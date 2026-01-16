<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Card;
use Illuminate\Http\Request;

/**
 * CardController
 *
 * Handles CRUD operations for Pokémon cards.
 */
class CardController extends Controller
{
    /**
     * Display a listing of cards.
     *
     * GET /api/cards
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $cards = Card::with('pack')->get();

        return response()->json($cards);
    }

    /**
     * Store a newly created card.
     *
     * POST /api/cards
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'collection' => 'required|string|max:255',
            'status' => 'required|string|max:50',
            'productions' => 'required|integer|min:0',
            'pack_id' => 'required|exists:packs,id',
        ]);

        $card = Card::create($validated);

        return response()->json($card, 201);
    }

    /**
     * Display the specified card.
     *
     * GET /api/cards/{id}
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $card = Card::with('pack')->find($id);

        if (! $card) {
            return response()->json(['message' => 'Card not found'], 404);
        }

        return response()->json($card);
    }

    /**
     * Update the specified card.
     *
     * PUT /api/cards/{id}
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id)
    {
        $card = Card::find($id);

        if (! $card) {
            return response()->json(['message' => 'Card not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric|min:0',
            'collection' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|required|string|max:50',
            'productions' => 'sometimes|required|integer|min:0',
            'pack_id' => 'sometimes|required|exists:packs,id',
        ]);

        $card->update($validated);

        return response()->json($card);
    }

    /**
     * Remove the specified card.
     *
     * DELETE /api/cards/{id}
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $card = Card::find($id);

        if (! $card) {
            return response()->json(['message' => 'Card not found'], 404);
        }

        $card->delete();

        return response()->json(['message' => 'Card deleted successfully']);
    }
}

