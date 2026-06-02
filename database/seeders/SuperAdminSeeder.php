<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            [
                'email' => 'admin@seehostels.test',
            ],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
            ]
        );

        $user->assignRole(RoleEnum::SUPER_ADMIN->value);
    }
}