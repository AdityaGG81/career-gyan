<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('skill_courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('field_id')->constrained('fields')->cascadeOnDelete();
            $table->string('category_title'); // e.g. "Programming & IT"
            $table->text('description');
            $table->string('tools');      // e.g. "HTML, CSS, JS"
            $table->string('duration');   // e.g. "4-6 Months"
            $table->string('difficulty'); // e.g. "Intermediate"
            $table->string('salary_potential');
            $table->text('job_roles');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skill_courses');
    }
};
