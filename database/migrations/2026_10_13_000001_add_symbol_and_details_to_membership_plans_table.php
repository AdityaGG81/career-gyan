<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('membership_plans', function (Blueprint $table) {
            if (!Schema::hasColumn('membership_plans', 'symbol')) {
                $table->string('symbol')->default('fa-solid fa-crown')->after('name');
            }
            if (!Schema::hasColumn('membership_plans', 'badge_text')) {
                $table->string('badge_text')->default('MOST POPULAR')->after('symbol');
            }
            if (!Schema::hasColumn('membership_plans', 'currency_symbol')) {
                $table->string('currency_symbol')->default('₹')->after('price');
            }
            if (!Schema::hasColumn('membership_plans', 'original_price')) {
                $table->integer('original_price')->nullable()->after('currency_symbol');
            }
            if (!Schema::hasColumn('membership_plans', 'billing_period')) {
                $table->string('billing_period')->default('yr')->after('duration_days');
            }
            if (!Schema::hasColumn('membership_plans', 'color_theme')) {
                $table->string('color_theme')->default('amber')->after('billing_period');
            }
        });
    }

    public function down(): void
    {
        Schema::table('membership_plans', function (Blueprint $table) {
            $table->dropColumn([
                'symbol',
                'badge_text',
                'currency_symbol',
                'original_price',
                'billing_period',
                'color_theme',
            ]);
        });
    }
};
