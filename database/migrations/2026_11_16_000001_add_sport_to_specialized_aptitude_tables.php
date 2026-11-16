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
        if (Schema::hasTable('specialized_aptitude_questions') && !Schema::hasColumn('specialized_aptitude_questions', 'sport')) {
            Schema::table('specialized_aptitude_questions', function (Blueprint $table) {
                $table->string('sport')->nullable()->index()->after('category');
            });
        }

        if (Schema::hasTable('specialized_test_attempts') && !Schema::hasColumn('specialized_test_attempts', 'sport')) {
            Schema::table('specialized_test_attempts', function (Blueprint $table) {
                $table->string('sport')->nullable()->index()->after('category');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('specialized_aptitude_questions') && Schema::hasColumn('specialized_aptitude_questions', 'sport')) {
            Schema::table('specialized_aptitude_questions', function (Blueprint $table) {
                $table->dropColumn('sport');
            });
        }

        if (Schema::hasTable('specialized_test_attempts') && Schema::hasColumn('specialized_test_attempts', 'sport')) {
            Schema::table('specialized_test_attempts', function (Blueprint $table) {
                $table->dropColumn('sport');
            });
        }
    }
};
