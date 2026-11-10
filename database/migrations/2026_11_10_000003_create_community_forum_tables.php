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
        // 1. Community Profiles (For both guests and registered users)
        if (!Schema::hasTable('community_profiles')) {
            Schema::create('community_profiles', function (Blueprint $table) {
                $table->id();
                $table->string('session_id')->index()->nullable();
                $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
                $table->string('display_name');
                $table->string('persona')->default('Student'); // e.g. '12th Student', 'College Student', 'Working Professional', 'Counselor', 'Parent'
                $table->string('headline')->nullable(); // e.g. 'JEE 2026 Aspirant', 'Software Engineer @ Infosys'
                $table->string('avatar_color')->default('#ff4500');
                $table->string('target_stream')->nullable();
                $table->string('target_college')->nullable();
                $table->integer('reputation_points')->default(10);
                $table->timestamps();
            });
        }

        // 2. Community Posts / Questions (Reddit-like threads)
        if (!Schema::hasTable('community_posts')) {
            Schema::create('community_posts', function (Blueprint $table) {
                $table->id();
                $table->uuid('uuid')->unique();
                $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
                $table->string('author_name');
                $table->string('author_persona')->default('Student');
                $table->string('author_headline')->nullable();
                $table->string('author_badge')->nullable(); // 'student', 'college', 'professional', 'counselor', 'parent'
                $table->string('channel')->default('career-advice')->index();
                $table->string('title');
                $table->string('slug')->index();
                $table->text('content');
                $table->json('tags')->nullable();
                $table->integer('upvotes_count')->default(0);
                $table->integer('answers_count')->default(0);
                $table->integer('views_count')->default(0);
                $table->boolean('is_pinned')->default(false);
                $table->boolean('is_resolved')->default(false);
                $table->string('guest_session_id')->nullable();
                $table->string('ip_address')->nullable();
                $table->timestamps();
            });
        }

        // 3. Community Answers / Replies
        if (!Schema::hasTable('community_answers')) {
            Schema::create('community_answers', function (Blueprint $table) {
                $table->id();
                $table->uuid('uuid')->unique();
                $table->foreignId('post_id')->constrained('community_posts')->cascadeOnDelete();
                $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
                $table->string('author_name');
                $table->string('author_persona')->default('Student');
                $table->string('author_headline')->nullable();
                $table->string('author_badge')->nullable();
                $table->text('content');
                $table->integer('upvotes_count')->default(0);
                $table->boolean('is_accepted')->default(false);
                $table->boolean('is_expert_answer')->default(false);
                $table->string('guest_session_id')->nullable();
                $table->string('ip_address')->nullable();
                $table->timestamps();
            });
        }

        // 4. Community Votes (Upvotes/Downvotes)
        if (!Schema::hasTable('community_votes')) {
            Schema::create('community_votes', function (Blueprint $table) {
                $table->id();
                $table->string('votable_type'); // 'post' or 'answer'
                $table->unsignedBigInteger('votable_id');
                $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
                $table->string('session_id')->nullable()->index();
                $table->string('ip_address')->nullable();
                $table->smallInteger('vote_type')->default(1); // 1 = upvote, -1 = downvote
                $table->timestamps();

                $table->index(['votable_type', 'votable_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community_votes');
        Schema::dropIfExists('community_answers');
        Schema::dropIfExists('community_posts');
        Schema::dropIfExists('community_profiles');
    }
};

