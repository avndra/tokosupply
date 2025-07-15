<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Toko;
use App\Models\User;
use App\Models\City;
class TokoSeeder extends Seeder
{
    public function run(): void
    {
        $john = User::where('username', 'john_doe')->first();
        $surabayaCityId = City::where('name', 'Surabaya')->first()->id;
        Toko::create([
            'owner_id' => $john->id,
            'name_toko' => 'Toko John Surabaya',
            'city_code' => $surabayaCityId,
        ]);
    }
}
