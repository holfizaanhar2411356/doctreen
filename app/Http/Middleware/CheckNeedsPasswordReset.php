<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckNeedsPasswordReset
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = auth()->user();
            // Jika butuh reset password, dan tidak sedang mengakses route ganti-sandi/logout
            if ($user->needs_password_reset && 
                !$request->routeIs('password.new.form') && 
                !$request->routeIs('password.new.update') && 
                !$request->routeIs('logout')) {
                
                return redirect()->route('password.new.form')
                    ->with('error', 'Anda harus mengubah kata sandi default Anda terlebih dahulu demi keamanan akun.');
            }
        }

        return $next($request);
    }
}
