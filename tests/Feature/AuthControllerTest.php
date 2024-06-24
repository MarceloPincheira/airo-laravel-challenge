<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testLoginOk()
    {

        // Create fake user
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);


        $response = $this->post('/api/auth/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);


        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'access_token',
                     'token_type',
                     'expires_in',
                 ]);
    }

    public function testLoginAccessDenied()
    {

        // Create fake user
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);


        $response = $this->post('/api/auth/login', [
            'email' => 'test@example.com',
            'password' => 'wrong_password',
        ]);


        $response->assertStatus(401);
    }
}
