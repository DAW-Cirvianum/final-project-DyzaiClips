<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductValue;
use Illuminate\Http\Request;

/**
 * ProductValueController
 *
 * Handles CRUD operations for product offers.
 */
class ProductValueController extends Controller
{
    /**
     * Display a listing of product values.
     *
     * GET /api/product-values
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = ProductValue::with('product');

        // Filter by product if product_id is provided
        if ($request->has('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        return response()->json($query->get());
    }


    /**
     * Store a newly created product value.
     *
     * POST /api/product-values
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Display the specified product value.
     *
     * GET /api/product-values/{id}
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $value = ProductValue::with('product')->find($id);

        if (!$value) {
            return response()->json(['message' => 'Product value not found'], 404);
        }

        return response()->json($value);
    }

    /**
     * Update the specified product value.
     *
     * PUT /api/product-values/{id}
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
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

        return response()->json($value);
    }

    /**
     * Remove the specified product value.
     *
     * DELETE /api/product-values/{id}
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $value = ProductValue::find($id);

        if (!$value) {
            return response()->json(['message' => 'Product value not found'], 404);
        }

        $value->delete();

        return response()->json(['message' => 'Product value deleted successfully']);
    }
}

