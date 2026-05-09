<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ModernTechCareersSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'modern-tech')->first();
        if (!$field) return;

        $careers = [
            // AI & Data
            ['name' => 'AI/ML Engineer', 'icon' => 'fa-robot', 'img' => 'https://images.unsplash.com/photo-1555255707-c07966088b7b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹10L – ₹40L', 'demand' => 'Very High'],
            ['name' => 'Data Scientist', 'icon' => 'fa-chart-pie', 'img' => 'https://images.unsplash.com/photo-1551288049-bbda38a594a0?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹35L', 'demand' => 'Very High'],
            ['name' => 'Data Analyst', 'icon' => 'fa-chart-bar', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹18L', 'demand' => 'High'],
            ['name' => 'Data Engineer', 'icon' => 'fa-database', 'img' => 'https://images.unsplash.com/photo-1542831371-29b0f74f9713?auto=format&fit=crop&w=800&q=80', 'salary' => '₹9L – ₹30L', 'demand' => 'Very High'],
            ['name' => 'NLP Engineer', 'icon' => 'fa-language', 'img' => 'https://images.unsplash.com/photo-1555255707-c07966088b7b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹12L – ₹45L', 'demand' => 'Very High'],

            // Software Development
            ['name' => 'Full Stack Developer', 'icon' => 'fa-code', 'img' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹35L', 'demand' => 'High'],
            ['name' => 'Frontend Developer', 'icon' => 'fa-desktop', 'img' => 'https://images.unsplash.com/photo-1547658719-da2b51169166?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹25L', 'demand' => 'High'],
            ['name' => 'Backend Developer', 'icon' => 'fa-server', 'img' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹30L', 'demand' => 'High'],
            ['name' => 'Mobile App Developer', 'icon' => 'fa-mobile-screen', 'img' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹28L', 'demand' => 'High'],
            ['name' => 'Game Developer', 'icon' => 'fa-gamepad', 'img' => 'https://images.unsplash.com/photo-1552820728-8b83bb6b773f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹25L', 'demand' => 'Growing'],

            // Cloud & DevOps
            ['name' => 'Cloud Architect', 'icon' => 'fa-cloud', 'img' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=800&q=80', 'salary' => '₹15L – ₹50L', 'demand' => 'Very High'],
            ['name' => 'DevOps Engineer', 'icon' => 'fa-infinity', 'img' => 'https://images.unsplash.com/photo-1618401471353-b98afee0b2eb?auto=format&fit=crop&w=800&q=80', 'salary' => '₹10L – ₹35L', 'demand' => 'Very High'],
            ['name' => 'Site Reliability Engineer', 'icon' => 'fa-triangle-exclamation', 'img' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80', 'salary' => '₹12L – ₹40L', 'demand' => 'High'],
            ['name' => 'Systems Administrator', 'icon' => 'fa-network-wired', 'img' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Stable'],
            ['name' => 'Database Administrator', 'icon' => 'fa-database', 'img' => 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹20L', 'demand' => 'Stable'],

            // Cybersecurity
            ['name' => 'Cybersecurity Analyst', 'icon' => 'fa-shield-halved', 'img' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹7L – ₹25L', 'demand' => 'Very High'],
            ['name' => 'Ethical Hacker', 'icon' => 'fa-user-secret', 'img' => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹20L', 'demand' => 'High'],
            ['name' => 'Information Security Manager', 'icon' => 'fa-lock', 'img' => 'https://images.unsplash.com/photo-1510511459019-5efa3274ba52?auto=format&fit=crop&w=800&q=80', 'salary' => '₹15L – ₹45L', 'demand' => 'High'],
            ['name' => 'Penetration Tester', 'icon' => 'fa-bug', 'img' => 'https://images.unsplash.com/photo-1555949963-aa79dcee981c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹28L', 'demand' => 'High'],
            ['name' => 'Forensic Computer Analyst', 'icon' => 'fa-magnifying-glass', 'img' => 'https://images.unsplash.com/photo-1563206767-5b18f218e8de?auto=format&fit=crop&w=800&q=80', 'salary' => '₹7L – ₹22L', 'demand' => 'Growing'],

            // UI/UX & Product
            ['name' => 'UX/UI Designer', 'icon' => 'fa-pen-nib', 'img' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹25L', 'demand' => 'High'],
            ['name' => 'Product Manager', 'icon' => 'fa-boxes-stacked', 'img' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80', 'salary' => '₹12L – ₹50L', 'demand' => 'Very High'],
            ['name' => 'Scrum Master', 'icon' => 'fa-list-check', 'img' => 'https://images.unsplash.com/photo-1531403009284-440f080d1e12?auto=format&fit=crop&w=800&q=80', 'salary' => '₹10L – ₹30L', 'demand' => 'High'],
            ['name' => 'Technical Writer', 'icon' => 'fa-file-lines', 'img' => 'https://images.unsplash.com/photo-1455390582262-044cdead2708?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹18L', 'demand' => 'Stable'],
            ['name' => 'Quality Assurance (QA) Tester', 'icon' => 'fa-check-double', 'img' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Stable'],

            // Emerging Tech
            ['name' => 'Blockchain Developer', 'icon' => 'fa-link', 'img' => 'https://images.unsplash.com/photo-1621416894569-0f39ed31d247?auto=format&fit=crop&w=800&q=80', 'salary' => '₹10L – ₹45L', 'demand' => 'High'],
            ['name' => 'Web3 Engineer', 'icon' => 'fa-globe', 'img' => 'https://images.unsplash.com/photo-1639762681485-074b7f4ec651?auto=format&fit=crop&w=800&q=80', 'salary' => '₹12L – ₹50L', 'demand' => 'Growing'],
            ['name' => 'AR/VR Developer', 'icon' => 'fa-vr-cardboard', 'img' => 'https://images.unsplash.com/photo-1593508512255-86ab42a8e620?auto=format&fit=crop&w=800&q=80', 'salary' => '₹7L – ₹28L', 'demand' => 'Growing'],
            ['name' => 'IoT Solutions Architect', 'icon' => 'fa-microchip', 'img' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80', 'salary' => '₹12L – ₹40L', 'demand' => 'High'],
            ['name' => 'Robotics Engineer', 'icon' => 'fa-robot', 'img' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹30L', 'demand' => 'Growing'],
        ];

        foreach ($careers as $c) {
            Career::updateOrCreate(
                ['slug' => Str::slug($c['name'])],
                [
                    'name'           => $c['name'],
                    'field_id'       => $field->id,
                    'description'    => $c['name'] . ' is a modern tech career path, heavily focused on building the digital future, automation, and advanced software systems.',
                    'qualification'  => 'B.Tech/B.E in CS/IT, BCA/MCA, or relevant bootcamps',
                    'stream'         => 'Science (PCM) / Computer Science',
                    'salary_range'   => $c['salary'],
                    'demand_level'   => $c['demand'],
                    'icon'           => $c['icon'],
                    'image'          => $c['img'],
                    'roadmap'        => [
                        'Learn programming basics (Python, JavaScript, Java)',
                        'Build personal projects and a strong portfolio',
                        'Earn a degree or complete an intensive bootcamp',
                        'Master specialized frameworks (React, Node, PyTorch, AWS)',
                        'Contribute to open-source or do internships',
                        'Apply for junior roles and clear technical interviews',
                        'Upskill continuously as technology evolves',
                    ],
                    'skills'         => ['Coding', 'Problem Solving', 'Logical Thinking', 'Continuous Learning', 'System Design'],
                    'future_scope'   => 'The technology sector is the fastest-growing industry globally. AI, Cloud, and Web3 are creating millions of high-paying jobs with excellent remote work flexibility.',
                    'entrance_exams' => ['JEE Main/Advanced', 'BITSAT', 'VITEEE', 'GATE (for Masters)'],
                    'job_opportunities' => ['MNCs (Google, Amazon)', 'Tech Startups', 'Fintech', 'Remote Global Roles', 'Freelance'],
                    'related_careers' => ['Software Architect', 'IT Consultant', 'Tech Lead'],
                ]
            );
        }
    }
}
