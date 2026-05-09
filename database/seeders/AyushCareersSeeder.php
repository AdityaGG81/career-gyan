<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AyushCareersSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'ayush-allied')->first();
        if (!$field) return;

        $careers = [
            // AYUSH Doctors
            ['name' => 'BAMS Doctor (Ayurveda)', 'icon' => 'fa-leaf', 'img' => 'https://images.unsplash.com/photo-1515377905703-c4788e51af15?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'High'],
            ['name' => 'BHMS Doctor (Homeopathy)', 'icon' => 'fa-pills', 'img' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'demand' => 'Stable'],
            ['name' => 'BUMS Doctor (Unani)', 'icon' => 'fa-mortar-pestle', 'img' => 'https://images.unsplash.com/photo-1596040033229-a9821ebd058d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹10L', 'demand' => 'Stable'],
            ['name' => 'BNYS Doctor (Naturopathy & Yoga)', 'icon' => 'fa-om', 'img' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Growing'],
            ['name' => 'BSMS Doctor (Siddha)', 'icon' => 'fa-spa', 'img' => 'https://images.unsplash.com/photo-1544161515-4ab6ce6db874?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹10L', 'demand' => 'Niche'],

            // Allied Health / Therapy
            ['name' => 'Physiotherapist (BPT)', 'icon' => 'fa-person-walking-with-cane', 'img' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Very High'],
            ['name' => 'Occupational Therapist', 'icon' => 'fa-hands-holding-child', 'img' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹12L', 'demand' => 'Growing'],
            ['name' => 'Speech Therapist / Audiologist', 'icon' => 'fa-ear-listen', 'img' => 'https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹18L', 'demand' => 'High'],
            ['name' => 'Clinical Psychologist', 'icon' => 'fa-brain', 'img' => 'https://images.unsplash.com/photo-1555580226-5b65103c2fa5?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹20L', 'demand' => 'Very High'],
            ['name' => 'Dietitian / Nutritionist', 'icon' => 'fa-apple-whole', 'img' => 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'High'],

            // Diagnostics & Technicians
            ['name' => 'Medical Lab Technologist (BMLT)', 'icon' => 'fa-microscope', 'img' => 'https://images.unsplash.com/photo-1581093588401-fbb62a02f120?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹10L', 'demand' => 'High'],
            ['name' => 'Radiology & Imaging Technologist', 'icon' => 'fa-x-ray', 'img' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹12L', 'demand' => 'High'],
            ['name' => 'Optometrist', 'icon' => 'fa-glasses', 'img' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'High'],
            ['name' => 'Operation Theatre Technologist', 'icon' => 'fa-bed-pulse', 'img' => 'https://images.unsplash.com/photo-1551076805-e1869043e560?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3.5L – ₹10L', 'demand' => 'Stable'],
            ['name' => 'Cardiovascular Technologist', 'icon' => 'fa-heart-pulse', 'img' => 'https://images.unsplash.com/photo-1530497610245-94d3c16cda28?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹12L', 'demand' => 'High'],

            // Medical Assistants & Care
            ['name' => 'Nursing (B.Sc Nursing / GNM)', 'icon' => 'fa-user-nurse', 'img' => 'https://images.unsplash.com/photo-1582750433449-648ed127d09e?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'demand' => 'Very High'],
            ['name' => 'Respiratory Therapist', 'icon' => 'fa-lungs', 'img' => 'https://images.unsplash.com/photo-1584036561566-baf8f5f1b144?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹12L', 'demand' => 'Growing'],
            ['name' => 'Dialysis Technologist', 'icon' => 'fa-droplet', 'img' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹9L', 'demand' => 'Stable'],
            ['name' => 'Medical Record Technician', 'icon' => 'fa-file-medical', 'img' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2.5L – ₹8L', 'demand' => 'Stable'],
            ['name' => 'Emergency Medical Technician (EMT)', 'icon' => 'fa-truck-medical', 'img' => 'https://images.unsplash.com/photo-1587556202022-dfa68452ba3b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹8L', 'demand' => 'High'],

            // Fill up remaining
            ['name' => 'Ayurvedic Pharmacist', 'icon' => 'fa-mortar-pestle', 'img' => 'https://images.unsplash.com/photo-1596040033229-a9821ebd058d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹9L', 'demand' => 'Stable'],
            ['name' => 'Yoga Instructor / Therapist', 'icon' => 'fa-person-praying', 'img' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'demand' => 'Growing'],
            ['name' => 'Medical Social Worker', 'icon' => 'fa-hand-holding-heart', 'img' => 'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹8L', 'demand' => 'Stable'],
            ['name' => 'Public Health Educator', 'icon' => 'fa-bullhorn', 'img' => 'https://images.unsplash.com/photo-1555580226-5b65103c2fa5?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹12L', 'demand' => 'Stable'],
            ['name' => 'Anesthesia Technologist', 'icon' => 'fa-mask-ventilator', 'img' => 'https://images.unsplash.com/photo-1551076805-e1869043e560?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹12L', 'demand' => 'High'],
            ['name' => 'Perfusion Technologist', 'icon' => 'fa-heart-circle-bolt', 'img' => 'https://images.unsplash.com/photo-1530497610245-94d3c16cda28?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹15L', 'demand' => 'Stable'],
            ['name' => 'Ayush Medical Officer', 'icon' => 'fa-user-shield', 'img' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹15L', 'demand' => 'High'],
        ];

        foreach ($careers as $c) {
            Career::updateOrCreate(
                ['slug' => Str::slug($c['name'])],
                [
                    'name'           => $c['name'],
                    'field_id'       => $field->id,
                    'description'    => $c['name'] . ' is an essential healthcare profession focused on holistic healing, rehabilitation, or assisting in critical medical procedures.',
                    'qualification'  => 'Undergraduate Degree (e.g., BAMS, BHMS, BPT, B.Sc Nursing)',
                    'stream'         => 'Science (PCB)',
                    'salary_range'   => $c['salary'],
                    'demand_level'   => $c['demand'] === 'Niche' ? 'Stable' : $c['demand'], // sanitize to avoid DB constraint error
                    'icon'           => $c['icon'],
                    'image'          => $c['img'],
                    'roadmap'        => [
                        'Complete 12th Science with Physics, Chemistry, and Biology (PCB)',
                        'Clear NEET-UG (for AYUSH courses) or State level CET (for Allied Health)',
                        'Enroll in a recognized university for the respective 3 to 5.5-year degree',
                        'Complete a mandatory clinical internship (usually 6 months to 1 year)',
                        'Register with the respective national/state medical or nursing council',
                        'Apply for jobs in hospitals, clinics, or start independent practice',
                    ],
                    'skills'         => ['Empathy', 'Communication', 'Attention to Detail', 'Stamina', 'Clinical Knowledge'],
                    'future_scope'   => 'With a global shift towards holistic wellness and a growing aging population, the demand for AYUSH doctors and allied health professionals is skyrocketing.',
                    'entrance_exams' => ['NEET-UG', 'AIAPGET', 'State CETs', 'AIIMS Nursing Entrance'],
                    'job_opportunities' => ['Government Hospitals', 'Private Clinics', 'Wellness Centers', 'Sports Facilities', 'NGOs'],
                    'related_careers' => ['Medical Doctor', 'Healthcare Administrator', 'Fitness Coach'],
                ]
            );
        }
    }
}
