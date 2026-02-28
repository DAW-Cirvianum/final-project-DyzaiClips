<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Box;
use Illuminate\Http\Request;

class BoxController extends Controller
{
    public function index()
    {
        $boxes = Box::with('packs')->get();

        return response()->json($boxes, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'productions' => 'required|integer|min:0',
        ]);

        $box = Box::create($validated);

        return response()->json($box, 201);
    }

    public function show(int $id)
    {
        $box = Box::with('packs')->find($id);

        if (! $box) {
            return response()->json(['message' => 'Box not found'], 404);
        }

        return response()->json($box, 200);
    }

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

        return response()->json($box, 200);
    }

    public function destroy(int $id)
    {
        $box = Box::find($id);

        if (! $box) {
            return response()->json(['message' => 'Box not found'], 404);
        }

        $box->delete();

        return response()->json(['message' => 'Box deleted successfully'], 200);
    }
}
