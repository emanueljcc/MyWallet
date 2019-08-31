<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Wallet;
use App\Transfer;

class WalletTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetWallet()
    {
        $wallet = factory(Wallet::class)->create();
        $transfers = factory(Transfer::class, 3)->create([
            'wallet_id' => $wallet->id
        ]);

        $response = $this->json('GET','/api/wallet');

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'id', 'money','transfers' => [
                        '*' => [
                            'id','amount','description','wallet_id'
                        ]
                    ]
                ]);

        $this->assertCount(3, $response->json()['transfers']);
        
    }
}
