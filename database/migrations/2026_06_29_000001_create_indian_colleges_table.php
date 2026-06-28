<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('indian_colleges', function (Blueprint $table) {
            $table->id();
            $table->string('college_name');
            $table->string('state')->nullable();
            $table->string('district')->nullable();
            $table->string('taluka')->nullable();
            $table->string('university_type')->nullable();
            $table->string('university_name')->nullable();
            $table->string('college_type')->nullable();
            $table->string('affiliation')->nullable();
            $table->string('management')->nullable();
            $table->string('website')->nullable();
            $table->integer('year_of_establishment')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('pin_code')->nullable();
            $table->integer('total_enrollment')->nullable();
            $table->integer('faculty_count')->nullable();
            // Maharashtra-specific course fields
            $table->string('course_name')->nullable();
            $table->string('course_type')->nullable();
            $table->string('is_professional')->nullable();
            $table->string('course_aided_unaided')->nullable();
            $table->integer('course_duration_months')->nullable();
            $table->string('course_category')->nullable();
            $table->timestamps();

            // Indexes for fast search/filter
            $table->index('state');
            $table->index('district');
            $table->index('college_name');
            $table->index('management');
            $table->index('university_name');
            $table->index('college_type');
            $table->index('course_category');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('indian_colleges');
    }
};
