<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KonsultanDocument extends Model
{
    protected $table = 'konsultan_documents';

    protected $fillable = [
        'user_id',
        'file_path',
        'file_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
