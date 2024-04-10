<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'from_bank_account_id',
        'to_bank_account_id',
        'transfer_amount',
        'state'
    ];
}
