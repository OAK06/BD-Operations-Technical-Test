<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\BankAccount;

class BankAccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BankAccount::factory(8)->create();
    }
}