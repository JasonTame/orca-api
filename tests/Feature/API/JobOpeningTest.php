<?php

use App\Models\Company;
use App\Models\CompanyMember;
use App\Models\JobOpening;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->company = Company::factory()->create();
    $this->hiringManager = CompanyMember::factory()->create();

    $this->actingAs($this->user);
});

test('can list all job openings', function () {
    JobOpening::factory()->count(3)->create(['company_id' => $this->company->id]);

    $response = $this->getJson('/api/job-openings');

    $response->assertStatus(200)
        ->assertJsonCount(3);
});

test('can create a job opening', function () {
    $jobOpeningData = [
        'company_id' => $this->company->id,
        'hiring_manager_id' => $this->hiringManager->id,
        'title' => 'Senior Software Engineer',
        'description' => 'We are looking for a senior software engineer...',
        'type' => 'full_time',
        'level' => 'senior',
        'status' => 'draft',
        'is_remote' => true,
    ];

    $response = $this->postJson('/api/job-openings', $jobOpeningData);

    $response->assertStatus(201)
        ->assertJson($jobOpeningData);

    $this->assertDatabaseHas('job_openings', $jobOpeningData);
});

test('can show a job opening', function () {
    $jobOpening = JobOpening::factory()->create(['company_id' => $this->company->id]);

    $response = $this->getJson("/api/job-openings/{$jobOpening->id}");

    $response->assertStatus(200)
        ->assertJson($jobOpening->toArray());
});

test('can update a job opening', function () {
    $jobOpening = JobOpening::factory()->create(['company_id' => $this->company->id]);
    $updateData = [
        'title' => 'Updated Job Opening Title',
        'description' => 'Updated job opening description...',
        'status' => 'published',
    ];

    $response = $this->putJson("/api/job-openings/{$jobOpening->id}", $updateData);

    $response->assertStatus(200)
        ->assertJson($updateData);

    $this->assertDatabaseHas('job_openings', $updateData);
});

test('can delete a job opening', function () {
    $jobOpening = JobOpening::factory()->create(['company_id' => $this->company->id]);

    $response = $this->deleteJson("/api/job-openings/{$jobOpening->id}");

    $response->assertStatus(204);

    $this->assertDatabaseMissing('job_openings', ['id' => $jobOpening->id]);
});

test('validates required fields when creating a job opening', function () {
    $response = $this->postJson('/api/job-openings', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['company_id', 'title', 'description', 'type', 'level', 'status']);
});

test('validates salary range when updating a job opening', function () {
    $jobOpening = JobOpening::factory()->create(['company_id' => $this->company->id]);
    $updateData = [
        'salary_min' => 100000,
        'salary_max' => 50000,
    ];

    $response = $this->putJson("/api/job-openings/{$jobOpening->id}", $updateData);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['salary_max']);
});

test('validates closing date is after published date', function () {
    $jobOpening = JobOpening::factory()->create(['company_id' => $this->company->id]);
    $updateData = [
        'published_at' => '2024-03-22 00:00:00',
        'closing_date' => '2024-03-21 00:00:00',
    ];

    $response = $this->putJson("/api/job-openings/{$jobOpening->id}", $updateData);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['closing_date']);
});
