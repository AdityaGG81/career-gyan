<?php

namespace Database\Seeders;

use App\Models\College;
use App\Models\Field;
use Illuminate\Database\Seeder;

class HotelManagementCollegeSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('name', 'LIKE', '%Hotel Management%')
                      ->orWhere('slug', 'hotel-management')
                      ->first();
                      
        if (!$field) {
            $field = Field::create([
                'name' => 'Hotel Management',
                'slug' => 'hotel-management',
                'icon' => 'fa-hotel',
                'color' => '#f59e0b',
                'bg_color' => '#fef3c7'
            ]);
        }

        $collegesData = [
            // Tier 1
            ['name' => 'Institute of Hotel Management Mumbai', 'location' => 'Mumbai', 'type' => 'Government', 'tier' => 'Tier 1'],
            ['name' => 'Institute of Hotel Management Sindhudurg', 'location' => 'Sindhudurg', 'type' => 'Government', 'tier' => 'Tier 1'],

            // Tier 2
            ['name' => 'Bharati Vidyapeeth College of Hotel and Tourism Management Studies', 'location' => 'Navi Mumbai', 'type' => 'Private', 'tier' => 'Tier 2'],
            ['name' => 'AISSMS College of Hotel Management and Catering Technology', 'location' => 'Pune', 'type' => 'Private', 'tier' => 'Tier 2'],
            ['name' => 'Symbiosis School of Culinary Arts', 'location' => 'Pune', 'type' => 'Private', 'tier' => 'Tier 2'],
            ['name' => 'School of Hospitality and Tourism Studies', 'location' => 'Navi Mumbai', 'type' => 'Private', 'tier' => 'Tier 2'],

            // Tier 3
            ['name' => 'ITM Institute of Hotel Management', 'location' => 'Mumbai', 'type' => 'Private', 'tier' => 'Tier 3'],
            ['name' => 'St Francis Institute of Hotel Management', 'location' => 'Mumbai', 'type' => 'Private', 'tier' => 'Tier 3'],
            ['name' => 'International Institute of Hotel Management Pune', 'location' => 'Pune', 'type' => 'Private', 'tier' => 'Tier 3'],
            ['name' => 'UEI Global Pune', 'location' => 'Pune', 'type' => 'Private', 'tier' => 'Tier 3'],
        ];

        $topRankedNames = [
            'Institute of Hotel Management Mumbai',
            'Institute of Hotel Management Sindhudurg',
            'Bharati Vidyapeeth College of Hotel and Tourism Management Studies',
            'AISSMS College of Hotel Management and Catering Technology',
            'Symbiosis School of Culinary Arts'
        ];

        foreach ($collegesData as $collegeInfo) {
            $isTopRanked = array_search($collegeInfo['name'], $topRankedNames);
            $rank = ($isTopRanked !== false) ? $isTopRanked + 1 : null;

            $type = $collegeInfo['type'];
            
            // Placeholder data logic
            $fees = ($type === 'Government') ? '₹50,000 – ₹1,50,000 per year' : '₹1,50,000 – ₹3,50,000 per year';
            $admission = 'NCHMCT JEE / MAH HM CET / Merit-based';
            $duration = '3–4 years';

            College::updateOrCreate(
                ['name' => $collegeInfo['name'], 'field_id' => $field->id],
                [
                    'location' => $collegeInfo['location'],
                    'state' => 'Maharashtra',
                    'type' => $type,
                    'rank' => $rank,
                    'tier' => $collegeInfo['tier'],
                    'fees_range' => $fees,
                    'cutoff' => $admission,
                    'duration' => $duration,
                    'popular_branches' => 'BHM (Bachelor of Hotel Management), B.Sc Hospitality, Diploma in Hotel Management',
                    'facilities' => 'Training kitchen, Food labs, Hostel, Library, Wi-Fi campus',
                    'description' => 'This college offers professional hospitality training with strong practical exposure and industry-focused curriculum.',
                    'placement_support' => 'Taj Hotels, Oberoi Group, ITC Hotels, Marriott, Airlines & Cruise Industry',
                    'internship_opportunities' => 'Mandatory overseas and domestic internship programs with leading hotel chains.',
                ]
            );
        }
    }
}
