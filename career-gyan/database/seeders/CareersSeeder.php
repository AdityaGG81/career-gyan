<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class CareersSeeder extends Seeder
{
    public function run(): void
    {
        $careers = [
            /* ── TECHNOLOGY / ENGINEERING ── */
            [
                'name'          => 'Software Engineer',
                'slug'          => 'software-engineer',
                'field'         => 'technology-engineering',
                'description'   => 'Design, develop and maintain software systems for companies across all industries. One of India\'s fastest-growing and highest-paying professions.',
                'qualification' => 'B.Tech / BCA / B.Sc CS',
                'stream'        => 'Science / PCM',
                'salary_range'  => '₹4L – ₹40L per annum',
                'demand_level'  => 'Very High',
                'icon'          => 'fa-code',
                'roadmap'       => [
                    '10th – Focus on Mathematics & Science',
                    '12th – Science stream (PCM)',
                    'JEE / State CET entrance exam',
                    'B.Tech / B.Sc (CS / IT) – 4 years',
                    'Internships & open-source projects',
                    'Entry-level Software Engineer',
                    'Specialise: Full Stack, AI/ML, DevOps, Cloud',
                ],
                'subjects'      => ['Mathematics', 'Physics', 'Computer Science', 'Information Technology'],
            ],
            [
                'name'          => 'Civil Engineer',
                'slug'          => 'civil-engineer',
                'field'         => 'technology-engineering',
                'description'   => 'Plan, design and oversee construction of infrastructure — roads, bridges, buildings and urban systems across India.',
                'qualification' => 'B.Tech (Civil)',
                'stream'        => 'Science / PCM',
                'salary_range'  => '₹3.5L – ₹20L per annum',
                'demand_level'  => 'High',
                'icon'          => 'fa-helmet-safety',
                'roadmap'       => [
                    '10th – Strong Maths & Science base',
                    '12th – Science (PCM)',
                    'JEE Main / State CET',
                    'B.Tech Civil Engineering – 4 years',
                    'GATE for PSU or M.Tech',
                    'Junior Engineer / Assistant Engineer roles',
                    'Senior Civil Engineer / Project Manager',
                ],
                'subjects'      => ['Mathematics', 'Physics', 'Chemistry', 'Drawing'],
            ],
            [
                'name'          => 'Data Scientist',
                'slug'          => 'data-scientist',
                'field'         => 'technology-engineering',
                'description'   => 'Analyse large datasets using statistics and machine learning to help businesses make data-driven decisions.',
                'qualification' => 'B.Tech / B.Sc Statistics or CS + Masters',
                'stream'        => 'Science / PCM',
                'salary_range'  => '₹6L – ₹50L per annum',
                'demand_level'  => 'Very High',
                'icon'          => 'fa-database',
                'roadmap'       => [
                    '12th – Science (PCM)',
                    'B.Tech CS / B.Sc Statistics or Mathematics',
                    'Learn Python, R, Machine Learning',
                    'M.Tech / M.Sc Data Science (optional)',
                    'Kaggle competitions & portfolio projects',
                    'Data Analyst → Data Scientist → ML Engineer',
                ],
                'subjects'      => ['Mathematics', 'Statistics', 'Computer Science', 'Physics'],
            ],

            /* ── MEDICAL ── */
            [
                'name'          => 'Doctor (MBBS)',
                'slug'          => 'doctor-mbbs',
                'field'         => 'medical',
                'description'   => 'Diagnose and treat patients as a medical doctor. A respected, highly rewarding profession requiring dedication, empathy, and rigorous study.',
                'qualification' => 'MBBS (via NEET UG)',
                'stream'        => 'Science / PCB',
                'salary_range'  => '₹8L – ₹60L per annum',
                'demand_level'  => 'Very High',
                'icon'          => 'fa-user-doctor',
                'roadmap'       => [
                    '10th – Focus on Science & Biology',
                    '12th – Science (PCB) with 50%+ marks',
                    'NEET UG Entrance Exam',
                    'MBBS – 5.5 years (including internship)',
                    'Medical Council Registration',
                    'MD / MS Specialisation (optional) – 3 years',
                    'Practice or join hospital / clinic',
                ],
                'subjects'      => ['Biology', 'Chemistry', 'Physics', 'Biotechnology'],
            ],
            [
                'name'          => 'Pharmacist',
                'slug'          => 'pharmacist',
                'field'         => 'medical',
                'description'   => 'Prepare, dispense and advise on medicines. Pharmacists work in hospitals, retail, and pharmaceutical companies across India.',
                'qualification' => '12th Science + B.Pharm',
                'stream'        => 'Science / PCB',
                'salary_range'  => '₹3.5L – ₹15L per annum',
                'demand_level'  => 'High',
                'icon'          => 'fa-pills',
                'roadmap'       => [
                    '12th – Science (PCB or PCM)',
                    'B.Pharm – 4 years',
                    'Pharmacy Council Registration',
                    'M.Pharm for specialisation',
                    'Hospital / Retail / Pharma company roles',
                ],
                'subjects'      => ['Biology', 'Chemistry', 'Physics'],
            ],
            [
                'name'          => 'Nurse',
                'slug'          => 'nurse',
                'field'         => 'medical',
                'description'   => 'Provide patient care, administer medications, and assist doctors. A noble and in-demand healthcare profession.',
                'qualification' => 'B.Sc Nursing',
                'stream'        => 'Science / PCB',
                'salary_range'  => '₹3L – ₹12L per annum',
                'demand_level'  => 'Very High',
                'icon'          => 'fa-user-nurse',
                'roadmap'       => [
                    '12th – Science (PCB)',
                    'B.Sc Nursing – 4 years OR GNM – 3 years',
                    'Internship in hospital',
                    'State Nursing Registration',
                    'Specialise in ICU, Paediatrics, or Community Health',
                ],
                'subjects'      => ['Biology', 'Chemistry', 'English', 'Psychology'],
            ],

            /* ── COMMERCE ── */
            [
                'name'          => 'Chartered Accountant (CA)',
                'slug'          => 'chartered-accountant',
                'field'         => 'commerce',
                'description'   => 'Manage financial audits, taxation and accounts for businesses and individuals. CA is one of India\'s most prestigious commerce careers.',
                'qualification' => '12th Commerce + CA Foundation',
                'stream'        => 'Commerce',
                'salary_range'  => '₹7L – ₹50L per annum',
                'demand_level'  => 'High',
                'icon'          => 'fa-file-invoice-dollar',
                'roadmap'       => [
                    '12th – Commerce (Accountancy as mandatory)',
                    'CA Foundation (after 12th) or Direct Entry after Graduation',
                    'CA Intermediate (IPCC) – 2 groups',
                    '3-year Articleship (practical training)',
                    'CA Final Exam',
                    'ICAI membership – Become a Chartered Accountant',
                    'Practice / Big-4 / Internal Finance roles',
                ],
                'subjects'      => ['Accountancy', 'Mathematics', 'Economics', 'Business Studies'],
            ],
            [
                'name'          => 'Bank PO / Banker',
                'slug'          => 'bank-po',
                'field'         => 'commerce',
                'description'   => 'Work as a Probationary Officer or clerk in public/private sector banks. One of the most sought-after government jobs in India.',
                'qualification' => 'Any Graduation + IBPS/SBI Exam',
                'stream'        => 'Commerce / Any',
                'salary_range'  => '₹5L – ₹18L per annum',
                'demand_level'  => 'High',
                'icon'          => 'fa-building-columns',
                'roadmap'       => [
                    '12th – Commerce (preferred)',
                    'Any Bachelor\'s Degree',
                    'IBPS PO / SBI PO / RBI Grade-B Exam',
                    'Prelims → Mains → Interview',
                    'Join as Probationary Officer',
                    'Confirmed as Scale-I Officer after training',
                ],
                'subjects'      => ['Mathematics', 'Economics', 'Accountancy', 'English'],
            ],

            /* ── SCIENCE ── */
            [
                'name'          => 'Research Scientist',
                'slug'          => 'research-scientist',
                'field'         => 'science',
                'description'   => 'Conduct experiments and research in labs across ISRO, DRDO, CSIR and universities to drive scientific discovery.',
                'qualification' => 'M.Sc / M.Tech + PhD',
                'stream'        => 'Science',
                'salary_range'  => '₹5L – ₹25L per annum',
                'demand_level'  => 'Moderate',
                'icon'          => 'fa-atom',
                'roadmap'       => [
                    '12th – Science (PCM or PCB)',
                    'B.Sc in relevant field',
                    'M.Sc / M.Tech (2 years)',
                    'CSIR-NET / GATE / JRF fellowship',
                    'PhD Research – 4 to 5 years',
                    'Post-doctoral research or Scientist role in ISRO/DRDO/CSIR',
                ],
                'subjects'      => ['Physics', 'Chemistry', 'Biology', 'Mathematics', 'Environmental Science'],
            ],

            /* ── ARTS & HUMANITIES ── */
            [
                'name'          => 'Graphic Designer',
                'slug'          => 'graphic-designer',
                'field'         => 'arts-humanities',
                'description'   => 'Create visual content for brands, media and digital platforms. A thriving freelance and corporate career in India\'s booming creative economy.',
                'qualification' => '12th + BDes / Diploma',
                'stream'        => 'Arts / Any',
                'salary_range'  => '₹3L – ₹18L per annum',
                'demand_level'  => 'Growing',
                'icon'          => 'fa-pen-nib',
                'roadmap'       => [
                    '12th – Any stream',
                    'BDes / B.Sc Visual Communication / NIFT / NID entrance',
                    'Learn Adobe Suite, Figma, Canva',
                    'Build portfolio via freelance projects',
                    'Junior Designer → Senior Designer → Creative Lead',
                ],
                'subjects'      => ['Fine Arts', 'Drawing', 'Computer Science', 'English'],
            ],
            [
                'name'          => 'Journalist / Mass Media',
                'slug'          => 'journalist',
                'field'         => 'arts-humanities',
                'description'   => 'Report news, write articles and create multimedia content for print, digital and broadcast media across India.',
                'qualification' => 'BA / B.Sc Mass Media or Journalism',
                'stream'        => 'Arts / Any',
                'salary_range'  => '₹2.5L – ₹15L per annum',
                'demand_level'  => 'Moderate',
                'icon'          => 'fa-newspaper',
                'roadmap'       => [
                    '12th – Any stream (Arts preferred)',
                    'BA Journalism / BA Mass Media / BMM',
                    'Internship at newspaper / TV channel',
                    'Build bylines and portfolio',
                    'Junior Reporter → Senior Reporter → Editor',
                ],
                'subjects'      => ['English', 'Hindi', 'History', 'Political Science', 'Mass Media'],
            ],

            /* ── GOVERNMENT ── */
            [
                'name'          => 'UPSC Officer (IAS/IPS)',
                'slug'          => 'ias-officer',
                'field'         => 'traditional',
                'description'   => 'Serve the nation as an IAS, IPS, or IFS officer through the UPSC Civil Services Exam — India\'s most prestigious competitive examination.',
                'qualification' => 'Any Graduation + UPSC CSE',
                'stream'        => 'Any',
                'salary_range'  => '₹6L – ₹20L per annum',
                'demand_level'  => 'Stable',
                'icon'          => 'fa-landmark-dome',
                'roadmap'       => [
                    '12th – Any stream',
                    'Any Bachelor\'s Degree',
                    'UPSC CSE Prelims (General Studies + CSAT)',
                    'UPSC CSE Mains (9 papers)',
                    'Personality Test / Interview',
                    'IAS / IPS / IFS / Other All-India Services',
                    'Foundation Training at LBSNAA / State Academy',
                ],
                'subjects'      => ['History', 'Geography', 'Political Science', 'Economics', 'English'],
            ],

            /* ── BUSINESS ADMINISTRATION ── */
            [
                'name'          => 'MBA / Management Graduate',
                'slug'          => 'mba',
                'field'         => 'business',
                'description'   => 'Lead business operations, strategy and teams across corporate, consulting and entrepreneurship. MBA from IIMs opens top-tier opportunities.',
                'qualification' => 'Graduation + CAT/MAT/XAT',
                'stream'        => 'Any',
                'salary_range'  => '₹8L – ₹80L per annum',
                'demand_level'  => 'Very High',
                'icon'          => 'fa-briefcase',
                'roadmap'       => [
                    '12th – Any stream',
                    'Bachelor\'s Degree (Any)',
                    '2-3 years work experience (recommended)',
                    'CAT / XAT / MAT / GMAT entrance',
                    'MBA – 2 years (IIM / XLRI / FMS etc.)',
                    'Summer Internship placement',
                    'Manager / Consultant / Entrepreneur roles',
                ],
                'subjects'      => ['Mathematics', 'Economics', 'English', 'Business Studies', 'Entrepreneurship'],
            ],

            /* ── AGRICULTURE ── */
            [
                'name'          => 'Agricultural Officer',
                'slug'          => 'agricultural-officer',
                'field'         => 'agriculture',
                'description'   => 'Work with government departments and NGOs to improve agricultural practices, advise farmers and drive rural development in India.',
                'qualification' => 'B.Sc Agriculture',
                'stream'        => 'Science / Agriculture',
                'salary_range'  => '₹3L – ₹12L per annum',
                'demand_level'  => 'Stable',
                'icon'          => 'fa-seedling',
                'roadmap'       => [
                    '12th – Science / Agriculture stream',
                    'B.Sc Agriculture – 4 years (via ICAR / State exams)',
                    'M.Sc Agriculture for specialisation',
                    'ICAR-JRF / State PSC Agriculture exams',
                    'Agricultural Officer / Field Officer',
                ],
                'subjects'      => ['Agriculture', 'Biology', 'Chemistry', 'Environmental Science'],
            ],

            /* ── SKILL DEVELOPMENT ── */
            [
                'name'          => 'ITI Electrician',
                'slug'          => 'iti-electrician',
                'field'         => 'skill-development',
                'description'   => 'Skilled trade profession for wiring, electrical installations and maintenance in industrial / residential settings across India.',
                'qualification' => '10th + ITI Electrician Trade',
                'stream'        => 'Any (after 10th)',
                'salary_range'  => '₹2L – ₹8L per annum',
                'demand_level'  => 'High',
                'icon'          => 'fa-bolt',
                'roadmap'       => [
                    '10th – Pass with Science & Maths',
                    'ITI Electrician Trade – 2 years',
                    'NCVT Certificate',
                    'Apprenticeship in industries',
                    'Electrician / Wireman in industries / govt / private',
                    'Own electrical business',
                ],
                'subjects'      => ['Mathematics', 'Physics', 'Electronics'],
            ],

            /* ── SPORTS ── */
            [
                'name'          => 'Professional Athlete',
                'slug'          => 'professional-athlete',
                'field'         => 'sports',
                'description'   => 'Represent India in national and international sports competitions. Requires rigorous training, dedication and talent from an early age.',
                'qualification' => 'Level-based sports certifications + physical tests',
                'stream'        => 'Any (Physical Education)',
                'salary_range'  => '₹2L – ₹2Cr+ (highly variable)',
                'demand_level'  => 'Growing',
                'icon'          => 'fa-trophy',
                'roadmap'       => [
                    '10th / 12th – Physical Education as subject',
                    'District / State level competitions',
                    'Join Sports Authority of India (SAI) Centre',
                    'National-level tournaments',
                    'Trial for National teams / IPL / Pro Kabaddi',
                    'Sponsorships & brand endorsements',
                ],
                'subjects'      => ['Physical Education', 'Biology', 'Yoga'],
            ],
        ];

        foreach ($careers as $data) {
            $field = Field::where('slug', $data['field'])->first();
            if (! $field) {
                continue;
            }

            $career = Career::updateOrCreate(
                ['slug' => $data['slug']],
                [
                    'name'          => $data['name'],
                    'field_id'      => $field->id,
                    'description'   => $data['description'],
                    'qualification' => $data['qualification'],
                    'stream'        => $data['stream'],
                    'salary_range'  => $data['salary_range'],
                    'demand_level'  => $data['demand_level'],
                    'roadmap'       => $data['roadmap'],
                    'icon'          => $data['icon'],
                ]
            );

            // Attach subjects
            $subjectIds = Subject::whereIn('name', $data['subjects'])->pluck('id');
            $career->subjects()->sync($subjectIds);
        }
    }
}
