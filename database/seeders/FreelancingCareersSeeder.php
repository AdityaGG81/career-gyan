<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FreelancingCareersSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'freelancing')->first();
        if (!$field) return;

        $careers = [
            // Tech & Web
            ['name' => 'Freelance Web Developer', 'icon' => 'fa-laptop-code', 'img' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Very High'],
            ['name' => 'Freelance UI/UX Designer', 'icon' => 'fa-pen-nib', 'img' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'High'],
            ['name' => 'Freelance Software Tester', 'icon' => 'fa-bug', 'img' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Growing'],
            ['name' => 'No-Code Developer', 'icon' => 'fa-wand-magic-sparkles', 'img' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Very High'],
            ['name' => 'WordPress Expert', 'icon' => 'fa-wordpress', 'img' => 'https://images.unsplash.com/photo-1616469829581-73993eb86b02?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'High'],

            // Writing & Content
            ['name' => 'Freelance Copywriter', 'icon' => 'fa-pen-to-square', 'img' => 'https://images.unsplash.com/photo-1455390582262-044cdead2708?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'High'],
            ['name' => 'Freelance Ghostwriter', 'icon' => 'fa-ghost', 'img' => 'https://images.unsplash.com/photo-1455390582262-044cdead2708?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Growing'],
            ['name' => 'Freelance Technical Writer', 'icon' => 'fa-file-lines', 'img' => 'https://images.unsplash.com/photo-1455390582262-044cdead2708?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'High'],
            ['name' => 'Freelance Editor & Proofreader', 'icon' => 'fa-spell-check', 'img' => 'https://images.unsplash.com/photo-1455390582262-044cdead2708?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Stable'],
            ['name' => 'Freelance Translator', 'icon' => 'fa-language', 'img' => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Growing'],

            // Digital Marketing
            ['name' => 'Freelance SEO Consultant', 'icon' => 'fa-magnifying-glass-chart', 'img' => 'https://images.unsplash.com/photo-1432888622747-4eb9a8efeb07?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Very High'],
            ['name' => 'Freelance Social Media Manager', 'icon' => 'fa-hashtag', 'img' => 'https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'High'],
            ['name' => 'Facebook/Google Ads Specialist', 'icon' => 'fa-rectangle-ad', 'img' => 'https://images.unsplash.com/photo-1551288049-bbda38a594a0?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Very High'],
            ['name' => 'Email Marketing Freelancer', 'icon' => 'fa-envelope-open-text', 'img' => 'https://images.unsplash.com/photo-1596526131083-e8c638c9c6c3?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Growing'],
            ['name' => 'Funnel Builder', 'icon' => 'fa-filter', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'High'],

            // Design & Video
            ['name' => 'Freelance Graphic Designer', 'icon' => 'fa-bezier-curve', 'img' => 'https://images.unsplash.com/photo-1626785774573-4b799315345d?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'High'],
            ['name' => 'Freelance Video Editor', 'icon' => 'fa-film', 'img' => 'https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Very High'],
            ['name' => 'Freelance Animator (Motion Graphics)', 'icon' => 'fa-person-running', 'img' => 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Growing'],
            ['name' => 'Freelance Presentation Designer', 'icon' => 'fa-person-chalkboard', 'img' => 'https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Stable'],
            ['name' => 'Freelance 3D Modeler', 'icon' => 'fa-cube', 'img' => 'https://images.unsplash.com/photo-1626785774573-4b799315345d?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Stable'],

            // Business & Admin Support
            ['name' => 'Virtual Assistant (VA)', 'icon' => 'fa-headset', 'img' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Very High'],
            ['name' => 'Freelance Data Entry Expert', 'icon' => 'fa-keyboard', 'img' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Stable'],
            ['name' => 'Freelance Bookkeeper / Accountant', 'icon' => 'fa-calculator', 'img' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'High'],
            ['name' => 'Freelance Project Manager', 'icon' => 'fa-list-check', 'img' => 'https://images.unsplash.com/photo-1531403009284-440f080d1e12?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Growing'],
            ['name' => 'Customer Success Freelancer', 'icon' => 'fa-phone-volume', 'img' => 'https://images.unsplash.com/photo-1551434678-e076c223a692?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Stable'],

            // Consulting & Niche
            ['name' => 'Freelance Business Consultant', 'icon' => 'fa-briefcase', 'img' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Growing'],
            ['name' => 'Freelance Legal Advisor', 'icon' => 'fa-scale-balanced', 'img' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Stable'],
            ['name' => 'Freelance Financial Modeler', 'icon' => 'fa-chart-pie', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'High'],
            ['name' => 'Freelance HR/Recruiter', 'icon' => 'fa-user-tie', 'img' => 'https://images.unsplash.com/photo-1556761175-4b46a572b786?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Growing'],
            ['name' => 'Freelance App Developer', 'icon' => 'fa-mobile-screen', 'img' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Very High'],

            // Coaching & Teaching
            ['name' => 'Online Tutor (Freelance)', 'icon' => 'fa-laptop-file', 'img' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'High'],
            ['name' => 'Freelance English / IELTS Coach', 'icon' => 'fa-language', 'img' => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Stable'],
            ['name' => 'Freelance Fitness/Yoga Coach', 'icon' => 'fa-dumbbell', 'img' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Stable'],
            ['name' => 'Freelance Life/Career Coach', 'icon' => 'fa-compass', 'img' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Growing'],
            ['name' => 'Freelance Music/Art Teacher', 'icon' => 'fa-music', 'img' => 'https://images.unsplash.com/photo-1511379938547-c1f69419868d?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Stable'],

            // Audio & Media
            ['name' => 'Freelance Voiceover Artist', 'icon' => 'fa-microphone', 'img' => 'https://images.unsplash.com/photo-1590602847861-f357a9332bbc?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'High'],
            ['name' => 'Freelance Podcaster/Editor', 'icon' => 'fa-headphones', 'img' => 'https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Growing'],
            ['name' => 'Freelance Transcriptionist', 'icon' => 'fa-keyboard', 'img' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Stable'],
            ['name' => 'Freelance Stock Photographer', 'icon' => 'fa-camera', 'img' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Stable'],
            ['name' => 'Freelance Music Producer / Beatmaker', 'icon' => 'fa-compact-disc', 'img' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Growing'],

            // Specialized Data & IT
            ['name' => 'Freelance Data Analyst', 'icon' => 'fa-chart-simple', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'High'],
            ['name' => 'Freelance Data Scientist', 'icon' => 'fa-brain', 'img' => 'https://images.unsplash.com/photo-1551288049-bbda38a594a0?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'High'],
            ['name' => 'Freelance Cybersecurity Expert', 'icon' => 'fa-shield-halved', 'img' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Growing'],
            ['name' => 'Freelance DevOps Engineer', 'icon' => 'fa-infinity', 'img' => 'https://images.unsplash.com/photo-1618401471353-b98afee0b2eb?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Growing'],
            ['name' => 'Freelance Cloud Solutions Architect', 'icon' => 'fa-cloud', 'img' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'High'],
        ];

        foreach ($careers as $c) {
            Career::updateOrCreate(
                ['slug' => Str::slug($c['name'])],
                [
                    'name'           => $c['name'],
                    'field_id'       => $field->id,
                    'description'    => $c['name'] . ' is a flexible, remote career path where you offer your specialized skills to clients globally on a contract basis.',
                    'qualification'  => 'Varies (Skills & Portfolio are far more important than degrees)',
                    'stream'         => 'Any Stream',
                    'salary_range'   => $c['salary'],
                    'demand_level'   => $c['demand'],
                    'icon'           => $c['icon'],
                    'image'          => $c['img'],
                    'roadmap'        => [
                        'Master a specific high-demand skill (e.g., coding, writing, design)',
                        'Build a strong portfolio of sample work or personal projects',
                        'Set up profiles on platforms like Upwork, Fiverr, or LinkedIn',
                        'Learn cold emailing and client acquisition strategies',
                        'Deliver high-quality work to get reviews and referrals',
                        'Scale by increasing rates, offering retainers, or building an agency',
                    ],
                    'skills'         => ['Core Skill (Design/Dev/Writing)', 'Time Management', 'Communication', 'Sales & Negotiation', 'Self-Discipline'],
                    'future_scope'   => 'The freelance economy is booming globally. Companies prefer hiring remote freelancers for specialized tasks rather than full-time employees.',
                    'entrance_exams' => ['None (Certifications in your niche can help)'],
                    'job_opportunities' => ['Global Clients', 'Startups', 'Agencies', 'Self-Employed'],
                    'related_careers' => ['Agency Owner', 'Consultant', 'Digital Nomad'],
                ]
            );
        }
    }
}
