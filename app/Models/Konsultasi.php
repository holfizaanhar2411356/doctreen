<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    protected $table      = 'konsultasi';
    protected $primaryKey = 'id_konsultasi';
    public    $timestamps = false;

    protected $fillable = [
        'id_konsultan','id_keluhan','tanggal_konsultasi',
        'catatan_konsultasi','diagnosa','rekomendasi','status',
    ];

    public function konsultan()
    {
        return $this->belongsTo(Konsultan::class, 'id_konsultan');
    }

    public function keluhan()
    {
        return $this->belongsTo(Keluhan::class, 'id_keluhan');
    }

    public function ulasan()
    {
        return $this->hasOne(Ulasan::class, 'id_konsultasi');
    }
}