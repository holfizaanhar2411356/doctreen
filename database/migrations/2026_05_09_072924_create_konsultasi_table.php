<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('konsultasi', function (Blueprint $table) {
            $table->id('id_konsultasi');
            // Foreign key ke tabel konsultan dan keluhan
            $table->unsignedBigInteger('id_konsultan')->nullable();
            $table->unsignedBigInteger('id_keluhan');
            
            $table->date('tanggal_konsultasi')->nullable();
            $table->text('catatan_konsultasi')->nullable();
            $table->string('diagnosa')->nullable();
            $table->string('rekomendasi')->nullable();
            $table->enum('status', ['menunggu', 'proses', 'selesai'])->default('menunggu');
            
            // Opsional: Jika Anda ingin menggunakan timestamps, hapus public $timestamps = false di model
            // $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konsultasi');
    }
};