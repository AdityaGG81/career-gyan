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
        Schema::create('traditional_careers', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('icon');
            $table->string('name');
            $table->string('education');
            $table->string('exam');
            $table->string('duration');
            $table->string('salary');
            $table->string('stability');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traditional_careers');
    }
};
