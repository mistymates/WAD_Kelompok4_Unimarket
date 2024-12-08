<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // List all products belonging to the authenticated seller
        $products = Product::where('seller_id', auth()->id())->get();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $product = Product::create([
            'seller_id' => auth()->id(),
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
        ]);

        return response()->json(['product' => $product, 'message' => 'Product created successfully']);
    }

    public function update(Request $request, $productId)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric|min:0',
            'stock' => 'sometimes|integer|min:0',
        ]);

        $product = Product::where('id', $productId)
            ->where('seller_id', auth()->id())
            ->firstOrFail();

        $product->update($validated);

        return response()->json(['product' => $product, 'message' => 'Product updated successfully']);
    }

    public function delete($productId)
    {
        $product = Product::where('id', $productId)
            ->where('seller_id', auth()->id())
            ->firstOrFail();

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
