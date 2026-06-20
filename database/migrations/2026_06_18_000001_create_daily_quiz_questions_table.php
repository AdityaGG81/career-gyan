<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->date('quiz_date')->unique();
            $table->text('question_text');
            $table->text('option_a');
            $table->text('option_b');
            $table->text('option_c');
            $table->text('option_d');
            $table->string('correct_option'); // 'a', 'b', 'c', or 'd'
            $table->text('explanation')->nullable();
            $table->string('category')->default('general'); // general, engineering, science, arts, commerce, technology
            $table->string('difficulty')->default('medium'); // easy, medium, hard
            $table->integer('points')->default(10);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_quiz_questions');
    }
};
