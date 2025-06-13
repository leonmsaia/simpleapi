<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Prepare a user for authentication tests
    $this->user = User::factory()->create([
        'email' => 'demo@latinad.com',
        'password' => Hash::make('12345678'),
    ]);
});

/**
 * Test Case: Successful login
 *
 * This test verifies that a user can log in using valid credentials
 * and receives a valid JWT token structure in the response.
 */
it('can login successfully', function () {
    $response = $this->postJson('/api/login', [
        'email' => 'demo@latinad.com',
        'password' => '12345678',
    ]);

    $response->assertStatus(200)
             ->assertJsonStructure([
                 'access_token',
                 'token_type',
                 'expires_in',
             ]);
});

/**
 * Test Case: Login failure with invalid credentials
 *
 * This test verifies that the system properly rejects invalid credentials
 * and returns an unauthorized response.
 */
it('cannot login with invalid credentials', function () {
    $response = $this->postJson('/api/login', [
        'email' => 'demo@latinad.com',
        'password' => 'wrong-password',
    ]);

    $response->assertStatus(401)
             ->assertJson([
                 'error' => 'Unauthorized'
             ]);
});
