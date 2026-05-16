<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use App\Models\Konsultasi;
use App\Models\Konsultan;
use App\Models\Produk;
use App\Models\Riwayat;
use App\Models\Ulasan;
use App\Models\Pesanan;
use App\Models\Tanaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetaniController extends Controller
{
    private function petaniId()
    {
        $user = auth()->user();
        if (!$user) {
            return null;
        }

        $petani = optional($user)->petani;
        if ($petani && isset($petani->id)) {
            return $petani->id;
        }

        $petani2 = \App\Models\Petani::where('user_id', $user->id)->first();
        return $petani2?->id;
    }

    public function dashboard()
    {
        $petaniId = $this->petaniId();

        $keluhans   = Keluhan::with(['konsultasi.konsultan'])
                        ->where('id_petani', $petaniId)
                        ->orderBy('tanggal_keluhan', 'desc')
                        ->take(5)
                        ->get();

        $konsultans = Konsultan::where('status', 'aktif')
                        ->take(4)
                        ->get();

        $totalKonsultasi = Keluhan::where('id_petani', $petaniId)->count();
        $terjawab        = Keluhan::where('id_petani', $petaniId)->where('status', 'selesai')->count();
        $pesananAktif    = Pesanan::where('id_petani', $petaniId)->where('status_bayar', 'menunggu')->count();

        $tanaman = Tanaman::all();

        return view('petani.dashboard', compact(
            'keluhans', 'konsultans', 'totalKonsultasi',
            'terjawab', 'pesananAktif', 'tanaman'
        ));
    }

    public function ajukanKeluhan(Request $request)
    {
        // PERBAIKAN: Menambahkan nama kolom eksplisit (,id) pada aturan exists
        $request->validate([
            'judul_keluhan' => 'required|string|max:255',
            'isi_keluhan'   => 'required|string',
            'id_tanaman'    => 'nullable|exists:tanaman,id', 
            'id_konsultan'  => 'required|exists:konsultan,id', 
        ]);

        $petaniId = $this->petaniId();
        if (!$petaniId) {
            return back()->with('error', 'Data petani tidak ditemukan. Silakan logout/login ulang.');
        }

        $data = [
            'id_petani'      => $petaniId,
            'judul_keluhan'  => $request->judul_keluhan,
            'isi_keluhan'    => $request->isi_keluhan,
            'id_tanaman'     => $request->id_tanaman,
            'tanggal_keluhan'=> now()->toDateString(),
            'status'         => 'baru',
        ];

        if ($request->hasFile('foto_kendala')) {
            $path = $request->file('foto_kendala')->store('keluhan', 'public');
            $data['foto_kendala'] = $path;
        }

        $keluhan = Keluhan::create($data);

        // Buat konsultasi awal agar konsultan pilihan petani tersambung
        $konsultasiData = [
            'id_konsultan'       => $request->id_konsultan,
            'id_keluhan'         => $keluhan->id, // Pastikan PK di tabel keluhan adalah id
            'tanggal_konsultasi' => now()->toDateString(),
            'catatan_konsultasi' => null,
            'diagnosa'          => null,
            'rekomendasi'       => null,
            'status'            => 'menunggu',
        ];

        // PERBAIKAN CADANGAN: Jika PK di tabel keluhan Anda adalah id_keluhan, gunakan baris bawah ini:
        // 'id_keluhan' => $keluhan->id_keluhan ?? $keluhan->id,

        Konsultasi::create($konsultasiData);

        return back()->with('success', 'Keluhan berhasil diajukan!');
    }

    public function produk()
    {
        $produks = Produk::with('toko')->where('stok', '>', 0)->get();
        return view('petani.dashboard', compact('produks'));
    }

    public function beli(Request $request)
    {
        // PERBAIKAN: Menambahkan nama kolom eksplisit (,id) pada aturan exists
        $request->validate([
            'id_produk'    => 'required|exists:produk,id',
            'metode_kirim' => 'required|string',
        ]);

        $produk = Produk::findOrFail($request->id_produk);

        Pesanan::create([
            'id_petani'    => $this->petaniId(),
            'tanggal_pesan'=> now(),
            'total_harga'  => $produk->harga,
            'metode_kirim' => $request->metode_kirim,
            'status_bayar' => 'menunggu',
        ]);

        return back()->with('success', 'Pesanan berhasil dibuat!');
    }

    public function riwayat()
    {
        // PERBAIKAN: Menyelaraskan join agar menggunakan primary key 'id' jika 'id_keluhan' tidak ditemukan
        $riwayats = Riwayat::join('keluhan', 'riwayat.id_keluhan', '=', 'keluhan.id')
                    ->where('keluhan.id_petani', $this->this->petaniId())
                    ->orderBy('riwayat.tanggal_waktu', 'desc')
                    ->get(['riwayat.*']);

        return view('petani.dashboard', compact('riwayats'));
    }

    public function beriUlasan(Request $request)
    {
        // PERBAIKAN: Menambahkan nama kolom eksplisit (,id) pada aturan exists
        $request->validate([
            'id_konsultasi' => 'required|exists:konsultasi,id',
            'skor_rating'   => 'required|integer|between:1,5',
            'komentar'      => 'nullable|string',
        ]);

        Ulasan::create([
            'id_konsultasi' => $request->id_konsultasi,
            'tanggal_ulasan'=> now()->toDateString(),
            'komentar'      => $request->komentar,
            'skor_rating'   => $request->skor_rating,
        ]);

        return back()->with('success', 'Ulasan berhasil dikirim!');
    }
}