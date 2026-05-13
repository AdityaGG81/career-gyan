<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArtsHumanitiesSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'arts-humanities')->first();
        if (!$field) return;

        $careers = [
            // Core Humanities
            ['name' => 'Historian', 'icon' => 'fa-book', 'img' => 'https://images.unsplash.com/photo-1461360370896-922624d12aa1?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹12L', 'demand' => 'Stable'],
            ['name' => 'Archaeologist', 'icon' => 'fa-map-location-dot', 'img' => 'https://images.unsplash.com/photo-1599930113854-d6d7fd521f10?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹10L', 'demand' => 'Stable'],
            ['name' => 'Sociologist', 'icon' => 'fa-users-viewfinder', 'img' => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹12L', 'demand' => 'Growing'],
            ['name' => 'Anthropologist', 'icon' => 'fa-bone', 'img' => 'https://images.unsplash.com/photo-1518991669955-9c7e78ec80ca?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Stable'],
            ['name' => 'Political Scientist', 'icon' => 'fa-landmark', 'img' => 'https://images.unsplash.com/photo-1541872703-74c5e44368f9?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹15L', 'demand' => 'Growing'],

            // Languages & Literature
            ['name' => 'Author / Writer', 'icon' => 'fa-pen-fancy', 'img' => 'https://images.unsplash.com/photo-1455390582262-044cdead2708?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'High'],
            ['name' => 'Translator / Interpreter', 'icon' => 'fa-language', 'img' => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'High'],
            ['name' => 'Linguist', 'icon' => 'fa-ear-listen', 'img' => 'https://images.unsplash.com/photo-1516321497487-e288fb19713f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹15L', 'demand' => 'Stable'],
            ['name' => 'Lexicographer', 'icon' => 'fa-spell-check', 'img' => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹10L', 'demand' => 'Stable'],
            ['name' => 'Content Strategist', 'icon' => 'fa-chess-knight', 'img' => 'https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹18L', 'demand' => 'Very High'],

            // Psychology & Counseling
            ['name' => 'Counseling Psychologist', 'icon' => 'fa-brain', 'img' => 'https://images.unsplash.com/photo-1555580226-5b65103c2fa5?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹12L', 'demand' => 'Very High'],
            ['name' => 'Career Counselor', 'icon' => 'fa-compass', 'img' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹10L', 'demand' => 'High'],
            ['name' => 'Rehabilitation Counselor', 'icon' => 'fa-hands-holding-child', 'img' => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹8L', 'demand' => 'Growing'],
            ['name' => 'School Psychologist', 'icon' => 'fa-school', 'img' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹10L', 'demand' => 'High'],
            ['name' => 'Industrial/Organizational Psychologist', 'icon' => 'fa-building', 'img' => 'https://images.unsplash.com/photo-1556761175-4b46a572b786?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹20L', 'demand' => 'High'],

            // Design & Fine Arts
            ['name' => 'Fine Artist (Painter/Sculptor)', 'icon' => 'fa-palette', 'img' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Stable'],
            ['name' => 'Art Curator', 'icon' => 'fa-image', 'img' => 'https://images.unsplash.com/photo-1561214115-f2f134cc4912?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Stable'],
            ['name' => 'Illustrator', 'icon' => 'fa-pen-nib', 'img' => 'https://images.unsplash.com/photo-1626785774573-4b799315345d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'demand' => 'High'],
            ['name' => 'Interior Designer', 'icon' => 'fa-couch', 'img' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'High'],
            ['name' => 'Fashion Designer', 'icon' => 'fa-shirt', 'img' => 'https://images.unsplash.com/photo-1558769132-cb1fac08b49b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹20L', 'demand' => 'High'],

            // Performing Arts
            ['name' => 'Actor / Actress', 'icon' => 'fa-masks-theater', 'img' => 'https://images.unsplash.com/photo-1585699324551-f6c309eedeca?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'High'],
            ['name' => 'Musician / Singer', 'icon' => 'fa-music', 'img' => 'https://images.unsplash.com/photo-1511379938547-c1f69419868d?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'High'],
            ['name' => 'Choreographer', 'icon' => 'fa-person-walking', 'img' => 'https://images.unsplash.com/photo-1508700115892-45ecd05ae2ad?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'demand' => 'Stable'],
            ['name' => 'Theatre Director', 'icon' => 'fa-clapperboard', 'img' => 'https://images.unsplash.com/photo-1585699324551-f6c309eedeca?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹12L', 'demand' => 'Stable'],
            ['name' => 'Cinematographer', 'icon' => 'fa-video', 'img' => 'https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹20L', 'demand' => 'High'],

            // Media & Communication
            ['name' => 'Journalist', 'icon' => 'fa-newspaper', 'img' => 'https://images.unsplash.com/photo-1585829365295-ab7cd400c167?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'demand' => 'High'],
            ['name' => 'News Anchor', 'icon' => 'fa-microphone', 'img' => 'https://images.unsplash.com/photo-1585829365295-ab7cd400c167?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹25L', 'demand' => 'Growing'],
            ['name' => 'Public Relations (PR) Specialist', 'icon' => 'fa-bullhorn', 'img' => 'https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'High'],
            ['name' => 'Event Manager', 'icon' => 'fa-calendar-check', 'img' => 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'High'],
            ['name' => 'Radio Jockey (RJ)', 'icon' => 'fa-radio', 'img' => 'https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'demand' => 'Stable'],

            // Teaching & Academia
            ['name' => 'Professor of Arts/Humanities', 'icon' => 'fa-chalkboard-user', 'img' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹20L', 'demand' => 'High'],
            ['name' => 'School Teacher (Humanities)', 'icon' => 'fa-school', 'img' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹8L', 'demand' => 'Very High'],
            ['name' => 'Special Education Teacher', 'icon' => 'fa-hands-holding-child', 'img' => 'https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹10L', 'demand' => 'High'],
            ['name' => 'Instructional Designer', 'icon' => 'fa-laptop-file', 'img' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹15L', 'demand' => 'Growing'],

            // Policy & International Relations
            ['name' => 'Public Policy Analyst', 'icon' => 'fa-landmark-dome', 'img' => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹18L', 'demand' => 'Growing'],
            ['name' => 'International Relations Specialist', 'icon' => 'fa-globe-americas', 'img' => 'https://images.unsplash.com/photo-1526374935311-b283ea7b56b5?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹25L', 'demand' => 'High'],
            ['name' => 'Philosopher', 'icon' => 'fa-brain', 'img' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Stable'],
            ['name' => 'Museologist', 'icon' => 'fa-building-columns', 'img' => 'https://images.unsplash.com/photo-1561214115-f2f134cc4912?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹10L', 'demand' => 'Stable'],
            ['name' => 'Archivist', 'icon' => 'fa-box-archive', 'img' => 'https://images.unsplash.com/photo-1461360370896-922624d12aa1?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹9L', 'demand' => 'Stable'],
            ['name' => 'Foreign Language Expert', 'icon' => 'fa-language', 'img' => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹18L', 'demand' => 'High'],
            ['name' => 'Economist', 'icon' => 'fa-chart-line', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹20L', 'demand' => 'High'],
            ['name' => 'Diplomat', 'icon' => 'fa-passport', 'img' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹25L', 'demand' => 'High'],
            ['name' => 'Art Therapist', 'icon' => 'fa-paintbrush', 'img' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹10L', 'demand' => 'Growing'],
            ['name' => 'Copy Editor', 'icon' => 'fa-pen', 'img' => 'https://images.unsplash.com/photo-1455390582262-044cdead2708?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹10L', 'demand' => 'Stable'],
            ['name' => 'Advertising Executive', 'icon' => 'fa-rectangle-ad', 'img' => 'https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'High'],
            ['name' => 'Music Therapist', 'icon' => 'fa-headphones', 'img' => 'https://images.unsplash.com/photo-1511379938547-c1f69419868d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹10L', 'demand' => 'Stable'],
            ['name' => 'Social Worker', 'icon' => 'fa-hand-holding-heart', 'img' => 'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹8L', 'demand' => 'High'],
        ];

        foreach ($careers as $c) {
            Career::updateOrCreate(
                ['slug' => Str::slug($c['name'])],
                [
                    'name'           => $c['name'],
                    'field_id'       => $field->id,
                    'description'    => $c['name'] . ' is a creative and analytical career path in the Arts & Humanities field.',
                    'qualification'  => 'BA / MA / Ph.D in relevant subject',
                    'stream'         => 'Arts / Humanities',
                    'salary_range'   => $c['salary'],
                    'demand_level'   => $c['demand'],
                    'icon'           => $c['icon'],
                    'image'          => $c['img'],
                    'roadmap'        => [
                        'Complete 10+2 with Arts/Humanities subjects',
                        'Pursue a Bachelor’s degree (BA/BFA/BDes) in your area of interest',
                        'Gain practical experience through internships or freelance projects',
                        'Build a strong portfolio of your work (crucial for creative roles)',
                        'Pursue a Master’s degree (MA/MFA) for advanced career prospects',
                        'Network with professionals in the media, academia, or arts industry'
                    ],
                    'skills'         => ['Communication', 'Critical Thinking', 'Creativity', 'Empathy', 'Research'],
                    'future_scope'   => 'As automation increases, uniquely human skills like creativity, empathy, and complex communication will become even more valuable.',
                    'entrance_exams' => ['CUET UG', 'NID DAT', 'UGC NET (for Teaching)'],
                    'job_opportunities' => ['Media Houses', 'Universities', 'NGOs', 'Publishing Companies', 'Self-Employed'],
                    'related_careers' => ['Content Writer', 'Teacher', 'Designer'],
                ]
            );
        }
    }
}
