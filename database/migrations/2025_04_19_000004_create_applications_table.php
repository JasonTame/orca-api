<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_opening_id')->constrained()->cascadeOnDelete();
            $table->foreignId('candidate_id')->constrained()->cascadeOnDelete();
            $table->string('code_sample_url')->nullable();
            $table->enum('status', ['pending', 'reviewing', 'interviewing', 'offered', 'accepted', 'rejected'])->default('pending');
            $table->foreignId('current_stage_id')->nullable()->constrained('interview_stages')->nullOnDelete();
            $table->string('rejection_reason')->nullable();
            $table->text('notes')->nullable();
            $table->string('referral_source')->nullable();
            $table->timestamp('applied_at')->useCurrent();
            $table->timestamps();

            // Ensure one application per candidate per job opening
            $table->unique(['job_opening_id', 'candidate_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
