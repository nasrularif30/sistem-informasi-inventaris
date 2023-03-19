<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\RegisterController;
use Yajra\Datatables\Datatables;

Route::get('/', [LoginController::class, 'index']);
Route::get('/dashboard', [HomeController::class, 'index']);
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'auth']);
Route::get('users', [UsersController::class, 'index'])->name('users.index');

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'show'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'handle'])->name('register');
