<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:products,code',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'count' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $product = Product::create($validated);

        return response()->json($product, 201);
    }

    public function show($product)
    {
        $product = Product::where('code', $product);
        return response()->json($product, 200);
    }

    public function update(Request $request, $product)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:products,code,' . $product->id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'count' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $product->update($validated);

        return response()->json($product, 200);
    }

    public function destroy($product)
    {
        $product = Product::where('code', $product);
        $product->delete();

        return response()->json(['message' => 'Producto eliminado correctamente', 200]);
    }
}
