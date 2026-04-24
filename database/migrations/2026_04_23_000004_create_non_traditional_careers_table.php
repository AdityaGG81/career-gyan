<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('non_traditional_careers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category'); // Tech & Digital, Creative, Gaming, etc.
            $table->text('description');
            $table->string('required_skills');
            $table->json('learning_path'); // Step-by-step
            $table->string('tools_platforms');
            $table->string('duration');
            $table->string('income_potential');
            $table->string('work_type'); // Remote, Freelance, Hybrid, etc.
            $table->string('risk_level');
            $table->string('icon')->default('fa-rocket');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('non_traditional_careers');
    }
};
