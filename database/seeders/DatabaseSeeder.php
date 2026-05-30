<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tanaman;
use App\Models\Toko;
use App\Models\Produk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin
        User::create([
            'name' => 'Admin Doctreen',
            'email' => 'admin@doctreen.com',
            'password' => Hash::make('admin123'),
            'telepon' => '081234567890',
            'role' => 'admin',
            'status' => 'active',
        ]);

        // 2. Create Petani
        $petani = User::create([
            'name' => 'Pak Tani',
            'email' => 'petani@doctreen.com',
            'password' => Hash::make('petani123'),
            'telepon' => '082223334445',
            'role' => 'petani',
            'status' => 'active',
            'asal' => 'Malang',
        ]);

        // 3. Create active Konsultan
        $konsultan = User::create([
            'name' => 'Dr. Budi Santoso',
            'email' => 'konsultan@doctreen.com',
            'password' => Hash::make('konsultan123'),
            'telepon' => '083334445556',
            'role' => 'konsultan',
            'status' => 'active',
            'spesialisasi' => 'Penyakit Padi & Jagung',
            'tarif_konsultasi' => 50, // Rp 50.000 (stored as 50)
        ]);

        // 4. Create Toko User & Toko
        $tokoUser = User::create([
            'name' => 'Toko Tani Makmur',
            'email' => 'toko@doctreen.com',
            'password' => Hash::make('toko123'),
            'telepon' => '084445556667',
            'role' => 'toko',
            'status' => 'active',
        ]);

        $toko = Toko::create([
            'user_id' => $tokoUser->id,
            'nama_toko' => 'Tani Makmur Jaya',
            'alamat' => 'Jl. Pertanian Raya No. 45, Malang',
            'status' => 'aktif',
        ]);

        // 5. Create Crops (Tanaman)
        $padi = Tanaman::create([
            'nama_tanaman' => 'Padi',
            'nama_latin' => 'Oryza sativa',
            'jenis_tanaman' => 'Pangan',
            'deskripsi' => 'Tanaman pangan utama penghasil beras.',
            'metode_perawatan' => 'Penyiraman teratur, pemupukan urea pada hari ke-15 dan 45.',
            'protokol_pengobatan' => 'Semprot fungisida jika terkena blast daun.',
            'ancaman_hama' => 'Wereng coklat, walang sangit, burung pipit.',
        ]);

        $jagung = Tanaman::create([
            'nama_tanaman' => 'Jagung',
            'nama_latin' => 'Zea mays',
            'jenis_tanaman' => 'Pangan',
            'deskripsi' => 'Tanaman pangan sumber karbohidrat alternatif.',
            'metode_perawatan' => 'Pengairan sedang, penjarangan gulma berkala.',
            'protokol_pengobatan' => 'Semprot pestisida organik untuk ulat grayak.',
            'ancaman_hama' => 'Ulat grayak, tikus, penyakit bulai.',
        ]);

        // 6. Create Products
        Produk::create([
            'id_toko' => $toko->id,
            'nama_produk' => 'Pupuk Urea Subsidi 50kg',
            'kategori' => 'Pupuk',
            'stok' => 100,
            'harga' => 150, // stored as 150 (Rp 150.000)
            'deskripsi' => 'Pupuk nitrogen berkualitas tinggi untuk pertumbuhan vegetatif tanaman.',
        ]);

        Produk::create([
            'id_toko' => $toko->id,
            'nama_produk' => 'Fungisida Blast-Off 500ml',
            'kategori' => 'Pestisida',
            'stok' => 50,
            'harga' => 85, // Rp 85.000
            'deskripsi' => 'Cairan fungisida sistemik ampuh mengatasi penyakit blas pada padi.',
        ]);
    }
}
