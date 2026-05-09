<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CommerceSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'commerce')->first();
        if (!$field) return;

        $careers = [
            // Core Finance & Accounting
            ['name' => 'Chartered Accountant (CA)', 'icon' => 'fa-calculator', 'img' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹30L+', 'demand' => 'Very High'],
            ['name' => 'Company Secretary (CS)', 'icon' => 'fa-file-signature', 'img' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹20L', 'demand' => 'High'],
            ['name' => 'Cost and Management Accountant (CMA)', 'icon' => 'fa-chart-pie', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹18L', 'demand' => 'High'],
            ['name' => 'Certified Public Accountant (CPA)', 'icon' => 'fa-globe', 'img' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹10L – ₹40L', 'demand' => 'High'],
            ['name' => 'Financial Analyst', 'icon' => 'fa-chart-line', 'img' => 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹20L', 'demand' => 'Very High'],
            ['name' => 'Investment Banker', 'icon' => 'fa-sack-dollar', 'img' => 'https://images.unsplash.com/photo-1551288049-bbda38a594a0?auto=format&fit=crop&w=800&q=80', 'salary' => '₹12L – ₹50L+', 'demand' => 'High'],
            ['name' => 'Actuary', 'icon' => 'fa-chart-area', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹10L – ₹30L', 'demand' => 'Growing'],
            ['name' => 'Wealth Manager', 'icon' => 'fa-gem', 'img' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹25L', 'demand' => 'High'],
            ['name' => 'Risk Manager', 'icon' => 'fa-shield-halved', 'img' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹25L', 'demand' => 'High'],
            ['name' => 'Tax Consultant', 'icon' => 'fa-receipt', 'img' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹20L', 'demand' => 'Stable'],
            
            // Banking & Insurance
            ['name' => 'Bank Probationary Officer (PO)', 'icon' => 'fa-building-columns', 'img' => 'https://images.unsplash.com/photo-1501167733022-261541e24bc1?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹12L', 'demand' => 'Very High'],
            ['name' => 'Loan Officer', 'icon' => 'fa-money-check-dollar', 'img' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹10L', 'demand' => 'Stable'],
            ['name' => 'Insurance Underwriter', 'icon' => 'fa-umbrella', 'img' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹12L', 'demand' => 'Stable'],
            ['name' => 'Stockbroker', 'icon' => 'fa-arrow-trend-up', 'img' => 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹20L+', 'demand' => 'High'],
            ['name' => 'Credit Analyst', 'icon' => 'fa-magnifying-glass-chart', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹15L', 'demand' => 'High'],
            
            // Business & Management
            ['name' => 'Business Analyst', 'icon' => 'fa-chart-simple', 'img' => 'https://images.unsplash.com/photo-1551288049-bbda38a594a0?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹18L', 'demand' => 'Very High'],
            ['name' => 'Human Resources (HR) Manager', 'icon' => 'fa-users', 'img' => 'https://images.unsplash.com/photo-1556761175-4b46a572b786?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹18L', 'demand' => 'High'],
            ['name' => 'Marketing Manager', 'icon' => 'fa-bullhorn', 'img' => 'https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹25L', 'demand' => 'High'],
            ['name' => 'Supply Chain Manager', 'icon' => 'fa-truck-fast', 'img' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹20L', 'demand' => 'Growing'],
            ['name' => 'Operations Manager', 'icon' => 'fa-gears', 'img' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹22L', 'demand' => 'Stable'],
            
            // Specialized Commerce
            ['name' => 'Economist', 'icon' => 'fa-scale-balanced', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹20L', 'demand' => 'High'],
            ['name' => 'Forensic Accountant', 'icon' => 'fa-user-secret', 'img' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹25L', 'demand' => 'Growing'],
            ['name' => 'Auditor', 'icon' => 'fa-clipboard-check', 'img' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹18L', 'demand' => 'High'],
            ['name' => 'Retail Manager', 'icon' => 'fa-store', 'img' => 'https://images.unsplash.com/photo-1567401893414-76b7b1e5a7a5?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹12L', 'demand' => 'Stable'],
            ['name' => 'E-commerce Manager', 'icon' => 'fa-cart-shopping', 'img' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹20L', 'demand' => 'Growing'],
            ['name' => 'International Business Expert', 'icon' => 'fa-earth-asia', 'img' => 'https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹25L', 'demand' => 'High'],
            ['name' => 'Corporate Lawyer', 'icon' => 'fa-gavel', 'img' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹30L', 'demand' => 'High'],
            ['name' => 'Event Manager (Corporate)', 'icon' => 'fa-calendar-days', 'img' => 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Stable'],
            ['name' => 'Real Estate Appraiser/Broker', 'icon' => 'fa-house-building', 'img' => 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Stable'],
            ['name' => 'Logistics Manager', 'icon' => 'fa-ship', 'img' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹15L', 'demand' => 'Growing'],
        ];

        foreach ($careers as $c) {
            Career::updateOrCreate(
                ['slug' => Str::slug($c['name'])],
                [
                    'name'           => $c['name'],
                    'field_id'       => $field->id,
                    'description'    => $c['name'] . ' is a crucial role in the global economy involving finance, management, and strategic operations.',
                    'qualification'  => 'B.Com / BBA / CA / MBA',
                    'stream'         => 'Commerce',
                    'salary_range'   => $c['salary'],
                    'demand_level'   => $c['demand'],
                    'icon'           => $c['icon'],
                    'image'          => $c['img'],
                    'roadmap'        => [
                        'Complete 10+2 in Commerce (with or without Math)',
                        'Pursue a relevant Bachelor’s degree like B.Com, BBA, or BMS',
                        'Clear professional exams (CA/CS/CMA) if targeting core finance',
                        'Gain practical experience through articleships or corporate internships',
                        'Pursue an MBA or PGDM from a top-tier institute for management roles',
                        'Stay updated with global economic trends and financial laws'
                    ],
                    'skills'         => ['Number Crunching', 'Analytical Thinking', 'Problem Solving', 'Communication', 'Business Acumen'],
                    'future_scope'   => 'Finance and business are the backbones of any industry. A career in commerce offers stability, high earnings, and global mobility.',
                    'entrance_exams' => ['CA Foundation', 'CAT/MAT (for MBA)', 'CUET UG'],
                    'job_opportunities' => ['MNCs', 'Big 4 Accounting Firms', 'Banks', 'Startups', 'Self-Employed Consultancies'],
                    'related_careers' => ['Entrepreneur', 'Management Consultant', 'Auditor'],
                ]
            );
        }
    }
}
