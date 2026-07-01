<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Fix the unique constraint on daily_quiz_attempts table.
     * 
     * The original constraint unique(user_id, attempted_at) only allows ONE
     * attempt per user per day. But the quiz system supports up to 10 questions
     * per day. We need to change it to unique(user_id, question_id, attempted_at)
     * so each user can answer each question once per day.
     * 
     * MySQL requires an index on any foreign key column (like user_id). Since the
     * original unique index was the only index starting with user_id, dropping it
     * directly fails in MySQL because the foreign key constraint becomes unindexed.
     * To fix this, we create a temporary index on user_id, drop the unique constraint,
     * add the new unique constraint, and then drop the temporary index.
     */
    public function up(): void
    {
        // 1. Create a temporary index on user_id to satisfy the foreign key constraint
        try {
            Schema::table('daily_quiz_attempts', function (Blueprint $table) {
                $table->index('user_id', 'temp_user_id_fk_index');
            });
        } catch (\Exception $e) {
            // Index might already exist or SQLite doesn't need it
        }

        // 2. Drop the old unique constraint
        Schema::table('daily_quiz_attempts', function (Blueprint $table) {
            try {
                $table->dropUnique(['user_id', 'attempted_at']);
            } catch (\Exception $e) {
                try {
                    $table->dropUnique('daily_quiz_attempts_user_id_attempted_at_unique');
                } catch (\Exception $ex) {
                    // Constraint might have a different name or not exist
                }
            }
        });

        // 3. Add the correct unique constraint & the query performance index
        Schema::table('daily_quiz_attempts', function (Blueprint $table) {
            // One answer per question per user per day
            $table->unique(['user_id', 'question_id', 'attempted_at'], 'quiz_user_question_date_unique');
            
            // Add index for common query pattern
            $table->index(['user_id', 'attempted_at'], 'quiz_user_date_index');
        });

        // 4. Clean up the temporary index
        try {
            Schema::table('daily_quiz_attempts', function (Blueprint $table) {
                $table->dropIndex('temp_user_id_fk_index');
            });
        } catch (\Exception $e) {
            // Might have failed to drop or SQLite doesn't support it
        }
    }

    public function down(): void
    {
        Schema::table('daily_quiz_attempts', function (Blueprint $table) {
            try {
                $table->dropUnique('quiz_user_question_date_unique');
                $table->dropIndex('quiz_user_date_index');
            } catch (\Exception $e) {}

            $table->unique(['user_id', 'attempted_at']);
        });
    }
};
