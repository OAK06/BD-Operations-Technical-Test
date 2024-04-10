<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Http\Requests\StoreBankAccount;
use App\Http\Requests\UpdateBankAccount;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'response' => BankAccount::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBankAccount $request)
    {
        try {
            $result = BankAccount::create($request->validated());

            return response()->json([
                'status' => 'success',
                'response' => $result
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failure',
                'response' => $e->getMessage()
            ], 500);    
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BankAccount $account)
    {
        return response()->json([
            'status' => 'success',
            'response' => $account
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBankAccount $request, BankAccount $account)
    {
        try {
            $account->update($request->validated());

            return response()->json([
                'status' => 'success',
                'response' => $account
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failure',
                'response' => $e->getMessage()
            ], 500);    
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BankAccount $account)
    {
        try {
            $account->update(['state' => 'closed']);
            $account->delete();

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failure',
                'response' => $e->getMessage()
            ], 500);    
        }
    }
}
