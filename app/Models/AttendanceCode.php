<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AttendanceCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'presence_id',
        'nama',
        'email',
        'nip',
        'is_used',
        'used_at',
        'expires_at'
    ];

    protected $casts = [
        'is_used' => 'boolean',
        'used_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function presence()
    {
        return $this->belongsTo(Presence::class);
    }

    /**
     * Generate kode unik baru
     */
    public static function generateUniqueCode(): string
    {
        do {
            // Format: PLNHDR + 4 digit random
            $code = 'PLNHDR' . strtoupper(Str::random(4));
        } while (self::where('code', $code)->exists());

        return $code;
    }

    /**
     * Buat kode unik baru untuk presence tertentu
     */
    public static function createForPresence(int $presenceId, array $data = []): self
    {
        return self::create([
            'code' => self::generateUniqueCode(),
            'presence_id' => $presenceId,
            'nama' => $data['nama'] ?? null,
            'email' => $data['email'] ?? null,
            'nip' => $data['nip'] ?? null,
        ]);
    }

    /**
     * Cek apakah kode masih valid (belum digunakan dan belum expired)
     */
    public function isValid(): bool
    {
        if ($this->is_used) {
            return false;
        }

        if ($this->expires_at && $this->expires_at->isPast()) {
            return false;
        }

        return true;
    }

    /**
     * Tandai kode sebagai sudah digunakan
     */
    public function markAsUsed(): void
    {
        $this->update([
            'is_used' => true,
            'used_at' => now(),
        ]);
    }
}
