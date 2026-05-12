<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EngineeringFieldsSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'technology-engineering')->first();
        if (!$field) return;

        $careers = [
            ['name' => 'Electrical Engineer', 'icon' => 'fa-bolt', 'salary' => '₹4L – ₹15L', 'demand' => 'High'],
            ['name' => 'Chemical Engineer', 'icon' => 'fa-flask', 'salary' => '₹5L – ₹20L', 'demand' => 'Stable'],
            ['name' => 'Computer Engineer', 'icon' => 'fa-computer', 'salary' => '₹5L – ₹25L', 'demand' => 'Very High'],
            ['name' => 'IT Engineer', 'icon' => 'fa-network-wired', 'salary' => '₹4L – ₹18L', 'demand' => 'High'],
            ['name' => 'Electronics & Telecommunication Engineer', 'icon' => 'fa-satellite-dish', 'salary' => '₹4L – ₹18L', 'demand' => 'High'],
            ['name' => 'Civil Engineer', 'icon' => 'fa-helmet-safety', 'salary' => '₹4L – ₹15L', 'demand' => 'High'],
            ['name' => 'AI & Data Science Engineer', 'icon' => 'fa-brain', 'salary' => '₹8L – ₹40L', 'demand' => 'Very High'],
            ['name' => 'Mechanical Engineer', 'icon' => 'fa-cogs', 'salary' => '₹4L – ₹18L', 'demand' => 'High'],
            ['name' => 'Automobile Engineer', 'icon' => 'fa-car', 'salary' => '₹5L – ₹20L', 'demand' => 'High'],
            ['name' => 'Aerospace Engineer', 'icon' => 'fa-plane-up', 'salary' => '₹6L – ₹25L', 'demand' => 'Growing'],
            ['name' => 'Robotics Engineer', 'icon' => 'fa-robot', 'salary' => '₹6L – ₹25L', 'demand' => 'Growing'],
            ['name' => 'Cybersecurity Expert', 'icon' => 'fa-shield-halved', 'salary' => '₹8L – ₹30L', 'demand' => 'Very High'],
            ['name' => 'Software Engineer', 'icon' => 'fa-code', 'salary' => '₹6L – ₹30L', 'demand' => 'Very High'],
            ['name' => 'Cloud Solutions Architect', 'icon' => 'fa-cloud', 'salary' => '₹12L – ₹40L', 'demand' => 'Very High'],
            ['name' => 'Data Scientist', 'icon' => 'fa-chart-pie', 'salary' => '₹8L – ₹40L', 'demand' => 'Very High'],
        ];

        foreach ($careers as $c) {
            Career::updateOrCreate(
                ['slug' => Str::slug($c['name'])],
                [
                    'name'           => $c['name'],
                    'field_id'       => $field->id,
                    'description'    => $c['name'] . ' is a specialized engineering discipline requiring strong technical and analytical skills to design, develop and maintain complex systems.',
                    'qualification'  => 'B.E / B.Tech in relevant branch',
                    'stream'         => 'Science (PCM)',
                    'salary_range'   => $c['salary'],
                    'demand_level'   => $c['demand'],
                    'icon'           => $c['icon'],
                    'roadmap'        => [
                        'Complete 10+2 with Science (Physics, Chemistry, Math)',
                        'Clear engineering entrance exams (JEE Main, State CET, etc.)',
                        'Pursue B.E/B.Tech in ' . $c['name'],
                        'Gain practical experience through internships',
                        'Consider higher studies (M.Tech/MBA) for growth',
                        'Build strong technical and soft skills'
                    ],
                ]
            );
        }
    }
}
