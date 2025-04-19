<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interview_stages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_opening_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('sequence');
            $table->integer('duration'); // in minutes
            $table->enum('format', ['in_person', 'video', 'phone', 'take_home']);
            $table->boolean('is_technical')->default(false);
            $table->timestamps();

            // Ensure sequence is unique per job opening
            $table->unique(['job_opening_id', 'sequence']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interview_stages');
    }
};
