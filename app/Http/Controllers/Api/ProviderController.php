<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index()
    {
        $provider = Provider::all();
        return response()->json($provider, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $provider = Provider::create($validated);

        return response()->json($provider, 201);
    }

    public function show($provider)
    {
        return Provider::where('id', $provider);
        return response()->json($provider, 200);
    }

    public function update(Request $request, $provider)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $provider->update($validated);

        return response()->json($provider, 200);
    }

    public function destroy($provider)
    {
        $provider = Provider::where('id', $provider);
        $provider->delete();

        return response()->json([
            'message' => 'Categoria eliminada correctamente',
        ], 200);
    }
}
