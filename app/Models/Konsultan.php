<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konsultan extends Model
{
    protected $table      = 'konsultans';
    public    $timestamps = true;

    protected $fillable = [
        'user_id',
        'nama',
        'keahlian',
        'tarif_konsultasi',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}