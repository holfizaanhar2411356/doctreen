<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthAdminOrKonsultan
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'konsultan')) {
            return $next($request);
        }

        if ($request->expectsJson()) {
            return response()->json(['error' => 'Akses ditolak.'], 403);
        }

        return redirect()->route('login')->with('error', 'Akses ditolak. Anda tidak memiliki izin untuk halaman ini.');
    }
}
