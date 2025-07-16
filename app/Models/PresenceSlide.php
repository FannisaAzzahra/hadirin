<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresenceSlide extends Model
{
    protected $fillable = ['presence_id', 'image_path'];

    public function presence()
    {
        return $this->belongsTo(Presence::class);
    }
}
