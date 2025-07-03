<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        \Log::info('Akses halaman login', ['ip' => request()->ip()]);
        return view('login');
    }

    public function login(Request $request)
    {
        \Log::info('Proses login dimulai', ['email' => $request->email, 'ip' => $request->ip()]);
        try {
            $credentials = $request->only('email', 'password');

            if (\Auth::attempt($credentials)) {
                \Log::info('User login', ['email' => $request->email, 'ip' => $request->ip()]);
                $request->session()->regenerate();
                return redirect()->route('home');
            }

            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ]);
        } catch (\Throwable $e) {
            \Log::error('Error saat login: ' . $e->getMessage(), [
                'email' => $request->email,
                'ip' => $request->ip(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return back()->with('error', 'Terjadi kesalahan saat login.');
        }
    }

    public function logout(Request $request)
    {
        \Log::info('Proses logout dimulai', ['user_id' => \Auth::id(), 'ip' => $request->ip()]);
        try {
            \Log::info('User logout', ['user_id' => \Auth::id(), 'ip' => $request->ip()]);
            \Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/login');
        } catch (\Throwable $e) {
            \Log::error('Error saat logout: ' . $e->getMessage(), [
                'user_id' => \Auth::id(),
                'ip' => $request->ip(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return back()->with('error', 'Terjadi kesalahan saat logout.');
        }
    }
}