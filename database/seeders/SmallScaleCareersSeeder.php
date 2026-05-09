<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SmallScaleCareersSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'small-scale')->first();
        if (!$field) return;

        $careers = [
            // Food & Beverages
            ['name' => 'Bakery Owner', 'icon' => 'fa-bread-slice', 'img' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹20L', 'demand' => 'High'],
            ['name' => 'Cloud Kitchen Operator', 'icon' => 'fa-utensils', 'img' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹30L', 'demand' => 'Very High'],
            ['name' => 'Cafe Owner', 'icon' => 'fa-mug-hot', 'img' => 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹25L', 'demand' => 'High'],
            ['name' => 'Organic Food Producer', 'icon' => 'fa-leaf', 'img' => 'https://images.unsplash.com/photo-1592982537447-7440770cbfc9?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'demand' => 'Growing'],
            ['name' => 'Spice Processing Business', 'icon' => 'fa-mortar-pestle', 'img' => 'https://images.unsplash.com/photo-1596040033229-a9821ebd058d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹18L', 'demand' => 'Stable'],
            
            // Retail & E-commerce
            ['name' => 'E-commerce Seller', 'icon' => 'fa-cart-shopping', 'img' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹50L+', 'demand' => 'Very High'],
            ['name' => 'Boutique Owner', 'icon' => 'fa-shirt', 'img' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹20L', 'demand' => 'Stable'],
            ['name' => 'Supermarket Franchisee', 'icon' => 'fa-store', 'img' => 'https://images.unsplash.com/photo-1534723452862-4c874018d66d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹30L', 'demand' => 'Stable'],
            ['name' => 'Dropshipping Entrepreneur', 'icon' => 'fa-box-open', 'img' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹25L', 'demand' => 'Growing'],
            ['name' => 'Handicraft Exporter', 'icon' => 'fa-palette', 'img' => 'https://images.unsplash.com/photo-1606722590583-6951b5ea92ad?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹25L', 'demand' => 'Growing'],

            // Services & Maintenance
            ['name' => 'Event Management Agency', 'icon' => 'fa-calendar-check', 'img' => 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹40L', 'demand' => 'High'],
            ['name' => 'Digital Marketing Agency Owner', 'icon' => 'fa-bullhorn', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹50L+', 'demand' => 'Very High'],
            ['name' => 'Cleaning Services Agency', 'icon' => 'fa-broom', 'img' => 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'demand' => 'Growing'],
            ['name' => 'Home Repair/Maintenance Agency', 'icon' => 'fa-wrench', 'img' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹18L', 'demand' => 'High'],
            ['name' => 'Packers and Movers Agency', 'icon' => 'fa-truck-fast', 'img' => 'https://images.unsplash.com/photo-1600518464441-9154a4dea21b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹25L', 'demand' => 'Stable'],

            // Health, Beauty & Fitness
            ['name' => 'Salon / Spa Owner', 'icon' => 'fa-spa', 'img' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹30L', 'demand' => 'High'],
            ['name' => 'Gym / Fitness Center Owner', 'icon' => 'fa-dumbbell', 'img' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹40L', 'demand' => 'High'],
            ['name' => 'Yoga Studio Owner', 'icon' => 'fa-om', 'img' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹20L', 'demand' => 'Growing'],
            ['name' => 'Pharmacy Shop Owner', 'icon' => 'fa-pills', 'img' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹25L', 'demand' => 'Stable'],
            ['name' => 'Organic Cosmetics Maker', 'icon' => 'fa-spray-can', 'img' => 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'demand' => 'Growing'],

            // Education & Consulting
            ['name' => 'Coaching Center Owner', 'icon' => 'fa-chalkboard-user', 'img' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹50L+', 'demand' => 'Very High'],
            ['name' => 'Corporate Training Agency', 'icon' => 'fa-users', 'img' => 'https://images.unsplash.com/photo-1515169067868-5387ec356754?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹40L', 'demand' => 'Growing'],
            ['name' => 'Career Counseling Agency', 'icon' => 'fa-compass', 'img' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹20L', 'demand' => 'Growing'],
            ['name' => 'HR Recruitment Agency', 'icon' => 'fa-user-tie', 'img' => 'https://images.unsplash.com/photo-1556761175-4b46a572b786?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹35L', 'demand' => 'High'],
            ['name' => 'Financial Consulting Firm', 'icon' => 'fa-chart-pie', 'img' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹50L+', 'demand' => 'High'],

            // Manufacturing & Assembly
            ['name' => 'Packaging Material Manufacturer', 'icon' => 'fa-box', 'img' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹30L', 'demand' => 'Stable'],
            ['name' => 'Paper Bag/Cup Manufacturer', 'icon' => 'fa-bag-shopping', 'img' => 'https://images.unsplash.com/photo-1606722590583-6951b5ea92ad?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'demand' => 'Growing'],
            ['name' => 'Candle & Soap Making Business', 'icon' => 'fa-fire-flame-simple', 'img' => 'https://images.unsplash.com/photo-1603006905003-be475563bc59?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹10L', 'demand' => 'Stable'],
            ['name' => 'Furniture Manufacturing', 'icon' => 'fa-chair', 'img' => 'https://images.unsplash.com/photo-1538688525198-9b88f6f53126?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹40L', 'demand' => 'Stable'],
            ['name' => 'Custom Apparel Manufacturer', 'icon' => 'fa-shirt', 'img' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹30L', 'demand' => 'Growing'],

            // Tech & IT Startups
            ['name' => 'App Development Agency', 'icon' => 'fa-code', 'img' => 'https://images.unsplash.com/photo-1551288049-bbda38a594a0?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹60L+', 'demand' => 'Very High'],
            ['name' => 'IT Support Business', 'icon' => 'fa-headset', 'img' => 'https://images.unsplash.com/photo-1551434678-e076c223a692?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹25L', 'demand' => 'High'],
            ['name' => 'SaaS Product Founder', 'icon' => 'fa-laptop-code', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹1Cr+', 'demand' => 'Very High'],
            ['name' => 'SEO Agency Owner', 'icon' => 'fa-magnifying-glass-chart', 'img' => 'https://images.unsplash.com/photo-1432888622747-4eb9a8efeb07?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹40L', 'demand' => 'High'],
            ['name' => 'Cybersecurity Consulting Firm', 'icon' => 'fa-shield-halved', 'img' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹60L+', 'demand' => 'Very High'],

            // Miscellaneous Services
            ['name' => 'Travel Agency Owner', 'icon' => 'fa-plane', 'img' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹30L', 'demand' => 'Growing'],
            ['name' => 'Real Estate Agency', 'icon' => 'fa-building', 'img' => 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹50L+', 'demand' => 'High'],
            ['name' => 'Photography Studio Owner', 'icon' => 'fa-camera', 'img' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹20L', 'demand' => 'Stable'],
            ['name' => 'Interior Design Firm', 'icon' => 'fa-couch', 'img' => 'https://images.unsplash.com/photo-1618221195710-dd6b1466a12a?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹40L', 'demand' => 'High'],
            ['name' => 'Pet Care & Grooming Services', 'icon' => 'fa-paw', 'img' => 'https://images.unsplash.com/photo-1516734212186-a967f81ad0d7?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'demand' => 'Growing'],
            ['name' => 'Car Wash & Detailing Business', 'icon' => 'fa-car', 'img' => 'https://images.unsplash.com/photo-1520340356584-f9917d1eea6f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹18L', 'demand' => 'Stable'],
            ['name' => 'Printing & Packaging Agency', 'icon' => 'fa-print', 'img' => 'https://images.unsplash.com/photo-1562564055-71e051d33c19?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹25L', 'demand' => 'Stable'],
            ['name' => 'Freelance Marketplace Founder', 'icon' => 'fa-laptop', 'img' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹50L+', 'demand' => 'High'],
            ['name' => 'Translation & Localization Agency', 'icon' => 'fa-language', 'img' => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹20L', 'demand' => 'Growing'],
            ['name' => 'Sustainability Consulting Firm', 'icon' => 'fa-leaf', 'img' => 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹30L', 'demand' => 'Very High'],
            ['name' => 'Nursery & Plant Shop', 'icon' => 'fa-seedling', 'img' => 'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'demand' => 'Stable'],
            ['name' => 'Food Truck Owner', 'icon' => 'fa-truck', 'img' => 'https://images.unsplash.com/photo-1565123409695-37563d8673a1?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹18L', 'demand' => 'Growing'],
            ['name' => 'Microbrewery Founder', 'icon' => 'fa-beer-mug-empty', 'img' => 'https://images.unsplash.com/photo-1551024709-8f23befc6f87?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹40L', 'demand' => 'Growing'],
            ['name' => 'Coworking Space Owner', 'icon' => 'fa-building-user', 'img' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹50L+', 'demand' => 'High'],
            ['name' => 'Gifting Solutions Agency', 'icon' => 'fa-gift', 'img' => 'https://images.unsplash.com/photo-1549465220-1a8b9238cd48?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹18L', 'demand' => 'Stable']
        ];

        foreach ($careers as $c) {
            Career::updateOrCreate(
                ['slug' => Str::slug($c['name'])],
                [
                    'name'           => $c['name'],
                    'field_id'       => $field->id,
                    'description'    => $c['name'] . ' is a dynamic entrepreneurial path allowing you to build your own business, generate employment, and achieve financial independence.',
                    'qualification'  => 'Varies (Business acumen more important than degrees)',
                    'stream'         => 'Any (Commerce/BBA preferred for management)',
                    'salary_range'   => $c['salary'],
                    'demand_level'   => $c['demand'],
                    'icon'           => $c['icon'],
                    'image'          => $c['img'],
                    'roadmap'        => [
                        'Identify a market gap or business idea',
                        'Conduct market research and create a business plan',
                        'Secure funding (Bootstrap, MSME loans, Investors)',
                        'Register the business and obtain necessary licenses',
                        'Set up operations, location, or digital presence',
                        'Market the product/service and acquire customers',
                        'Scale the business and build a team',
                    ],
                    'skills'         => ['Leadership', 'Sales & Marketing', 'Financial Management', 'Risk Taking', 'Networking'],
                    'future_scope'   => 'India is the world\'s 3rd largest startup ecosystem. Government initiatives like Startup India, Mudra Yojana, and MSME support make this an excellent time for small scale businesses to thrive.',
                    'entrance_exams' => ['None (MBA Entrance like CAT can be helpful)'],
                    'job_opportunities' => ['Self-Employed', 'Business Owner', 'Franchise Owner', 'Partnerships'],
                    'related_careers' => ['Entrepreneur', 'Business Manager', 'Sales Manager'],
                ]
            );
        }
    }
}
