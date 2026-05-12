<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechnologyEngineeringMainExpansionSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'technology-engineering')->first();
        if (!$field) return;

        $careers = [
            ['name' => 'Software Engineer', 'icon' => 'fa-laptop-code', 'img' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Full Stack Developer', 'icon' => 'fa-layer-group', 'img' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Data Scientist', 'icon' => 'fa-chart-pie', 'img' => 'https://images.unsplash.com/photo-1551288049-bbda38a594a0?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Cyber Security Engineer', 'icon' => 'fa-shield-halved', 'img' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Cloud Engineer', 'icon' => 'fa-cloud', 'img' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'DevOps Engineer', 'icon' => 'fa-infinity', 'img' => 'https://images.unsplash.com/photo-1618401471353-b98afee0b2eb?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Robotics Engineer', 'icon' => 'fa-robot', 'img' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Aerospace Engineer', 'icon' => 'fa-plane-up', 'img' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Aeronautical Engineer', 'icon' => 'fa-plane', 'img' => 'https://images.unsplash.com/photo-1555580226-5b65103c2fa5?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Civil Site Engineer', 'icon' => 'fa-helmet-safety', 'img' => 'https://images.unsplash.com/photo-1541888086925-920a0b22a0ce?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Structural Engineer', 'icon' => 'fa-building', 'img' => 'https://images.unsplash.com/photo-1517581177682-a085bb7ffb15?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Electrical Design Engineer', 'icon' => 'fa-lightbulb', 'img' => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Power Systems Engineer', 'icon' => 'fa-plug-circle-bolt', 'img' => 'https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Embedded Systems Engineer', 'icon' => 'fa-microchip', 'img' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'VLSI Engineer', 'icon' => 'fa-memory', 'img' => 'https://images.unsplash.com/photo-1553341640-6b28f1ed1bfc?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Electronics Engineer', 'icon' => 'fa-satellite-dish', 'img' => 'https://images.unsplash.com/photo-1517077304055-6e89abbf09b0?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'IoT Engineer', 'icon' => 'fa-network-wired', 'img' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Blockchain Developer', 'icon' => 'fa-link', 'img' => 'https://images.unsplash.com/photo-1639762681485-074b7f4fec07?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Game Developer', 'icon' => 'fa-gamepad', 'img' => 'https://images.unsplash.com/photo-1556438064-2d7646166914?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'AR/VR Developer', 'icon' => 'fa-vr-cardboard', 'img' => 'https://images.unsplash.com/photo-1622979135225-d2ba269cf1ac?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'UI/UX Designer', 'icon' => 'fa-pen-nib', 'img' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Computer Vision Engineer', 'icon' => 'fa-eye', 'img' => 'https://images.unsplash.com/photo-1555255707-c07966088b7b?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'AI Research Engineer', 'icon' => 'fa-brain', 'img' => 'https://images.unsplash.com/photo-1620712943543-bcc4688e7485?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Data Engineer', 'icon' => 'fa-database', 'img' => 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Network Engineer', 'icon' => 'fa-server', 'img' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Ethical Hacker', 'icon' => 'fa-user-secret', 'img' => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Industrial Engineer', 'icon' => 'fa-industry', 'img' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Mechatronics Engineer', 'icon' => 'fa-gears', 'img' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Environmental Engineer', 'icon' => 'fa-leaf', 'img' => 'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?auto=format&fit=crop&w=800&q=80'],
            ['name' => 'Renewable Energy Engineer', 'icon' => 'fa-solar-panel', 'img' => 'https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=800&q=80'],
        ];

        foreach ($careers as $c) {
            Career::updateOrCreate(
                ['slug' => Str::slug($c['name'])],
                [
                    'field_id'       => $field->id,
                    'name'           => $c['name'],
                    'description'    => $c['name'] . ' is a premier engineering and technology career path shaping the digital and physical future.',
                    'qualification'  => 'B.E / B.Tech in relevant domain',
                    'stream'         => 'Science (PCM)',
                    'salary_range'   => '₹8L – ₹30L+',
                    'demand_level'   => 'Very High',
                    'icon'           => $c['icon'],
                    'image'          => $c['img'],
                    'roadmap'        => [
                        'Complete 10+2 with Physics, Chemistry, and Mathematics',
                        'Clear engineering entrance exams (JEE Main, State CET)',
                        'Pursue an undergraduate degree in the specific engineering domain',
                        'Learn high-demand technical skills and relevant software tools',
                        'Gain hands-on experience through internships and industrial projects',
                        'Obtain certifications and apply for professional engineering roles'
                    ],
                    'skills'         => ['Technical Aptitude', 'Problem Solving', 'Mathematics', 'Software Proficiency', 'Innovation'],
                    'future_scope'   => 'With rapid advancements in AI, automation, and sustainable technologies, this engineering discipline is highly future-proof.',
                    'entrance_exams' => ['JEE Main', 'JEE Advanced', 'GATE', 'State CETs'],
                    'job_opportunities' => ['Tech Giants', 'Core Engineering Firms', 'Government PSUs', 'Startups', 'Research Labs'],
                    'related_careers' => ['Consultant', 'Project Manager', 'Research Scientist'],
                ]
            );
        }
    }
}
