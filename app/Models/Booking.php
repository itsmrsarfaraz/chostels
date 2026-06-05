<?php

namespace App\Models;

use App\Enums\Booking\BookingSourceEnum;
use App\Enums\Booking\BookingStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'hostel_id',
        'room_id',
        'bed_id',
        'seeker_id',
        'status',
        'check_in_date',
        'check_out_date',
        'monthly_rent',
        'source',
    ];

    protected $casts = [
        'check_in_date' => 'date',
        'check_out_date' => 'date',
        'status' => BookingStatusEnum::class,
        'source' => BookingSourceEnum::class,
    ];

    protected $with = [
        'hostel',
        'room',
        'bed',
        'seeker',
    ];

    // ----------- Scopes -----------
    public function scopePending($query): Builder
    {
        return $query->where(
            'status',
            BookingStatusEnum::PENDING
        );
    }

    public function scopeConfirmed($query): Builder
    {
        return $query->where(
            'status',
            BookingStatusEnum::CONFIRMED
        );
    }

    public function scopeCheckedIn($query): Builder
    {
        return $query->where(
            'status',
            BookingStatusEnum::CHECKED_IN
        );
    }

    // ---------- Relationships -----------
    public function hostel(): BelongsTo
    {
        return $this->belongsTo(Hostel::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function bed(): BelongsTo
    {
        return $this->belongsTo(Bed::class);
    }

    public function seeker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seeker_id');
    }

    // ---------- Helper Methods ---------
    
}