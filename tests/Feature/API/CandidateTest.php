<?php

use App\Models\Candidate;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('can list all candidates', function () {
    Candidate::factory()->count(3)->create();

    $response = $this->getJson('/api/candidates');

    $response->assertStatus(200)
        ->assertJsonCount(3)
        ->assertJsonStructure([
            '*' => [
                'id',
                'first_name',
                'last_name',
                'email',
                'phone',
                'location',
                'resume_url',
                'portfolio_url',
                'linkedin_url',
                'years_experience',
                'current_position',
                'current_company',
                'desired_salary',
                'source',
                'notes',
                'status',
                'created_at',
                'updated_at',
            ],
        ]);
});

test('can create a candidate', function () {
    $candidateData = [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john.doe@example.com',
        'phone' => '1234567890',
        'location' => 'New York',
        'years_experience' => 5,
        'current_position' => 'Senior Developer',
        'current_company' => 'Tech Corp',
        'desired_salary' => 100000,
        'source' => 'linkedin',
        'status' => 'active',
    ];

    $response = $this->postJson('/api/candidates', $candidateData);

    $response->assertStatus(201)
        ->assertJson($candidateData);

    $this->assertDatabaseHas('candidates', $candidateData);
});

test('can show a candidate', function () {
    $candidate = Candidate::factory()->create();

    $response = $this->getJson("/api/candidates/{$candidate->id}");

    $response->assertStatus(200)
        ->assertJson($candidate->toArray());
});

test('can update a candidate', function () {
    $candidate = Candidate::factory()->create();
    $updateData = [
        'first_name' => 'Updated',
        'last_name' => 'Name',
        'email' => 'updated@example.com',
    ];

    $response = $this->putJson("/api/candidates/{$candidate->id}", $updateData);

    $response->assertStatus(200)
        ->assertJson($updateData);

    $this->assertDatabaseHas('candidates', $updateData);
});

test('can delete a candidate', function () {
    $candidate = Candidate::factory()->create();

    $response = $this->deleteJson("/api/candidates/{$candidate->id}");

    $response->assertStatus(204);
    $this->assertDatabaseMissing('candidates', ['id' => $candidate->id]);
});

test('validates required fields when creating a candidate', function () {
    $response = $this->postJson('/api/candidates', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['first_name', 'last_name', 'email']);
});

test('validates email uniqueness when creating a candidate', function () {
    $existingCandidate = Candidate::factory()->create();

    $response = $this->postJson('/api/candidates', [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => $existingCandidate->email,
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email']);
});

test('validates numeric fields', function () {
    $response = $this->postJson('/api/candidates', [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john@example.com',
        'years_experience' => 'not-a-number',
        'desired_salary' => 'not-a-number',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['years_experience', 'desired_salary']);
});

test('validates enum fields', function () {
    $response = $this->postJson('/api/candidates', [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john@example.com',
        'source' => 'invalid-source',
        'status' => 'invalid-status',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['source', 'status']);
});
