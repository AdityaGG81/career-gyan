<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechnologyEngineeringSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'technology-engineering')->first();
        if (!$field) return;

        $careers = [
            ['name' => 'Software Engineer', 'icon' => 'fa-laptop-code', 'img' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹30L+', 'demand' => 'Very High'],
            ['name' => 'Electrical Engineer', 'icon' => 'fa-bolt', 'img' => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'High'],
            ['name' => 'Mechanical Engineer', 'icon' => 'fa-cogs', 'img' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'High'],
            ['name' => 'Civil Engineer', 'icon' => 'fa-helmet-safety', 'img' => 'https://images.unsplash.com/photo-1541888086925-920a0b22a0ce?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'High'],
            ['name' => 'Chemical Engineer', 'icon' => 'fa-flask', 'img' => 'https://images.unsplash.com/photo-1581093588401-fbb62a02f120?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹20L', 'demand' => 'Stable'],
            ['name' => 'Data Scientist', 'icon' => 'fa-brain', 'img' => 'https://images.unsplash.com/photo-1551288049-bbda38a594a0?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹40L+', 'demand' => 'Very High'],
            ['name' => 'Aerospace Engineer', 'icon' => 'fa-plane-up', 'img' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹25L', 'demand' => 'Growing'],
            ['name' => 'Cybersecurity Expert', 'icon' => 'fa-shield-halved', 'img' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹30L+', 'demand' => 'Very High'],
            ['name' => 'Robotics Engineer', 'icon' => 'fa-robot', 'img' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹25L', 'demand' => 'Growing'],
            ['name' => 'Automobile Engineer', 'icon' => 'fa-car', 'img' => 'https://images.unsplash.com/photo-1503376713835-1f81d1136bdf?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹20L', 'demand' => 'High'],
            ['name' => 'Electronics & Telecommunication Engineer', 'icon' => 'fa-satellite-dish', 'img' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'High'],
            ['name' => 'Cloud Solutions Architect', 'icon' => 'fa-cloud', 'img' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=800&q=80', 'salary' => '₹12L – ₹40L+', 'demand' => 'Very High'],
            ['name' => 'AI / Machine Learning Engineer', 'icon' => 'fa-network-wired', 'img' => 'https://images.unsplash.com/photo-1555255707-c07966088b7b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹10L – ₹45L+', 'demand' => 'Very High'],
            ['name' => 'Information Technology (IT) Engineer', 'icon' => 'fa-server', 'img' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹25L', 'demand' => 'High'],
            ['name' => 'Biomedical Engineer', 'icon' => 'fa-heart-pulse', 'img' => 'https://images.unsplash.com/photo-1530497610245-94d3c16cda28?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'Growing'],
        ];

        foreach ($careers as $c) {
            Career::updateOrCreate(
                ['slug' => Str::slug($c['name'])],
                [
                    'name'           => $c['name'],
                    'field_id'       => $field->id,
                    'description'    => $c['name'] . ' is a core engineering discipline requiring strong analytical and technical skills to innovate and solve complex real-world problems.',
                    'qualification'  => 'B.E / B.Tech in relevant branch',
                    'stream'         => 'Science (PCM)',
                    'salary_range'   => $c['salary'],
                    'demand_level'   => $c['demand'],
                    'icon'           => $c['icon'],
                    'image'          => $c['img'],
                    'roadmap'        => [
                        'Complete 10+2 with Science (Physics, Chemistry, Math)',
                        'Clear national or state level engineering entrance exams (JEE Main, MHT-CET, etc.)',
                        'Pursue a 4-year B.E. or B.Tech degree in the chosen engineering branch',
                        'Complete industrial internships and practical project work',
                        'Clear GATE exam if planning for M.Tech or PSU jobs',
                        'Join an IT firm, core engineering company, or launch a startup'
                    ],
                    'skills'         => ['Mathematics', 'Problem Solving', 'Logical Reasoning', 'Technical Aptitude', 'Teamwork'],
                    'future_scope'   => 'Engineering and Technology run the modern world. With AI and automation on the rise, highly skilled tech professionals are in massive global demand.',
                    'entrance_exams' => ['JEE Main', 'JEE Advanced', 'BITSAT', 'State CETs', 'GATE (for Masters)'],
                    'job_opportunities' => ['Tech Giants (Google, Microsoft)', 'Core Companies (L&T, Tata)', 'Startups', 'PSUs'],
                    'related_careers' => ['Product Manager', 'Research Scientist', 'Consultant'],
                ]
            );
        }
    }
}
