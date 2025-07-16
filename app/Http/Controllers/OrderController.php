<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->get();
        return view('orders.index', compact('orders'));
    }
    public function create()
    {
        $users = \App\Models\User::all();
        $products = \App\Models\Product::where('status', 'active')->get();
        return view('orders.create', compact('users', 'products'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);
        $order = Order::create($request->only(['user_id', 'status']));
        $qtys = $request->input('qty', []);
        foreach ($qtys as $product_id => $qty) {
            if ($qty > 0) {
                $product = \App\Models\Product::find($product_id);
                if ($product) {
                    $order->orderedItems()->create([
                        'product_id' => $product_id,
                        'quantity' => $qty,
                        'price_per_item' => $product->price,
                        'ordered_at' => now(),
                    ]);
                }
            }
        }
        return redirect()->route('orders.show', $order)
                         ->with('success', 'Order created successfully.');
    }
    public function show(Order $order)
    {
        $order->load('orderedItems.product', 'user');
        return view('orders.show', compact('order'));
    }
    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);
        $order->update($request->only('status'));
        return redirect()->route('orders.show', $order)
                         ->with('success', 'Order status updated successfully.');
    }
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')
                         ->with('success', 'Order deleted successfully.');
    }
}
