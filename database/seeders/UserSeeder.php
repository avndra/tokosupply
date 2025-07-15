<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\City;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    public function run(): void
    {
        $surabayaCityId = City::where('name', 'Surabaya')->first()->id;
        $jakartaCityId = City::where('name', 'Jakarta')->first()->id;
        User::create([
            'username' => 'john_doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'gender' => 'male',
            'city_code' => $surabayaCityId,
        ]);
        User::create([
            'username' => 'jane_doe',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
            'gender' => 'female',
            'city_code' => $jakartaCityId,
        ]);
    }
}
