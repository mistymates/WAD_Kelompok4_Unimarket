<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function getTransactions()
    {
        $transactions = Transaction::where('seller_id', auth()->id())->get();
        return response()->json($transactions);
    }

    public function updateTransactionStatus(Request $request, $transactionId)
    {
        $validated = $request->validate([
            'status' => 'required|string',
        ]);

        $transaction = Transaction::where('id', $transactionId)
            ->where('seller_id', auth()->id())
            ->firstOrFail();

        $transaction->update(['status' => $validated['status']]);

        return response()->json(['transaction' => $transaction, 'message' => 'Transaction status updated']);
    }
}
