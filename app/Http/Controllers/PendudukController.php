<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Agama;
use App\Models\Lokasi;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $penduduk = array();
        if ($request->ajax()) {
            $penduduk = DB::table('warga AS w')
                            ->leftJoin('lokasi AS l', 'w.id_lokasi', '=', 'l.id')
                            ->leftJoin('agama AS a', 'w.agama', '=', 'a.id')
                            ->leftJoin('pekerjaan AS pk', 'w.pekerjaan', '=', 'pk.id')
                            ->leftJoin('pendidikan AS pl', 'w.pendidikan', '=', 'pl.id')
                            ->leftJoin('jenis_kelamin AS j', 'w.jenis_kelamin', '=', 'j.id')
                            ->select('w.id', 'w.nik', 'w.nama_lengkap', 'l.alamat_lengkap AS alamat', 'w.tanggal_lahir', 'w.tempat_lahir', 'pk.pekerjaan', 'pl.pendidikan', 'a.nama_agama AS agama', 'w.ktp_file', 'w.kk_file')
                            ->get();
            // $penduduk = Penduduk::latest()->get();
            return Datatables::of($penduduk)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a data-id="'.$row->id.'" class="edit btn btn-primary btn-sm">
                                        <i class="ti ti-edit"></i>
                                        Edit
                                    </a>  
                                    <a data-id="'.$row->id.'" data-param="peminjaman" class="delete btn btn-danger btn-sm">
                                        <i class="ti ti-trash"></i>
                                        Delete
                                    </a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('penduduk.index',compact('penduduk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_alamat = Lokasi::latest()->get();
        $data_pekerjaan = Pekerjaan::latest()->get();
        $data_pendidikan = Pendidikan::latest()->get();
        $data_agama = Agama::latest()->groupBy('id')->get();
        return view('penduduk.create', compact(['data_alamat', 'data_pekerjaan', 'data_pendidikan', 'data_agama']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $success = false;
        $message = '';
        // $validator = $request->validate([
        //     'nik' => 'required',
        //     'nama' => 'required',
        //     'alamat' => 'required',
        //     'tgl_lahir' => 'required',
        //     'tempat_lahir' => 'required',
        //     'pekerjaan' => 'required',
        //     'pendidikan' => 'required',
        //     'agama' => 'required',
        //     'file_ktp' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //     'file_kk' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
        // if ($validator->fails()) {
        //    return response()->json(['success' => false, 'message' => $validator->errors()]);
        // }
        $nik = $request->input('nik');
        $nama = $request->input('nama');
        $alamat = $request->input('alamat');
        $jenis_kelamin = $request->input('jenis_kelamin');
        $tgl_lahir = $request->input('tgl_lahir');
        $tempat_lahir = $request->input('tempat_lahir');
        $pekerjaan = $request->input('pekerjaan');
        $pendidikan = $request->input('pendidikan');
        $agama = $request->input('agama');
        $file_ktp = $request->file('file_ktp');
        $file_kk = $request->file('file_kk');
  
        $input = $request->all();
        if(!File::exists('file/')) File::makeDirectory('file/');
        if(!File::exists('file/' . $nik)) File::makeDirectory('file/' . $nik);
        $destinationPath = 'file/' . $nik;
  
        if ($request->hasFile('file_ktp')) {
            $file_name = "ktp_" . $nik . "." . $file_ktp->getClientOriginalExtension();
            $file_ktp->move($destinationPath, $file_name);
            $input['file_ktp'] = "$file_name";
            $file_ktp = $file_name;
        }
        if ($request->hasFile('file_kk')) {
            $file_name = "kk_" . $nik . "." . $file_kk->getClientOriginalExtension();
            $file_kk->move($destinationPath, $file_name);
            $input['file_kk'] = "$file_name";
            $file_kk = $file_name;
        }
    
        DB::table('warga')->updateOrInsert(['nik' => $nik],
                                            ['nama_lengkap' => $nama,
                                            'alamat' => $alamat,
                                            'tanggal_lahir' => $tgl_lahir,
                                            'tempat_lahir' => $tempat_lahir,
                                            'agama' => $agama,
                                            'jenis_kelamin' => $jenis_kelamin,
                                            'pendidikan' => $pendidikan,
                                            'pekerjaan' => $pekerjaan,
                                            'ktp_file' => $file_ktp,
                                            'kk_file' => $file_kk,
                                            'id_lokasi' => $alamat
                                            ]);
        return response()->json(['success' => true, 'message' => 'sukses menambahkan data!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penduduk  $penduduk
     * @return \Illuminate\Http\Response
     */
    public function show(Penduduk $penduduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penduduk  $penduduk
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $data = Penduduk::where('id', $id)->get()->toArray();
        $data_alamat = Lokasi::latest()->get();
        $data_pekerjaan = Pekerjaan::latest()->get();
        $data_pendidikan = Pendidikan::latest()->get();
        $data_agama = Agama::latest()->groupBy('id')->get();
        return view('penduduk.edit', compact(['data', 'data_alamat', 'data_pekerjaan', 'data_pendidikan', 'data_agama']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penduduk  $penduduk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penduduk $penduduk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penduduk  $penduduk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penduduk $penduduk, Request $request)
    {
        $id = $request->id;
        // $tablename = 'warga';
        $penduduk = Penduduk::where('id', $id);
        $penduduk->delete();
        // check data deleted or not
        if ($penduduk) {
            $success = true;
            $message = "Data berhasil dihapus";
        } else {
            $success = false;
            $message = "Terjadi kesalahan";
        }

        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
