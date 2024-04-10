<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\User;
use App\Models\BankAccount;

class BankAccountControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_return_a_list_of_accounts()
    {
        $user = User::factory()->create();
        $accounts = BankAccount::factory(2)->create(['user_id' => $user->id]);
        $response = $this->get('/api/accounts');
        $response->assertStatus(200);
        $response->assertJsonCount(2, 'response');
    }

    /** @test */
    public function it_should_return_account_details()
    {
        $user = User::factory()->create();
        $account = BankAccount::factory()->create(['user_id' => $user->id]);
        $response = $this->get('/api/accounts/' . $account->id);
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
            'response' => [
                'id' => $account->id,
                'user_id' => $user->id
            ]
        ]);
    }
    
    /** @test */
    public function it_should_create_a_new_account()
    {   
        $user = User::factory()->create();
        $response = $this->post('/api/accounts', [
            'user_id' => $user->id,
            'account_type' => 'Current',
            'balance' => 1000,
            'currency' => 'EUR'
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
            'response' => [
                'user_id' => $user->id,
                'account_type' => 'Current',
                'balance' => 1000,
                'currency' => 'EUR'
            ]
        ]);
    }
    
    /** @test */
    public function it_should_update_an_existing_account()
    {
        $user = User::factory()->create();
        $account = BankAccount::factory()->create(['user_id' => $user->id]);
        $response = $this->put('/api/accounts/' . $account->id, ['balance' => 10]);
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
            'response' => ['balance' => 10]
        ]);
    }
}
