<?php

use App\Models\User;
use App\Models\Company;
use App\Models\Interview;
use App\Models\JobOpening;
use App\Models\Application;
use App\Models\CompanyMember;
use App\Models\InterviewStage;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('can list all company members', function () {
    CompanyMember::factory()->count(3)->create();

    $response = $this->getJson('/api/company-members');

    $response->assertStatus(200)
        ->assertJsonStructure([
            '*' => [
                'id',
                'company_id',
                'name',
                'email',
                'position',
                'department',
                'phone',
                'is_hiring_manager',
                'is_recruiter',
                'is_interviewer',
                'status',
                'created_at',
                'updated_at',
                'company',
                'job_openings',
                'interviews'
            ]
        ]);
});

test('can create company member', function () {
    $company = Company::factory()->create();
    $data = [
        'company_id' => $company->id,
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'position' => 'Senior Developer',
        'department' => 'Engineering',
        'phone' => '1234567890',
        'is_hiring_manager' => true,
        'is_recruiter' => false,
        'is_interviewer' => true,
        'status' => 'active'
    ];

    $response = $this->postJson('/api/company-members', $data);

    $response->assertStatus(201)
        ->assertJsonStructure([
            'id',
            'company_id',
            'name',
            'email',
            'position',
            'department',
            'phone',
            'is_hiring_manager',
            'is_recruiter',
            'is_interviewer',
            'status',
            'created_at',
            'updated_at'
        ]);

    $this->assertDatabaseHas('company_members', $data);
});

test('can show company member', function () {
    $companyMember = CompanyMember::factory()->create();

    $response = $this->getJson("/api/company-members/{$companyMember->id}");

    $response->assertStatus(200)
        ->assertJsonStructure([
            'id',
            'company_id',
            'name',
            'email',
            'position',
            'department',
            'phone',
            'is_hiring_manager',
            'is_recruiter',
            'is_interviewer',
            'status',
            'created_at',
            'updated_at',
            'company',
            'job_openings',
            'interviews'
        ]);
});

test('can update company member', function () {
    $companyMember = CompanyMember::factory()->create();
    $data = [
        'name' => 'Updated Name',
        'position' => 'Updated Position',
        'department' => 'Updated Department'
    ];

    $response = $this->putJson("/api/company-members/{$companyMember->id}", $data);

    $response->assertStatus(200)
        ->assertJsonFragment($data);

    $this->assertDatabaseHas('company_members', $data);
});

test('can delete company member', function () {
    $companyMember = CompanyMember::factory()->create();

    $response = $this->deleteJson("/api/company-members/{$companyMember->id}");

    $response->assertStatus(204);
    $this->assertDatabaseMissing('company_members', ['id' => $companyMember->id]);
});

test('can get job openings for company member', function () {
    $companyMember = CompanyMember::factory()->create();
    JobOpening::factory()->count(3)->create(['hiring_manager_id' => $companyMember->id]);

    $response = $this->getJson("/api/company-members/{$companyMember->id}/job-openings");

    $response->assertStatus(200)
        ->assertJsonStructure([
            '*' => [
                'id',
                'company_id',
                'title',
                'description',
                'team',
                'location',
                'type',
                'level',
                'salary_min',
                'salary_max',
                'requirements',
                'benefits',
                'hiring_manager_id',
                'status',
                'is_remote',
                'published_at',
                'closing_date',
                'created_at',
                'updated_at',
                'company',
                'applications'
            ]
        ]);
});

test('can get interviews for company member', function () {
    $companyMember = CompanyMember::factory()->create();
    $application = Application::factory()->create();
    $stages = InterviewStage::factory()->count(3)->create();

    foreach ($stages as $stage) {
        Interview::factory()->create([
            'interviewer_id' => $companyMember->id,
            'application_id' => $application->id,
            'stage_id' => $stage->id
        ]);
    }

    $response = $this->getJson("/api/company-members/{$companyMember->id}/interviews");

    $response->assertStatus(200)
        ->assertJsonStructure([
            '*' => [
                'id',
                'application_id',
                'stage_id',
                'interviewer_id',
                'scheduled_at',
                'completed_at',
                'location',
                'meeting_url',
                'status',
                'technical_score',
                'cultural_score',
                'feedback',
                'decision',
                'notes',
                'created_at',
                'updated_at',
                'application',
                'stage'
            ]
        ]);
});

test('validation errors on create', function () {
    $response = $this->postJson('/api/company-members', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors([
            'company_id',
            'name',
            'email',
            'position',
            'department',
            'phone',
            'status'
        ]);
});

test('validation errors on update', function () {
    $companyMember = CompanyMember::factory()->create();
    $response = $this->putJson("/api/company-members/{$companyMember->id}", [
        'email' => 'invalid-email',
        'status' => 'invalid-status'
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors([
            'email',
            'status'
        ]);
});
