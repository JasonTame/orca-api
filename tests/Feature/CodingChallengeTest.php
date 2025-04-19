<?php

use App\Models\CodingChallenge;
use App\Models\JobOpening;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('can list all coding challenges', function () {
    CodingChallenge::factory()->count(3)->create();

    $response = $this->getJson('/api/coding-challenges');

    $response->assertStatus(200)
        ->assertJsonCount(3)
        ->assertJsonStructure([
            '*' => [
                'id',
                'job_opening_id',
                'title',
                'description',
                'instructions',
                'repository_url',
                'time_limit',
                'difficulty',
                'created_at',
                'updated_at',
            ],
        ]);
});

test('can create a coding challenge', function () {
    $jobOpening = JobOpening::factory()->create();
    $data = [
        'job_opening_id' => $jobOpening->id,
        'title' => 'Test Challenge',
        'description' => 'Test Description',
        'instructions' => 'Test Instructions',
        'repository_url' => 'https://github.com/test/repo',
        'time_limit' => 60,
        'difficulty' => 'medium',
    ];

    $response = $this->postJson('/api/coding-challenges', $data);

    $response->assertStatus(201)
        ->assertJson($data);

    $this->assertDatabaseHas('coding_challenges', $data);
});

test('can show a coding challenge', function () {
    $codingChallenge = CodingChallenge::factory()->create();

    $response = $this->getJson("/api/coding-challenges/{$codingChallenge->id}");

    $response->assertStatus(200)
        ->assertJson([
            'id' => $codingChallenge->id,
            'title' => $codingChallenge->title,
            'description' => $codingChallenge->description,
        ]);
});

test('can update a coding challenge', function () {
    $codingChallenge = CodingChallenge::factory()->create();
    $newData = [
        'title' => 'Updated Title',
        'description' => 'Updated Description',
        'instructions' => 'Updated Instructions',
        'repository_url' => 'https://github.com/updated/repo',
        'time_limit' => 90,
        'difficulty' => 'hard',
    ];

    $response = $this->putJson("/api/coding-challenges/{$codingChallenge->id}", $newData);

    $response->assertStatus(200)
        ->assertJson($newData);

    $this->assertDatabaseHas('coding_challenges', $newData);
});

test('can delete a coding challenge', function () {
    $codingChallenge = CodingChallenge::factory()->create();

    $response = $this->deleteJson("/api/coding-challenges/{$codingChallenge->id}");

    $response->assertStatus(204);
    $this->assertDatabaseMissing('coding_challenges', ['id' => $codingChallenge->id]);
});

test('validates required fields when creating a coding challenge', function () {
    $response = $this->postJson('/api/coding-challenges', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors([
            'job_opening_id',
            'title',
            'description',
            'instructions',
            'repository_url',
            'time_limit',
            'difficulty',
        ]);
});

test('validates job opening exists when creating a coding challenge', function () {
    $data = [
        'job_opening_id' => 999,
        'title' => 'Test Challenge',
        'description' => 'Test Description',
        'instructions' => 'Test Instructions',
        'repository_url' => 'https://github.com/test/repo',
        'time_limit' => 60,
        'difficulty' => 'medium',
    ];

    $response = $this->postJson('/api/coding-challenges', $data);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['job_opening_id']);
});

test('validates difficulty enum when creating a coding challenge', function () {
    $jobOpening = JobOpening::factory()->create();
    $data = [
        'job_opening_id' => $jobOpening->id,
        'title' => 'Test Challenge',
        'description' => 'Test Description',
        'instructions' => 'Test Instructions',
        'repository_url' => 'https://github.com/test/repo',
        'time_limit' => 60,
        'difficulty' => 'invalid',
    ];

    $response = $this->postJson('/api/coding-challenges', $data);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['difficulty']);
});
