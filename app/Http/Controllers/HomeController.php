<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        \Log::info('Akses halaman home', ['user_id' => \Auth::id(), 'ip' => request()->ip()]);
        return view('home');
    }
}
