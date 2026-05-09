<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GamingCareersSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'gaming-esports')->first();
        if (!$field) return;

        $careers = [
            // Game Development & Tech
            ['name' => 'Game Developer / Programmer', 'icon' => 'fa-code', 'img' => 'https://images.unsplash.com/photo-1552820728-8b83bb6b773f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹30L', 'demand' => 'Very High'],
            ['name' => 'Game Engine Developer', 'icon' => 'fa-cogs', 'img' => 'https://images.unsplash.com/photo-1555255707-c07966088b7b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹40L', 'demand' => 'High'],
            ['name' => 'AI Programmer for Games', 'icon' => 'fa-robot', 'img' => 'https://images.unsplash.com/photo-1555255707-c07966088b7b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹35L', 'demand' => 'Very High'],
            ['name' => 'Network Programmer (Multiplayer)', 'icon' => 'fa-network-wired', 'img' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=800&q=80', 'salary' => '₹7L – ₹30L', 'demand' => 'High'],
            ['name' => 'VR/AR Game Developer', 'icon' => 'fa-vr-cardboard', 'img' => 'https://images.unsplash.com/photo-1593508512255-86ab42a8e620?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹28L', 'demand' => 'Growing'],

            // Game Design & Art
            ['name' => 'Game Designer', 'icon' => 'fa-chess', 'img' => 'https://images.unsplash.com/photo-1552820728-8b83bb6b773f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹25L', 'demand' => 'High'],
            ['name' => 'Level Designer', 'icon' => 'fa-map', 'img' => 'https://images.unsplash.com/photo-1552820728-8b83bb6b773f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹20L', 'demand' => 'High'],
            ['name' => '3D Modeler / Game Artist', 'icon' => 'fa-cube', 'img' => 'https://images.unsplash.com/photo-1626785774573-4b799315345d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹20L', 'demand' => 'High'],
            ['name' => 'UI/UX Designer for Games', 'icon' => 'fa-pen-nib', 'img' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹22L', 'demand' => 'Growing'],
            ['name' => 'Game Animator', 'icon' => 'fa-person-running', 'img' => 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹22L', 'demand' => 'Stable'],
            
            // Audio & Writing
            ['name' => 'Game Sound Designer', 'icon' => 'fa-headphones', 'img' => 'https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'Stable'],
            ['name' => 'Game Composer', 'icon' => 'fa-music', 'img' => 'https://images.unsplash.com/photo-1511379938547-c1f69419868d?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Stable'],
            ['name' => 'Game Writer / Narrative Designer', 'icon' => 'fa-book', 'img' => 'https://images.unsplash.com/photo-1455390582262-044cdead2708?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'demand' => 'Growing'],

            // Testing & Quality
            ['name' => 'QA Tester / Game Tester', 'icon' => 'fa-bug', 'img' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹10L', 'demand' => 'High'],
            ['name' => 'Localization Specialist', 'icon' => 'fa-language', 'img' => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Growing'],

            // Production & Management
            ['name' => 'Game Producer', 'icon' => 'fa-clapperboard', 'img' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹35L', 'demand' => 'High'],
            ['name' => 'Product Manager (Gaming)', 'icon' => 'fa-boxes-stacked', 'img' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80', 'salary' => '₹10L – ₹40L', 'demand' => 'High'],

            // E-Sports & Competitive Gaming
            ['name' => 'Professional Esports Player', 'icon' => 'fa-headset', 'img' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies widely', 'demand' => 'High'],
            ['name' => 'Esports Coach', 'icon' => 'fa-chalkboard-user', 'img' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹20L', 'demand' => 'Growing'],
            ['name' => 'Esports Shoutcaster / Commentator', 'icon' => 'fa-microphone', 'img' => 'https://images.unsplash.com/photo-1590602847861-f357a9332bbc?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹18L', 'demand' => 'Growing'],
            ['name' => 'Esports Team Manager', 'icon' => 'fa-users-gear', 'img' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹25L', 'demand' => 'Growing'],
            ['name' => 'Esports Tournament Organizer', 'icon' => 'fa-trophy', 'img' => 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹22L', 'demand' => 'High'],

            // Streaming & Content
            ['name' => 'Gaming Streamer (Twitch/YT)', 'icon' => 'fa-twitch', 'img' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies widely', 'demand' => 'Very High'],
            ['name' => 'Gaming YouTuber', 'icon' => 'fa-youtube', 'img' => 'https://images.unsplash.com/photo-1516259762381-22954d7d3ad2?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies widely', 'demand' => 'Very High'],
            ['name' => 'Gaming Video Editor', 'icon' => 'fa-film', 'img' => 'https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'demand' => 'High'],

            // Community & Marketing
            ['name' => 'Community Manager (Gaming)', 'icon' => 'fa-users', 'img' => 'https://images.unsplash.com/photo-1515169067868-5387ec356754?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'High'],
            ['name' => 'Gaming Journalist', 'icon' => 'fa-newspaper', 'img' => 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'demand' => 'Stable'],
            ['name' => 'Esports Marketing Specialist', 'icon' => 'fa-bullhorn', 'img' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹20L', 'demand' => 'High'],
            
            // Monetization & Analytics
            ['name' => 'Monetization Designer', 'icon' => 'fa-money-bill-wave', 'img' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹25L', 'demand' => 'Growing'],
            ['name' => 'Game Data Analyst', 'icon' => 'fa-chart-simple', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹22L', 'demand' => 'High'],

            // More Game Roles to make 50...
            ['name' => 'Technical Artist', 'icon' => 'fa-paint-roller', 'img' => 'https://images.unsplash.com/photo-1626785774573-4b799315345d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹25L', 'demand' => 'High'],
            ['name' => 'Environment Artist', 'icon' => 'fa-tree-city', 'img' => 'https://images.unsplash.com/photo-1618221195710-dd6b1466a12a?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'Stable'],
            ['name' => 'Character Designer', 'icon' => 'fa-user-ninja', 'img' => 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹20L', 'demand' => 'High'],
            ['name' => 'Mobile Game Developer', 'icon' => 'fa-mobile-screen-button', 'img' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹25L', 'demand' => 'Very High'],
            ['name' => 'Board Game Designer', 'icon' => 'fa-chess-board', 'img' => 'https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Stable'],
            ['name' => 'Esports Psychologist', 'icon' => 'fa-brain', 'img' => 'https://images.unsplash.com/photo-1555580226-5b65103c2fa5?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Growing'],
            ['name' => 'Esports Physical Therapist', 'icon' => 'fa-hand-holding-medical', 'img' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'demand' => 'Growing'],
            ['name' => 'Hardware Reviewer', 'icon' => 'fa-computer', 'img' => 'https://images.unsplash.com/photo-1587831990711-23ca6441447b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'demand' => 'Stable'],
            ['name' => 'Gaming Events Manager', 'icon' => 'fa-calendar-days', 'img' => 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹20L', 'demand' => 'Stable'],
            ['name' => 'Server Administrator (Gaming)', 'icon' => 'fa-server', 'img' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹18L', 'demand' => 'Stable'],
            ['name' => 'Blockchain Game Developer', 'icon' => 'fa-link', 'img' => 'https://images.unsplash.com/photo-1621416894569-0f39ed31d247?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹35L', 'demand' => 'Growing'],
            ['name' => 'Indie Game Developer', 'icon' => 'fa-laptop-code', 'img' => 'https://images.unsplash.com/photo-1552820728-8b83bb6b773f?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Growing'],
            ['name' => 'Gaming Content Strategist', 'icon' => 'fa-chess-knight', 'img' => 'https://images.unsplash.com/photo-1455390582262-044cdead2708?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹22L', 'demand' => 'Growing'],
            ['name' => 'Player Support Agent', 'icon' => 'fa-headset', 'img' => 'https://images.unsplash.com/photo-1551434678-e076c223a692?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹8L', 'demand' => 'High'],
            ['name' => 'Game Localization QA', 'icon' => 'fa-spell-check', 'img' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹10L', 'demand' => 'Stable'],
            ['name' => 'Esports Nutritionist', 'icon' => 'fa-apple-whole', 'img' => 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'demand' => 'Growing'],
            ['name' => 'Speedrunner', 'icon' => 'fa-stopwatch', 'img' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Niche'],
            ['name' => 'Game Modder', 'icon' => 'fa-wrench', 'img' => 'https://images.unsplash.com/photo-1552820728-8b83bb6b773f?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Niche'],
            ['name' => 'Gaming Affiliate Marketer', 'icon' => 'fa-handshake', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Stable'],
            ['name' => 'Esports Legal Counsel', 'icon' => 'fa-scale-balanced', 'img' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹25L', 'demand' => 'Growing'],
        ];

        foreach ($careers as $c) {
            Career::updateOrCreate(
                ['slug' => Str::slug($c['name'])],
                [
                    'name'           => $c['name'],
                    'field_id'       => $field->id,
                    'description'    => $c['name'] . ' is an exciting career path in the booming gaming and esports industry, combining creativity, technology, and entertainment.',
                    'qualification'  => 'Varies (B.Tech for Devs, Portfolio for Artists, Skill for Esports)',
                    'stream'         => 'Any Stream (PCM preferred for Devs)',
                    'salary_range'   => $c['salary'],
                    'demand_level'   => $c['demand'],
                    'icon'           => $c['icon'],
                    'image'          => $c['img'],
                    'roadmap'        => [
                        'Play and analyze games across different genres',
                        'Learn the necessary skills (C#/C++ for dev, Blender for art, mechanical skills for esports)',
                        'Build a portfolio (create indie games, stream, or climb ranked ladders)',
                        'Network in gaming communities (Discord, Reddit, Twitter)',
                        'Participate in game jams or amateur tournaments',
                        'Apply to game studios or esports orgs',
                    ],
                    'skills'         => ['Passion for Gaming', 'Problem Solving', 'Creativity', 'Teamwork', 'Quick Reflexes (for Esports)'],
                    'future_scope'   => 'The gaming industry generates more revenue than the movie and music industries combined. Esports is rapidly becoming mainstream.',
                    'entrance_exams' => ['None (Design/Engineering entrances depending on the degree)'],
                    'job_opportunities' => ['Game Studios (EA, Ubisoft, Tencent)', 'Esports Orgs', 'Streaming Platforms', 'Freelance/Indie'],
                    'related_careers' => ['Software Developer', 'Digital Artist', 'Content Creator'],
                ]
            );
        }
    }
}
