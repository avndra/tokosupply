<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Toko;
use App\Models\Supplier;
class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $tokoJohn = Toko::where('name_toko', 'Toko John Surabaya')->first();
        $techSupplier = Supplier::where('name', 'Tech Supply Co.')->first();
        Product::create([
            'name' => 'Laptop Gaming',
            'toko_id' => $tokoJohn->id,
            'price' => 15000000,
            'status' => 'available',
            'supplier_id' => $techSupplier->id,
            'stock' => 10,
        ]);
        Product::create([
            'name' => 'Smartphone Terbaru',
            'toko_id' => $tokoJohn->id,
            'price' => 8000000,
            'status' => 'available',
            'supplier_id' => $techSupplier->id,
            'stock' => 25,
        ]);
    }
}
