<?php

namespace Database\Seeders;

use App\Models\College;
use App\Models\Field;
use Illuminate\Database\Seeder;

class ArtsCollegeSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'arts-humanities')->firstOrFail();

        $collegesData = [
            // Mumbai
            ['name' => 'St. Xavier\'s College Mumbai', 'location' => 'Mumbai', 'type' => 'Private'],
            ['name' => 'Mithibai College of Arts', 'location' => 'Mumbai', 'type' => 'Private'],
            ['name' => 'K J Somaiya College of Arts & Commerce', 'location' => 'Mumbai', 'type' => 'Private'],
            ['name' => 'Jai Hind College', 'location' => 'Mumbai', 'type' => 'Private'],
            ['name' => 'Ramnarain Ruia Autonomous College', 'location' => 'Mumbai', 'type' => 'Private'],
            ['name' => 'Kishinchand Chellaram College', 'location' => 'Mumbai', 'type' => 'Private'],
            ['name' => 'Sophia College for Women', 'location' => 'Mumbai', 'type' => 'Private'],
            ['name' => 'Wilson College', 'location' => 'Mumbai', 'type' => 'Private'],
            ['name' => 'Tata Institute of Social Sciences (TISS Mumbai)', 'location' => 'Mumbai', 'type' => 'Government', 'is_elite' => true],
            ['name' => 'College of Social Work Mumbai', 'location' => 'Mumbai', 'type' => 'Private', 'is_elite' => true],

            // Pune
            ['name' => 'Fergusson College', 'location' => 'Pune', 'type' => 'Private'],
            ['name' => 'Symbiosis College of Arts and Commerce', 'location' => 'Pune', 'type' => 'Private'],
            ['name' => 'Nowrosjee Wadia College', 'location' => 'Pune', 'type' => 'Private'],
            ['name' => 'St. Mira\'s College for Girls', 'location' => 'Pune', 'type' => 'Private'],
            ['name' => 'Modern College of Arts, Science and Commerce', 'location' => 'Pune', 'type' => 'Private'],
            ['name' => 'Sir Parashurambhau College', 'location' => 'Pune', 'type' => 'Private'],
            ['name' => 'Flame University Pune', 'location' => 'Pune', 'type' => 'Private', 'is_elite' => true],

            // Nagpur
            ['name' => 'Hislop College', 'location' => 'Nagpur', 'type' => 'Private'],
            ['name' => 'Rashtrasant Tukadoji Maharaj Nagpur University', 'location' => 'Nagpur', 'type' => 'Government'],
            ['name' => 'Dr. Ambedkar College', 'location' => 'Nagpur', 'type' => 'Private'],

            // Nashik
            ['name' => 'KTHM College Nashik', 'location' => 'Nashik', 'type' => 'Private'],
            ['name' => 'BYK College Nashik', 'location' => 'Nashik', 'type' => 'Private'],
            ['name' => 'HPT Arts & RYK Science College', 'location' => 'Nashik', 'type' => 'Private'],

            // Aurangabad
            ['name' => 'Deogiri College', 'location' => 'Aurangabad', 'type' => 'Private'],
            ['name' => 'Dr Babasaheb Ambedkar Marathwada University', 'location' => 'Aurangabad', 'type' => 'Government'],

            // Kolhapur
            ['name' => 'Shivaji University Kolhapur', 'location' => 'Kolhapur', 'type' => 'Government'],
            ['name' => 'Rajaram College', 'location' => 'Kolhapur', 'type' => 'Government'],

            // Ahmednagar
            ['name' => 'New Arts, Commerce and Science College', 'location' => 'Ahmednagar', 'type' => 'Private'],
            ['name' => 'Shrirampur College', 'location' => 'Ahmednagar', 'type' => 'Private'],

            // Solapur
            ['name' => 'Sangameshwar College', 'location' => 'Solapur', 'type' => 'Private'],
            ['name' => 'Walchand College of Arts and Science', 'location' => 'Solapur', 'type' => 'Private'],
            
            // Other Elite
            ['name' => 'NMIMS Mumbai (Liberal Arts)', 'location' => 'Mumbai', 'type' => 'Private', 'is_elite' => true],
        ];

        foreach ($collegesData as $collegeInfo) {
            $isElite = $collegeInfo['is_elite'] ?? false;
            $type = $collegeInfo['type'];
            
            $fees = ($isElite) ? '₹1,50,000 – ₹4,50,000 per year' : '₹5,000 – ₹25,000 per year';
            $admission = ($isElite) ? 'CUET / Entrance Test' : 'Merit-based (12th Marks)';

            College::updateOrCreate(
                ['name' => $collegeInfo['name'], 'field_id' => $field->id],
                [
                    'location' => $collegeInfo['location'],
                    'state' => 'Maharashtra',
                    'type' => $type,
                    'rank' => $isElite ? 1 : null,
                    'fees_range' => $fees,
                    'cutoff' => $admission,
                    'popular_branches' => 'BA / MA in Psychology, Economics, Political Science, Sociology, English',
                    'specializations' => 'Liberal Arts, Social Work, International Relations, Literature',
                    'facilities' => 'Well-stocked Library, Smart Classrooms, Auditorium, Cultural Center, Hostel',
                    'description' => 'This college offers quality humanities education with strong academic foundation and career opportunities in diverse fields.',
                    'placement_support' => 'Media Houses, NGOs, PR Agencies, UPSC/MPSC Coaching, Research Firms',
                    'average_package' => '₹2.5 LPA – ₹8 LPA (Higher for Elite Institutes)'
                ]
            );
        }
    }
}
