<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_openings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('team')->nullable();
            $table->string('location')->nullable();
            $table->enum('type', ['full_time', 'part_time', 'contract', 'internship']);
            $table->enum('level', ['entry', 'junior', 'mid', 'senior', 'lead', 'principal']);
            $table->decimal('salary_min', 10, 2)->nullable();
            $table->decimal('salary_max', 10, 2)->nullable();
            $table->text('requirements')->nullable();
            $table->text('benefits')->nullable();
            $table->foreignId('hiring_manager_id')->nullable()->constrained('company_members')->onDelete('set null');
            $table->enum('status', ['draft', 'published', 'closed', 'archived']);
            $table->boolean('is_remote')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamp('closing_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_openings');
    }
};
