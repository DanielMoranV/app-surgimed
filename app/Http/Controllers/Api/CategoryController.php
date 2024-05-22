<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return response()->json($category, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = Category::create($validated);

        return response()->json($category, 201);
    }

    public function show($category)
    {
        return Category::where('id', $category);
        return response()->json($category, 200);
    }

    public function update(Request $request, $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return response()->json($category, 200);
    }

    public function destroy($category)
    {
        $category = Category::where('id', $category);
        $category->delete();

        return response()->json([
            'message' => 'Categoria eliminada correctamente',
        ], 200);
    }
}
