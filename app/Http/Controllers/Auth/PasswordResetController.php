<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PasswordResetController extends Controller
{
    /**
     * Tampilkan form pembuatan sandi baru setelah lupa password / aktivasi.
     */
    public function showNewPasswordForm()
    {
        return view('auth.new-password');
    }

    /**
     * Memproses penyimpanan sandi baru.
     */
    public function updateNewPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.required'  => 'Password baru wajib diisi.',
            'password.min'       => 'Password baru wajib berukuran minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        try {
            $user = Auth::user();
            if (!$user) {
                return redirect()->route('login')->with('error', 'Silakan masuk terlebih dahulu.');
            }

            $user->update([
                'password'             => Hash::make($request->password),
                'needs_password_reset' => false
            ]);

            // Redirect ke dashboard masing-masing aktor secara dinamis
            $route = $user->role . '.dashboard';
            
            return redirect()->route($route)->with('success', 'Sandi baru Anda berhasil disimpan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui sandi: ' . $e->getMessage());
        }
    }
}
