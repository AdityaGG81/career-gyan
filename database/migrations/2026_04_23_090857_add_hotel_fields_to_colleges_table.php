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
        Schema::table('colleges', function (Blueprint $table) {
            $table->string('tier')->nullable(); // Tier 1, Tier 2, Tier 3
            $table->string('duration')->nullable(); // e.g. 3-4 years
            $table->text('internship_opportunities')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('colleges', function (Blueprint $table) {
            $table->dropColumn(['tier', 'duration', 'internship_opportunities']);
        });
    }
};
