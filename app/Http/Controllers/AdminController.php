<?php

namespace App\Http\Controllers;

use App\Models\Petani;
use App\Models\Konsultan;
use App\Models\Keluhan;
use App\Models\Toko;
use App\Models\User;
use App\Models\Konsultasi;
use App\Models\Tanaman;
use App\Models\VideoTanaman;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function showLoginForm() {
        return view('auth.admin-login');
    }

    public function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->username, 'password' => $request->password, 'role' => 'admin']) ||
            Auth::attempt(['name' => $request->username, 'password' => $request->password, 'role' => 'admin'])) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withInput()->with('error', 'Username/Email atau Password salah.');
    }

    public function dashboard()
    {
        try {
            $totalPetani    = Petani::count();
            $totalKonsultan = Konsultan::where('status', 'aktif')->count();
            $totalKeluhan   = Keluhan::count();
            $selesai        = Keluhan::where('status', 'selesai')->count();

            // Ambil keluhan terbaru dengan relasi petani (dari tabel petani via id_petani)
            $keluhanTerbaru = Keluhan::with(['petani', 'konsultasi.konsultan'])
                                ->orderBy('created_at', 'desc')->take(8)->get();

            // Petani dari tabel petani (bukan users)
            $petanis    = Petani::with('user')
                            ->withCount('keluhans')
                            ->orderBy('created_at', 'desc')->get();

            // Konsultan dari tabel konsultan (bukan users)
            $konsultans = Konsultan::with('user')
                            ->orderBy('created_at', 'desc')->get();

            $tokos            = Toko::with('user')->orderBy('created_at', 'desc')->get();
            $tokoVerifikasi   = Toko::where('status', 'aktif')->get();

            // Riwayat konsultasi dari tabel riwayat
            $riwayats = \App\Models\Riwayat::orderBy('tanggal_waktu', 'desc')->take(20)->get();

            // Riwayat pesanan belanja
            $riwayatPesanans = \App\Models\Pesanan::with(['petani', 'produk'])
                            ->orderBy('created_at', 'desc')->take(10)->get();

            // Tanaman & video
            $tanamanList = Tanaman::with('videos')
                            ->orderBy('nama_tanaman')->get();

            // Produk
            $produks = Produk::with('toko')->orderBy('created_at', 'desc')->get();

            $tanamans = $tanamanList;
            $pesanans = $riwayatPesanans;

            return view('admin.dashboard', compact(
                'totalPetani', 'totalKonsultan', 'totalKeluhan', 'selesai',
                'keluhanTerbaru', 'petanis', 'konsultans', 'tokos', 'tokoVerifikasi',
                'riwayats', 'riwayatPesanans', 'tanamanList', 'produks', 'tanamans', 'pesanans'
            ));
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memuat dashboard: ' . $e->getMessage());
        }
    }

    // --- CRUD PETANI ---
    public function storePetani(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'telepon' => 'required|string|max:20',
            'daerah' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'password' => Hash::make($request->password ?? Str::random(12)),
            'role' => 'petani',
        ]);

        Petani::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'daerah' => $request->daerah,
        ]);

        return back()->with('success', 'Petani berhasil ditambahkan!');
    }

    public function hapusPetani($id)
    {
        $petani = Petani::findOrFail($id);
        if ($petani->user) {
            $petani->user->delete();
        } else {
            $petani->delete();
        }

        return back()->with('success', 'Petani berhasil dihapus!');
    }

    public function updatePetani(Request $request, $id)
    {
        $petani = Petani::findOrFail($id);
        $user = $petani->user;

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . ($user? $user->id : 'NULL'),
            'telepon' => 'required|string|max:20',
            'daerah' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8',
        ]);

        if ($user) {
            $user->update([
                'name' => $request->nama,
                'email' => $request->email,
                'telepon' => $request->telepon,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
            ]);
        }

        $petani->update([
            'nama' => $request->nama,
            'daerah' => $request->daerah,
        ]);

        return back()->with('success', 'Petani berhasil diperbarui!');
    }

    // --- CRUD KONSULTAN ---
    public function storeKonsultan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'telepon' => 'required|string|max:20',
            'keahlian' => 'required|string|max:255',
            'tarif_konsultasi' => 'required|numeric|min:0',
            'password' => 'nullable|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'password' => Hash::make($request->password ?? Str::random(12)),
            'role' => 'konsultan',
        ]);

        Konsultan::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'keahlian' => $request->keahlian,
            'tarif_konsultasi' => $request->tarif_konsultasi,
            'status' => 'aktif',
        ]);

        return back()->with('success', 'Konsultan berhasil ditambahkan!');
    }

    public function verifikasiKonsultan($id)
    {
        try {
            $konsultan = Konsultan::findOrFail($id);
            $konsultan->update(['status' => 'aktif']);
            
            $user = $konsultan->user;
            if ($user) {
                $user->update([
                    'needs_password_reset' => true,
                ]);

                try {
                    \Illuminate\Support\Facades\Mail::raw("Halo {$user->name},\n\nAkun Konsultan Anda telah disetujui oleh Admin. Silakan login ke aplikasi Doctreen dengan kata sandi default Anda. Anda akan diminta untuk membuat sandi baru setelah login.", function ($message) use ($user) {
                        $message->to($user->email)->subject('Akun Konsultan Doctreen Aktif');
                    });
                } catch (\Exception $mailEx) {
                    // Abaikan jika SMTP offline
                }
            }

            return back()->with('success', 'Konsultan berhasil disetujui dan diaktifkan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memverifikasi konsultan: ' . $e->getMessage());
        }
    }

    public function hapusKonsultan($id)
    {
        try {
            $konsultan = Konsultan::findOrFail($id);
            $user = $konsultan->user;
            $email = $user ? $user->email : null;

            // Hapus berkas dari storage
            $docs = json_decode($konsultan->dokumen_path ?? '', true);
            if (is_array($docs)) {
                foreach ($docs as $filePath) {
                    if (\Illuminate\Support\Facades\Storage::disk('public')->exists($filePath)) {
                        \Illuminate\Support\Facades\Storage::disk('public')->delete($filePath);
                    }
                }
            }

            if ($user) {
                $user->delete(); // Ini otomatis men-cascade delete ke konsultan
            } else {
                $konsultan->delete();
            }

            if ($email) {
                try {
                    \Illuminate\Support\Facades\Mail::raw("Halo,\n\nMohon maaf, pendaftaran Anda sebagai konsultan di Doctreen belum disetujui oleh Admin karena dokumen kredensial Anda tidak memenuhi kriteria. Silakan daftarkan kembali dengan berkas yang valid.", function ($message) use ($email) {
                        $message->to($email)->subject('Pendaftaran Konsultan Doctreen Ditolak');
                    });
                } catch (\Exception $mailEx) {
                    // Abaikan jika SMTP offline
                }
            }

            return back()->with('success', 'Konsultan berhasil ditolak dan dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menolak konsultan: ' . $e->getMessage());
        }
    }

    public function updateKonsultan(Request $request, $id)
    {
        $konsultan = Konsultan::findOrFail($id);
        $user = $konsultan->user;

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . ($user? $user->id : 'NULL'),
            'telepon' => 'required|string|max:20',
            'keahlian' => 'nullable|string|max:255',
            'tarif_konsultasi' => 'nullable|numeric|min:0',
            'status' => 'nullable|in:verifikasi,aktif,nonaktif',
            'password' => 'nullable|string|min:8',
        ]);

        if ($user) {
            $user->update([
                'name' => $request->nama,
                'email' => $request->email,
                'telepon' => $request->telepon,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
            ]);
        }

        $konsultan->update([
            'nama' => $request->nama,
            'keahlian' => $request->keahlian,
            'tarif_konsultasi' => $request->tarif_konsultasi,
            'status' => $request->status ?? $konsultan->status,
        ]);

        return back()->with('success', 'Konsultan berhasil diperbarui!');
    }

    // --- CRUD TOKO ---
    public function storeToko(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
            'status' => 'nullable|in:verifikasi,aktif,nonaktif',
            'password' => 'nullable|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->nama_toko,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'password' => Hash::make($request->password ?? Str::random(12)),
            'role' => 'toko',
        ]);

        Toko::create([
            'user_id' => $user->id,
            'nama_toko' => $request->nama_toko,
            'alamat' => $request->alamat,
            'status' => $request->status ?? 'verifikasi',
        ]);

        return back()->with('success', 'Toko berhasil ditambahkan!');
    }

    public function verifikasiToko($id)
    {
        $toko = Toko::findOrFail($id);
        $toko->update(['status' => 'aktif']);
        if ($toko->user) {
            $toko->user->update(['needs_password_reset' => true]);
        }
        return back()->with('success', 'Toko berhasil diverifikasi!');
    }

    public function hapusToko($id)
    {
        $toko = Toko::findOrFail($id);
        if ($toko->user) {
            $toko->user->delete();
        } else {
            $toko->delete();
        }

        return back()->with('success', 'Toko berhasil dihapus!');
    }

    public function updateToko(Request $request, $id)
    {
        $toko = Toko::findOrFail($id);
        $user = $toko->user;

        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . ($user? $user->id : 'NULL'),
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
            'status' => 'nullable|in:verifikasi,aktif,nonaktif',
            'password' => 'nullable|string|min:8',
        ]);

        if ($user) {
            $user->update([
                'name' => $request->nama_toko,
                'email' => $request->email,
                'telepon' => $request->telepon,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
            ]);
        }

        $toko->update([
            'nama_toko' => $request->nama_toko,
            'alamat' => $request->alamat,
            'status' => $request->status ?? $toko->status,
        ]);

        return back()->with('success', 'Toko berhasil diperbarui!');
    }

    public function assignKonsultan(Request $request, $id)
    {
        $request->validate([
            'konsultan_id' => 'required|exists:konsultan,id',
            'tanggal_konsultasi' => 'required|date',
        ]);

        $keluhan = Keluhan::findOrFail($id);
        $keluhan->update(['status' => 'proses']);

        Konsultasi::create([
            'id_konsultan' => $request->konsultan_id,
            'id_keluhan' => $keluhan->id,
            'tanggal_konsultasi' => $request->tanggal_konsultasi,
            'status' => 'menunggu',
        ]);

        return back()->with('success', 'Konsultan berhasil ditugaskan ke keluhan.');
    }

    /**
     * Memproses penghapusan riwayat sesi konsultasi oleh admin
     */
    public function hapusKonsultasi($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);
        $idKeluhan = $konsultasi->id_keluhan;
        
        // Hapus konsultasi terlebih dahulu secara aman
        $konsultasi->delete();
        
        // Hapus keluhan terkait secara permanen
        if ($idKeluhan) {
            Keluhan::where('id', $idKeluhan)->delete();
        }

        return back()->with('success', 'Riwayat sesi konsultasi berhasil dihapus secara permanen!');
    }

    /**
     * Memproses penghapusan riwayat pesanan belanja oleh admin
     */
    public function hapusPesanan($id)
    {
        $pesanan = \App\Models\Pesanan::findOrFail($id);
        
        // Kembalikan stok produk jika pesanan dibatalkan/dihapus saat masih menunggu
        if ($pesanan->status_bayar === 'menunggu' && $pesanan->produk) {
            $pesanan->produk->increment('stok', $pesanan->kuantitas);
        }
        
        $pesanan->delete();

        return back()->with('success', 'Riwayat transaksi pesanan belanja berhasil dihapus secara permanen!');
    }

    /**
     * Mengambil daftar ulasan dan rating untuk konsultan tertentu (AJAX)
     */
    public function getUlasanKonsultan($id)
    {
        try {
            $keluhans = Keluhan::whereHas('konsultasi', function($q) use ($id) {
                    $q->where('id_konsultan', $id);
                })
                ->whereNotNull('rating')
                ->with('petani')
                ->orderBy('id', 'desc')
                ->get();

            $ulasans = $keluhans->map(function($k) {
                return [
                    'rating' => $k->rating,
                    'ulasan' => $k->ulasan,
                    'petani' => $k->petaniUser ? $k->petaniUser->name : 'Petani Anonim',
                    'tanggal' => optional($k->created_at)->format('d M Y') ?? '-',
                ];
            });

            return response()->json([
                'success' => true,
                'ulasans' => $ulasans,
                'avg_rating' => $keluhans->average('rating') ?? 0,
                'total' => $keluhans->count(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil ulasan: ' . $e->getMessage()
            ], 500);
        }
    }

    // =========================================================
    // CRUD PRODUK
    // =========================================================

    public function storeProduk(Request $request)
    {
        $request->validate([
            'id_toko'     => 'required|exists:toko,id',
            'nama_produk' => 'required|string|max:255',
            'kategori'    => 'nullable|string|max:100',
            'stok'        => 'required|integer|min:0',
            'harga'       => 'required|integer|min:0',
            'deskripsi'   => 'nullable|string',
            'foto_produk' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        try {
            $data = $request->only(['id_toko', 'nama_produk', 'kategori', 'stok', 'harga', 'deskripsi']);

            if ($request->hasFile('foto_produk')) {
                $data['foto_produk'] = $request->file('foto_produk')->store('produk', 'public');
            }

            Produk::create($data);

            return back()->with('success', 'Produk berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambah produk: ' . $e->getMessage());
        }
    }

    public function updateProduk(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori'    => 'nullable|string|max:100',
            'stok'        => 'required|integer|min:0',
            'harga'       => 'required|integer|min:0',
            'deskripsi'   => 'nullable|string',
            'foto_produk' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        try {
            $produk = Produk::findOrFail($id);
            $data   = $request->only(['nama_produk', 'kategori', 'stok', 'harga', 'deskripsi']);

            if ($request->hasFile('foto_produk')) {
                if ($produk->foto_produk && Storage::disk('public')->exists($produk->foto_produk)) {
                    Storage::disk('public')->delete($produk->foto_produk);
                }
                $data['foto_produk'] = $request->file('foto_produk')->store('produk', 'public');
            }

            $produk->update($data);

            return back()->with('success', 'Produk berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui produk: ' . $e->getMessage());
        }
    }

    public function hapusProduk($id)
    {
        try {
            $produk = Produk::findOrFail($id);

            if ($produk->foto_produk && Storage::disk('public')->exists($produk->foto_produk)) {
                Storage::disk('public')->delete($produk->foto_produk);
            }

            $produk->delete();

            return back()->with('success', 'Produk berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus produk: ' . $e->getMessage());
        }
    }
}