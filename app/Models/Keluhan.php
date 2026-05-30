<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    protected $table = 'keluhan';

    protected $fillable = [
        'id_petani',
        'id_tanaman',
        'judul_keluhan',
        'isi_keluhan',
        'foto_kendala',
        'tanggal_keluhan',
        'status',
        'parent_id',
        'last_resolved_at',
        'rating',
        'ulasan',
        'metode_bayar',
        'snap_token_konsultasi',
        'order_id_konsultasi',
        'payment_type_konsultasi',
        'midtrans_status_konsultasi',
        'status_bayar_konsultasi',
        'bukti_bayar',
    ];

    protected $casts = [
        'last_resolved_at' => 'datetime',
        'tanggal_keluhan'  => 'date',
    ];

    public function petani()
    {
        return $this->belongsTo(Petani::class, 'id_petani');
    }

    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class, 'id_tanaman');
    }

    public function parent()
    {
        return $this->belongsTo(Keluhan::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Keluhan::class, 'parent_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'keluhan_id');
    }

    /** Relasi ke konsultasi (melalui tabel konsultasi) */
    public function konsultasi()
    {
        return $this->hasOne(Konsultasi::class, 'id_keluhan');
    }
}
