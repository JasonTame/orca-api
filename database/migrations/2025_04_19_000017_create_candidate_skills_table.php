<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidate_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained()->cascadeOnDelete();
            $table->foreignId('skill_id')->constrained('tech_skills')->cascadeOnDelete();
            $table->enum('proficiency', ['beginner', 'intermediate', 'advanced', 'expert']);
            $table->integer('years_experience')->default(0);
            $table->timestamps();

            // Prevent duplicate skills for the same candidate
            $table->unique(['candidate_id', 'skill_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidate_skills');
    }
};
