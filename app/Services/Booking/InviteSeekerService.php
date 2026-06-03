<?php

namespace App\Services\Booking;

use App\Models\User;
use App\Models\SeekerProfile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class InviteSeekerService
{
    public function create(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make(Str::random(40)),
            'is_invited' => true,
        ]);

        $user->assignRole('seeker');

        SeekerProfile::create([
            'user_id' => $user->id,
            'phone' => $data['phone'],
            'cnic' => $data['cnic'],
            'gender' => $data['gender'] ?? null,
            'home_city' => $data['home_city'] ?? null,
            'current_city' => $data['current_city'] ?? null,
        ]);

        return $user;
    }
}