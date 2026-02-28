<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index()
    {
        $cards = Card::with('pack')->get()->map(function ($card) {
            $card->image_url = $card->image ? asset('storage/' . $card->image) : null;
            return $card;
        });

        return response()->json($cards, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'collection' => 'required|string|max:255',
            'status' => 'required|string|max:50',
            'productions' => 'required|integer|min:0',
            'pack_id' => 'required|exists:packs,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('cards', 'public');
            $validated['image'] = $path;
        }

        $card = Card::create($validated);

        return response()->json($card, 201);
    }

    public function show(int $id)
    {
        $card = Card::with('pack')->find($id);

        if (!$card) {
            return response()->json(['message' => 'Card not found'], 404);
        }

        $card->image_url = $card->image ? asset('storage/' . $card->image) : null;

        return response()->json($card, 200);
    }

    public function update(Request $request, int $id)
    {
        $card = Card::find($id);

        if (!$card) {
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

        if ($request->hasFile('image')) {
            if ($card->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($card->image);
            }
            $path = $request->file('image')->store('cards', 'public');
            $card->image = $path;
        }

        $card->update($validated);

        return response()->json($card, 200);
    }

    public function destroy(int $id)
    {
        $card = Card::find($id);

        if (!$card) {
            return response()->json(['message' => 'Card not found'], 404);
        }

        $card->delete();

        return response()->json(['message' => 'Card deleted successfully'], 200);
    }
}