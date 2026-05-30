<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    /**
     * Menampilkan formulir Lupa Password
     */
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Mengirim email tautan (link) reset password
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => 'Alamat email tidak ditemukan dalam sistem kami.'
        ]);

        // 1. Generate token acak yang unik
        $token = Str::random(60);

        // 2. Simpan token ke tabel password_reset_tokens
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => bcrypt($token),
                'created_at' => now()
            ]
        );

        // 3. Bangun URL Reset Password
        $resetUrl = route('password.reset', ['token' => $token, 'email' => $request->email]);

        // 4. Kirim email (Karena MAIL_MAILER=log di .env, tulisan email akan langsung tercetak di storage/logs/laravel.log)
        Mail::raw("Halo!\n\nKami menerima permintaan atur ulang password untuk akun Anda di Doctreen.\nSilakan klik tautan di bawah ini untuk menyetel ulang password Anda:\n\n{$resetUrl}\n\nJika Anda tidak meminta atur ulang password, silakan abaikan email ini.\n\nSalam hangat,\nTim Doctreen", function($message) use ($request) {
            $message->to($request->email)
                    ->subject('Tautan Pengaturan Ulang Password - Doctreen');
        });

        return back()->with('status', 'Tautan atur ulang password telah dikirim! Silakan periksa file log Anda di storage/logs/laravel.log untuk menyalin tautan reset.');
    }
}
