<?php

namespace App\Models;

use App\Enums\Bed\BedStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bed extends Model
{
    protected $fillable = [
        'room_id',
        'bed_number',
        'status',
    ];

    protected $casts = [
        'status' => BedStatusEnum::class,
    ];

    // ----------- Relationships -----------
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    // ----------- Accessors & Mutators -----------
    public function scopeAvailable($query): Builder
    {
        return $query->where(
            'status',
            \App\Enums\Bed\BedStatusEnum::AVAILABLE
        );
    }
    
}