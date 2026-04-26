<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('career_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('career_id')->constrained('careers')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->unique(['career_id', 'subject_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('career_subjects');
    }
};
