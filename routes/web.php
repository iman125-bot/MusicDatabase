<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MusicController;

Route::resource('musics', MusicController::class);
Route::get('/musics/{id}', [MusicController::class, 'show']);
