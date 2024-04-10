<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transfer;
use App\Models\BankAccount;

class BankAccountTransfersController extends Controller
{
    // Created a separate controller to preserve the standard naming of the resource APIs.
    // The following functions could be created in their respective controllers if required by the business.

    /**
     * Display the specified resource.
     */
    public function show(BankAccount $history)
    {
        $transfers = Transfer::where('from_bank_account_id', $history->id)->orWhere('to_bank_account_id', $history->id)->get();

        return response()->json([
            'status' => 'success',
            'response' => $transfers
        ]);
    }
}
