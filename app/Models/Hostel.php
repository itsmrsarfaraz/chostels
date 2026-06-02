<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Hostel extends Model implements HasMedia
{
    use InteractsWithMedia;
    
    protected $fillable = [
        'owner_id',
        'name',
        'slug',
        'hostel_type',
        'description',
        'bank_name',
        'bank_account_title',
        'bank_account_number',
        'latitude',
        'longitude',
        'address',
        'has_mess_menu',
        'status',
    ];

    protected $casts = [
        'has_mess_menu' => 'boolean',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')
            ->singleFile();

        $this->addMediaCollection('featured_image')
            ->singleFile();

        $this->addMediaCollection('gallery');
    }
}