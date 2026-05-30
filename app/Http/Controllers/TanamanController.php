<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use App\Models\Konsultasi;
use App\Models\Konsultan;
use App\Models\Tanaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TanamanController extends Controller
{
    /**
     * Dashboard utama konsultan.
     * Route: GET /konsultan/dashboard  (name: konsultan.dashboard)
     */
    public function index()
    {
        // Ambil profil konsultan yang sedang login via user_id
        $konsultan = Konsultan::where('user_id', auth()->id())->first();

        if (!$konsultan) {
            abort(403, 'Profil konsultan tidak ditemukan. Hubungi administrator.');
        }

        // Keluhan berstatus 'baru' — belum dijawab siapapun
        // Eager load petani, tanaman, dan konsultasi agar tidak N+1
        $keluhanBaru = Keluhan::with(['petani', 'tanaman', 'konsultasi'])
            ->where('status', 'baru')
            ->orderBy('tanggal_keluhan', 'desc')
            ->get();

        // Konsultasi aktif milik konsultan ini (menunggu atau proses)
        $konsultasiAktif = Konsultasi::with(['keluhan.petani'])
            ->where('id_konsultan', $konsultan->id)
            ->whereIn('status', ['menunggu', 'proses'])
            ->get();

        // Statistik ringkasan
        $totalDitangani = Konsultasi::where('id_konsultan', $konsultan->id)->count();
        $selesai        = Konsultasi::where('id_konsultan', $konsultan->id)
                            ->where('status', 'selesai')
                            ->count();

        // Semua keluhan yang sudah ditugaskan ke konsultan ini (tab Keluhan Masuk)
        $semuaKeluhan = Keluhan::whereHas('konsultasi', fn($q) =>
                $q->where('id_konsultan', $konsultan->id)
            )
            ->with(['petani', 'tanaman', 'konsultasi'])
            ->latest('tanggal_keluhan')
            ->get();

        // Riwayat semua konsultasi konsultan ini (tab Riwayat)
        $riwayatKonsultasi = Konsultasi::where('id_konsultan', $konsultan->id)
            ->with(['keluhan.petani'])
            ->latest('tanggal_konsultasi')
            ->get();

        // Data ensiklopedia tanaman
        $daftarTanaman = Tanaman::latest()->get();

        return view('konsultan.dashboard', compact(
            'konsultan',
            'keluhanBaru',
            'konsultasiAktif',
            'totalDitangani',
            'selesai',
            'semuaKeluhan',
            'riwayatKonsultasi',
            'daftarTanaman'
        ));
    }

    /**
     * Simpan komoditas tanaman baru.
     * Route: POST /tanaman  (name: tanaman.store)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_tanaman'        => 'required|string|max:255',
            'nama_latin'          => 'nullable|string|max:255',
            'jenis_tanaman'       => 'nullable|string|max:255',
            'deskripsi'           => 'nullable|string',
            'foto_tanaman'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'metode_perawatan'    => 'nullable|string',
            'protokol_pengobatan' => 'nullable|string',
            'ancaman_1'           => 'nullable|string|max:255',
            'ancaman_2'           => 'nullable|string|max:255',
            'ancaman_3'           => 'nullable|string|max:255',
        ]);

        $ancamanHama = array_values(array_filter([
            $request->ancaman_1,
            $request->ancaman_2,
            $request->ancaman_3,
        ]));

        $pathFoto = null;
        if ($request->hasFile('foto_tanaman')) {
            $pathFoto = $request->file('foto_tanaman')->store('tanaman', 'public');
        }

        Tanaman::create([
            'nama_tanaman'        => $request->nama_tanaman,
            'nama_latin'          => $request->nama_latin,
            'jenis_tanaman'       => $request->jenis_tanaman,
            'deskripsi'           => $request->deskripsi,
            'foto_tanaman'        => $pathFoto,
            'metode_perawatan'    => $request->metode_perawatan,
            'protokol_pengobatan' => $request->protokol_pengobatan,
            'ancaman_hama'        => $ancamanHama, // di-cast ke JSON oleh Model
        ]);

        return redirect()->back()->with('success', 'Komoditas baru berhasil ditambahkan ke pustaka!');
    }

    /**
     * Perbarui data komoditas yang sudah ada.
     * Route: PUT/PATCH /tanaman/{id}  (name: tanaman.update)
     */
    public function update(Request $request, $id)
    {
        $tanaman = Tanaman::findOrFail($id);

        $request->validate([
            'nama_tanaman'        => 'required|string|max:255',
            'nama_latin'          => 'nullable|string|max:255',
            'jenis_tanaman'       => 'nullable|string|max:255',
            'deskripsi'           => 'nullable|string',
            'foto_tanaman'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'metode_perawatan'    => 'nullable|string',
            'protokol_pengobatan' => 'nullable|string',
            'ancaman_1'           => 'nullable|string|max:255',
            'ancaman_2'           => 'nullable|string|max:255',
            'ancaman_3'           => 'nullable|string|max:255',
        ]);

        $ancamanHama = array_values(array_filter([
            $request->ancaman_1,
            $request->ancaman_2,
            $request->ancaman_3,
        ]));

        $pathFoto = $tanaman->foto_tanaman;
        if ($request->hasFile('foto_tanaman')) {
            if ($pathFoto && Storage::disk('public')->exists($pathFoto)) {
                Storage::disk('public')->delete($pathFoto);
            }
            $pathFoto = $request->file('foto_tanaman')->store('tanaman', 'public');
        }

        $tanaman->update([
            'nama_tanaman'        => $request->nama_tanaman,
            'nama_latin'          => $request->nama_latin,
            'jenis_tanaman'       => $request->jenis_tanaman,
            'deskripsi'           => $request->deskripsi,
            'foto_tanaman'        => $pathFoto,
            'metode_perawatan'    => $request->metode_perawatan,
            'protokol_pengobatan' => $request->protokol_pengobatan,
            'ancaman_hama'        => $ancamanHama,
        ]);

        return redirect()->back()->with('success', 'Informasi komoditas berhasil diperbarui!');
    }

    /**
     * Hapus komoditas tanaman.
     * Route: DELETE /tanaman/{id}  (name: tanaman.destroy)
     */
    public function destroy($id)
    {
        $tanaman = Tanaman::findOrFail($id);

        if ($tanaman->foto_tanaman && Storage::disk('public')->exists($tanaman->foto_tanaman)) {
            Storage::disk('public')->delete($tanaman->foto_tanaman);
        }

        $tanaman->delete();

        return redirect()->back()->with('success', 'Komoditas berhasil dihapus dari pustaka.');
    }
}