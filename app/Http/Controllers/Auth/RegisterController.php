<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\KonsultanDocument;
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

    public function showKonsultanForm()
    {
        return view('auth.register-konsultan');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama'         => 'required|string|max:255',
            'email'        => 'required|string|email|max:255|unique:users',
            'telepon'      => 'required|string|max:15',
            'password'     => 'required|string|min:8|confirmed',
            'role'         => 'required|in:petani,konsultan',
            'asal'         => 'nullable|string|max:255',
            'spesialisasi' => 'nullable|string|max:255',
            'tarif_konsultasi' => ['nullable','integer','min:0', function($attribute, $value, $fail) {
                if ($value !== null && $value % 1000 !== 0) {
                    $fail('Tarif konsultasi harus kelipatan 1000.');
                }
            }],
            'dokumen'   => 'nullable|array',
            'dokumen.*' => 'file|mimes:pdf,doc,docx,jpeg,png,jpg|max:10240',
        ]);

        try {
            DB::beginTransaction();

            $tarif = $request->tarif_konsultasi;
            if ($tarif !== null && $tarif >= 1000) {
                $tarif = (int)($tarif / 1000);
            }

            $user = User::create([
                'name'     => $request->nama,
                'email'    => $request->email,
                'telepon'  => $request->telepon,
                'password' => Hash::make($request->password),
                'role'     => $request->role,
            ]);

            if ($request->role === 'petani') {
                \App\Models\Petani::create([
                    'user_id' => $user->id,
                    'nama'    => $request->nama,
                    'daerah'  => $request->asal,
                ]);
            } elseif ($request->role === 'konsultan') {
                $uploadedDocs = [];
                if ($request->hasFile('dokumen')) {
                    foreach ($request->file('dokumen') as $file) {
                        $filePath = $file->store('konsultan_documents', 'public');
                        $uploadedDocs[] = $filePath;
                    }
                }

                \App\Models\Konsultan::create([
                    'user_id'          => $user->id,
                    'nama'             => $request->nama,
                    'keahlian'         => $request->spesialisasi,
                    'tarif_konsultasi' => $tarif,
                    'status'           => 'verifikasi',
                    'telepon'          => $request->telepon,
                    'dokumen_tipe'     => 'Portofolio/Sertifikat',
                    'dokumen_path'     => count($uploadedDocs) > 0 ? json_encode($uploadedDocs) : null,
                ]);
            }

            DB::commit();

            if ($user->role === 'petani') {
                Auth::login($user);
                return redirect()->route('petani.dashboard')->with('success', 'Registrasi sukses! Selamat datang.');
            } else {
                return redirect()->route('register')->with('success', 'Pendaftaran berhasil! Akun Konsultan Anda sukses terdaftar dengan status PENDING dan saat ini sedang menunggu verifikasi dari Admin sebelum dapat digunakan.');
            }

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', 'Pendaftaran gagal: ' . $e->getMessage());
        }
    }

    public function registerKonsultan(Request $request)
    {
        $request->merge(['role' => 'konsultan']);
        return $this->register($request);
    }
}