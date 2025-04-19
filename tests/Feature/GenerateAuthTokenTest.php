<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('it generates a token for an existing user', function () {
    // Create a test user
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    // Run the command
    $this->artisan('token:generate', ['email' => 'test@example.com'])
        ->assertSuccessful();

    // Verify the token was created
    $this->assertDatabaseHas('personal_access_tokens', [
        'tokenable_type' => User::class,
        'tokenable_id' => $user->id,
        'name' => 'test-token',
    ]);
});

test('it creates a user and generates a token if user does not exist', function () {
    $email = 'newuser@example.com';

    // Verify user doesn't exist
    $this->assertDatabaseMissing('users', [
        'email' => $email,
    ]);

    // Run the command
    $this->artisan('token:generate', ['email' => $email])
        ->assertSuccessful();

    // Verify user was created
    $this->assertDatabaseHas('users', [
        'email' => $email,
        'name' => 'Test User',
    ]);

    // Get the created user
    $user = User::where('email', $email)->first();

    // Verify token was created
    $this->assertDatabaseHas('personal_access_tokens', [
        'tokenable_type' => User::class,
        'tokenable_id' => $user->id,
        'name' => 'test-token',
    ]);
});

test('it outputs the generated token', function () {
    $email = 'output@example.com';

    // Run the command and capture output
    $this->artisan('token:generate', ['email' => $email])
        ->expectsOutputToContain('Token generated successfully:')
        ->assertSuccessful();
});
