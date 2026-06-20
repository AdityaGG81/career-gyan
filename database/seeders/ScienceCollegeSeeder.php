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

            // Sambhajinagar
            ['name' => 'Dr Babasaheb Ambedkar Marathwada University (Science Dept)', 'location' => 'Sambhajinagar', 'type' => 'Government'],
            ['name' => 'Deogiri College', 'location' => 'Sambhajinagar', 'type' => 'Private'],

            // Kolhapur
            ['name' => 'Shivaji University Kolhapur (Science Dept)', 'location' => 'Kolhapur', 'type' => 'Government'],
            ['name' => 'Rajaram College', 'location' => 'Kolhapur', 'type' => 'Government'],

            // Ahilyanagar
            ['name' => 'New Arts, Commerce and Science College Ahilyanagar', 'location' => 'Ahilyanagar', 'type' => 'Private'],
            ['name' => 'Shrirampur College', 'location' => 'Ahilyanagar', 'type' => 'Private'],

            // Solapur
            ['name' => 'Sangameshwar College Solapur', 'location' => 'Solapur', 'type' => 'Private'],
            ['name' => 'Walchand College of Arts and Science', 'location' => 'Solapur', 'type' => 'Private'],

            // Jalgaon
            ['name' => 'North Maharashtra University Science College', 'location' => 'Jalgaon', 'type' => 'Government'],
            ['name' => 'MGM College of Science Jalgaon', 'location' => 'Jalgaon', 'type' => 'Private'],

            // Amravati
            ['name' => 'Government Science College Amravati', 'location' => 'Amravati', 'type' => 'Government'],
            ['name' => 'Shri Shivaji Science College Amravati', 'location' => 'Amravati', 'type' => 'Private'],

            // Latur
            ['name' => 'Government Science College Latur', 'location' => 'Latur', 'type' => 'Government'],
            ['name' => 'Dayanand Science College Latur', 'location' => 'Latur', 'type' => 'Private'],

            // Chandrapur
            ['name' => 'Government Science College Chandrapur', 'location' => 'Chandrapur', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Science College Chandrapur', 'location' => 'Chandrapur', 'type' => 'Private'],

            // Dhule
            ['name' => 'Government Science College Dhule', 'location' => 'Dhule', 'type' => 'Government'],
            ['name' => 'SVPM Science College Dhule', 'location' => 'Dhule', 'type' => 'Private'],

            // Nanded
            ['name' => 'Government Science College Nanded', 'location' => 'Nanded', 'type' => 'Government'],
            ['name' => 'Swami Ramanand Teerth Science College Nanded', 'location' => 'Nanded', 'type' => 'Private'],

            // Parbhani
            ['name' => 'Government Science College Parbhani', 'location' => 'Parbhani', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Science College Parbhani', 'location' => 'Parbhani', 'type' => 'Private'],

            // Satara
            ['name' => 'Government Science College Satara', 'location' => 'Satara', 'type' => 'Government'],
            ['name' => 'Yashwantrao Chavan Science College Satara', 'location' => 'Satara', 'type' => 'Private'],

            // Yavatmal
            ['name' => 'Government Science College Yavatmal', 'location' => 'Yavatmal', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Science College Yavatmal', 'location' => 'Yavatmal', 'type' => 'Private'],

            // Ratnagiri
            ['name' => 'Government Science College Ratnagiri', 'location' => 'Ratnagiri', 'type' => 'Government'],
            ['name' => 'Gogate Science College Ratnagiri', 'location' => 'Ratnagiri', 'type' => 'Private'],

            // Sindhudurg
            ['name' => 'Government Science College Sindhudurg', 'location' => 'Sindhudurg', 'type' => 'Government'],
            ['name' => 'Dayanand Science College Sindhudurg', 'location' => 'Sindhudurg', 'type' => 'Private'],

            // Palghar
            ['name' => 'Government Science College Palghar', 'location' => 'Palghar', 'type' => 'Government'],
            ['name' => 'Vidyavardhini Science College Palghar', 'location' => 'Palghar', 'type' => 'Private'],

            // Beed
            ['name' => 'Government Science College Beed', 'location' => 'Beed', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Science College Beed', 'location' => 'Beed', 'type' => 'Private'],

            // Osmanabad
            ['name' => 'Government Science College Osmanabad', 'location' => 'Osmanabad', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Science College Osmanabad', 'location' => 'Osmanabad', 'type' => 'Private'],

            // Washim
            ['name' => 'Government Science College Washim', 'location' => 'Washim', 'type' => 'Government'],
            ['name' => 'Dayanand Science College Washim', 'location' => 'Washim', 'type' => 'Private'],

            // Hingoli
            ['name' => 'Government Science College Hingoli', 'location' => 'Hingoli', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Science College Hingoli', 'location' => 'Hingoli', 'type' => 'Private'],

            // Buldhana
            ['name' => 'Government Science College Buldhana', 'location' => 'Buldhana', 'type' => 'Government'],
            ['name' => 'Shri Shivaji Science College Buldhana', 'location' => 'Buldhana', 'type' => 'Private'],

            // Gadchiroli
            ['name' => 'Government Science College Gadchiroli', 'location' => 'Gadchiroli', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Science College Gadchiroli', 'location' => 'Gadchiroli', 'type' => 'Private'],

            // Gondia
            ['name' => 'Government Science College Gondia', 'location' => 'Gondia', 'type' => 'Government'],
            ['name' => 'Shri Shivaji Science College Gondia', 'location' => 'Gondia', 'type' => 'Private'],

            // Bhandara
            ['name' => 'Government Science College Bhandara', 'location' => 'Bhandara', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Science College Bhandara', 'location' => 'Bhandara', 'type' => 'Private'],

            // Akola
            ['name' => 'Government Science College Akola', 'location' => 'Akola', 'type' => 'Government'],
            ['name' => 'Shri Shivaji Science College Akola', 'location' => 'Akola', 'type' => 'Private'],

            // Jalna
            ['name' => 'Government Science College Jalna', 'location' => 'Jalna', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Science College Jalna', 'location' => 'Jalna', 'type' => 'Private'],

            // Wardha
            ['name' => 'Government Science College Wardha', 'location' => 'Wardha', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Science College Wardha', 'location' => 'Wardha', 'type' => 'Private'],

            // Nandurbar
            ['name' => 'Government Science College Nandurbar', 'location' => 'Nandurbar', 'type' => 'Government'],
            ['name' => 'Shri Shivaji Science College Nandurbar', 'location' => 'Nandurbar', 'type' => 'Private'],

            // Raigad
            ['name' => 'Government Science College Raigad', 'location' => 'Raigad', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Science College Raigad', 'location' => 'Raigad', 'type' => 'Private'],

            // Thane
            ['name' => 'Government Science College Thane', 'location' => 'Thane', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Science College Thane', 'location' => 'Thane', 'type' => 'Private'],

            // Mumbai Suburban
            ['name' => 'Government Science College Mumbai Suburban', 'location' => 'Mumbai Suburban', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Science College Mumbai Suburban', 'location' => 'Mumbai Suburban', 'type' => 'Private'],

            // Sangli
            ['name' => 'Government Science College Sangli', 'location' => 'Sangli', 'type' => 'Government'],
            ['name' => 'Walchand Science College Sangli', 'location' => 'Sangli', 'type' => 'Private'],
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
