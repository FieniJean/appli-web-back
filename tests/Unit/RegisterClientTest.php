<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Tests\TestCase;
use App\Models\Client;
use App\Models\User;

class RegisterTest extends TestCase
{
    use DatabaseTransactions;

    public function test_register_with_valid_data()
    {
        $data = [
            'nom_client' => 'John Doe',
            'email_client' => 'johndoe@example.com',
            'password_client' => 'Password1!',
            'password_client_confirmation' => 'Password1!'
        ];

        $response = $this->postJson('/api/clients/register', $data);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson(['message' => 'Client enregistré avec succès.']);

        $this->assertDatabaseHas('clients', ['email_client' => 'johndoe@example.com']);
    }

    public function test_register_with_invalid_data()
    {
        $data = [
            'nom_client' => '',
            'email_client' => 'invalid-email',
            'password_client' => 'password',
            'password_client_confirmation' => 'incorrect-password-confirmation'
        ];

        $response = $this->postJson('/api/clients/register', $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors([
                'nom_client',
                'email_client',
                'password_client'
            ]);

        $this->assertDatabaseMissing('clients', ['email_client' => 'invalid-email']);
    }
}
