<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('colleges', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('field_id')->constrained('fields')->cascadeOnDelete();
            $table->string('location');
            $table->string('state');
            $table->string('fees_range');
            $table->enum('type', ['Government', 'Private', 'Deemed', 'Central', 'Autonomous']);
            $table->string('website')->nullable();
            
            // New columns for detailed top college view
            $table->integer('rank')->nullable();
            $table->string('popular_branches')->nullable();
            $table->string('cutoff')->nullable();
            $table->text('placement_support')->nullable();
            $table->text('facilities')->nullable();
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('colleges');
    }
};
