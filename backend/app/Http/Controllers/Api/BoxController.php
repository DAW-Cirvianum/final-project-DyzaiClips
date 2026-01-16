<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Box;
use Illuminate\Http\Request;

/**
 * BoxController
 *
 * Handles CRUD operations for Pokémon boxes.
 */
class BoxController extends Controller
{
    /**
     * Display a listing of boxes.
     *
     * GET /api/boxes
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $boxes = Box::with('packs')->get();

        return response()->json($boxes);
    }

    /**
     * Store a newly created box.
     *
     * POST /api/boxes
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'productions' => 'required|integer|min:0',
        ]);

        $box = Box::create($validated);

        return response()->json($box, 201);
    }

    /**
     * Display the specified box.
     *
     * GET /api/boxes/{id}
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $box = Box::with('packs')->find($id);

        if (! $box) {
            return response()->json(['message' => 'Box not found'], 404);
        }

        return response()->json($box);
    }

    /**
     * Update the specified box.
     *
     * PUT /api/boxes/{id}
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id)
    {
        $box = Box::find($id);

        if (! $box) {
            return response()->json(['message' => 'Box not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'productions' => 'sometimes|required|integer|min:0',
        ]);

        $box->update($validated);

        return response()->json($box);
    }

    /**
     * Remove the specified box.
     *
     * DELETE /api/boxes/{id}
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $box = Box::find($id);

        if (! $box) {
            return response()->json(['message' => 'Box not found'], 404);
        }

        $box->delete();

        return response()->json(['message' => 'Box deleted successfully']);
    }
}
