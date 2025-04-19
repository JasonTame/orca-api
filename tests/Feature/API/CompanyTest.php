<?php

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

beforeEach(function () {
    Sanctum::actingAs(
        User::factory()->create(),
        ['*']
    );
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
