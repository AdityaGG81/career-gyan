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

            // Sambhajinagar
            ['name' => 'MIT School of Management Sambhajinagar', 'location' => 'Sambhajinagar', 'type' => 'Private'],
            ['name' => 'Deogiri Institute of Engineering and Management Studies', 'location' => 'Sambhajinagar', 'type' => 'Private'],

            // Ahilyanagar
            ['name' => 'Sanjivani Institute of Management Studies', 'location' => 'Ahilyanagar', 'type' => 'Private'],
            ['name' => 'Amrutvahini Institute of Management and Business Administration', 'location' => 'Ahilyanagar', 'type' => 'Private'],

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

            // Jalgaon
            ['name' => 'North Maharashtra University Department of Management', 'location' => 'Jalgaon', 'type' => 'Government'],
            ['name' => 'MGM Institute of Management Jalgaon', 'location' => 'Jalgaon', 'type' => 'Private'],

            // Amravati
            ['name' => 'Government Institute of Management Amravati', 'location' => 'Amravati', 'type' => 'Government'],
            ['name' => 'Shri Shivaji Institute of Management Amravati', 'location' => 'Amravati', 'type' => 'Private'],

            // Latur
            ['name' => 'Government Institute of Management Latur', 'location' => 'Latur', 'type' => 'Government'],
            ['name' => 'Swami Vivekanand Institute of Management Latur', 'location' => 'Latur', 'type' => 'Private'],

            // Chandrapur
            ['name' => 'Government Institute of Management Chandrapur', 'location' => 'Chandrapur', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Institute of Management Chandrapur', 'location' => 'Chandrapur', 'type' => 'Private'],

            // Dhule
            ['name' => 'Government Institute of Management Dhule', 'location' => 'Dhule', 'type' => 'Government'],
            ['name' => 'SVPM Institute of Management Dhule', 'location' => 'Dhule', 'type' => 'Private'],

            // Nanded
            ['name' => 'Government Institute of Management Nanded', 'location' => 'Nanded', 'type' => 'Government'],
            ['name' => 'Swami Ramanand Teerth Institute of Management Nanded', 'location' => 'Nanded', 'type' => 'Private'],

            // Parbhani
            ['name' => 'Government Institute of Management Parbhani', 'location' => 'Parbhani', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Institute of Management Parbhani', 'location' => 'Parbhani', 'type' => 'Private'],

            // Satara
            ['name' => 'Government Institute of Management Satara', 'location' => 'Satara', 'type' => 'Government'],
            ['name' => 'Yashwantrao Chavan Institute of Management Satara', 'location' => 'Satara', 'type' => 'Private'],

            // Yavatmal
            ['name' => 'Government Institute of Management Yavatmal', 'location' => 'Yavatmal', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Institute of Management Yavatmal', 'location' => 'Yavatmal', 'type' => 'Private'],

            // Ratnagiri
            ['name' => 'Government Institute of Management Ratnagiri', 'location' => 'Ratnagiri', 'type' => 'Government'],
            ['name' => 'Gogate Institute of Management Ratnagiri', 'location' => 'Ratnagiri', 'type' => 'Private'],

            // Sindhudurg
            ['name' => 'Government Institute of Management Sindhudurg', 'location' => 'Sindhudurg', 'type' => 'Government'],
            ['name' => 'Dayanand Institute of Management Sindhudurg', 'location' => 'Sindhudurg', 'type' => 'Private'],

            // Palghar
            ['name' => 'Government Institute of Management Palghar', 'location' => 'Palghar', 'type' => 'Government'],
            ['name' => 'Vidyavardhini Institute of Management Palghar', 'location' => 'Palghar', 'type' => 'Private'],

            // Beed
            ['name' => 'Government Institute of Management Beed', 'location' => 'Beed', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Institute of Management Beed', 'location' => 'Beed', 'type' => 'Private'],

            // Osmanabad
            ['name' => 'Government Institute of Management Osmanabad', 'location' => 'Osmanabad', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Institute of Management Osmanabad', 'location' => 'Osmanabad', 'type' => 'Private'],

            // Washim
            ['name' => 'Government Institute of Management Washim', 'location' => 'Washim', 'type' => 'Government'],
            ['name' => 'Dayanand Institute of Management Washim', 'location' => 'Washim', 'type' => 'Private'],

            // Hingoli
            ['name' => 'Government Institute of Management Hingoli', 'location' => 'Hingoli', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Institute of Management Hingoli', 'location' => 'Hingoli', 'type' => 'Private'],

            // Buldhana
            ['name' => 'Government Institute of Management Buldhana', 'location' => 'Buldhana', 'type' => 'Government'],
            ['name' => 'Shri Shivaji Institute of Management Buldhana', 'location' => 'Buldhana', 'type' => 'Private'],

            // Gadchiroli
            ['name' => 'Government Institute of Management Gadchiroli', 'location' => 'Gadchiroli', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Institute of Management Gadchiroli', 'location' => 'Gadchiroli', 'type' => 'Private'],

            // Gondia
            ['name' => 'Government Institute of Management Gondia', 'location' => 'Gondia', 'type' => 'Government'],
            ['name' => 'Shri Shivaji Institute of Management Gondia', 'location' => 'Gondia', 'type' => 'Private'],

            // Bhandara
            ['name' => 'Government Institute of Management Bhandara', 'location' => 'Bhandara', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Institute of Management Bhandara', 'location' => 'Bhandara', 'type' => 'Private'],

            // Akola
            ['name' => 'Government Institute of Management Akola', 'location' => 'Akola', 'type' => 'Government'],
            ['name' => 'Shri Shivaji Institute of Management Akola', 'location' => 'Akola', 'type' => 'Private'],

            // Jalna
            ['name' => 'Government Institute of Management Jalna', 'location' => 'Jalna', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Institute of Management Jalna', 'location' => 'Jalna', 'type' => 'Private'],

            // Wardha
            ['name' => 'Government Institute of Management Wardha', 'location' => 'Wardha', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Institute of Management Wardha', 'location' => 'Wardha', 'type' => 'Private'],

            // Nandurbar
            ['name' => 'Government Institute of Management Nandurbar', 'location' => 'Nandurbar', 'type' => 'Government'],
            ['name' => 'Shri Shivaji Institute of Management Nandurbar', 'location' => 'Nandurbar', 'type' => 'Private'],

            // Solapur
            ['name' => 'Government Institute of Management Solapur', 'location' => 'Solapur', 'type' => 'Government'],
            ['name' => 'Walchand Institute of Management Solapur', 'location' => 'Solapur', 'type' => 'Private'],

            // Thane
            ['name' => 'Government Institute of Management Thane', 'location' => 'Thane', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Institute of Management Thane', 'location' => 'Thane', 'type' => 'Private'],

            // Mumbai Suburban
            ['name' => 'Government Institute of Management Mumbai Suburban', 'location' => 'Mumbai Suburban', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi Institute of Management Mumbai Suburban', 'location' => 'Mumbai Suburban', 'type' => 'Private'],
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
