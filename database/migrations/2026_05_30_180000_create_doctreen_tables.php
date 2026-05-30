<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. PETANI
        Schema::create('petani', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama');
            $table->string('daerah')->nullable();
            $table->string('foto_profil')->nullable();
            $table->timestamps();
        });

        // 2. KONSULTAN
        Schema::create('konsultan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama');
            $table->string('keahlian')->nullable();
            $table->string('status')->default('verifikasi');
            $table->text('alamat')->nullable();
            $table->string('telepon', 50)->nullable();
            $table->integer('tarif_konsultasi')->nullable();
            $table->string('foto_profil')->nullable();
            $table->string('dokumen_tipe', 100)->nullable();
            $table->text('dokumen_path')->nullable();
            $table->timestamps();
        });

        // 3. KONSULTAN DOCUMENTS
        Schema::create('konsultan_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('file_path');
            $table->string('file_name');
            $table->timestamps();
        });

        // 4. TANAMAN
        Schema::create('tanaman', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tanaman');
            $table->string('nama_latin')->nullable();
            $table->string('jenis_tanaman')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('foto_tanaman')->nullable();
            $table->text('metode_perawatan')->nullable();
            $table->text('protokol_pengobatan')->nullable();
            $table->text('ancaman_hama')->nullable(); // JSON / string list
            $table->string('added_by')->default('Admin Doctreen');
            $table->timestamps();
        });

        // 5. VIDEO TANAMAN
        Schema::create('video_tanaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tanaman')->constrained('tanaman')->onDelete('cascade');
            $table->string('judul');
            $table->string('url')->nullable();
            $table->string('file_path')->nullable();
            $table->enum('uploader', ['admin', 'konsultan'])->default('admin');
            $table->timestamps();
        });

        // 6. TOKO
        Schema::create('toko', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_toko');
            $table->text('alamat')->nullable();
            $table->enum('status', ['verifikasi', 'aktif', 'nonaktif'])->default('verifikasi');
            $table->string('foto_profil')->nullable();
            $table->timestamps();
        });

        // 7. PRODUK
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_toko')->constrained('toko')->onDelete('cascade');
            $table->string('nama_produk');
            $table->string('kategori')->nullable();
            $table->integer('stok')->default(0);
            $table->decimal('harga', 10, 2)->default(0.00);
            $table->text('deskripsi')->nullable();
            $table->string('foto_produk')->nullable();
            $table->timestamps();
        });

        // 8. KELUHAN
        Schema::create('keluhan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('keluhan')->onDelete('cascade');
            $table->foreignId('id_petani')->constrained('petani')->onDelete('cascade');
            $table->foreignId('id_tanaman')->nullable()->constrained('tanaman')->onDelete('set null');
            $table->string('judul_keluhan');
            $table->text('isi_keluhan');
            $table->string('foto_kendala')->nullable();
            $table->date('tanggal_keluhan');
            $table->enum('status', ['pending_payment', 'baru', 'sedang_berjalan', 'selesai'])->default('pending_payment');
            $table->timestamp('last_resolved_at')->nullable();
            $table->integer('rating')->nullable();
            $table->text('ulasan')->nullable();
            $table->string('metode_bayar')->nullable();
            $table->string('snap_token_konsultasi')->nullable();
            $table->string('order_id_konsultasi')->nullable()->unique();
            $table->string('payment_type_konsultasi')->nullable();
            $table->string('midtrans_status_konsultasi')->nullable();
            $table->string('status_bayar_konsultasi')->default('menunggu');
            $table->string('bukti_bayar')->nullable();
            $table->timestamps();
        });

        // 9. KONSULTASI
        Schema::create('konsultasi', function (Blueprint $table) {
            $table->id('id_konsultasi');
            $table->foreignId('id_konsultan')->nullable()->constrained('konsultan')->onDelete('cascade');
            $table->foreignId('id_keluhan')->constrained('keluhan')->onDelete('cascade');
            $table->date('tanggal_konsultasi')->nullable();
            $table->text('catatan_konsultasi')->nullable();
            $table->string('diagnosa')->nullable();
            $table->string('rekomendasi')->nullable();
            $table->enum('status', ['menunggu', 'proses', 'selesai'])->default('menunggu');
            $table->timestamps();
        });

        // 10. REVIEWS
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keluhan_id')->constrained('keluhan')->onDelete('cascade');
            $table->foreignId('konsultan_id')->constrained('users')->onDelete('cascade');
            $table->tinyInteger('rating');
            $table->text('ulasan')->nullable();
            $table->timestamps();
        });

        // 11. TRANSACTIONS
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('tipe_produk', ['konsultasi', 'produk_fisik']);
            $table->unsignedBigInteger('produk_id');
            $table->unsignedBigInteger('nominal');
            $table->string('status');
            $table->timestamps();
        });

        // 12. PESANAN
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_petani')->constrained('petani')->onDelete('cascade');
            $table->foreignId('id_produk')->nullable()->constrained('produk')->onDelete('set null');
            $table->foreignId('id_toko')->nullable()->constrained('toko')->onDelete('set null');
            $table->string('nama_produk')->nullable();
            $table->integer('kuantitas')->default(1);
            $table->datetime('tanggal_pesan');
            $table->decimal('total_harga', 10, 2);
            $table->string('metode_kirim');
            $table->string('metode_bayar')->nullable();
            $table->enum('status_bayar', ['menunggu', 'lunas', 'batal'])->default('menunggu');
            
            // Midtrans snap details
            $table->string('snap_token')->nullable();
            $table->string('order_id')->nullable()->unique();
            $table->string('payment_type')->nullable();
            $table->string('midtrans_status')->nullable();
            $table->string('bukti_bayar')->nullable();
            $table->timestamps();
        });

        // 13. RIWAYAT
        Schema::create('riwayat', function (Blueprint $table) {
            $table->id('id_riwayat');
            $table->foreignId('id_keluhan')->nullable()->constrained('keluhan')->onDelete('set null');
            $table->datetime('tanggal_waktu');
            $table->string('tipe_interaksi');
            $table->text('masalah')->nullable();
            $table->text('tindakan')->nullable();
            $table->string('nama_petani')->nullable();
            $table->string('nama_konsultan')->nullable();
            $table->text('ulasan')->nullable();
        });

        // 14. ULASAN
        Schema::create('ulasan', function (Blueprint $table) {
            $table->id('id_ulasan');
            $table->foreignId('id_konsultasi')->nullable()->constrained('konsultasi')->onDelete('cascade');
            $table->date('tanggal_ulasan');
            $table->text('komentar')->nullable();
            $table->integer('skor_rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasan');
        Schema::dropIfExists('riwayat');
        Schema::dropIfExists('pesanan');
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('konsultasi');
        Schema::dropIfExists('keluhan');
        Schema::dropIfExists('produk');
        Schema::dropIfExists('toko');
        Schema::dropIfExists('video_tanaman');
        Schema::dropIfExists('tanaman');
        Schema::dropIfExists('konsultan_documents');
        Schema::dropIfExists('konsultan');
        Schema::dropIfExists('petani');
    }
};
