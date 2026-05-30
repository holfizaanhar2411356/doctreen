<?php

namespace App\Http\Controllers;

use App\Models\Tanaman;
use App\Models\VideoTanaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TanamanController extends Controller
{
    /**
     * Tampilkan daftar semua tanaman (untuk konsultan & admin)
     */
    public function index()
    {
        try {
            $tanamanList = Tanaman::with(['videos', 'addedBy'])
                            ->orderBy('nama_tanaman')
                            ->get();

            return view('tanaman.index', compact('tanamanList'));
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memuat daftar tanaman: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tanaman'        => 'required|string|max:255',
            'nama_latin'          => 'nullable|string|max:255',
            'jenis_tanaman'       => 'nullable|string|max:255',
            'deskripsi'           => 'nullable|string',
            'foto_tanaman'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'metode_perawatan'    => 'nullable|string',
            'protokol_pengobatan' => 'nullable|string',
            'ancaman_hama'        => 'nullable',
            'ancaman_1'           => 'nullable|string',
            'ancaman_2'           => 'nullable|string',
        ]);

        try {
            $data = $request->only([
                'nama_tanaman', 'nama_latin', 'jenis_tanaman',
                'deskripsi', 'metode_perawatan', 'protokol_pengobatan',
            ]);
            $user = Auth::user();
            $data['added_by'] = ($user->role === 'admin' ? 'Admin ' : 'Konsultan ') . $user->name;

            if ($request->hasFile('foto_tanaman')) {
                $data['foto_tanaman'] = $request->file('foto_tanaman')
                                                ->store('tanaman', 'public');
            }

            // Parse ancaman_hama
            $ancaman = [];
            if ($request->filled('ancaman_1')) $ancaman[] = $request->ancaman_1;
            if ($request->filled('ancaman_2')) $ancaman[] = $request->ancaman_2;
            if ($request->filled('ancaman_hama')) {
                $hama = $request->ancaman_hama;
                if (is_array($hama)) {
                    $ancaman = array_merge($ancaman, $hama);
                } else {
                    $decoded = json_decode($hama, true);
                    if (is_array($decoded)) {
                        $ancaman = array_merge($ancaman, $decoded);
                    } else {
                        $ancaman[] = $hama;
                    }
                }
            }
            $data['ancaman_hama'] = array_values(array_filter($ancaman));

            Tanaman::create($data);

            return back()->with('success', 'Tanaman berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambah tanaman: ' . $e->getMessage());
        }
    }

    /**
     * Update data tanaman yang sudah ada
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_tanaman'        => 'required|string|max:255',
            'nama_latin'          => 'nullable|string|max:255',
            'jenis_tanaman'       => 'nullable|string|max:255',
            'deskripsi'           => 'nullable|string',
            'foto_tanaman'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'metode_perawatan'    => 'nullable|string',
            'protokol_pengobatan' => 'nullable|string',
            'ancaman_hama'        => 'nullable',
            'ancaman_1'           => 'nullable|string',
            'ancaman_2'           => 'nullable|string',
        ]);

        try {
            $tanaman = Tanaman::findOrFail($id);

            $data = $request->only([
                'nama_tanaman', 'nama_latin', 'jenis_tanaman',
                'deskripsi', 'metode_perawatan', 'protokol_pengobatan',
            ]);

            if ($request->hasFile('foto_tanaman')) {
                // Hapus foto lama dari storage
                if ($tanaman->foto_tanaman && Storage::disk('public')->exists($tanaman->foto_tanaman)) {
                    Storage::disk('public')->delete($tanaman->foto_tanaman);
                }
                $data['foto_tanaman'] = $request->file('foto_tanaman')
                                                ->store('tanaman', 'public');
            }

            // Parse ancaman_hama
            $ancaman = [];
            if ($request->filled('ancaman_1')) $ancaman[] = $request->ancaman_1;
            if ($request->filled('ancaman_2')) $ancaman[] = $request->ancaman_2;
            if ($request->filled('ancaman_hama')) {
                $hama = $request->ancaman_hama;
                if (is_array($hama)) {
                    $ancaman = array_merge($ancaman, $hama);
                } else {
                    $decoded = json_decode($hama, true);
                    if (is_array($decoded)) {
                        $ancaman = array_merge($ancaman, $decoded);
                    } else {
                        $ancaman[] = $hama;
                    }
                }
            }
            $data['ancaman_hama'] = array_values(array_filter($ancaman));

            $tanaman->update($data);

            return back()->with('success', 'Data tanaman berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui tanaman: ' . $e->getMessage());
        }
    }

    /**
     * Hapus tanaman beserta fotonya dan semua video terkait
     */
    public function destroy($id)
    {
        try {
            $tanaman = Tanaman::with('videos')->findOrFail($id);

            // Hapus semua video file lokal dulu
            foreach ($tanaman->videos as $video) {
                if ($video->file_path && Storage::disk('public')->exists($video->file_path)) {
                    Storage::disk('public')->delete($video->file_path);
                }
            }

            // Hapus foto tanaman dari storage
            if ($tanaman->foto_tanaman && Storage::disk('public')->exists($tanaman->foto_tanaman)) {
                Storage::disk('public')->delete($tanaman->foto_tanaman);
            }

            // Cascade delete via onDelete('cascade') di migration
            $tanaman->delete();

            return back()->with('success', 'Tanaman berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus tanaman: ' . $e->getMessage());
        }
    }

    // =========================================================
    // VIDEO MANAGEMENT
    // =========================================================

    public function storeVideo(Request $request, $id)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'tipe_video' => 'required|in:youtube,lokal',
            'url'        => 'nullable|url',
            'video_url'  => 'nullable|url',
            'file_video' => 'nullable|file|mimes:mp4,webm,ogg|max:102400',
            'video_file' => 'nullable|file|mimes:mp4,webm,ogg|max:102400',
        ]);

        try {
            $tanaman = Tanaman::findOrFail($id);

            $data = [
                'id_tanaman' => $tanaman->id,
                'judul'      => $request->judul,
                'uploader'   => Auth::user()->name,
            ];

            if ($request->tipe_video === 'youtube') {
                $data['url'] = $request->video_url ?? $request->url;
            } else {
                $file = $request->file('video_file') ?? $request->file('file_video');
                if ($file) {
                    $data['file_path'] = $file->store('videos/tanaman', 'public');
                }
            }

            VideoTanaman::create($data);

            return back()->with('success', 'Video berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambah video: ' . $e->getMessage());
        }
    }

    /**
     * Update metadata video (hanya judul & URL/file)
     */
    public function updateVideo(Request $request, $id)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'tipe_video' => 'required|in:youtube,lokal',
            'url'        => 'nullable|url',
            'video_url'  => 'nullable|url',
            'file_video' => 'nullable|file|mimes:mp4,webm,ogg|max:102400',
            'video_file' => 'nullable|file|mimes:mp4,webm,ogg|max:102400',
        ]);

        try {
            $video = VideoTanaman::findOrFail($id);

            $video->judul = $request->judul;

            if ($request->tipe_video === 'youtube') {
                $video->url       = $request->video_url ?? $request->url;
                $video->file_path = null;
            } else {
                $file = $request->file('video_file') ?? $request->file('file_video');
                if ($file) {
                    // Hapus file lama
                    if ($video->file_path && Storage::disk('public')->exists($video->file_path)) {
                        Storage::disk('public')->delete($video->file_path);
                    }
                    $video->url       = null;
                    $video->file_path = $file->store('videos/tanaman', 'public');
                }
            }

            $video->save();

            return back()->with('success', 'Video berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui video: ' . $e->getMessage());
        }
    }

    /**
     * Hapus video dari database dan storage
     */
    public function destroyVideo($id)
    {
        try {
            $video = VideoTanaman::findOrFail($id);

            if ($video->file_path && Storage::disk('public')->exists($video->file_path)) {
                Storage::disk('public')->delete($video->file_path);
            }

            $video->delete();

            return back()->with('success', 'Video berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus video: ' . $e->getMessage());
        }
    }
}
