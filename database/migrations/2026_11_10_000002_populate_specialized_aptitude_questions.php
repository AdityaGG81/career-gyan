<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use App\Models\SpecializedAptitudeQuestion;
use App\Models\SpecializedCourse;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Populate questions and courses if missing
        if (class_exists(\Database\Seeders\SpecializedAptitudeSeeder::class)) {
            try {
                (new \Database\Seeders\SpecializedAptitudeSeeder())->run();
            } catch (\Exception $e) {
                // Ignore if seeder encounters duplicate entries
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Keep data intact
    }
};
