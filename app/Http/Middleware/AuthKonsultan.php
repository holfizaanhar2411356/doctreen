<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthKonsultan
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah user sudah login (menggunakan guard default 'web')
        // 2. Cek apakah role-nya adalah 'konsultan'
        if (Auth::check() && Auth::user()->role === 'konsultan') {
            return $next($request);
        }

        // Jika bukan konsultan, arahkan kembali ke login
        return redirect()->route('login')->with('error', 'Akses khusus konsultan.');
    }
}