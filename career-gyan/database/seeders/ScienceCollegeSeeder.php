<?php

namespace Database\Seeders;

use App\Models\College;
use App\Models\Field;
use Illuminate\Database\Seeder;

class ScienceCollegeSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'science')->firstOrFail();

        $collegesData = [
            // Mumbai
            ['name' => 'St. Xavier\'s College Mumbai', 'location' => 'Mumbai', 'type' => 'Private'],
            ['name' => 'Mithibai College of Arts & Science', 'location' => 'Mumbai', 'type' => 'Private'],
            ['name' => 'Kishinchand Chellaram College (KC College)', 'location' => 'Mumbai', 'type' => 'Private'],
            ['name' => 'Sophia College for Women', 'location' => 'Mumbai', 'type' => 'Private'],
            ['name' => 'K J Somaiya College of Science and Commerce', 'location' => 'Mumbai', 'type' => 'Private'],
            ['name' => 'Ramnarain Ruia Autonomous College', 'location' => 'Mumbai', 'type' => 'Private'],
            ['name' => 'Wilson College', 'location' => 'Mumbai', 'type' => 'Private'],
            ['name' => 'Indian Institute of Technology Bombay', 'location' => 'Mumbai', 'type' => 'Government', 'is_research' => true],
            ['name' => 'Tata Institute of Fundamental Research (TIFR Mumbai)', 'location' => 'Mumbai', 'type' => 'Government', 'is_research' => true],

            // Pune
            ['name' => 'Fergusson College (Autonomous)', 'location' => 'Pune', 'type' => 'Private'],
            ['name' => 'Nowrosjee Wadia College', 'location' => 'Pune', 'type' => 'Private'],
            ['name' => 'Modern College of Arts, Science and Commerce', 'location' => 'Pune', 'type' => 'Private'],
            ['name' => 'MIT World Peace University (School of Science)', 'location' => 'Pune', 'type' => 'Private'],
            ['name' => 'Symbiosis School for Liberal Arts', 'location' => 'Pune', 'type' => 'Private'],
            ['name' => 'Indian Institute of Science Education and Research Pune (IISER Pune)', 'location' => 'Pune', 'type' => 'Government', 'is_research' => true],

            // Nagpur
            ['name' => 'Institute of Science Nagpur', 'location' => 'Nagpur', 'type' => 'Government'],
            ['name' => 'Rashtrasant Tukadoji Maharaj Nagpur University (Science Dept)', 'location' => 'Nagpur', 'type' => 'Government'],
            ['name' => 'Hislop College', 'location' => 'Nagpur', 'type' => 'Private'],

            // Nashik
            ['name' => 'KTHM College Nashik', 'location' => 'Nashik', 'type' => 'Private'],
            ['name' => 'BYK College of Science Nashik', 'location' => 'Nashik', 'type' => 'Private'],
            ['name' => 'Sandip University School of Science', 'location' => 'Nashik', 'type' => 'Private'],

            // Aurangabad
            ['name' => 'Dr Babasaheb Ambedkar Marathwada University (Science Dept)', 'location' => 'Aurangabad', 'type' => 'Government'],
            ['name' => 'Deogiri College', 'location' => 'Aurangabad', 'type' => 'Private'],

            // Kolhapur
            ['name' => 'Shivaji University Kolhapur (Science Dept)', 'location' => 'Kolhapur', 'type' => 'Government'],
            ['name' => 'Rajaram College', 'location' => 'Kolhapur', 'type' => 'Government'],

            // Ahmednagar
            ['name' => 'New Arts, Commerce and Science College Ahmednagar', 'location' => 'Ahmednagar', 'type' => 'Private'],
            ['name' => 'Shrirampur College', 'location' => 'Ahmednagar', 'type' => 'Private'],

            // Solapur
            ['name' => 'Sangameshwar College Solapur', 'location' => 'Solapur', 'type' => 'Private'],
            ['name' => 'Walchand College of Arts and Science', 'location' => 'Solapur', 'type' => 'Private'],
        ];

        foreach ($collegesData as $collegeInfo) {
            $type = $collegeInfo['type'];
            $isRes = $collegeInfo['is_research'] ?? false;
            
            // Fees
            $fees = ($type === 'Government') ? '₹8,000 – ₹30,000 per year' : '₹40,000 – ₹1,50,000 per year';
            if ($isRes) $fees = '₹50,000 – ₹2,50,000 (Stipend provided for Research)';

            College::updateOrCreate(
                ['name' => $collegeInfo['name'], 'field_id' => $field->id],
                [
                    'location' => $collegeInfo['location'],
                    'state' => 'Maharashtra',
                    'type' => $type,
                    'rank' => $isRes ? 1 : null,
                    'fees_range' => $fees,
                    'cutoff' => $isRes ? 'GATE / NET / IIT-JAM' : 'Merit-based (12th Marks)',
                    'popular_branches' => 'B.Sc / M.Sc in Physics, Chemistry, Biotechnology, IT, Mathematics',
                    'specializations' => 'Pure Sciences, Data Science, Biotechnology, Micro-Biology',
                    'facilities' => 'Advanced Laboratories, Central Library, Research Centers, Hostel, Sports Complex',
                    'research_support' => $isRes ? 'Dedicated Research Labs, High-Performance Computing, Global Collaborations' : 'Well-equipped labs for Physics, Chemistry, and Biology experiments.',
                    'description' => 'This college offers quality science education with strong academic foundation and laboratory-based learning.',
                    'placement_support' => 'CSIR Labs, IT Companies, Chemical Industries, Pharmaceuticals, Coaching Institutes',
                    'average_package' => '₹2 LPA – ₹6 LPA (Research Stipends extra)'
                ]
            );
        }
    }
}
