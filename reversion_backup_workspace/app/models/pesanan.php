<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table      = 'pesanan';
    protected $primaryKey = 'id_pesanan';
    public    $timestamps = false;

    protected $fillable = [
        'id_petani','tanggal_pesan','total_harga','metode_kirim','status_bayar',
    ];
}
