<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use App\Models\Konsultasi;
use App\Models\Riwayat;
use App\Models\Konsultan;
use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    /**
     * Menyimpan atau memperbarui data konsultasi (jawaban / solusi) dari konsultan
     */
    public function simpan(Request $request)
    {
        $request->validate([
            'id_konsultasi'      => 'required|exists:konsultasi,id_konsultasi',
            'diagnosa'           => 'required|string|max:255',
            'rekomendasi'        => 'required|string',
            'catatan_konsultasi' => 'nullable|string',
        ]);

        $konsultasi = Konsultasi::findOrFail($request->id_konsultasi);
        $konsultan = Konsultan::find($konsultasi->id_konsultan);
        $keluhan = $konsultasi->keluhan;

        $konsultasi->update([
            'diagnosa'           => $request->diagnosa,
            'rekomendasi'        => $request->rekomendasi,
            'catatan_konsultasi' => $request->catatan_konsultasi,
            'tanggal_konsultasi' => now()->format('Y-m-d'),
            'status'             => 'proses',
        ]);

        if ($keluhan) {
            $keluhan->update(['status' => 'proses']);

            // Buat atau perbarui catatan di tabel riwayat
            Riwayat::create([
                'id_keluhan'     => $keluhan->id,
                'tanggal_waktu'  => now(),
                'tipe_interaksi' => 'Konsultasi Online',
                'masalah'        => $keluhan->judul_keluhan,
                'tindakan'       => $request->rekomendasi,
                'nama_petani'    => optional($keluhan->petani)->nama ?? 'Petani',
                'nama_konsultan' => $konsultan ? $konsultan->nama : 'Konsultan Ahli',
            ]);
        }

        if ($request->ajax() || $request->wantsJson()) {
            session()->flash('success', 'Solusi konsultasi berhasil dikirim!');
            return response()->json(['success' => true, 'message' => 'Solusi konsultasi berhasil dikirim!']);
        }

        return redirect()->back()->with('success', 'Solusi konsultasi berhasil dikirim!');
    }
}
