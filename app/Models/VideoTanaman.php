<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoTanaman extends Model
{
    protected $table    = 'video_tanaman';
    public $timestamps  = true;

    protected $fillable = [
        'id_tanaman',
        'judul',
        'url',
        'file_path',
        'uploader',
    ];

    /**
     * Relasi ke Tanaman
     */
    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class, 'id_tanaman');
    }

    /**
     * Apakah video ini bertipe YouTube?
     */
    public function isYoutube(): bool
    {
        return !empty($this->url);
    }

    /**
     * Konversi URL YouTube ke embed URL
     */
    public function getEmbedUrlAttribute(): ?string
    {
        if (!$this->url) {
            return null;
        }
        // Support: youtu.be/ID & youtube.com/watch?v=ID
        preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/))([a-zA-Z0-9_-]{11})/', $this->url, $m);
        if (!empty($m[1])) {
            return "https://www.youtube.com/embed/{$m[1]}";
        }
        return $this->url;
    }

    /**
     * Thumbnail YouTube
     */
    public function getThumbnailAttribute(): ?string
    {
        if (!$this->url) {
            return null;
        }
        preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/))([a-zA-Z0-9_-]{11})/', $this->url, $m);
        if (!empty($m[1])) {
            return "https://img.youtube.com/vi/{$m[1]}/hqdefault.jpg";
        }
        return null;
    }
}
