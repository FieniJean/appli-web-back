<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;

use Tests\TestCase;


class LogoutTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test that a user can log out successfully.
     *
     * @return void
     */
    public function test_logout()
    {
        // Given a logged in user with a token
        $user = \App\Models\User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;
        $headers = [
            'Authorization' => "Bearer $token",
            'Accept' => 'application/json'
        ];

        // When they log out
        $response = $this->postJson('/api/logout', [], $headers);

        // Then they should no longer have any tokens associated with their account
        $this->assertCount(0, $user->tokens);

        // And they should receive a success response with the correct message
        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'message' => 'User logged out successfully.'
            ]);
    }
}
