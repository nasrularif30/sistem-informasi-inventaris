<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

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

        return view('peminjaman.index', ['data_barang'=>$data_barang,
                                                'data_peminjam'=>$data_peminjam]);
        // return view('peminjaman.index');
    }

    public function getAllPeminjaman(Request $request){
        if ($request->ajax()) {
            $data = DB::table('inventaris AS i')
            ->leftJoin('peminjaman AS p', 'i.id', '=', 'p.id_barang')
            ->leftJoin('warga AS w', 'p.id_peminjam', '=', 'w.id')
            ->select('p.*', 'w.nama_lengkap AS nama_peminjam', 'i.kode', 'i.nama AS nama_barang', 'i.kategori', 'i.status', 'i.ketersediaan AS tersedia', 'i.total_stok AS jumlah_barang', 'i.kondisi')
            ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a data-id="'.$row->id.'" class="edit btn btn-primary btn-sm">
                                        <i class="ti ti-edit"></i>
                                        Edit
                                    </a>  
                                    <a data-id="'.$row->id.'" class="delete btn btn-danger btn-sm">
                                        <i class="ti ti-trash"></i>
                                        Delete
                                    </a>';
                    return $actionBtn;
                })
                ->addColumn('status', function($row){
                    $status = ['Tidak Ada', 'Ada'];
                    $rowStatus = $status[$row->status];
                    return $rowStatus;
                })
                ->rawColumns(['action'],['status'])
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
        $id_peminjam = $request->input('id_peminjam');
        $id_peminjaman = $request->input('id_peminjaman');
        $jumlah = $request->input('jumlah');
        $tangal_peminjaman = $request->input('tanggal_peminjaman');
        $tanggal_kembali = $request->input('tanggal_kembali');
        $status_peminjaman = $request->input('status_peminjaman');
        $id_barang_peminjaman = $request->input('id_barang_peminjaman');

        $id_barang = $request->input('id_barang');
        $nama_barang = $request->input('nama_barang');
        $kode_barang = $request->input('kode');
        $status_barang = $request->input('status');
        $total_stok = $request->input('total_stok');
        $kondisi_barang = $request->input('kondisi');
        $param = $request->input('param');
        if($param == "barang"){
            DB::table('inventaris')
            ->updateOrInsert(['id' => $id_barang, 'kode' => $kode_barang],
                                ['nama'=>$nama_barang,
                                 'kondisi'=>$kondisi_barang,
                                 'status'=>$status_barang,
                                 'total_stok'=>$total_stok]);
            $success = true;
            $message = "Inventaris ".$nama_barang." berhasil ditambahkan!";
        }else{
            DB::table('peminjaman')
            ->updateOrInsert(['id' => $id_peminjaman],
                                ['id_peminjam'=>$id_peminjam,
                                 'id_barang'=>$id_barang_peminjaman,
                                 'jumlah'=>$jumlah,
                                 'tanggal_pinjam'=>$tangal_peminjaman,
                                 'tanggal_kembali'=>$tanggal_kembali,
                                 'status_peminjaman'=>$status_peminjaman]);
            $success = true;
            $message = "Peminjaman berhasil ditambahkan!";

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
    public function edit($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
