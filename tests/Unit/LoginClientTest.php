<?php

namespace Tests\Unit;

use App\Models\Client;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseTransactions;

    public function test_login_with_valid_credentials()
    {
        $client = Client::factory()->create(); // Creating a client using the factory method

        $data = [
            'email_client' => $client->email_client,
            'password_client' => 'password',
        ];

        $response = $this->postJson('/api/clients/login', $data);

        // $response->assertStatus(Response::HTTP_OK)->assertJson(['message' => 'Login successful']);
        $response->assertJson(['message' => 'Client connecté avec succès.']);
        // Add additional assertions to verify the expected behavior here
    }

    public function test_login_with_invalid_credentials()
    {
        // Create a client with a password of 'password'
        $client = Client::factory()->create([
            'password_client' => bcrypt('password'),
        ]);

        $data = [
            'email_client' => $client->email_client,
            'password_client' => 'invalid-password',
        ];

        $response = $this->postJson('/api/clients/login', $data);

        // Assert that the response returns a 401 status code
        $response->assertStatus(422);

        // Assert that the response contains an 'error' key


        $response->assertJsonStructure(['errors' => ['email_client']]);
    }
}
