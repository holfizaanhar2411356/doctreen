<?php
namespace App\Http\Controllers;

use App\Models\Keluhan;
use App\Models\Konsultasi;
use App\Models\Riwayat;
use Illuminate\Http\Request;

class KonsultanController extends Controller
{
    private function konsultanId()
    {
        return optional(auth()->user())->konsultan->id_konsultan ?? optional(\App\Models\Konsultan::where('user_id', auth()->id())->first())->id_konsultan;
    }

    public function dashboard()
    {
        $konsultanId = $this->konsultanId();


        // Keluhan masuk yang belum ditangani
        $keluhanBaru = Keluhan::with(['petani', 'tanaman'])
                        ->where('status', 'baru')
                        ->orderBy('tanggal_keluhan', 'desc')
                        ->get();

        // Konsultasi yang sedang ditangani konsultan ini
        $konsultasiAktif = Konsultasi::with(['keluhan.petani', 'keluhan.tanaman'])
                            ->where('id_konsultan', $konsultanId)
                            ->whereIn('status', ['menunggu', 'proses'])
                            ->get();

        // Statistik konsultan
        $totalDitangani = Konsultasi::where('id_konsultan', $konsultanId)->count();
        $selesai        = Konsultasi::where('id_konsultan', $konsultanId)->where('status','selesai')->count();

        return view('konsultan.dashboard', compact(
            'keluhanBaru', 'konsultasiAktif', 'totalDitangani', 'selesai'
        ));
    }

    public function jawabKeluhan(Request $request, $id)
    {
        $request->validate([
            'catatan_konsultasi' => 'required|string',
            'diagnosa'           => 'required|string',
            'rekomendasi'        => 'required|string',
        ]);

        $keluhan = Keluhan::findOrFail($id);

        $konsultasi = Konsultasi::create([
            'id_konsultan'       => $this->konsultanId(),
            'id_keluhan'         => $id,
            'tanggal_konsultasi' => now(),
            'catatan_konsultasi' => $request->catatan_konsultasi,
            'diagnosa'           => $request->diagnosa,
            'rekomendasi'        => $request->rekomendasi,
            'status'             => 'proses',
        ]);

        $keluhan->update(['status' => 'proses']);

        // Tambah ke riwayat
        Riwayat::create([
            'id_keluhan'     => $id,
            'tanggal_waktu'  => now(),
            'tipe_interaksi' => 'Konsultasi Online',
            'masalah'        => $keluhan->judul_keluhan,
            'tindakan'       => $request->rekomendasi,
            'nama_petani'    => $keluhan->petani->nama_petani,
            'nama_konsultan' => session('konsultan_nama'),
        ]);

        return back()->with('success', 'Jawaban berhasil dikirim!');
    }

    public function selesaikan(Request $request, $id)
    {
        $konsultasi = Konsultasi::findOrFail($id);
        $konsultasi->update(['status' => 'selesai']);
        $konsultasi->keluhan->update(['status' => 'selesai']);

        return back()->with('success', 'Konsultasi ditandai selesai.');
    }

    public function riwayat()
    {
        $riwayats = Riwayat::where('nama_konsultan', session('konsultan_nama'))
                    ->orderBy('tanggal_waktu', 'desc')
                    ->get();

        return view('konsultan.dashboard', compact('riwayats'));
    }
}