<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;
class CitySeeder extends Seeder
{
    public function run(): void
    {
        City::create(['name' => 'Surabaya']);
        City::create(['name' => 'Jakarta']);
        City::create(['name' => 'Bandung']);
        City::create(['name' => 'Medan']);
    }
}
