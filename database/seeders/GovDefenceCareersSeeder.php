<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GovDefenceCareersSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'government-defence')->first();
        if (!$field) return;

        $careers = [
            // Civil Services
            ['name' => 'IAS Officer', 'icon' => 'fa-landmark-flag', 'img' => 'https://images.unsplash.com/photo-1555848962-6e79363ec58f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹7L – ₹30L', 'demand' => 'Very High'],
            ['name' => 'IPS Officer', 'icon' => 'fa-shield-halved', 'img' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=800&q=80', 'salary' => '₹7L – ₹28L', 'demand' => 'Very High'],
            ['name' => 'IFS Officer (Foreign Service)', 'icon' => 'fa-passport', 'img' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹35L', 'demand' => 'High'],
            ['name' => 'IRS Officer (Revenue Service)', 'icon' => 'fa-file-invoice-dollar', 'img' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹7L – ₹28L', 'demand' => 'High'],
            ['name' => 'IFoS Officer (Forest Service)', 'icon' => 'fa-tree', 'img' => 'https://images.unsplash.com/photo-1448375240586-882707db888b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹7L – ₹25L', 'demand' => 'High'],
            
            // Armed Forces (Officers)
            ['name' => 'Indian Army Officer', 'icon' => 'fa-person-military-rifle', 'img' => 'https://images.unsplash.com/photo-1580130544521-8848b11cbac6?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹30L', 'demand' => 'High'],
            ['name' => 'Indian Navy Officer', 'icon' => 'fa-anchor', 'img' => 'https://images.unsplash.com/photo-1534067341352-7ab522bdcb6d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹30L', 'demand' => 'High'],
            ['name' => 'Indian Air Force Pilot', 'icon' => 'fa-plane-up', 'img' => 'https://images.unsplash.com/photo-1555580226-5b65103c2fa5?auto=format&fit=crop&w=800&q=80', 'salary' => '₹10L – ₹35L', 'demand' => 'High'],
            ['name' => 'Coast Guard Officer', 'icon' => 'fa-ship', 'img' => 'https://images.unsplash.com/photo-1518385207796-056e431f4503?auto=format&fit=crop&w=800&q=80', 'salary' => '₹7L – ₹25L', 'demand' => 'Stable'],
            ['name' => 'Military Nursing Officer', 'icon' => 'fa-user-nurse', 'img' => 'https://images.unsplash.com/photo-1594824476967-48c8b964273f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹20L', 'demand' => 'High'],

            // Paramilitary & Police
            ['name' => 'CAPF Assistant Commandant', 'icon' => 'fa-shield', 'img' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=800&q=80', 'salary' => '₹7L – ₹22L', 'demand' => 'High'],
            ['name' => 'State Police Inspector', 'icon' => 'fa-user-shield', 'img' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹15L', 'demand' => 'High'],
            ['name' => 'Intelligence Officer (IB/RAW)', 'icon' => 'fa-user-secret', 'img' => 'https://images.unsplash.com/photo-1555848962-6e79363ec58f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹25L', 'demand' => 'Stable'],
            ['name' => 'CBI Officer', 'icon' => 'fa-magnifying-glass', 'img' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=800&q=80', 'salary' => '₹7L – ₹22L', 'demand' => 'High'],
            ['name' => 'Forensic Expert (Govt)', 'icon' => 'fa-flask', 'img' => 'https://images.unsplash.com/photo-1581093588401-fbb62a02f120?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹18L', 'demand' => 'Growing'],

            // Banking & Finance
            ['name' => 'RBI Grade B Officer', 'icon' => 'fa-building-columns', 'img' => 'https://images.unsplash.com/photo-1501167733022-261541e24bc1?auto=format&fit=crop&w=800&q=80', 'salary' => '₹12L – ₹25L', 'demand' => 'Very High'],
            ['name' => 'SBI PO / Bank Manager', 'icon' => 'fa-piggy-bank', 'img' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹18L', 'demand' => 'Very High'],
            ['name' => 'NABARD Grade A Officer', 'icon' => 'fa-seedling', 'img' => 'https://images.unsplash.com/photo-1500595046743-cd271d694d30?auto=format&fit=crop&w=800&q=80', 'salary' => '₹10L – ₹20L', 'demand' => 'High'],
            ['name' => 'SEBI Grade A Officer', 'icon' => 'fa-chart-line', 'img' => 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?auto=format&fit=crop&w=800&q=80', 'salary' => '₹12L – ₹25L', 'demand' => 'High'],
            ['name' => 'LIC AAO', 'icon' => 'fa-umbrella', 'img' => 'https://images.unsplash.com/photo-1555848962-6e79363ec58f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹16L', 'demand' => 'High'],

            // SSC & Railways
            ['name' => 'Income Tax Inspector (SSC CGL)', 'icon' => 'fa-receipt', 'img' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹15L', 'demand' => 'Very High'],
            ['name' => 'Customs & Excise Officer', 'icon' => 'fa-ship', 'img' => 'https://images.unsplash.com/photo-1518385207796-056e431f4503?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹15L', 'demand' => 'High'],
            ['name' => 'Section Officer (CSS)', 'icon' => 'fa-folder-open', 'img' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹14L', 'demand' => 'Stable'],
            ['name' => 'Railway Section Engineer', 'icon' => 'fa-train', 'img' => 'https://images.unsplash.com/photo-1415353597402-9907fbf863c3?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹15L', 'demand' => 'High'],
            ['name' => 'Railway Station Master', 'icon' => 'fa-train-subway', 'img' => 'https://images.unsplash.com/photo-1541427468627-a89a96e5ca1d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹12L', 'demand' => 'High'],

            // State Services
            ['name' => 'State Civil Service Officer (SDM/BDO)', 'icon' => 'fa-landmark', 'img' => 'https://images.unsplash.com/photo-1555848962-6e79363ec58f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹20L', 'demand' => 'High'],
            ['name' => 'RTO Officer', 'icon' => 'fa-car', 'img' => 'https://images.unsplash.com/photo-1530046339160-ce3e530c7d2f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹15L', 'demand' => 'High'],
            ['name' => 'Tehsildar / Revenue Officer', 'icon' => 'fa-map-location-dot', 'img' => 'https://images.unsplash.com/photo-1555848962-6e79363ec58f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹15L', 'demand' => 'High'],
            ['name' => 'Food Inspector', 'icon' => 'fa-utensils', 'img' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹12L', 'demand' => 'Stable'],
            ['name' => 'Treasury Officer', 'icon' => 'fa-vault', 'img' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹14L', 'demand' => 'Stable'],

            // Technical & Scientific (Govt)
            ['name' => 'ISRO Scientist / Engineer', 'icon' => 'fa-rocket', 'img' => 'https://images.unsplash.com/photo-1541185933-ef5d8ed016c2?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹25L', 'demand' => 'Very High'],
            ['name' => 'DRDO Scientist', 'icon' => 'fa-satellite', 'img' => 'https://images.unsplash.com/photo-1581093588401-fbb62a02f120?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹25L', 'demand' => 'High'],
            ['name' => 'BARC Scientific Officer', 'icon' => 'fa-atom', 'img' => 'https://images.unsplash.com/photo-1532094349884-543559c6571f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹22L', 'demand' => 'High'],
            ['name' => 'Meteorological Officer (IMD)', 'icon' => 'fa-cloud-sun-rain', 'img' => 'https://images.unsplash.com/photo-1561484930-998b6a7b22e8?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹18L', 'demand' => 'Stable'],
            ['name' => 'Geologist (GSI)', 'icon' => 'fa-mountain', 'img' => 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹18L', 'demand' => 'Stable'],

            // PSU & Others
            ['name' => 'PSU Engineer (ONGC, BHEL, etc.)', 'icon' => 'fa-industry', 'img' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80', 'salary' => '₹10L – ₹25L', 'demand' => 'High'],
            ['name' => 'AAI Air Traffic Controller', 'icon' => 'fa-tower-observation', 'img' => 'https://images.unsplash.com/photo-1555580226-5b65103c2fa5?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹20L', 'demand' => 'Growing'],
            ['name' => 'Government Doctor', 'icon' => 'fa-user-doctor', 'img' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹25L', 'demand' => 'Very High'],
            ['name' => 'Government Lecturer / Assistant Professor', 'icon' => 'fa-chalkboard-user', 'img' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹20L', 'demand' => 'High'],
            ['name' => 'Indian Postal Service Officer', 'icon' => 'fa-envelopes-bulk', 'img' => 'https://images.unsplash.com/photo-1555848962-6e79363ec58f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹7L – ₹20L', 'demand' => 'Stable'],
            
            // Subordinate Armed Forces Ranks
            ['name' => 'Army Soldier (GD)', 'icon' => 'fa-person-military-rifle', 'img' => 'https://images.unsplash.com/photo-1580130544521-8848b11cbac6?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹8L', 'demand' => 'High'],
            ['name' => 'Air Force Airman', 'icon' => 'fa-plane', 'img' => 'https://images.unsplash.com/photo-1555580226-5b65103c2fa5?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹8L', 'demand' => 'High'],
            ['name' => 'Navy Sailor', 'icon' => 'fa-ship', 'img' => 'https://images.unsplash.com/photo-1534067341352-7ab522bdcb6d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹8L', 'demand' => 'High'],
            ['name' => 'CRPF Constable', 'icon' => 'fa-shield', 'img' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3.5L – ₹7L', 'demand' => 'High'],
            ['name' => 'BSF Jawan', 'icon' => 'fa-shield-halved', 'img' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3.5L – ₹7L', 'demand' => 'High'],
        ];

        foreach ($careers as $c) {
            Career::updateOrCreate(
                ['slug' => Str::slug($c['name'])],
                [
                    'name'           => $c['name'],
                    'field_id'       => $field->id,
                    'description'    => $c['name'] . ' is a highly prestigious and secure career path offering the opportunity to serve the nation with excellent perks and benefits.',
                    'qualification'  => 'Graduation / 12th Pass (depends on rank)',
                    'stream'         => 'Any Stream',
                    'salary_range'   => $c['salary'],
                    'demand_level'   => $c['demand'],
                    'icon'           => $c['icon'],
                    'image'          => $c['img'],
                    'roadmap'        => [
                        'Complete required education (12th or Degree)',
                        'Check eligibility (Age, Physical Standards)',
                        'Clear Written Examination (UPSC, SSC, NDA, CDS)',
                        'Clear SSB Interview or Physical/Medical Tests',
                        'Complete rigorous academy training',
                        'Get commissioned/appointed to the respective rank',
                        'Serve the nation and get promoted through internal exams/seniority',
                    ],
                    'skills'         => ['Leadership', 'Discipline', 'Decision Making', 'Physical Fitness', 'Patriotism'],
                    'future_scope'   => 'Government and Defence jobs offer unparalleled job security, lifelong pension benefits (for armed forces), social prestige, and the opportunity to make a massive impact on society.',
                    'entrance_exams' => ['UPSC CSE', 'NDA', 'CDS', 'AFCAT', 'SSC CGL', 'IBPS PO', 'SBI PO'],
                    'job_opportunities' => ['Central Government', 'State Government', 'Indian Armed Forces', 'Public Sector Undertakings (PSUs)'],
                    'related_careers' => ['Civil Servant', 'Armed Forces Officer', 'Public Sector Manager'],
                ]
            );
        }
    }
}
