<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        // Validasi input dari form
        $credentials = $request->validate([
            'identifier' => 'required',
            'password' => 'required',
            'role' => 'required|in:petani,konsultan'
        ]);

        // Cek apakah identifier adalah email atau nomor telepon (username)
        $loginType = filter_var($request->identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'telepon';

        // Logika login (Asumsi menggunakan satu tabel User dengan kolom 'role')
        if (Auth::attempt([$loginType => $request->identifier, 'password' => $request->password, 'role' => $request->role])) {
            $request->session()->regenerate();

            // Redirect sesuai peran masing-masing
            if ($request->role === 'petani') {
                return redirect()->intended('/petani/dashboard');
            }
            return redirect()->intended('/konsultan/dashboard');
        }

        // Jika gagal, kembali ke halaman login dengan pesan error
        return back()->with('error', 'Nomor telepon/email atau password salah untuk akun ' . ucfirst($request->role));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}