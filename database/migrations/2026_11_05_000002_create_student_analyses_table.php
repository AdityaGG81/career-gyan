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
        if (!Schema::hasTable('student_analyses')) {
            Schema::create('student_analyses', function (Blueprint $table) {
                $table->id();
                $table->uuid('uuid')->unique();
                $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();

                // Section 1: Basic & Academic Profile (Q1 - Q9)
                $table->string('full_name');
                $table->string('mobile_number');
                $table->string('email');
                $table->string('current_class');
                $table->string('current_stream');
                $table->string('city_district');
                $table->text('exam_results_last_3_years');
                $table->text('top_subjects_last_3_years');
                $table->string('desired_admission_course');

                // Section 2: Subject Preferences & Aptitude (Q10 - Q15)
                $table->json('enjoyed_subjects')->nullable();
                $table->json('difficult_subjects')->nullable();
                $table->string('completed_aptitude_test')->default('No');
                $table->text('aptitude_test_scores')->nullable();
                $table->json('strongest_aptitude_areas')->nullable();
                $table->string('aptitude_report_file')->nullable();

                // Section 3: Personal Interests & Activities (Q16 - Q19)
                $table->text('personal_interests');
                $table->text('special_hobbies_talents')->nullable();
                $table->json('enjoyed_activities')->nullable();
                $table->text('free_day_preference')->nullable();

                // Section 4: Skills & Work Personality (Q20 - Q25)
                $table->json('strongest_skills')->nullable();
                $table->string('work_with_preference')->nullable();
                $table->string('work_style')->nullable();
                $table->json('personality_descriptions')->nullable();
                $table->tinyInteger('problem_solving_rating')->default(3);
                $table->tinyInteger('learning_tech_rating')->default(3);

                // Section 5: Career Fields & Environment (Q26 - Q33)
                $table->json('interested_career_fields')->nullable();
                $table->text('dream_career')->nullable();
                $table->text('dream_career_reason')->nullable();
                $table->json('career_priorities')->nullable();
                $table->string('business_startup_interest')->default('Maybe');
                $table->json('preferred_work_environments')->nullable();
                $table->tinyInteger('people_interaction_comfort')->default(3);
                $table->tinyInteger('machines_tools_comfort')->default(3);

                // Section 6: Higher Education & Preferences (Q34 - Q41)
                $table->string('higher_studies_willingness')->default('Maybe-Not decided');
                $table->string('study_outside_city')->default('Yes');
                $table->string('preferred_study_location')->default('Same State');
                $table->string('annual_education_budget')->nullable();
                $table->string('need_scholarship_loan_info')->default('Maybe');
                $table->text('top_three_careers_courses');
                $table->text('parent_suggested_career')->nullable();
                $table->string('parent_preference_alignment')->default('Partially');

                // Section 7: Limitations & CareerGyan Help (Q42 - Q47)
                $table->text('limitations_constraints')->nullable();
                $table->text('dream_career_no_limitations')->nullable();
                $table->text('no_limitations_reason')->nullable();
                $table->text('biggest_career_confusion')->nullable();
                $table->json('help_requested')->nullable();
                $table->text('additional_info')->nullable();

                $table->timestamps();

                $table->index(['created_at', 'user_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_analyses');
    }
};
