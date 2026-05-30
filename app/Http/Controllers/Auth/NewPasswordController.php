<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NewPasswordController extends Controller
{
    public function showForm()
    {
        return view('auth.new-password');
    }

    public function update(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();
        $user->update([
            'password' => Hash::make($request->password),
            'needs_password_reset' => false,
        ]);

        if ($user->role === 'petani') {
            return redirect()->route('petani.dashboard')->with('success', 'Kata sandi default Anda berhasil diperbarui!');
        } elseif ($user->role === 'konsultan') {
            return redirect()->route('konsultan.dashboard')->with('success', 'Kata sandi default Anda berhasil diperbarui!');
        }

        return redirect('/')->with('success', 'Kata sandi berhasil diperbarui!');
    }
}
