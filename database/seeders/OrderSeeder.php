<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderedItem;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('ordered_items')->truncate();
        DB::table('orders')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $products = Product::inRandomOrder()->take(3)->get();

        $order = Order::create([
            'user_id' => 1,
            'status' => 'pending',
        ]);

        foreach ($products as $product) {
            OrderedItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => 1,
                'price_per_item' => $product->price,
                'ordered_at' => now(),
            ]);
        }
    }
}
