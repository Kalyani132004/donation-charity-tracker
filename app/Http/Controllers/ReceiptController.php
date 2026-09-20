<?php

namespace App\Http\Controllers;

use App\Models\Donation;

class ReceiptController extends Controller
{
    public function show(Donation $donation)
    {
        $donation->load(['donor', 'cause']);

        return view('receipts.show', compact('donation'));
    }
}
