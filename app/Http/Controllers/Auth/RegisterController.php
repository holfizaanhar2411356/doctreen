<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Petani;
use App\Models\Konsultan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // 1. Validasi Input (WAJIB menyertakan field tambahan agar terbaca)
        $request->validate([
            'nama'         => 'required|string|max:255',
            'email'        => 'required|string|email|max:255|unique:users',
            'telepon'      => 'required|string|max:15',
            'password'     => 'required|string|min:8|confirmed',
            'role'         => 'required|in:petani,konsultan',
            'asal'         => 'nullable|string|max:255',         // Tambahkan ini
            'spesialisasi' => 'nullable|string|max:255',         // Tambahkan ini
            'tarif_konsultasi' => ['nullable','integer','min:0', function($attribute, $value, $fail) {
                if ($value !== null && $value % 1000 !== 0) {
                    $fail('Tarif konsultasi harus kelipatan 1000.');
                }
            }],

        ]);

        try {
            DB::beginTransaction();

            // 2. Simpan ke tabel USERS
            $user = User::create([
                'name'     => $request->nama,
                'email'    => $request->email,
                'telepon'  => $request->telepon,
                'password' => Hash::make($request->password),
                'role'     => $request->role,
            ]);

            // 3. Simpan ke tabel Profil berdasarkan Role
            if ($request->role === 'petani') {
                Petani::create([
                    'user_id' => $user->id,
                    'nama'    => $request->nama,
                    'daerah'  => $request->asal, // Cocokkan dengan name="asal" di HTML
                ]);
            } else {
                Konsultan::create([
                    'user_id'          => $user->id,
                    'nama'             => $request->nama,
                    'keahlian'         => $request->spesialisasi, // Cocokkan dengan name="spesialisasi"
                    'tarif_konsultasi' => $request->tarif_konsultasi ?? 0, // input dalam "ribu"
                    'status'           => 'verifikasi',
                ]);

            }

            DB::commit();

            Auth::login($user);

            if ($user->role === 'petani') {
                return redirect()->route('petani.dashboard');
            } else {
                return redirect()->route('konsultan.dashboard');
            }

        } catch (\Exception $e) {
            DB::rollback();
            // Debug: Jika masih tidak tersimpan, hapus komentar dd dibawah untuk lihat errornya
            // dd($e->getMessage()); 
            return back()->withInput()->with('error', 'Pendaftaran gagal: ' . $e->getMessage());
        }
    }
}