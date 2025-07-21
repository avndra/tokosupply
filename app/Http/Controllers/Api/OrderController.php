<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderedItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderController extends Controller
{
    // GET /api/orders (user only)
    public function userIndex(Request $request)
    {
        $orders = Order::with('orderedItems.product')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json($orders);
    }

    // GET /api/orders/{id}
    public function detail($id, Request $request)
    {
        $order = Order::with('orderedItems.product')
            ->where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        return response()->json($order);
    }

    // POST /api/checkout
    public function checkout(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
        ]);

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => $request->user()->id,
                'status' => 'pending'
            ]);

            foreach ($request->items as $item) {
                OrderedItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'ordered_at' => Carbon::now(),
                ]);
            }

            DB::commit();
            return response()->json([
                'message' => 'Checkout berhasil',
                'order_id' => $order->id
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // GET /api/admin/orders
    public function adminIndex()
    {
        $orders = Order::with(['user', 'orderedItems.product'])->latest()->get();
        return response()->json($orders);
    }

    // PUT /api/admin/orders/{id}/status
    public function updateStatus($id, Request $request)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,done'
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return response()->json(['message' => 'Status updated', 'status' => $order->status]);
    }
}
