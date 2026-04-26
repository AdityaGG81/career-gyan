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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dimension_id')->constrained('dimensions')->cascadeOnDelete();
            $table->string('question_type')->default('text_only'); // text_only, single_image, image_sequence, image_mcq
            $table->text('question_text')->nullable();
            $table->json('question_images')->nullable();
            $table->string('options_type')->default('text'); // text, image
            $table->json('options');
            $table->string('correct_answer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
