<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ScienceSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'science')->first();
        if (!$field) return;

        $careers = [
            // Core Sciences (Physics, Chem, Bio)
            ['name' => 'Physicist', 'icon' => 'fa-atom', 'img' => 'https://images.unsplash.com/photo-1532094349884-543559c6571f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹20L', 'demand' => 'Stable'],
            ['name' => 'Chemist', 'icon' => 'fa-flask', 'img' => 'https://images.unsplash.com/photo-1581093588401-fbb62a02f120?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'High'],
            ['name' => 'Biologist', 'icon' => 'fa-leaf', 'img' => 'https://images.unsplash.com/photo-1532094349884-543559c6571f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹12L', 'demand' => 'Stable'],
            ['name' => 'Mathematician', 'icon' => 'fa-calculator', 'img' => 'https://images.unsplash.com/photo-1518133910546-b6c2fb7d79e3?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹18L', 'demand' => 'Stable'],
            ['name' => 'Statistician', 'icon' => 'fa-chart-pie', 'img' => 'https://images.unsplash.com/photo-1551288049-bbda38a594a0?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹20L', 'demand' => 'Very High'],

            // Specialized Life Sciences
            ['name' => 'Biotechnologist', 'icon' => 'fa-dna', 'img' => 'https://images.unsplash.com/photo-1532094349884-543559c6571f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹18L', 'demand' => 'High'],
            ['name' => 'Microbiologist', 'icon' => 'fa-microscope', 'img' => 'https://images.unsplash.com/photo-1581093588401-fbb62a02f120?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'High'],
            ['name' => 'Geneticist', 'icon' => 'fa-dna', 'img' => 'https://images.unsplash.com/photo-1532094349884-543559c6571f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹22L', 'demand' => 'Growing'],
            ['name' => 'Zoologist', 'icon' => 'fa-paw', 'img' => 'https://images.unsplash.com/photo-1583337130417-3346a1be7dee?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹10L', 'demand' => 'Stable'],
            ['name' => 'Botanist', 'icon' => 'fa-seedling', 'img' => 'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹10L', 'demand' => 'Stable'],

            // Earth, Space & Environmental
            ['name' => 'Astronomer / Astrophysicist', 'icon' => 'fa-meteor', 'img' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹25L', 'demand' => 'Stable'],
            ['name' => 'Geologist', 'icon' => 'fa-gem', 'img' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹18L', 'demand' => 'High'],
            ['name' => 'Meteorologist', 'icon' => 'fa-cloud-sun-rain', 'img' => 'https://images.unsplash.com/photo-1561484930-998b6a7b22e8?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Stable'],
            ['name' => 'Oceanographer', 'icon' => 'fa-water', 'img' => 'https://images.unsplash.com/photo-1518837695005-2083093ee35b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹18L', 'demand' => 'Stable'],
            ['name' => 'Environmental Scientist', 'icon' => 'fa-leaf', 'img' => 'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Growing'],

            // Forensics & Applied Science
            ['name' => 'Forensic Scientist', 'icon' => 'fa-fingerprint', 'img' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹12L', 'demand' => 'High'],
            ['name' => 'Food Scientist / Technologist', 'icon' => 'fa-burger', 'img' => 'https://images.unsplash.com/photo-1555244162-803834f70033?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'High'],
            ['name' => 'Agricultural Scientist', 'icon' => 'fa-wheat-awn', 'img' => 'https://images.unsplash.com/photo-1592982537447-7440770cbfc9?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Stable'],
            ['name' => 'Materials Scientist', 'icon' => 'fa-cubes', 'img' => 'https://images.unsplash.com/photo-1581093588401-fbb62a02f120?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹20L', 'demand' => 'Growing'],
            ['name' => 'Toxicologist', 'icon' => 'fa-skull-crossbones', 'img' => 'https://images.unsplash.com/photo-1532094349884-543559c6571f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'Stable'],

            // Academic & General
            ['name' => 'Science Professor / Lecturer', 'icon' => 'fa-chalkboard-user', 'img' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹20L', 'demand' => 'High'],
            ['name' => 'Clinical Research Associate', 'icon' => 'fa-clipboard-list', 'img' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Very High'],
            ['name' => 'Epidemiologist', 'icon' => 'fa-virus', 'img' => 'https://images.unsplash.com/photo-1584036561566-baf8f5f1b144?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹22L', 'demand' => 'Growing'],
            ['name' => 'Pharmacologist', 'icon' => 'fa-capsules', 'img' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹20L', 'demand' => 'High'],
            ['name' => 'Science Journalist/Writer', 'icon' => 'fa-pen-nib', 'img' => 'https://images.unsplash.com/photo-1455390582262-044cdead2708?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹12L', 'demand' => 'Stable'],
        ];

        foreach ($careers as $c) {
            Career::updateOrCreate(
                ['slug' => Str::slug($c['name'])],
                [
                    'name'           => $c['name'],
                    'field_id'       => $field->id,
                    'description'    => $c['name'] . ' is a dynamic career in the Pure and Applied Sciences focusing on research, discovery, and practical problem-solving.',
                    'qualification'  => 'B.Sc / M.Sc / Ph.D in relevant Science subject',
                    'stream'         => 'Science',
                    'salary_range'   => $c['salary'],
                    'demand_level'   => $c['demand'],
                    'icon'           => $c['icon'],
                    'image'          => $c['img'],
                    'roadmap'        => [
                        'Complete 10+2 with Science (PCB/PCM)',
                        'Pursue a Bachelor’s degree (B.Sc) in your chosen specialization',
                        'Clear entrance exams (like IIT-JAM) for reputed Master’s programs',
                        'Complete a Master’s degree (M.Sc)',
                        'Clear NET/GATE to pursue a Ph.D for research or academia',
                        'Publish research papers and attend global conferences'
                    ],
                    'skills'         => ['Analytical Thinking', 'Research Methodology', 'Curiosity', 'Data Analysis', 'Patience'],
                    'future_scope'   => 'Scientific research is fundamental to human progress. Careers in science lead to innovations in healthcare, environment, and technology.',
                    'entrance_exams' => ['CUET UG', 'IIT JAM', 'CSIR NET', 'GATE'],
                    'job_opportunities' => ['ISRO/DRDO', 'Pharmaceutical Labs', 'Universities', 'Environmental Agencies', 'Tech Companies'],
                    'related_careers' => ['Engineer', 'Medical Doctor', 'Data Scientist'],
                ]
            );
        }
    }
}
