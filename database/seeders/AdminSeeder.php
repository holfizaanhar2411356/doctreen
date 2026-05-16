<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Cek apakah admin sudah ada, jika tidak buat
        $admin = User::where('email', 'admin@doctreen.com')->first();

        if (!$admin) {
            $admin = User::create([
                'name' => 'Admin doctreen',
                'email' => 'admin@doctreen.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'telepon' => '08123456789'
            ]);
            echo "Admin user created successfully.\n";
        } else {
            // Update password jika sudah ada
            $admin->update([
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]);
            echo "Admin user already exists. Password updated.\n";
        }
    }
}