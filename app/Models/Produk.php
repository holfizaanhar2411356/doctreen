<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produks';
    public $timestamps = true;

    protected $fillable = [
        'id_toko','nama_produk','kategori','stok','deskripsi','harga','foto_produk',
    ];

    public function toko()
    {
        return $this->belongsTo(Toko::class, 'id_toko');
    }
}