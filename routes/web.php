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
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('login/auth', [LoginController::class, 'auth'])->name('login.auth');
Route::get('users', [UsersController::class, 'index'])->name('users');
// Route::post('users', [UsersController::class, 'index'])->name('users.index');
Route::get('users/list', [UsersController::class, 'getAllUsers'])->name('users.list');
Route::post('users/create', [UsersController::class, 'create'])->name('users.create');
Route::post('users/store', [UsersController::class, 'store'])->name('users.store');
Route::post('users/update', [UsersController::class, 'update'])->name('users.update');
Route::get('users/edit', [UsersController::class, 'edit'])->name('users.edit');
Route::get('users/delete', [UsersController::class, 'destroy'])->name('users.delete');

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'show'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'handle'])->name('register');
