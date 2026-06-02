<?php

namespace App\Services\User;

use App\Enums\RoleEnum;
use App\Models\User;

class DashboardRedirectService
{
    public function getRedirect(User $user): string
    {
        if ($user->hasRole(RoleEnum::SUPER_ADMIN->value)) {
            return 'admin.dashboard';
        }

        if ($user->hasRole(RoleEnum::OWNER->value)) {
            return 'owner.dashboard';
        }

        if ($user->hasRole(RoleEnum::WARDEN->value)) {
            return 'warden.dashboard';
        }

        return 'seeker.dashboard';
    }
}