<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\User;
use App\Models\BankAccount;
use App\Models\Transfer;

class TransferControllerTest extends TestCase
{
    use RefreshDatabase;

   
    /** @test */
    public function it_should_return_transfer_details()
    {
        $fromUser = User::factory()->create();
        $fromAccount = BankAccount::factory()->create(['user_id' => $fromUser->id]);
        $toUser = User::factory()->create();
        $toAccount = BankAccount::factory()->create(['user_id' => $toUser->id]);
        $transfer = Transfer::factory()->create([
            'user_id' => $fromUser->id,
            'from_bank_account_id' => $fromAccount->id,
            'to_bank_account_id' => $toAccount->id,
            'state' => 'pending'
        ]);

        $response = $this->get('/api/transfers/' . $transfer->id);
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
            'response' => [
                'id' => $transfer->id,
                'user_id' => $fromUser->id,
                'from_bank_account_id' => $fromAccount->id,
                'to_bank_account_id' => $toAccount->id,
                'state' => 'pending'
            ]
        ]);
    }
    
    /** @test */
    public function it_should_create_a_new_transfer()
    {   
        $fromUser = User::factory()->create();
        $fromAccount = BankAccount::factory()->create(['user_id' => $fromUser->id]);
        $toUser = User::factory()->create();
        $toAccount = BankAccount::factory()->create(['user_id' => $toUser->id]);
        
        $response = $this->post('/api/transfers', [
            'user_id' => $fromUser->id,
            'from_bank_account_id' => $fromAccount->id,
            'to_bank_account_id' => $toAccount->id,
            'transfer_amount' => 1000
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
            'response' => [
                'user_id' => $fromUser->id,
                'from_bank_account_id' => $fromAccount->id,
                'to_bank_account_id' => $toAccount->id,
                'transfer_amount' => 1000
            ]
        ]);
    }
    
    /** @test */
    public function it_should_update_an_existing_transfer_state()
    {
        $fromUser = User::factory()->create();
        $fromAccount = BankAccount::factory()->create(['user_id' => $fromUser->id]);
        $toUser = User::factory()->create();
        $toAccount = BankAccount::factory()->create(['user_id' => $toUser->id]);
        $transfer = Transfer::factory()->create([
            'user_id' => $fromUser->id,
            'from_bank_account_id' => $fromAccount->id,
            'to_bank_account_id' => $toAccount->id,
            'state' => 'pending'
        ]);

        $response = $this->put('/api/transfers/' . $transfer->id, ['state' => 'complete']);
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
            'response' => [
                'user_id' => $fromUser->id,
                'from_bank_account_id' => $fromAccount->id,
                'to_bank_account_id' => $toAccount->id,
                'state' => 'complete'
            ]
        ]);
    }
}
