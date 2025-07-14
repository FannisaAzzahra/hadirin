<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresenceDetail extends Model
{
    // Data disimpan
    // protected $fillable = ['presence_id', 'nama', 'jabatan', 'unit', 'signature'];
    protected $fillable = ['presence_id', 'nama', 'nip', 'email', 'jabatan', 'unit', 'no_hp', 'signature'];
}
