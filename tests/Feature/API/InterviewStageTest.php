<?php

use App\Enums\InterviewFormat;
use App\Models\InterviewStage;
use App\Models\JobOpening;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('can list interview stages', function () {
    InterviewStage::factory()->count(3)->create();

    $response = $this->getJson('/api/interview-stages');

    $response->assertStatus(200)
        ->assertJsonCount(3)
        ->assertJsonStructure([
            '*' => [
                'id',
                'job_opening_id',
                'name',
                'description',
                'sequence',
                'duration',
                'format',
                'is_technical',
                'created_at',
                'updated_at',
            ],
        ]);
});

test('can create interview stage', function () {
    $jobOpening = JobOpening::factory()->create();

    $data = [
        'job_opening_id' => $jobOpening->id,
        'name' => 'Technical Interview',
        'description' => 'In-depth technical assessment',
        'sequence' => 2,
        'duration' => 60,
        'format' => 'video',
        'is_technical' => true,
    ];

    $response = $this->postJson('/api/interview-stages', $data);

    $response->assertStatus(201)
        ->assertJson([
            'job_opening_id' => $data['job_opening_id'],
            'name' => $data['name'],
            'description' => $data['description'],
            'sequence' => $data['sequence'],
            'duration' => $data['duration'],
            'format' => $data['format'],
            'is_technical' => $data['is_technical'],
        ]);

    $this->assertDatabaseHas('interview_stages', [
        'job_opening_id' => $data['job_opening_id'],
        'name' => $data['name'],
        'description' => $data['description'],
        'sequence' => $data['sequence'],
        'duration' => $data['duration'],
        'format' => $data['format'],
        'is_technical' => $data['is_technical'],
    ]);
});

test('can show interview stage', function () {
    $interviewStage = InterviewStage::factory()->create();

    $response = $this->getJson("/api/interview-stages/{$interviewStage->id}");

    $response->assertStatus(200)
        ->assertJson([
            'id' => $interviewStage->id,
            'job_opening_id' => $interviewStage->job_opening_id,
            'name' => $interviewStage->name,
            'sequence' => $interviewStage->sequence,
            'duration' => $interviewStage->duration,
            'format' => $interviewStage->format,
            'is_technical' => $interviewStage->is_technical,
        ]);
});

test('can update interview stage', function () {
    $interviewStage = InterviewStage::factory()->create();

    $data = [
        'name' => 'Updated Stage Name',
        'description' => 'Updated description',
        'sequence' => 3,
        'duration' => 90,
        'format' => 'in_person',
        'is_technical' => false,
    ];

    $response = $this->putJson("/api/interview-stages/{$interviewStage->id}", $data);

    $response->assertStatus(200)
        ->assertJson([
            'name' => $data['name'],
            'description' => $data['description'],
            'sequence' => $data['sequence'],
            'duration' => $data['duration'],
            'format' => $data['format'],
            'is_technical' => $data['is_technical'],
        ]);

    $this->assertDatabaseHas('interview_stages', array_merge(['id' => $interviewStage->id], [
        'name' => $data['name'],
        'description' => $data['description'],
        'sequence' => $data['sequence'],
        'duration' => $data['duration'],
        'format' => $data['format'],
        'is_technical' => $data['is_technical'],
    ]));
});

test('can delete interview stage', function () {
    $interviewStage = InterviewStage::factory()->create();

    $response = $this->deleteJson("/api/interview-stages/{$interviewStage->id}");

    $response->assertStatus(204);
    $this->assertDatabaseMissing('interview_stages', ['id' => $interviewStage->id]);
});

test('validates required fields when creating interview stage', function () {
    $response = $this->postJson('/api/interview-stages', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['job_opening_id', 'name', 'sequence', 'duration', 'format']);
});

test('validates format enum values', function () {
    $jobOpening = JobOpening::factory()->create();

    $data = [
        'job_opening_id' => $jobOpening->id,
        'name' => 'Technical Interview',
        'sequence' => 2,
        'duration' => 60,
        'format' => 'invalid_format',
    ];

    $response = $this->postJson('/api/interview-stages', $data);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['format']);
});

test('validates sequence and duration are positive integers', function () {
    $jobOpening = JobOpening::factory()->create();

    $data = [
        'job_opening_id' => $jobOpening->id,
        'name' => 'Technical Interview',
        'sequence' => 0,
        'duration' => -30,
        'format' => 'video',
    ];

    $response = $this->postJson('/api/interview-stages', $data);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['sequence', 'duration']);
});
