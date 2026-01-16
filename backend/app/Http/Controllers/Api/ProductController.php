<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

/**
 * ProductController
 *
 * Handles CRUD operations for products.
 */
class ProductController extends Controller
{
    /**
     * Display a listing of products.
     *
     * GET /api/products
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $products = Product::all();

        return response()->json($products);
    }


    /**
     * Store a newly created product.
     *
     * POST /api/products
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:50',
        ]);

        $product = Product::create($validated);

        return response()->json($product, 201);
    }



    /**
     * Display the specified product.
     *
     * GET /api/products/{id}
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json($product);
    }


    /**
     * Update the specified product.
     *
     * PUT /api/products/{id}
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'type' => 'sometimes|required|string|max:50',
        ]);

        $product->update($validated);

        return response()->json($product);
    }


    /**
     * Remove the specified product.
     *
     * DELETE /api/products/{id}
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    /**
 * Remove the specified product.
 *
 * DELETE /api/products/{id}
 *
 * @param int $id
 * @return \Illuminate\Http\JsonResponse
 */
public function destroy(int $id)
{
    $product = Product::find($id);

    if (! $product) {
        return response()->json([
            'message' => 'Product not found'
        ], 404);
    }

    $product->delete();

    return response()->json([
        'message' => 'Product deleted successfully'
    ]);
}

}

