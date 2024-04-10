<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            "Arisha Barron",
            "Branden Gibson",
            "Rhonda Church",
            "Georgina Hazel"
        ];
        foreach ($users as $user) {
            User::factory()->create([ 'name' => $user ]);
        }
    }
}
