<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\ProductValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_value_id' => 'required|exists:product_values,id',
        ]);

        $productValue = ProductValue::findOrFail($data['product_value_id']);

        if ($productValue->stock < 1) {
            return response()->json(['message' => 'Out of stock'], 400);
        }

        $transaction = Transaction::create([
            'buyer_id' => Auth::id(),
            'seller_id' => null,
            'total_price' => $productValue->price,
            'status' => 'completed',
        ]);

        $transaction->productValues()->attach($productValue->id);

        $productValue->decrement('stock');

        return response()->json([
            'message' => 'Purchase successful',
            'transaction' => $transaction,
        ], 201);
    }

    public function myTransactions(Request $request)
    {
        $user = $request->user();

        $transactions = Transaction::with('productValues.product')
            ->where('buyer_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($transactions, 200);
    }
}
