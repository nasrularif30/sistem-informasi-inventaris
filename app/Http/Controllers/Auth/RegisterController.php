<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{    
    public function show()
    {
        return  view('auth.register');
    }

    public function handle()
    {
        request()->validate([
            'nama' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'min:4', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'level' => ['string'],
            'id_lokasi' => ['integer']
        ]);

        $user = User::create([
            'nama' => request('nama'),
            'username' => request('username'),
            'password' => Hash::make(request('password')),
            'level' => request('level'),
            'id_lokasi' => request('id_lokasi')
        ]);

        event(new Registered($user));
        return redirect()->to('/users');
    }
}
