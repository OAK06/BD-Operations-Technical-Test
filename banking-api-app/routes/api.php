<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\UserBankAccountController;
use App\Http\Controllers\BankAccountTransfersController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::resource('accounts', BankAccountController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
Route::resource('transfers', TransferController::class)->only(['store', 'show', 'update']);
Route::resource('user-accounts', UserBankAccountController::class)->only(['show']);
Route::resource('history', BankAccountTransfersController::class)->only(['show']);
// Route::get('/history/{history}', [BankAccountTransfersController::class, 'show']);
