<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Transfer;

class TransfersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transfer::factory(50)->create();
    }
}
