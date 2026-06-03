<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements HasMedia
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use InteractsWithMedia;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function ownerProfile()
    {
        return $this->hasOne(OwnerProfile::class);
    }

    public function seekerProfile()
    {
        return $this->hasOne(SeekerProfile::class);
    }

    public function hostels()
    {
        return $this->hasMany(Hostel::class, 'owner_id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'seeker_id');
    }

    // ------ Media Library ------
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->singleFile();
    }

    // ------ Helper Methods ------
    public function hasCompletedOnboarding(): bool
    {
        return ! is_null($this->password_set_at);
    }

    public function isInvited(): bool
    {
        return $this->is_invited;
    }

    public function hasSetPassword(): bool
    {
        return ! is_null($this->password_set_at);
    }
}
