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
     
<truncated 22221 bytes>
_path && Storage::disk('public')->exists($video->file_path)) {
                Storage::disk('public')->delete($video->file_path);
            }
            \Illuminate\Support\Facades\DB::table('video_tanaman')->where('id', $id)->delete();
            return back()->with('success', 'Video panduan berhasil dihapus.');
        }
        return back()->with('error', 'Video tidak ditemukan.');
    }

    public function updateVideo(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|file|mimes:mp4,mov,avi,mkv|max:51200',
        ]);
        
        $video = \Illuminate\Support\Facades\DB::table('video_tanaman')->where('id', $id)->first();
        if (!$video) {
            return back()->with('error', 'Video tidak ditemukan.');
        }
        
        $pathVideo = $video->file_path;
        if ($request->hasFile('video_file')) {
            if ($pathVideo && Storage::disk('public')->exists($pathVideo)) {
                Storage::disk('public')->delete($pathVideo);
            }
            $pathVideo = $request->file('video_file')->store('videos', 'public');
            $urlVideo = null;
        } else {
            $urlVideo = $request->filled('video_url') ? $request->video_url : $video->url;
        }
        
        \Illuminate\Support\Facades\DB::table('video_tanaman')->where('id', $id)->update([
            'judul' => $request->judul,
            'url' => $urlVideo,
            'file_path' => $pathVideo,
            'updated_at' => now(),
        ]);
        
        return back()->with('success', 'Video panduan berhasil diperbarui!');
    }
}
