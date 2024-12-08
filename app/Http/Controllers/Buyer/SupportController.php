<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function submitTicket(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string',
        ]);

        // Logic for submitting a support ticket
        return response()->json(['message' => 'Support ticket submitted successfully']);
    }
}
