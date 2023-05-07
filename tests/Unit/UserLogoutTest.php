<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;

use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\Concerns;

class UserLogoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_it_logs_out_user_and_deletes_access_tokens()
    {
        // Create a user and generate an access token for the user
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        // Send a logout request as the authenticated user
        $response = $this->actingAs($user)
            ->postJson('/api/logout');

        // Assert that the user's access tokens have been deleted
        $this->assertCount(0, $user->tokens);

        // Assert that the response has a 200 status code
        $response->assertStatus(200);
    }
}
