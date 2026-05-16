<?php

namespace App\Http\Middleware; // Namespace harus tepat

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Logika pengecekan role admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Jika bukan admin, arahkan ke login dengan pesan error
        return redirect()->route('login')->with('error', 'Anda tidak memiliki akses Admin.');
    }
}