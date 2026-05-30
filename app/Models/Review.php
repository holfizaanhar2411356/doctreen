<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';

    protected $fillable = [
        'keluhan_id',
        'konsultan_id',
        'rating',
        'ulasan',
    ];

    public function keluhan()
    {
        return $this->belongsTo(Keluhan::class, 'keluhan_id');
    }

    public function konsultan()
    {
        return $this->belongsTo(User::class, 'konsultan_id');
    }
}
