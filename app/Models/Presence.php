<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    // Data disimpan
    protected $fillable = [
        'nama_kegiatan', 
        'slug', 
        'tgl_kegiatan', 
        'lokasi', 
        'link_lokasi', 
        'batas_waktu',
        'is_active'
    ];
}
