<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with(['toko', 'supplier']);
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $products = $query->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tokos = \App\Models\Toko::all();
        $suppliers = \App\Models\Supplier::all();
        return view('products.create', compact('tokos', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'toko_id' => 'required|exists:tokos,id',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
            'supplier_id' => 'required|exists:suppliers,id',
            'stock' => 'required|integer|min:0',
        ]);
        Product::create($request->all());
        return redirect()->route('products.index')
                         ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $tokos = \App\Models\Toko::all();
        $suppliers = \App\Models\Supplier::all();
        return view('products.edit', compact('product', 'tokos', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'toko_id' => 'required|exists:tokos,id',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
            'supplier_id' => 'required|exists:suppliers,id',
            'stock' => 'required|integer|min:0',
        ]);
        $product->update($request->all());
        return redirect()->route('products.index')
                         ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
                         ->with('success', 'Product deleted successfully.');
    }
}
