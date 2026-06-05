<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Str;

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

    // -------- Relationships --------
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function facilities(): HasMany
    {
        return $this->hasMany(HostelFacility::class);
    }

    public function rules(): HasMany
    {
        return $this->hasMany(HostelRule::class);
    }

    public function nearbyPlaces(): HasMany
    {
        return $this->hasMany(HostelNearbyPlace::class);
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    // -------- Helper Methods --------
    
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')
            ->singleFile();

        $this->addMediaCollection('featured_image')
            ->singleFile();

        $this->addMediaCollection('gallery');
    }

    protected static function booted(): void
    {
        static::creating(function ($hostel) {
            $slug = Str::slug($hostel->name);
            $count = static::where('slug', 'like', "{$slug}%")->count();
            $hostel->slug = $count ? "{$slug}-".($count + 1) : $slug;
        });
    }
}