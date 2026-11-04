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
        if (!Schema::hasTable('ai_chat_logs')) {
            Schema::create('ai_chat_logs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
                $table->string('user_name')->nullable();
                $table->string('user_email')->nullable();
                $table->string('session_id', 100)->nullable()->index();
                $table->text('question');
                $table->longText('reply')->nullable();
                $table->json('sources')->nullable();
                $table->string('model_used', 100)->nullable();
                $table->string('status', 50)->default('success')->index();
                $table->text('error_message')->nullable();
                $table->integer('response_time_ms')->nullable();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->timestamps();

                $table->index('created_at');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_chat_logs');
    }
};

