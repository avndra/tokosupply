<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $jane = User::where('username', 'jane_doe')->first();
        Order::create([
            'user_id' => $jane->id,
            'status' => 'pending',
        ]);
    }
}
