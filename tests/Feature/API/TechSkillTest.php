<?php

use App\Models\TechSkill;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('can list all tech skills', function () {
    TechSkill::factory()->count(3)->create();

    $response = $this->getJson('/api/tech-skills');

    $response->assertStatus(200)
        ->assertJsonCount(3)
        ->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'category',
                'is_language',
                'is_framework',
                'is_tool',
                'parent_skill_id',
                'created_at',
                'updated_at',
            ],
        ]);
});

test('can create a tech skill', function () {
    $techSkillData = [
        'name' => 'PHP',
        'category' => 'language',
        'is_language' => true,
        'is_framework' => false,
        'is_tool' => false,
    ];

    $response = $this->postJson('/api/tech-skills', $techSkillData);

    $response->assertStatus(201)
        ->assertJson($techSkillData);

    $this->assertDatabaseHas('tech_skills', $techSkillData);
});

test('can show a tech skill', function () {
    $techSkill = TechSkill::factory()->create();

    $response = $this->getJson("/api/tech-skills/{$techSkill->id}");

    $response->assertStatus(200)
        ->assertJson($techSkill->toArray());
});

test('can update a tech skill', function () {
    $techSkill = TechSkill::factory()->create();
    $updateData = [
        'name' => 'Updated Skill',
        'category' => 'framework',
        'is_language' => false,
        'is_framework' => true,
        'is_tool' => false,
    ];

    $response = $this->putJson("/api/tech-skills/{$techSkill->id}", $updateData);

    $response->assertStatus(200)
        ->assertJson($updateData);

    $this->assertDatabaseHas('tech_skills', $updateData);
});

test('can delete a tech skill', function () {
    $techSkill = TechSkill::factory()->create();

    $response = $this->deleteJson("/api/tech-skills/{$techSkill->id}");

    $response->assertStatus(204);
    $this->assertDatabaseMissing('tech_skills', ['id' => $techSkill->id]);
});

test('validates required fields when creating a tech skill', function () {
    $response = $this->postJson('/api/tech-skills', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['name', 'category']);
});

test('validates unique name', function () {
    TechSkill::factory()->create(['name' => 'PHP']);

    $response = $this->postJson('/api/tech-skills', [
        'name' => 'PHP',
        'category' => 'language',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['name']);
});

test('validates category enum', function () {
    $response = $this->postJson('/api/tech-skills', [
        'name' => 'Test Skill',
        'category' => 'invalid-category',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['category']);
});

test('can get skill categories', function () {
    $response = $this->getJson('/api/tech-skills/categories');

    $response->assertStatus(200)
        ->assertJson([
            'language',
            'framework',
            'database',
            'tool',
            'platform',
        ]);
});
