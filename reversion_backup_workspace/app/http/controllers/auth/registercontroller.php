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
            'foto_profil'      => 'nullable|file|mimes:jpeg,png,jpg,webp,pdf|max:51200',
       
<truncated 5492 bytes>
:                     if ($file && $file->isValid()) {
                        $portfolioPaths[] = $file->store('konsultan_documents', 'public');
                    }
                }
            }

            // 1. Simpan ke tabel USERS
            $user = User::create([
                'name'        => $request->nama,
                'email'       => $request->email,
                'telepon'     => $request->telepon,
                'password'    => Hash::make($request->password),
                'role'        => 'konsultan',
            ]);

            // 2. Simpan ke tabel Profil KONSULTAN
            // dokumen_path menyimpan JSON array dari semua path file portofolio
            Konsultan::create([
                'user_id'          => $user->id,
                'nama'             => $request->nama,
                'keahlian'         => $request->spesialisasi,
                'tarif_konsultasi' => $request->tarif_konsultasi,
                'status'           => 'verifikasi', // Default status Pending
                'dokumen_path'     => !empty($portfolioPaths) ? json_encode($portfolioPaths) : null,
                'dokumen_tipe'     => !empty($portfolioPaths) ? 'Portofolio/Sertifikat' : null,
            ]);

            DB::commit();

            // Kembalikan ke halaman pendaftaran dengan status pending (sukses warna hijau #27500A)
            return redirect()->route('register.konsultan')->with('status_pending', 'Pendaftaran berhasil! Akun Anda sukses terdaftar dengan status PENDING dan saat ini sedang menunggu verifikasi dari Admin sebelum dapat digunakan.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', 'Pendaftaran gagal: ' . $e->getMessage());
        }
    }
}
