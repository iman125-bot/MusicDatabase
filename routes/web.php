<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

// Route Login
Route::get('/upload', [ImageController::class, 'create'])->name('upload.form');
Route::post('/upload', [ImageController::class, 'store'])->name('upload.store');
Route::delete('/upload/{id}', [ImageController::class, 'destroy'])->name('upload.destroy');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route dengan proteksi auth
Route::middleware('auth')->group(function () {

    // Route ke halaman daftar musik + cek genre
    Route::get('/musics', [MusicController::class, 'index'])->middleware('check.genre')->name('musics.index');

    // Resource untuk CRUD Music
    Route::resource('musics', MusicController::class)->except(['index']);

    // Route untuk menampilkan filter musik lain, bisa diatur sesuai kebutuhan
    Route::get('/musics/filter', function () {
        return 'Selamat datang di koleksi musik pilihan Anda!';
    })->middleware('check.genre');
});