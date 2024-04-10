<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Transfer;
use App\Models\BankAccount;

class TransferFactory extends Factory
{
    protected $model = Transfer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randomFromBankAccount = BankAccount::inRandomOrder()->first();
        $randomToBankAccount = BankAccount::where('id', '!=', $randomFromBankAccount->id)->inRandomOrder()->first();

        return [
            'user_id' => $randomFromBankAccount->user_id,
            'from_bank_account_id' => $randomFromBankAccount->id,
            'to_bank_account_id' => $randomToBankAccount->id,
            'transfer_amount' => $this->faker->randomFloat(2, 1, 1000),
            'state' => $this->faker->randomElement(['pending', 'completed', 'rejected'])
        ];
    }
}
