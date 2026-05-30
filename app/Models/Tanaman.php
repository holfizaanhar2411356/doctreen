<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Tanaman extends Model
{
    protected $table      = 'tanaman';
    public    $timestamps = true;

    protected $fillable = [
        'nama_tanaman',
        'nama_latin',
        'jenis_tanaman',
        'deskripsi',
        'foto_tanaman',
        'metode_perawatan',
        'protokol_pengobatan',
        'ancaman_hama',
        'added_by',
    ];

    protected $casts = [
        'ancaman_hama' => 'array',
    ];

    /**
     * Relasi ke video-video yang terkait dengan tanaman ini
     */
    public function videos()
    {
        return $this->hasMany(VideoTanaman::class, 'id_tanaman');
    }

    /**
     * Relasi ke user yang menambahkan tanaman ini
     */
    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    /**
     * URL foto tanaman dengan cache-busting (timestamp)
     */
    public function getFotoUrlAttribute(): ?string
    {
        if (!$this->foto_tanaman) {
            return null;
        }
        $url = asset('storage/' . $this->foto_tanaman);
        return $url . '?v=' . ($this->updated_at ? $this->updated_at->timestamp : time());
    }
}
