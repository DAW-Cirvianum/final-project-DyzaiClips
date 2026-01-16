<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\ProductValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Handles user transactions (purchases)
 */
class TransactionController extends Controller
{
    /**
     * Store a new transaction (buy a product value)
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_value_id' => 'required|exists:product_values,id',
        ]);

        $productValue = ProductValue::findOrFail($data['product_value_id']);

        // Check stock
        if ($productValue->stock < 1) {
            return response()->json([
                'message' => 'Out of stock'
            ], 400);
        }

        // Create transaction
        $transaction = Transaction::create([
            'buyer_id' => Auth::id(),
            'seller_id' => null,
            'total_price' => $productValue->price,
            'status' => 'completed',
        ]);

        // Attach product value to transaction (pivot table)
        $transaction->productValues()->attach($productValue->id);

        // Decrease stock
        $productValue->decrement('stock');

        return response()->json([
            'message' => 'Purchase successful',
            'transaction' => $transaction,
        ], 201);
    }

    /**
     * Get authenticated user's purchases
     */
    public function myTransactions(Request $request)
    {
        $user = $request->user();

        return Transaction::with('productValues.product')
            ->where('buyer_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}

