<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Penduduk;
use DataTables;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data_warga = Penduduk::latest()->get();
        return view('users.index', compact('data_warga'));
    }

    public function getAllUsers(Request $request)
    {   
        if ($request->ajax()) {
            $data = DB::table('loginn AS l')
                        ->leftJoin('warga AS w', 'l.id_warga', '=', 'w.id')
                        ->select('l.*', 'w.nama_lengkap')
                        ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a data-id="'.$row->id.'" class="edit btn btn-primary btn-sm">
                                        <i class="ti ti-edit"></i>
                                        Edit
                                    </a>  
                                    <a data-id="'.$row->id.'" class="changepass btn btn-yellow btn-sm">
                                        <i class="ti ti-key"></i>
                                        Change
                                    </a>
                                    <a data-id="'.$row->id.'" class="delete btn btn-danger btn-sm">
                                        <i class="ti ti-trash"></i>
                                        Delete
                                    </a>';
                    return $actionBtn;
                })
                ->addColumn('nama_warga', function($row)
                {
                    $id_warga = $row->nama_lengkap;
                    $bg = $id_warga ? 'success' : 'warning';
                    $btn = '<span data-id="'.$row->id.'" class="ubahwarga badge bg-'.$bg.' ">
                                <i class="ti ti-user"></i>
                                '.$row->nama_lengkap.'
                            </span>';
                    return $btn;
                })
                ->rawColumns(['action', 'nama_warga'])
                ->make(true);
        }
        // echo json_encode($data->toArray());
        return view('users.index');
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
        $validate = request()->validate([
            'nama' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'min:4', 'max:255'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:5', 'same:password'],
            'level' => ['string']
        ]);
        try{
            $check = DB::select('select * from loginn where username = ?', [request('username')]);
            if(count($check) > 0){
                $message = 'Username telah digunakan';
            } else{
                DB::table('loginn')->insert([
                    'nama' => request('nama'),
                    'username' => request('username'),
                    'password' => Hash::make(request('password')),
                    'leveldata' => request('level') ?? 'User',
                    'id_warga' => request('nama_warga') ?? 0
                ]);
                $success = true;
                $message = 'User '.request('nama').' berhasil ditambahkan!';
            }
        }
        catch(Exception $e){
            $message = 'error, '.$e;
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
        request()->validate([
            'id_user' => ['integer'],
            'nama' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'min:4', 'max:255'],
            'old_username' => ['string', 'min:4', 'max:255'],
            'level' => ['string'],
            'nama_warga' => ['integer']
        ]);
        $success = false;
        $message = 'error';
        if(request('username') != request('old_username')){
            $check = DB::select('select * from loginn where username = ?', [request('username')]);
            if(count($check) > 0){
                $message = 'Username telah digunakan';
            } else{
                DB::table('loginn')->where('id', request('id_user'))->update([
                    'nama' => request('nama'),
                    'username' => request('username'),
                    'leveldata' => request('level') ?? 'User',
                    'id_warga' => request('nama_warga') ?? 0
                ]);
                $success = true;
                $message = 'User '.request('nama').' berhasil diperbarui!';
            }

        } else{
            $store = DB::table('loginn')
                        ->updateOrInsert(
                            ['id' => request('id_user')],
                            ['nama' => request('nama'), 
                            'username' => request('username'), 
                            'leveldata' => request('level') ?? 'User', 
                            'id_warga' => request('nama_warga') ?? 0]
                        );
            $success = true;
            $message = 'User '.request('nama').' berhasil diperbarui!';
        }
            
        //  return response
        return Response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $data = DB::table('loginn AS l')
        ->leftJoin('warga AS w', 'l.id_warga', '=', 'w.id')
        ->select('l.id', 'l.id_warga','l.nama', 'l.username', 'l.last_login', 'l.create_at', 'l.leveldata', 'w.nama_lengkap')
        ->where('l.id', $id)
        ->get()
        ->toArray();
        return Response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $success = false;
        $message = '';
        try {
            DB::table('loginn')->where('id', request('id_user'))->update([
                'password' => Hash::make(request('password'))
            ]);
            $success = true;
            $message = 'Berhasil mengubah password';
        } catch (Exception $e) {
            $message = 'error, '.$e;
        }
        return Response()->json([
            'success' => $success,
            'message' => $message,
        ]);
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
        $delete = DB::table('loginn')->where('id', $id)->delete();
        // check data deleted or not
        if ($delete == 1) {
            $success = true;
            $message = "User deleted successfully";
        } else {
            $success = false;
            $message = "User not found";
        }

        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
