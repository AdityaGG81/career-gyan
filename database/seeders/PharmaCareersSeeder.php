<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PharmaCareersSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'pharmacy')->first();
        if (!$field) return;

        $careers = [
            // Core Pharmacy & Retail
            ['name' => 'Pharmacist (Retail/Community)', 'icon' => 'fa-prescription-bottle-medical', 'img' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹10L', 'demand' => 'High'],
            ['name' => 'Hospital Pharmacist', 'icon' => 'fa-hospital', 'img' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹12L', 'demand' => 'High'],
            ['name' => 'Clinical Pharmacist', 'icon' => 'fa-stethoscope', 'img' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹15L', 'demand' => 'Growing'],
            ['name' => 'Pharmacy Store Owner / Entrepreneur', 'icon' => 'fa-store', 'img' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹30L+', 'demand' => 'High'],
            ['name' => 'Veterinary Pharmacist', 'icon' => 'fa-paw', 'img' => 'https://images.unsplash.com/photo-1583337130417-3346a1be7dee?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹12L', 'demand' => 'Stable'],

            // Research & Development (R&D)
            ['name' => 'Research Scientist (Pharma)', 'icon' => 'fa-microscope', 'img' => 'https://images.unsplash.com/photo-1532094349884-543559c6571f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹25L', 'demand' => 'High'],
            ['name' => 'Formulation Scientist', 'icon' => 'fa-vial', 'img' => 'https://images.unsplash.com/photo-1581093588401-fbb62a02f120?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹20L', 'demand' => 'High'],
            ['name' => 'Clinical Research Associate (CRA)', 'icon' => 'fa-file-medical', 'img' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Very High'],
            ['name' => 'Pharmacologist', 'icon' => 'fa-flask', 'img' => 'https://images.unsplash.com/photo-1581093588401-fbb62a02f120?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹25L', 'demand' => 'High'],
            ['name' => 'Toxicologist', 'icon' => 'fa-skull-crossbones', 'img' => 'https://images.unsplash.com/photo-1532094349884-543559c6571f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹22L', 'demand' => 'Stable'],

            // Regulatory & Quality Assurance
            ['name' => 'Drug Inspector (Government)', 'icon' => 'fa-user-shield', 'img' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹20L', 'demand' => 'High'],
            ['name' => 'Quality Control (QC) Chemist', 'icon' => 'fa-check-double', 'img' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'demand' => 'High'],
            ['name' => 'Quality Assurance (QA) Manager', 'icon' => 'fa-clipboard-check', 'img' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹25L', 'demand' => 'High'],
            ['name' => 'Regulatory Affairs Specialist', 'icon' => 'fa-scale-balanced', 'img' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹20L', 'demand' => 'Very High'],
            ['name' => 'Pharmacovigilance Scientist', 'icon' => 'fa-eye', 'img' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'Very High'],

            // Manufacturing & Operations
            ['name' => 'Production Chemist/Manager', 'icon' => 'fa-industry', 'img' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹20L', 'demand' => 'Stable'],
            ['name' => 'Packaging Development Manager', 'icon' => 'fa-box', 'img' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹18L', 'demand' => 'Stable'],
            ['name' => 'Supply Chain Manager (Pharma)', 'icon' => 'fa-truck-fast', 'img' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹25L', 'demand' => 'High'],
            
            // Sales, Marketing & Data
            ['name' => 'Medical Representative (MR)', 'icon' => 'fa-briefcase-medical', 'img' => 'https://images.unsplash.com/photo-1556761175-4b46a572b786?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'demand' => 'Very High'],
            ['name' => 'Pharma Product Manager', 'icon' => 'fa-boxes-stacked', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹30L', 'demand' => 'High'],
            ['name' => 'Medical Science Liaison (MSL)', 'icon' => 'fa-user-doctor', 'img' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?auto=format&fit=crop&w=800&q=80', 'salary' => '₹10L – ₹35L', 'demand' => 'Growing'],
            ['name' => 'Medical Writer', 'icon' => 'fa-pen-nib', 'img' => 'https://images.unsplash.com/photo-1455390582262-044cdead2708?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'High'],
            ['name' => 'Pharma Data Analyst', 'icon' => 'fa-chart-pie', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹20L', 'demand' => 'Growing'],

            // Fill up remaining to make it comprehensive
            ['name' => 'Biotechnologist', 'icon' => 'fa-dna', 'img' => 'https://images.unsplash.com/photo-1532094349884-543559c6571f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹22L', 'demand' => 'High'],
            ['name' => 'Cosmetic Chemist', 'icon' => 'fa-spray-can', 'img' => 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'Stable'],
            ['name' => 'Pharmaceutical Professor / Lecturer', 'icon' => 'fa-chalkboard-user', 'img' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹20L', 'demand' => 'Stable'],
            ['name' => 'Clinical Data Manager', 'icon' => 'fa-database', 'img' => 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹25L', 'demand' => 'Growing'],
            ['name' => 'Biostatistician', 'icon' => 'fa-calculator', 'img' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹30L', 'demand' => 'High'],
            ['name' => 'Nutraceuticals Expert', 'icon' => 'fa-apple-whole', 'img' => 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Growing'],
            ['name' => 'Nuclear Pharmacist', 'icon' => 'fa-radiation', 'img' => 'https://images.unsplash.com/photo-1532094349884-543559c6571f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹35L', 'demand' => 'Stable'],
        ];

        foreach ($careers as $c) {
            Career::updateOrCreate(
                ['slug' => Str::slug($c['name'])],
                [
                    'name'           => $c['name'],
                    'field_id'       => $field->id,
                    'description'    => $c['name'] . ' is a vital role in the healthcare ecosystem, bridging the gap between medicine manufacturing and patient care.',
                    'qualification'  => 'B.Pharm / M.Pharm / Pharm.D / Ph.D in Pharmacy',
                    'stream'         => 'Science (PCB / PCM)',
                    'salary_range'   => $c['salary'],
                    'demand_level'   => $c['demand'],
                    'icon'           => $c['icon'],
                    'image'          => $c['img'],
                    'roadmap'        => [
                        'Complete 12th standard with Science (PCB/PCM)',
                        'Clear state/national level pharmacy entrance exams (e.g., MHT-CET, NEET)',
                        'Complete B.Pharm (4 years) or Pharm.D (6 years)',
                        'Register with the State Pharmacy Council to get a license',
                        'Pursue M.Pharm/MBA for advanced roles in R&D or Management',
                        'Apply to hospitals, pharma companies, or start a retail pharmacy',
                    ],
                    'skills'         => ['Attention to Detail', 'Analytical Skills', 'Chemistry Knowledge', 'Ethics', 'Communication'],
                    'future_scope'   => 'India is known as the "Pharmacy of the World". The pharmaceutical sector is highly recession-proof and offers global opportunities.',
                    'entrance_exams' => ['NEET', 'MHT-CET', 'GPAT (for Masters)', 'NIPER JEE'],
                    'job_opportunities' => ['Pharma MNCs (Sun Pharma, Cipla)', 'Hospitals', 'Clinical Research Orgs (CROs)', 'Government Sectors'],
                    'related_careers' => ['Doctor', 'Biomedical Engineer', 'Chemical Engineer'],
                ]
            );
        }
    }
}
