<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'telepon',
        'role',
        'needs_password_reset',
        'foto_profil',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function documents() { return $this->hasMany(KonsultanDocument::class, 'user_id'); }
    public function toko() { return $this->hasOne(Toko::class, 'user_id'); }
    public function konsultan() { return $this->hasOne(Konsultan::class, 'user_id'); }
    public function petani() { return $this->hasOne(Petani::class, 'user_id'); }

    /** Keluhan yang dibuat oleh petani (via tabel keluhan FK id_petani → petani.id → user_id) */
    public function keluhans() { return $this->hasManyThrough(Keluhan::class, Petani::class, 'user_id', 'id_petani'); }
}