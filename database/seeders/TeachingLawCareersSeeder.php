<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TeachingLawCareersSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'teaching-law')->first();
        if (!$field) return;

        $careers = [
            // Law & Judiciary
            ['name' => 'Corporate Lawyer', 'icon' => 'fa-scale-balanced', 'img' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹35L', 'demand' => 'Very High'],
            ['name' => 'Civil Litigation Lawyer', 'icon' => 'fa-gavel', 'img' => 'https://images.unsplash.com/photo-1505664173615-61732552f4a3?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹25L', 'demand' => 'Stable'],
            ['name' => 'Criminal Lawyer', 'icon' => 'fa-handcuffs', 'img' => 'https://images.unsplash.com/photo-1589391886645-d51941baf7fb?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹30L', 'demand' => 'High'],
            ['name' => 'Judge / Judicial Magistrate', 'icon' => 'fa-scale-unbalanced', 'img' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=800&q=80', 'salary' => '₹12L – ₹25L', 'demand' => 'High'],
            ['name' => 'Cyber Law Expert', 'icon' => 'fa-laptop-code', 'img' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹40L', 'demand' => 'Very High'],

            // Specialized Law
            ['name' => 'Intellectual Property Lawyer', 'icon' => 'fa-copyright', 'img' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹30L', 'demand' => 'High'],
            ['name' => 'Environmental Lawyer', 'icon' => 'fa-leaf', 'img' => 'https://images.unsplash.com/photo-1497436072909-60f360e1d4b1?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹20L', 'demand' => 'Growing'],
            ['name' => 'Family Lawyer', 'icon' => 'fa-people-roof', 'img' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Stable'],
            ['name' => 'Tax Lawyer', 'icon' => 'fa-file-invoice-dollar', 'img' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹25L', 'demand' => 'High'],
            ['name' => 'Human Rights Lawyer', 'icon' => 'fa-hand-holding-heart', 'img' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'demand' => 'Stable'],

            // Legal Consulting & Misc
            ['name' => 'Legal Advisor / Consultant', 'icon' => 'fa-briefcase', 'img' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹25L', 'demand' => 'High'],
            ['name' => 'Legal Analyst', 'icon' => 'fa-chart-pie', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'High'],
            ['name' => 'Paralegal', 'icon' => 'fa-file-signature', 'img' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹10L', 'demand' => 'Growing'],
            ['name' => 'Arbitrator / Mediator', 'icon' => 'fa-handshake-angle', 'img' => 'https://images.unsplash.com/photo-1556761175-4b46a572b786?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹20L', 'demand' => 'Growing'],
            ['name' => 'Notary Public', 'icon' => 'fa-stamp', 'img' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'demand' => 'Stable'],

            // Core Teaching (Schools)
            ['name' => 'Pre-Primary Teacher', 'icon' => 'fa-child-reaching', 'img' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹6L', 'demand' => 'High'],
            ['name' => 'Primary School Teacher', 'icon' => 'fa-school', 'img' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹8L', 'demand' => 'Very High'],
            ['name' => 'TGT (Trained Graduate Teacher)', 'icon' => 'fa-chalkboard-user', 'img' => 'https://images.unsplash.com/photo-1577896851231-70ef18881754?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹10L', 'demand' => 'High'],
            ['name' => 'PGT (Post Graduate Teacher)', 'icon' => 'fa-book-open-reader', 'img' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹12L', 'demand' => 'High'],
            ['name' => 'Special Educator', 'icon' => 'fa-hands-holding-child', 'img' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹12L', 'demand' => 'Growing'],

            // Higher Education & Coaching
            ['name' => 'College Professor', 'icon' => 'fa-graduation-cap', 'img' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹25L', 'demand' => 'High'],
            ['name' => 'University Dean', 'icon' => 'fa-building-columns', 'img' => 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹12L – ₹35L', 'demand' => 'Stable'],
            ['name' => 'Subject Matter Expert (EdTech)', 'icon' => 'fa-laptop-file', 'img' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹18L', 'demand' => 'Very High'],
            ['name' => 'Competitive Exam Coach', 'icon' => 'fa-user-tie', 'img' => 'https://images.unsplash.com/photo-1515169067868-5387ec356754?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹30L+', 'demand' => 'High'],
            ['name' => 'Corporate Trainer', 'icon' => 'fa-users', 'img' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹25L', 'demand' => 'High'],

            // Education Administration
            ['name' => 'School Principal', 'icon' => 'fa-user-graduate', 'img' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹25L', 'demand' => 'Stable'],
            ['name' => 'Education Administrator', 'icon' => 'fa-sitemap', 'img' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹20L', 'demand' => 'Stable'],
            ['name' => 'Curriculum Developer', 'icon' => 'fa-pen-nib', 'img' => 'https://images.unsplash.com/photo-1455390582262-044cdead2708?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹18L', 'demand' => 'Growing'],
            ['name' => 'Educational Counselor', 'icon' => 'fa-compass', 'img' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'demand' => 'Growing'],
            ['name' => 'Instructional Designer', 'icon' => 'fa-swatchbook', 'img' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹20L', 'demand' => 'High'],

            // Specialized Teaching
            ['name' => 'Online Tutor', 'icon' => 'fa-laptop', 'img' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'demand' => 'Very High'],
            ['name' => 'Physical Education Teacher', 'icon' => 'fa-basketball', 'img' => 'https://images.unsplash.com/photo-1526676037777-05a232554f77?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹10L', 'demand' => 'Stable'],
            ['name' => 'Art & Craft Teacher', 'icon' => 'fa-palette', 'img' => 'https://images.unsplash.com/photo-1460661419201-fd4cecdf8a8b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2.5L – ₹8L', 'demand' => 'Stable'],
            ['name' => 'Music Teacher', 'icon' => 'fa-music', 'img' => 'https://images.unsplash.com/photo-1511379938547-c1f69419868d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹10L', 'demand' => 'Stable'],
            ['name' => 'Language Instructor', 'icon' => 'fa-language', 'img' => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'High'],

            // Researchers & Evaluators
            ['name' => 'Educational Researcher', 'icon' => 'fa-microscope', 'img' => 'https://images.unsplash.com/photo-1532094349884-543559c6571f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹18L', 'demand' => 'Stable'],
            ['name' => 'Assessment Specialist', 'icon' => 'fa-list-check', 'img' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Growing'],
            ['name' => 'Law Professor', 'icon' => 'fa-gavel', 'img' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹25L', 'demand' => 'High'],
            ['name' => 'Legal Researcher', 'icon' => 'fa-book-open', 'img' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Growing'],
            ['name' => 'E-Learning Director', 'icon' => 'fa-display', 'img' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹30L', 'demand' => 'Very High'],
        ];

        foreach ($careers as $c) {
            Career::updateOrCreate(
                ['slug' => Str::slug($c['name'])],
                [
                    'name'           => $c['name'],
                    'field_id'       => $field->id,
                    'description'    => $c['name'] . ' is a highly respected career that focuses on shaping minds or upholding justice and societal order.',
                    'qualification'  => str_contains(strtolower($c['name']), 'law') ? 'LLB / LLM' : 'B.Ed / M.Ed / PhD / Master\'s',
                    'stream'         => 'Arts / Humanities / Any Stream',
                    'salary_range'   => $c['salary'],
                    'demand_level'   => $c['demand'],
                    'icon'           => $c['icon'],
                    'image'          => $c['img'],
                    'roadmap'        => [
                        'Complete 12th standard in any stream',
                        'Clear entrance exams (CLAT for Law, CTET for Teaching)',
                        'Complete LLB (for Law) or B.Ed/Degree (for Teaching)',
                        'Clear state bar council exams / NET exams',
                        'Gain practical experience (moot courts, internships, student teaching)',
                        'Apply for roles in firms, schools, or government',
                    ],
                    'skills'         => ['Communication', 'Patience', 'Analytical Thinking', 'Public Speaking', 'Empathy'],
                    'future_scope'   => 'Both Law and Education are evergreen fields. EdTech and Corporate Law have seen massive spikes in demand over recent years.',
                    'entrance_exams' => ['CLAT', 'AILET', 'LSAT', 'CTET', 'UGC NET', 'State TET'],
                    'job_opportunities' => ['Law Firms', 'Corporate Legal Teams', 'EdTech Companies', 'Schools & Universities', 'Govt Roles'],
                    'related_careers' => ['Consultant', 'Social Worker', 'Administrator'],
                ]
            );
        }
    }
}
