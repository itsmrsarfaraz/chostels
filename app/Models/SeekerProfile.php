<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SeekerProfile extends Model
{
    protected $fillable = [
        'user_id',
        'phone',
        'cnic',
        'gender',
        'home_city',
        'current_city',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}