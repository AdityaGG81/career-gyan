<?php

namespace Database\Seeders;

use App\Models\TraditionalCareer;
use App\Models\SportCareer;
use Illuminate\Database\Seeder;

class PortableDataSeeder extends Seeder
{
    public function run(): void
    {
        // Traditional Careers
        $traditional = [
            [
                'category' => 'Engineering & Tech',
                'icon' => 'fa-microchip',
                'name' => 'Civil/Mech/Comp Engineering',
                'education' => 'B.E. / B.Tech',
                'exam' => 'JEE Main/Adv, MHT-CET',
                'duration' => '4 Years',
                'salary' => '₹4L - ₹25L+',
                'stability' => 'High'
            ],
            [
                'category' => 'Medical Sciences',
                'icon' => 'fa-user-doctor',
                'name' => 'Doctor (MBBS)',
                'education' => 'MBBS',
                'exam' => 'NEET UG',
                'duration' => '5.5 Years',
                'salary' => '₹8L - ₹30L+',
                'stability' => 'Very High'
            ],
            [
                'category' => 'Medical Sciences',
                'icon' => 'fa-user-doctor',
                'name' => 'Dentistry / Nursing',
                'education' => 'BDS / B.Sc Nursing',
                'exam' => 'NEET',
                'duration' => '4 Years',
                'salary' => '₹3L - ₹12L',
                'stability' => 'High'
            ],
            [
                'category' => 'Commerce & Finance',
                'icon' => 'fa-money-bill-trend-up',
                'name' => 'Chartered Accountant (CA)',
                'education' => 'CA Foundation/Inter/Final',
                'exam' => 'ICAI Exams',
                'duration' => '5 Years',
                'salary' => '₹7L - ₹20L+',
                'stability' => 'Very High'
            ],
            [
                'category' => 'Commerce & Finance',
                'icon' => 'fa-money-bill-trend-up',
                'name' => 'Banking / IBPS',
                'education' => 'Any Graduate',
                'exam' => 'IBPS PO/Clerk, SBI',
                'duration' => '1 Year Prep',
                'salary' => '₹4L - ₹10L',
                'stability' => 'Very High'
            ],
            [
                'category' => 'Government & Defence',
                'icon' => 'fa-shield-halved',
                'name' => 'Civil Services (IAS/IPS)',
                'education' => 'Any Graduate',
                'exam' => 'UPSC / MPSC',
                'duration' => '1-3 Years Prep',
                'salary' => '₹7L - ₹15L',
                'stability' => 'Absolute'
            ],
            [
                'category' => 'Government & Defence',
                'icon' => 'fa-shield-halved',
                'name' => 'Military Officer',
                'education' => 'NDA / CDS',
                'exam' => 'NDA, CDS Exams',
                'duration' => '3-4 Years TRG',
                'salary' => '₹8L - ₹18L',
                'stability' => 'Absolute'
            ],
            [
                'category' => 'Teaching & Law',
                'icon' => 'fa-graduation-cap',
                'name' => 'Legal Professional',
                'education' => 'LLB / Integrated LLB',
                'exam' => 'CLAT, MH-CET Law',
                'duration' => '3-5 Years',
                'salary' => '₹5L - ₹30L',
                'stability' => 'Medium-High'
            ],
            [
                'category' => 'Teaching & Law',
                'icon' => 'fa-graduation-cap',
                'name' => 'Professor / Teacher',
                'education' => 'B.Ed / NET / SET',
                'exam' => 'TET, NET',
                'duration' => '2-4 Years',
                'salary' => '₹3L - ₹12L',
                'stability' => 'High'
            ]
        ];

        foreach ($traditional as $t) {
            TraditionalCareer::updateOrCreate(['name' => $t['name']], $t);
        }

        // Sports Careers
        $sports = [
            ['name' => 'Cricket', 'icon' => 'fa-baseball-bat-ball', 'description' => 'The most popular sport in India with vast career scope in IPL and National teams.'],
            ['name' => 'Football', 'icon' => 'fa-futbol', 'description' => 'Rapidly growing with ISL and local leagues, offering paths for players and coaches.'],
            ['name' => 'Badminton', 'icon' => 'fa-shuttlecock', 'description' => 'Highly competitive with strong international presence from India.'],
            ['name' => 'Hockey', 'icon' => 'fa-hockey-puck', 'description' => 'Our national pride with dedicated academies across the country.'],
            ['name' => 'Athletics', 'icon' => 'fa-person-running', 'description' => 'Focus on Track & Field, Sprinting, and Olympics-based training.'],
            ['name' => 'Martial Arts', 'icon' => 'fa-user-ninja', 'description' => 'Self-defense, Mixed Martial Arts (MMA), and Karate-based careers.'],
        ];

        foreach ($sports as $s) {
            SportCareer::updateOrCreate(['name' => $s['name']], $s);
        }
    }
}
