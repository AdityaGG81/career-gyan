<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('business_ideas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('field_id')->constrained('fields')->cascadeOnDelete();
            $table->text('description');
            $table->string('investment');
            $table->string('profit_margin');
            $table->enum('risk_level', ['Low', 'Medium', 'High'])->default('Low');
            $table->string('start_time')->default('2-4 Weeks');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_ideas');
    }
};
