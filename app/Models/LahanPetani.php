<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class LahanPetani extends Model
{
    protected $table      = 'lahan_petani';
    protected $primaryKey = 'id_lahan';
    public    $timestamps = false;

    protected $fillable = [
        'id_petani','id_tanaman','nama_lahan','lokasi','luas_lahan',
        'jenis_tanah','sistem_irigasi','tanggal_tanam','estimasi_panen','status_lahan',
    ];
}