<?php

namespace Database\Seeders;

use App\Models\College;
use App\Models\Field;
use Illuminate\Database\Seeder;

class EngineeringCollegeSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'technology-engineering')->first();
        if (!$field) {
            $field = Field::create([
                'name' => 'Technology / Engineering',
                'slug' => 'technology-engineering',
                'icon' => 'fa-laptop-code',
                'color' => '#1d4ed8',
                'bg_color' => '#dbeafe'
            ]);
        }

        $dummyData = [
            'state' => 'Maharashtra',
            'fees_range' => '₹80,000 – ₹1,50,000 per year',
            'popular_branches' => 'Computer Engineering, Mechanical Engineering, Civil Engineering, Electronics Engineering',
            'cutoff' => 'Based on MHT-CET / JEE Main merit',
            'facilities' => 'Library, Labs, Hostel, Sports, Wi-Fi Campus',
            'placement_support' => 'Good placement support with training and internship guidance',
            'description' => 'This college is one of the well-known engineering institutes in its district and offers quality technical education for aspiring students.',
        ];

        $collegesData = [
            // Mumbai District
            ['name' => 'Indian Institute of Technology Bombay', 'location' => 'Mumbai', 'type' => 'Government'],
            ['name' => 'Institute of Chemical Technology', 'location' => 'Mumbai', 'type' => 'Government'],
            ['name' => 'Veermata Jijabai Technological Institute', 'location' => 'Mumbai', 'type' => 'Government'],
            ['name' => 'Sardar Patel College of Engineering', 'location' => 'Mumbai', 'type' => 'Government'],
            ['name' => 'Dwarkadas J Sanghvi College of Engineering', 'location' => 'Mumbai', 'type' => 'Private'],
            ['name' => 'K J Somaiya College of Engineering', 'location' => 'Mumbai', 'type' => 'Private'],
            ['name' => 'Thadomal Shahani Engineering College', 'location' => 'Mumbai', 'type' => 'Private'],
            ['name' => 'NMIMS Mukesh Patel School of Technology Management and Engineering', 'location' => 'Mumbai', 'type' => 'Private'],

            // Pune District
            ['name' => 'College of Engineering Pune', 'location' => 'Pune', 'type' => 'Government'],
            ['name' => 'Defence Institute of Advanced Technology', 'location' => 'Pune', 'type' => 'Central'],
            ['name' => 'Vishwakarma Institute of Technology', 'location' => 'Pune', 'type' => 'Autonomous'],
            ['name' => 'Pune Institute of Computer Technology', 'location' => 'Pune', 'type' => 'Private'],
            ['name' => 'MIT World Peace University', 'location' => 'Pune', 'type' => 'Private'],
            ['name' => 'Bharati Vidyapeeth College of Engineering', 'location' => 'Pune', 'type' => 'Private'],
            ['name' => 'Army Institute of Technology', 'location' => 'Pune', 'type' => 'Private'],
            ['name' => 'Symbiosis Institute of Technology', 'location' => 'Pune', 'type' => 'Private'],

            // Nagpur District
            ['name' => 'Visvesvaraya National Institute of Technology', 'location' => 'Nagpur', 'type' => 'Central'],
            ['name' => 'Shri Ramdeobaba College of Engineering and Management', 'location' => 'Nagpur', 'type' => 'Autonomous'],
            ['name' => 'Yeshwantrao Chavan College of Engineering', 'location' => 'Nagpur', 'type' => 'Autonomous'],
            ['name' => 'G H Raisoni College of Engineering', 'location' => 'Nagpur', 'type' => 'Autonomous'],

            // Nashik District
            ['name' => 'K K Wagh Institute of Engineering Education and Research', 'location' => 'Nashik', 'type' => 'Private'],
            ['name' => 'Sandip Institute of Technology and Research Centre', 'location' => 'Nashik', 'type' => 'Private'],
            ['name' => 'MET Institute of Engineering', 'location' => 'Nashik', 'type' => 'Private'],
            ['name' => 'Gokhale Education Society R H Sapat College of Engineering', 'location' => 'Nashik', 'type' => 'Private'],

            // Sambhajinagar District
            ['name' => 'Government College of Engineering Sambhajinagar', 'location' => 'Sambhajinagar', 'type' => 'Government'],
            ['name' => 'MIT Sambhajinagar', 'location' => 'Sambhajinagar', 'type' => 'Private'],

            // Sangli District
            ['name' => 'Walchand College of Engineering', 'location' => 'Sangli', 'type' => 'Government'],

            // Navi Mumbai / Raigad
            ['name' => 'Ramrao Adik Institute of Technology', 'location' => 'Navi Mumbai', 'type' => 'Private'],
            ['name' => 'Bharati Vidyapeeth College of Engineering Navi Mumbai', 'location' => 'Navi Mumbai', 'type' => 'Private'],

            // Kolhapur District
            ['name' => 'Government College of Engineering Kolhapur', 'location' => 'Kolhapur', 'type' => 'Government'],
            ['name' => 'D Y Patil College of Engineering Kolhapur', 'location' => 'Kolhapur', 'type' => 'Private'],

            // Solapur District
            ['name' => 'Walchand Institute of Technology', 'location' => 'Solapur', 'type' => 'Government'],
            ['name' => 'D Y Patil College of Engineering Solapur', 'location' => 'Solapur', 'type' => 'Private'],

            // Jalgaon District
            ['name' => 'Government College of Engineering Jalgaon', 'location' => 'Jalgaon', 'type' => 'Government'],
            ['name' => 'MGM College of Engineering Jalgaon', 'location' => 'Jalgaon', 'type' => 'Private'],

            // Amravati District
            ['name' => 'Government College of Engineering Amravati', 'location' => 'Amravati', 'type' => 'Government'],
            ['name' => 'Prof. Ram Meghe Institute of Technology and Research', 'location' => 'Amravati', 'type' => 'Private'],

            // Latur District
            ['name' => 'Government College of Engineering Latur', 'location' => 'Latur', 'type' => 'Government'],
            ['name' => 'Swami Vivekanand College of Engineering', 'location' => 'Latur', 'type' => 'Private'],

            // Ahilyanagar District
            ['name' => 'Government College of Engineering Ahilyanagar', 'location' => 'Ahilyanagar', 'type' => 'Government'],
            ['name' => 'New College of Engineering Ahilyanagar', 'location' => 'Ahilyanagar', 'type' => 'Private'],

            // Chandrapur District
            ['name' => 'Government College of Engineering Chandrapur', 'location' => 'Chandrapur', 'type' => 'Government'],
            ['name' => 'Lokmanya Tilak College of Engineering Chandrapur', 'location' => 'Chandrapur', 'type' => 'Private'],

            // Dhule District
            ['name' => 'Government College of Engineering Dhule', 'location' => 'Dhule', 'type' => 'Government'],
            ['name' => 'SSVPS College of Engineering Dhule', 'location' => 'Dhule', 'type' => 'Private'],

            // Nanded District
            ['name' => 'Government College of Engineering Nanded', 'location' => 'Nanded', 'type' => 'Government'],
            ['name' => 'Swami Ramanand Teerth Marathwada University Engineering College', 'location' => 'Nanded', 'type' => 'Private'],

            // Parbhani District
            ['name' => 'Government College of Engineering Parbhani', 'location' => 'Parbhani', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Mission College of Engineering Parbhani', 'location' => 'Parbhani', 'type' => 'Private'],

            // Satara District
            ['name' => 'Government College of Engineering Satara', 'location' => 'Satara', 'type' => 'Government'],
            ['name' => 'K J Somaiya College of Engineering Satara', 'location' => 'Satara', 'type' => 'Private'],

            // Yavatmal District
            ['name' => 'Government College of Engineering Yavatmal', 'location' => 'Yavatmal', 'type' => 'Government'],
            ['name' => 'College of Engineering Yavatmal', 'location' => 'Yavatmal', 'type' => 'Private'],

            // Ratnagiri District
            ['name' => 'Government College of Engineering Ratnagiri', 'location' => 'Ratnagiri', 'type' => 'Government'],
            ['name' => 'Konkan Gyanpeeth College of Engineering Ratnagiri', 'location' => 'Ratnagiri', 'type' => 'Private'],

            // Sindhudurg District
            ['name' => 'Government College of Engineering Sindhudurg', 'location' => 'Sindhudurg', 'type' => 'Government'],
            ['name' => 'Konkan Gyanpeeth College of Engineering Sindhudurg', 'location' => 'Sindhudurg', 'type' => 'Private'],

            // Palghar District
            ['name' => 'Government College of Engineering Palghar', 'location' => 'Palghar', 'type' => 'Government'],
            ['name' => 'Vidyavardhini College of Engineering Palghar', 'location' => 'Palghar', 'type' => 'Private'],

            // Beed District
            ['name' => 'Government College of Engineering Beed', 'location' => 'Beed', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Mission College of Engineering Beed', 'location' => 'Beed', 'type' => 'Private'],

            // Osmanabad District
            ['name' => 'Government College of Engineering Osmanabad', 'location' => 'Osmanabad', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Mission College of Engineering Osmanabad', 'location' => 'Osmanabad', 'type' => 'Private'],

            // Washim District
            ['name' => 'Government College of Engineering Washim', 'location' => 'Washim', 'type' => 'Government'],
            ['name' => 'College of Engineering Washim', 'location' => 'Washim', 'type' => 'Private'],

            // Hingoli District
            ['name' => 'Government College of Engineering Hingoli', 'location' => 'Hingoli', 'type' => 'Government'],
            ['name' => 'College of Engineering Hingoli', 'location' => 'Hingoli', 'type' => 'Private'],

            // Buldhana District
            ['name' => 'Government College of Engineering Buldhana', 'location' => 'Buldhana', 'type' => 'Government'],
            ['name' => 'College of Engineering Buldhana', 'location' => 'Buldhana', 'type' => 'Private'],

            // Gadchiroli District
            ['name' => 'Government College of Engineering Gadchiroli', 'location' => 'Gadchiroli', 'type' => 'Government'],
            ['name' => 'College of Engineering Gadchiroli', 'location' => 'Gadchiroli', 'type' => 'Private'],

            // Gondia District
            ['name' => 'Government College of Engineering Gondia', 'location' => 'Gondia', 'type' => 'Government'],
            ['name' => 'College of Engineering Gondia', 'location' => 'Gondia', 'type' => 'Private'],

            // Bhandara District
            ['name' => 'Government College of Engineering Bhandara', 'location' => 'Bhandara', 'type' => 'Government'],
            ['name' => 'College of Engineering Bhandara', 'location' => 'Bhandara', 'type' => 'Private'],

            // Akola District
            ['name' => 'Government College of Engineering Akola', 'location' => 'Akola', 'type' => 'Government'],
            ['name' => 'College of Engineering Akola', 'location' => 'Akola', 'type' => 'Private'],

            // Jalna District
            ['name' => 'Government College of Engineering Jalna', 'location' => 'Jalna', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Mission College of Engineering Jalna', 'location' => 'Jalna', 'type' => 'Private'],

            // Wardha District
            ['name' => 'Government College of Engineering Wardha', 'location' => 'Wardha', 'type' => 'Government'],
            ['name' => 'College of Engineering Wardha', 'location' => 'Wardha', 'type' => 'Private'],

            // Nandurbar District
            ['name' => 'Government College of Engineering Nandurbar', 'location' => 'Nandurbar', 'type' => 'Government'],
            ['name' => 'College of Engineering Nandurbar', 'location' => 'Nandurbar', 'type' => 'Private'],
        ];

        $top10 = [
            'Indian Institute of Technology Bombay' => 1,
            'Institute of Chemical Technology' => 2,
            'Visvesvaraya National Institute of Technology' => 3,
            'College of Engineering Pune' => 4,
            'Veermata Jijabai Technological Institute' => 5,
            'Defence Institute of Advanced Technology' => 6,
            'Vishwakarma Institute of Technology' => 7,
            'MIT World Peace University' => 8,
            'K J Somaiya College of Engineering' => 9,
            'Dwarkadas J Sanghvi College of Engineering' => 10,
        ];

        foreach ($collegesData as $collegeInfo) {
            $rank = $top10[$collegeInfo['name']] ?? null;

            College::updateOrCreate(
                ['name' => $collegeInfo['name'], 'field_id' => $field->id],
                array_merge($dummyData, [
                    'location' => $collegeInfo['location'],
                    'type' => $collegeInfo['type'],
                    'rank' => $rank
                ])
            );
        }
    }
}
