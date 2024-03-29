<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\File;
use App\Models\FotoInventaris;
use Illuminate\Support\Str;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data_peminjam = DB::table('warga')->get()->toArray();
        $data_barang = DB::table('inventaris')->get()->toArray();
        $dataFoto = DB::table('foto_inventaris AS fi')->select('*')->get();

        return view('peminjaman.index', ['data_barang'=>$data_barang,
                                                'data_peminjam'=>$data_peminjam,
                                                'dataFoto'=>$dataFoto]);
        // return view('peminjaman.index');
    }

    public function getAllPeminjaman(Request $request){
        if ($request->ajax()) {
            $data = DB::table('peminjaman AS p')
            ->leftJoin('inventaris AS i', 'p.id_barang', '=', 'i.id')
            ->leftJoin('warga AS w', 'p.id_peminjam', '=', 'w.id')
            ->select('p.*', 'w.nama_lengkap AS nama_peminjam', 'i.kode', 'i.nama AS nama_barang', 'i.kategori', 'i.status', 'i.ketersediaan AS tersedia', 'i.total_stok AS total_stok', 'i.kondisi')
            ->orderBy('p.id', 'DESC')
            ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $disable = $row->status_peminjaman == 2 ? '' : 'disabled';
                    $actionBtn = '<a data-id="'.$row->id.'" class="edit btn btn-primary btn-sm">
                                        <i class="ti ti-edit"></i>
                                        Edit
                                    </a>  
                                    <a data-id="'.$row->id.'" data-param="peminjaman" class="delete btn btn-danger btn-sm '. $disable .'">
                                        <i class="ti ti-trash"></i>
                                        Delete
                                    </a>';
                    return $actionBtn;
                })
                ->addColumn('status', function($row){
                    $status = ['Belum Diambil', 'Sudah Diambil', 'Sudah Dikembalikan'];
                    $rowStatus = $status[$row->status_peminjaman];
                    return $rowStatus;
                })
                ->addColumn('tanggal_pinjam', function($row){
                    $rowTgl = date('Y-m-d', strtotime($row->tanggal_pinjam));
                    return $rowTgl;
                })
                ->addColumn('tanggal_kembali', function($row){
                    $rowTgl = date('Y-m-d', strtotime($row->tanggal_kembali));
                    return $rowTgl;
                })
                ->rawColumns(['action'],['status'])
                ->make(true);
        }
    }

    public function getAllInventaris(Request $request){
        if ($request->ajax()) {
            $data = DB::table('inventaris AS i')
                    ->leftJoin('peminjaman AS p', 'i.id', '=', 'p.id_barang')
                    ->select('i.id', 'i.kode', 'i.nama', 'i.kategori', 'i.total_stok', 'i.kondisi', 'i.spek',
                            DB::raw('i.total_stok - SUM(if(p.status_peminjaman <> 2, p.jumlah, 0)) AS ketersediaan',
                              'if((i.total_stok - SUM(if(p.status_peminjaman <> 2, p.jumlah, 0))) = 0, 0, 1) AS `status`',
                              '(CASE WHEN (i.total_stok - SUM(if(p.status_peminjaman <> 2, p.jumlah, 0))) = 0 THEN 0 ELSE 1 END) AS status_barang',
                              'SUM(if(p.status_peminjaman <> 2, p.jumlah, 0)) dipinjam'))
                    ->groupBy('i.id')
                    ->orderBy('i.id', 'DESC')
                    ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a data-id="'.$row->id.'" class="detailBarang btn btn-success btn-sm me-1">
                                        <i class="ti ti-eye"></i>
                                        detail
                                    </a>';
                    
                    if(Auth::user()->leveldata === 'Admin' || Auth::user()->leveldata === 'Ketua RT')  {
                        $actionBtn .= '<a data-id="'.$row->id.'" class="editBarang btn btn-primary btn-sm">
                                        <i class="ti ti-edit"></i>
                                        edit
                                    </a> 
                                    <a data-id="'.$row->id.'" class="editFoto btn btn-warning btn-sm">
                                        <i class="ti ti-camera-cog"></i>
                                        edit foto
                                    </a> 
                                    <a data-id="'.$row->id.'" data-param="barang" class="delete btn btn-danger btn-sm">
                                        <i class="ti ti-trash"></i>
                                        delete
                                    </a>';
                    }
                    return $actionBtn;
                })
                ->addColumn('status', function($row){
                    $status = ['Tidak Tersedia', 'Tersedia'];
                    $valStatus = $row->ketersediaan == 0 ? 0 : 1;
                    $txtStatus = $status[$valStatus];
                    $bgStatus = $valStatus == 1 ? 'bg-success' : 'bg-danger';
                    $rowStatus = '<span class="badge '.$bgStatus.'">'.$txtStatus.'</span>';
                    return $rowStatus;
                })
                ->escapeColumns([])
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $success = false;
        $message = 'error';
        $id_peminjam = $request->input('nama_peminjam') ?? $request->input('id_peminjam');
        $id_peminjaman = $request->input('id_peminjaman') ?? 0;
        $jumlah = $request->input('jumlah_peminjaman') ?? $request->input('jml_peminjaman');
        $tangal_peminjaman = $request->input('tgl_peminjaman');
        $tanggal_kembali = $request->input('tgl_kembali');
        $status_peminjaman = $request->input('status_peminjaman');
        $id_barang_peminjaman = $request->input('nama_barang_peminjaman') ?? $request->input('id_barang_peminjaman');

        $lastBarang = DB::table('inventaris')->select('*')->orderBy('id', 'DESC')->first();
        
        $id_barang = $request->input('id_barang') ?? $lastBarang->id + 1;
        $nama_barang = $request->input('nama_barang');
        $kode_barang = $request->input('kode');
        $spek_barang = $request->input('spek');
        $status_barang = $request->input('status');
        $total_stok = $request->input('total_stok');
        $kondisi_barang = $request->input('kondisi');
        $param = $request->input('param');
        $totalFile = $request->input('totalFile');
        // $foto_barang = $request->file('foto_barang');
        // die(print_r($request->input('spek')));
        if($param == "barang"){
            if(!File::exists('file/')) File::makeDirectory('file/');
            if(!File::exists('file/inventaris/')) File::makeDirectory('file/inventaris/');
            if(!File::exists('file/inventaris/' . $id_barang)) File::makeDirectory('file/inventaris/' . $id_barang);
            if($request->hasFile('foto_barang0')){
                $input=$request->all();
                $destinationPath = 'file/inventaris/' . $id_barang;
                $file_name = Str::random(10) . "." . $request->file('foto_barang0')->getClientOriginalExtension();
                $request->file('foto_barang0')->move($destinationPath, $file_name);
                $foto_barang = $destinationPath . '/' . $file_name;
                DB::table('foto_inventaris')
                    ->insert(['id_barang'=>$id_barang, 
                                'foto_barang' => $foto_barang,
                            ]);
            }
            // die(print_r($foto_barang));
            if ($totalFile > 0) {
                for ($i=0; $i < $request->toalFoto; $i++) { 
                    // die(print_r($i));
                    if($request->hasFile('foto_barang'."$i")){
                        $file_name = Str::random(10) . "." . $request->file('foto_barang'."$i")->getClientOriginalExtension();
                        $request->file('foto_barang'."$i")->move($destinationPath, $file_name);
                        $foto_barang = $destinationPath . '/' . $file_name;
                        
                        DB::table('foto_inventaris')
                            ->insert(['id_barang'=>$id_barang, 
                                        'foto_barang' => $foto_barang,
                                    ]);
                    }
                }
            }
            DB::table('inventaris')
            ->updateOrInsert(['id' => $id_barang],
                                ['nama'=>$nama_barang, 
                                 'spek' => $spek_barang,
                                 'kondisi'=>$kondisi_barang,
                                 'total_stok'=>$total_stok,
                                 'ketersediaan'=>$total_stok,]);
            $success = true;
            $message = "Inventaris ".$nama_barang." berhasil ditambahkan!";
        }else{
            $cekStok = DB::table('inventaris')->where('id', $id_barang_peminjaman)->get()->toArray();
            if($id_peminjaman != 0 ){
                if($status_peminjaman == 2){
                    DB::table('inventaris')
                        ->where('id', $id_barang_peminjaman)
                        ->update(['ketersediaan'=> ($cekStok[0]->ketersediaan + $jumlah),
                                    'status'=> 1]);
                    $success = true;
                    $message = "Peminjaman berhasil diperbarui!";
                }else{
                    $success = true;
                    $message = "Peminjaman berhasil diperbarui!";
                }
                DB::table('peminjaman')
                    ->updateOrInsert(['id' => $id_peminjaman],
                                    ['id_peminjam'=>$id_peminjam,
                                        'id_barang'=>$id_barang_peminjaman,
                                        'tanggal_pinjam'=>$tangal_peminjaman,
                                        'tanggal_kembali'=>$tanggal_kembali,
                                        'status_peminjaman'=>$status_peminjaman ?? 2]);
            }else{
                if ($cekStok[0]->ketersediaan > 0) {
                    if($jumlah > $cekStok[0]->total_stok){
                        $success = false;
                        $message = "Jumlah barang maksimal dipinjam sejumlah <b>".$cekStok[0]->total_stok."</b> buah";
                    } else if($jumlah > $cekStok[0]->ketersediaan){ 
                        $success = false;
                        $message = "Jumlah barang tersedia sejumlah <b>".$cekStok[0]->ketersediaan."</b> buah";
                    } else{
                        DB::table('peminjaman')
                            ->updateOrInsert(['id' => $id_peminjaman],
                                            ['id_peminjam'=>$id_peminjam,
                                            'id_barang'=>$id_barang_peminjaman,
                                            'jumlah'=>$jumlah,
                                            'tanggal_pinjam'=>$tangal_peminjaman,
                                            'tanggal_kembali'=>$tanggal_kembali,
                                            'status_peminjaman'=>$status_peminjaman]);
                        DB::table('inventaris')
                            ->where('id', $id_barang_peminjaman)
                            ->update(['ketersediaan'=> ($cekStok[0]->ketersediaan - $jumlah)]);
                        $success = true;
                        $message = "Peminjaman berhasil ditambahkan!";
                    }
                } else{
                    $success = false;
                    $message = "Barang tidak tersedia!";
                }
            }

        }
        //  return response
        return Response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id_barang = request('id_barang') ?? 0;
        $id_peminjaman = request('id_peminjaman') ?? 0;
        $data_peminjam = DB::table('warga')->get()->toArray();
        $data_barang = DB::table('inventaris')->get()->toArray();

        return view('peminjaman.create', compact(['data_barang'=>$data_barang,
                                    'data_peminjam'=>$data_peminjam]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $param = $request->param;
        $id = $request->id;
        if ($param == 'peminjaman') {
            $data = DB::table('peminjaman AS p')
                    ->leftJoin('inventaris AS i', 'p.id_barang', '=', 'i.id')
                    ->leftJoin('warga AS w', 'p.id_peminjam', '=', 'w.id')
                    ->select('p.*', 'w.nama_lengkap AS nama_peminjam', 'i.kode', 'i.nama AS nama_barang', 'i.kategori', 'i.status', 'i.ketersediaan AS tersedia', 'i.total_stok AS total_stok', 'i.kondisi')
                    ->where('p.id', $id)
                    ->orderBy('p.id', 'DESC')
                    ->get()
                    ->toArray();
            return response()->json($data);
        } else {
            $data = DB::table('inventaris AS i')
                    ->where('i.id', $id)
                    ->select('*')
                    ->get()
                    ->toArray();
            $dataFoto = DB::table('foto_inventaris AS fi')
                    ->where('fi.id_barang', $id)
                    ->select('*')
                    ->get();
            // return view('peminjaman.inventaris', compact(['data', 'dataFoto']));
            return response()->json($data);
        }
        
    }

    public function detail(Request $request)
    {
        $id = $request->id;
        $data = DB::table('inventaris AS i')
                ->where('i.id', $id)
                ->select('*')
                ->get()
                ->first();
        $dataFoto = DB::table('foto_inventaris AS fi')
                ->where('fi.id_barang', $id)
                ->select('*')
                ->get();
        // return response()->json(['data'=>$data, 'dataFoto'=>$dataFoto]);
        return view('peminjaman.detail', compact(['data', 'dataFoto']));
    }

    public function editFoto(Request $request)
    {
        $id = $request->id;
        $data = DB::table('inventaris AS i')
                ->where('i.id', $id)
                ->select('*')
                ->get()
                ->first();
        $dataFoto = DB::table('foto_inventaris AS fi')
                ->where('fi.id_barang', $id)
                ->select('*')
                ->get();
        // return response()->json(['data'=>$data, 'dataFoto'=>$dataFoto]);
        return view('peminjaman.editfoto', compact(['data', 'dataFoto']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $param = $request->param;
        $tablename = '';
        if($param == "peminjaman"){
            $tablename = 'peminjaman';
        }else{
            $tablename = 'inventaris';
        }
        $delete = DB::table($tablename)->where('id', $id)->delete();
        // check data deleted or not
        if ($delete == 1) {
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
    public function deleteFoto(Request $request)
    {
        $id = $request->id;
        $path = $request->path;
        $tablename = 'foto_inventaris';
        $delete = DB::table($tablename)->where('id', $id)->delete();
        $deleteFile = Storage::delete([$path]);
        // check data deleted or not
        if ($delete == 1) {
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
