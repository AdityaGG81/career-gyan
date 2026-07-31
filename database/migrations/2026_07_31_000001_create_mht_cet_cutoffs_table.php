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
        Schema::create('mht_cet_cutoffs', function (Blueprint $table) {
            $table->id();
            $table->integer('college_code')->nullable()->index();
            $table->string('college_name')->index();
            $table->string('branch_code')->nullable();
            $table->string('branch_name')->index();
            $table->string('category')->index();
            $table->string('category_full')->nullable();
            $table->decimal('percentile', 10, 7)->default(0);
            $table->integer('year')->default(2025);
            $table->string('round')->nullable();
            $table->string('status')->nullable();
            $table->string('quota')->nullable()->index();
            $table->integer('merit_no')->nullable();
            $table->string('percentile_band')->nullable();
            $table->timestamps();

            $table->index(['college_name', 'branch_name', 'category', 'round']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mht_cet_cutoffs');
    }
};
