<?php

namespace Database\Seeders;

use App\Models\College;
use App\Models\Field;
use Illuminate\Database\Seeder;

class PharmacyCollegeSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('name', 'LIKE', '%Pharmacy%')
                      ->orWhere('slug', 'pharmacy')
                      ->first();
                      
        if (!$field) {
            $field = Field::create([
                'name' => 'Pharmaceutical Sciences',
                'slug' => 'pharmacy',
                'icon' => 'fa-pills',
                'color' => '#db2777',
                'bg_color' => '#fce7f3'
            ]);
        }

        $collegesData = [
            // Mumbai
            ['name' => 'Institute of Chemical Technology', 'location' => 'Mumbai', 'type' => 'Government'],
            ['name' => 'Bombay College of Pharmacy', 'location' => 'Mumbai', 'type' => 'Private'],
            ['name' => 'SVKM\'s Dr Bhanuben Nanavati College of Pharmacy', 'location' => 'Mumbai', 'type' => 'Private'],
            ['name' => 'C U Shah College of Pharmacy', 'location' => 'Mumbai', 'type' => 'Private'],

            // Pune
            ['name' => 'Poona College of Pharmacy', 'location' => 'Pune', 'type' => 'Private'],
            ['name' => 'Dr D Y Patil Institute of Pharmaceutical Sciences and Research', 'location' => 'Pune', 'type' => 'Private'],
            ['name' => 'MIT World Peace University School of Pharmacy', 'location' => 'Pune', 'type' => 'Private'],
            ['name' => 'Sinhgad Institute of Pharmacy', 'location' => 'Pune', 'type' => 'Private'],

            // Nagpur
            ['name' => 'Rashtrasant Tukadoji Maharaj Nagpur University', 'location' => 'Nagpur', 'type' => 'Government'],
            ['name' => 'Smt Kishoritai Bhoyar College of Pharmacy', 'location' => 'Nagpur', 'type' => 'Private'],
            ['name' => 'Dadasaheb Balpande College of Pharmacy', 'location' => 'Nagpur', 'type' => 'Private'],

            // Nashik
            ['name' => 'K K Wagh College of Pharmacy', 'location' => 'Nashik', 'type' => 'Private'],
            ['name' => 'R G Sapkal College of Pharmacy', 'location' => 'Nashik', 'type' => 'Private'],
            ['name' => 'Sandip Institute of Pharmaceutical Sciences', 'location' => 'Nashik', 'type' => 'Private'],

            // Ahmednagar
            ['name' => 'Sanjivani College of Pharmaceutical Education and Research', 'location' => 'Ahmednagar', 'type' => 'Private'],
            ['name' => 'Dr Vithalrao Vikhe Patil College of Pharmacy', 'location' => 'Ahmednagar', 'type' => 'Private'],

            // Aurangabad
            ['name' => 'Y B Chavan College of Pharmacy', 'location' => 'Aurangabad', 'type' => 'Private'],
            ['name' => 'MGM College of Pharmacy', 'location' => 'Aurangabad', 'type' => 'Private'],

            // Dhule
            ['name' => 'RC Patel Institute of Pharmaceutical Education and Research', 'location' => 'Dhule', 'type' => 'Private'],

            // Jalgaon
            ['name' => 'SSBT College of Pharmacy', 'location' => 'Jalgaon', 'type' => 'Private'],

            // Kolhapur
            ['name' => 'Bharati Vidyapeeth College of Pharmacy Kolhapur', 'location' => 'Kolhapur', 'type' => 'Private'],

            // Sangli
            ['name' => 'Rajarambapu College of Pharmacy', 'location' => 'Sangli', 'type' => 'Private'],

            // Solapur
            ['name' => 'College of Pharmacy Solapur', 'location' => 'Solapur', 'type' => 'Private'],
        ];

        $top10Names = [
            'Institute of Chemical Technology',
            'NMIMS School of Pharmacy',
            'Poona College of Pharmacy',
            'Dr D Y Patil Institute of Pharmaceutical Sciences and Research',
            'Bombay College of Pharmacy'
        ];

        foreach ($collegesData as $collegeInfo) {
            $isTop10 = array_search($collegeInfo['name'], $top10Names);
            $rank = ($isTop10 !== false) ? $isTop10 + 1 : null;

            $type = $collegeInfo['type'];
            
            // Placeholder data
            $fees = ($type === 'Government') ? '₹40,000 – ₹90,000 per year' : '₹1,20,000 – ₹2,50,000 per year';
            $avgPack = '₹3 LPA – ₹8 LPA';
            $admission = 'MHT CET / GPAT / Merit-based';

            College::updateOrCreate(
                ['name' => $collegeInfo['name'], 'field_id' => $field->id],
                [
                    'location' => $collegeInfo['location'],
                    'state' => 'Maharashtra',
                    'type' => $type,
                    'rank' => $rank,
                    'fees_range' => $fees,
                    'cutoff' => $admission,
                    'average_package' => $avgPack,
                    'duration' => 'B.Pharm (4Y), D.Pharm (2Y)',
                    'popular_branches' => 'Bachelor of Pharmacy (B.Pharm), Diploma in Pharmacy (D.Pharm)',
                    'facilities' => 'Advanced Chemistry Labs, Herbal Garden, Library, Computer Centre, Hostel',
                    'research_support' => 'MHRD-supported research labs with HPLC and Spectrophotometry equipment.',
                    'description' => 'This college offers quality pharmacy education with strong laboratory facilities and industry-oriented training.',
                    'placement_support' => 'Cipla, Sun Pharma, Dr. Reddy\'s, Glenmark, Apollo Hospitals',
                ]
            );
        }
    }
}
