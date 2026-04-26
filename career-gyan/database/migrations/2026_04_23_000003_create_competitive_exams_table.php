<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('competitive_exams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category'); // Government, Banking, Entrance, Defence, etc.
            $table->string('conducting_body');
            $table->text('purpose');
            $table->string('eligibility');
            $table->string('age_limit');
            $table->text('exam_pattern');
            $table->enum('difficulty_level', ['Easy', 'Moderate', 'High', 'Very High'])->default('Moderate');
            $table->text('career_outcome');
            $table->text('description');
            $table->json('roadmap'); // Step-by-step path
            $table->json('prep_tips'); // List of tips
            $table->string('icon')->default('fa-file-signature');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('competitive_exams');
    }
};
