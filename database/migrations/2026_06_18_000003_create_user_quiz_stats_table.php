<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_quiz_stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->integer('total_points')->default(0);
            $table->integer('current_streak')->default(0);
            $table->integer('longest_streak')->default(0);
            $table->integer('quizzes_taken')->default(0);
            $table->integer('correct_answers')->default(0);
            $table->integer('speed_bonuses')->default(0);
            $table->json('badges')->nullable(); // array of badge keys
            $table->date('last_attempt_date')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_quiz_stats');
    }
};
