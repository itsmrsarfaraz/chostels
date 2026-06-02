<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HostelNearbyPlace extends Model
{
    protected $fillable = [
        'hostel_id',
        'name',
        'type',
        'distance_km',
    ];

    public function hostel(): BelongsTo
    {
        return $this->belongsTo(Hostel::class);
    }
}