<?php

use App\Models\User;
use App\Models\Display;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Create an authenticated user
    $this->user = User::factory()->create([
        'email' => 'demo@latinad.com',
        'password' => Hash::make('12345678'),
    ]);

    // Authenticate user before each request
    $this->actingAs($this->user, 'api');
});

/**
 * Test Case: Can create a new display
 */
it('can create a display', function () {
    $payload = [
        'name' => 'Test Display',
        'description' => 'Testing display creation',
        'price_per_day' => 150.00,
        'resolution_height' => 1080,
        'resolution_width' => 1920,
        'type' => 'indoor',
    ];

    $response = $this->postJson('/api/displays', $payload);

    $response->assertStatus(201)
             ->assertJsonFragment(['name' => 'Test Display']);

    $this->assertDatabaseHas('displays', ['name' => 'Test Display']);
});

/**
 * Test Case: Can list displays
 */
it('can list displays', function () {
    Display::factory()->count(3)->create(['user_id' => $this->user->id]);

    $response = $this->getJson('/api/displays');

    $response->assertJsonStructure([
        'data',
        'current_page',
        'last_page',
        'per_page',
        'total'
    ]);
});

/**
 * Test Case: Can get a display by ID
 */
it('can get a display details', function () {
    $display = Display::factory()->create(['user_id' => $this->user->id]);

    $response = $this->getJson("/api/displays/{$display->id}");

    $response->assertStatus(200)
             ->assertJsonFragment(['id' => $display->id]);
});

/**
 * Test Case: Can update a display
 */
it('can update a display', function () {
    $display = Display::factory()->create(['user_id' => $this->user->id]);

    $update = [
        'name' => 'Updated Name',
        'description' => 'Updated Description',
        'price_per_day' => 200.00,
        'resolution_height' => 1440,
        'resolution_width' => 2560,
        'type' => 'outdoor',
    ];

    $response = $this->putJson("/api/displays/{$display->id}", $update);

    $response->assertStatus(200)
             ->assertJsonFragment(['name' => 'Updated Name']);

    $this->assertDatabaseHas('displays', ['name' => 'Updated Name']);
});

/**
 * Test Case: Can delete a display
 */
it('can delete a display', function () {
    $display = Display::factory()->create(['user_id' => $this->user->id]);

    $response = $this->deleteJson("/api/displays/{$display->id}");

    $response->assertStatus(204);

    $this->assertDatabaseMissing('displays', ['id' => $display->id]);
});

/**
 * Test Case: Cannot access another user's display
 */
it('cannot access displays owned by another user', function () {
    $otherUser = User::factory()->create();
    $display = Display::factory()->create(['user_id' => $otherUser->id]);

    $response = $this->getJson("/api/displays/{$display->id}");

    $response->assertStatus(403);
});
