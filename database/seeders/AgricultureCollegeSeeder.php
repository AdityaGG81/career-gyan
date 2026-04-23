<?php

namespace Database\Seeders;

use App\Models\College;
use App\Models\Field;
use Illuminate\Database\Seeder;

class AgricultureCollegeSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'agriculture')->firstOrFail();

        $collegesData = [
            // State Universities (High Level)
            ['name' => 'Mahatma Phule Krishi Vidyapeeth (Rahuri)', 'location' => 'Ahmednagar', 'type' => 'Government', 'is_top' => true],
            ['name' => 'Dr. Panjabrao Deshmukh Krishi Vidyapeeth (Akola)', 'location' => 'Akola', 'type' => 'Government', 'is_top' => true],
            ['name' => 'Vasantrao Naik Marathwada Krishi Vidyapeeth (Parbhani)', 'location' => 'Parbhani', 'type' => 'Government', 'is_top' => true],
            ['name' => 'Dr. Balasaheb Sawant Konkan Krishi Vidyapeeth (Dapoli)', 'location' => 'Ratnagiri', 'type' => 'Government', 'is_top' => true],

            // Regional
            ['name' => 'College of Agriculture Pune', 'location' => 'Pune', 'type' => 'Government'],
            ['name' => 'College of Agriculture and Allied Sciences Pune', 'location' => 'Pune', 'type' => 'Private'],
            ['name' => 'College of Agriculture Nagpur', 'location' => 'Nagpur', 'type' => 'Government'],
            ['name' => 'Nagpur Veterinary College', 'location' => 'Nagpur', 'type' => 'Government'],
            ['name' => 'College of Agriculture Parbhani', 'location' => 'Parbhani', 'type' => 'Government'],
            ['name' => 'College of Agriculture Dapoli', 'location' => 'Ratnagiri', 'type' => 'Government'],
            ['name' => 'Central Institute of Fisheries Education (Mumbai)', 'location' => 'Mumbai', 'type' => 'Government', 'is_top' => true],
            ['name' => 'Anand Niketan College of Agriculture (Chandrapur)', 'location' => 'Chandrapur', 'type' => 'Private'],
            ['name' => 'College of Agriculture Dhule', 'location' => 'Dhule', 'type' => 'Government'],
            ['name' => 'College of Agriculture Kolhapur', 'location' => 'Kolhapur', 'type' => 'Government'],
        ];

        foreach ($collegesData as $collegeInfo) {
            $isTop = $collegeInfo['is_top'] ?? false;
            $type = $collegeInfo['type'];
            
            $fees = ($type === 'Government') ? '₹18,000 – ₹45,000 per year' : '₹60,000 – ₹1,80,000 per year';

            College::updateOrCreate(
                ['name' => $collegeInfo['name'], 'field_id' => $field->id],
                [
                    'location' => $collegeInfo['location'],
                    'state' => 'Maharashtra',
                    'type' => $type,
                    'rank' => $isTop ? 1 : null,
                    'fees_range' => $fees,
                    'cutoff' => 'MHT-CET / ICAR AIEEA',
                    'popular_branches' => 'B.Sc Agriculture, B.Tech Agricultural Engineering, M.Sc Agri',
                    'specializations' => 'Agronomy, Horticulture, Food Technology, Agribusiness',
                    'facilities' => 'Experimental Farms, Livestock Centers, High-Tech Labs, Library, Hostel',
                    'description' => 'This college provides practical agriculture education with strong focus on field training research and modern farming techniques.',
                    'placement_support' => 'NABARD, Agribusiness Startups, Seed Companies, Food Processing Units',
                    'average_package' => '₹3 LPA – ₹7 LPA'
                ]
            );
        }
    }
}
