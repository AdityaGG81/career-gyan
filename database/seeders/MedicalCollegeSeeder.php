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

            // Aurangabad
            ['name' => 'Government Medical College Aurangabad', 'location' => 'Aurangabad', 'type' => 'Government'],
            ['name' => 'MGM Medical College Aurangabad', 'location' => 'Aurangabad', 'type' => 'Private'],

            // Ahmednagar
            ['name' => 'Rural Medical College Loni', 'location' => 'Ahmednagar', 'type' => 'Private'],
            ['name' => 'Dr. Vithalrao Vikhe Patil Medical College', 'location' => 'Ahmednagar', 'type' => 'Private'],

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
