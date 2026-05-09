<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AgricultureCareersSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'agriculture')->first();
        if (!$field) return;

        $careers = [
            // Core Farming & Agribusiness
            ['name' => 'Organic Farmer', 'icon' => 'fa-leaf', 'img' => 'https://images.unsplash.com/photo-1592982537447-7440770cbfc9?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'demand' => 'High'],
            ['name' => 'Agronomist', 'icon' => 'fa-seedling', 'img' => 'https://images.unsplash.com/photo-1628102491629-778571d893a3?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'High'],
            ['name' => 'Agricultural Scientist', 'icon' => 'fa-flask', 'img' => 'https://images.unsplash.com/photo-1581093588401-fbb62a02f120?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹25L', 'demand' => 'Growing'],
            ['name' => 'Agribusiness Manager', 'icon' => 'fa-briefcase', 'img' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹20L', 'demand' => 'Very High'],
            ['name' => 'Farm Manager', 'icon' => 'fa-tractor', 'img' => 'https://images.unsplash.com/photo-1592982537447-7440770cbfc9?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Stable'],
            
            // Tech & Engineering
            ['name' => 'Agricultural Engineer', 'icon' => 'fa-cogs', 'img' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹20L', 'demand' => 'High'],
            ['name' => 'Precision Agriculture Specialist', 'icon' => 'fa-satellite-dish', 'img' => 'https://images.unsplash.com/photo-1581094794329-c8112a89af12?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹22L', 'demand' => 'Very High'],
            ['name' => 'Agricultural Drone Pilot', 'icon' => 'fa-helicopter', 'img' => 'https://images.unsplash.com/photo-1473968512647-3e447244af8f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Growing'],
            ['name' => 'Irrigation Engineer', 'icon' => 'fa-water', 'img' => 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'Stable'],
            ['name' => 'Soil Scientist', 'icon' => 'fa-mountain', 'img' => 'https://images.unsplash.com/photo-1628102491629-778571d893a3?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹20L', 'demand' => 'Stable'],

            // Plant & Crop Sciences
            ['name' => 'Plant Breeder', 'icon' => 'fa-dna', 'img' => 'https://images.unsplash.com/photo-1530836369250-ef71a3a5e4d1?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹22L', 'demand' => 'Growing'],
            ['name' => 'Horticulturist', 'icon' => 'fa-tree', 'img' => 'https://images.unsplash.com/photo-1585320806297-9794b3e4ce11?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'demand' => 'Stable'],
            ['name' => 'Floriculturist', 'icon' => 'fa-fan', 'img' => 'https://images.unsplash.com/photo-1563241527-3004b7be0ffd?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'demand' => 'Growing'],
            ['name' => 'Plant Pathologist', 'icon' => 'fa-microscope', 'img' => 'https://images.unsplash.com/photo-1579154204601-01588f351e67?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹20L', 'demand' => 'Stable'],
            ['name' => 'Weed Scientist', 'icon' => 'fa-leaf', 'img' => 'https://images.unsplash.com/photo-1628102491629-778571d893a3?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'Stable'],

            // Animal Husbandry
            ['name' => 'Dairy Farm Manager', 'icon' => 'fa-cow', 'img' => 'https://images.unsplash.com/photo-1500595046743-cd271d694d30?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Stable'],
            ['name' => 'Poultry Farm Manager', 'icon' => 'fa-egg', 'img' => 'https://images.unsplash.com/photo-1548550023-2bf3c49bceee?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'demand' => 'Stable'],
            ['name' => 'Animal Geneticist', 'icon' => 'fa-dna', 'img' => 'https://images.unsplash.com/photo-1530836369250-ef71a3a5e4d1?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹25L', 'demand' => 'Growing'],
            ['name' => 'Veterinary Inspector', 'icon' => 'fa-stethoscope', 'img' => 'https://images.unsplash.com/photo-1622253692010-333f2da6031d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'High'],
            ['name' => 'Livestock Manager', 'icon' => 'fa-horse', 'img' => 'https://images.unsplash.com/photo-1500595046743-cd271d694d30?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'demand' => 'Stable'],

            // Allied Sectors
            ['name' => 'Aquaculturist', 'icon' => 'fa-fish', 'img' => 'https://images.unsplash.com/photo-1524704654690-b56c05c78a00?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Growing'],
            ['name' => 'Fisheries Biologist', 'icon' => 'fa-fish-fins', 'img' => 'https://images.unsplash.com/photo-1524704654690-b56c05c78a00?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'Stable'],
            ['name' => 'Sericulturist', 'icon' => 'fa-bug', 'img' => 'https://images.unsplash.com/photo-1628102491629-778571d893a3?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹10L', 'demand' => 'Stable'],
            ['name' => 'Apiculturist (Beekeeper)', 'icon' => 'fa-bug', 'img' => 'https://images.unsplash.com/photo-1587049352847-4d4b12b14185?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹8L', 'demand' => 'Growing'],
            ['name' => 'Forestry Manager', 'icon' => 'fa-tree', 'img' => 'https://images.unsplash.com/photo-1448375240586-882707db888b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Stable'],

            // Supply Chain & Economics
            ['name' => 'Agricultural Economist', 'icon' => 'fa-chart-line', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹25L', 'demand' => 'High'],
            ['name' => 'Agri Supply Chain Manager', 'icon' => 'fa-truck-fast', 'img' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹20L', 'demand' => 'Very High'],
            ['name' => 'Commodity Trader', 'icon' => 'fa-money-bill-trend-up', 'img' => 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹30L', 'demand' => 'High'],
            ['name' => 'Agricultural Inspector', 'icon' => 'fa-clipboard-check', 'img' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'demand' => 'Stable'],
            ['name' => 'Agri-Marketing Manager', 'icon' => 'fa-bullhorn', 'img' => 'https://images.unsplash.com/photo-1551434678-e076c223a692?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹22L', 'demand' => 'High'],

            // Research & Education
            ['name' => 'Agricultural Extension Officer', 'icon' => 'fa-users', 'img' => 'https://images.unsplash.com/photo-1573164713988-8665fc963095?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹12L', 'demand' => 'Stable'],
            ['name' => 'Crop Consultant', 'icon' => 'fa-user-tie', 'img' => 'https://images.unsplash.com/photo-1556761175-4b46a572b786?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'Growing'],
            ['name' => 'Agricultural Researcher', 'icon' => 'fa-microscope', 'img' => 'https://images.unsplash.com/photo-1581093588401-fbb62a02f120?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹20L', 'demand' => 'Stable'],
            ['name' => 'Agricultural Professor', 'icon' => 'fa-chalkboard-user', 'img' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹25L', 'demand' => 'Stable'],
            ['name' => 'Rural Development Officer', 'icon' => 'fa-house-chimney-window', 'img' => 'https://images.unsplash.com/photo-1449844908441-8829872d2607?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Stable'],

            // Food Tech & Quality
            ['name' => 'Food Technologist', 'icon' => 'fa-burger', 'img' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'High'],
            ['name' => 'Quality Assurance Manager (Food)', 'icon' => 'fa-check-double', 'img' => 'https://images.unsplash.com/photo-1581094794329-c8112a89af12?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹20L', 'demand' => 'High'],
            ['name' => 'Post-Harvest Technologist', 'icon' => 'fa-box', 'img' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Growing'],
            ['name' => 'Flavor Chemist', 'icon' => 'fa-vial', 'img' => 'https://images.unsplash.com/photo-1579154204601-01588f351e67?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹22L', 'demand' => 'Growing'],
            ['name' => 'Beverage Technologist', 'icon' => 'fa-wine-glass', 'img' => 'https://images.unsplash.com/photo-1551024709-8f23befc6f87?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'Growing'],

            // Conservation & Environment
            ['name' => 'Conservation Scientist', 'icon' => 'fa-earth-americas', 'img' => 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'Growing'],
            ['name' => 'Environmental Consultant', 'icon' => 'fa-leaf', 'img' => 'https://images.unsplash.com/photo-1497436072909-60f360e1d4b1?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹20L', 'demand' => 'High'],
            ['name' => 'Hydrologist', 'icon' => 'fa-water', 'img' => 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹22L', 'demand' => 'Stable'],
            ['name' => 'Wildlife Biologist', 'icon' => 'fa-paw', 'img' => 'https://images.unsplash.com/photo-1456926631375-92c8ce872def?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Stable'],
            ['name' => 'Climate Change Analyst', 'icon' => 'fa-cloud-sun-rain', 'img' => 'https://images.unsplash.com/photo-1561484930-998b6a7b22e8?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹25L', 'demand' => 'High'],

            // Specialized
            ['name' => 'Entomologist', 'icon' => 'fa-bug', 'img' => 'https://images.unsplash.com/photo-1628102491629-778571d893a3?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'Stable'],
            ['name' => 'Nematologist', 'icon' => 'fa-worm', 'img' => 'https://images.unsplash.com/photo-1581093588401-fbb62a02f120?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Stable'],
            ['name' => 'Agri-Fintech Specialist', 'icon' => 'fa-mobile-screen', 'img' => 'https://images.unsplash.com/photo-1551288049-bbda38a594a0?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹25L', 'demand' => 'Very High'],
            ['name' => 'Agri-Journalist', 'icon' => 'fa-newspaper', 'img' => 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'demand' => 'Growing'],
            ['name' => 'Agri-Tourism Manager', 'icon' => 'fa-map-location-dot', 'img' => 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Growing'],
        ];

        foreach ($careers as $c) {
            Career::updateOrCreate(
                ['slug' => Str::slug($c['name'])],
                [
                    'name'           => $c['name'],
                    'field_id'       => $field->id,
                    'description'    => $c['name'] . ' is a crucial career in the agriculture and allied sciences sector, focusing on improving food security, sustainable practices, and agribusiness.',
                    'qualification'  => 'B.Sc/M.Sc in Agriculture or related field',
                    'stream'         => 'Science (PCB/PCM) / Agriculture',
                    'salary_range'   => $c['salary'],
                    'demand_level'   => $c['demand'],
                    'icon'           => $c['icon'],
                    'image'          => $c['img'],
                    'roadmap'        => [
                        'Complete 12th with Science or Agriculture',
                        'Clear ICAR AIEEA or State Agri entrance exams',
                        'Pursue B.Sc in Agriculture / Tech degree',
                        'Complete internships and field work',
                        'Pursue Master\'s for specialization (optional)',
                        'Join Agri-corporates, Research, or Gov sector',
                        'Advance to management or start an agribusiness',
                    ],
                    'skills'         => ['Analytical Thinking', 'Field Knowledge', 'Problem Solving', 'Tech Savviness', 'Project Management'],
                    'future_scope'   => 'With the rise of Agritech, precision farming, and sustainable food production, the agriculture sector is transforming. Demand for educated professionals is at an all-time high globally.',
                    'entrance_exams' => ['ICAR AIEEA', 'State Agriculture Exams', 'GATE (Agri Engg)', 'CAT (for Agribusiness)'],
                    'job_opportunities' => ['Govt Agri Departments', 'FMCG Companies', 'Agritech Startups', 'Research Institutes', 'Banks (Agri Officers)'],
                    'related_careers' => ['Agronomist', 'Agricultural Engineer', 'Agribusiness Manager'],
                ]
            );
        }
    }
}
