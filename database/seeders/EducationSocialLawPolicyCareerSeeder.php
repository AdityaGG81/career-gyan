<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Career;
use App\Models\Field;

class EducationSocialLawPolicyCareerSeeder extends Seeder
{
    public function run(): void
    {
        $fieldSlug = 'education-social-law-policy';
        $field = Field::where('slug', $fieldSlug)->first();

        if (!$field) {
            $this->command->error("Field '$fieldSlug' not found. Please run FieldsSeeder first.");
            return;
        }

        $careers = [
            [
                'slug' => 'primary-school-teacher',
                'name' => 'Primary School Teacher',
                'sub_domain' => 'School Teaching',
                'description' => 'Primary School Teachers teach young children basic subjects, language skills, values, creativity, and foundational learning concepts.',
                'salary_range' => '₹2.5L – ₹8L',
                'demand_level' => 'High',
                'qualification' => 'D.El.Ed / B.El.Ed / B.Ed with required eligibility',
                'stream' => 'Arts / Science / Commerce / Any Stream',
                'entrance_exams' => ['CTET', 'State TET', 'CUET', 'Teacher Recruitment Exams'],
                'skills' => ['Classroom Management', 'Communication', 'Child Psychology', 'Lesson Planning', 'Patience', 'Creativity'],
                'job_opportunities' => ['Government Schools', 'Private Schools', 'International Schools', 'NGOs', 'Coaching Centres'],
                'image' => 'images/careers/education-social-law-policy/primary-school-teacher.svg'
            ],
            [
                'slug' => 'secondary-school-teacher',
                'name' => 'Secondary School Teacher',
                'sub_domain' => 'School Teaching',
                'description' => 'Secondary School Teachers teach subject-specific topics to middle and high school students and prepare them for board exams and future studies.',
                'salary_range' => '₹3L – ₹10L',
                'demand_level' => 'High',
                'qualification' => 'Graduation + B.Ed / Integrated B.Ed',
                'stream' => 'Arts / Science / Commerce based on subject',
                'entrance_exams' => ['CTET', 'State TET', 'Teacher Recruitment Exams', 'CUET'],
                'skills' => ['Subject Knowledge', 'Lesson Planning', 'Student Assessment', 'Communication', 'Discipline Management'],
                'job_opportunities' => ['Government Schools', 'Private Schools', 'Junior Colleges', 'Coaching Institutes'],
                'image' => 'images/careers/education-social-law-policy/secondary-school-teacher.svg'
            ],
            [
                'slug' => 'assistant-professor',
                'name' => 'Assistant Professor',
                'sub_domain' => 'Higher Education & Academic Careers',
                'description' => 'Assistant Professors teach college students, conduct research, publish papers, guide projects, and contribute to academic development.',
                'salary_range' => '₹6L – ₹18L+',
                'demand_level' => 'High',
                'qualification' => 'Master’s Degree + UGC NET / SET / Ph.D preferred',
                'stream' => 'Subject-specific',
                'entrance_exams' => ['UGC NET', 'CSIR NET', 'SET', 'GATE', 'Ph.D Entrance Exams'],
                'skills' => ['Teaching', 'Research', 'Academic Writing', 'Presentation', 'Mentoring', 'Subject Expertise'],
                'job_opportunities' => ['Colleges', 'Universities', 'Research Institutes', 'Private Universities'],
                'image' => 'images/careers/education-social-law-policy/assistant-professor.svg'
            ],
            [
                'slug' => 'education-consultant',
                'name' => 'Education Consultant',
                'sub_domain' => 'Education Consulting & Counselling',
                'description' => 'Education Consultants guide students, schools, and institutions about academic planning, admissions, curriculum, and career pathways.',
                'salary_range' => '₹3L – ₹12L',
                'demand_level' => 'High',
                'qualification' => 'Graduation / B.Ed / Psychology / Education Management / MBA preferred',
                'stream' => 'Arts / Commerce / Science / Any Stream',
                'entrance_exams' => ['CUET', 'MBA Entrance Exams', 'Counselling Certifications'],
                'skills' => ['Career Guidance', 'Admission Knowledge', 'Communication', 'Research', 'Counselling', 'Planning'],
                'job_opportunities' => ['Education Consultancies', 'Schools', 'Colleges', 'Study Abroad Firms', 'EdTech Companies'],
                'image' => 'images/careers/education-social-law-policy/education-consultant.svg'
            ],
            [
                'slug' => 'instructional-designer',
                'name' => 'Instructional Designer',
                'sub_domain' => 'Instructional Design & E-Learning',
                'description' => 'Instructional Designers create structured learning content, courses, training modules, assessments, and digital learning experiences.',
                'salary_range' => '₹4L – ₹15L',
                'demand_level' => 'Very High',
                'qualification' => 'Degree in Education, Psychology, Communication, Instructional Design, or E-Learning',
                'stream' => 'Arts / Education / Psychology / Any Stream',
                'entrance_exams' => ['Certification Courses Preferred'],
                'skills' => ['Learning Design', 'Storyboarding', 'Content Writing', 'LMS Tools', 'Assessment Design', 'Communication'],
                'job_opportunities' => ['EdTech Companies', 'Corporate Training Teams', 'Universities', 'E-Learning Agencies'],
                'image' => 'images/careers/education-social-law-policy/instructional-designer.svg'
            ],
            [
                'slug' => 'e-learning-developer',
                'name' => 'E-Learning Developer',
                'sub_domain' => 'Instructional Design & E-Learning',
                'description' => 'E-Learning Developers build interactive online courses, simulations, quizzes, videos, and learning modules using digital tools.',
                'salary_range' => '₹3.5L – ₹12L',
                'demand_level' => 'High',
                'qualification' => 'Degree / Diploma in Multimedia, Education Technology, Computer Science, or E-Learning',
                'stream' => 'Arts / Science / Computer / Any Stream',
                'entrance_exams' => ['Skill Certifications Preferred'],
                'skills' => ['Articulate Storyline', 'Captivate', 'HTML Basics', 'LMS', 'Video Tools', 'Interactive Content Development'],
                'job_opportunities' => ['EdTech Companies', 'Corporate Training Firms', 'Universities', 'Online Course Platforms'],
                'image' => 'images/careers/education-social-law-policy/e-learning-developer.svg'
            ],
            [
                'slug' => 'education-technology-specialist',
                'name' => 'Education Technology Specialist',
                'sub_domain' => 'EdTech & Digital Learning',
                'description' => 'Education Technology Specialists integrate digital tools, LMS platforms, smart classrooms, and learning software into education systems.',
                'salary_range' => '₹4L – ₹16L',
                'demand_level' => 'Very High',
                'qualification' => 'B.Ed / B.Tech / Education Technology / Computer Science / EdTech Certification',
                'stream' => 'Science / Computer / Education / Any Stream',
                'entrance_exams' => ['CUET', 'B.Ed Entrance Exams', 'EdTech Certifications'],
                'skills' => ['LMS Management', 'Digital Teaching Tools', 'Training', 'Data Analysis', 'Technical Support', 'Curriculum Technology'],
                'job_opportunities' => ['EdTech Companies', 'Schools', 'Colleges', 'Universities', 'Education Startups'],
                'image' => 'images/careers/education-social-law-policy/education-technology-specialist.svg'
            ],
            [
                'slug' => 'school-administrator',
                'name' => 'School Administrator',
                'sub_domain' => 'School Leadership & Administration',
                'description' => 'School Administrators manage daily school operations, records, staff coordination, admissions, parent communication, and academic support systems.',
                'salary_range' => '₹3L – ₹10L',
                'demand_level' => 'High',
                'qualification' => 'Graduation / B.Ed / Education Administration / MBA preferred',
                'stream' => 'Any Stream',
                'entrance_exams' => ['CUET or MBA Entrance Exams'],
                'skills' => ['Administration', 'Communication', 'Record Management', 'Staff Coordination', 'Planning', 'Problem Solving'],
                'job_opportunities' => ['Schools', 'Junior Colleges', 'International Schools', 'Education Trusts'],
                'image' => 'images/careers/education-social-law-policy/school-administrator.svg'
            ],
            [
                'slug' => 'principal',
                'name' => 'Principal',
                'sub_domain' => 'School Leadership & Administration',
                'description' => 'Principals lead schools by managing academics, staff, discipline, admissions, parent relations, policies, and institutional development.',
                'salary_range' => '₹8L – ₹25L+',
                'demand_level' => 'High',
                'qualification' => 'Post Graduation + B.Ed / M.Ed with teaching and administrative experience',
                'stream' => 'Education / Any Subject',
                'entrance_exams' => ['Teacher Recruitment Exams', 'School Leadership Certifications'],
                'skills' => ['Leadership', 'Academic Planning', 'Decision Making', 'Staff Management', 'Communication', 'Policy Implementation'],
                'job_opportunities' => ['Government Schools', 'Private Schools', 'International Schools', 'Education Trusts'],
                'image' => 'images/careers/education-social-law-policy/principal.svg'
            ],
            [
                'slug' => 'admission-counsellor',
                'name' => 'Admission Counsellor',
                'sub_domain' => 'Education Consulting & Counselling',
                'description' => 'Admission Counsellors guide students and parents about courses, eligibility, fees, admissions, scholarships, and institution selection.',
                'salary_range' => '₹2.5L – ₹8L',
                'demand_level' => 'High',
                'qualification' => 'Graduation in Any Field, Counselling or Communication Certification preferred',
                'stream' => 'Any Stream',
                'entrance_exams' => ['None'],
                'skills' => ['Communication', 'Student Counselling', 'Course Knowledge', 'Follow-up Skills', 'CRM Tools', 'Persuasion'],
                'job_opportunities' => ['Schools', 'Colleges', 'Universities', 'Coaching Classes', 'EdTech Companies'],
                'image' => 'images/careers/education-social-law-policy/admission-counsellor.svg'
            ],
            [
                'slug' => 'student-mentor',
                'name' => 'Student Mentor',
                'sub_domain' => 'Student Support & Mentoring',
                'description' => 'Student Mentors support students in academic planning, confidence building, goal setting, exam preparation, and career decision-making.',
                'salary_range' => '₹2.5L – ₹9L',
                'demand_level' => 'High',
                'qualification' => 'Graduation / Psychology / Education / Career Counselling Certification preferred',
                'stream' => 'Any Stream',
                'entrance_exams' => ['Counselling Certification Programs'],
                'skills' => ['Mentoring', 'Communication', 'Motivation', 'Academic Planning', 'Emotional Support', 'Problem Solving'],
                'job_opportunities' => ['Schools', 'Colleges', 'Coaching Institutes', 'EdTech Companies', 'NGOs'],
                'image' => 'images/careers/education-social-law-policy/student-mentor.svg'
            ],
            [
                'slug' => 'child-development-specialist',
                'name' => 'Child Development Specialist',
                'sub_domain' => 'Child Development & Rehabilitation',
                'description' => 'Child Development Specialists study children’s growth, learning, behavior, emotional needs, and developmental challenges.',
                'salary_range' => '₹3L – ₹10L',
                'demand_level' => 'Moderate',
                'qualification' => 'Psychology / Child Development / Human Development / Early Childhood Education',
                'stream' => 'Arts / Psychology / Science',
                'entrance_exams' => ['CUET', 'University Entrance Exams', 'Psychology Entrance Exams'],
                'skills' => ['Child Psychology', 'Observation', 'Assessment', 'Parent Guidance', 'Communication', 'Development Planning'],
                'job_opportunities' => ['Schools', 'Child Development Centres', 'Hospitals', 'NGOs', 'Early Learning Centres'],
                'image' => 'images/careers/education-social-law-policy/child-development-specialist.svg'
            ],
            [
                'slug' => 'ngo-program-manager',
                'name' => 'NGO Program Manager',
                'sub_domain' => 'NGO, Social Work & Community Development',
                'description' => 'NGO Program Managers plan, implement, monitor, and evaluate social development projects for education, health, livelihood, and community welfare.',
                'salary_range' => '₹4L – ₹14L',
                'demand_level' => 'High',
                'qualification' => 'MSW / MBA / MA Development Studies / Public Policy / Social Work',
                'stream' => 'Arts / Social Work / Management',
                'entrance_exams' => ['CUET', 'TISS Entrance', 'University Entrance Exams'],
                'skills' => ['Project Management', 'Fundraising', 'Reporting', 'Community Work', 'Leadership', 'Monitoring & Evaluation'],
                'job_opportunities' => ['NGOs', 'CSR Foundations', 'International Development Agencies', 'Social Enterprises'],
                'image' => 'images/careers/education-social-law-policy/ngo-program-manager.svg'
            ],
            [
                'slug' => 'community-development-officer',
                'name' => 'Community Development Officer',
                'sub_domain' => 'NGO, Social Work & Community Development',
                'description' => 'Community Development Officers work with local communities to improve education, health, livelihood, social awareness, and welfare programs.',
                'salary_range' => '₹3L – ₹10L',
                'demand_level' => 'High',
                'qualification' => 'MSW / Sociology / Rural Development / Development Studies / Public Administration',
                'stream' => 'Arts / Social Work / Any Stream',
                'entrance_exams' => ['CUET', 'State PSC Exams', 'Rural Development Institute Exams'],
                'skills' => ['Community Mobilization', 'Communication', 'Field Work', 'Social Research', 'Program Implementation', 'Documentation'],
                'job_opportunities' => ['NGOs', 'Government Departments', 'CSR Projects', 'Rural Development Agencies'],
                'image' => 'images/careers/education-social-law-policy/community-development-officer.svg'
            ],
            [
                'slug' => 'rehabilitation-counsellor',
                'name' => 'Rehabilitation Counsellor',
                'sub_domain' => 'Child Development & Rehabilitation',
                'description' => 'Rehabilitation Counsellors support people with disabilities, injuries, emotional challenges, or social difficulties to improve independence and quality of life.',
                'salary_range' => '₹3L – ₹9L',
                'demand_level' => 'Moderate',
                'qualification' => 'Psychology / Rehabilitation Science / Social Work / Counselling Certification',
                'stream' => 'Arts / Psychology / Science',
                'entrance_exams' => ['CUET', 'University Entrance Exams', 'RCI-approved Course Admissions'],
                'skills' => ['Counselling', 'Empathy', 'Assessment', 'Rehabilitation Planning', 'Communication', 'Case Documentation'],
                'job_opportunities' => ['Rehabilitation Centres', 'Hospitals', 'NGOs', 'Special Schools', 'Mental Health Clinics'],
                'image' => 'images/careers/education-social-law-policy/rehabilitation-counsellor.svg'
            ],
            [
                'slug' => 'legal-advisor',
                'name' => 'Legal Advisor',
                'sub_domain' => 'Law, Legal Services & Court Support',
                'description' => 'Legal Advisors provide legal guidance to individuals, companies, institutions, and organizations on contracts, compliance, disputes, and regulations.',
                'salary_range' => '₹5L – ₹20L+',
                'demand_level' => 'High',
                'qualification' => 'LLB / BA LLB / BBA LLB',
                'stream' => 'Arts / Commerce / Any Stream',
                'entrance_exams' => ['CLAT', 'AILET', 'LSAT India', 'MHCET Law', 'State Law Entrance Exams'],
                'skills' => ['Legal Knowledge', 'Contract Drafting', 'Research', 'Communication', 'Compliance', 'Problem Solving'],
                'job_opportunities' => ['Companies', 'Law Firms', 'Banks', 'NGOs', 'Government Bodies'],
                'image' => 'images/careers/education-social-law-policy/legal-advisor.svg'
            ],
            [
                'slug' => 'paralegal',
                'name' => 'Paralegal',
                'sub_domain' => 'Law, Legal Services & Court Support',
                'description' => 'Paralegals assist lawyers by preparing documents, maintaining case files, doing legal research, and supporting court-related work.',
                'salary_range' => '₹2.5L – ₹8L',
                'demand_level' => 'Moderate',
                'qualification' => 'Paralegal Diploma / LLB / Legal Studies Certification',
                'stream' => 'Arts / Commerce / Any Stream',
                'entrance_exams' => ['Law Entrance Exams'],
                'skills' => ['Legal Documentation', 'Research', 'Filing', 'Communication', 'Case Management', 'Attention to Detail'],
                'job_opportunities' => ['Law Firms', 'Corporate Legal Departments', 'Courts', 'NGOs', 'Legal Aid Centres'],
                'image' => 'images/careers/education-social-law-policy/paralegal.svg'
            ],
            [
                'slug' => 'legal-researcher',
                'name' => 'Legal Researcher',
                'sub_domain' => 'Law, Legal Services & Court Support',
                'description' => 'Legal Researchers study laws, judgments, cases, policies, and legal documents to support lawyers, courts, companies, and academic work.',
                'salary_range' => '₹3L – ₹12L',
                'demand_level' => 'High',
                'qualification' => 'LLB / LLM / Legal Studies / Public Policy',
                'stream' => 'Arts / Commerce / Law',
                'entrance_exams' => ['CLAT', 'AILET', 'LSAT India', 'CUET PG', 'LLM Entrance Exams'],
                'skills' => ['Legal Research', 'Case Analysis', 'Writing', 'Critical Thinking', 'Policy Understanding', 'Documentation'],
                'job_opportunities' => ['Law Firms', 'Courts', 'Think Tanks', 'Universities', 'Corporate Legal Teams'],
                'image' => 'images/careers/education-social-law-policy/legal-researcher.svg'
            ],
            [
                'slug' => 'court-clerk',
                'name' => 'Court Clerk',
                'sub_domain' => 'Law, Legal Services & Court Support',
                'description' => 'Court Clerks maintain court records, manage case files, assist judges and lawyers, handle documentation, and support court administration.',
                'salary_range' => '₹2.5L – ₹7L',
                'demand_level' => 'Moderate',
                'qualification' => 'Graduation / Law-related Diploma / Computer Skills',
                'stream' => 'Any Stream',
                'entrance_exams' => ['Court Recruitment Exams', 'State Judiciary Staff Exams'],
                'skills' => ['Documentation', 'Record Keeping', 'Typing', 'Legal Procedures', 'Attention to Detail', 'Office Administration'],
                'job_opportunities' => ['District Courts', 'High Courts', 'Tribunals', 'Government Judicial Offices'],
                'image' => 'images/careers/education-social-law-policy/court-clerk.svg'
            ],
            [
                'slug' => 'notary-officer',
                'name' => 'Notary Officer',
                'sub_domain' => 'Law, Legal Services & Court Support',
                'description' => 'Notary Officers authenticate legal documents, verify signatures, witness declarations, and certify affidavits and agreements.',
                'salary_range' => '₹3L – ₹12L+',
                'demand_level' => 'Moderate',
                'qualification' => 'LLB with legal practice experience as per government rules',
                'stream' => 'Law',
                'entrance_exams' => ['Bar Council Registration'],
                'skills' => ['Legal Verification', 'Documentation', 'Ethics', 'Attention to Detail', 'Client Handling', 'Legal Procedure Knowledge'],
                'job_opportunities' => ['Legal Practice', 'Law Offices', 'Courts', 'Government-Authorized Notary Services'],
                'image' => 'images/careers/education-social-law-policy/notary-officer.svg'
            ],
            [
                'slug' => 'mediator',
                'name' => 'Mediator',
                'sub_domain' => 'Mediation & Dispute Resolution',
                'description' => 'Mediators help parties resolve conflicts through structured discussion, negotiation, and peaceful dispute resolution without lengthy court processes.',
                'salary_range' => '₹3L – ₹15L+',
                'demand_level' => 'Moderate',
                'qualification' => 'LLB / Psychology / Social Work / Mediation Certification',
                'stream' => 'Law / Psychology / Social Work / Any Stream',
                'entrance_exams' => ['Mediation Certification Programs'],
                'skills' => ['Negotiation', 'Listening', 'Neutrality', 'Conflict Resolution', 'Communication', 'Emotional Intelligence'],
                'job_opportunities' => ['Courts', 'Mediation Centres', 'Law Firms', 'Family Counselling Centres', 'NGOs'],
                'image' => 'images/careers/education-social-law-policy/mediator.svg'
            ],
            [
                'slug' => 'policy-analyst',
                'name' => 'Policy Analyst',
                'sub_domain' => 'Public Policy, Governance & Human Rights',
                'description' => 'Policy Analysts research public issues, study data, evaluate government programs, and recommend policy improvements.',
                'salary_range' => '₹5L – ₹18L',
                'demand_level' => 'High',
                'qualification' => 'Public Policy / Economics / Political Science / Sociology / Law / Development Studies',
                'stream' => 'Arts / Commerce / Law / Social Sciences',
                'entrance_exams' => ['CUET', 'TISS Entrance', 'JNU Entrance', 'Public Policy Institute Exams'],
                'skills' => ['Research', 'Data Analysis', 'Policy Writing', 'Critical Thinking', 'Communication', 'Governance Understanding'],
                'job_opportunities' => ['Think Tanks', 'Government Bodies', 'NGOs', 'International Organizations', 'Consulting Firms'],
                'image' => 'images/careers/education-social-law-policy/policy-analyst.svg'
            ],
            [
                'slug' => 'urban-governance-specialist',
                'name' => 'Urban Governance Specialist',
                'sub_domain' => 'Environmental & Urban Policy',
                'description' => 'Urban Governance Specialists work on city planning, municipal systems, public services, urban reforms, smart cities, and local governance projects.',
                'salary_range' => '₹5L – ₹18L',
                'demand_level' => 'High',
                'qualification' => 'Urban Planning / Public Policy / Public Administration / Civil Engineering / Development Studies',
                'stream' => 'Arts / Engineering / Social Sciences',
                'entrance_exams' => ['GATE', 'CUET PG', 'CEPT Entrance', 'Public Policy Institute Exams'],
                'skills' => ['Urban Planning', 'Governance', 'Data Analysis', 'Stakeholder Coordination', 'Project Management', 'Policy Writing'],
                'job_opportunities' => ['Municipal Corporations', 'Smart City Missions', 'Urban Planning Firms', 'Think Tanks'],
                'image' => 'images/careers/education-social-law-policy/urban-governance-specialist.svg'
            ],
            [
                'slug' => 'environmental-policy-analyst',
                'name' => 'Environmental Policy Analyst',
                'sub_domain' => 'Environmental & Urban Policy',
                'description' => 'Environmental Policy Analysts study environmental laws, climate issues, sustainability programs, pollution control, and conservation policies.',
                'salary_range' => '₹4L – ₹16L',
                'demand_level' => 'High',
                'qualification' => 'Environmental Science / Public Policy / Law / Geography / Sustainability Studies',
                'stream' => 'Science / Arts / Law',
                'entrance_exams' => ['CUET', 'GATE', 'University Entrance Exams', 'Public Policy Entrance Exams'],
                'skills' => ['Environmental Research', 'Policy Analysis', 'Climate Knowledge', 'Data Interpretation', 'Report Writing', 'Sustainability Planning'],
                'job_opportunities' => ['Government Departments', 'NGOs', 'Climate Organizations', 'Think Tanks', 'CSR Foundations'],
                'image' => 'images/careers/education-social-law-policy/environmental-policy-analyst.svg'
            ],
            [
                'slug' => 'human-rights-officer',
                'name' => 'Human Rights Officer',
                'sub_domain' => 'Public Policy, Governance & Human Rights',
                'description' => 'Human Rights Officers work to protect rights, investigate violations, support vulnerable groups, prepare reports, and promote social justice.',
                'salary_range' => '₹4L – ₹15L',
                'demand_level' => 'Moderate',
                'qualification' => 'Law / Human Rights / Political Science / Social Work / International Relations',
                'stream' => 'Arts / Law / Social Sciences',
                'entrance_exams' => ['CUET', 'Law Entrance Exams', 'University Entrance Exams'],
                'skills' => ['Human Rights Law', 'Research', 'Advocacy', 'Communication', 'Documentation', 'Field Investigation', 'Empathy'],
                'job_opportunities' => ['Human Rights Commissions', 'NGOs', 'International Organizations', 'Legal Aid Groups', 'Government Bodies'],
                'image' => 'images/careers/education-social-law-policy/human-rights-officer.svg'
            ]
        ];

        $futureScopeCommon = "Education, Social, Law & Policy careers are essential for societal growth, governance, and justice. They offer meaningful paths for individuals dedicated to social impact, teaching, and legal advocacy.";

        foreach ($careers as $careerData) {
            $roadmap = [
                "Step 1: Complete 10+2 in any stream (Arts/Social Science/Commerce preferred).",
                "Step 2: Pursue a relevant Degree or Diploma (B.Ed/LLB/MSW/MA) based on the chosen path.",
                "Step 3: Clear mandatory eligibility tests (CTET/NET/CLAT/AIBE) as per the profession.",
                "Step 4: Gain practical experience through internships, teaching practice, or legal clerkships.",
                "Step 5: Build a strong network and expertise in niche areas like EdTech, Corporate Law, or Policy Research.",
                "Step 6: Advance to leadership roles (Principal, Senior Partner, Program Director) or contribute to global policy initiatives."
            ];

            Career::updateOrCreate(
                ['slug' => $careerData['slug']],
                array_merge($careerData, [
                    'field_id' => $field->id,
                    'roadmap' => $roadmap,
                    'future_scope' => $futureScopeCommon . "\n\nNote: This sector values empathy, critical thinking, and a deep understanding of human and legal systems."
                ])
            );
        }

        $this->command->info('Education, Social, Law & Policy careers seeded successfully.');
    }
}
