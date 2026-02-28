<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pack;
use Illuminate\Http\Request;

class PackController extends Controller
{
    public function index()
    {
        $packs = Pack::with('box')->get();

        return response()->json($packs, 200);
    }

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

    public function show(int $id)
    {
        $pack = Pack::with(['box', 'cards'])->find($id);

        if (! $pack) {
            return response()->json(['message' => 'Pack not found'], 404);
        }

        return response()->json($pack, 200);
    }

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

        return response()->json($pack, 200);
    }

    public function destroy(int $id)
    {
        $pack = Pack::find($id);

        if (! $pack) {
            return response()->json(['message' => 'Pack not found'], 404);
        }

        $pack->delete();

        return response()->json(['message' => 'Pack deleted successfully'], 200);
    }
}
