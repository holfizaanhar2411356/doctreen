<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use App\Models\Konsultasi;
use App\Models\Konsultan;
use App\Models\Tanaman;
use App\Models\Petani;
use App\Models\Toko;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PetaniController extends Controller
{
    /**
     * Menampilkan Halaman Dashboard Petani beserta semua datanya
     */
    public function dashboard()
    {
        // 1. Ambil data profil Petani yang sedang login berdasarkan user_id
        $petani = Petani::where('user_id', Auth::id())->first();

        // Antisipasi jika data profile petani belum terbuat di database
        if (!$petani) {
            return "Akun Anda terdaftar di tabel users, namun profile Petani belum ada di tabel petani.";
        }

        // 2. Tarik data keluhan milik petani tersebut dengan Eager Loading relasi konsultasi & konsultan
        $keluhans = Keluhan::with(['konsultasi.konsultan'])
                            ->where('id_petani', $petani->id)
                            ->orderBy('id', 'desc')
                            ->get();

        // 3. Tarik data konsultan ahli untuk pilihan dropdown di modal form pengajuan
        // Hanya konsultan dengan status 'aktif' yang ditampilkan (pending/verifikasi disembunyikan)
        $konsultans = Konsultan:
<truncated 18190 bytes>
ng,
            'ulasan' => $request->ulasan,
        ]);

        // Update related konsultasi status to selesai
        Konsultasi::where('id_keluhan', $id)->update([
            'status' => 'selesai'
        ]);

        // SINKRONISASI: Simpan juga ke tabel ulasan jika belum ada
        $konsultasi = Konsultasi::where('id_keluhan', $id)->first();
        if ($konsultasi) {
            \App\Models\Ulasan::updateOrCreate(
                ['id_konsultasi' => $konsultasi->id_konsultasi],
                [
                    'tanggal_ulasan' => now()->format('Y-m-d'),
                    'komentar'       => $request->ulasan,
                    'skor_rating'    => $request->rating,
                ]
            );
        }

        return redirect()->back()->with('success', 'Keluhan berhasil ditandai selesai dan ulasan Anda telah disimpan!');
    }

    /**
     * Memproses tanya lagi (mengembalikan status keluhan ke proses)
     */
    public function tanyaLagiKeluhan($id)
    {
        $petani = Petani::where('user_id', Auth::id())->first();
        if (!$petani) {
            return redirect()->back()->with('error', 'Profil data petani Anda tidak ditemukan.');
        }

        $keluhan = Keluhan::where('id', $id)->where('id_petani', $petani->id)->firstOrFail();

        // Kembalikan keluhan status ke 'proses'
        $keluhan->update([
            'status' => 'proses',
        ]);

        // Kembalikan related konsultasi status ke 'proses'
        Konsultasi::where('id_keluhan', $id)->update([
            'status' => 'proses'
        ]);

        return redirect()->back()->with('success', 'Pertanyaan Anda berhasil diajukan kembali. Status keluhan kini kembali dalam proses.');
    }
}
