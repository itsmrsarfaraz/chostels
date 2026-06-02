<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HostelFacility extends Model
{
    protected $fillable = ['hostel_id', 'facility',];

    public function hostel(): BelongsTo
    {
        return $this->belongsTo(Hostel::class);
    }
}