<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Session;
use Carbon\Carbon;

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
            return redirect()->intended('dashboard')->withSuccess('Login Berhasil');
        } else{
            return redirect("login")->withSuccess('Username atau password tidak benar!');
        }
        return redirect("login")->withSuccess('Username atau password tidak benar!');
    }
    public function authenticateApi($user_id){
      
        if(Auth::loginUsingId($user_id)){
        $user = User::where('id', $user_id)->first();
            
            if($user->leveldata == 'Sekretaris'){
                return response()->json(['success'=>1,'message'=>'Berhasil Login Bendahara','url'=>'']);
            }elseif($user->leveldata == 'Ketua RT'){
                return response()->json(['success'=>1,'message'=>'Berhasil Login Ketua','url'=>'']);
            }elseif($user->leveldata == 'Admin'){
                return response()->json(['success'=>1,'message'=>'Berhasil Login Admin','url'=>'']);
            }elseif($user->leveldata == 'User'){
                return response()->json(['success'=>1,'message'=>'Berhasil Login User','url'=>'']);
            }elseif($user->leveldata == 'PJ'){
                return response()->json(['success'=>1,'message'=>'Berhasil Login User','url'=>'']);
            }else{
                return response()->json(['success'=>0,'message'=>'role tidak ada']);
            }
        }else{
            return response()->json(['success'=>0,'message'=>'Anda Gagal Login',]);
        }

        // return back()->with('loginError','login failed!');
    }
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
