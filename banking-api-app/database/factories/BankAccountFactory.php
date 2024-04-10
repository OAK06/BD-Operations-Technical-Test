<?php 

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\BankAccount;

class BankAccountFactory extends Factory
{
    protected $model = BankAccount::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randomUser = User::inRandomOrder()->first();

        return [
            'user_id' => $randomUser->id,
            'account_type' => $this->faker->randomElement(['Current', 'Savings']),
            'balance' => $this->faker->randomFloat(2, 0, 10000),
            'currency' => 'EUR'
        ];
    }
}
