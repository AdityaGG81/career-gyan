<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_quiz_attempts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('question_id');
            $table->string('selected_option')->nullable(); // 'a', 'b', 'c', 'd', or null if time ran out
            $table->boolean('is_correct')->default(false);
            $table->integer('points_earned')->default(0);
            $table->integer('time_taken_seconds')->default(30);
            $table->date('attempted_at');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('daily_quiz_questions')->onDelete('cascade');
            $table->unique(['user_id', 'attempted_at']); // one attempt per day per user
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_quiz_attempts');
    }
};
