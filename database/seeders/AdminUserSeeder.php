<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Change these to whatever you want for the admin login
        User::updateOrCreate(
            ['email' => 'admin@fleetflow.test'],
            [
                'name'     => 'FleetFlow Admin',
                'password' => Hash::make('password123'),
                'role'     => 'admin',
            ]
        );
    }
}
