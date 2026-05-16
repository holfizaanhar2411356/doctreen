<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petani extends Model
{
    protected $table = 'petani';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'nama',
        'daerah',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function keluhans()
    {
        // keluhans tabel punya FK id_petani
        return $this->hasMany(Keluhan::class, 'id_petani');
    }
}

