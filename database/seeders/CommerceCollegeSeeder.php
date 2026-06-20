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

            // Sambhajinagar
            ['name' => 'Deogiri College', 'location' => 'Sambhajinagar', 'type' => 'Private'],
            ['name' => 'Dr Babasaheb Ambedkar Marathwada University (Commerce Dept)', 'location' => 'Sambhajinagar', 'type' => 'Government'],

            // Kolhapur
            ['name' => 'Shivaji University Kolhapur (Commerce Dept)', 'location' => 'Kolhapur', 'type' => 'Government'],
            ['name' => 'Rajaram College', 'location' => 'Kolhapur', 'type' => 'Government'],

            // Ahilyanagar
            ['name' => 'New Arts, Commerce and Science College', 'location' => 'Ahilyanagar', 'type' => 'Private'],
            ['name' => 'Shrirampur College', 'location' => 'Ahilyanagar', 'type' => 'Private'],

            // Navi Mumbai
            ['name' => 'SIES College of Arts, Science and Commerce', 'location' => 'Navi Mumbai', 'type' => 'Private'],
            ['name' => 'Pillai College of Arts, Commerce and Science', 'location' => 'Navi Mumbai', 'type' => 'Private'],

            // Jalgaon
            ['name' => 'North Maharashtra University College of Commerce', 'location' => 'Jalgaon', 'type' => 'Government'],
            ['name' => 'MGM College of Commerce Jalgaon', 'location' => 'Jalgaon', 'type' => 'Private'],

            // Amravati
            ['name' => 'Government College of Commerce Amravati', 'location' => 'Amravati', 'type' => 'Government'],
            ['name' => 'Shri Shivaji College of Commerce Amravati', 'location' => 'Amravati', 'type' => 'Private'],

            // Latur
            ['name' => 'Government College of Commerce Latur', 'location' => 'Latur', 'type' => 'Government'],
            ['name' => 'Dayanand College of Commerce Latur', 'location' => 'Latur', 'type' => 'Private'],

            // Chandrapur
            ['name' => 'Government College of Commerce Chandrapur', 'location' => 'Chandrapur', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi College of Commerce Chandrapur', 'location' => 'Chandrapur', 'type' => 'Private'],

            // Dhule
            ['name' => 'Government College of Commerce Dhule', 'location' => 'Dhule', 'type' => 'Government'],
            ['name' => 'SVPM College of Commerce Dhule', 'location' => 'Dhule', 'type' => 'Private'],

            // Nanded
            ['name' => 'Government College of Commerce Nanded', 'location' => 'Nanded', 'type' => 'Government'],
            ['name' => 'Shri Shivaji College of Commerce Nanded', 'location' => 'Nanded', 'type' => 'Private'],

            // Parbhani
            ['name' => 'Government College of Commerce Parbhani', 'location' => 'Parbhani', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi College of Commerce Parbhani', 'location' => 'Parbhani', 'type' => 'Private'],

            // Satara
            ['name' => 'Government College of Commerce Satara', 'location' => 'Satara', 'type' => 'Government'],
            ['name' => 'Yashwantrao Chavan College of Commerce Satara', 'location' => 'Satara', 'type' => 'Private'],

            // Yavatmal
            ['name' => 'Government College of Commerce Yavatmal', 'location' => 'Yavatmal', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi College of Commerce Yavatmal', 'location' => 'Yavatmal', 'type' => 'Private'],

            // Ratnagiri
            ['name' => 'Government College of Commerce Ratnagiri', 'location' => 'Ratnagiri', 'type' => 'Government'],
            ['name' => 'Gogate College of Commerce Ratnagiri', 'location' => 'Ratnagiri', 'type' => 'Private'],

            // Sindhudurg
            ['name' => 'Government College of Commerce Sindhudurg', 'location' => 'Sindhudurg', 'type' => 'Government'],
            ['name' => 'Dayanand College of Commerce Sindhudurg', 'location' => 'Sindhudurg', 'type' => 'Private'],

            // Palghar
            ['name' => 'Government College of Commerce Palghar', 'location' => 'Palghar', 'type' => 'Government'],
            ['name' => 'Vidyavardhini College of Commerce Palghar', 'location' => 'Palghar', 'type' => 'Private'],

            // Beed
            ['name' => 'Government College of Commerce Beed', 'location' => 'Beed', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi College of Commerce Beed', 'location' => 'Beed', 'type' => 'Private'],

            // Osmanabad
            ['name' => 'Government College of Commerce Osmanabad', 'location' => 'Osmanabad', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi College of Commerce Osmanabad', 'location' => 'Osmanabad', 'type' => 'Private'],

            // Washim
            ['name' => 'Government College of Commerce Washim', 'location' => 'Washim', 'type' => 'Government'],
            ['name' => 'Dayanand College of Commerce Washim', 'location' => 'Washim', 'type' => 'Private'],

            // Hingoli
            ['name' => 'Government College of Commerce Hingoli', 'location' => 'Hingoli', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi College of Commerce Hingoli', 'location' => 'Hingoli', 'type' => 'Private'],

            // Buldhana
            ['name' => 'Government College of Commerce Buldhana', 'location' => 'Buldhana', 'type' => 'Government'],
            ['name' => 'Shri Shivaji College of Commerce Buldhana', 'location' => 'Buldhana', 'type' => 'Private'],

            // Gadchiroli
            ['name' => 'Government College of Commerce Gadchiroli', 'location' => 'Gadchiroli', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi College of Commerce Gadchiroli', 'location' => 'Gadchiroli', 'type' => 'Private'],

            // Gondia
            ['name' => 'Government College of Commerce Gondia', 'location' => 'Gondia', 'type' => 'Government'],
            ['name' => 'Shri Shivaji College of Commerce Gondia', 'location' => 'Gondia', 'type' => 'Private'],

            // Bhandara
            ['name' => 'Government College of Commerce Bhandara', 'location' => 'Bhandara', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi College of Commerce Bhandara', 'location' => 'Bhandara', 'type' => 'Private'],

            // Akola
            ['name' => 'Government College of Commerce Akola', 'location' => 'Akola', 'type' => 'Government'],
            ['name' => 'Shri Shivaji College of Commerce Akola', 'location' => 'Akola', 'type' => 'Private'],

            // Jalna
            ['name' => 'Government College of Commerce Jalna', 'location' => 'Jalna', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi College of Commerce Jalna', 'location' => 'Jalna', 'type' => 'Private'],

            // Wardha
            ['name' => 'Government College of Commerce Wardha', 'location' => 'Wardha', 'type' => 'Government'],
            ['name' => 'Mahatma Gandhi College of Commerce Wardha', 'location' => 'Wardha', 'type' => 'Private'],

            // Nandurbar
            ['name' => 'Government College of Commerce Nandurbar', 'location' => 'Nandurbar', 'type' => 'Government'],
            ['name' => 'Shri Shivaji College of Commerce Nandurbar', 'location' => 'Nandurbar', 'type' => 'Private'],

            // Sangli
            ['name' => 'Government College of Commerce Sangli', 'location' => 'Sangli', 'type' => 'Government'],
            ['name' => 'Walchand College of Commerce Sangli', 'location' => 'Sangli', 'type' => 'Private'],

            // Solapur
            ['name' => 'Sangameshwar College of Commerce', 'location' => 'Solapur', 'type' => 'Private'],
            ['name' => 'Walchand College of Commerce Solapur', 'location' => 'Solapur', 'type' => 'Private'],
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
