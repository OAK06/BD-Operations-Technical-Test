<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class BankAccount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'account_number',
        'account_type',
        'iban',
        'balance',
        'blocked_amount',
        'currency',
        'state'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<int, string>
     */
    protected $dates = ['deleted_at']; // We could also use casts to modify the date format retireved from the model.

    // Define the one-to-many relationship with Transfer model
    public function transfers()
    {
        // This relation could be split into seperate sent and recieved transfers.
        // However that would require an added sort operation when merging the 2 datasets if needed for a page that shows both.
        return Transfer::where(function ($query) {
            $query->where('from_bank_account_id', $this->id)
                ->orWhere('to_bank_account_id', $this->id);
        })->get();

    }

    // Override the boot method to generate a unique account number before saving
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Generate a random unique account number
            do {
                $accountNumber = Str::random(10); // Adjust this based on business requirement
            } while (static::where('account_number', $accountNumber)->exists());

            // Generate a random unique IBAN-like string
            do {
                $iban = 'XX' . Str::random(2) . 'ZZZZ' . Str::random(12); // Adjust this based on business requirement
            } while (static::where('iban', $iban)->exists());

            $model->account_number = $accountNumber;
            $model->iban = $iban;
        });
    }
}
