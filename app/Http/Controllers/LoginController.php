<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        // you can call some model here
        // store data in a variable and
        // pass this data to your view file

        // passing data to view file
        return view('login');
    }
    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);
        $check = DB::select('select * from user_login where username = ? and password = ?', [$request['username'], Hash::make($request['password'])]);
        if(count($check) > 0){
            // Session::put('username', $check->username);
            // Session::put('level', $check->level);
            // Session::put('id_lokasi', $check->id_lokasi);
            // $request->session()->regenerate();
            return redirect()->intended('dashboard');
        } else{
            return back()->with('loginError', 'Login failed');
        }
        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();
        //     return redirect()->intended('/dashboard');
        // }
        return Redirect::to("login")->withSuccess('Oppes! You have entered invalid credentials');
    }
}
