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

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\RegisterController;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\ProfileController;
Route::get('/', function () {
    return view('index');
})->middleware(['auth']);

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard')->middleware(['auth']);

require __DIR__.'/auth.php';

Route::get('users', [UsersController::class, 'index'])->name('users')->middleware(['auth']);
Route::get('users/list', [UsersController::class, 'getAllUsers'])->name('users.list')->middleware(['auth']);
Route::post('users/create', [UsersController::class, 'create'])->name('users.create')->middleware(['auth']);
Route::post('users/store', [UsersController::class, 'store'])->name('users.store')->middleware(['auth']);
Route::post('users/update', [UsersController::class, 'update'])->name('users.update')->middleware(['auth']);
Route::get('users/edit', [UsersController::class, 'edit'])->name('users.edit')->middleware(['auth']);
Route::get('users/delete', [UsersController::class, 'destroy'])->name('users.delete')->middleware(['auth']);

Route::get('peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman')->middleware(['auth'])->middleware(['auth']);
Route::get('peminjaman/list', [PeminjamanController::class, 'getAllPeminjaman'])->name('peminjaman.list')->middleware(['auth']);
Route::get('peminjaman/inventaris', [PeminjamanController::class, 'getAllInventaris'])->name('peminjaman.inventaris')->middleware(['auth']);
Route::post('peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create')->middleware(['auth']);
Route::get('peminjaman/show', [PeminjamanController::class, 'show'])->name('peminjaman.show')->middleware(['auth']);
Route::post('peminjaman/store', [PeminjamanController::class, 'store'])->name('peminjaman.store')->middleware(['auth']);
Route::post('peminjaman/update', [PeminjamanController::class, 'update'])->name('peminjaman.update')->middleware(['auth']);
Route::get('peminjaman/edit', [PeminjamanController::class, 'edit'])->name('peminjaman.edit')->middleware(['auth']);
Route::get('peminjaman/delete', [PeminjamanController::class, 'destroy'])->name('peminjaman.delete')->middleware(['auth']);

// Route::resource('penduduk', PendudukController::class);
Route::get('penduduk', [PendudukController::class, 'index'])->name('penduduk.index')->middleware(['auth']);
Route::get('penduduk/create', [PendudukController::class, 'create'])->name('penduduk.create')->middleware(['auth']);
Route::post('penduduk/store', [PendudukController::class, 'store'])->name('penduduk.store')->middleware(['auth']);
Route::get('penduduk/destroy', [PendudukController::class, 'destroy'])->name('penduduk.destroy')->middleware(['auth']);
Route::get('penduduk/edit', [PendudukController::class, 'edit'])->name('penduduk.edit')->middleware(['auth']);

Route::get('profile', [ProfileController::class, 'index'])->name('profile')->middleware(['auth']);

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'show'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'handle'])->name('register');
