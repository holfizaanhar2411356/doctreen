<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Keluhan extends Model
{
    protected $table = 'keluhan';

    protected $fillable = [
        'id_petani',
        'id_tanaman',
        'judul_keluhan',
        'isi_keluhan',
        'foto_kendala',
        'status',
        'rating',
        'ulasan',
        'metode_bayar',
        'tanggal_keluhan',
        'bukti_bayar',
        // Midtrans — pembayaran konsultasi
        'snap_token_konsultasi',
        'order_id_konsultasi',
        'payment_type_konsultasi',
        'midtrans_status_konsultasi',
        'status_bayar_konsultasi',
    ];

    /**
     * Keluhan dibuat oleh satu Petani
     * keluhan.id_petani → petani.id
     */
    public function petani(): BelongsTo
    {
        return $this->belongsTo(Petani::class, 'id_petani', 'id');
    }

    /**
     * Keluhan terkait satu Tanaman (nullable)
     * keluhan.id_tanaman → tanaman.id
     */
    public function tanaman(): BelongsTo
    {
        return $this->belongsTo(Tanaman::class, 'id_tanaman', 'id');
    }

    /**
     * Satu keluhan bisa punya banyak record konsultasi
     * konsultasi.id_keluhan → keluhan.id
     */
    public function konsultasi(): HasMany
    {
        return $this->hasMany(Konsultasi::class, 'id_keluhan', 'id');
    }
}
