<?php

namespace Database\Seeders;

use App\Models\College;
use App\Models\Field;
use Illuminate\Database\Seeder;

class ManagementCollegeSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'business')->first();
                      
        if (!$field) {
            $field = Field::create([
                'name' => 'Management / Business',
                'slug' => 'business',
                'icon' => 'fa-briefcase',
                'color' => '#1d4ed8',
                'bg_color' => '#dbeafe'
            ]);
        }

        $collegesData = [
            // Mumbai
            ['name' => 'SP Jain Institute of Management and Research', 'location' => 'Mumbai', 'type' => 'Private'],
            ['name' => 'Indian Institute of Management Mumbai', 'location' => 'Mumbai', 'type' => 'Government'],
            ['name' => 'Jamnalal Bajaj Institute of Management Studies', 'location' => 'Mumbai', 'type' => 'Government'],
            ['name' => 'NMIMS School of Business Management', 'location' => 'Mumbai', 'type' => 'Private'],
            ['name' => 'Shailesh J Mehta School of Management IIT Bombay', 'location' => 'Mumbai', 'type' => 'Government'],
            ['name' => 'Tata Institute of Social Sciences', 'location' => 'Mumbai', 'type' => 'Government'],

            // Pune
            ['name' => 'Symbiosis Institute of Business Management', 'location' => 'Pune', 'type' => 'Private'],
            ['name' => 'Department of Management Sciences Savitribai Phule Pune University', 'location' => 'Pune', 'type' => 'Government'],
            ['name' => 'National Institute of Bank Management', 'location' => 'Pune', 'type' => 'Government'],
            ['name' => 'MIT World Peace University School of Management', 'location' => 'Pune', 'type' => 'Private'],
            ['name' => 'Balaji Institute of Modern Management', 'location' => 'Pune', 'type' => 'Private'],

            // Nagpur
            ['name' => 'Indian Institute of Management Nagpur', 'location' => 'Nagpur', 'type' => 'Government'],
            ['name' => 'Institute of Management Technology Nagpur', 'location' => 'Nagpur', 'type' => 'Private'],
            ['name' => 'GH Raisoni Institute of Management Studies', 'location' => 'Nagpur', 'type' => 'Private'],

            // Nashik
            ['name' => 'K K Wagh Institute of Engineering Education and Research Management', 'location' => 'Nashik', 'type' => 'Private'],
            ['name' => 'Sandip University School of Management', 'location' => 'Nashik', 'type' => 'Private'],
            ['name' => 'MET Institute of Management', 'location' => 'Nashik', 'type' => 'Private'],

            // Aurangabad
            ['name' => 'MIT School of Management Aurangabad', 'location' => 'Aurangabad', 'type' => 'Private'],
            ['name' => 'Deogiri Institute of Engineering and Management Studies', 'location' => 'Aurangabad', 'type' => 'Private'],

            // Ahmednagar
            ['name' => 'Sanjivani Institute of Management Studies', 'location' => 'Ahmednagar', 'type' => 'Private'],
            ['name' => 'Amrutvahini Institute of Management and Business Administration', 'location' => 'Ahmednagar', 'type' => 'Private'],

            // Kolhapur
            ['name' => 'Shivaji University Department of Management', 'location' => 'Kolhapur', 'type' => 'Government'],
            ['name' => 'DKTE Institute of Management', 'location' => 'Kolhapur', 'type' => 'Private'],

            // Sangli
            ['name' => 'Walchand Institute of Technology Management', 'location' => 'Sangli', 'type' => 'Private'],
            ['name' => 'Rajarambapu Institute of Management', 'location' => 'Sangli', 'type' => 'Private'],

            // Navi Mumbai / Raigad
            ['name' => 'SIES College of Management Studies', 'location' => 'Navi Mumbai', 'type' => 'Private'],
            ['name' => 'ITM Business School Navi Mumbai', 'location' => 'Navi Mumbai', 'type' => 'Private'],
            ['name' => 'Welingkar Institute of Management Development and Research', 'location' => 'Mumbai', 'type' => 'Private'],
        ];

        $top10Names = [
            'SP Jain Institute of Management and Research',
            'Indian Institute of Management Mumbai',
            'Tata Institute of Social Sciences',
            'Jamnalal Bajaj Institute of Management Studies',
            'Shailesh J Mehta School of Management IIT Bombay',
            'NMIMS School of Business Management',
            'Symbiosis Institute of Business Management',
            'Indian Institute of Management Nagpur',
            'National Institute of Bank Management',
            'Department of Management Sciences Savitribai Phule Pune University'
        ];

        foreach ($collegesData as $collegeInfo) {
            $isTop10 = array_search($collegeInfo['name'], $top10Names);
            $rank = ($isTop10 !== false) ? $isTop10 + 1 : null;

            $type = $collegeInfo['type'];
            
            // Placeholder data
            $fees = ($type === 'Government') ? '₹2,00,000 – ₹6,00,000 (Full Course)' : '₹8,00,000 – ₹12,00,000 (Full Course)';
            $avgPack = ($rank && $rank <= 5) ? '₹18 LPA – ₹25 LPA' : (($rank) ? '₹12 LPA – ₹18 LPA' : '₹4 LPA – ₹10 LPA');
            $admission = 'CAT / MAH MBA CET / Merit-based';
            $specs = 'Finance, Marketing, HR, Operations, Business Analytics';

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
                    'specializations' => $specs,
                    'popular_branches' => 'MBA, BBA, PGDM',
                    'facilities' => 'Smart classrooms, Library, Computer labs, Hostel, Wi-Fi campus',
                    'description' => 'This college offers quality management education with industry-oriented curriculum and strong placement support.',
                    'placement_support' => 'TCS, Infosys, Deloitte, HDFC Bank, ICICI Bank',
                ]
            );
        }
    }
}
