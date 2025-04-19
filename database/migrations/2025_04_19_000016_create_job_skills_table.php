<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_opening_id')->constrained()->cascadeOnDelete();
            $table->foreignId('skill_id')->constrained('tech_skills')->cascadeOnDelete();
            $table->boolean('is_required')->default(true);
            $table->enum('importance', ['low', 'medium', 'high', 'critical'])->default('medium');
            $table->timestamps();

            // Prevent duplicate skills for the same job opening
            $table->unique(['job_opening_id', 'skill_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_skills');
    }
};
