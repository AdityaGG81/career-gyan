<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('field_id')->constrained('fields')->cascadeOnDelete();
            $table->text('description');
            $table->string('qualification');          // e.g. "12th + B.Tech"
            $table->string('stream')->nullable();     // Science / Commerce / Arts / Any
            $table->string('salary_range');           // e.g. "₹4L – ₹40L per annum"
            $table->enum('demand_level', ['Very High', 'High', 'Moderate', 'Growing', 'Stable'])
                  ->default('High');
            $table->json('roadmap');                  // JSON array of step strings
            $table->string('icon')->default('fa-briefcase');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};
