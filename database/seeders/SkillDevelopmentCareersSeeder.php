<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SkillDevelopmentCareersSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'skill-development')->first();
        if (!$field) return;

        $careers = [
            // ── Electrical & Electronics ──
            ['name' => 'Electrician',                   'icon' => 'fa-bolt',                'img' => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹8L',  'qual' => '10th + ITI Electrician',          'demand' => 'High'],
            ['name' => 'Solar Panel Technician',        'icon' => 'fa-solar-panel',          'img' => 'https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2.5L – ₹10L','qual' => 'ITI / Diploma Solar Tech',         'demand' => 'Growing'],
            ['name' => 'AC & Refrigeration Technician', 'icon' => 'fa-snowflake',            'img' => 'https://images.unsplash.com/photo-1581094794329-c8112a89af12?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹9L',  'qual' => 'ITI RAACT Trade',                  'demand' => 'High'],
            ['name' => 'EV Technician',                 'icon' => 'fa-charging-station',     'img' => 'https://images.unsplash.com/photo-1593941707882-a5bba14938c7?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'qual' => 'Diploma EV Technology',            'demand' => 'Very High'],
            ['name' => 'CCTV Technician',               'icon' => 'fa-camera',               'img' => 'https://images.unsplash.com/photo-1555664424-778a1e5e1b48?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹7L',  'qual' => 'Certificate CCTV Installation',    'demand' => 'Growing'],
            // ── Mechanical & Industrial ──
            ['name' => 'Plumber',                       'icon' => 'fa-wrench',               'img' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹8L',  'qual' => 'ITI Plumber Trade',                'demand' => 'High'],
            ['name' => 'Welder',                        'icon' => 'fa-fire-flame-curved',    'img' => 'https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2.5L – ₹9L','qual' => 'ITI Welder Trade',                 'demand' => 'High'],
            ['name' => 'Fitter',                        'icon' => 'fa-gear',                 'img' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹8L',  'qual' => 'ITI Fitter Trade',                 'demand' => 'High'],
            ['name' => 'Turner',                        'icon' => 'fa-circle-notch',         'img' => 'https://images.unsplash.com/photo-1565814329452-e1efa11c5b89?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹7.5L','qual' => 'ITI Turner Trade',                 'demand' => 'Stable'],
            ['name' => 'CNC Machine Operator',          'icon' => 'fa-sliders',              'img' => 'https://images.unsplash.com/photo-1565814329452-e1efa11c5b89?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'qual' => 'ITI / Diploma CNC Programming',    'demand' => 'Very High'],
            ['name' => 'Industrial Safety Assistant',   'icon' => 'fa-helmet-safety',        'img' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2.5L – ₹9L','qual' => 'Diploma Industrial Safety',         'demand' => 'Growing'],
            ['name' => 'Packaging Machine Operator',    'icon' => 'fa-box-open',             'img' => 'https://images.unsplash.com/photo-1586528116493-a029325540fa?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹7L',  'qual' => 'Certificate Packaging Technology', 'demand' => 'Stable'],
            // ── Automotive ──
            ['name' => 'Automobile Mechanic',           'icon' => 'fa-car-wrench',           'img' => 'https://images.unsplash.com/photo-1530046339160-ce3e530c7d2f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹9L',  'qual' => 'ITI Motor Vehicle Trade',          'demand' => 'High'],
            ['name' => 'Two Wheeler Mechanic',          'icon' => 'fa-motorcycle',           'img' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹7L',  'qual' => 'ITI Two Wheeler Trade',            'demand' => 'High'],
            ['name' => 'Diesel Mechanic',               'icon' => 'fa-truck',                'img' => 'https://images.unsplash.com/photo-1530046339160-ce3e530c7d2f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2.5L – ₹8L','qual' => 'ITI Diesel Mechanic Trade',        'demand' => 'High'],
            // ── IT & Digital ──
            ['name' => 'Computer Hardware Technician',  'icon' => 'fa-desktop',              'img' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹8L',  'qual' => 'CHTT / A+ Certification',         'demand' => 'High'],
            ['name' => 'Mobile Repair Technician',      'icon' => 'fa-mobile-screen',        'img' => 'https://images.unsplash.com/photo-1512054502232-10a0a035d672?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹8L',  'qual' => 'Certificate Mobile Repair',       'demand' => 'High'],
            ['name' => 'Networking Technician',         'icon' => 'fa-network-wired',        'img' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'qual' => 'CCNA / CompTIA Network+',         'demand' => 'Very High'],
            ['name' => 'Web Designer',                  'icon' => 'fa-code',                 'img' => 'https://images.unsplash.com/photo-1547658719-da2b51169166?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'qual' => 'Certificate Web Design',          'demand' => 'Very High'],
            ['name' => 'Data Entry Operator',           'icon' => 'fa-keyboard',             'img' => 'https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&w=800&q=80', 'salary' => '₹1.5L – ₹5L','qual' => 'Certificate Computer Skills',     'demand' => 'High'],
            ['name' => 'Tally Operator',                'icon' => 'fa-calculator',           'img' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹6L',  'qual' => 'Tally ERP Certification',         'demand' => 'High'],
            ['name' => 'Drone Operator',                'icon' => 'fa-drone',                'img' => 'https://images.unsplash.com/photo-1473968512647-3e447244af8f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'qual' => 'DGCA Drone Pilot Certification',  'demand' => 'Very High'],
            ['name' => '3D Printing Technician',        'icon' => 'fa-cubes',                'img' => 'https://images.unsplash.com/photo-1612815154858-60aa4c59eaa6?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'qual' => 'Certificate 3D Printing',         'demand' => 'Growing'],
            ['name' => 'Robotics Technician',           'icon' => 'fa-robot',                'img' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'qual' => 'Diploma Robotics / Mechatronics',  'demand' => 'Very High'],
            // ── Creative & Media ──
            ['name' => 'Graphic Designer',              'icon' => 'fa-pen-nib',              'img' => 'https://images.unsplash.com/photo-1626785774625-ddcddc3445e9?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'qual' => 'Certificate Graphic Design',       'demand' => 'Very High'],
            ['name' => 'Video Editor',                  'icon' => 'fa-film',                 'img' => 'https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹14L', 'qual' => 'Certificate Video Editing',        'demand' => 'Very High'],
            ['name' => 'Digital Marketing Assistant',   'icon' => 'fa-bullhorn',             'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2.5L – ₹12L','qual' => 'Google/Meta Digital Mktg Cert',   'demand' => 'Very High'],
            // ── Office & Business Skills ──
            ['name' => 'Office Assistant',              'icon' => 'fa-briefcase',            'img' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹1.5L – ₹5L','qual' => 'Certificate Office Management',   'demand' => 'High'],
            ['name' => 'Retail Sales Associate',        'icon' => 'fa-shop',                 'img' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=800&q=80', 'salary' => '₹1.5L – ₹5L','qual' => 'Certificate Retail Skills',        'demand' => 'High'],
            ['name' => 'Customer Care Executive',       'icon' => 'fa-headset',              'img' => 'https://images.unsplash.com/photo-1565538810643-b5bdb714032a?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹7L',  'qual' => 'Certificate Customer Service',    'demand' => 'Very High'],
            // ── Fashion & Beauty ──
            ['name' => 'Tailor / Fashion Stitching',    'icon' => 'fa-scissors',             'img' => 'https://images.unsplash.com/photo-1558769132-cb1aea458c5e?auto=format&fit=crop&w=800&q=80', 'salary' => '₹1.5L – ₹8L','qual' => '10th + Tailoring Certificate',    'demand' => 'Stable'],
            ['name' => 'Beautician',                    'icon' => 'fa-spa',                  'img' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹10L', 'qual' => 'Certificate Beauty Therapy',       'demand' => 'High'],
            ['name' => 'Hair Stylist',                  'icon' => 'fa-cut',                  'img' => 'https://images.unsplash.com/photo-1562322140-8baeececf3df?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹10L', 'qual' => 'Certificate Hair Styling',         'demand' => 'High'],
            ['name' => 'Makeup Artist',                 'icon' => 'fa-wand-sparkles',        'img' => 'https://images.unsplash.com/photo-1487412947147-5cebf100d293?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹12L', 'qual' => 'Certificate Makeup Artistry',      'demand' => 'Growing'],
            // ── Food & Hospitality ──
            ['name' => 'Chef / Cook',                   'icon' => 'fa-utensils',             'img' => 'https://images.unsplash.com/photo-1577219491135-ce391730fb2c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹15L', 'qual' => 'Certificate / Diploma Culinary Arts','demand' => 'High'],
            ['name' => 'Bakery Assistant',              'icon' => 'fa-bread-slice',          'img' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=800&q=80', 'salary' => '₹1.8L – ₹6L','qual' => 'Certificate Bakery & Confectionery','demand' => 'Growing'],
            ['name' => 'Hotel Housekeeping Staff',      'icon' => 'fa-broom',                'img' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹6L',  'qual' => 'Certificate Housekeeping',        'demand' => 'Stable'],
            ['name' => 'Front Office Executive',        'icon' => 'fa-concierge-bell',       'img' => 'https://images.unsplash.com/photo-1551882547-ff40c4a49e8e?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹8L',  'qual' => 'Certificate Front Office Mgmt',   'demand' => 'High'],
            // ── Security & Safety ──
            ['name' => 'Security Guard',                'icon' => 'fa-shield',               'img' => 'https://images.unsplash.com/photo-1555664424-778a1e5e1b48?auto=format&fit=crop&w=800&q=80', 'salary' => '₹1.8L – ₹5L','qual' => 'Certificate Security Training',    'demand' => 'High'],
            ['name' => 'Fire Safety Technician',        'icon' => 'fa-fire-extinguisher',    'img' => 'https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2.5L – ₹9L','qual' => 'Diploma Fire Safety',              'demand' => 'Growing'],
            // ── Healthcare Support ──
            ['name' => 'Healthcare Assistant',          'icon' => 'fa-hand-holding-medical', 'img' => 'https://images.unsplash.com/photo-1584515933487-779824d29309?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹7L',  'qual' => 'Certificate Healthcare Assistance','demand' => 'High'],
            ['name' => 'Nursing Assistant',             'icon' => 'fa-user-nurse',           'img' => 'https://images.unsplash.com/photo-1594824476967-48c8b964273f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹7L',  'qual' => 'Certificate Nursing Assistance',   'demand' => 'Very High'],
            ['name' => 'Lab Assistant',                 'icon' => 'fa-flask',                'img' => 'https://images.unsplash.com/photo-1579154204601-01588f351e67?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹7L',  'qual' => 'Certificate Lab Technology',      'demand' => 'High'],
            ['name' => 'Pharmacy Assistant',            'icon' => 'fa-pills',                'img' => 'https://images.unsplash.com/photo-1631549916768-4119b2e5f926?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹7L',  'qual' => 'D.Pharm / Pharmacy Certificate',  'demand' => 'High'],
            // ── Agriculture & Food ──
            ['name' => 'Agriculture Equipment Operator','icon' => 'fa-tractor',              'img' => 'https://images.unsplash.com/photo-1464226184884-fa280b87c399?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹7L',  'qual' => 'Certificate Agri Machinery',      'demand' => 'Stable'],
            ['name' => 'Dairy Farm Assistant',          'icon' => 'fa-cow',                  'img' => 'https://images.unsplash.com/photo-1500595046743-cd271d694d30?auto=format&fit=crop&w=800&q=80', 'salary' => '₹1.8L – ₹5L','qual' => 'Certificate Dairy Technology',    'demand' => 'Stable'],
            ['name' => 'Food Processing Technician',    'icon' => 'fa-industry',             'img' => 'https://images.unsplash.com/photo-1586528116493-a029325540fa?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹8L',  'qual' => 'Diploma Food Technology',         'demand' => 'Growing'],
            // ── Logistics & Warehouse ──
            ['name' => 'Warehouse Assistant',           'icon' => 'fa-warehouse',            'img' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹7L',  'qual' => 'Certificate Warehouse Management', 'demand' => 'High'],
            ['name' => 'Logistics Assistant',           'icon' => 'fa-truck-fast',           'img' => 'https://images.unsplash.com/photo-1494412552103-41028abc387f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹8L',  'qual' => 'Certificate Logistics & SCM',     'demand' => 'High'],
            // ── Entrepreneurship ──
            ['name' => 'Entrepreneurship / Small Business Owner','icon' => 'fa-rocket',      'img' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2L – ₹50L+','qual' => 'Startup / PMKVY / NSDC Program',   'demand' => 'Growing'],
        ];

        foreach ($careers as $c) {
            Career::updateOrCreate(
                ['slug' => Str::slug($c['name'])],
                [
                    'name'           => $c['name'],
                    'field_id'       => $field->id,
                    'description'    => $c['name'] . ' is a practical, in-demand skilled trade that offers strong employment prospects across India\'s growing industries and service sectors.',
                    'qualification'  => $c['qual'],
                    'stream'         => 'Any (after 10th)',
                    'salary_range'   => $c['salary'],
                    'demand_level'   => $c['demand'],
                    'icon'           => $c['icon'],
                    'image'          => $c['img'],
                    'roadmap'        => [
                        'Complete 10th or 12th',
                        'Enrol in ITI / Diploma / Certificate course',
                        'Complete NCVT / SCVT certification',
                        'Do an apprenticeship in relevant industry',
                        'Apply for entry-level positions',
                        'Build experience and upgrade skills',
                        'Become self-employed or start your own business',
                    ],
                    'skills'         => ['Technical Skills', 'Problem Solving', 'Hand-Eye Coordination', 'Safety Awareness', 'Team Work'],
                    'future_scope'   => 'India\'s Skill India Mission and PMKVY scheme are creating massive opportunities in skilled trades. Demand for certified technicians and skilled workers is growing rapidly across manufacturing, construction, services, and the new-age tech sectors.',
                    'entrance_exams' => ['PMKVY Assessment', 'NCVT MIS Exam', 'NSDC Certification', 'State ITI Admission'],
                    'job_opportunities' => ['Government Projects', 'Private Companies', 'Self-Employment', 'Abroad Opportunities', 'MSMEs', 'Startups'],
                    'related_careers' => ['Welder', 'Electrician', 'CNC Machine Operator'],
                ]
            );
        }
    }
}
