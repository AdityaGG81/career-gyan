<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechnologyEngineeringExpansionSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'technology-engineering')->first();
        if (!$field) return;

        $careers = [
            ['name' => 'Software Engineer', 'icon' => 'fa-laptop-code', 'img' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹30L+', 'demand' => 'Very High'],
            ['name' => 'Full Stack Developer', 'icon' => 'fa-layer-group', 'img' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹25L+', 'demand' => 'Very High'],
            ['name' => 'Data Scientist', 'icon' => 'fa-chart-pie', 'img' => 'https://images.unsplash.com/photo-1551288049-bbda38a594a0?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹40L+', 'demand' => 'Very High'],
            ['name' => 'Cyber Security Engineer', 'icon' => 'fa-shield-halved', 'img' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹30L+', 'demand' => 'Very High'],
            ['name' => 'Cloud Engineer', 'icon' => 'fa-cloud', 'img' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=800&q=80', 'salary' => '₹10L – ₹35L+', 'demand' => 'Very High'],
            ['name' => 'DevOps Engineer', 'icon' => 'fa-infinity', 'img' => 'https://images.unsplash.com/photo-1618401471353-b98afee0b2eb?auto=format&fit=crop&w=800&q=80', 'salary' => '₹10L – ₹35L+', 'demand' => 'Very High'],
            ['name' => 'Robotics Engineer', 'icon' => 'fa-robot', 'img' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹25L', 'demand' => 'Growing'],
            ['name' => 'Aerospace Engineer', 'icon' => 'fa-plane-up', 'img' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹25L', 'demand' => 'Growing'],
            ['name' => 'Aeronautical Engineer', 'icon' => 'fa-plane', 'img' => 'https://images.unsplash.com/photo-1555580226-5b65103c2fa5?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹22L', 'demand' => 'Stable'],
            ['name' => 'Civil Site Engineer', 'icon' => 'fa-helmet-safety', 'img' => 'https://images.unsplash.com/photo-1541888086925-920a0b22a0ce?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'demand' => 'High'],
            ['name' => 'Structural Engineer', 'icon' => 'fa-building', 'img' => 'https://images.unsplash.com/photo-1517581177682-a085bb7ffb15?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'High'],
            ['name' => 'Electrical Design Engineer', 'icon' => 'fa-lightbulb', 'img' => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'High'],
            ['name' => 'Power Systems Engineer', 'icon' => 'fa-plug-circle-bolt', 'img' => 'https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹16L', 'demand' => 'Stable'],
            ['name' => 'Embedded Systems Engineer', 'icon' => 'fa-microchip', 'img' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹18L', 'demand' => 'Growing'],
            ['name' => 'VLSI Engineer', 'icon' => 'fa-memory', 'img' => 'https://images.unsplash.com/photo-1553341640-6b28f1ed1bfc?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹25L', 'demand' => 'High'],
            ['name' => 'Electronics Engineer', 'icon' => 'fa-satellite-dish', 'img' => 'https://images.unsplash.com/photo-1517077304055-6e89abbf09b0?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Stable'],
            ['name' => 'IoT Engineer', 'icon' => 'fa-network-wired', 'img' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹20L', 'demand' => 'Growing'],
            ['name' => 'Blockchain Developer', 'icon' => 'fa-link', 'img' => 'https://images.unsplash.com/photo-1639762681485-074b7f4fec07?auto=format&fit=crop&w=800&q=80', 'salary' => '₹10L – ₹40L+', 'demand' => 'Growing'],
            ['name' => 'Game Developer', 'icon' => 'fa-gamepad', 'img' => 'https://images.unsplash.com/photo-1556438064-2d7646166914?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹25L', 'demand' => 'High'],
            ['name' => 'AR/VR Developer', 'icon' => 'fa-vr-cardboard', 'img' => 'https://images.unsplash.com/photo-1622979135225-d2ba269cf1ac?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹25L', 'demand' => 'Growing'],
            ['name' => 'UI/UX Designer', 'icon' => 'fa-pen-nib', 'img' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹20L', 'demand' => 'High'],
            ['name' => 'Computer Vision Engineer', 'icon' => 'fa-eye', 'img' => 'https://images.unsplash.com/photo-1555255707-c07966088b7b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹35L', 'demand' => 'Growing'],
            ['name' => 'AI Research Engineer', 'icon' => 'fa-brain', 'img' => 'https://images.unsplash.com/photo-1620712943543-bcc4688e7485?auto=format&fit=crop&w=800&q=80', 'salary' => '₹12L – ₹45L+', 'demand' => 'Very High'],
            ['name' => 'Data Engineer', 'icon' => 'fa-database', 'img' => 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹30L+', 'demand' => 'Very High'],
            ['name' => 'Network Engineer', 'icon' => 'fa-server', 'img' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Stable'],
            ['name' => 'Ethical Hacker', 'icon' => 'fa-user-secret', 'img' => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹20L', 'demand' => 'High'],
            ['name' => 'Industrial Engineer', 'icon' => 'fa-industry', 'img' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Stable'],
            ['name' => 'Mechatronics Engineer', 'icon' => 'fa-gears', 'img' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹18L', 'demand' => 'Growing'],
            ['name' => 'Environmental Engineer', 'icon' => 'fa-leaf', 'img' => 'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Growing'],
            ['name' => 'Renewable Energy Engineer', 'icon' => 'fa-solar-panel', 'img' => 'https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹18L', 'demand' => 'High'],
        ];

        foreach ($careers as $c) {
            Career::updateOrCreate(
                ['slug' => Str::slug($c['name'])],
                [
                    'name'           => $c['name'],
                    'field_id'       => $field->id,
                    'description'    => $c['name'] . ' is an advanced and in-demand role blending specialized engineering principles with modern technological innovation.',
                    'qualification'  => 'B.E / B.Tech / B.Sc in related field',
                    'stream'         => 'Science (PCM)',
                    'salary_range'   => $c['salary'],
                    'demand_level'   => $c['demand'],
                    'icon'           => $c['icon'],
                    'image'          => $c['img'],
                    'roadmap'        => [
                        'Complete 10+2 with Physics, Chemistry, and Mathematics',
                        'Clear engineering entrance exams (JEE Main, State CET)',
                        'Pursue an undergraduate degree in a relevant engineering or tech field',
                        'Gain practical experience through internships and industrial projects',
                        'Learn high-demand technical skills and software relevant to the niche',
                        'Obtain certifications and apply for entry-level engineering roles'
                    ],
                    'skills'         => ['Technical Aptitude', 'Problem Solving', 'Mathematics', 'Software Proficiency', 'Innovation'],
                    'future_scope'   => 'With rapid advancements in AI, automation, and sustainable energy, this field is highly future-proof and offers exceptional global opportunities.',
                    'entrance_exams' => ['JEE Main', 'JEE Advanced', 'GATE', 'State CETs'],
                    'job_opportunities' => ['Tech Giants', 'Core Engineering Firms', 'Government Sectors', 'Startups', 'Research Labs'],
                    'related_careers' => ['Consultant', 'Project Manager', 'Research Scientist'],
                ]
            );
        }
    }
}
