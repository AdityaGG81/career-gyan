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
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('job_title');
            $table->string('category');
            $table->string('qualification');
            $table->string('location');
            $table->date('last_date');
            $table->string('apply_link')->nullable();
            $table->string('notification_file')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('active'); // active, archived
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
