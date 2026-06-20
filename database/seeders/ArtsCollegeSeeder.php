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

            // Sambhajinagar
            ['name' => 'Deogiri College', 'location' => 'Sambhajinagar', 'type' => 'Private'],
            ['name' => 'Dr Babasaheb Ambedkar Marathwada University', 'location' => 'Sambhajinagar', 'type' => 'Government'],

            // Kolhapur
            ['name' => 'Shivaji University Kolhapur', 'location' => 'Kolhapur', 'type' => 'Government'],
            ['name' => 'Rajaram College', 'location' => 'Kolhapur', 'type' => 'Government'],

            // Ahilyanagar
            ['name' => 'New Arts, Commerce and Science College', 'location' => 'Ahilyanagar', 'type' => 'Private'],
            ['name' => 'Shrirampur College', 'location' => 'Ahilyanagar', 'type' => 'Private'],

            // Solapur
            ['name' => 'Sangameshwar College', 'location' => 'Solapur', 'type' => 'Private'],
            ['name' => 'Walchand College of Arts and Science', 'location' => 'Solapur', 'type' => 'Private'],

            // Jalgaon
            ['name' => 'North Maharashtra University Arts College', 'location' => 'Jalgaon', 'type' => 'Government'],
            ['name' => 'MGM Arts College Jalgaon', 'location' => 'Jalgaon', 'type' => 'Private'],

            // Amravati
            ['name' => 'Government Arts College Amravati', 'location' => 'Amravati', 'type' => 'Government'],
            ['name' => 'Shri Shivaji Arts College Amravati', 'location' => 'Amravati', 'type' => 'Private'],

            // Latur
            ['name' => 'Government Arts College Latur', 'location' => 'Latur', 'type' => 'Government'],
            ['name' => 'Dayanand College of Arts Latur', 'location' => 'Latur', 'type' => 'Private'],

            // Chandrapur
            ['name' => 'Government Arts College Chandrapur', 'location' => 'Chandrapur', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Arts College Chandrapur', 'location' => 'Chandrapur', 'type' => 'Private'],

            // Dhule
            ['name' => 'Government Arts College Dhule', 'location' => 'Dhule', 'type' => 'Government'],
            ['name' => 'SVPM Arts College Dhule', 'location' => 'Dhule', 'type' => 'Private'],

            // Nanded
            ['name' => 'Government Arts College Nanded', 'location' => 'Nanded', 'type' => 'Government'],
            ['name' => 'Swami Ramanand Teerth Arts College Nanded', 'location' => 'Nanded', 'type' => 'Private'],

            // Parbhani
            ['name' => 'Government Arts College Parbhani', 'location' => 'Parbhani', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Arts College Parbhani', 'location' => 'Parbhani', 'type' => 'Private'],

            // Satara
            ['name' => 'Government Arts College Satara', 'location' => 'Satara', 'type' => 'Government'],
            ['name' => 'Yashwantrao Chavan Arts College Satara', 'location' => 'Satara', 'type' => 'Private'],

            // Yavatmal
            ['name' => 'Government Arts College Yavatmal', 'location' => 'Yavatmal', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Arts College Yavatmal', 'location' => 'Yavatmal', 'type' => 'Private'],

            // Ratnagiri
            ['name' => 'Government Arts College Ratnagiri', 'location' => 'Ratnagiri', 'type' => 'Government'],
            ['name' => 'Gogate College Ratnagiri', 'location' => 'Ratnagiri', 'type' => 'Private'],

            // Sindhudurg
            ['name' => 'Government Arts College Sindhudurg', 'location' => 'Sindhudurg', 'type' => 'Government'],
            ['name' => 'Dayanand College Sindhudurg', 'location' => 'Sindhudurg', 'type' => 'Private'],

            // Palghar
            ['name' => 'Government Arts College Palghar', 'location' => 'Palghar', 'type' => 'Government'],
            ['name' => 'Vidyavardhini Arts College Palghar', 'location' => 'Palghar', 'type' => 'Private'],

            // Beed
            ['name' => 'Government Arts College Beed', 'location' => 'Beed', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Arts College Beed', 'location' => 'Beed', 'type' => 'Private'],

            // Osmanabad
            ['name' => 'Government Arts College Osmanabad', 'location' => 'Osmanabad', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Arts College Osmanabad', 'location' => 'Osmanabad', 'type' => 'Private'],

            // Washim
            ['name' => 'Government Arts College Washim', 'location' => 'Washim', 'type' => 'Government'],
            ['name' => 'Dayanand College Washim', 'location' => 'Washim', 'type' => 'Private'],

            // Hingoli
            ['name' => 'Government Arts College Hingoli', 'location' => 'Hingoli', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Arts College Hingoli', 'location' => 'Hingoli', 'type' => 'Private'],

            // Buldhana
            ['name' => 'Government Arts College Buldhana', 'location' => 'Buldhana', 'type' => 'Government'],
            ['name' => 'Shri Shivaji Arts College Buldhana', 'location' => 'Buldhana', 'type' => 'Private'],

            // Gadchiroli
            ['name' => 'Government Arts College Gadchiroli', 'location' => 'Gadchiroli', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Arts College Gadchiroli', 'location' => 'Gadchiroli', 'type' => 'Private'],

            // Gondia
            ['name' => 'Government Arts College Gondia', 'location' => 'Gondia', 'type' => 'Government'],
            ['name' => 'Shri Shivaji Arts College Gondia', 'location' => 'Gondia', 'type' => 'Private'],

            // Bhandara
            ['name' => 'Government Arts College Bhandara', 'location' => 'Bhandara', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Arts College Bhandara', 'location' => 'Bhandara', 'type' => 'Private'],

            // Akola
            ['name' => 'Government Arts College Akola', 'location' => 'Akola', 'type' => 'Government'],
            ['name' => 'Shri Shivaji Arts College Akola', 'location' => 'Akola', 'type' => 'Private'],

            // Jalna
            ['name' => 'Government Arts College Jalna', 'location' => 'Jalna', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Arts College Jalna', 'location' => 'Jalna', 'type' => 'Private'],

            // Wardha
            ['name' => 'Government Arts College Wardha', 'location' => 'Wardha', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Arts College Wardha', 'location' => 'Wardha', 'type' => 'Private'],

            // Nandurbar
            ['name' => 'Government Arts College Nandurbar', 'location' => 'Nandurbar', 'type' => 'Government'],
            ['name' => 'Shri Shivaji Arts College Nandurbar', 'location' => 'Nandurbar', 'type' => 'Private'],

            // Sangli
            ['name' => 'Government Arts College Sangli', 'location' => 'Sangli', 'type' => 'Government'],
            ['name' => 'Walchand College of Arts Sangli', 'location' => 'Sangli', 'type' => 'Private'],

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
