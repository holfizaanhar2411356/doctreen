<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanaman extends Model
{
    use HasFactory;

    protected $table = 'tanaman';

    protected $fillable = [
        'nama_tanaman',
        'nama_latin',
        'jenis_tanaman',
        'foto_tanaman',
        'metode_perawatan',
        'protokol_pengobatan',
        'ancaman_hama',
        'added_by',
    ];

    // Mengubah otomatis JSON string di DB menjadi array PHP
    protected $casts = [
        'ancaman_hama' => 'array',
    ];
}
