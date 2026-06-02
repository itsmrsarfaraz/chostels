<?php

namespace App\Services\User;

use App\Enums\RoleEnum;
use App\Models\User;

class DashboardRedirectService
{
    public function getRedirect(User $user): string
    {
        if ($user->hasRole(RoleEnum::SUPER_ADMIN->value)) {
            return route('admin.dashboard');
        }

        if ($user->hasRole(RoleEnum::OWNER->value)) {
            return route('owner.dashboard');
        }

        if ($user->hasRole(RoleEnum::WARDEN->value)) {
            return route('warden.dashboard');
        }

        return route('seeker.dashboard');
    }
}