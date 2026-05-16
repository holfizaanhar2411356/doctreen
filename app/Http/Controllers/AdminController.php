<?php

namespace App\Http\Controllers;

use App\Models\Petani;
use App\Models\Konsultan;
use App\Models\Keluhan;
use App\Models\Toko;
use App\Models\User;
use App\Models\Konsultasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $totalPetani    = Petani::count();
        $totalKonsultan = Konsultan::count();
        $totalKeluhan   = Keluhan::count();
        $selesai        = Keluhan::where('status', 'selesai')->count();

        $tokoVerifikasi = Toko::where('status', 'verifikasi')->get();
        $keluhanTerbaru = Keluhan::with(['petani', 'konsultasi.konsultan'])
                            ->orderBy('tanggal_keluhan', 'desc')->take(8)->get();

        $petanis    = Petani::with('user')->withCount('keluhans')->orderBy('created_at','desc')->get();
        $konsultans = Konsultan::with('user')->orderBy('created_at', 'desc')->get();
        $tokos      = Toko::with('user')->orderBy('created_at', 'desc')->get();
        $riwayats   = Konsultasi::with(['keluhan.petani', 'konsultan'])
                            ->orderBy('tanggal_konsultasi', 'desc')->take(10)->get();

        return view('admin.dashboard', compact(
            'totalPetani', 'totalKonsultan', 'totalKeluhan', 'selesai',
            'tokoVerifikasi', 'keluhanTerbaru', 'petanis', 'konsultans', 'tokos', 'riwayats'
        ));
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
        Konsultan::findOrFail($id)->update(['status' => 'aktif']);
        return back()->with('success', 'Konsultan berhasil diverifikasi!');
    }

    public function hapusKonsultan($id)
    {
        $konsultan = Konsultan::findOrFail($id);
        if ($konsultan->user) {
            $konsultan->user->delete();
        } else {
            $konsultan->delete();
        }

        return back()->with('success', 'Konsultan berhasil dihapus!');
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
        Toko::findOrFail($id)->update(['status' => 'aktif']);
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
            'konsultan_id' => 'required|exists:konsultans,id',
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
}