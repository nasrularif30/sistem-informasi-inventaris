<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        return view('users.index');
    }

    public function getAllUsers(Request $request)
    {   
             
        if ($request->ajax()) {
            $data = DB::table('user_login')
                        ->join('user_level', 'user_login.level', '=', 'user_level.id')
                        ->select('user_login.id', 'user_login.nama', 'user_login.username', 'user_login.id_lokasi', 'user_level.level', 'user_login.last_login', 'user_login.create_at', 'user_login.level as level_id')
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
                ->rawColumns(['action'])
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
        request()->validate([
            'nama' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'min:4', 'max:255'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            'level' => ['string'],
            'id_lokasi' => ['integer']
        ]);
        $success = false;
        $message = 'error';
        $data = $request->input();
			try{
                $check = DB::select('select * from user_login where username = ?', [request('username')]);
                if(count($check) > 0){
                    $message = 'Username telah digunakan';
                } else{
                    DB::table('user_login')->insert([
                        'nama' => request('nama'),
                        'username' => request('username'),
                        'password' => Hash::make(request('password')),
                        'level' => request('level') ?? 5,
                        'id_lokasi' => request('id_lokasi') ?? 0
                    ]);
                    $success = true;
                    $message = 'User '.request('nama').' berhasil ditambahkan!';
                }
			}
			catch(Exception $e){
				$message = 'error, '.$e;
			}
            
        //  return response
            return response()->json([
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
            'id' => ['integer'],
            'nama' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'min:4', 'max:255'],
            'old_username' => ['string', 'min:4', 'max:255'],
            'level' => ['string'],
            'id_lokasi' => ['integer']
        ]);
        $success = false;
        $message = 'error';
        $data = $request->input();
        if(request('username') != request('old_username')){
            $check = DB::select('select * from user_login where username = ?', [request('username')]);
            if(count($check) > 0){
                $message = 'Username telah digunakan';
            } else{
                DB::table('user_login')->where('id', request('id'))->update([
                    'nama' => request('nama'),
                    'username' => request('username'),
                    'level' => request('level') ?? 5,
                    'id_lokasi' => request('id_lokasi') ?? 0
                ]);
                $success = true;
                $message = 'User '.request('nama').' berhasil diperbarui!';
            }

        } else{
            DB::table('user_login')->where('id', request('id'))->update([
                'nama' => request('nama'),
                'username' => request('username'),
                'level' => request('level') ?? 5,
                'id_lokasi' => request('id_lokasi') ?? 0
            ]);
            $success = true;
            $message = 'User '.request('nama').' berhasil diperbarui!';
        }
            
        //  return response
            return response()->json([
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
        $data = DB::table('user_login')
        ->join('user_level', 'user_login.level', '=', 'user_level.id')
        ->select('user_login.id', 'user_login.nama', 'user_login.username', 'user_login.id_lokasi', 'user_level.level', 'user_login.last_login', 'user_login.create_at', 'user_login.level as level_id')
        ->where('user_login.id', $id)
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
        $delete = DB::table('user_login')->where('id', $id)->delete();
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
