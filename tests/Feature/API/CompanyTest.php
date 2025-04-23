<?php

use App\Models\Company;
use App\Models\CompanyMember;
use App\Models\JobOpening;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('can list all companies', function () {
    Company::factory()->count(3)->create();

    $response = $this->getJson('/api/companies');

    $response->assertStatus(200)
        ->assertJsonCount(3)
        ->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'logo_url',
                'website',
                'industry',
                'size',
                'description',
                'location',
                'status',
                'created_at',
                'updated_at',
            ],
        ]);
});

test('can search companies by name', function () {
    Company::factory()->create(['name' => 'Acme Corporation']);
    Company::factory()->create(['name' => 'Beta Industries']);
    Company::factory()->create(['name' => 'Acme Solutions']);

    $response = $this->getJson('/api/companies?search=Acme');

    $response->assertStatus(200)
        ->assertJsonCount(2)
        ->assertJsonFragment(['name' => 'Acme Corporation'])
        ->assertJsonFragment(['name' => 'Acme Solutions'])
        ->assertJsonMissing(['name' => 'Beta Industries']);
});

test('can create a company', function () {
    $companyData = [
        'name' => 'Test Company',
        'logo_url' => 'https://example.com/logo.png',
        'website' => 'https://example.com',
        'industry' => 'Technology',
        'size' => 'medium',
        'description' => 'A test company',
        'location' => 'New York',
        'status' => 'active',
    ];

    $response = $this->postJson('/api/companies', $companyData);

    $response->assertStatus(201)
        ->assertJson($companyData);

    $this->assertDatabaseHas('companies', $companyData);
});

test('can show a company', function () {
    $company = Company::factory()->create();

    $response = $this->getJson("/api/companies/{$company->id}");

    $response->assertStatus(200)
        ->assertJson($company->toArray());
});

test('can update a company', function () {
    $company = Company::factory()->create();
    $updateData = [
        'name' => 'Updated Company',
        'website' => 'https://updated.com',
    ];

    $response = $this->putJson("/api/companies/{$company->id}", $updateData);

    $response->assertStatus(200)
        ->assertJson($updateData);

    $this->assertDatabaseHas('companies', $updateData);
});

test('can delete a company', function () {
    $company = Company::factory()->create();

    $response = $this->deleteJson("/api/companies/{$company->id}");

    $response->assertStatus(204);
    $this->assertDatabaseMissing('companies', ['id' => $company->id]);
});

test('validates required fields when creating a company', function () {
    $response = $this->postJson('/api/companies', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['name']);
});

test('validates url fields', function () {
    $response = $this->postJson('/api/companies', [
        'name' => 'Test Company',
        'logo_url' => 'not-a-url',
        'website' => 'not-a-url',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['logo_url', 'website']);
});

test('validates enum fields', function () {
    $response = $this->postJson('/api/companies', [
        'name' => 'Test Company',
        'size' => 'invalid-size',
        'status' => 'invalid-status',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['size', 'status']);
});

test('can get company job openings', function () {
    $company = Company::factory()->create();
    JobOpening::factory()->count(3)->create(['company_id' => $company->id]);

    $response = $this->getJson("/api/companies/{$company->id}/job-openings");

    $response->assertStatus(200)
        ->assertJsonCount(3)
        ->assertJsonStructure([
            '*' => [
                'id',
                'title',
                'description',
                'company_id',
                'created_at',
                'updated_at',
            ],
        ]);
});

test('can get company members', function () {
    $company = Company::factory()->create();
    CompanyMember::factory()->count(3)->create(['company_id' => $company->id]);

    $response = $this->getJson("/api/companies/{$company->id}/members");

    $response->assertStatus(200)
        ->assertJsonCount(3)
        ->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'email',
                'position',
                'department',
                'phone',
                'is_hiring_manager',
                'is_recruiter',
                'is_interviewer',
                'status',
                'company_id',
                'created_at',
                'updated_at',
            ],
        ]);
});

test('can filter company members by company_id', function () {
    $company1 = Company::factory()->create();
    $company2 = Company::factory()->create();

    CompanyMember::factory()->count(3)->create(['company_id' => $company1->id]);
    CompanyMember::factory()->count(2)->create(['company_id' => $company2->id]);

    $response1 = $this->getJson("/api/company-members?company_id={$company1->id}");
    $response1->assertStatus(200)
        ->assertJsonCount(3)
        ->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'email',
                'company_id',
            ],
        ]);

    $response2 = $this->getJson("/api/company-members?company_id={$company2->id}");
    $response2->assertStatus(200)
        ->assertJsonCount(2);

    $responseAll = $this->getJson('/api/company-members');
    $responseAll->assertStatus(200)
        ->assertJsonCount(5);
});

test('can get company hiring managers', function () {
    $company = Company::factory()->create();
    CompanyMember::factory()->count(2)->create([
        'company_id' => $company->id,
        'is_hiring_manager' => true,
    ]);
    CompanyMember::factory()->count(2)->create([
        'company_id' => $company->id,
        'is_hiring_manager' => false,
    ]);

    $response = $this->getJson("/api/companies/{$company->id}/hiring-managers");

    $response->assertStatus(200)
        ->assertJsonCount(2)
        ->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'email',
                'position',
                'department',
                'phone',
                'is_hiring_manager',
                'is_recruiter',
                'is_interviewer',
                'status',
                'company_id',
                'created_at',
                'updated_at',
            ],
        ]);
});

test('can get company interviewers', function () {
    $company = Company::factory()->create();
    CompanyMember::factory()->count(2)->create([
        'company_id' => $company->id,
        'is_interviewer' => true,
    ]);
    CompanyMember::factory()->count(2)->create([
        'company_id' => $company->id,
        'is_interviewer' => false,
    ]);

    $response = $this->getJson("/api/companies/{$company->id}/interviewers");

    $response->assertStatus(200)
        ->assertJsonCount(2)
        ->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'email',
                'position',
                'department',
                'phone',
                'is_hiring_manager',
                'is_recruiter',
                'is_interviewer',
                'status',
                'company_id',
                'created_at',
                'updated_at',
            ],
        ]);
});
