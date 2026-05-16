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
    ];

    public function petani()
    {
        return $this->belongsTo(Petani::class, 'id_petani');
    }

    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class, 'id_tanaman');
    }

    public function konsultasi()
    {
return $this->hasOne(Konsultasi::class, 'id_keluhan', 'id');
    }
}



