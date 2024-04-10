<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use App\Http\Requests\StoreTransfer;
use App\Http\Requests\UpdateTransfer;

class TransferController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransfer $request)
    {
        try {
            $result = Transfer::create($request->validated());

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
    public function show(Transfer $transfer)
    {
        return response()->json([
            'status' => 'success',
            'response' => $transfer
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransfer $request, Transfer $transfer)
    {
        try {
            $transfer->update($request->validated());

            return response()->json([
                'status' => 'success',
                'response' => $transfer
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failure',
                'response' => $e->getMessage()
            ], 500);    
        }
    }
}
