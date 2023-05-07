<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/dashboard';
    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
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
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard')->withSuccess('Login Berhasil');;
        } else{
            return redirect("login")->withSuccess('Username atau password tidak benar!');
        }
        return redirect("login")->withSuccess('Username atau password tidak benar!');
 
        // $check = DB::table('user_login')
        //             ->where('username', $credentials['username'])
        //             ->get()
        //             ->toArray();

        // if(count($check)>0){
        //     if(Hash::check($credentials['password'], $check[0]->password)){
        //         Session::put('username', $check[0]->username);
        //         Session::put('level', $check[0]->level);
        //         Session::put('id_lokasi', $check[0]->id_lokasi);
        //         $request->session()->regenerate();
        //         return redirect()->intended('dashboard');
        //     }
        //     else{
        //         $request->session()->flash('error', 'Username atau password tidak benar');
        //         return redirect('/');
        //     }
        // } else{
        //     $request->session()->flash('error', 'Username tidak terdaftar');
        //     return redirect('/');
        // }
    }
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
