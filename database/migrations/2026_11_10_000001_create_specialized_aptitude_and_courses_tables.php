<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('specialized_aptitude_questions')) {
            Schema::create('specialized_aptitude_questions', function (Blueprint $table) {
                $table->id();
                $table->string('category')->index(); // 'spiritual', 'artistic', 'sports', 'business'
                $table->text('question_text');
                $table->text('option_a');
                $table->text('option_b');
                $table->text('option_c');
                $table->text('option_d');
                $table->string('correct_option', 5); // 'A', 'B', 'C', 'D'
                $table->text('explanation')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('specialized_courses')) {
            Schema::create('specialized_courses', function (Blueprint $table) {
                $table->id();
                $table->string('category')->index(); // 'spiritual', 'artistic', 'sports', 'business'
                $table->string('title');
                $table->string('slug')->index();
                $table->string('duration');
                $table->string('level'); // 'Bachelor Degree', 'Master Degree', 'Diploma', 'Certification'
                $table->string('eligibility');
                $table->text('description');
                $table->json('key_skills')->nullable();
                $table->json('top_colleges')->nullable();
                $table->json('career_roles')->nullable();
                $table->string('salary_range')->nullable();
                $table->string('average_fees')->nullable();
                $table->boolean('is_featured')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('specialized_test_attempts')) {
            Schema::create('specialized_test_attempts', function (Blueprint $table) {
                $table->id();
                $table->uuid('uuid')->unique();
                $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
                $table->string('category')->index(); // 'spiritual', 'artistic', 'sports', 'business'
                $table->string('student_name');
                $table->string('student_email');
                $table->string('student_phone')->nullable();
                $table->integer('total_questions')->default(20);
                $table->integer('correct_answers')->default(0);
                $table->decimal('score_percentage', 5, 2)->default(0.00);
                $table->string('aptitude_level');
                $table->json('answers');
                $table->json('question_details');
                $table->json('recommended_courses')->nullable();
                $table->timestamps();

                $table->index(['created_at', 'category']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specialized_test_attempts');
        Schema::dropIfExists('specialized_courses');
        Schema::dropIfExists('specialized_aptitude_questions');
    }
};
