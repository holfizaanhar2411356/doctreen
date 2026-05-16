<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    protected $table      = 'riwayat';
    protected $primaryKey = 'id_riwayat';
    public    $timestamps = false;

    protected $fillable = [
        'id_keluhan','tanggal_waktu','tipe_interaksi',
        'masalah','tindakan','nama_petani','nama_konsultan','ulasan',
    ];
}