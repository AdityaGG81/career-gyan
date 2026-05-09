<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SocialMediaCareersSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'social-media')->first();
        if (!$field) return;

        $careers = [
            // Influencers & Content Creators
            ['name' => 'YouTuber / Vlogger', 'icon' => 'fa-youtube', 'img' => 'https://images.unsplash.com/photo-1516259762381-22954d7d3ad2?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies widely', 'demand' => 'Very High'],
            ['name' => 'Instagram/TikTok Influencer', 'icon' => 'fa-instagram', 'img' => 'https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies widely', 'demand' => 'Very High'],
            ['name' => 'Podcaster', 'icon' => 'fa-microphone-lines', 'img' => 'https://images.unsplash.com/photo-1590602847861-f357a9332bbc?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies widely', 'demand' => 'Growing'],
            ['name' => 'Travel Blogger', 'icon' => 'fa-plane', 'img' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'High'],
            ['name' => 'Food Blogger', 'icon' => 'fa-burger', 'img' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'High'],

            // Digital Marketing
            ['name' => 'Social Media Manager', 'icon' => 'fa-hashtag', 'img' => 'https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'Very High'],
            ['name' => 'Digital Marketing Strategist', 'icon' => 'fa-bullseye', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹30L', 'demand' => 'Very High'],
            ['name' => 'SEO Specialist', 'icon' => 'fa-magnifying-glass-chart', 'img' => 'https://images.unsplash.com/photo-1432888622747-4eb9a8efeb07?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'High'],
            ['name' => 'PPC / Performance Marketer', 'icon' => 'fa-hand-pointer', 'img' => 'https://images.unsplash.com/photo-1551288049-bbda38a594a0?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹25L', 'demand' => 'Very High'],
            ['name' => 'Email Marketing Specialist', 'icon' => 'fa-envelope-open-text', 'img' => 'https://images.unsplash.com/photo-1596526131083-e8c638c9c6c3?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Stable'],

            // Strategy & Brand Management
            ['name' => 'Brand Manager', 'icon' => 'fa-certificate', 'img' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹40L', 'demand' => 'High'],
            ['name' => 'Community Manager', 'icon' => 'fa-users-viewfinder', 'img' => 'https://images.unsplash.com/photo-1515169067868-5387ec356754?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'Growing'],
            ['name' => 'Public Relations (PR) Specialist', 'icon' => 'fa-bullhorn', 'img' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹20L', 'demand' => 'High'],
            ['name' => 'Influencer Marketing Manager', 'icon' => 'fa-handshake', 'img' => 'https://images.unsplash.com/photo-1556761175-4b46a572b786?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹20L', 'demand' => 'Very High'],
            ['name' => 'Content Strategist', 'icon' => 'fa-chess-knight', 'img' => 'https://images.unsplash.com/photo-1455390582262-044cdead2708?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹25L', 'demand' => 'High'],

            // Writing & Editing
            ['name' => 'Social Media Copywriter', 'icon' => 'fa-keyboard', 'img' => 'https://images.unsplash.com/photo-1455390582262-044cdead2708?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'demand' => 'High'],
            ['name' => 'Scriptwriter for YT/Reels', 'icon' => 'fa-pen-clip', 'img' => 'https://images.unsplash.com/photo-1485846234645-a62644f84728?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹18L', 'demand' => 'Growing'],
            ['name' => 'Technical Blogger', 'icon' => 'fa-laptop-code', 'img' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹25L', 'demand' => 'High'],
            ['name' => 'Meme Creator / Humour Writer', 'icon' => 'fa-face-laugh-squint', 'img' => 'https://images.unsplash.com/photo-1542044801-44ee3170e176?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'demand' => 'Growing'],
            ['name' => 'Newsletter Writer/Editor', 'icon' => 'fa-envelope-open-text', 'img' => 'https://images.unsplash.com/photo-1596526131083-e8c638c9c6c3?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'Growing'],

            // Media Production
            ['name' => 'Social Media Video Editor', 'icon' => 'fa-film', 'img' => 'https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹20L', 'demand' => 'Very High'],
            ['name' => 'Thumbnail / Graphic Designer', 'icon' => 'fa-image', 'img' => 'https://images.unsplash.com/photo-1626785774573-4b799315345d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'demand' => 'High'],
            ['name' => 'Short-form Content Editor (Reels/Shorts)', 'icon' => 'fa-mobile-screen', 'img' => 'https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹18L', 'demand' => 'Very High'],
            ['name' => 'Live Stream Producer', 'icon' => 'fa-video', 'img' => 'https://images.unsplash.com/photo-1516259762381-22954d7d3ad2?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹25L', 'demand' => 'Growing'],
            ['name' => 'Voice Actor for Social Media', 'icon' => 'fa-microphone-lines', 'img' => 'https://images.unsplash.com/photo-1590602847861-f357a9332bbc?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'demand' => 'Stable'],

            // Analytics & Data
            ['name' => 'Social Media Analyst', 'icon' => 'fa-chart-simple', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹20L', 'demand' => 'High'],
            ['name' => 'Audience Development Manager', 'icon' => 'fa-users-rays', 'img' => 'https://images.unsplash.com/photo-1515169067868-5387ec356754?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹22L', 'demand' => 'Growing'],
            ['name' => 'Trend Forecaster', 'icon' => 'fa-arrow-trend-up', 'img' => 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹25L', 'demand' => 'Growing'],
            ['name' => 'Growth Hacker', 'icon' => 'fa-rocket', 'img' => 'https://images.unsplash.com/photo-1551288049-bbda38a594a0?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹40L', 'demand' => 'Very High'],
            ['name' => 'YouTube Analytics Expert', 'icon' => 'fa-youtube', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'High'],

            // Specialized Platforms & Formats
            ['name' => 'Discord Server Manager', 'icon' => 'fa-discord', 'img' => 'https://images.unsplash.com/photo-1614680376593-902f74cf0d41?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'demand' => 'Growing'],
            ['name' => 'LinkedIn Branding Specialist', 'icon' => 'fa-linkedin', 'img' => 'https://images.unsplash.com/photo-1611926653458-09294b3142bf?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹25L', 'demand' => 'High'],
            ['name' => 'OnlyFans / Patreon Creator', 'icon' => 'fa-patreon', 'img' => 'https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Stable'],
            ['name' => 'Course Creator / Infopreneur', 'icon' => 'fa-graduation-cap', 'img' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies widely', 'demand' => 'Very High'],
            ['name' => 'Twitch Streamer', 'icon' => 'fa-twitch', 'img' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Growing'],

            // E-commerce & Social Selling
            ['name' => 'Social Commerce Specialist', 'icon' => 'fa-cart-shopping', 'img' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹20L', 'demand' => 'High'],
            ['name' => 'Affiliate Marketer', 'icon' => 'fa-link', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'High'],
            ['name' => 'Talent Manager for Creators', 'icon' => 'fa-address-book', 'img' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹30L', 'demand' => 'Growing'],
            ['name' => 'Ad Campaign Manager', 'icon' => 'fa-rectangle-ad', 'img' => 'https://images.unsplash.com/photo-1551288049-bbda38a594a0?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹25L', 'demand' => 'High'],
            ['name' => 'Social Media Consultant', 'icon' => 'fa-user-tie', 'img' => 'https://images.unsplash.com/photo-1556761175-4b46a572b786?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹35L', 'demand' => 'High'],
        ];

        foreach ($careers as $c) {
            Career::updateOrCreate(
                ['slug' => Str::slug($c['name'])],
                [
                    'name'           => $c['name'],
                    'field_id'       => $field->id,
                    'description'    => $c['name'] . ' is a dynamic role in the rapidly growing creator economy, focusing on digital content, audience engagement, and modern marketing.',
                    'qualification'  => 'Varies (Skills, Portfolio, and Personal Brand matter more than degrees)',
                    'stream'         => 'Any Stream',
                    'salary_range'   => $c['salary'],
                    'demand_level'   => $c['demand'],
                    'icon'           => $c['icon'],
                    'image'          => $c['img'],
                    'roadmap'        => [
                        'Identify your niche (Tech, Comedy, Business, etc.)',
                        'Learn content creation tools (Premiere Pro, Canva, etc.)',
                        'Understand platform algorithms and SEO',
                        'Consistently publish high-quality content',
                        'Engage with your community and build an audience',
                        'Monetize through ads, sponsorships, or digital products',
                    ],
                    'skills'         => ['Content Creation', 'Storytelling', 'Video Editing', 'Analytics', 'Consistency'],
                    'future_scope'   => 'The Creator Economy is a multi-billion dollar industry. Traditional advertising is shifting entirely to social media and influencer marketing.',
                    'entrance_exams' => ['None (Digital Marketing certifications like Google/Hubspot are a plus)'],
                    'job_opportunities' => ['Self-Employed Creator', 'Marketing Agencies', 'Brands & Startups', 'Media Companies'],
                    'related_careers' => ['Digital Marketer', 'Video Editor', 'Brand Strategist'],
                ]
            );
        }
    }
}
