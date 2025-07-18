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
        $surabaya = City::where('name', 'Surabaya')->first();
        $jakarta = City::where('name', 'Jakarta')->first();

        if (!$surabaya || !$jakarta) {
            throw new \Exception('City Surabaya atau Jakarta belum ada di tabel cities. Jalankan CitySeeder dulu.');
        }

        User::create([
            'username' => 'suryo',
            'email' => 'suryo@example.com',
            'password' => Hash::make('password'),
            'gender' => 'male',
            'city_code' => $surabaya->id,
            'role' => 'user',
        ]);
        User::create([
            'username' => 'iqbal',
            'email' => 'iqbal@example.com',
            'password' => Hash::make('password'),
            'gender' => 'male',
            'city_code' => $jakarta->id,
            'role' => 'user',
        ]);

    }
}
