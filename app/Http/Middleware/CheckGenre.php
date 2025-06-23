<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckGenre
{
    public function handle(Request $request, Closure $next)
    {
        // Ambil parameter genre dari URL query
        $genre = $request->query('genre');

        // Cek jika genre 'Explicit' dilarang diakses
        if ($genre === 'Explicit') {
            return response()->view('denied', [], 403);
        }
        return $next($request);
    }
}