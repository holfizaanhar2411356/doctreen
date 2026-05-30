<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konsultan extends Model
{
    protected $table      = 'konsultan';
    public    $timestamps = true;

    protected $fillable = [
        'user_id',
        'nama',
        'keahlian',
        'tarif_konsultasi',
        'status',
        'alamat',
        'telepon',
        'foto_profil',
        'dokumen_tipe',
        'dokumen_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}