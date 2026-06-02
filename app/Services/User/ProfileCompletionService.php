<?php

namespace App\Services\User;

use App\Models\User;

class ProfileCompletionService
{
    public function isOwnerProfileComplete(User $user): bool
    {
        return (bool) $user->ownerProfile;
    }

    public function isSeekerProfileComplete(User $user): bool
    {
        return (bool) $user->seekerProfile;
    }
}