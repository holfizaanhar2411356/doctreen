<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Petani extends Model
{
    // Tentukan nama tabel jika tidak menggunakan jamak (optional)
    protected $table = 'petani'; 

    protected $fillable = [
        'id_user', 
        'user_id',
        'nama',
        'daerah',
        'telepon',
        'foto_profil'
    ];

    /**
     * Relasi ke model User (Setiap petani terikat ke satu akun User)
     */
    public function user(): BelongsTo
    {
        // Parameter kedua adalah foreign key di tabel petani. 
        // Ubah 'id_user' jika di database Anda menggunakan nama 'user_id'
        return $this->belongsTo(User::class, 'user_id'); 
    }
}
