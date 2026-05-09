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
        Schema::table('careers', function (Blueprint $table) {
            $table->json('skills')->nullable();
            $table->text('future_scope')->nullable();
            $table->json('entrance_exams')->nullable();
            $table->json('job_opportunities')->nullable();
            $table->json('related_careers')->nullable();
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('careers', function (Blueprint $table) {
            $table->dropColumn(['skills', 'future_scope', 'entrance_exams', 'job_opportunities', 'related_careers', 'image']);
        });
    }
};
