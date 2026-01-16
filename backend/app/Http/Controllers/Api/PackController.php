<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pack;
use Illuminate\Http\Request;

/**
 * PackController
 *
 * Handles CRUD operations for Pokémon packs.
 */
class PackController extends Controller
{
    /**
     * Display a listing of packs.
     *
     * GET /api/packs
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $packs = Pack::with('box')->get();

        return response()->json($packs);
    }

    /**
     * Store a newly created pack.
     *
     * POST /api/packs
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'productions' => 'required|integer|min:0',
            'box_id' => 'required|exists:boxes,id',
        ]);

        $pack = Pack::create($validated);

        return response()->json($pack, 201);
    }

    /**
     * Display the specified pack.
     *
     * GET /api/packs/{id}
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $pack = Pack::with(['box', 'cards'])->find($id);

        if (! $pack) {
            return response()->json(['message' => 'Pack not found'], 404);
        }

        return response()->json($pack);
    }

    /**
     * Update the specified pack.
     *
     * PUT /api/packs/{id}
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id)
    {
        $pack = Pack::find($id);

        if (! $pack) {
            return response()->json(['message' => 'Pack not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric|min:0',
            'productions' => 'sometimes|required|integer|min:0',
            'box_id' => 'sometimes|required|exists:boxes,id',
        ]);

        $pack->update($validated);

        return response()->json($pack);
    }

    /**
     * Remove the specified pack.
     *
     * DELETE /api/packs/{id}
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $pack = Pack::find($id);

        if (! $pack) {
            return response()->json(['message' => 'Pack not found'], 404);
        }

        $pack->delete();

        return response()->json(['message' => 'Pack deleted successfully']);
    }
}
