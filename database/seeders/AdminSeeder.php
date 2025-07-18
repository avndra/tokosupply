<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@example.com',
            ],
            [
                'username' => 'admin',
                'password' => Hash::make('password'),
                'gender' => 'male',
                'city_code' => 1, // Pastikan city dengan id 1 ada
                'role' => 'admin',
            ]
        );
    }
}
