<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PetaniController;
use App\Http\Controllers\KonsultanController;
use App\Http\Controllers\TanamanController;
use App\Http\Controllers\KeluhanController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\MidtransController;
// routes/web.php
Route::middleware(['auth', 'auth.konsultan'])->group(function () {
    Route::post('/konsultasi/simpan', [KonsultasiController::class, 'simpan'])
        ->name('konsultasi.simpan');
});

Route::middleware(['auth', 'auth.admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // ... route admin Anda yang lain (petani, konsultan, toko, dll) ...
    // BARU: Tambahkan baris route untuk manajemen tanaman edukasi di sini
    Route::post('/tanaman', [AdminController::class, 'storeTanaman'])->name('tanaman.store');
    Route::put('/tanaman/{id}', [AdminController::class, 'updateTanaman'])->name('tanaman.update');
    Route::delete('/tanaman/{id}', [AdminController::class, 'hapusTanaman'])->name('tanaman.hapus');
});
/*
|--------------------------------------------------------------------------
| 1. Halaman Publik
|------------------------------------------------------------------
<truncated 7554 bytes>
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
        Route::post('/tanaman/{id}/video', [AdminController::class, 'storeVideo'])->name('video.store');
        Route::delete('/video/{id}', [AdminController::class, 'hapusVideo'])->name('video.hapus');
        Route::put('/video/ubah/{id}', [AdminController::class, 'updateVideo'])->name('video.update');
        // Aksi Keluhan
        Route::post('/keluhan/{id}/assign', [AdminController::class, 'assignKonsultan'])->name('keluhan.assign');

        // Riwayat / Log Deletion
        Route::delete('/riwayat-konsultasi/{id}', [AdminController::class, 'hapusKonsultasi'])->name('riwayat-konsultasi.hapus');
        Route::delete('/riwayat-pesanan/{id}', [AdminController::class, 'hapusPesanan'])->name('riwayat-pesanan.hapus');
    });
});
