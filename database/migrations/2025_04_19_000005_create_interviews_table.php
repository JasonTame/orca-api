<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained()->cascadeOnDelete();
            $table->foreignId('stage_id')->constrained('interview_stages')->cascadeOnDelete();
            $table->foreignId('interviewer_id')->constrained('users')->nullOnDelete();
            $table->timestamp('scheduled_at');
            $table->timestamp('completed_at')->nullable();
            $table->string('location')->nullable();
            $table->string('meeting_url')->nullable();
            $table->enum('status', ['scheduled', 'completed', 'cancelled', 'rescheduled'])->default('scheduled');
            $table->integer('technical_score')->nullable();
            $table->integer('cultural_score')->nullable();
            $table->text('feedback')->nullable();
            $table->enum('decision', ['proceed', 'reject', 'hold'])->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            // Ensure one interview per stage per application
            $table->unique(['application_id', 'stage_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};
