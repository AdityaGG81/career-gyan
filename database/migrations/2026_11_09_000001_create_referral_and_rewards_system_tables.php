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
        // 1. Add referral and points columns to users table
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'referral_code')) {
                $table->string('referral_code', 32)->nullable()->unique()->after('remember_token');
            }
            if (!Schema::hasColumn('users', 'referred_by')) {
                $table->foreignId('referred_by')->nullable()->after('referral_code')->constrained('users')->nullOnDelete();
            }
            if (!Schema::hasColumn('users', 'points_balance')) {
                $table->integer('points_balance')->default(0)->after('referred_by')->index();
            }
        });

        // 2. Referrals table
        if (!Schema::hasTable('referrals')) {
            Schema::create('referrals', function (Blueprint $table) {
                $table->id();
                $table->foreignId('referrer_id')->constrained('users')->cascadeOnDelete();
                $table->foreignId('referred_user_id')->unique()->constrained('users')->cascadeOnDelete();
                $table->string('referral_code', 32)->index();
                $table->string('status', 20)->default('pending')->index(); // pending, completed, rejected
                $table->integer('referrer_points')->default(0);
                $table->integer('referred_user_points')->default(0);
                $table->timestamp('completed_at')->nullable();
                $table->timestamps();

                $table->index(['referrer_id', 'status']);
            });
        }

        // 3. Centralized Point Transactions Ledger
        if (!Schema::hasTable('point_transactions')) {
            Schema::create('point_transactions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->string('transaction_type', 50)->index(); // referral_bonus, referred_signup, aptitude_test, student_analysis, admin_adjustment
                $table->integer('points'); // +100, -50, etc.
                $table->string('description', 255);
                $table->string('reference_type', 50)->nullable(); // referral, test_session, quick_test_attempt, student_analysis, admin_manual
                $table->unsignedBigInteger('reference_id')->nullable();
                $table->unsignedBigInteger('admin_id')->nullable();
                $table->timestamps();

                $table->index(['user_id', 'created_at']);
                $table->index(['user_id', 'transaction_type']);
            });
        }

        // 4. Reward Claims table for duplicate prevention
        if (!Schema::hasTable('reward_claims')) {
            Schema::create('reward_claims', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->string('reward_type', 50); // aptitude_test, student_analysis, referred_signup
                $table->unsignedBigInteger('reference_id')->nullable();
                $table->integer('points_awarded')->default(0);
                $table->timestamps();

                // Unique compound constraint prevents duplicate reward claims per user and category
                $table->unique(['user_id', 'reward_type']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reward_claims');
        Schema::dropIfExists('point_transactions');
        Schema::dropIfExists('referrals');

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'referred_by')) {
                $table->dropForeign(['referred_by']);
                $table->dropColumn('referred_by');
            }
            if (Schema::hasColumn('users', 'referral_code')) {
                $table->dropColumn('referral_code');
            }
            if (Schema::hasColumn('users', 'points_balance')) {
                $table->dropColumn('points_balance');
            }
        });
    }
};

