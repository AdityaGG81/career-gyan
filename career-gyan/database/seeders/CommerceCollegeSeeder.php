<?php

namespace Database\Seeders;

use App\Models\College;
use App\Models\Field;
use Illuminate\Database\Seeder;

class CommerceCollegeSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'commerce')->firstOrFail();

        $collegesData = [
            // Mumbai
            ['name' => 'St. Xavier\'s College Mumbai', 'location' => 'Mumbai', 'type' => 'Private'],
            ['name' => 'Narsee Monjee College of Commerce & Economics (NM College)', 'location' => 'Mumbai', 'type' => 'Private', 'is_top' => true],
            ['name' => 'H.R. College of Commerce and Economics', 'location' => 'Mumbai', 'type' => 'Private', 'is_top' => true],
            ['name' => 'R A Podar College of Commerce and Economics', 'location' => 'Mumbai', 'type' => 'Private'],
            ['name' => 'Sydenham College of Commerce and Economics', 'location' => 'Mumbai', 'type' => 'Government'],
            ['name' => 'K J Somaiya College of Arts & Commerce', 'location' => 'Mumbai', 'type' => 'Private'],
            ['name' => 'Jai Hind College', 'location' => 'Mumbai', 'type' => 'Private'],
            ['name' => 'KPB Hinduja College of Commerce', 'location' => 'Mumbai', 'type' => 'Private'],
            ['name' => 'Mithibai College of Arts, Commerce and Science', 'location' => 'Mumbai', 'type' => 'Private'],
            ['name' => 'Kishinchand Chellaram College (KC College)', 'location' => 'Mumbai', 'type' => 'Private'],

            // Pune
            ['name' => 'Brihan Maharashtra College of Commerce (BMCC)', 'location' => 'Pune', 'type' => 'Private', 'is_top' => true],
            ['name' => 'Symbiosis College of Arts and Commerce', 'location' => 'Pune', 'type' => 'Private', 'is_top' => true],
            ['name' => 'Ness Wadia College of Commerce', 'location' => 'Pune', 'type' => 'Private'],
            ['name' => 'Garware College of Commerce', 'location' => 'Pune', 'type' => 'Private'],
            ['name' => 'Modern College of Arts, Science and Commerce', 'location' => 'Pune', 'type' => 'Private'],
            ['name' => 'MIT World Peace University (Commerce)', 'location' => 'Pune', 'type' => 'Private'],
            ['name' => 'Marathwada Mitra Mandal College of Commerce', 'location' => 'Pune', 'type' => 'Private'],

            // Nagpur
            ['name' => 'Hislop College', 'location' => 'Nagpur', 'type' => 'Private'],
            ['name' => 'Dr Ambedkar College of Commerce', 'location' => 'Nagpur', 'type' => 'Private'],
            ['name' => 'Rashtrasant Tukadoji Maharaj Nagpur University (Commerce Dept)', 'location' => 'Nagpur', 'type' => 'Government'],

            // Nashik
            ['name' => 'BYK College of Commerce', 'location' => 'Nashik', 'type' => 'Private'],
            ['name' => 'KTHM College Nashik', 'location' => 'Nashik', 'type' => 'Private'],
            ['name' => 'HPT Arts & RYK Science College (Commerce)', 'location' => 'Nashik', 'type' => 'Private'],

            // Aurangabad
            ['name' => 'Deogiri College', 'location' => 'Aurangabad', 'type' => 'Private'],
            ['name' => 'Dr Babasaheb Ambedkar Marathwada University (Commerce Dept)', 'location' => 'Aurangabad', 'type' => 'Government'],

            // Kolhapur
            ['name' => 'Shivaji University Kolhapur (Commerce Dept)', 'location' => 'Kolhapur', 'type' => 'Government'],
            ['name' => 'Rajaram College', 'location' => 'Kolhapur', 'type' => 'Government'],

            // Ahmednagar
            ['name' => 'New Arts, Commerce and Science College', 'location' => 'Ahmednagar', 'type' => 'Private'],
            ['name' => 'Shrirampur College', 'location' => 'Ahmednagar', 'type' => 'Private'],

            // Navi Mumbai
            ['name' => 'SIES College of Arts, Science and Commerce', 'location' => 'Navi Mumbai', 'type' => 'Private'],
            ['name' => 'Pillai College of Arts, Commerce and Science', 'location' => 'Navi Mumbai', 'type' => 'Private'],
        ];

        foreach ($collegesData as $collegeInfo) {
            $isTop = $collegeInfo['is_top'] ?? false;
            $type = $collegeInfo['type'];
            
            $fees = ($isTop) ? '₹40,000 – ₹1,50,000 per year' : '₹8,000 – ₹30,000 per year';

            College::updateOrCreate(
                ['name' => $collegeInfo['name'], 'field_id' => $field->id],
                [
                    'location' => $collegeInfo['location'],
                    'state' => 'Maharashtra',
                    'type' => $type,
                    'rank' => $isTop ? 1 : null,
                    'fees_range' => $fees,
                    'cutoff' => 'Merit-based (12th Marks)',
                    'popular_branches' => 'B.Com / M.Com in Accounting, Finance, Banking, Insurance',
                    'specializations' => 'Accounting & Finance (BAF), Banking & Insurance (BBI), Financial Markets (BFM)',
                    'facilities' => 'Advanced Computer Labs, Massive Library, Placement Cell, Smart Classrooms, Auditorium',
                    'description' => 'This college offers strong commerce education with focus on finance, accounting, and business skills.',
                    'placement_support' => 'Deloitte, KPMG, EY, HDFC Bank, ICICI Bank, TCS, Reliance',
                    'average_package' => '₹3 LPA – ₹8 LPA (Higher for top-tier institutes)'
                ]
            );
        }
    }
}
