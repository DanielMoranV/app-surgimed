<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InventoryMovement;
use Illuminate\Http\Request;

class InventoryMovementController extends Controller
{
    public function index()
    {
        $inventoryMovement = InventoryMovement::all();
        return response()->json($inventoryMovement, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'count' => 'required|integer',
            'date' => 'required|date',
            'comment' => 'required|string|max:255',
        ]);

        $inventoryMovement = InventoryMovement::create($validated);

        return response()->json($inventoryMovement, 201);
    }

    public function show(InventoryMovement $inventoryMovement)
    {
        return $inventoryMovement;
    }

    public function update(Request $request, InventoryMovement $inventoryMovement)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'count' => 'required|integer',
            'date' => 'required|date',
            'comment' => 'required|string|max:255',
        ]);

        $inventoryMovement->update($validated);

        return response()->json($inventoryMovement);
    }

    public function destroy(InventoryMovement $inventoryMovement)
    {
        $inventoryMovement->delete();

        return response()->json(null, 204);
    }
}
