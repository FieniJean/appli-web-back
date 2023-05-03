<?php

namespace Tests\Unit;

use App\Models\Client;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;

use Tests\TestCase;

class LogoutClientTest extends TestCase
{
    // Use database transactions to ensure tests are isolated from each other
    use DatabaseTransactions;

    public function test_logout()
    {
        // Create a client using the Client model factory
        $client = Client::factory()->create();

        // Use Sanctum to act as the created client and create an access token
        Sanctum::actingAs($client, ['*']); // Utiliser '*' pour tous les guards

        // Send a JSON post request to the logout endpoint
        $response = $this->postJson('/api/clients/logout');

        // Assert that the response returns a 200 status code
        $response->assertStatus(200);

        // Assert that the response contains a 'message' key with value 'Successfully logged out'
        $response->assertJson(['message' => 'Client déconnecté avec succès.']);
    }
}
