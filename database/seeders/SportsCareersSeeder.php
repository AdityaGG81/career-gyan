<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SportsCareersSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'sports')->first();
        if (!$field) return;

        $careers = [
            // ── Playing Careers ──
            ['name' => 'Cricketer',                    'icon' => 'fa-baseball-bat-ball', 'img' => 'https://images.unsplash.com/photo-1531415074968-036ba1b575da?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹10Cr+', 'demand' => 'Growing'],
            ['name' => 'Football Player',              'icon' => 'fa-futbol',             'img' => 'https://images.unsplash.com/photo-1553778263-73a83bab9b0c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹5Cr+',  'demand' => 'Growing'],
            ['name' => 'Hockey Player',                'icon' => 'fa-hockey-puck',        'img' => 'https://images.unsplash.com/photo-1580748142113-d3c60a585f19?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹40L',   'demand' => 'Stable'],
            ['name' => 'Badminton Player',             'icon' => 'fa-table-tennis-paddle-ball','img' => 'https://images.unsplash.com/photo-1626224583764-f87db24ac4ea?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹2Cr+',  'demand' => 'Growing'],
            ['name' => 'Tennis Player',                'icon' => 'fa-baseball',           'img' => 'https://images.unsplash.com/photo-1554068865-24cecd4e34b8?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹5Cr+',  'demand' => 'Growing'],
            ['name' => 'Table Tennis Player',          'icon' => 'fa-table-tennis-paddle-ball', 'img' => 'https://images.unsplash.com/photo-1611251135345-18c56206b863?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹50L',  'demand' => 'Stable'],
            ['name' => 'Basketball Player',            'icon' => 'fa-basketball',         'img' => 'https://images.unsplash.com/photo-1546519638405-a1d0b51d6e16?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹1Cr+',  'demand' => 'Growing'],
            ['name' => 'Volleyball Player',            'icon' => 'fa-volleyball',         'img' => 'https://images.unsplash.com/photo-1612872087720-bb876e2e67d1?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹30L',   'demand' => 'Stable'],
            ['name' => 'Kabaddi Player',               'icon' => 'fa-person-running',     'img' => 'https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹1Cr+',  'demand' => 'Growing'],
            ['name' => 'Kho Kho Player',               'icon' => 'fa-person-running',     'img' => 'https://images.unsplash.com/photo-1576941089067-2de3c901e126?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹20L',   'demand' => 'Stable'],
            ['name' => 'Athlete / Track Runner',       'icon' => 'fa-flag-checkered',     'img' => 'https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹50L',   'demand' => 'Growing'],
            ['name' => 'Marathon Runner',              'icon' => 'fa-person-walking',     'img' => 'https://images.unsplash.com/photo-1530549387789-4c1017266635?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹30L',   'demand' => 'Growing'],
            ['name' => 'Swimmer',                      'icon' => 'fa-person-swimming',    'img' => 'https://images.unsplash.com/photo-1571902943202-507ec2618e8f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹40L',   'demand' => 'Growing'],
            ['name' => 'Boxer',                        'icon' => 'fa-hand-fist',          'img' => 'https://images.unsplash.com/photo-1549719386-74dfcbf7dbed?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹2Cr+',  'demand' => 'Growing'],
            ['name' => 'Wrestler',                     'icon' => 'fa-hand-fist',          'img' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹1Cr+',  'demand' => 'Growing'],
            ['name' => 'Weightlifter',                 'icon' => 'fa-dumbbell',           'img' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹50L',   'demand' => 'Stable'],
            ['name' => 'Gymnast',                      'icon' => 'fa-person-falling',     'img' => 'https://images.unsplash.com/photo-1517963879433-6ad2171073fb?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹40L',   'demand' => 'Stable'],
            ['name' => 'Archer',                       'icon' => 'fa-bullseye',           'img' => 'https://images.unsplash.com/photo-1488085061387-422e29b40080?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹30L',   'demand' => 'Growing'],
            ['name' => 'Shooter',                      'icon' => 'fa-crosshairs',         'img' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹30L',   'demand' => 'Growing'],
            ['name' => 'Chess Player',                 'icon' => 'fa-chess',              'img' => 'https://images.unsplash.com/photo-1529699211952-734e80c4d42b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹5Cr+',  'demand' => 'Growing'],
            ['name' => 'Skater',                       'icon' => 'fa-person-skating',     'img' => 'https://images.unsplash.com/photo-1551698618-1dfe5d97d256?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹20L',   'demand' => 'Stable'],
            ['name' => 'Cyclist',                      'icon' => 'fa-person-biking',      'img' => 'https://images.unsplash.com/photo-1541625602703-16f4c7c8a67a?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹30L',   'demand' => 'Growing'],
            ['name' => 'Mountaineer',                  'icon' => 'fa-mountain',           'img' => 'https://images.unsplash.com/photo-1522163182402-834f871fd851?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹25L',   'demand' => 'Growing'],
            // ── Fitness & Wellness ──
            ['name' => 'Yoga Instructor',              'icon' => 'fa-om',                 'img' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹20L',   'demand' => 'Very High'],
            ['name' => 'Fitness Trainer',              'icon' => 'fa-dumbbell',           'img' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹20L',   'demand' => 'Very High'],
            ['name' => 'Strength and Conditioning Coach','icon' => 'fa-dumbbell',         'img' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹25L',   'demand' => 'Growing'],
            ['name' => 'Athletic Trainer',             'icon' => 'fa-person-running',     'img' => 'https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹20L',   'demand' => 'Growing'],
            ['name' => 'Martial Arts Trainer',         'icon' => 'fa-hand-fist',          'img' => 'https://images.unsplash.com/photo-1549719386-74dfcbf7dbed?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹18L',   'demand' => 'Growing'],
            ['name' => 'Adventure Sports Instructor',  'icon' => 'fa-mountain-sun',       'img' => 'https://images.unsplash.com/photo-1522163182402-834f871fd851?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹18L',   'demand' => 'Growing'],
            // ── Coaching & Education ──
            ['name' => 'Sports Coach',                 'icon' => 'fa-whistle',            'img' => 'https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹30L',   'demand' => 'High'],
            ['name' => 'Physical Education Teacher',   'icon' => 'fa-chalkboard-user',    'img' => 'https://images.unsplash.com/photo-1576941089067-2de3c901e126?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L',   'demand' => 'High'],
            ['name' => 'Sports Academy Owner',         'icon' => 'fa-building-columns',   'img' => 'https://images.unsplash.com/photo-1571902943202-507ec2618e8f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹50L',   'demand' => 'Growing'],
            // ── Sports Medicine & Science ──
            ['name' => 'Sports Physiotherapist',       'icon' => 'fa-user-doctor',        'img' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹22L',   'demand' => 'Very High'],
            ['name' => 'Sports Nutritionist',          'icon' => 'fa-apple-whole',        'img' => 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹20L',   'demand' => 'Growing'],
            ['name' => 'Sports Psychologist',          'icon' => 'fa-brain',              'img' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹25L',   'demand' => 'Growing'],
            ['name' => 'Sports Medicine Doctor',       'icon' => 'fa-stethoscope',        'img' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹40L',   'demand' => 'Growing'],
            // ── Management & Business ──
            ['name' => 'Referee / Umpire',             'icon' => 'fa-whistle',            'img' => 'https://images.unsplash.com/photo-1531415074968-036ba1b575da?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹20L',   'demand' => 'Stable'],
            ['name' => 'Sports Event Manager',         'icon' => 'fa-calendar-check',     'img' => 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹25L',   'demand' => 'Growing'],
            ['name' => 'Sports Marketing Manager',     'icon' => 'fa-bullhorn',           'img' => 'https://images.unsplash.com/photo-1551434678-e076c223a692?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹30L',   'demand' => 'Growing'],
            ['name' => 'Sports Agent',                 'icon' => 'fa-handshake',          'img' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹50L',   'demand' => 'Growing'],
            ['name' => 'Sports Facility Manager',      'icon' => 'fa-building',           'img' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹20L',   'demand' => 'Stable'],
            ['name' => 'Sports Administrator',         'icon' => 'fa-landmark',           'img' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹25L',   'demand' => 'Stable'],
            // ── Media & Analytics ──
            ['name' => 'Sports Commentator',           'icon' => 'fa-microphone',         'img' => 'https://images.unsplash.com/photo-1589903308904-1010c2294adc?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹30L',   'demand' => 'Growing'],
            ['name' => 'Sports Journalist',            'icon' => 'fa-newspaper',          'img' => 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹18L',   'demand' => 'Stable'],
            ['name' => 'Sports Photographer',          'icon' => 'fa-camera',             'img' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹20L',   'demand' => 'Growing'],
            ['name' => 'Sports Analyst',               'icon' => 'fa-chart-line',         'img' => 'https://images.unsplash.com/photo-1551288049-bbda38a594a0?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹30L',   'demand' => 'Very High'],
            ['name' => 'Sports Data Analyst',          'icon' => 'fa-magnifying-glass-chart','img' => 'https://images.unsplash.com/photo-1543286386-713bdd548da4?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹35L',   'demand' => 'Very High'],
            // ── Esports & Innovation ──
            ['name' => 'Esports Player',               'icon' => 'fa-gamepad',            'img' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹5Cr+',  'demand' => 'Very High'],
            ['name' => 'Esports Coach',                'icon' => 'fa-headset',            'img' => 'https://images.unsplash.com/photo-1511512578047-dfb367046420?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹25L',   'demand' => 'Very High'],
            ['name' => 'Sports Equipment Designer',    'icon' => 'fa-pen-ruler',          'img' => 'https://images.unsplash.com/photo-1581093588401-fbb62a02f120?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹25L',   'demand' => 'Growing'],
        ];

        foreach ($careers as $c) {
            Career::updateOrCreate(
                ['slug' => Str::slug($c['name'])],
                [
                    'name'           => $c['name'],
                    'field_id'       => $field->id,
                    'description'    => $c['name'] . ' is an exciting sports career that combines passion, performance, and professionalism in India\'s rapidly growing sports ecosystem.',
                    'qualification'  => 'Level-based sports certifications + physical tests',
                    'stream'         => 'Any (Physical Education preferred)',
                    'salary_range'   => $c['salary'],
                    'demand_level'   => $c['demand'],
                    'icon'           => $c['icon'],
                    'image'          => $c['img'],
                    'roadmap'        => [
                        'Identify your sport and start training early',
                        'Compete at district and state level',
                        'Join a sports academy or SAI centre',
                        'Pursue relevant degree (BSc Sports, BPEd, etc.)',
                        'Compete at national level tournaments',
                        'Get professional sponsorship or coaching role',
                        'Represent India internationally',
                    ],
                    'skills'         => ['Physical Fitness', 'Discipline', 'Teamwork', 'Mental Toughness', 'Strategic Thinking'],
                    'future_scope'   => 'India\'s sports economy is booming with IPL, PKL, ISL, and massive Olympic investments. Sports-related careers in coaching, analytics, management, and media are growing rapidly with significant government backing under Khelo India.',
                    'entrance_exams' => ['SAI Trials', 'Khelo India Scholarship', 'NSNIS Patiala', 'BPEd Entrance', 'State Sports Quota'],
                    'job_opportunities' => ['National Sports Federations', 'State Sports Boards', 'Private Sports Academies', 'Franchises', 'Media Channels', 'Corporates & Brands'],
                    'related_careers' => ['Sports Coach', 'Fitness Trainer', 'Sports Physiotherapist'],
                ]
            );
        }
    }
}
