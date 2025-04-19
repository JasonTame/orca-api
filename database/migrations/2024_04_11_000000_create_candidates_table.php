<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('location')->nullable();
            $table->string('resume_url')->nullable();
            $table->string('portfolio_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->integer('years_experience')->nullable();
            $table->string('current_position')->nullable();
            $table->string('current_company')->nullable();
            $table->decimal('desired_salary', 10, 2)->nullable();
            $table->enum('source', ['linkedin', 'indeed', 'referral', 'career_site', 'other'])->default('other');
            $table->text('notes')->nullable();
            $table->enum('status', ['active', 'inactive', 'hired', 'rejected'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
}; 