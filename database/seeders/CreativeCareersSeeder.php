<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CreativeCareersSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'creative-careers')->first();
        if (!$field) return;

        $careers = [
            // Design & Visual Arts
            ['name' => 'Graphic Designer', 'icon' => 'fa-bezier-curve', 'img' => 'https://images.unsplash.com/photo-1626785774573-4b799315345d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'demand' => 'High'],
            ['name' => 'Art Director', 'icon' => 'fa-palette', 'img' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹30L', 'demand' => 'High'],
            ['name' => 'Illustrator', 'icon' => 'fa-pen-nib', 'img' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'demand' => 'Stable'],
            ['name' => 'Animator (2D/3D)', 'icon' => 'fa-person-running', 'img' => 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹20L', 'demand' => 'High'],
            ['name' => 'Visual Effects (VFX) Artist', 'icon' => 'fa-wand-magic-sparkles', 'img' => 'https://images.unsplash.com/photo-1536240478700-b869070f9279?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹25L', 'demand' => 'Growing'],
            ['name' => 'Interior Designer', 'icon' => 'fa-couch', 'img' => 'https://images.unsplash.com/photo-1618221195710-dd6b1466a12a?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹20L', 'demand' => 'High'],
            ['name' => 'Fashion Designer', 'icon' => 'fa-shirt', 'img' => 'https://images.unsplash.com/photo-1550614000-4b95d4eddf84?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹25L', 'demand' => 'High'],
            ['name' => 'Industrial Designer', 'icon' => 'fa-industry', 'img' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹22L', 'demand' => 'Stable'],
            ['name' => 'Game Artist', 'icon' => 'fa-gamepad', 'img' => 'https://images.unsplash.com/photo-1552820728-8b83bb6b773f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'Growing'],
            ['name' => 'Exhibition Designer', 'icon' => 'fa-store', 'img' => 'https://images.unsplash.com/photo-1531058020387-3be344556be6?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Stable'],

            // Writing & Publishing
            ['name' => 'Copywriter', 'icon' => 'fa-pen-to-square', 'img' => 'https://images.unsplash.com/photo-1455390582262-044cdead2708?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'demand' => 'High'],
            ['name' => 'Content Writer', 'icon' => 'fa-file-lines', 'img' => 'https://images.unsplash.com/photo-1455390582262-044cdead2708?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'demand' => 'High'],
            ['name' => 'Author / Novelist', 'icon' => 'fa-book', 'img' => 'https://images.unsplash.com/photo-1455390582262-044cdead2708?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Stable'],
            ['name' => 'Screenwriter / Scriptwriter', 'icon' => 'fa-clapperboard', 'img' => 'https://images.unsplash.com/photo-1485846234645-a62644f84728?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹30L', 'demand' => 'Growing'],
            ['name' => 'Editor / Proofreader', 'icon' => 'fa-spell-check', 'img' => 'https://images.unsplash.com/photo-1455390582262-044cdead2708?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'demand' => 'Stable'],

            // Film, Media & Photography
            ['name' => 'Film Director', 'icon' => 'fa-video', 'img' => 'https://images.unsplash.com/photo-1485846234645-a62644f84728?auto=format&fit=crop&w=800&q=80', 'salary' => '₹10L – ₹1Cr+', 'demand' => 'High'],
            ['name' => 'Cinematographer', 'icon' => 'fa-camera-retro', 'img' => 'https://images.unsplash.com/photo-1485846234645-a62644f84728?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹30L', 'demand' => 'High'],
            ['name' => 'Video Editor', 'icon' => 'fa-film', 'img' => 'https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'demand' => 'Very High'],
            ['name' => 'Commercial Photographer', 'icon' => 'fa-camera', 'img' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹20L', 'demand' => 'High'],
            ['name' => 'Sound Designer / Engineer', 'icon' => 'fa-headphones', 'img' => 'https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'Stable'],

            // Performing Arts
            ['name' => 'Actor / Actress', 'icon' => 'fa-masks-theater', 'img' => 'https://images.unsplash.com/photo-1485846234645-a62644f84728?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'High'],
            ['name' => 'Professional Dancer / Choreographer', 'icon' => 'fa-shoe-prints', 'img' => 'https://images.unsplash.com/photo-1508700929628-666bc8bd84ea?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹20L', 'demand' => 'Stable'],
            ['name' => 'Musician / Singer', 'icon' => 'fa-music', 'img' => 'https://images.unsplash.com/photo-1511379938547-c1f69419868d?auto=format&fit=crop&w=800&q=80', 'salary' => 'Varies', 'demand' => 'Stable'],
            ['name' => 'Voice Over Artist', 'icon' => 'fa-microphone', 'img' => 'https://images.unsplash.com/photo-1590602847861-f357a9332bbc?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'demand' => 'Growing'],
            ['name' => 'Theatre Director', 'icon' => 'fa-ticket', 'img' => 'https://images.unsplash.com/photo-1507676184212-d0330a15233c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'demand' => 'Stable'],

            // Styling, Makeup & Beauty
            ['name' => 'Makeup Artist (MUA)', 'icon' => 'fa-paintbrush', 'img' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹20L', 'demand' => 'Very High'],
            ['name' => 'Fashion Stylist', 'icon' => 'fa-glasses', 'img' => 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹25L', 'demand' => 'High'],
            ['name' => 'Hair Stylist', 'icon' => 'fa-scissors', 'img' => 'https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'demand' => 'High'],
            ['name' => 'Costume Designer', 'icon' => 'fa-shirt', 'img' => 'https://images.unsplash.com/photo-1550614000-4b95d4eddf84?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹20L', 'demand' => 'Stable'],
            ['name' => 'Personal Shopper', 'icon' => 'fa-bag-shopping', 'img' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'demand' => 'Growing'],

            // Specialized & Niche Creative
            ['name' => 'Tattoo Artist', 'icon' => 'fa-pen', 'img' => 'https://images.unsplash.com/photo-1598371839696-5c5bb00bdc28?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹25L', 'demand' => 'Growing'],
            ['name' => 'Floral Designer', 'icon' => 'fa-leaf', 'img' => 'https://images.unsplash.com/photo-1563241527-3004b7be0ffd?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹10L', 'demand' => 'Stable'],
            ['name' => 'Jewelry Designer', 'icon' => 'fa-gem', 'img' => 'https://images.unsplash.com/photo-1535632066927-ab7c9ab60908?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹20L', 'demand' => 'Stable'],
            ['name' => 'Culinary Artist / Chef', 'icon' => 'fa-utensils', 'img' => 'https://images.unsplash.com/photo-1577219491135-ce391730fb2c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹30L', 'demand' => 'High'],
            ['name' => 'Ceramic Artist / Potter', 'icon' => 'fa-jar', 'img' => 'https://images.unsplash.com/photo-1610701596007-11502861dcfa?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹12L', 'demand' => 'Stable'],
            ['name' => 'Art Restorer', 'icon' => 'fa-brush', 'img' => 'https://images.unsplash.com/photo-1578301978018-3005759f48f7?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹15L', 'demand' => 'Stable'],
            ['name' => 'Calligrapher', 'icon' => 'fa-pen-nib', 'img' => 'https://images.unsplash.com/photo-1583089892943-e02e52f17d3b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹10L', 'demand' => 'Stable'],
            ['name' => 'Set Designer', 'icon' => 'fa-hammer', 'img' => 'https://images.unsplash.com/photo-1507676184212-d0330a15233c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'demand' => 'Stable'],
            ['name' => 'DJ / Music Producer', 'icon' => 'fa-compact-disc', 'img' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹30L', 'demand' => 'High'],
            ['name' => 'Creative Director', 'icon' => 'fa-crown', 'img' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=800&q=80', 'salary' => '₹12L – ₹50L', 'demand' => 'High'],
        ];

        foreach ($careers as $c) {
            Career::updateOrCreate(
                ['slug' => Str::slug($c['name'])],
                [
                    'name'           => $c['name'],
                    'field_id'       => $field->id,
                    'description'    => $c['name'] . ' is a profession where imagination meets execution. It allows you to express ideas visually, audibly, or through performance while building a unique brand.',
                    'qualification'  => 'Varies (Degrees in Fine Arts/Design are helpful but Portfolio is key)',
                    'stream'         => 'Arts / Humanities / Design',
                    'salary_range'   => $c['salary'],
                    'demand_level'   => $c['demand'],
                    'icon'           => $c['icon'],
                    'image'          => $c['img'],
                    'roadmap'        => [
                        'Identify your creative interest and practice daily',
                        'Pursue a relevant degree, diploma, or self-taught courses',
                        'Build a strong portfolio or showreel of your work',
                        'Network with industry professionals and use social media',
                        'Start taking freelance projects or internships',
                        'Join an agency, studio, or work as an independent creator',
                    ],
                    'skills'         => ['Creativity', 'Attention to Detail', 'Software Tools (Adobe CS, etc.)', 'Communication', 'Adaptability'],
                    'future_scope'   => 'The creator economy and digital boom have exponentially increased the demand for creative professionals in advertising, media, and tech.',
                    'entrance_exams' => ['NIFT', 'NID DAT', 'UCEED', 'FTII Entrance (for film)'],
                    'job_opportunities' => ['Ad Agencies', 'Design Studios', 'Film Production Houses', 'Freelance', 'Tech Companies'],
                    'related_careers' => ['Digital Artist', 'Media Professional'],
                ]
            );
        }
    }
}
