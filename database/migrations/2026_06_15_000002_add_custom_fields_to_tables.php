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
        Schema::table('fields', function (Blueprint $table) {
            $table->string('cover_image')->nullable();
        });

        Schema::table('colleges', function (Blueprint $table) {
            $table->string('youtube_url')->nullable();
        });

        Schema::table('careers', function (Blueprint $table) {
            $table->string('video_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fields', function (Blueprint $table) {
            $table->dropColumn('cover_image');
        });

        Schema::table('colleges', function (Blueprint $table) {
            $table->dropColumn('youtube_url');
        });

        Schema::table('careers', function (Blueprint $table) {
            $table->dropColumn('video_url');
        });
    }
};
