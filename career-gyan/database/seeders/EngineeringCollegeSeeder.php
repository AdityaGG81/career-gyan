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

            // Aurangabad District
            ['name' => 'Government College of Engineering Aurangabad', 'location' => 'Aurangabad', 'type' => 'Government'],
            ['name' => 'MIT Aurangabad', 'location' => 'Aurangabad', 'type' => 'Private'],

            // Sangli District
            ['name' => 'Walchand College of Engineering', 'location' => 'Sangli', 'type' => 'Government'],

            // Navi Mumbai / Raigad
            ['name' => 'Ramrao Adik Institute of Technology', 'location' => 'Navi Mumbai', 'type' => 'Private'],
            ['name' => 'Bharati Vidyapeeth College of Engineering Navi Mumbai', 'location' => 'Navi Mumbai', 'type' => 'Private'],
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
