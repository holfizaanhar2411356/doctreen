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
        if (Auth::check() && Auth::user()->role === 'konsultan') {
            if (Auth::user()->status === 'active') {
                return $next($request);
            }
            Auth::logout();
            return redirect()->route('login')->with('error', 'Akun Konsultan Anda sedang dalam status PENDING dan menunggu verifikasi dari Admin sebelum dapat digunakan.');
        }
        // Jika bukan konsultan, arahkan kembali ke login
        return redirect()->route('login')->with('error', 'Akses khusus konsultan.');
    }
}
