<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\Quotation;

use JWTAuth;

class ApiQuotationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testSaveQuotation()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        $requestData = [
            'age' => '30,40',
            'total' => 117,
            'currency_id' => 'EUR',
            'quotation_id' => 1,
            'start_date' => '2020-10-01',
            'end_date' => '2020-10-30',
        ];

        $response = $this->withHeaders([
                'Authorization' => 'Bearer '.$token,
                'Accept' => 'application/json',
            ])
            ->post('/api/quotation/save', $requestData);

        $response->assertStatus(201);

        $this->assertNotNull($response);

        $this->assertEquals($requestData['total'], round($response['quotation']['total']));
        $this->assertEquals($requestData['currency_id'], $response['quotation']['currency_id']);
        $this->assertEquals($requestData['currency_id'], $response['quotation']['currency_id']);
    }
}
