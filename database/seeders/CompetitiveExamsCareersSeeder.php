<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompetitiveExamsCareersSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'competitive-exams')->first();
        if (!$field) return;

        $careers = [
            // UPSC / Civil Services
            ['name' => 'IAS Officer (UPSC CSE)', 'icon' => 'fa-landmark-flag', 'img' => 'https://images.unsplash.com/photo-1555848962-6e79363ec58f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹7L – ₹30L', 'demand' => 'Very High'],
            ['name' => 'IPS Officer (UPSC CSE)', 'icon' => 'fa-shield-halved', 'img' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=800&q=80', 'salary' => '₹7L – ₹28L', 'demand' => 'Very High'],
            ['name' => 'IFS Officer (Foreign Service)', 'icon' => 'fa-passport', 'img' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹35L', 'demand' => 'High'],
            ['name' => 'IRS Officer (Revenue Service)', 'icon' => 'fa-file-invoice-dollar', 'img' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹7L – ₹28L', 'demand' => 'High'],
            ['name' => 'State PSC Officer (SDM/DSP)', 'icon' => 'fa-landmark', 'img' => 'https://images.unsplash.com/photo-1555848962-6e79363ec58f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹20L', 'demand' => 'High'],

            // Defence Exams
            ['name' => 'NDA Officer (Army/Navy/AF)', 'icon' => 'fa-person-military-rifle', 'img' => 'https://images.unsplash.com/photo-1580130544521-8848b11cbac6?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹25L', 'demand' => 'High'],
            ['name' => 'CDS Officer', 'icon' => 'fa-star', 'img' => 'https://images.unsplash.com/photo-1580130544521-8848b11cbac6?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹25L', 'demand' => 'High'],
            ['name' => 'AFCAT Officer (Air Force)', 'icon' => 'fa-plane-up', 'img' => 'https://images.unsplash.com/photo-1555580226-5b65103c2fa5?auto=format&fit=crop&w=800&q=80', 'salary' => '₹10L – ₹30L', 'demand' => 'High'],
            ['name' => 'CAPF Assistant Commandant', 'icon' => 'fa-shield', 'img' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=800&q=80', 'salary' => '₹7L – ₹22L', 'demand' => 'High'],
            ['name' => 'Indian Coast Guard Officer', 'icon' => 'fa-ship', 'img' => 'https://images.unsplash.com/photo-1518385207796-056e431f4503?auto=format&fit=crop&w=800&q=80', 'salary' => '₹7L – ₹25L', 'demand' => 'Stable'],

            // Banking & Finance Exams
            ['name' => 'SBI PO', 'icon' => 'fa-building-columns', 'img' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹15L', 'demand' => 'Very High'],
            ['name' => 'IBPS PO', 'icon' => 'fa-piggy-bank', 'img' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹7L – ₹12L', 'demand' => 'High'],
            ['name' => 'RBI Grade B Officer', 'icon' => 'fa-vault', 'img' => 'https://images.unsplash.com/photo-1501167733022-261541e24bc1?auto=format&fit=crop&w=800&q=80', 'salary' => '₹12L – ₹25L', 'demand' => 'Very High'],
            ['name' => 'NABARD Grade A Officer', 'icon' => 'fa-seedling', 'img' => 'https://images.unsplash.com/photo-1500595046743-cd271d694d30?auto=format&fit=crop&w=800&q=80', 'salary' => '₹10L – ₹20L', 'demand' => 'High'],
            ['name' => 'SEBI Grade A Officer', 'icon' => 'fa-chart-line', 'img' => 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?auto=format&fit=crop&w=800&q=80', 'salary' => '₹12L – ₹25L', 'demand' => 'High'],

            // SSC (Staff Selection Commission)
            ['name' => 'Income Tax Inspector (SSC CGL)', 'icon' => 'fa-receipt', 'img' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹12L', 'demand' => 'Very High'],
            ['name' => 'Customs Inspector (SSC CGL)', 'icon' => 'fa-ship', 'img' => 'https://images.unsplash.com/photo-1518385207796-056e431f4503?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹12L', 'demand' => 'High'],
            ['name' => 'Sub-Inspector in CBI (SSC CGL)', 'icon' => 'fa-magnifying-glass', 'img' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹12L', 'demand' => 'High'],
            ['name' => 'Assistant Section Officer (MEA)', 'icon' => 'fa-plane', 'img' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹14L', 'demand' => 'High'],
            ['name' => 'Junior Engineer (SSC JE)', 'icon' => 'fa-helmet-safety', 'img' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹10L', 'demand' => 'Stable'],

            // Railways (RRB)
            ['name' => 'Station Master (RRB NTPC)', 'icon' => 'fa-train', 'img' => 'https://images.unsplash.com/photo-1541427468627-a89a96e5ca1d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹10L', 'demand' => 'High'],
            ['name' => 'Commercial Apprentice (RRB NTPC)', 'icon' => 'fa-briefcase', 'img' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹10L', 'demand' => 'High'],
            ['name' => 'Junior Engineer (RRB JE)', 'icon' => 'fa-wrench', 'img' => 'https://images.unsplash.com/photo-1415353597402-9907fbf863c3?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹10L', 'demand' => 'Stable'],
            ['name' => 'Assistant Loco Pilot (RRB ALP)', 'icon' => 'fa-train-tram', 'img' => 'https://images.unsplash.com/photo-1541427468627-a89a96e5ca1d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹9L', 'demand' => 'High'],
            ['name' => 'Railway Protection Force (RPF) SI', 'icon' => 'fa-shield', 'img' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹10L', 'demand' => 'Stable'],

            // Engineering & Technical Exams
            ['name' => 'IES Officer (Engineering Services)', 'icon' => 'fa-industry', 'img' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹25L', 'demand' => 'High'],
            ['name' => 'GATE PSU Officer (ONGC, BHEL)', 'icon' => 'fa-gas-pump', 'img' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80', 'salary' => '₹10L – ₹25L', 'demand' => 'High'],
            ['name' => 'ISRO Scientist/Engineer', 'icon' => 'fa-rocket', 'img' => 'https://images.unsplash.com/photo-1541185933-ef5d8ed016c2?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹22L', 'demand' => 'High'],
            ['name' => 'DRDO Scientist', 'icon' => 'fa-satellite', 'img' => 'https://images.unsplash.com/photo-1581093588401-fbb62a02f120?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹22L', 'demand' => 'High'],
            ['name' => 'BARC Scientific Officer', 'icon' => 'fa-atom', 'img' => 'https://images.unsplash.com/photo-1532094349884-543559c6571f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹22L', 'demand' => 'High'],

            // Teaching & Academic Exams
            ['name' => 'Assistant Professor (UGC NET)', 'icon' => 'fa-chalkboard-user', 'img' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹15L', 'demand' => 'High'],
            ['name' => 'JRF Research Fellow (CSIR/UGC)', 'icon' => 'fa-microscope', 'img' => 'https://images.unsplash.com/photo-1532094349884-543559c6571f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹6L (Stipend)', 'demand' => 'High'],
            ['name' => 'Government School Teacher (CTET/TET)', 'icon' => 'fa-school', 'img' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹10L', 'demand' => 'Very High'],
            ['name' => 'PGT/TGT Teacher (KVS/NVS)', 'icon' => 'fa-book-open-reader', 'img' => 'https://images.unsplash.com/photo-1577896851231-70ef18881754?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹12L', 'demand' => 'High'],

            // Entrance Exams (For Higher Education)
            ['name' => 'IIT Engineer (via JEE Advanced)', 'icon' => 'fa-laptop-code', 'img' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=800&q=80', 'salary' => '₹10L – ₹40L+', 'demand' => 'Very High'],
            ['name' => 'Medical Doctor (via NEET UG)', 'icon' => 'fa-user-doctor', 'img' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹30L+', 'demand' => 'Very High'],
            ['name' => 'NLU Corporate Lawyer (via CLAT)', 'icon' => 'fa-scale-balanced', 'img' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=800&q=80', 'salary' => '₹10L – ₹30L', 'demand' => 'High'],
            ['name' => 'IIM MBA Graduate (via CAT)', 'icon' => 'fa-user-tie', 'img' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=800&q=80', 'salary' => '₹15L – ₹50L+', 'demand' => 'Very High'],
            ['name' => 'NID/NIFT Designer (via NID DAT/NIFT)', 'icon' => 'fa-pen-nib', 'img' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹20L', 'demand' => 'High'],
            ['name' => 'CA Professional (via ICAI Exams)', 'icon' => 'fa-calculator', 'img' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹30L', 'demand' => 'Very High'],

            // State Level & Misc
            ['name' => 'State Police Sub-Inspector', 'icon' => 'fa-person-military-pointing', 'img' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹8L', 'demand' => 'High'],
            ['name' => 'LIC AAO (Insurance Officer)', 'icon' => 'fa-umbrella', 'img' => 'https://images.unsplash.com/photo-1555848962-6e79363ec58f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹14L', 'demand' => 'High'],
            ['name' => 'FCI Manager (Food Corporation)', 'icon' => 'fa-wheat-awn', 'img' => 'https://images.unsplash.com/photo-1592982537447-7440770cbfc9?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹12L', 'demand' => 'Stable'],
            ['name' => 'EPFO Enforcement Officer', 'icon' => 'fa-building-columns', 'img' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹7L – ₹14L', 'demand' => 'High'],
            ['name' => 'Post Office Inspector (India Post)', 'icon' => 'fa-envelopes-bulk', 'img' => 'https://images.unsplash.com/photo-1555848962-6e79363ec58f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹10L', 'demand' => 'Stable'],
            ['name' => 'Supreme/High Court Clerk', 'icon' => 'fa-gavel', 'img' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹8L', 'demand' => 'Stable'],
            ['name' => 'RBI Assistant', 'icon' => 'fa-money-bill-transfer', 'img' => 'https://images.unsplash.com/photo-1501167733022-261541e24bc1?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4.5L – ₹8L', 'demand' => 'High'],
            ['name' => 'Forest Ranger (State/UPSC IFoS)', 'icon' => 'fa-tree', 'img' => 'https://images.unsplash.com/photo-1448375240586-882707db888b?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹15L', 'demand' => 'Stable'],
            ['name' => 'CBT/Online Exam Content Creator', 'icon' => 'fa-laptop-file', 'img' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹10L', 'demand' => 'Growing'],
            ['name' => 'Competitive Exam Faculty/Coach', 'icon' => 'fa-user-tie', 'img' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹30L+', 'demand' => 'High'],
        ];

        foreach ($careers as $c) {
            Career::updateOrCreate(
                ['slug' => Str::slug($c['name'])],
                [
                    'name'           => $c['name'],
                    'field_id'       => $field->id,
                    'description'    => $c['name'] . ' is a prestigious career path achieved by clearing highly competitive national or state-level examinations.',
                    'qualification'  => 'Graduation (in any stream, mostly) / 12th for some exams',
                    'stream'         => 'Any Stream',
                    'salary_range'   => $c['salary'],
                    'demand_level'   => $c['demand'],
                    'icon'           => $c['icon'],
                    'image'          => $c['img'],
                    'roadmap'        => [
                        'Understand the exam syllabus and pattern thoroughly',
                        'Gather standard study materials and NCERT books',
                        'Create a strict daily study routine and stick to it',
                        'Solve previous year question papers and give mock tests',
                        'Clear Prelims, Mains, and the Interview round',
                        'Attend the respective training academy after selection',
                    ],
                    'skills'         => ['Perseverance', 'Time Management', 'General Awareness', 'Analytical Ability', 'Discipline'],
                    'future_scope'   => 'Government and public sector jobs offer unmatched job security, societal respect, and perks that are rarely found in the private sector.',
                    'entrance_exams' => ['Specific to the role (UPSC, SSC, IBPS, GATE, etc.)'],
                    'job_opportunities' => ['Central Government', 'State Government', 'PSUs', 'Public Sector Banks'],
                    'related_careers' => ['Civil Servant', 'Banker', 'Government Engineer'],
                ]
            );
        }
    }
}
