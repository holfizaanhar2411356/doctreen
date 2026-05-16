<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    protected $table = 'toko';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'nama_toko',
        'alamat',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function produks()
    {
        return $this->hasMany(Produk::class, 'id_toko');
    }
}