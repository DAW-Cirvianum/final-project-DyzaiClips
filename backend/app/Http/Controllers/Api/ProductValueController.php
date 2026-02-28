<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductValue;
use Illuminate\Http\Request;

class ProductValueController extends Controller
{
    public function index(Request $request)
    {
        $query = ProductValue::with('product');

        if ($request->has('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        return response()->json($query->get(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'condition' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $value = ProductValue::create($validated);

        return response()->json($value, 201);
    }

    public function show(int $id)
    {
        $value = ProductValue::with('product')->find($id);

        if (!$value) {
            return response()->json(['message' => 'Product value not found'], 404);
        }

        return response()->json($value, 200);
    }

    public function update(Request $request, int $id)
    {
        $value = ProductValue::find($id);

        if (!$value) {
            return response()->json(['message' => 'Product value not found'], 404);
        }

        $validated = $request->validate([
            'condition' => 'sometimes|required|string|max:50',
            'price' => 'sometimes|required|numeric|min:0',
            'stock' => 'sometimes|required|integer|min:0',
        ]);

        $value->update($validated);

        return response()->json($value, 200);
    }

    public function destroy(int $id)
    {
        $value = ProductValue::find($id);

        if (!$value) {
            return response()->json(['message' => 'Product value not found'], 404);
        }

        $value->delete();

        return response()->json(['message' => 'Product value deleted successfully'], 200);
    }
}