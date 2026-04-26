<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('icon')->default('fa-briefcase');   // Font Awesome class
            $table->string('color')->default('#1a56db');       // accent hex
            $table->string('bg_color')->default('#e8f0fe');    // card bg hex
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fields');
    }
};
