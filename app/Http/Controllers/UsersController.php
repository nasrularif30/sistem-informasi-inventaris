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
            $data = DB::table('user_login')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">
                                        <i class="ti ti-edit"></i>
                                        Edit
                                    </a>  
                                    <a href="javascript:void(0)" class="changepass btn btn-yellow btn-sm">
                                        <i class="ti ti-key"></i>
                                        Change
                                    </a>
                                    <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">
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
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'level' => ['string'],
            'id_lokasi' => ['integer']
        ]);
        $data = $request->input();
			try{
                $check = DB::select('select * from user_login where username = ?', [request('username')]);
                if(count($check) > 0){
                    return redirect('users')->with('failed',"Username already exist");
                } else{
                    DB::table('user_login')->insert([
                        'nama' => request('nama'),
                        'username' => request('username'),
                        'password' => Hash::make(request('password')),
                        'level' => request('level') ?? 5,
                        'id_lokasi' => request('id_lokasi') ?? 0
                    ]);
                    return redirect('users')->with('status',"Insert successfully");
                }
			}
			catch(Exception $e){
				return redirect('users')->with('failed',"operation failed");
			}
        
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
