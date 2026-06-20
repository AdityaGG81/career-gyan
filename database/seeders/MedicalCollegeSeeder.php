<?php

namespace Database\Seeders;

use App\Models\College;
use App\Models\Field;
use Illuminate\Database\Seeder;

class MedicalCollegeSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'medical')->first();
        if (!$field) {
            $field = Field::create([
                'name' => 'Medical',
                'slug' => 'medical',
                'icon' => 'fa-stethoscope',
                'color' => '#16a34a',
                'bg_color' => '#dcfce7'
            ]);
        }

        $collegesData = [
            // Mumbai
            ['name' => 'Seth GS Medical College', 'location' => 'Mumbai', 'type' => 'Government'],
            ['name' => 'Grant Medical College', 'location' => 'Mumbai', 'type' => 'Government'],
            ['name' => 'Lokmanya Tilak Municipal Medical College', 'location' => 'Mumbai', 'type' => 'Government'],
            ['name' => 'Topiwala National Medical College', 'location' => 'Mumbai', 'type' => 'Government'],
            ['name' => 'KJ Somaiya Medical College', 'location' => 'Mumbai', 'type' => 'Private'],

            // Pune
            ['name' => 'Armed Forces Medical College', 'location' => 'Pune', 'type' => 'Government', 'rank' => 1],
            ['name' => 'BJ Government Medical College', 'location' => 'Pune', 'type' => 'Government'],
            ['name' => 'Dr. D. Y. Patil Medical College Pune', 'location' => 'Pune', 'type' => 'Private'],
            ['name' => 'Bharati Vidyapeeth Medical College Pune', 'location' => 'Pune', 'type' => 'Deemed'],
            ['name' => 'Symbiosis Medical College for Women', 'location' => 'Pune', 'type' => 'Private'],

            // Nagpur
            ['name' => 'AIIMS Nagpur', 'location' => 'Nagpur', 'type' => 'Government'],
            ['name' => 'Government Medical College Nagpur', 'location' => 'Nagpur', 'type' => 'Government'],
            ['name' => 'NKP Salve Institute of Medical Sciences', 'location' => 'Nagpur', 'type' => 'Private'],

            // Nashik
            ['name' => 'Dr. Vasantrao Pawar Medical College', 'location' => 'Nashik', 'type' => 'Private'],
            ['name' => 'SMBT Institute of Medical Sciences', 'location' => 'Nashik', 'type' => 'Private'],

            // Sambhajinagar
            ['name' => 'Government Medical College Sambhajinagar', 'location' => 'Sambhajinagar', 'type' => 'Government'],
            ['name' => 'MGM Medical College Sambhajinagar', 'location' => 'Sambhajinagar', 'type' => 'Private'],

            // Ahilyanagar
            ['name' => 'Rural Medical College Loni', 'location' => 'Ahilyanagar', 'type' => 'Private'],
            ['name' => 'Dr. Vithalrao Vikhe Patil Medical College', 'location' => 'Ahilyanagar', 'type' => 'Private'],

            // Kolhapur
            ['name' => 'Government Medical College Kolhapur', 'location' => 'Kolhapur', 'type' => 'Government'],
            ['name' => 'DY Patil Medical College Kolhapur', 'location' => 'Kolhapur', 'type' => 'Private'],

            // Sangli
            ['name' => 'Government Medical College Miraj', 'location' => 'Sangli', 'type' => 'Government'],
            ['name' => 'Bharati Vidyapeeth Medical College Sangli', 'location' => 'Sangli', 'type' => 'Deemed'],

            // Solapur
            ['name' => 'Government Medical College Solapur', 'location' => 'Solapur', 'type' => 'Government'],
            ['name' => 'Ashwini Rural Medical College', 'location' => 'Solapur', 'type' => 'Private'],

            // Jalgaon
            ['name' => 'Dr. Ulhas Patil Medical College', 'location' => 'Jalgaon', 'type' => 'Private'],

            // Amravati
            ['name' => 'Dr. Panjabrao Deshmukh Medical College', 'location' => 'Amravati', 'type' => 'Private'],

            // Wardha
            ['name' => 'Mahatma Gandhi Institute of Medical Sciences', 'location' => 'Wardha', 'type' => 'Government'],
            ['name' => 'Datta Meghe Institute of Medical Sciences', 'location' => 'Wardha', 'type' => 'Deemed'],

            // Latur
            ['name' => 'Government Medical College Latur', 'location' => 'Latur', 'type' => 'Government'],

            // Nanded
            ['name' => 'Government Medical College Nanded', 'location' => 'Nanded', 'type' => 'Government'],

            // Akola
            ['name' => 'Government Medical College Akola', 'location' => 'Akola', 'type' => 'Government'],

            // Bhandara
            ['name' => 'Bhandara Medical College', 'location' => 'Bhandara', 'type' => 'Private'],

            // Chandrapur
            ['name' => 'Government Medical College Chandrapur', 'location' => 'Chandrapur', 'type' => 'Government'],

            // Dhule
            ['name' => 'Government Medical College Dhule', 'location' => 'Dhule', 'type' => 'Government'],

            // Jalna
            ['name' => 'Mahatma Jyotiba Phule Medical College', 'location' => 'Jalna', 'type' => 'Private'],

            // Osmanabad (Dharashiv)
            ['name' => 'Government Medical College Osmanabad', 'location' => 'Osmanabad', 'type' => 'Government'],

            // Parbhani
            ['name' => 'Government Medical College Parbhani', 'location' => 'Parbhani', 'type' => 'Government'],

            // Satara
            ['name' => 'Government Medical College Satara', 'location' => 'Satara', 'type' => 'Government'],

            // Yavatmal
            ['name' => 'Government Medical College Yavatmal', 'location' => 'Yavatmal', 'type' => 'Government'],

            // Nandurbar
            ['name' => 'Government Medical College Nandurbar', 'location' => 'Nandurbar', 'type' => 'Government'],

            // Washim
            ['name' => 'Government Medical College Washim', 'location' => 'Washim', 'type' => 'Government'],

            // Gondia
            ['name' => 'Government Medical College Gondia', 'location' => 'Gondia', 'type' => 'Government'],

            // Hingoli
            ['name' => 'Government Medical College Hingoli', 'location' => 'Hingoli', 'type' => 'Government'],

            // Buldhana
            ['name' => 'Government Medical College Buldhana', 'location' => 'Buldhana', 'type' => 'Government'],

            // Beed
            ['name' => 'Government Medical College Beed', 'location' => 'Beed', 'type' => 'Government'],

            // Gadchiroli
            ['name' => 'Government Medical College Gadchiroli', 'location' => 'Gadchiroli', 'type' => 'Government'],

            // Ratnagiri
            ['name' => 'Government Medical College Ratnagiri', 'location' => 'Ratnagiri', 'type' => 'Government'],

            // Sindhudurg
            ['name' => 'Government Medical College Sindhudurg', 'location' => 'Sindhudurg', 'type' => 'Government'],

            // Palghar
            ['name' => 'Government Medical College Palghar', 'location' => 'Palghar', 'type' => 'Government'],
        ];

        $top10Names = [
            'Armed Forces Medical College',
            'Seth GS Medical College',
            'AIIMS Nagpur',
            'Grant Medical College',
            'BJ Government Medical College',
            'Lokmanya Tilak Municipal Medical College',
            'Datta Meghe Institute of Medical Sciences',
            'Dr. D. Y. Patil Medical College Pune',
            'Bharati Vidyapeeth Medical College Pune',
            'Government Medical College Nagpur'
        ];

        foreach ($collegesData as $collegeInfo) {
            $isTop10 = array_search($collegeInfo['name'], $top10Names);
            $rank = ($isTop10 !== false) ? $isTop10 + 1 : null;

            $type = $collegeInfo['type'];
            
            // Placeholder data logic
            $fees = ($type === 'Government') ? '₹1L – ₹2L per year' : '₹8L – ₹15L per year';
            $cutoff = ($type === 'Government') ? '580–680 Marks (NEET)' : '350–550 Marks (NEET)';
            $seats = rand(100, 250);

            College::updateOrCreate(
                ['name' => $collegeInfo['name'], 'field_id' => $field->id],
                [
                    'location' => $collegeInfo['location'],
                    'state' => 'Maharashtra',
                    'type' => $type,
                    'rank' => $rank,
                    'fees_range' => $fees,
                    'cutoff' => $cutoff,
                    'seats' => $seats,
                    'affiliated_hospital' => 'Attached multi-specialty teaching hospital',
                    'facilities' => 'Library, Labs, Hostel, ICU, OPD, Emergency services',
                    'clinical_exposure' => 'Strong patient flow with hands-on training',
                    'description' => 'This is a well-known medical college offering MBBS education with strong clinical exposure and experienced faculty.',
                    'placement_support' => 'Internship + hospital training (MBBS standard)',
                    'popular_branches' => 'MBBS (Bachelor of Medicine and Bachelor of Surgery)'
                ]
            );
        }
    }
}
