<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\Quotation;

class ApiQuotationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testSaveQuotation()
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->accessToken;

        $requestData = [
            'total' => 117,
            'currency_id' => 'EUR',
            'quotation_id' => 1,
        ];

        $response = $this->withHeaders([
                'Authorization' => 'Bearer '.$token,
                'Accept' => 'application/json',
            ])
            ->post('/api/quotation/save', $requestData);

        $response->assertStatus(201)
                 ->assertJson([
                     'quotation' => [
                         'total' => $requestData['total'],
                         'currency_id' => $requestData['currency_id'],
                         'quotation_id' => $requestData['quotation_id'],
                     ],
                 ]);

        // $quotation = Quotation::find($response['quotation']['quotation_id']);
        // $this->assertNotNull($quotation);
        // $this->assertEquals($requestData['total'], $quotation->total);
        // $this->assertEquals($requestData['currency_id'], $quotation->currency_id);
    }
}
