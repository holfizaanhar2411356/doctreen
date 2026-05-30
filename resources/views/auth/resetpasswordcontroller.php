<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class ResetPasswordController extends Controller
{
    /**
     * Menampilkan form untuk memasukkan password baru
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
    /**
     * Memproses penggantian password dengan password baru
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.min' => 'Password baru harus memiliki panjang minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.'
        ]);
        // 1. Ambil data token dari tabel database
        $record = DB::table('password_reset_tokens')->where('email', $request->email)->first();
        // 2. Validasi kecocokan token
        if (!$record || !Hash::check($request->token, $record->token)) {
            return back()->withErrors(['email' => 'Token reset password tidak valid atau telah kedaluwarsa.']);
        }
        // 3. Update password pengguna di tabel users
        $user = User::where('email', $request->email)->first();
        $user->update([
            'password' => Hash::make($request->password)
        ]);
        // 4. Hapus token yang sudah terpakai
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        // 5. Kembalikan ke halaman login dengan pesan sukses hijau
        return redirect()->route('login')->with('success_password_reset', 'Password Anda berhasil diperbarui! Silakan masuk menggunakan password baru Anda.');
    }
}
