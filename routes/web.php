<?php

use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PengaduanController::class, 'index'])->name('user.home');
Route::get('/gallery', function() {
    return view('gallery');
})->name('gallery');

Route::get('/cari', [PengaduanController::class, 'searchById'])->name('pengaduan.cari');

Route::get('/success', [PengaduanController::class, 'index'])->name('pengaduan.success');
Route::post('/store', [PengaduanController::class, 'store'])->name('pengaduan.store');

Route::middleware(['auth'])->group(function () {
    Route::resource('/admin', AuthController::class);
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login-process', [AuthController::class, 'login_process'])->name('login-process');
