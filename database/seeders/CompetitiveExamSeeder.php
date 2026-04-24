<?php

namespace Database\Seeders;

use App\Models\CompetitiveExam;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompetitiveExamSeeder extends Seeder
{
    public function run(): void
    {
        $exams = [
            [
                'name' => 'UPSC Civil Services Examination',
                'category' => 'Government Exams',
                'conducting_body' => 'Union Public Service Commission (UPSC)',
                'purpose' => 'Selection for IAS, IPS, IFS, and other Group A services.',
                'eligibility' => 'Any Graduate (Degree from recognized University)',
                'age_limit' => '21 - 32 years (Relaxation for OBC/SC/ST)',
                'exam_pattern' => 'Three Stages: Prelims (Objective), Mains (Descriptive), and Personality Test (Interview).',
                'difficulty_level' => 'Very High',
                'career_outcome' => 'High-ranking Bureaucrat, Administrator, or Police Officer. Salary: ₹56,100 - ₹2,50,000+ PM.',
                'description' => 'The toughest and most prestigious exam in India for those who want to serve the nation at the highest level of administration.',
                'roadmap' => [
                    'Foundation: Understand the syllabus and NCERT basics (6-12 months)',
                    'Standard Books: Master subjects like History, Polity, Geography, and Economy',
                    'Current Affairs: Daily Newspaper reading and monthly compilations',
                    'Prelims Focus: Practice 50+ Mock Tests and PYQs',
                    'Mains Focus: Answer writing practice and Optional subject mastery',
                    'Interview: Personality development and mock interviews'
                ],
                'prep_tips' => [
                    'Consistency is more important than number of hours',
                    'Make concise notes for multiple revisions',
                    'Analyze previous years papers to understand trend',
                    'Do not ignore CSAT (Prelims Paper 2)',
                    'Choose an Optional subject you are passionate about'
                ],
                'icon' => 'fa-landmark-flag'
            ],
            [
                'name' => 'IBPS PO (Probationary Officer)',
                'category' => 'Banking Exams',
                'conducting_body' => 'Institute of Banking Personnel Selection',
                'purpose' => 'Recruitment for officers in Public Sector Banks.',
                'eligibility' => 'Any Graduate',
                'age_limit' => '20 - 30 years',
                'exam_pattern' => 'Prelims (Online Obj), Mains (Online Obj + Des), and Interview.',
                'difficulty_level' => 'High',
                'career_outcome' => 'Bank Officer with rapid promotion to Management roles. Salary: ₹52,000 - ₹65,000 PM.',
                'description' => 'A fast-track career path in the banking sector with job security and excellent growth potential.',
                'roadmap' => [
                    'Speed & Accuracy: Practice Vedic Maths and mental calculation',
                    'Sections: Master Reasoning, Quant, and English separately',
                    'General Awareness: Focus on Banking Awareness and Economy news',
                    'Mock Tests: Take daily sectional tests and weekly full mocks',
                    'Mains Writing: Practice letter and essay writing'
                ],
                'prep_tips' => [
                    'Solve 50+ puzzles and 50+ DIs every week',
                    'Focus on high-weightage topics like Data Interpretation',
                    'Read economic times or financial express regularly',
                    'Maintain a high accuracy rate even if you attempt fewer questions'
                ],
                'icon' => 'fa-building-columns'
            ],
            [
                'name' => 'JEE Advanced',
                'category' => 'Entrance Exams',
                'conducting_body' => 'One of the seven IITs (on behalf of JAB)',
                'purpose' => 'Admission to Undergraduate Engineering programs in IITs.',
                'eligibility' => '12th Pass with PCM + Top rankers of JEE Main',
                'age_limit' => 'Max 25 years (Relaxation applies)',
                'exam_pattern' => 'Two Papers (Computer Based), both mandatory. Questions are highly conceptual.',
                'difficulty_level' => 'Very High',
                'career_outcome' => 'Software Engineer, Researcher, Scientist, or Entrepreneur from world-class IITs.',
                'description' => 'Considered one of the most difficult engineering entrance exams globally, testing deep conceptual clarity.',
                'roadmap' => [
                    'Concepts: Build 11th & 12th Physics, Chemistry, Maths foundation',
                    'Problem Solving: Solve Irodov for Physics and Arihant/Cengage for Maths',
                    'Mock Tests: Intense practice of previous year JEE Advanced papers',
                    'Analysis: Identify weak topics after every test and re-read theory'
                ],
                'prep_tips' => [
                    'Physics: Focus on Mechanics and Electrodynamics',
                    'Maths: Practice Calculus and Coordinate Geometry daily',
                    'Chemistry: Inorganic requires regular revision; Organic needs logic',
                    'Health: Manage stress and sleep well during the final month'
                ],
                'icon' => 'fa-atom'
            ],
            [
                'name' => 'NDA (National Defence Academy)',
                'category' => 'Defence Exams',
                'conducting_body' => 'UPSC',
                'purpose' => 'Entry into Army, Navy, and Air Force as Officers.',
                'eligibility' => '12th Pass (PCM for Navy/Air Force)',
                'age_limit' => '16.5 - 19.5 years',
                'exam_pattern' => 'Written Exam (Maths + GAT) followed by SSB Interview (5 Days).',
                'difficulty_level' => 'High',
                'career_outcome' => 'Lieutenant in Indian Army or equivalent. Prestigious life and adventure. Salary: ₹56,100+.',
                'description' => 'The premier joint services training institution of the Indian Armed Forces.',
                'roadmap' => [
                    'Maths: Master 11th-12th Maths topics (300 Marks paper)',
                    'English & GS: Improve vocabulary and Basic Science/SST knowledge',
                    'Physical Fitness: Start running and basic bodyweight exercises',
                    'SSB Preparation: Work on communication skills and leadership traits'
                ],
                'prep_tips' => [
                    'Maths is the deciding factor; do not ignore it',
                    'Be honest and confident for the SSB interview',
                    'Stay updated with world affairs for the GD rounds',
                    'Practice mental stamina for the 5-day selection process'
                ],
                'icon' => 'fa-shield-halved'
            ],
            [
                'name' => 'MPSC State Services',
                'category' => 'Police Exams',
                'conducting_body' => 'Maharashtra Public Service Commission',
                'purpose' => 'Recruitment for DySP, ACP, and other State Gazetted posts.',
                'eligibility' => 'Any Graduate (Marathi language knowledge required)',
                'age_limit' => '19 - 38 years (Relaxation for categories)',
                'exam_pattern' => 'Prelims (Objective), Mains (Descriptive), and Interview.',
                'difficulty_level' => 'High',
                'career_outcome' => 'Deputy Collector, DySP, Tehsildar. Powerful role in state governance.',
                'description' => 'The gateway for those wanting to serve in the Maharashtra State Government administration.',
                'roadmap' => [
                    'Language: Master Marathi and English grammar',
                    'State History: Deep dive into Maharashtra\'s history and geography',
                    'Mains Preparation: Selective reading of GS1 to GS4 topics',
                    'Test Series: Regular practice of descriptive answer writing'
                ],
                'prep_tips' => [
                    'Read the MPSC specific state board books',
                    'Watch local news and stay updated with state government schemes',
                    'Practice Marathi typing if required for specific posts',
                    'Focus on accuracy in the Prelims CSAT paper'
                ],
                'icon' => 'fa-person-military-pointing'
            ],
            [
                'name' => 'Chartered Accountancy (CA)',
                'category' => 'Professional Exams',
                'conducting_body' => 'The Institute of Chartered Accountants of India (ICAI)',
                'purpose' => 'Becoming a certified Chartered Accountant.',
                'eligibility' => '12th Pass (for Foundation) or Graduate (for Direct Entry)',
                'age_limit' => 'No upper age limit',
                'exam_pattern' => 'Three Levels: Foundation, Intermediate, and Final + Articleship training.',
                'difficulty_level' => 'Very High',
                'career_outcome' => 'Auditor, Financial Consultant, or Tax Expert. Salary: ₹8L - ₹25L+ PA.',
                'description' => 'One of the most respected professional certifications globally for finance and accounting.',
                'roadmap' => [
                    'Foundation: Build strong Accounting and Law basics',
                    'Intermediate: Clear Group 1 and Group 2 with 8 months study',
                    'Articleship: 2-3 years of practical training under a practicing CA',
                    'Final: Toughest level; focus on SFM, FR, and Taxation'
                ],
                'prep_tips' => [
                    'Focus on ICAI Study Material strictly',
                    'Multiple revisions (at least 3) are mandatory',
                    'Practice Mock Test Papers (MTP) and Revision Test Papers (RTP)',
                    'Conceptual clarity is more important than rote learning'
                ],
                'icon' => 'fa-file-invoice-dollar'
            ]
        ];

        foreach ($exams as $exam) {
            CompetitiveExam::updateOrCreate(
                ['slug' => Str::slug($exam['name'])],
                $exam
            );
        }
    }
}
