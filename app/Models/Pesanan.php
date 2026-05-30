<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table      = 'pesanan';
    // Primary key di database adalah 'id'
    // protected $primaryKey = 'id';
    public    $timestamps = true;

    protected $fillable = [
        'id_petani',
        'id_produk',
        'id_toko',
        'nama_produk',
        'kuantitas',
        'tanggal_pesan',
        'total_harga',
        'metode_kirim',
        'metode_bayar',
        'status_bayar',
        'snap_token',
        'order_id',
        'payment_type',
        'midtrans_status',
        'bukti_bayar',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    public function petani()
    {
        return $this->belongsTo(Petani::class, 'id_petani');
    }

    public function toko()
    {
        return $this->belongsTo(Toko::class, 'id_toko');
    }
}