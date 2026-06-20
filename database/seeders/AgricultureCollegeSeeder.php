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
            ['name' => 'Mahatma Phule Krishi Vidyapeeth (Rahuri)', 'location' => 'Ahilyanagar', 'type' => 'Government', 'is_top' => true],
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

            // Additional Districts
            ['name' => 'College of Agriculture Jalgaon', 'location' => 'Jalgaon', 'type' => 'Government'],
            ['name' => 'College of Agriculture Amravati', 'location' => 'Amravati', 'type' => 'Government'],
            ['name' => 'College of Agriculture Latur', 'location' => 'Latur', 'type' => 'Government'],
            ['name' => 'College of Agriculture Nanded', 'location' => 'Nanded', 'type' => 'Government'],
            ['name' => 'College of Agriculture Parbhani', 'location' => 'Parbhani', 'type' => 'Government'],
            ['name' => 'College of Agriculture Satara', 'location' => 'Satara', 'type' => 'Government'],
            ['name' => 'College of Agriculture Yavatmal', 'location' => 'Yavatmal', 'type' => 'Government'],
            ['name' => 'College of Agriculture Ratnagiri', 'location' => 'Ratnagiri', 'type' => 'Government'],
            ['name' => 'College of Agriculture Palghar', 'location' => 'Palghar', 'type' => 'Government'],
            ['name' => 'College of Agriculture Beed', 'location' => 'Beed', 'type' => 'Government'],
            ['name' => 'College of Agriculture Osmanabad', 'location' => 'Osmanabad', 'type' => 'Government'],
            ['name' => 'College of Agriculture Washim', 'location' => 'Washim', 'type' => 'Government'],
            ['name' => 'College of Agriculture Hingoli', 'location' => 'Hingoli', 'type' => 'Government'],
            ['name' => 'College of Agriculture Buldhana', 'location' => 'Buldhana', 'type' => 'Government'],
            ['name' => 'College of Agriculture Gadchiroli', 'location' => 'Gadchiroli', 'type' => 'Government'],
            ['name' => 'College of Agriculture Gondia', 'location' => 'Gondia', 'type' => 'Government'],
            ['name' => 'College of Agriculture Bhandara', 'location' => 'Bhandara', 'type' => 'Government'],
            ['name' => 'College of Agriculture Akola', 'location' => 'Akola', 'type' => 'Government'],
            ['name' => 'College of Agriculture Jalna', 'location' => 'Jalna', 'type' => 'Government'],
            ['name' => 'College of Agriculture Wardha', 'location' => 'Wardha', 'type' => 'Government'],
            ['name' => 'College of Agriculture Nandurbar', 'location' => 'Nandurbar', 'type' => 'Government'],
            ['name' => 'College of Agriculture Raigad', 'location' => 'Raigad', 'type' => 'Government'],
            ['name' => 'College of Agriculture Thane', 'location' => 'Thane', 'type' => 'Government'],
            ['name' => 'College of Agriculture Mumbai Suburban', 'location' => 'Mumbai Suburban', 'type' => 'Government'],
            ['name' => 'College of Agriculture Sangli', 'location' => 'Sangli', 'type' => 'Government'],
            ['name' => 'College of Agriculture Solapur', 'location' => 'Solapur', 'type' => 'Government'],
            ['name' => 'College of Agriculture Ahilyanagar', 'location' => 'Ahilyanagar', 'type' => 'Government'],
            ['name' => 'College of Agriculture Nagpur', 'location' => 'Nagpur', 'type' => 'Government'],
            ['name' => 'College of Agriculture Nashik', 'location' => 'Nashik', 'type' => 'Government'],
            ['name' => 'College of Agriculture Sambhajinagar', 'location' => 'Sambhajinagar', 'type' => 'Government'],
            ['name' => 'College of Agriculture Pune', 'location' => 'Pune', 'type' => 'Government'],
            ['name' => 'College of Agriculture Mumbai', 'location' => 'Mumbai', 'type' => 'Government'],
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
