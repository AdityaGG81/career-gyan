<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('business_ideas')) {
            Schema::create('business_ideas', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->unsignedBigInteger('field_id')->nullable();
                $table->string('category')->default('Retail')->nullable();
                $table->text('description')->nullable();
                $table->string('investment')->nullable();
                $table->string('initial_investment')->nullable();
                $table->string('profit_margin')->nullable();
                $table->string('risk_level')->default('Low');
                $table->string('start_time')->default('2-4 Weeks');
                $table->string('break_even_period')->nullable();
                $table->string('target_audience')->nullable();
                $table->text('skills_required')->nullable();
                $table->text('soft_skills')->nullable();
                $table->text('opportunities')->nullable();
                $table->text('equipment_needed')->nullable();
                $table->string('icon')->nullable()->default('fa-store');
                $table->string('status')->default('active');
                $table->timestamps();
            });
            return;
        }

        Schema::table('business_ideas', function (Blueprint $table) {
            if (!Schema::hasColumn('business_ideas', 'category')) {
                $table->string('category')->default('Retail')->nullable();
            }
            if (!Schema::hasColumn('business_ideas', 'skills_required')) {
                $table->text('skills_required')->nullable();
            }
            if (!Schema::hasColumn('business_ideas', 'soft_skills')) {
                $table->text('soft_skills')->nullable();
            }
            if (!Schema::hasColumn('business_ideas', 'opportunities')) {
                $table->text('opportunities')->nullable();
            }
            if (!Schema::hasColumn('business_ideas', 'initial_investment')) {
                $table->string('initial_investment')->nullable();
            }
            if (!Schema::hasColumn('business_ideas', 'break_even_period')) {
                $table->string('break_even_period')->nullable();
            }
            if (!Schema::hasColumn('business_ideas', 'target_audience')) {
                $table->string('target_audience')->nullable();
            }
            if (!Schema::hasColumn('business_ideas', 'equipment_needed')) {
                $table->text('equipment_needed')->nullable();
            }
            if (!Schema::hasColumn('business_ideas', 'icon')) {
                $table->string('icon')->nullable()->default('fa-store');
            }
            if (!Schema::hasColumn('business_ideas', 'status')) {
                $table->string('status')->default('active');
            }
        });
    }

    public function down(): void
    {
        Schema::table('business_ideas', function (Blueprint $table) {
            $columns = [
                'category',
                'skills_required',
                'soft_skills',
                'opportunities',
                'initial_investment',
                'break_even_period',
                'target_audience',
                'equipment_needed',
                'icon',
                'status',
            ];
            foreach ($columns as $column) {
                if (Schema::hasColumn('business_ideas', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
