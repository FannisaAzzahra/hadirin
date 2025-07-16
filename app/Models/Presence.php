<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    protected $fillable = [
        'nama_kegiatan', 
        'slug', 
        'tgl_kegiatan', 
        'lokasi', 
        'link_lokasi', 
        'batas_waktu',
        'is_active',
        'judul_header',
        'logo_kiri',
        'logo_kanan',
        'logo_ig',     
        'link_ig',     
    ];

    public function slides()
    {
        return $this->hasMany(PresenceSlide::class);
    }
}
