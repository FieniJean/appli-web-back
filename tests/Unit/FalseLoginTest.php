<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Database\Eloquent\Factories\Factory;
use Tests\CreatesApplication;
use App\Models\User;

class YourTestClass extends TestCase
{
    use CreatesApplication;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_login_with_missing_fields()
    {
        $response = $this->postJson('/api/login', []);

        $response->assertStatus(422);
    }

    public function test_login_with_invalid_credentials()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertStatus(401)
            ->assertJson(['message' => 'Invalid credentials.']);
    }
}
