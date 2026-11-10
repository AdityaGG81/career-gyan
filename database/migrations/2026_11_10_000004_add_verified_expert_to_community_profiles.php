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
        if (Schema::hasTable('community_profiles')) {
            Schema::table('community_profiles', function (Blueprint $table) {
                if (!Schema::hasColumn('community_profiles', 'is_verified_expert')) {
                    $table->boolean('is_verified_expert')->default(false)->after('reputation_points');
                }
                if (!Schema::hasColumn('community_profiles', 'expert_title')) {
                    $table->string('expert_title')->nullable()->after('is_verified_expert');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('community_profiles')) {
            Schema::table('community_profiles', function (Blueprint $table) {
                if (Schema::hasColumn('community_profiles', 'expert_title')) {
                    $table->dropColumn('expert_title');
                }
                if (Schema::hasColumn('community_profiles', 'is_verified_expert')) {
                    $table->dropColumn('is_verified_expert');
                }
            });
        }
    }
};
