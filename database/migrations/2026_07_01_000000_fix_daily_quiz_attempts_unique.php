<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Fix the unique constraint on daily_quiz_attempts table.
     * 
     * The original constraint unique(user_id, attempted_at) only allows ONE
     * attempt per user per day. But the quiz system supports up to 10 questions
     * per day. We need to change it to unique(user_id, question_id, attempted_at)
     * so each user can answer each question once per day.
     */
    public function up(): void
    {
        Schema::table('daily_quiz_attempts', function (Blueprint $table) {
            // Drop the old unique constraint that blocks multiple attempts per day
            // SQLite doesn't support dropping constraints directly, so we handle both
            try {
                $table->dropUnique(['user_id', 'attempted_at']);
            } catch (\Exception $e) {
                // Constraint may not exist or may have a different name
            }
        });

        // For SQLite, we may need to use raw SQL or rebuild the table
        // But first, add the correct unique constraint
        Schema::table('daily_quiz_attempts', function (Blueprint $table) {
            // One answer per question per user per day
            $table->unique(['user_id', 'question_id', 'attempted_at'], 'quiz_user_question_date_unique');
            
            // Add index for common query pattern
            $table->index(['user_id', 'attempted_at'], 'quiz_user_date_index');
        });
    }

    public function down(): void
    {
        Schema::table('daily_quiz_attempts', function (Blueprint $table) {
            $table->dropUnique('quiz_user_question_date_unique');
            $table->dropIndex('quiz_user_date_index');
            $table->unique(['user_id', 'attempted_at']);
        });
    }
};
