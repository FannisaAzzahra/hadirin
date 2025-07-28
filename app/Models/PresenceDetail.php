<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresenceDetail extends Model
{
    // Data disimpan
    // protected $fillable = ['presence_id', 'nama', 'jabatan', 'unit', 'signature'];
    protected $fillable = ['presence_id', 'nama', 'nip', 'email', 'jabatan', 'unit', 'no_hp', 'signature'];

    use HasFactory;

    public function pln_member()
    {
        return $this->belongsTo(PlnMember::class);
    }

    public function presence()
    {
        return $this->belongsTo(Presence::class);
    }
}
