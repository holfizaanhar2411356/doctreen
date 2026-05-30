<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use App\Models\User;
use App\Models\Produk;
use App\Models\Riwayat;
use App\Models\Pesanan;
use App\Models\Tanaman;
use App\Models\Toko;
use App\Models\Konsultan;
use App\Models\Konsultasi;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PetaniController extends Controller
{
    private function petaniId()
    {
        return auth()->user()->petani->id ?? null;
    }

    public function dashboard()
    {
        try {
            $petaniId = $this->petaniId();
            $petani = auth()->user()->petani;

            if (!$petani) {
                return redirect()->route('home')->with('error', 'Profil petani tidak ditemukan.');
            }

            $keluhans = Keluhan::with(['konsultasi.konsultan.user', 'tanaman'])
                            ->where('id_petani', $petaniId)
                            ->orderBy('created_at', 'desc')
                            ->get();

            $konsultans = Konsultan::with('user')
                            ->where('status', 'aktif')
                            ->take(5)
                            ->get();

            $totalKonsultasi = Keluhan::where('id_petani', $petaniId)->count();
            $terjawab        = Keluhan::where('id_petani', $petaniId)->where('status', 'selesai')->count();
            $pesananAktif    = Pesanan::where('id_petani', $petaniId)->where('status_bayar', 'menunggu')->count();

            $tanamans = Tanaman::with('videos')->orderBy('nama_tanaman')->get();
            $produks = Produk::with('toko')->where('stok', '>', 0)->get();
            $tokos = Toko::with('produks')->where('status', 'aktif')->orderBy('nama_toko')->get();

            // Riwayats for consultation sessions
            $riwayats = Konsultasi::whereHas('keluhan', function($q) use ($petaniId) {
                            $q->where('id_petani', $petaniId);
                        })
                        ->with(['keluhan.tanaman', 'konsultan.user'])
                        ->orderBy('id_konsultasi', 'desc')
                        ->get();

            // Pesanans for shopping log
            $pesanans = Pesanan::where('id_petani', $petaniId)
                        ->with(['produk', 'toko'])
                        ->orderBy('created_at', 'desc')
                        ->get();

            return view('petani.dashboard', compact(
                'keluhans', 'konsultans', 'totalKonsultasi', 'petani', 'tanamans',
                'terjawab', 'pesananAktif', 'produks', 'riwayats', 'pesanans', 'tokos'
            ));
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memuat dashboard: ' . $e->getMessage());
        }
    }

    public function ajukanKeluhan(Request $request)
    {
        $request->validate([
            'judul_keluhan' => 'required|string|max:255',
            'isi_keluhan'   => 'required|string',
            'id_tanaman'    => 'nullable|exists:tanaman,id', 
            'id_konsultan'  => 'required|exists:konsultan,id', 
            'metode_bayar'   => 'nullable|string',
        ]);

        try {
            $petaniId = $this->petaniId();

            $data = [
                'id_petani'       => $petaniId,
                'id_tanaman'      => $request->id_tanaman,
                'judul_keluhan'   => $request->judul_keluhan,
                'isi_keluhan'     => $request->isi_keluhan,
                'tanggal_keluhan' => now()->toDateString(),
                'status'          => 'baru',
                'metode_bayar'    => $request->metode_bayar ?? 'Transfer Bank',
                'status_bayar_konsultasi' => 'menunggu',
            ];

            if ($request->hasFile('foto_kendala')) {
                $path = $request->file('foto_kendala')->store('keluhan', 'public');
                $data['foto_kendala'] = $path;
            }

            $keluhan = Keluhan::create($data);

            // Create matching consultation record assigned to the selected consultant
            Konsultasi::create([
                'id_konsultan'       => $request->id_konsultan,
                'id_keluhan'         => $keluhan->id,
                'tanggal_konsultasi' => now(),
                'status'             => 'menunggu',
            ]);

            return back()->with('success', 'Keluhan berhasil diajukan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengajukan keluhan: ' . $e->getMessage());
        }
    }

    public function updateKeluhan(Request $request, $id)
    {
        $request->validate([
            'judul_keluhan' => 'required|string|max:255',
            'isi_keluhan'   => 'required|string',
            'id_konsultan'  => 'required|exists:konsultan,id',
            'metode_bayar'  => 'required|string',
        ]);

        try {
            $keluhan = Keluhan::findOrFail($id);
            $data = [
                'judul_keluhan' => $request->judul_keluhan,
                'isi_keluhan'   => $request->isi_keluhan,
                'metode_bayar'  => $request->metode_bayar,
            ];

            if ($request->hasFile('foto_kendala')) {
                if ($keluhan->foto_kendala && Storage::disk('public')->exists($keluhan->foto_kendala)) {
                    Storage::disk('public')->delete($keluhan->foto_kendala);
                }
                $data['foto_kendala'] = $request->file('foto_kendala')->store('keluhan', 'public');
            }

            $keluhan->update($data);

            if ($keluhan->konsultasi) {
                $keluhan->konsultasi->update([
                    'id_konsultan' => $request->id_konsultan,
                ]);
            }

            return back()->with('success', 'Keluhan berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui keluhan: ' . $e->getMessage());
        }
    }

    public function hapusKeluhan($id)
    {
        try {
            $keluhan = Keluhan::findOrFail($id);
            if ($keluhan->foto_kendala && Storage::disk('public')->exists($keluhan->foto_kendala)) {
                Storage::disk('public')->delete($keluhan->foto_kendala);
            }
            if ($keluhan->bukti_bayar && Storage::disk('public')->exists($keluhan->bukti_bayar)) {
                Storage::disk('public')->delete($keluhan->bukti_bayar);
            }
            $keluhan->konsultasi()->delete();
            $keluhan->delete();
            return back()->with('success', 'Keluhan berhasil dihapus secara permanen!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus keluhan: ' . $e->getMessage());
        }
    }

    public function buktiKeluhan(Request $request, $id)
    {
        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg,webp|max:51200',
        ]);

        try {
            $keluhan = Keluhan::findOrFail($id);
            if ($request->hasFile('bukti_bayar')) {
                if ($keluhan->bukti_bayar && Storage::disk('public')->exists($keluhan->bukti_bayar)) {
                    Storage::disk('public')->delete($keluhan->bukti_bayar);
                }
                $path = $request->file('bukti_bayar')->store('bukti_bayar', 'public');
                $keluhan->update([
                    'bukti_bayar' => $path,
                    'status_bayar_konsultasi' => 'proses'
                ]);
            }

            return back()->with('success', 'Bukti pembayaran keluhan berhasil diunggah! Mohon tunggu konfirmasi admin.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengunggah bukti pembayaran: ' . $e->getMessage());
        }
    }

    public function tanyaLagiGratis(Request $request, $id)
    {
        $request->validate([
            'judul_keluhan' => 'required|string|max:255',
            'isi_keluhan'   => 'required|string',
            'foto_kendala'  => 'nullable|image|max:10240',
        ]);

        try {
            $prevKeluhan = Keluhan::with('konsultasi')->findOrFail($id);
            
            $data = [
                'id_petani'       => $prevKeluhan->id_petani,
                'id_tanaman'      => $prevKeluhan->id_tanaman,
                'judul_keluhan'   => $request->judul_keluhan,
                'isi_keluhan'     => $request->isi_keluhan,
                'tanggal_keluhan' => now()->toDateString(),
                'status'          => 'baru', 
                'parent_id'       => $prevKeluhan->id,
                'status_bayar_konsultasi' => 'lunas', 
            ];

            if ($request->hasFile('foto_kendala')) {
                $data['foto_kendala'] = $request->file('foto_kendala')->store('keluhan', 'public');
            } else {
                $data['foto_kendala'] = $prevKeluhan->foto_kendala;
            }

            $newKeluhan = Keluhan::create($data);

            if ($prevKeluhan->konsultasi) {
                Konsultasi::create([
                    'id_konsultan'       => $prevKeluhan->konsultasi->id_konsultan,
                    'id_keluhan'         => $newKeluhan->id,
                    'tanggal_konsultasi' => now(),
                    'status'             => 'menunggu',
                ]);
            }

            return back()->with('success', 'Pertanyaan lanjutan berhasil dikirim secara gratis!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses pertanyaan lanjutan: ' . $e->getMessage());
        }
    }

    public function tanyaLagiBayar(Request $request, $id)
    {
        $request->validate([
            'judul_keluhan' => 'required|string|max:255',
            'isi_keluhan'   => 'required|string',
            'foto_kendala'  => 'nullable|image|max:10240',
        ]);

        try {
            $prevKeluhan = Keluhan::with('konsultasi')->findOrFail($id);

            $data = [
                'id_petani'       => $prevKeluhan->id_petani,
                'id_tanaman'      => $prevKeluhan->id_tanaman,
                'judul_keluhan'   => $request->judul_keluhan,
                'isi_keluhan'     => $request->isi_keluhan,
                'tanggal_keluhan' => now()->toDateString(),
                'status'          => 'baru',
                'parent_id'       => $prevKeluhan->id,
                'metode_bayar'    => $prevKeluhan->metode_bayar ?? 'Transfer Bank',
                'status_bayar_konsultasi' => 'menunggu',
            ];

            if ($request->hasFile('foto_kendala')) {
                $data['foto_kendala'] = $request->file('foto_kendala')->store('keluhan', 'public');
            } else {
                $data['foto_kendala'] = $prevKeluhan->foto_kendala;
            }

            $newKeluhan = Keluhan::create($data);

            if ($prevKeluhan->konsultasi) {
                Konsultasi::create([
                    'id_konsultan'       => $prevKeluhan->konsultasi->id_konsultan,
                    'id_keluhan'         => $newKeluhan->id,
                    'tanggal_konsultasi' => now(),
                    'status'             => 'menunggu',
                ]);
            }

            return back()->with('success', 'Pertanyaan lanjutan berhasil diajukan! Silakan lakukan pembayaran sesi.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses pertanyaan lanjutan: ' . $e->getMessage());
        }
    }

    public function produk()
    {
        return redirect()->route('petani.dashboard')->with('tab', 'toko');
    }

    public function beli(Request $request)
    {
        $request->validate([
            'id_produk'    => 'required|exists:produk,id',
            'metode_kirim' => 'required|string',
            'kuantitas'    => 'nullable|integer|min:1',
            'metode_bayar' => 'nullable|string',
        ]);

        try {
            $produk = Produk::findOrFail($request->id_produk);
            $petaniId = $this->petaniId();
            $qty = (int)($request->kuantitas ?? 1);

            if ($produk->stok < $qty) {
                if ($request->expectsJson() || $request->wantsJson()) {
                    return response()->json(['success' => false, 'message' => 'Stok produk tidak mencukupi.'], 400);
                }
                return back()->with('error', 'Stok produk tidak mencukupi.');
            }
            $produk->decrement('stok', $qty);

            $pesanan = Pesanan::create([
                'id_petani'    => $petaniId,
                'id_produk'    => $request->id_produk,
                'id_toko'      => $produk->id_toko,
                'nama_produk'  => $produk->nama_produk,
                'kuantitas'    => $qty,
                'tanggal_pesan'=> now(),
                'total_harga'  => $produk->harga * $qty,
                'metode_kirim' => $request->metode_kirim,
                'metode_bayar' => $request->metode_bayar ?? 'Transfer Bank',
                'status_bayar' => 'menunggu',
            ]);

            if ($request->expectsJson() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.',
                    'pesanan' => $pesanan
                ]);
            }

            return back()->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');
        } catch (\Exception $e) {
            if ($request->expectsJson() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Gagal memproses pembelian: ' . $e->getMessage()], 500);
            }
            return back()->with('error', 'Gagal memproses pembelian: ' . $e->getMessage());
        }
    }

    public function hapusPesanan($id)
    {
        try {
            $pesanan = Pesanan::findOrFail($id);
            if ($pesanan->status_bayar === 'menunggu' && $pesanan->produk) {
                $pesanan->produk->increment('stok', $pesanan->kuantitas);
            }
            if ($pesanan->bukti_bayar && Storage::disk('public')->exists($pesanan->bukti_bayar)) {
                Storage::disk('public')->delete($pesanan->bukti_bayar);
            }
            $pesanan->delete();
            return back()->with('success', 'Pesanan berhasil dibatalkan secara permanen!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membatalkan pesanan: ' . $e->getMessage());
        }
    }

    public function buktiPesanan(Request $request, $id)
    {
        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg,webp|max:51200',
        ]);

        try {
            $pesanan = Pesanan::findOrFail($id);
            if ($request->hasFile('bukti_bayar')) {
                if ($pesanan->bukti_bayar && Storage::disk('public')->exists($pesanan->bukti_bayar)) {
                    Storage::disk('public')->delete($pesanan->bukti_bayar);
                }
                $path = $request->file('bukti_bayar')->store('bukti_bayar', 'public');
                $pesanan->update([
                    'bukti_bayar' => $path,
                    'status_bayar' => 'proses'
                ]);
            }

            return back()->with('success', 'Bukti transfer pembayaran belanja berhasil diunggah! Mohon tunggu konfirmasi admin.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengunggah bukti pembayaran belanja: ' . $e->getMessage());
        }
    }

    public function riwayat()
    {
        return redirect()->route('petani.dashboard')->with('tab', 'riwayat');
    }

    public function beriUlasan(Request $request)
    {
        $request->validate([
            'id_konsultasi' => 'required|exists:konsultasi,id_konsultasi',
            'skor_rating'   => 'required|integer|between:1,5',
            'komentar'      => 'nullable|string',
        ]);

        try {
            $konsultasi = Konsultasi::with('keluhan')->findOrFail($request->id_konsultasi);

            Ulasan::create([
                'id_konsultasi' => $request->id_konsultasi,
                'skor_rating'   => $request->skor_rating,
                'komentar'      => $request->komentar,
                'tanggal_ulasan'=> now()->toDateString(),
            ]);

            // Save directly to the parent complaint for denormalized statistic
            if ($konsultasi->keluhan) {
                $konsultasi->keluhan->update([
                    'rating' => $request->skor_rating,
                    'ulasan' => $request->komentar,
                ]);
            }

            return back()->with('success', 'Ulasan dan rating berhasil dikirim!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim ulasan: ' . $e->getMessage());
        }
    }

    public function tanyaLagi($id)
    {
        try {
            $keluhan = Keluhan::findOrFail($id);

            if (!$keluhan->last_resolved_at) {
                return back()->with('error', 'Sesi konsultasi ini belum selesai.');
            }

            $closedAt = \Carbon\Carbon::parse($keluhan->last_resolved_at);
            $diffHours = $closedAt->diffInHours(now());

            if ($diffHours < 24) {
                $keluhan->touch();
                $keluhan->update([
                    'status'           => 'baru',
                    'last_resolved_at' => null,
                ]);

                return back()->with('success', 'Konsultasi berhasil dibuka kembali secara gratis!');
            } else {
                $followUp = Keluhan::create([
                    'id_petani'       => $keluhan->id_petani,
                    'id_tanaman'      => $keluhan->id_tanaman,
                    'judul_keluhan'   => 'Lanjutan: ' . $keluhan->judul_keluhan,
                    'isi_keluhan'     => 'Pertanyaan lanjutan dari sesi sebelumnya.',
                    'foto_kendala'    => $keluhan->foto_kendala,
                    'tanggal_keluhan' => now()->toDateString(),
                    'status'          => 'baru',
                    'parent_id'       => $keluhan->id,
                    'status_bayar_konsultasi' => 'menunggu',
                ]);

                if ($keluhan->konsultasi) {
                    Konsultasi::create([
                        'id_konsultan'       => $keluhan->konsultasi->id_konsultan,
                        'id_keluhan'         => $followUp->id,
                        'tanggal_konsultasi' => now(),
                        'status'             => 'menunggu',
                    ]);
                }

                return back()->with('success', 'Sesi lanjutan telah dibuat! Silakan cek keluhan Anda di tab Keluhan.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses konsultasi lanjutan: ' . $e->getMessage());
        }
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'nama'        => 'required|string|max:255',
            'daerah'      => 'required|string|max:255',
            'telepon'     => 'required|string|max:20',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        try {
            $user = auth()->user();
            $petani = $user->petani;

            if (!$petani) {
                return back()->with('error', 'Profil petani tidak ditemukan.');
            }

            // Update user table
            $user->update([
                'name'    => $request->nama,
                'telepon' => $request->telepon,
            ]);

            $data = [
                'nama'   => $request->nama,
                'daerah' => $request->daerah,
            ];

            if ($request->hasFile('foto_profil')) {
                if ($petani->foto_profil && Storage::disk('public')->exists($petani->foto_profil)) {
                    Storage::disk('public')->delete($petani->foto_profil);
                }
                $path = $request->file('foto_profil')->store('petani_photos', 'public');
                $data['foto_profil'] = $path;
                
                // Update photo on user table too
                $user->update(['foto_profil' => $path]);
            }

            $petani->update($data);

            return back()->with('success', 'Profil Anda berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui profil: ' . $e->getMessage());
        }
    }
}