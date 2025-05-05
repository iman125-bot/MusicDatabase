<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MusicController;

Route::resource('musics', MusicController::class);