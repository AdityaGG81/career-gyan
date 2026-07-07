<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MembershipPlan;

class MembershipPlanSeeder extends Seeder
{
    public function run(): void
    {
        MembershipPlan::create([
            'name' => 'Pro Member',
            'slug' => 'pro-member',
            'description' => 'Unlock premium tools, advanced tests, 1-on-1 counseling, and expert WhatsApp group access.',
            'price' => 99900, // ₹999 in paise
            'duration_days' => 365, // 1 year duration
            'features' => [
                '🧠 Advanced Personality Profiler Test',
                '🎯 Career Deep-Dive Roadmaps & Insights',
                '👑 Leadership & Entrepreneurship Assessment',
                '⚡ Unlimited AI Chatbot Career Counseling',
                '💬 Private Mentor WhatsApp Group Access',
                '🤝 1-on-1 Direct Career Session Booking',
                '📊 Premium PDF Downloadable Reports',
                '🏅 Gold Pro Badge on Leaderboards'
            ],
            'is_active' => true
        ]);
    }
}
