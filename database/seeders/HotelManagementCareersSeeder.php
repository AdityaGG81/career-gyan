<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class HotelManagementCareersSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'hotel-management')->first();
        if (!$field) return;

        $careers = [
            // Core Hotel Management
            ['name' => 'General Manager (Hotel)', 'icon' => 'fa-building', 'img' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&q=80', 'salary' => '₹12L – ₹50L+', 'demand' => 'High'],
            ['name' => 'Front Office Manager', 'icon' => 'fa-bell-concierge', 'img' => 'https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹15L', 'demand' => 'High'],
            ['name' => 'Executive Housekeeper', 'icon' => 'fa-broom', 'img' => 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹12L', 'demand' => 'Stable'],
            ['name' => 'Food & Beverage (F&B) Manager', 'icon' => 'fa-wine-glass', 'img' => 'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹20L', 'demand' => 'Very High'],
            ['name' => 'Guest Relations Executive', 'icon' => 'fa-handshake', 'img' => 'https://images.unsplash.com/photo-1556745753-b2904692b3cd?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹8L', 'demand' => 'High'],

            // Culinary Arts / Kitchen
            ['name' => 'Executive Chef', 'icon' => 'fa-hat-wizard', 'img' => 'https://images.unsplash.com/photo-1577219491135-ce391730fb2c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹10L – ₹40L+', 'demand' => 'High'],
            ['name' => 'Sous Chef', 'icon' => 'fa-utensils', 'img' => 'https://images.unsplash.com/photo-1577219491135-ce391730fb2c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹15L', 'demand' => 'Very High'],
            ['name' => 'Pastry Chef (Patissier)', 'icon' => 'fa-cake-candles', 'img' => 'https://images.unsplash.com/photo-1559598467-f8b76c8155d0?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'Growing'],
            ['name' => 'Sommelier (Wine Expert)', 'icon' => 'fa-wine-bottle', 'img' => 'https://images.unsplash.com/photo-1510812431401-41d2bd2722f3?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹20L', 'demand' => 'Growing'],
            ['name' => 'Culinary Director', 'icon' => 'fa-fire-burner', 'img' => 'https://images.unsplash.com/photo-1577219491135-ce391730fb2c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹12L – ₹45L', 'demand' => 'Stable'],

            // Tourism & Travel
            ['name' => 'Travel Agency Manager', 'icon' => 'fa-plane', 'img' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Stable'],
            ['name' => 'Tour Operator / Guide', 'icon' => 'fa-map-location-dot', 'img' => 'https://images.unsplash.com/photo-1527631746610-bca00a040d60?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹10L', 'demand' => 'Growing'],
            ['name' => 'Cruise Ship Director', 'icon' => 'fa-ship', 'img' => 'https://images.unsplash.com/photo-1599640842225-85d111c60e6b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹25L (Tax-Free)', 'demand' => 'High'],
            ['name' => 'Airline Catering Manager', 'icon' => 'fa-plane-departure', 'img' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹18L', 'demand' => 'Stable'],
            ['name' => 'Tourism Destination Marketer', 'icon' => 'fa-earth-americas', 'img' => 'https://images.unsplash.com/photo-1488085061387-422e29b40080?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹20L', 'demand' => 'Growing'],

            // Events & Banquet
            ['name' => 'Event Manager / Planner', 'icon' => 'fa-calendar-check', 'img' => 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹20L', 'demand' => 'High'],
            ['name' => 'Banquet Manager', 'icon' => 'fa-champagne-glasses', 'img' => 'https://images.unsplash.com/photo-1530103862676-de8892bc952f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹15L', 'demand' => 'High'],
            ['name' => 'Wedding Planner', 'icon' => 'fa-ring', 'img' => 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹30L+', 'demand' => 'Very High'],
            ['name' => 'Conference/Exhibition Organizer', 'icon' => 'fa-people-group', 'img' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'Stable'],
            ['name' => 'Club Manager', 'icon' => 'fa-music', 'img' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹20L', 'demand' => 'High'],

            // Aviation Hospitality
            ['name' => 'Flight Attendant / Cabin Crew', 'icon' => 'fa-plane-up', 'img' => 'https://images.unsplash.com/photo-1542296332-2e4473faf563?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹15L', 'demand' => 'High'],
            ['name' => 'Airport Lounge Manager', 'icon' => 'fa-mug-hot', 'img' => 'https://images.unsplash.com/photo-1524850011238-e3d235c7d4c9?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹12L', 'demand' => 'Stable'],
            ['name' => 'Ground Staff Manager', 'icon' => 'fa-suitcase-rolling', 'img' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹10L', 'demand' => 'High'],
            
            // Sales, Marketing & Operations
            ['name' => 'Revenue Manager', 'icon' => 'fa-chart-line', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹25L', 'demand' => 'High'],
            ['name' => 'Hotel Sales & Marketing Director', 'icon' => 'fa-bullseye', 'img' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=800&q=80', 'salary' => '₹10L – ₹30L', 'demand' => 'High'],
            ['name' => 'Catering Sales Manager', 'icon' => 'fa-utensils', 'img' => 'https://images.unsplash.com/photo-1555244162-803834f70033?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹15L', 'demand' => 'Stable'],
            ['name' => 'Facility Manager', 'icon' => 'fa-building-shield', 'img' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹18L', 'demand' => 'High'],
            
            // Specialised & Luxury
            ['name' => 'Spa & Wellness Director', 'icon' => 'fa-spa', 'img' => 'https://images.unsplash.com/photo-1544161515-4ab6ce6db874?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹20L', 'demand' => 'Growing'],
            ['name' => 'Resort Manager', 'icon' => 'fa-umbrella-beach', 'img' => 'https://images.unsplash.com/photo-1499793983690-e29da59ef1c2?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹30L', 'demand' => 'High'],
            ['name' => 'Casino Manager', 'icon' => 'fa-dice', 'img' => 'https://images.unsplash.com/photo-1596838132731-3301c3fd4317?auto=format&fit=crop&w=800&q=80', 'salary' => '₹10L – ₹40L', 'demand' => 'Stable'],
            ['name' => 'Sommelier / Mixologist', 'icon' => 'fa-martini-glass', 'img' => 'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'High'],
            ['name' => 'Luxury Concierge', 'icon' => 'fa-key', 'img' => 'https://images.unsplash.com/photo-1556745753-b2904692b3cd?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹12L', 'demand' => 'Stable'],

            // Fill up remaining to hit ~50 overall
            ['name' => 'Restaurant Manager', 'icon' => 'fa-store', 'img' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'High'],
            ['name' => 'Food Critic / Blogger', 'icon' => 'fa-pen-nib', 'img' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Growing'],
            ['name' => 'Barista / Cafe Manager', 'icon' => 'fa-mug-saucer', 'img' => 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2.5L – ₹8L', 'demand' => 'Very High'],
            ['name' => 'Hospitality Consultant', 'icon' => 'fa-briefcase', 'img' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹30L', 'demand' => 'Growing'],
            ['name' => 'Catering Entrepreneur', 'icon' => 'fa-truck', 'img' => 'https://images.unsplash.com/photo-1565123409695-37563d8673a1?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹25L+', 'demand' => 'High'],
            ['name' => 'Chocolatier', 'icon' => 'fa-cookie-bite', 'img' => 'https://images.unsplash.com/photo-1548883354-94cb0ce5e0fa?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'demand' => 'Growing'],
            ['name' => 'Theme Park Manager', 'icon' => 'fa-ticket', 'img' => 'https://images.unsplash.com/photo-1513151233558-d860c5398176?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹20L', 'demand' => 'Stable'],
            ['name' => 'Accommodation Manager', 'icon' => 'fa-bed', 'img' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹12L', 'demand' => 'Stable'],
            ['name' => 'In-Flight Services Manager', 'icon' => 'fa-plane', 'img' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹20L', 'demand' => 'Stable'],
            ['name' => 'Boutique Hotel Owner', 'icon' => 'fa-building', 'img' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Growing'],
            ['name' => 'Hospitality Educator / Professor', 'icon' => 'fa-chalkboard-user', 'img' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹15L', 'demand' => 'Stable'],
            ['name' => 'Bed & Breakfast Host', 'icon' => 'fa-house-chimney', 'img' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Growing'],
            ['name' => 'Eco-Tourism Guide', 'icon' => 'fa-leaf', 'img' => 'https://images.unsplash.com/photo-1527631746610-bca00a040d60?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹10L', 'demand' => 'Growing'],
            ['name' => 'Golf Resort Manager', 'icon' => 'fa-golf-ball-tee', 'img' => 'https://images.unsplash.com/photo-1587329310686-91414b8e3cb7?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹25L', 'demand' => 'Stable'],
            ['name' => 'Hotel HR Manager', 'icon' => 'fa-users', 'img' => 'https://images.unsplash.com/photo-1556761175-4b46a572b786?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹15L', 'demand' => 'High'],
            ['name' => 'Hotel IT Manager', 'icon' => 'fa-computer', 'img' => 'https://images.unsplash.com/photo-1551434678-e076c223a692?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹18L', 'demand' => 'Stable'],
            ['name' => 'Public Relations (PR) Manager Hotel', 'icon' => 'fa-bullhorn', 'img' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹18L', 'demand' => 'Stable'],
            ['name' => 'Personal Chef', 'icon' => 'fa-fire-burner', 'img' => 'https://images.unsplash.com/photo-1577219491135-ce391730fb2c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹20L', 'demand' => 'Growing'],
        ];

        foreach ($careers as $c) {
            Career::updateOrCreate(
                ['slug' => Str::slug($c['name'])],
                [
                    'name'           => $c['name'],
                    'field_id'       => $field->id,
                    'description'    => $c['name'] . ' is an exciting career in the hospitality industry, requiring excellent communication skills and a passion for customer service.',
                    'qualification'  => 'BHM / Degree/Diploma in Hotel Management or Culinary Arts',
                    'stream'         => 'Any Stream',
                    'salary_range'   => $c['salary'],
                    'demand_level'   => $c['demand'],
                    'icon'           => $c['icon'],
                    'image'          => $c['img'],
                    'roadmap'        => [
                        'Complete 12th standard in any stream',
                        'Clear NCHMCT JEE or other hotel management entrance exams',
                        'Pursue a B.Sc in Hospitality and Hotel Administration or BHM',
                        'Complete industrial training and internships in 5-star properties',
                        'Apply for Management Trainee programs (e.g., Oberoi OCLD, Taj TM)',
                        'Gain experience and climb the ladder to executive roles',
                    ],
                    'skills'         => ['Communication', 'Customer Service', 'Problem Solving', 'Leadership', 'Grooming & Etiquette'],
                    'future_scope'   => 'The tourism and hospitality sector is one of the largest employers globally. It offers opportunities to travel, work on cruise ships, or settle abroad.',
                    'entrance_exams' => ['NCHMCT JEE', 'eCHAT', 'AIMA UGAT'],
                    'job_opportunities' => ['Luxury Hotels (Taj, Marriott)', 'Cruise Lines', 'Airlines', 'Event Management Companies'],
                    'related_careers' => ['Travel Consultant', 'Event Planner', 'Food & Beverage Director'],
                ]
            );
        }
    }
}
