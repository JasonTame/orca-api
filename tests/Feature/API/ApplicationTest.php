<?php

use App\Models\Application;
use App\Models\Candidate;
use App\Models\InterviewStage;
use App\Models\JobOpening;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('can list applications', function () {
    Application::factory()->count(3)->create();

    $response = $this->getJson('/api/applications');

    $response->assertStatus(200)
        ->assertJsonCount(3)
        ->assertJsonStructure([
            '*' => [
                'id',
                'job_opening_id',
                'candidate_id',
                'status',
                'created_at',
                'updated_at',
            ],
        ]);
});

test('can create application', function () {
    $jobOpening = JobOpening::factory()->create();
    $candidate = Candidate::factory()->create();
    $stage = InterviewStage::factory()->create(['job_opening_id' => $jobOpening->id]);

    $data = [
        'job_opening_id' => $jobOpening->id,
        'candidate_id' => $candidate->id,
        'status' => 'pending',
        'current_stage_id' => $stage->id,
        'notes' => 'Test application',
    ];

    $response = $this->postJson('/api/applications', $data);

    $response->assertStatus(201)
        ->assertJson($data);

    $this->assertDatabaseHas('applications', $data);
});

test('can show application', function () {
    $application = Application::factory()->create();

    $response = $this->getJson("/api/applications/{$application->id}");

    $response->assertStatus(200)
        ->assertJson([
            'id' => $application->id,
            'job_opening_id' => $application->job_opening_id,
            'candidate_id' => $application->candidate_id,
        ]);
});

test('can update application', function () {
    $application = Application::factory()->create();
    $newStage = InterviewStage::factory()->create(['job_opening_id' => $application->job_opening_id]);

    $data = [
        'status' => 'reviewing',
        'current_stage_id' => $newStage->id,
        'notes' => 'Updated notes',
    ];

    $response = $this->putJson("/api/applications/{$application->id}", $data);

    $response->assertStatus(200)
        ->assertJson($data);

    $this->assertDatabaseHas('applications', array_merge(['id' => $application->id], $data));
});

test('can delete application', function () {
    $application = Application::factory()->create();

    $response = $this->deleteJson("/api/applications/{$application->id}");

    $response->assertStatus(204);
    $this->assertDatabaseMissing('applications', ['id' => $application->id]);
});

test('validates required fields when creating application', function () {
    $response = $this->postJson('/api/applications', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['job_opening_id', 'candidate_id', 'status']);
});

test('validates status enum values', function () {
    $jobOpening = JobOpening::factory()->create();
    $candidate = Candidate::factory()->create();

    $data = [
        'job_opening_id' => $jobOpening->id,
        'candidate_id' => $candidate->id,
        'status' => 'invalid_status',
    ];

    $response = $this->postJson('/api/applications', $data);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['status']);
});
