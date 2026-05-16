<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PetaniController;
use App\Http\Controllers\KonsultanController;


/*
|--------------------------------------------------------------------------
| 1. Halaman Publik
|--------------------------------------------------------------------------
*/
Route::get('/', function () { 
    return view('landing'); 
})->name('home');

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

/*
|--------------------------------------------------------------------------
| 3. Fitur Admin (Login & Dashboard)
|--------------------------------------------------------------------------
*/

// --- Dashboard Petani ---
Route::middleware(['auth', 'auth.petani'])->prefix('petani')->name('petani.')->group(function () {
    Route::get('/dashboard', [PetaniController::class, 'dashboard'])->name('dashboard');
    Route::post('/keluhan', [PetaniController::class, 'ajukanKeluhan'])->name('keluhan.store');
    Route::get('/produk', [PetaniController::class, 'produk'])->name('produk');
    Route::post('/pesanan', [PetaniController::class, 'beli'])->name('pesanan.store');
    Route::get('/riwayat', [PetaniController::class, 'riwayat'])->name('riwayat');
    Route::post('/ulasan', [PetaniController::class, 'beriUlasan'])->name('ulasan.store');
});

// --- Dashboard Konsultan ---
Route::middleware(['auth', 'auth.konsultan'])->prefix('konsultan')->name('konsultan.')->group(function () {
    Route::get('/dashboard', [KonsultanController::class, 'dashboard'])->name('dashboard');
    Route::post('/konsultasi/{id}/jawab', [KonsultanController::class, 'jawabKeluhan'])->name('jawab');
    Route::post('/konsultasi/{id}/selesai', [KonsultanController::class, 'selesaikan'])->name('selesai');
    Route::get('/riwayat', [KonsultanController::class, 'riwayat'])->name('riwayat');
});
Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.submit');

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

        // CRUD Toko
        Route::post('/toko/store', [AdminController::class, 'storeToko'])->name('toko.store');
        Route::put('/toko/{id}', [AdminController::class, 'updateToko'])->name('toko.update');
        Route::post('/toko/{id}/verifikasi', [AdminController::class, 'verifikasiToko'])->name('toko.verifikasi');
        Route::delete('/toko/{id}', [AdminController::class, 'hapusToko'])->name('toko.hapus');

        // Aksi Keluhan
        Route::post('/keluhan/{id}/assign', [AdminController::class, 'assignKonsultan'])->name('keluhan.assign');
    });
});