<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relasi ke company units
     */
    public function units()
    {
        return $this->hasMany(CompanyUnit::class)->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Relasi ke company units yang aktif
     */
    public function activeUnits()
    {
        return $this->hasMany(CompanyUnit::class)->where('is_active', true)->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Scope untuk companies yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk ordering
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Get companies with their active units
     */
    public static function getCompaniesWithUnits()
    {
        return self::active()
            ->ordered()
            ->with('activeUnits')
            ->get();
    }
}