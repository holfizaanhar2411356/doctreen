<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\PetaniController;
use App\Http\Controllers\KonsultanController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\TanamanController;

/*
|--------------------------------------------------------------------------
| 1. Halaman Publik
|--------------------------------------------------------------------------
*/
Route::get('/', function () { 
    $konsultans = \App\Models\Konsultan::whereIn('status', ['active', 'aktif'])->limit(3)->get();
    $produks = \App\Models\Produk::with('toko')->limit(4)->get();
    $tanamans = \App\Models\Tanaman::orderBy('created_at', 'desc')->limit(6)->get();
    return view('landing', compact('konsultans', 'produks', 'tanamans')); 
})->name('home');

// Midtrans Callback (exempt from CSRF in bootstrap/app.php)
Route::post('/midtrans/callback', [\App\Http\Controllers\NotificationController::class, 'callback'])->name('midtrans.callback');

/*
|--------------------------------------------------------------------------
| 2. Autentikasi User Umum (Petani & Konsultan)
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Pendaftaran Khusus Konsultan
Route::get('/register/konsultan', [RegisterController::class, 'showKonsultanForm'])->name('register.konsultan');
Route::post('/register/konsultan', [RegisterController::class, 'registerKonsultan']);

// Lupa Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Force Password Reset Routes
Route::get('/sandi-baru', [\App\Http\Controllers\Auth\NewPasswordController::class, 'showForm'])->name('password.new.form');
Route::post('/sandi-baru', [\App\Http\Controllers\Auth\NewPasswordController::class, 'update'])->name('password.new.update');

/*
|--------------------------------------------------------------------------
| 3. Fitur Petani
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'auth.petani'])->prefix('petani')->name('petani.')->group(function () {
    Route::get('/dashboard', [PetaniController::class, 'dashboard'])->name('dashboard');
    Route::post('/keluhan', [PetaniController::class, 'ajukanKeluhan'])->name('keluhan.store');
    Route::put('/keluhan/{id}', [PetaniController::class, 'updateKeluhan'])->name('keluhan.update');
    Route::delete('/keluhan/{id}', [PetaniController::class, 'hapusKeluhan'])->name('keluhan.destroy');
    Route::post('/keluhan/{id}/bukti', [PetaniController::class, 'buktiKeluhan'])->name('keluhan.bukti');
    Route::post('/keluhan/{id}/edit-gratis', [PetaniController::class, 'tanyaLagiGratis'])->name('keluhan.edit-gratis');
    Route::post('/keluhan/{id}/tanya-lagi-bayar', [PetaniController::class, 'tanyaLagiBayar'])->name('keluhan.tanya-lagi-bayar');

    Route::get('/produk', [PetaniController::class, 'produk'])->name('produk');
    Route::post('/pesanan', [PetaniController::class, 'beli'])->name('pesanan.store');
    Route::delete('/pesanan/{id}', [PetaniController::class, 'hapusPesanan'])->name('pesanan.destroy');
    Route::post('/pesanan/{id}/bukti', [PetaniController::class, 'buktiPesanan'])->name('pesanan.bukti');

    Route::get('/riwayat', [PetaniController::class, 'riwayat'])->name('riwayat');
    Route::post('/ulasan', [PetaniController::class, 'beriUlasan'])->name('ulasan.store');
    Route::put('/profil/update', [PetaniController::class, 'updateProfil'])->name('profil.update');

    // Midtrans Token endpoints
    Route::post('/midtrans/token/pesanan/{id}', [MidtransController::class, 'tokenPesanan'])->name('midtrans.token.pesanan');
    Route::post('/midtrans/token/keluhan/{id}', [MidtransController::class, 'tokenKeluhan'])->name('midtrans.token.keluhan');
    Route::get('/midtrans/status/pesanan/{id}', [MidtransController::class, 'statusPesanan'])->name('midtrans.status.pesanan');
    Route::get('/midtrans/status/keluhan/{id}', [MidtransController::class, 'statusKeluhan'])->name('midtrans.status.keluhan');
    
    // Webhook simulation / localhost testing endpoints
    Route::post('/midtrans/update/pesanan/{id}', [MidtransController::class, 'updateStatusPesanan'])->name('midtrans.update.pesanan');
    Route::post('/midtrans/update/keluhan/{id}', [MidtransController::class, 'updateStatusKeluhan'])->name('midtrans.update.keluhan');

    // Tanya Lagi
    Route::post('/keluhan/{id}/tanya-lagi', [PetaniController::class, 'tanyaLagi'])->name('keluhan.tanya-lagi');
});

/*
|--------------------------------------------------------------------------
| 4. Fitur Konsultan
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'auth.konsultan'])->prefix('konsultan')->name('konsultan.')->group(function () {
    Route::get('/dashboard', [KonsultanController::class, 'dashboard'])->name('dashboard');
    Route::get('/keluhan/{id}', [KonsultanController::class, 'show'])->name('keluhan.show');
    Route::get('/konsultasi/keluhan/{id}', [KonsultanController::class, 'detailKeluhan'])->name('detail');
    Route::post('/konsultasi/{id}/jawab', [KonsultanController::class, 'jawabKeluhan'])->name('jawab');
    Route::post('/konsultasi/simpan', [KonsultanController::class, 'simpanJawaban'])->name('simpan');
    Route::post('/konsultasi/{id}/selesai', [KonsultanController::class, 'selesaikan'])->name('selesai');
    Route::get('/riwayat', [KonsultanController::class, 'riwayat'])->name('riwayat');
    Route::post('/profil/update', [KonsultanController::class, 'updateProfil'])->name('profil.update');
    Route::post('/profil/dokumen/hapus', [KonsultanController::class, 'hapusDokumen'])->name('profil.dokumen.hapus');

    // Model Tanaman — read only untuk konsultan (shared view)
    Route::get('/tanaman', [TanamanController::class, 'index'])->name('tanaman.index');

    // CRUD Tanaman & Video via Konsultan
    Route::post('/tanaman/simpan', [KonsultanController::class, 'simpanTanaman'])->name('tanaman.simpan');
    Route::put('/tanaman/update/{id}', [KonsultanController::class, 'updateTanaman'])->name('tanaman.update');
    Route::delete('/tanaman/hapus/{id}', [KonsultanController::class, 'hapusTanaman'])->name('tanaman.hapus');
    Route::delete('/keluhan/hapus/{id}', [KonsultanController::class, 'hapusKeluhan'])->name('keluhan.hapus');
    Route::delete('/riwayat/{id}', [KonsultanController::class, 'hapusRiwayat'])->name('riwayat.hapus');
});

/*
|--------------------------------------------------------------------------
| 5. Fitur Admin (Login & Dashboard CRUD)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function() {
    // Guest Admin Route
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.submit');

    // Protected Admin Route
    Route::middleware(['auth', 'auth.admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // CRUD Petani
        Route::post('/petani/store', [AdminController::class, 'storePetani'])->name('petani.store');
        Route::put('/petani/{id}', [AdminController::class, 'updatePetani'])->name('petani.update');
        Route::delete('/petani/{id}', [AdminController::class, 'hapusPetani'])->name('petani.hapus');

        // CRUD Konsultan
        Route::post('/konsultan/store', [AdminController::class, 'storeKonsultan'])->name('konsultan.store');
        Route::put('/konsultan/{id}', [AdminController::class, 'updateKonsultan'])->name('konsultan.update');
        Route::post('/konsultan/{id}/verifikasi', [AdminController::class, 'verifikasiKonsultan'])->name('konsultan.verifikasi');
        Route::delete('/konsultan/{id}', [AdminController::class, 'hapusKonsultan'])->name('konsultan.hapus');
        Route::get('/konsultan/{id}/ulasan', [AdminController::class, 'getUlasanKonsultan'])->name('konsultan.ulasan');

        // CRUD Toko
        Route::post('/toko/store', [AdminController::class, 'storeToko'])->name('toko.store');
        Route::put('/toko/{id}', [AdminController::class, 'updateToko'])->name('toko.update');
        Route::post('/toko/{id}/verifikasi', [AdminController::class, 'verifikasiToko'])->name('toko.verifikasi');
        Route::delete('/toko/{id}', [AdminController::class, 'hapusToko'])->name('toko.hapus');

        // CRUD Produk
        Route::post('/produk/store', [AdminController::class, 'storeProduk'])->name('produk.store');
        Route::put('/produk/{id}', [AdminController::class, 'updateProduk'])->name('produk.update');
        Route::delete('/produk/{id}', [AdminController::class, 'hapusProduk'])->name('produk.hapus');
    });

    // CRUD Tanaman & Video (Admin only — via TanamanController)
    Route::middleware(['auth', 'auth.admin'])->group(function () {
        // CRUD Tanaman (Ensiklopedia / Model Tanaman)
        Route::post('/tanaman', [TanamanController::class, 'store'])->name('tanaman.store');
        Route::put('/tanaman/{id}', [TanamanController::class, 'update'])->name('tanaman.update');
        Route::delete('/tanaman/{id}', [TanamanController::class, 'destroy'])->name('tanaman.hapus');
        
        // Video Tanaman
        Route::post('/tanaman/{id}/video', [TanamanController::class, 'storeVideo'])->name('video.store');
        Route::delete('/video/{id}', [TanamanController::class, 'destroyVideo'])->name('video.hapus');
        Route::put('/video/ubah/{id}', [TanamanController::class, 'updateVideo'])->name('video.update');
    });

    Route::middleware(['auth', 'auth.admin'])->group(function () {
        // Aksi Keluhan
        Route::post('/keluhan/{id}/assign', [AdminController::class, 'assignKonsultan'])->name('keluhan.assign');

        // Riwayat / Log Deletion
        Route::delete('/riwayat-konsultasi/{id}', [AdminController::class, 'hapusKonsultasi'])->name('riwayat-konsultasi.hapus');
        Route::delete('/riwayat-pesanan/{id}', [AdminController::class, 'hapusPesanan'])->name('riwayat-pesanan.hapus');
    });
});
