<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    use HasFactory, Notifiable; // <-- HasApiTokens sudah dihapus dengan aman
    /**
     * Kolom-kolom yang boleh diisi secara massal (Mass Assignment).
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'telepon', 
        'role',    
        'foto_profil',
    ];
    /**
     * Kolom-kolom yang harus disembunyikan dalam serialisasi array.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * Casting tipe data kolom database.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    /**
     * Relasi ke model Konsultan
     */
    public function konsultan()
    {
        return $this->hasOne(Konsultan::class, 'user_id');
    }
}
