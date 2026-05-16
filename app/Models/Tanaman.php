<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Tanaman extends Model
{
    protected $table      = 'tanaman';
    protected $primaryKey = 'id_tanaman';
    public    $timestamps = false;

    protected $fillable = [
        'id_kategori','nama_tanaman','nama_latin','deskripsi',
        'musim_tanam','umur_panen','syarat_tumbuh','foto_tanaman',
    ];
}
