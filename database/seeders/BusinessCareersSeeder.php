<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BusinessCareersSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'business')->first();
        if (!$field) return;

        $careers = [
            ['name' => 'Business Manager', 'icon' => 'fa-briefcase', 'img' => 'https://images.unsplash.com/photo-1497366216548-37526070297c'],
            ['name' => 'Marketing Manager', 'icon' => 'fa-bullhorn', 'img' => 'https://images.unsplash.com/photo-1551434678-e076c223a692'],
            ['name' => 'Human Resource Manager', 'icon' => 'fa-users-gear', 'img' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d'],
            ['name' => 'Financial Analyst', 'icon' => 'fa-chart-line', 'img' => 'https://images.unsplash.com/photo-1543286386-713bdd548da4'],
            ['name' => 'Investment Banker', 'icon' => 'fa-building-columns', 'img' => 'https://images.unsplash.com/photo-1454165833767-027ff33026b6'],
            ['name' => 'Chartered Accountant (CA)', 'icon' => 'fa-calculator', 'img' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c'],
            ['name' => 'Company Secretary (CS)', 'icon' => 'fa-file-signature', 'img' => 'https://images.unsplash.com/photo-1507679799987-c73774586594'],
            ['name' => 'Entrepreneur', 'icon' => 'fa-rocket', 'img' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c'],
            ['name' => 'Operations Manager', 'icon' => 'fa-gears', 'img' => 'https://images.unsplash.com/photo-1553877522-43269d4ea984'],
            ['name' => 'Supply Chain Manager', 'icon' => 'fa-truck-fast', 'img' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d'],
            ['name' => 'Digital Marketing Specialist', 'icon' => 'fa-hashtag', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f'],
            ['name' => 'Sales Manager', 'icon' => 'fa-handshake', 'img' => 'https://images.unsplash.com/photo-1552664730-d307ca884978'],
            ['name' => 'International Business Consultant', 'icon' => 'fa-earth-americas', 'img' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f'],
            ['name' => 'Business Data Analyst', 'icon' => 'fa-magnifying-glass-chart', 'img' => 'https://images.unsplash.com/photo-1551288049-bbda38a594a0'],
            ['name' => 'Retail Store Manager', 'icon' => 'fa-shop', 'img' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8'],
            ['name' => 'Brand Manager', 'icon' => 'fa-tag', 'img' => 'https://images.unsplash.com/photo-1557804506-669a67965ba0'],
            ['name' => 'Product Manager', 'icon' => 'fa-box-open', 'img' => 'https://images.unsplash.com/photo-1522204523234-8729aa6e3d5f'],
            ['name' => 'Banking Officer', 'icon' => 'fa-building-columns', 'img' => 'https://images.unsplash.com/photo-1501167786227-4cba60f6d58f'],
            ['name' => 'Insurance Advisor', 'icon' => 'fa-shield-halved', 'img' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85'],
            ['name' => 'Tax Consultant', 'icon' => 'fa-receipt', 'img' => 'https://images.unsplash.com/photo-1586486855514-8c633cc6fd38'],
            ['name' => 'Audit Manager', 'icon' => 'fa-magnifying-glass-dollar', 'img' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85'],
            ['name' => 'E-commerce Manager', 'icon' => 'fa-cart-shopping', 'img' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3'],
            ['name' => 'Startup Founder', 'icon' => 'fa-lightbulb', 'img' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f'],
            ['name' => 'Business Consultant', 'icon' => 'fa-comments-dollar', 'img' => 'https://images.unsplash.com/photo-1552664730-d307ca884978'],
            ['name' => 'Market Research Analyst', 'icon' => 'fa-magnifying-glass-chart', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f'],
            ['name' => 'Customer Relationship Manager', 'icon' => 'fa-headset', 'img' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c'],
            ['name' => 'Event Manager', 'icon' => 'fa-calendar-check', 'img' => 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622'],
            ['name' => 'Hotel Operations Manager', 'icon' => 'fa-hotel', 'img' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945'],
            ['name' => 'Logistics Manager', 'icon' => 'fa-warehouse', 'img' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d'],
            ['name' => 'Corporate Lawyer', 'icon' => 'fa-gavel', 'img' => 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f'],
            ['name' => 'Risk Manager', 'icon' => 'fa-triangle-exclamation', 'img' => 'https://images.unsplash.com/photo-1454165833767-027ff33026b6'],
            ['name' => 'Wealth Manager', 'icon' => 'fa-vault', 'img' => 'https://images.unsplash.com/photo-1579621970563-ebec7560ff3e'],
            ['name' => 'Export-Import Manager', 'icon' => 'fa-ship', 'img' => 'https://images.unsplash.com/photo-1494412552103-41028abc387f'],
            ['name' => 'Franchise Manager', 'icon' => 'fa-store', 'img' => 'https://images.unsplash.com/photo-1556740734-7f95826913b8'],
            ['name' => 'Advertising Manager', 'icon' => 'fa-rectangle-ad', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f'],
            ['name' => 'Payroll Specialist', 'icon' => 'fa-money-check-dollar', 'img' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c'],
            ['name' => 'Procurement Manager', 'icon' => 'fa-cart-flatbed', 'img' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d'],
            ['name' => 'Management Consultant', 'icon' => 'fa-user-tie', 'img' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f'],
            ['name' => 'BPO Manager', 'icon' => 'fa-phone-volume', 'img' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c'],
            ['name' => 'Financial Planner', 'icon' => 'fa-calendar-day', 'img' => 'https://images.unsplash.com/photo-1543286386-713bdd548da4'],
            ['name' => 'Venture Capital Analyst', 'icon' => 'fa-seedling', 'img' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c'],
            ['name' => 'Equity Research Analyst', 'icon' => 'fa-magnifying-glass-chart', 'img' => 'https://images.unsplash.com/photo-1551288049-bbda38a594a0'],
            ['name' => 'Digital Business Strategist', 'icon' => 'fa-laptop-code', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f'],
            ['name' => 'Business Intelligence Analyst', 'icon' => 'fa-brain-circuit', 'img' => 'https://images.unsplash.com/photo-1551288049-bbda38a594a0'],
            ['name' => 'Public Relations Manager', 'icon' => 'fa-microphone', 'img' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d'],
            ['name' => 'Project Manager', 'icon' => 'fa-list-check', 'img' => 'https://images.unsplash.com/photo-1531403009284-440f080d1e12'],
            ['name' => 'Asset Manager', 'icon' => 'fa-coins', 'img' => 'https://images.unsplash.com/photo-1579621970563-ebec7560ff3e'],
            ['name' => 'Credit Manager', 'icon' => 'fa-credit-card', 'img' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c'],
            ['name' => 'Sustainability Manager', 'icon' => 'fa-leaf', 'img' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09'],
            ['name' => 'Media Planner', 'icon' => 'fa-clapperboard', 'img' => 'https://images.unsplash.com/photo-1492724441997-5dc865305da7']
        ];

        foreach ($careers as $c) {
            Career::updateOrCreate(
                ['slug' => Str::slug($c['name'])],
                [
                    'name' => $c['name'],
                    'field_id' => $field->id,
                    'description' => "Professional career in " . $c['name'] . " focused on strategic growth and leadership within the business landscape.",
                    'qualification' => 'MBA / BBA / PGDM',
                    'stream' => 'Commerce / Any',
                    'salary_range' => '₹5L – ₹45L per annum',
                    'demand_level' => 'High',
                    'icon' => $c['icon'],
                    'image' => $c['img'] . '?auto=format&fit=crop&w=800&q=80',
                    'roadmap' => [
                        'Complete Graduation in any stream',
                        'Clear MBA Entrance Exams (CAT/MAT/XAT)',
                        'Pursue MBA/PGDM from a reputed institute',
                        'Specialise in relevant field',
                        'Gain industrial experience through internships',
                        'Join as Management Trainee or Associate'
                    ],
                    'skills' => ['Leadership', 'Strategic Thinking', 'Communication', 'Analytical Skills', 'Project Management'],
                    'future_scope' => 'The demand for skilled management professionals is growing rapidly as companies expand globally and focus on data-driven decision making.',
                    'entrance_exams' => ['CAT', 'XAT', 'GMAT', 'SNAP', 'MAT'],
                    'job_opportunities' => ['Top MNCs', 'Startups', 'Consulting Firms', 'Financial Institutions', 'Government Sectors'],
                    'related_careers' => ['Business Analyst', 'Operations Lead', 'Strategic Consultant']
                ]
            );
        }
    }
}
