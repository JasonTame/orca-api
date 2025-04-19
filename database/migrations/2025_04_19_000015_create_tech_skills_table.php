<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tech_skills', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->enum('category', ['language', 'framework', 'database', 'tool', 'platform']);
            $table->boolean('is_language')->default(false);
            $table->boolean('is_framework')->default(false);
            $table->boolean('is_tool')->default(false);
            $table->foreignId('parent_skill_id')->nullable()->constrained('tech_skills')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tech_skills');
    }
};
