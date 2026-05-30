<?php
namespace App\Http\Controllers;

use App\Models\Keluhan;
use App\Models\Riwayat;
use App\Models\User;
use App\Models\Tanaman;
use App\Models\VideoTanaman;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class KonsultanController extends Controller
{
    private function konsultanId()
    {
        return auth()->id();
    }

    public function dashboard()
    {
        $user = auth()->user();
        $konsultan = $user->konsultan;

        if (!$konsultan) {
            return redirect()->route('home')->with('error', 'Profil konsultan tidak ditemukan.');
        }

        $konsultanId = $konsultan->id;

        // Keluhan masuk yang ditugaskan ke konsultan ini (status 'menunggu' di pivot konsultasi)
        $keluhanBaru = Keluhan::whereHas('konsultasi', function($q) use ($konsultanId) {
                            $q->where('id_konsultan', $konsultanId)->where('status', 'menunggu');
                        })
                        ->with(['petani', 'tanaman'])
                        ->orderBy('updated_at', 'desc')
                        ->get();

        // Sesi konsultasi aktif yang sedang berjalan (status 'proses' di pivot konsultasi)
        $konsultasiAktif = Keluhan::whereHas('konsultasi', function($q) use ($konsultanId) {
                            $q->where('id_konsultan', $konsultanId)->where('status', 'proses');
                        })
                        ->with(['petani', 'tanaman'])
                        ->orderBy('updated_at', 'desc')
                        ->get();

        // Statistik
        $totalDitangani = \App\Models\Konsultasi::where('id_konsultan', $konsultanId)->count();
        $selesai        = \App\Models\Konsultasi::where('id_konsultan', $konsultanId)->where('status', 'selesai')->count();

        // Reviews / ulasan dari petani (rating dan ulasan disimpan di keluhan)
        $ulasanTerbaru = Keluhan::whereHas('konsultasi', function($q) use ($konsultanId) {
                            $q->where('id_konsultan', $konsultanId)->where('status', 'selesai');
                        })
                        ->whereNotNull('ulasan')
                        ->with('petani')
                        ->orderBy('updated_at', 'desc')
                        ->take(5)
                        ->get();

        $ratings = Keluhan::whereHas('konsultasi', function($q) use ($konsultanId) {
                            $q->where('id_konsultan', $konsultanId)->where('status', 'selesai');
                        })
                        ->whereNotNull('rating')
                        ->pluck('rating');

        $ratingRataRata = $ratings->count() > 0 ? round($ratings->average(), 1) : 0;

        // Pendapatan konsultan (selesai * tarif_konsultasi)
        $tarif = $konsultan->tarif_konsultasi ?? 0;
        $pendapatanKonsultasi = $selesai * $tarif;

        // Ensiklopedia Tanaman
        $tanamans = Tanaman::with('videos')->orderBy('nama_tanaman')->get();

        // Riwayat Sesi Konsultasi Saya
        $riwayatKonsultasi = \App\Models\Konsultasi::where('id_konsultan', $konsultanId)
                                ->with(['keluhan.petani', 'keluhan.tanaman'])
                                ->orderBy('id_konsultasi', 'desc')
                                ->get();

        return view('konsultan.dashboard', compact(
            'keluhanBaru', 'konsultasiAktif', 'totalDitangani', 'selesai', 'konsultan', 
            'ulasanTerbaru', 'ratingRataRata', 'pendapatanKonsultasi', 'tanamans', 'riwayatKonsultasi'
        ));
    }

    public function jawabKeluhan(Request $request, $id)
    {
        $request->validate([
            'catatan_konsultasi' => 'nullable|string',
            'diagnosa'           => 'required|string',
            'rekomendasi'        => 'required|string',
        ]);

        try {
            $keluhan = Keluhan::with('konsultasi')->findOrFail($id);
            $konsultasi = $keluhan->konsultasi;

            if ($konsultasi) {
                $konsultasi->update([
                    'diagnosa'           => $request->diagnosa,
                    'rekomendasi'        => $request->rekomendasi,
                    'catatan_konsultasi' => $request->catatan_konsultasi,
                    'status'             => 'selesai',
                ]);
            }

            $keluhan->update([
                'status'           => 'selesai',
                'last_resolved_at' => now(),
            ]);

            // Tambah ke riwayat
            Riwayat::create([
                'id_keluhan'     => $id,
                'tanggal_waktu'  => now(),
                'tipe_interaksi' => 'Konsultasi Online',
                'masalah'        => $keluhan->judul_keluhan,
                'tindakan'       => $request->rekomendasi,
                'nama_petani'    => optional($keluhan->petani)->nama ?? 'Petani',
                'nama_konsultan' => $konsultasi && $konsultasi->konsultan ? $konsultasi->konsultan->nama : auth()->user()->name,
            ]);

            return back()->with('success', 'Solusi medis berhasil dikirim dan konsultasi diselesaikan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses solusi medis: ' . $e->getMessage());
        }
    }

    public function selesaikan(Request $request, $id)
    {
        try {
            $keluhan = Keluhan::with('konsultasi')->findOrFail($id);
            $keluhan->update([
                'status'           => 'selesai',
                'last_resolved_at' => now(),
            ]);

            if ($keluhan->konsultasi) {
                $keluhan->konsultasi->update(['status' => 'selesai']);
            }

            return back()->with('success', 'Konsultasi ditandai selesai.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyelesaikan konsultasi: ' . $e->getMessage());
        }
    }

    public function riwayat()
    {
        return redirect()->route('konsultan.dashboard')->with('tab', 'riwayat');
    }

    public function show($id)
    {
        try {
            $keluhan = Keluhan::with(['petani', 'tanaman'])->findOrFail($id);
            return view('konsultan.detail', compact('keluhan'));
        } catch (\Exception $e) {
            return redirect()->route('konsultan.dashboard')->with('error', 'Keluhan tidak ditemukan.');
        }
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'nama'             => 'required|string|max:255',
            'keahlian'         => 'nullable|string|max:255',
            'tarif_konsultasi' => 'nullable|numeric|min:0',
            'alamat'           => 'nullable|string',
            'telepon'          => 'nullable|string|max:50',
            'foto_profil'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'dokumen'          => 'nullable|array',
            'dokumen.*'        => 'file|mimes:pdf,doc,docx,jpeg,png,jpg|max:10240',
        ]);

        try {
            $user = auth()->user();
            $konsultan = $user->konsultan;

            if (!$konsultan) {
                return back()->with('error', 'Profil konsultan tidak ditemukan.');
            }

            $tarif = $request->tarif_konsultasi;
            if ($tarif !== null && $tarif >= 1000) {
                $tarif = (int)($tarif / 1000);
            }

            // Update basic fields on unified users table
            $user->update([
                'name'             => $request->nama,
                'telepon'          => $request->telepon,
            ]);

            $konsultanData = [
                'nama'             => $request->nama,
                'keahlian'         => $request->keahlian,
                'tarif_konsultasi' => $tarif,
                'telepon'          => $request->telepon,
                'alamat'           => $request->alamat,
            ];

            // Handle photo profile
            if ($request->hasFile('foto_profil')) {
                if ($konsultan->foto_profil && Storage::disk('public')->exists($konsultan->foto_profil)) {
                    Storage::disk('public')->delete($konsultan->foto_profil);
                }
                $fotoPath = $request->file('foto_profil')->store('konsultan_photos', 'public');
                $konsultanData['foto_profil'] = $fotoPath;
            }

            // Handle multiple document uploads to konsultan table
            if ($request->hasFile('dokumen')) {
                $uploadedDocs = [];
                $existingDocs = json_decode($konsultan->dokumen_path ?? '', true);
                if (is_array($existingDocs)) {
                    $uploadedDocs = $existingDocs;
                }

                foreach ($request->file('dokumen') as $file) {
                    $filePath = $file->store('konsultan_documents', 'public');
                    $uploadedDocs[] = $filePath;
                }
                $konsultanData['dokumen_path'] = json_encode($uploadedDocs);
            }

            $konsultan->update($konsultanData);

            return back()->with('success', 'Profil berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui profil: ' . $e->getMessage());
        }
    }

    public function hapusDokumen(Request $request)
    {
        $request->validate([
            'path' => 'required|string',
        ]);

        try {
            $konsultan = auth()->user()->konsultan;
            if (!$konsultan) {
                return back()->with('error', 'Profil tidak ditemukan.');
            }

            $docs = json_decode($konsultan->dokumen_path ?? '', true);
            if (!is_array($docs)) {
                $docs = $konsultan->dokumen_path ? [$konsultan->dokumen_path] : [];
            }

            if (($key = array_search($request->path, $docs)) !== false) {
                unset($docs[$key]);
                if (Storage::disk('public')->exists($request->path)) {
                    Storage::disk('public')->delete($request->path);
                }
                $konsultan->update([
                    'dokumen_path' => json_encode(array_values($docs))
                ]);
                return back()->with('success', 'Dokumen berhasil dihapus.');
            }

            return back()->with('error', 'Dokumen tidak ditemukan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus dokumen: ' . $e->getMessage());
        }
    }

    // =========================================================
    // MISSING AJAX CONTROLLER METHODS
    // =========================================================

    public function simpanJawaban(Request $request)
    {
        $request->validate([
            'id_konsultasi'      => 'required|exists:konsultasi,id_konsultasi',
            'id_keluhan'         => 'required|exists:keluhan,id',
            'diagnosa'           => 'required|string',
            'rekomendasi'        => 'required|string',
            'catatan_konsultasi' => 'nullable|string',
        ]);

        try {
            $konsultasi = \App\Models\Konsultasi::with(['keluhan.petani', 'konsultan'])->findOrFail($request->id_konsultasi);
            $keluhan = $konsultasi->keluhan;

            $konsultasi->update([
                'diagnosa'           => $request->diagnosa,
                'rekomendasi'        => $request->rekomendasi,
                'catatan_konsultasi' => $request->catatan_konsultasi,
                'status'             => 'selesai',
            ]);

            if ($keluhan) {
                $keluhan->update([
                    'status'           => 'selesai',
                    'last_resolved_at' => now(),
                ]);
            }

            // Create riwayat log using correct column names
            Riwayat::create([
                'id_keluhan'     => $request->id_keluhan,
                'tanggal_waktu'  => now(),
                'tipe_interaksi' => 'Konsultasi Online',
                'masalah'        => $keluhan ? $keluhan->judul_keluhan : 'Keluhan',
                'tindakan'       => $request->rekomendasi,
                'nama_petani'    => ($keluhan && $keluhan->petani) ? $keluhan->petani->nama : 'Petani',
                'nama_konsultan' => $konsultasi->konsultan ? $konsultasi->konsultan->nama : auth()->user()->name,
            ]);

            return response()->json(['success' => true, 'message' => 'Jawaban berhasil dikirim dan konsultasi diselesaikan!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menyimpan solusi: ' . $e->getMessage()], 500);
        }
    }

    public function simpanTanaman(Request $request)
    {
        $request->validate([
            'nama_tanaman' => 'required|string|max:255',
            'nama_latin'   => 'nullable|string|max:255',
            'jenis_tanaman'=> 'nullable|string|max:255',
            'deskripsi'    => 'nullable|string',
            'foto_tanaman' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        try {
            $data = $request->only(['nama_tanaman', 'nama_latin', 'jenis_tanaman', 'deskripsi', 'metode_perawatan', 'protokol_pengobatan']);
            $data['added_by'] = 'Konsultan ' . auth()->user()->name;

            // Handle foto
            if ($request->hasFile('foto_tanaman')) {
                $data['foto_tanaman'] = $request->file('foto_tanaman')->store('tanaman', 'public');
            }

            // Parse ancaman_hama
            $ancaman = [];
            if ($request->filled('ancaman_1')) $ancaman[] = $request->ancaman_1;
            if ($request->filled('ancaman_2')) $ancaman[] = $request->ancaman_2;
            if ($request->filled('ancaman_3')) $ancaman[] = $request->ancaman_3;
            $data['ancaman_hama'] = json_encode(array_values(array_filter($ancaman)));

            $tanaman = Tanaman::create($data);

            // Handle videos_data (YouTube URL / local video file)
            if ($request->has('videos_data')) {
                $videosData = json_decode($request->videos_data, true);
                if (is_array($videosData)) {
                    foreach ($videosData as $v) {
                        if ($v['action'] === 'create') {
                            $videoData = [
                                'id_tanaman' => $tanaman->id,
                                'judul'      => $v['judul'],
                                'uploader'   => 'konsultan',
                            ];
                            if ($v['type'] === 'link') {
                                $videoData['url'] = $v['url'];
                            } else {
                                $fileKey = "video_files_" . $v['tempId'];
                                if ($request->hasFile($fileKey)) {
                                    $videoData['file_path'] = $request->file($fileKey)->store('videos/tanaman', 'public');
                                }
                            }
                            VideoTanaman::create($videoData);
                        }
                    }
                }
            }

            $tanamanLoad = Tanaman::with('videos')->find($tanaman->id);
            $tanamanLoad->foto_url = $tanamanLoad->foto_url;

            return response()->json([
                'success' => true,
                'message' => 'Komoditas tanaman baru berhasil disimpan!',
                'tanaman' => $tanamanLoad
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menyimpan komoditas: ' . $e->getMessage()], 500);
        }
    }

    public function updateTanaman(Request $request, $id)
    {
        $request->validate([
            'nama_tanaman' => 'required|string|max:255',
            'nama_latin'   => 'nullable|string|max:255',
            'jenis_tanaman'=> 'nullable|string|max:255',
            'deskripsi'    => 'nullable|string',
            'foto_tanaman' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        try {
            $tanaman = Tanaman::findOrFail($id);
            $data = $request->only(['nama_tanaman', 'nama_latin', 'jenis_tanaman', 'deskripsi', 'metode_perawatan', 'protokol_pengobatan']);

            // Handle foto
            if ($request->hasFile('foto_tanaman')) {
                if ($tanaman->foto_tanaman && Storage::disk('public')->exists($tanaman->foto_tanaman)) {
                    Storage::disk('public')->delete($tanaman->foto_tanaman);
                }
                $data['foto_tanaman'] = $request->file('foto_tanaman')->store('tanaman', 'public');
            }

            // Parse ancaman_hama
            $ancaman = [];
            if ($request->filled('ancaman_1')) $ancaman[] = $request->ancaman_1;
            if ($request->filled('ancaman_2')) $ancaman[] = $request->ancaman_2;
            if ($request->filled('ancaman_3')) $ancaman[] = $request->ancaman_3;
            $data['ancaman_hama'] = json_encode(array_values(array_filter($ancaman)));

            $tanaman->update($data);

            // Handle videos_data
            if ($request->has('videos_data')) {
                $videosData = json_decode($request->videos_data, true);
                if (is_array($videosData)) {
                    foreach ($videosData as $v) {
                        if ($v['action'] === 'create') {
                            $videoData = [
                                'id_tanaman' => $tanaman->id,
                                'judul'      => $v['judul'],
                                'uploader'   => 'konsultan',
                            ];
                            if ($v['type'] === 'link') {
                                $videoData['url'] = $v['url'];
                            } else {
                                $fileKey = "video_files_" . $v['tempId'];
                                if ($request->hasFile($fileKey)) {
                                    $videoData['file_path'] = $request->file($fileKey)->store('videos/tanaman', 'public');
                                }
                            }
                            VideoTanaman::create($videoData);
                        } elseif ($v['action'] === 'update') {
                            $video = VideoTanaman::findOrFail($v['id']);
                            $video->judul = $v['judul'];
                            if (isset($v['url']) && !empty($v['url'])) {
                                if ($video->file_path && Storage::disk('public')->exists($video->file_path)) {
                                    Storage::disk('public')->delete($video->file_path);
                                }
                                $video->url = $v['url'];
                                $video->file_path = null;
                            } else {
                                $fileKey = "video_files_" . $v['id'];
                                if ($request->hasFile($fileKey)) {
                                    if ($video->file_path && Storage::disk('public')->exists($video->file_path)) {
                                        Storage::disk('public')->delete($video->file_path);
                                    }
                                    $video->file_path = $request->file($fileKey)->store('videos/tanaman', 'public');
                                    $video->url = null;
                                }
                            }
                            $video->save();
                        } elseif ($v['action'] === 'delete') {
                            $video = VideoTanaman::findOrFail($v['id']);
                            if ($video->file_path && Storage::disk('public')->exists($video->file_path)) {
                                Storage::disk('public')->delete($video->file_path);
                            }
                            $video->delete();
                        }
                    }
                }
            }

            $tanamanLoad = Tanaman::with('videos')->find($tanaman->id);
            $tanamanLoad->foto_url = $tanamanLoad->foto_url;

            return response()->json([
                'success' => true,
                'message' => 'Data komoditas berhasil diperbarui!',
                'tanaman' => $tanamanLoad
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal memperbarui komoditas: ' . $e->getMessage()], 500);
        }
    }

    public function hapusTanaman($id)
    {
        try {
            $tanaman = Tanaman::with('videos')->findOrFail($id);

            // Delete videos from disk
            foreach ($tanaman->videos as $video) {
                if ($video->file_path && Storage::disk('public')->exists($video->file_path)) {
                    Storage::disk('public')->delete($video->file_path);
                }
            }

            // Delete crop image
            if ($tanaman->foto_tanaman && Storage::disk('public')->exists($tanaman->foto_tanaman)) {
                Storage::disk('public')->delete($tanaman->foto_tanaman);
            }

            $tanaman->delete();

            return response()->json([
                'success' => true,
                'message' => 'Komoditas tanaman berhasil dihapus secara permanen!'
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus komoditas: ' . $e->getMessage()], 500);
        }
    }

    public function hapusKeluhan($id)
    {
        try {
            $keluhan = Keluhan::findOrFail($id);
            $keluhan->konsultasi()->delete();
            $keluhan->delete();
            return response()->json(['success' => true, 'message' => 'Keluhan berhasil dihapus secara permanen.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus keluhan: ' . $e->getMessage()], 500);
        }
    }

    public function hapusRiwayat($id)
    {
        try {
            $konsultasi = \App\Models\Konsultasi::findOrFail($id);
            $idKeluhan = $konsultasi->id_keluhan;
            $konsultasi->delete();
            if ($idKeluhan) {
                Keluhan::where('id', $idKeluhan)->delete();
            }
            return response()->json(['success' => true, 'message' => 'Riwayat berhasil dihapus secara permanen.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus riwayat: ' . $e->getMessage()], 500);
        }
    }
}