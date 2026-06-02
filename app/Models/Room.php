<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    protected $fillable = [
        'hostel_id',
        'name',
        'room_type',
        'total_beds',
        'monthly_rent',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // ----------- Relationships -----------
    public function hostel(): BelongsTo
    {
        return $this->belongsTo(Hostel::class);
    }
    
    public function beds(): HasMany
    {
        return $this->hasMany(Bed::class);
    }

    // ---------- Accessors & Mutators -----------
    protected static function booted(): void
    {
        static::created(function ($room) {
            for ($i = 1; $i <= $room->total_beds; $i++) {
                $room->beds()->create([
                    'bed_number' => "Bed {$i}",
                ]);
            }
        });
    }
}