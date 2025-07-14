<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlnMember extends Model
{
    protected $fillable = [
        'nama', 'nip', 'email', 'jabatan', 'no_hp',
    ];
}
