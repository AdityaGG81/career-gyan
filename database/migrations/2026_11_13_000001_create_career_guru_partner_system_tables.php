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
        // 1. CareerGurus table (Partner accounts)
        Schema::create('careergurus', function (Blueprint $table) {
            $table->id();
            $table->string('guru_id')->unique(); // e.g. CG-1001
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('password');
            $table->string('referral_code')->unique(); // e.g. GURU9482
            $table->string('commission_type')->default('percentage'); // 'percentage' or 'fixed'
            $table->decimal('commission_value', 8, 2)->default(20.00); // 20% default or fixed ₹
            $table->string('status')->default('active'); // 'active', 'inactive', 'revoked'
            $table->string('payout_upi_id')->nullable();
            $table->text('payout_bank_details')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip', 45)->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->index('status');
        });

        // 2. CareerGuru Password Resets
        Schema::create('careerguru_password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // 3. Add CareerGuru attribution fields to users table (if not exists)
        if (!Schema::hasColumn('users', 'careerguru_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->foreignId('careerguru_id')->nullable()->after('referred_by')->constrained('careergurus')->nullOnDelete();
                $table->timestamp('careerguru_registered_at')->nullable()->after('careerguru_id');
                $table->index('careerguru_id');
            });
        }

        // 4. Student Leads managed by CareerGurus
        Schema::create('careerguru_leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('careerguru_id')->constrained('careergurus')->cascadeOnDelete();
            $table->string('student_name');
            $table->string('phone');
            $table->string('email');
            $table->string('standard'); // Class 8, Class 9, Class 10, Class 11, Class 12, Diploma, Undergraduate, Postgraduate, Other
            $table->string('parent_name')->nullable();
            $table->string('parent_phone')->nullable();
            $table->string('city')->nullable();
            $table->string('school_college')->nullable();
            $table->string('interested_course')->nullable();
            $table->string('lead_status')->default('New Lead'); // New Lead, Contacted, Interested, Follow-up Required, Registered on CareerGyan, Premium Purchased, Not Interested
            $table->foreignId('registered_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('registered_at')->nullable();
            $table->timestamp('premium_purchased_at')->nullable();
            $table->text('additional_notes')->nullable();
            $table->date('next_followup_at')->nullable();
            $table->timestamps();

            $table->index(['careerguru_id', 'lead_status']);
            $table->index('phone');
            $table->index('email');
            $table->index('registered_user_id');
        });

        // 5. Activity log / timestamped notes history for leads
        Schema::create('careerguru_lead_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained('careerguru_leads')->cascadeOnDelete();
            $table->foreignId('careerguru_id')->constrained('careergurus')->cascadeOnDelete();
            $table->string('activity_type')->default('status_change'); // status_change, note_added, lead_created, student_registered, premium_purchased, followup_scheduled
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index(['lead_id', 'created_at']);
        });

        // 6. Premium conversion commissions
        Schema::create('careerguru_commissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('careerguru_id')->constrained('careergurus')->cascadeOnDelete();
            $table->foreignId('lead_id')->nullable()->constrained('careerguru_leads')->nullOnDelete();
            $table->foreignId('student_user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('membership_id')->nullable()->constrained('memberships')->nullOnDelete();
            $table->string('payment_id')->nullable();
            $table->string('membership_plan')->default('Pro Membership');
            $table->decimal('membership_amount', 10, 2);
            $table->string('commission_type')->default('percentage'); // 'percentage' or 'fixed'
            $table->decimal('commission_rate', 8, 2)->default(20.00); // 20.00%
            $table->decimal('commission_amount', 10, 2);
            $table->string('status')->default('pending'); // pending, approved, paid, rejected
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->string('payment_reference')->nullable(); // UTR / check / bank ref
            $table->text('rejection_reason')->nullable();
            $table->text('admin_remarks')->nullable();
            $table->timestamps();

            $table->index(['careerguru_id', 'status']);
            $table->index('student_user_id');
            $table->index('membership_id');
        });

        // 7. CareerGuru global settings
        Schema::create('careerguru_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('careerguru_settings');
        Schema::dropIfExists('careerguru_commissions');
        Schema::dropIfExists('careerguru_lead_activities');
        Schema::dropIfExists('careerguru_leads');

        if (Schema::hasColumn('users', 'careerguru_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropForeign(['careerguru_id']);
                $table->dropColumn(['careerguru_id', 'careerguru_registered_at']);
            });
        }

        Schema::dropIfExists('careerguru_password_resets');
        Schema::dropIfExists('careergurus');
    }
};
