<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user sudah login dan memiliki role 'admin'
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect()->route('admin.login')->with('error', 'Akses ditolak. Anda harus login sebagai admin.');
        }
        return $next($request);
    }
}