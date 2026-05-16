<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthPetani
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah user sudah login (menggunakan guard default 'web')
        // 2. Cek apakah role-nya adalah 'petani'
        if (Auth::check() && Auth::user()->role === 'petani') {
            return $next($request);
        }

        // Jika bukan petani, arahkan kembali ke login
        return redirect()->route('login')->with('error', 'Akses khusus petani.');
    }
}