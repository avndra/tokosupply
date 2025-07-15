<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;
class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        Supplier::create([
            'name' => 'Tech Supply Co.',
            'email' => 'tech@example.com',
            'phone_number' => '081234567890',
            'address' => 'Jl. Teknologi No. 10',
        ]);
        Supplier::create([
            'name' => 'Fashion Source',
            'email' => 'fashion@example.com',
            'phone_number' => '087654321098',
            'address' => 'Jl. Gaya No. 5',
        ]);
    }
}
