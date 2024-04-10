<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserBankAccountController extends Controller
{
    // Created a separate controller to preserve the standard naming of the resource APIs.
    // The following functions could be created in their respective controllers if required by the business.

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json([
            'status' => 'success',
            'response' => $user->load('bankAccounts')
        ]);
    }
}
