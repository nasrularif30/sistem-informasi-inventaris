<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;

class LoginController extends Controller
{
    public function index()
    {
        // you can call some model here
        // store data in a variable and
        // pass this data to your view file

        // passing data to view file
        if(Auth::check()){
            return redirect('dashboard');
        } else{
            return view('login');
        }
    }
    public function auth(Request $request)
    {
        $credentials = [
            'username' => $request->input('username'),
            'password' => $request->input('password')
        ];
        $check = DB::table('user_login')
                    ->where('username', $credentials['username'])
                    ->get()
                    ->toArray();
        if(count($check)>0){
            if(Hash::check($credentials['password'], $check[0]->password)){
                Session::put('username', $check[0]->username);
                Session::put('level', $check[0]->level);
                Session::put('id_lokasi', $check[0]->id_lokasi);
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            }
            else{
                $request->session()->flash('error', 'Username atau password tidak benar');
                return redirect('/');
            }
        } else{
            $request->session()->flash('error', 'Username tidak terdaftar');
            return redirect('/');
        }
    }
}
