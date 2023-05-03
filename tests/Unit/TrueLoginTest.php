<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Factory as Faker;
use App\Models\User;

class TrueLoginTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * Test that a user can log in with valid credentials.
     *
     * @return void
     */
    public function test_login_with_valid_credentials()
    {
        // Create a new user with a random password
        $password = \Illuminate\Support\Str::random(10);
        $user = User::factory()->create([
            'password' => bcrypt($password),
        ]);

        // Send a POST request to /api/login with the user's email and password
        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        // Assert that the response was successful and contains a message and token
        $response->assertOk()
            ->assertJsonStructure(['message', 'token']);
    }
}
