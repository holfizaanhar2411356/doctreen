<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use App\Models\Konsultasi;
use App\Models\Riwayat;
use App\Models\Konsultan;
use App\Models\Tanaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KonsultanController extends Controller
{
    /**
     * Helper untuk mengambil ID Konsultan yang sedang login
     */
    private function konsultanId()
    {
        // Disesuaikan dengan primary key tabel 'konsultan' yaitu 'id'
        $konsultan = Konsultan::where('user_id', auth()->id())->first();
        return $konsultan ? $konsultan->id : null;
    }

    public function dashboard()
    {
        $konsultanId = $this->konsultanId();

        if (!$konsultanId) {
            return "Profil akun konsultan Anda tidak ditemukan di database.";
        }

        $konsultan = Konsultan::findOrFail($konsultanId);

        // Keluhan masuk yang belum ditangani (status baru)
        $keluhanBaru = Keluhan::with(['petani', 'tanaman'])
                        ->where('status', 'baru')
                        ->orderBy('tanggal_keluhan', 'desc')
                        ->get();

        // Konsultasi yang sedang aktif ditangani konsultan ini
        $konsultasiAktif = Konsultasi::with(['keluhan.petani', 'keluhan.tanaman'])
                            ->where('id_konsultan', $konsultanId)
                            ->whereIn('status', ['menunggu', 'pro
<truncated 9080 bytes>
        'foto_profil' => $fotoPath,
            ]);
        }

        return redirect()->back()->with('success', 'Profil data diri Anda berhasil diperbarui!');
    }

    public function hapusRiwayat($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);
        $idKeluhan = $konsultasi->id_keluhan;

        // Hapus konsultasi terlebih dahulu secara aman
        $konsultasi->delete();

        // Hapus keluhan terkait secara permanen
        if ($idKeluhan) {
            Keluhan::where('id', $idKeluhan)->delete();
        }

        if (request()->ajax() || request()->wantsJson()) {
            session()->flash('success', 'Riwayat sesi konsultasi berhasil dihapus secara permanen!');
            return response()->json(['success' => true, 'message' => 'Riwayat sesi konsultasi berhasil dihapus secara permanen!']);
        }

        return redirect()->back()->with('success', 'Riwayat sesi konsultasi berhasil dihapus secara permanen!');
    }

    /**
     * Memproses penghapusan keluhan masuk oleh konsultan
     */
    public function hapusKeluhan($id)
    {
        $keluhan = Keluhan::findOrFail($id);
        
        // Hapus konsultasi terkait terlebih dahulu secara aman
        Konsultasi::where('id_keluhan', $id)->delete();
        
        // Hapus keluhan
        $keluhan->delete();

        if (request()->ajax() || request()->wantsJson()) {
            session()->flash('success', 'Keluhan masuk berhasil dihapus secara permanen!');
            return response()->json(['success' => true, 'message' => 'Keluhan masuk berhasil dihapus secara permanen!']);
        }

        return redirect()->back()->with('success', 'Keluhan masuk berhasil dihapus secara permanen!');
    }
}
