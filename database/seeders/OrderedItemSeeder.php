<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrderedItem;
use App\Models\Order;
use App\Models\Product;
class OrderedItemSeeder extends Seeder
{
    public function run(): void
    {
        $order = Order::first(); // Ambil order pertama
        $laptop = Product::where('name', 'Laptop Gaming')->first();
        OrderedItem::create([
            'order_id' => $order->id,
            'product_id' => $laptop->id,
            'quantity' => 1,
            'price_per_item' => $laptop->price,
            'ordered_at' => now(),
        ]);
    }
}
