<?php

use App\Models\Application;
use App\Models\CompanyMember;
use App\Models\Interview;
use App\Models\InterviewStage;
use App\Models\JobOpening;
use App\Models\User;

test('can list interviews', function () {
    $user = User::factory()->create();
    Interview::factory()->count(3)->create();

    $response = $this->actingAs($user)->getJson('/api/interviews');

    $response->assertStatus(200)
        ->assertJsonCount(3)
        ->assertJsonStructure([
            '*' => [
                'id',
                'application_id',
                'stage_id',
                'interviewer_id',
                'scheduled_at',
                'status',
                'created_at',
                'updated_at',
            ],
        ]);
});

test('can create interview', function () {
    $user = User::factory()->create();
    $jobOpening = JobOpening::factory()->create();
    $application = Application::factory()->create(['job_opening_id' => $jobOpening->id]);
    $stage = InterviewStage::factory()->create(['job_opening_id' => $jobOpening->id]);
    $interviewer = CompanyMember::factory()->create();

    $scheduledAt = now()->addDays(1);
    $data = [
        'application_id' => $application->id,
        'stage_id' => $stage->id,
        'interviewer_id' => $interviewer->id,
        'scheduled_at' => $scheduledAt->format('Y-m-d H:i:s'),
        'status' => 'scheduled',
        'location' => 'Conference Room A',
        'notes' => 'Technical interview focusing on backend skills',
    ];

    $response = $this->actingAs($user)->postJson('/api/interviews', $data);

    $response->assertStatus(201)
        ->assertJson([
            'application_id' => $data['application_id'],
            'stage_id' => $data['stage_id'],
            'interviewer_id' => $data['interviewer_id'],
            'status' => $data['status'],
            'location' => $data['location'],
            'notes' => $data['notes'],
        ]);

    $this->assertDatabaseHas('interviews', [
        'application_id' => $data['application_id'],
        'stage_id' => $data['stage_id'],
        'interviewer_id' => $data['interviewer_id'],
        'status' => $data['status'],
        'location' => $data['location'],
        'notes' => $data['notes'],
    ]);
});

test('can show interview', function () {
    $user = User::factory()->create();
    $interview = Interview::factory()->create();

    $response = $this->actingAs($user)->getJson("/api/interviews/{$interview->id}");

    $response->assertStatus(200)
        ->assertJson([
            'id' => $interview->id,
            'application_id' => $interview->application_id,
            'stage_id' => $interview->stage_id,
            'interviewer_id' => $interview->interviewer_id,
        ]);
});

test('can update interview', function () {
    $user = User::factory()->create();
    $interview = Interview::factory()->create();

    $completedAt = now();
    $data = [
        'status' => 'completed',
        'completed_at' => $completedAt->format('Y-m-d H:i:s'),
        'technical_score' => 4,
        'cultural_score' => 5,
        'feedback' => 'Excellent technical skills and cultural fit',
        'decision' => 'proceed',
    ];

    $response = $this->actingAs($user)->putJson("/api/interviews/{$interview->id}", $data);

    $response->assertStatus(200)
        ->assertJson([
            'status' => $data['status'],
            'technical_score' => $data['technical_score'],
            'cultural_score' => $data['cultural_score'],
            'feedback' => $data['feedback'],
            'decision' => $data['decision'],
        ]);

    $this->assertDatabaseHas('interviews', array_merge(['id' => $interview->id], [
        'status' => $data['status'],
        'technical_score' => $data['technical_score'],
        'cultural_score' => $data['cultural_score'],
        'feedback' => $data['feedback'],
        'decision' => $data['decision'],
    ]));
});

test('can delete interview', function () {
    $user = User::factory()->create();
    $interview = Interview::factory()->create();

    $response = $this->actingAs($user)->deleteJson("/api/interviews/{$interview->id}");

    $response->assertStatus(204);
    $this->assertDatabaseMissing('interviews', ['id' => $interview->id]);
});

test('validates required fields when creating interview', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->postJson('/api/interviews', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['application_id', 'stage_id', 'interviewer_id', 'scheduled_at', 'status']);
});

test('validates status enum values', function () {
    $user = User::factory()->create();
    $application = Application::factory()->create();
    $stage = InterviewStage::factory()->create();
    $interviewer = CompanyMember::factory()->create();

    $data = [
        'application_id' => $application->id,
        'stage_id' => $stage->id,
        'interviewer_id' => $interviewer->id,
        'scheduled_at' => now()->addDays(1)->format('Y-m-d H:i:s'),
        'status' => 'invalid_status',
    ];

    $response = $this->actingAs($user)->postJson('/api/interviews', $data);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['status']);
});

test('validates scores are within range', function () {
    $user = User::factory()->create();
    $application = Application::factory()->create();
    $stage = InterviewStage::factory()->create();
    $interviewer = CompanyMember::factory()->create();

    $data = [
        'application_id' => $application->id,
        'stage_id' => $stage->id,
        'interviewer_id' => $interviewer->id,
        'scheduled_at' => now()->addDays(1)->format('Y-m-d H:i:s'),
        'status' => 'scheduled',
        'technical_score' => 6,
        'cultural_score' => 0,
    ];

    $response = $this->actingAs($user)->postJson('/api/interviews', $data);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['technical_score', 'cultural_score']);
});
