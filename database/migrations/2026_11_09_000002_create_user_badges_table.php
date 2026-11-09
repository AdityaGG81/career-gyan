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
        if (!Schema::hasTable('user_badges')) {
            Schema::create('user_badges', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->integer('tier_level'); // 1 = 1000 pts, 2 = 2000 pts, etc.
                $table->integer('points_milestone'); // 1000, 2000, 3000...
                $table->string('badge_name', 100);
                $table->string('badge_slug', 100);
                $table->string('badge_icon', 100)->default('fa-solid fa-award');
                $table->string('badge_color', 50)->default('#b45309');
                $table->string('badge_bg', 50)->default('#fef3c7');
                $table->text('badge_description')->nullable();
                $table->timestamp('unlocked_at')->nullable();
                $table->timestamps();

                $table->unique(['user_id', 'tier_level']);
                $table->index(['user_id', 'points_milestone']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_badges');
    }
};
