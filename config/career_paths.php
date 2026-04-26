<?php

return [
    // -----------------------------------------------------
    // BATCH 1: Original 12 Streams
    // -----------------------------------------------------
    'arts-humanities' => [
        'title' => 'Arts & Humanities',
        'description' => 'A comprehensive guide to courses and career opportunities in Arts & Humanities.',
        'theme_color' => '#6366f1',
        'gradient' => 'linear-gradient(135deg, #6366f1 0%, #a855f7 100%)',
        'icon' => 'fa-masks-theater',
        'roadmap' => [
            'after_10th' => 'Choose Arts stream in 11th/12th (History, Geography, Political Science, Psychology). Focus on reading and writing skills.',
            'after_12th' => 'Pursue a BA degree in your chosen specialization (English, Psychology, Political Science, etc.). Participate in debates, writing, and internships.',
            'after_grad' => 'Opt for MA, specialized PG Diplomas, B.Ed for teaching, or start preparing for competitive exams like UPSC/MPSC. Build a strong portfolio for creative fields.'
        ],
        'opportunities' => [
            'Mumbai: Hub for Media, Journalism, and Advertising.',
            'Pune: Excellent for UPSC/MPSC preparation and higher education (Oxford of the East).',
            'Government: High scope in state administration and public services.'
        ],
        'subjects' => [
            [
                'name' => 'English / Literature',
                'icon' => 'fa-book-open',
                'image' => 'images/career-path/arts/english-literature.jpg',
                'courses' => ['BA English', 'MA English', 'Journalism', 'Mass Communication'],
                'careers' => ['Content Writer', 'Journalist', 'Editor / Publisher', 'Digital Marketer', 'Script Writer'],
                'skills' => ['Communication', 'Creativity', 'Critical Thinking'],
                'scope' => 'Strong communication & creativity lead to high demand in media & corporate sectors.',
            ],
            [
                'name' => 'Psychology',
                'icon' => 'fa-brain',
                'image' => 'images/career-path/arts/psychology.jpg',
                'courses' => ['BA Psychology', 'MA Psychology', 'Specialization (Clinical/Child)'],
                'careers' => ['Clinical Psychologist', 'Counsellor', 'HR / Organizational', 'Career Coach', 'UX Researcher'],
                'skills' => ['Empathy', 'Analytical Thinking', 'Active Listening'],
                'scope' => 'Fast-growing field in India due to rising mental health awareness.',
            ],
            [
                'name' => 'Political Science',
                'icon' => 'fa-landmark',
                'image' => 'images/career-path/arts/political-science.jpg',
                'courses' => ['BA Political Science', 'Public Administration'],
                'careers' => ['Civil Services (UPSC/MPSC)', 'Political Analyst', 'Diplomat', 'Policy Advisor', 'Election Strategist'],
                'skills' => ['Analytical Skills', 'Debating', 'Knowledge of Law'],
                'scope' => 'Best option for government jobs and UPSC preparation.',
            ]
        ],
    ],

    'commerce' => [
        'title' => 'Commerce & Finance',
        'description' => 'Explore professional pathways in business, finance, and trade.',
        'theme_color' => '#10b981',
        'gradient' => 'linear-gradient(135deg, #047857 0%, #10b981 100%)',
        'icon' => 'fa-coins',
        'roadmap' => [
            'after_10th' => 'Choose Commerce stream (with or without Math). Math is recommended for premium finance/economics careers.',
            'after_12th' => 'Pursue B.Com, BBA, or start professional courses like CA, CS, or CMA Foundation alongside graduation.',
            'after_grad' => 'Complete professional degrees (CA/CS), pursue MBA in Finance, or obtain certifications like CFA/FRM for investment banking.'
        ],
        'opportunities' => [
            'Mumbai: The financial capital of India (BSE, RBI, corporate headquarters) offers unmatched opportunities.',
            'Pune: Growing hub for finance KPOs and banking back-offices.',
            'Global: High demand for Indian CAs and finance professionals in the Middle East and UK.'
        ],
        'subjects' => [
            [
                'name' => 'Chartered Accountancy (CA)',
                'icon' => 'fa-calculator',
                'image' => 'images/career-path/commerce/ca.jpg',
                'courses' => ['CA Foundation', 'CA Intermediate', 'CA Final'],
                'careers' => ['Auditor', 'Tax Consultant', 'Financial Controller', 'Chief Financial Officer (CFO)'],
                'skills' => ['Accounting', 'Taxation', 'Analytical Thinking'],
                'scope' => 'Evergreen profession with excellent earning potential globally.',
            ],
            [
                'name' => 'Finance & Banking',
                'icon' => 'fa-building-columns',
                'image' => 'images/career-path/commerce/finance-banking.jpg',
                'courses' => ['B.Com (Banking & Insurance)', 'BBA Finance', 'MBA Finance'],
                'careers' => ['Investment Banker', 'Loan Officer', 'Risk Analyst', 'Wealth Manager'],
                'skills' => ['Financial Modeling', 'Risk Assessment', 'Sales'],
                'scope' => 'High-growth sector driven by fintech and economic expansion.',
            ]
        ],
    ],

    'science' => [
        'title' => 'Science (Pure & Applied)',
        'description' => 'A structured guide for students pursuing careers in physical, chemical, and biological sciences.',
        'theme_color' => '#06b6d4',
        'gradient' => 'linear-gradient(135deg, #0891b2 0%, #06b6d4 100%)',
        'icon' => 'fa-flask',
        'roadmap' => [
            'after_10th' => 'Choose Science (PCM or PCB based on interest). Focus heavily on core concepts.',
            'after_12th' => 'Pursue B.Sc in core subjects (Physics, Chemistry, Math, Biology) or integrated M.Sc programs.',
            'after_grad' => 'Go for M.Sc, clear NET/GATE for research/teaching, or pursue Ph.D. in specialized fields.'
        ],
        'opportunities' => [
            'Pune: Research hubs like NCL (National Chemical Laboratory) and IISER.',
            'Mumbai: BARC and TIFR offer premier research opportunities.',
            'Pharma Hubs: Booming chemical and biological research in Maharashtra’s industrial belts.'
        ],
        'subjects' => [
            [
                'name' => 'Physics',
                'icon' => 'fa-atom',
                'image' => 'images/career-path/science/physics.jpg',
                'courses' => ['B.Sc Physics', 'M.Sc Physics', 'Ph.D.'],
                'careers' => ['Research Scientist', 'Astrophysicist', 'Data Analyst', 'Professor'],
                'skills' => ['Mathematics', 'Analytical Problem Solving', 'Research'],
                'scope' => 'Opportunities in ISRO, DRDO, academia, and tech companies.',
            ],
            [
                'name' => 'Chemistry',
                'icon' => 'fa-vial',
                'image' => 'images/career-path/science/chemistry.jpg',
                'courses' => ['B.Sc Chemistry', 'M.Sc Chemistry', 'Analytical Chemistry'],
                'careers' => ['Chemical Engineer', 'Pharmacologist', 'Toxicologist', 'Forensic Scientist'],
                'skills' => ['Lab Techniques', 'Data Analysis', 'Attention to Detail'],
                'scope' => 'High demand in pharmaceuticals, FMCG, and material science.',
            ],
            [
                'name' => 'Biology / Life Sciences',
                'icon' => 'fa-dna',
                'image' => 'images/career-path/science/biology.jpg',
                'courses' => ['B.Sc Botany/Zoology', 'Biotechnology', 'Microbiology'],
                'careers' => ['Biotechnologist', 'Microbiologist', 'Environmental Scientist', 'Geneticist'],
                'skills' => ['Research', 'Lab Analysis', 'Bio-informatics'],
                'scope' => 'Booming sector post-pandemic, especially in genetics and pharma.',
            ]
        ],
    ],

    'technology-engineering' => [
        'title' => 'Technology & Engineering',
        'description' => 'A guide to engineering disciplines and the ever-evolving tech industry.',
        'theme_color' => '#3b82f6',
        'gradient' => 'linear-gradient(135deg, #1d4ed8 0%, #3b82f6 100%)',
        'icon' => 'fa-microchip',
        'roadmap' => [
            'after_10th' => 'Opt for Science (PCM). Prepare for JEE Main/Advanced or state CETs.',
            'after_12th' => 'Clear entrance exams to secure admission in B.Tech/B.E. Participate in hackathons and build projects.',
            'after_grad' => 'Join the IT sector, core engineering firms, or pursue M.Tech/MS abroad or MBA for management.'
        ],
        'opportunities' => [
            'Pune & Mumbai: Major IT parks (Hinjewadi, Magarpatta, Airoli) hosting TCS, Infosys, Tech Mahindra.',
            'Manufacturing: Pimpri-Chinchwad (PCMC) is the auto-manufacturing hub (Tata Motors, Bajaj) for mechanical engineers.',
            'Startups: High venture capital funding available for tech startups.'
        ],
        'subjects' => [
            [
                'name' => 'Computer Science & IT',
                'icon' => 'fa-laptop-code',
                'image' => 'images/career-path/engineering/computer-science.jpg',
                'courses' => ['B.Tech CSE', 'BCA', 'MCA'],
                'careers' => ['Software Engineer', 'Full Stack Developer', 'Cloud Architect', 'Cybersecurity Analyst'],
                'skills' => ['Coding (Python, Java, C++)', 'System Design', 'Problem Solving'],
                'scope' => 'Highest paying and most in-demand sector globally.',
            ]
        ],
    ],

    'medical' => [
        'title' => 'Medical & Healthcare',
        'description' => 'Comprehensive guide to careers in medicine, surgery, and allied healthcare.',
        'theme_color' => '#ef4444',
        'gradient' => 'linear-gradient(135deg, #b91c1c 0%, #ef4444 100%)',
        'icon' => 'fa-user-doctor',
        'roadmap' => [
            'after_10th' => 'Choose Science (PCB). Start preparing for NEET-UG early.',
            'after_12th' => 'Clear NEET and pursue MBBS, BDS, or allied medical courses. Maintain intense focus on studies and clinicals.',
            'after_grad' => 'Prepare for NEET-PG/NEXT to pursue MD/MS specializations, or start clinical practice/hospital residency.'
        ],
        'opportunities' => [
            'Top Hospitals: Lilavati, Hinduja (Mumbai), Ruby Hall, Sahyadri (Pune).',
            'Government: Robust public health infrastructure needing medical officers.',
            'Research: Clinical research organizations based heavily in Maharashtra.'
        ],
        'subjects' => [
            [
                'name' => 'Allopathic Medicine (MBBS)',
                'icon' => 'fa-stethoscope',
                'image' => 'images/career-path/medical/mbbs.jpg',
                'courses' => ['MBBS', 'MD / MS'],
                'careers' => ['General Physician', 'Surgeon', 'Specialist (Cardio, Neuro, etc.)'],
                'skills' => ['Clinical Knowledge', 'Empathy', 'Decision Making'],
                'scope' => 'Highest respect, massive demand, but requires long years of study.',
            ],
            [
                'name' => 'Dental Sciences',
                'icon' => 'fa-tooth',
                'image' => 'images/career-path/medical/dental.jpg',
                'courses' => ['BDS', 'MDS'],
                'careers' => ['Dentist', 'Orthodontist', 'Oral Surgeon'],
                'skills' => ['Precision', 'Dexterity', 'Patient Care'],
                'scope' => 'Lucrative private practice potential and cosmetic dentistry.',
            ]
        ],
    ],

    'business' => [
        'title' => 'Business Administration & Management',
        'description' => 'Guide to leadership, management, and operational careers.',
        'theme_color' => '#f59e0b',
        'gradient' => 'linear-gradient(135deg, #b45309 0%, #f59e0b 100%)',
        'icon' => 'fa-briefcase',
        'roadmap' => [
            'after_10th' => 'Any stream (Commerce/Arts/Science). Focus on communication and leadership extracurriculars.',
            'after_12th' => 'Pursue BBA, BMS, or B.Com. Engage in internships, case study competitions, and organizational roles.',
            'after_grad' => 'Crack CAT/CET/GMAT for premium MBA programs. Specialize in HR, Marketing, or Finance.'
        ],
        'opportunities' => [
            'Corporate Hubs: Mumbai (BKC, Lower Parel) houses headquarters of top MNCs and Indian conglomerates.',
            'Consulting: Big 4 and MBB firms hire heavily from top MBA institutes like JBIMS (Mumbai).',
            'Startups: Operations and marketing roles in booming e-commerce ecosystems.'
        ],
        'subjects' => [
            [
                'name' => 'Marketing & Sales',
                'icon' => 'fa-bullhorn',
                'image' => 'images/career-path/business/marketing.jpg',
                'courses' => ['BBA Marketing', 'MBA Marketing', 'Digital Marketing'],
                'careers' => ['Marketing Manager', 'Brand Manager', 'Sales Director', 'Digital Marketer'],
                'skills' => ['Communication', 'Creativity', 'Data Analysis'],
                'scope' => 'Every business needs marketing; highly dynamic and rewarding.',
            ]
        ],
    ],

    'skill-development' => [
        'title' => 'Skill Development & Vocational',
        'description' => 'Fast-track career paths focusing on specific, employable skills.',
        'theme_color' => '#8b5cf6',
        'gradient' => 'linear-gradient(135deg, #6d28d9 0%, #8b5cf6 100%)',
        'icon' => 'fa-hammer',
        'roadmap' => [
            'after_10th' => 'Opt for ITI or diploma courses if you want to start earning early.',
            'after_12th' => 'Enroll in short-term bootcamps (UI/UX, Digital Marketing, Coding) alongside a regular or distance degree.',
            'after_grad' => 'Upskill constantly. Build a strong portfolio and leverage platforms like LinkedIn for opportunities.'
        ],
        'opportunities' => [
            'Agency Work: High demand in advertising agencies in Mumbai.',
            'Tech Hubs: Pune IT parks hire heavily for skilled UX designers and digital marketers.',
            'Freelancing: Global client access from anywhere.'
        ],
        'subjects' => [
            [
                'name' => 'Digital Marketing',
                'icon' => 'fa-hashtag',
                'image' => 'images/career-path/skill-development/digital-marketing.jpg',
                'courses' => ['SEO/SEM Certification', 'Social Media Marketing', 'Performance Marketing'],
                'careers' => ['SEO Specialist', 'Social Media Manager', 'Performance Marketer'],
                'skills' => ['Analytics', 'Copywriting', 'Ad Management'],
                'scope' => 'Extremely high demand; low barrier to entry.',
            ]
        ],
    ],

    'sports' => [
        'title' => 'Sports & Physical Education',
        'description' => 'Careers built around physical fitness, sports management, and athletics.',
        'theme_color' => '#f97316',
        'gradient' => 'linear-gradient(135deg, #c2410c 0%, #f97316 100%)',
        'icon' => 'fa-medal',
        'roadmap' => [
            'after_10th' => 'Join state-level academies. Balance basic education with intense daily training.',
            'after_12th' => 'Pursue BPED (Physical Education) or Sports Science degrees. Attempt national level selections.',
            'after_grad' => 'Transition to professional leagues, coaching (NIS), or sports management (MBA Sports).'
        ],
        'opportunities' => [
            'Leagues: ISL, PKL, and local cricket leagues offer strong exposure.',
            'Infrastructure: Balewadi Stadium (Pune) and various Mumbai gymkhanas provide world-class training.',
            'Corporate Sports: Management roles in sports academies and franchises.'
        ],
        'subjects' => [
            [
                'name' => 'Professional Athletics',
                'icon' => 'fa-person-running',
                'image' => 'images/career-path/sports/athletics.jpg',
                'courses' => ['Sports Academy Training', 'NIS Certification'],
                'careers' => ['Professional Athlete', 'National Player', 'Olympian'],
                'skills' => ['Physical Endurance', 'Discipline', 'Mental Toughness'],
                'scope' => 'Highly competitive; requires early start and dedication.',
            ]
        ],
    ],

    'agriculture' => [
        'title' => 'Agriculture & Allied Sciences',
        'description' => 'Careers focusing on farming, agribusiness, and agricultural research.',
        'theme_color' => '#65a30d',
        'gradient' => 'linear-gradient(135deg, #4d7c0f 0%, #65a30d 100%)',
        'icon' => 'fa-seedling',
        'roadmap' => [
            'after_10th' => 'Science (PCB or PCMB). Focus on biology and chemistry.',
            'after_12th' => 'Clear MCAER UG/ICAR AIEEA to pursue B.Sc Agriculture, Horticulture, or B.Tech Agri Engineering.',
            'after_grad' => 'Pursue M.Sc, attempt MPSC/UPSC for Agri Officer roles, or pursue MBA in Agribusiness.'
        ],
        'opportunities' => [
            'Education: MPKV Rahuri and other state agri-universities.',
            'Agri-Tech: Rapid growth of agritech startups in Pune/Nashik providing smart farming solutions.',
            'Government: Roles in NABARD and state agriculture departments.'
        ],
        'subjects' => [
            [
                'name' => 'Agricultural Science',
                'icon' => 'fa-wheat-awn',
                'image' => 'images/career-path/agriculture/science.jpg',
                'courses' => ['B.Sc Agriculture', 'M.Sc Agronomy'],
                'careers' => ['Agronomist', 'Agricultural Scientist', 'Farm Manager'],
                'skills' => ['Research', 'Field Work', 'Plant Biology'],
                'scope' => 'Backbone of the Indian economy; immense scope in research.',
            ]
        ],
    ],

    'small-scale' => [
        'title' => 'Small Scale Businesses & Entrepreneurship',
        'description' => 'Guide to starting and managing micro, small, and medium enterprises (MSMEs).',
        'theme_color' => '#0284c7',
        'gradient' => 'linear-gradient(135deg, #0369a1 0%, #0284c7 100%)',
        'icon' => 'fa-store',
        'roadmap' => [
            'after_10th' => 'Gain practical skills. Trade skills (baking, tailoring, digital marketing) are more important than degrees.',
            'after_12th' => 'Start small-scale trials. Use social media to validate business ideas. BBA can provide foundational knowledge.',
            'after_grad' => 'Scale the business. Register as MSME, secure funding/loans, and expand operations.'
        ],
        'opportunities' => [
            'Schemes: Maharashtra State Innovation Society supports local entrepreneurs.',
            'Market Access: Massive urban markets in Mumbai and Pune for D2C brands and cloud kitchens.',
            'E-commerce: Logistics networks are highly developed.'
        ],
        'subjects' => [
            [
                'name' => 'E-Commerce & Reselling',
                'icon' => 'fa-cart-shopping',
                'image' => 'images/career-path/small-business/ecommerce.jpg',
                'courses' => ['E-Commerce Bootcamps', 'Digital Marketing'],
                'careers' => ['Dropshipper', 'Online Store Owner', 'Amazon/Flipkart Seller'],
                'skills' => ['Digital Marketing', 'Customer Service', 'Inventory Management'],
                'scope' => 'Low investment, high scalability online.',
            ]
        ],
    ],

    'government-defence' => [
        'title' => 'Government & Defence',
        'description' => 'Pathways to secure, prestigious roles in civil services and armed forces.',
        'theme_color' => '#4338ca',
        'gradient' => 'linear-gradient(135deg, #312e81 0%, #4338ca 100%)',
        'icon' => 'fa-shield-halved',
        'roadmap' => [
            'after_10th' => 'For NDA: Choose Science (PCM) in 11th/12th. Start physical training.',
            'after_12th' => 'Attempt NDA exams. For civil services, pursue any graduation degree and start reading NCERTs/newspapers.',
            'after_grad' => 'Attempt UPSC Civil Services, CDS, AFCAT, or SSC CGL. Join dedicated coaching if required.'
        ],
        'opportunities' => [
            'NDA: The prestigious National Defence Academy is located in Khadakwasla, Pune.',
            'MPSC: State administrative roles provide immense authority and stability.',
            'Banking: RBI headquarters and major PSU banks in Mumbai offer numerous roles.'
        ],
        'subjects' => [
            [
                'name' => 'Defence Forces (NDA/CDS)',
                'icon' => 'fa-jet-fighter',
                'image' => 'images/career-path/government-defence/defence.jpg',
                'courses' => ['NDA (After 12th)', 'CDS (After Graduation)', 'AFCAT'],
                'careers' => ['Army Officer', 'Air Force Pilot', 'Naval Officer'],
                'skills' => ['Physical Fitness', 'Discipline', 'Strategic Thinking'],
                'scope' => 'Unmatched respect, adventure, and job security.',
            ]
        ],
    ],

    'teaching-law' => [
        'title' => 'Teaching & Law',
        'description' => 'Noble professions shaping the future and upholding justice.',
        'theme_color' => '#db2777',
        'gradient' => 'linear-gradient(135deg, #be185d 0%, #db2777 100%)',
        'icon' => 'fa-chalkboard-user',
        'roadmap' => [
            'after_10th' => 'For Law: Any stream, prep for CLAT/MH-CET Law. For Teaching: Any stream.',
            'after_12th' => 'Law: 5-year integrated BA LLB. Teaching: BA/B.Sc/B.Com followed by B.Ed.',
            'after_grad' => 'Law: 3-year LLB or LLM. Teaching: Master’s degree + clear NET/SET for professorship.'
        ],
        'opportunities' => [
            'Top Law Colleges: GLC Mumbai, ILS Pune, Symbiosis Law School.',
            'High Court: Bombay High Court offers prestigious litigation practice.',
            'Education Hubs: Pune university ecosystem hires thousands of professors and educators.'
        ],
        'subjects' => [
            [
                'name' => 'Legal Practice',
                'icon' => 'fa-scale-balanced',
                'image' => 'images/career-path/teaching-law/law.jpg',
                'courses' => ['BA LLB', 'LLB', 'LLM'],
                'careers' => ['Advocate', 'Corporate Lawyer', 'Judge', 'Legal Advisor'],
                'skills' => ['Logical Reasoning', 'Debating', 'Reading Comprehension'],
                'scope' => 'Highly rewarding; can range from independent practice to top corporate firms.',
            ]
        ],
    ],


    // -----------------------------------------------------
    // BATCH 2: The 9 New Streams
    // -----------------------------------------------------
    'modern-tech-ai' => [
        'title' => 'Modern Tech & AI',
        'description' => 'Cutting-edge careers in artificial intelligence, data science, and next-gen technologies.',
        'theme_color' => '#0ea5e9',
        'gradient' => 'linear-gradient(135deg, #0284c7 0%, #0ea5e9 100%)',
        'icon' => 'fa-robot',
        'roadmap' => [
            'after_10th' => 'Choose Science (PCM). Learn basic programming (Python) via online resources.',
            'after_12th' => 'Pursue B.Tech in CSE/AI/Data Science or BCA. Build projects, contribute to open-source, and join tech communities.',
            'after_grad' => 'Join the industry, complete specialized PG programs, or pursue M.Tech/MS in specialized AI fields.'
        ],
        'opportunities' => [
            'Pune & Mumbai: Major IT parks and startups focus heavily on AI and Cloud computing.',
            'Remote Work: Tech roles offer the highest flexibility for global remote work.',
            'Startups: Immense funding available for AI-driven products.'
        ],
        'subjects' => [
            [
                'name' => 'Artificial Intelligence & ML',
                'icon' => 'fa-brain',
                'image' => 'images/career-path/modern-tech-ai/ai.jpg',
                'courses' => ['B.Tech AI & Data Science', 'Certification in ML', 'PG Diploma in AI'],
                'careers' => ['AI Engineer', 'Machine Learning Engineer', 'NLP Specialist'],
                'skills' => ['Python', 'Math/Statistics', 'TensorFlow/PyTorch'],
                'scope' => 'The fastest-growing tech sector globally.',
            ],
            [
                'name' => 'Data Science & Analytics',
                'icon' => 'fa-chart-network',
                'image' => 'images/career-path/modern-tech-ai/data-science.jpg',
                'courses' => ['B.Sc Data Science', 'Data Analytics Bootcamps'],
                'careers' => ['Data Scientist', 'Data Analyst', 'Data Engineer'],
                'skills' => ['SQL', 'Data Visualization', 'Statistical Analysis'],
                'scope' => 'Every industry relies on data for decision making.',
            ],
            [
                'name' => 'Cyber Security',
                'icon' => 'fa-shield-halved',
                'image' => 'images/career-path/modern-tech-ai/cyber-security.jpg',
                'courses' => ['B.Tech Cyber Security', 'CEH Certification'],
                'careers' => ['Ethical Hacker', 'Security Analyst', 'Information Security Manager'],
                'skills' => ['Networking', 'Cryptography', 'Risk Management'],
                'scope' => 'Critical demand due to rising digital threats.',
            ],
            [
                'name' => 'Cloud & DevOps',
                'icon' => 'fa-cloud',
                'image' => 'images/career-path/modern-tech-ai/cloud.jpg',
                'courses' => ['AWS/Azure Certifications', 'DevOps Bootcamps'],
                'careers' => ['Cloud Architect', 'DevOps Engineer', 'SysAdmin'],
                'skills' => ['Linux', 'Docker/Kubernetes', 'CI/CD Pipelines'],
                'scope' => 'Backbone of modern software deployment.',
            ]
        ],
    ],

    'creative-careers' => [
        'title' => 'Creative Careers',
        'description' => 'Unleash your imagination in design, media, fashion, and visual arts.',
        'theme_color' => '#ec4899',
        'gradient' => 'linear-gradient(135deg, #be185d 0%, #ec4899 100%)',
        'icon' => 'fa-palette',
        'roadmap' => [
            'after_10th' => 'Any stream. Start building a portfolio (sketches, digital art, photos).',
            'after_12th' => 'Attempt NID/NIFT/UCEED exams. Pursue B.Des, Fine Arts, or specialized diplomas. Focus intensely on portfolio building.',
            'after_grad' => 'Work in agencies, start freelancing, or pursue M.Des for specialized leadership roles.'
        ],
        'opportunities' => [
            'Mumbai: The ultimate hub for Film, Advertising, and Fashion (Bollywood, Ad agencies).',
            'Pune: Growing design studios and gaming companies.',
            'Global: UI/UX designers are heavily recruited remotely by international tech firms.'
        ],
        'subjects' => [
            [
                'name' => 'UI/UX Design',
                'icon' => 'fa-object-group',
                'image' => 'images/career-path/creative-careers/ui-ux.jpg',
                'courses' => ['B.Des', 'HCI Degrees', 'Bootcamps'],
                'careers' => ['UX Researcher', 'UI Designer', 'Product Designer'],
                'skills' => ['Figma', 'User Research', 'Prototyping'],
                'scope' => 'High paying creative role in the tech industry.',
            ],
            [
                'name' => 'Animation & VFX',
                'icon' => 'fa-film',
                'image' => 'images/career-path/creative-careers/animation.jpg',
                'courses' => ['B.Sc Animation', 'VFX Diplomas'],
                'careers' => ['Animator', 'VFX Artist', '3D Modeler'],
                'skills' => ['Maya/Blender', 'Creativity', 'Attention to detail'],
                'scope' => 'Booming due to OTT platforms and gaming.',
            ],
            [
                'name' => 'Fashion Design',
                'icon' => 'fa-shirt',
                'image' => 'images/career-path/creative-careers/fashion.jpg',
                'courses' => ['B.FTech', 'Fashion Design Diplomas (NIFT)'],
                'careers' => ['Fashion Designer', 'Merchandiser', 'Stylist'],
                'skills' => ['Sketching', 'Fabric Knowledge', 'Trend Forecasting'],
                'scope' => 'Glamorous field with immense entrepreneurial potential.',
            ],
            [
                'name' => 'Graphic Design',
                'icon' => 'fa-pen-nib',
                'image' => 'images/career-path/creative-careers/graphic-design.jpg',
                'courses' => ['BFA', 'Commercial Art Diplomas'],
                'careers' => ['Graphic Designer', 'Art Director', 'Illustrator'],
                'skills' => ['Adobe Creative Suite', 'Typography', 'Color Theory'],
                'scope' => 'Needed by every brand and marketing agency.',
            ]
        ],
    ],

    'social-media-content' => [
        'title' => 'Social Media & Content',
        'description' => 'Careers driving the digital creator economy and brand communications.',
        'theme_color' => '#f43f5e',
        'gradient' => 'linear-gradient(135deg, #e11d48 0%, #f43f5e 100%)',
        'icon' => 'fa-hashtag',
        'roadmap' => [
            'after_10th' => 'Any stream. Start consuming and creating content actively on platforms.',
            'after_12th' => 'Pursue Mass Communication, BMM, or BBA. Start your own blog/channel/page to build practical proof.',
            'after_grad' => 'Join digital agencies, work in-house for brands, or scale your personal brand/influencer career.'
        ],
        'opportunities' => [
            'Mumbai: Hub of influencer management agencies and digital marketing firms.',
            'Creator Economy: Rapid growth allows independent creators to earn via sponsorships.',
            'Freelance: High demand for freelance content writers and video editors.'
        ],
        'subjects' => [
            [
                'name' => 'Digital Marketing',
                'icon' => 'fa-bullhorn',
                'image' => 'images/career-path/social-media-content/digital-marketing.jpg',
                'courses' => ['Digital Marketing Certification', 'BBA Digital'],
                'careers' => ['Digital Marketer', 'SEO Specialist', 'Performance Marketer'],
                'skills' => ['Data Analytics', 'Ad Strategy', 'Copywriting'],
                'scope' => 'Essential for modern business survival and growth.',
            ],
            [
                'name' => 'Content Creation & YouTube',
                'icon' => 'fa-youtube',
                'image' => 'images/career-path/social-media-content/youtube.jpg',
                'courses' => ['Self-Taught', 'Video Production Courses'],
                'careers' => ['YouTuber', 'Influencer', 'Content Strategist'],
                'skills' => ['Video Editing', 'Storytelling', 'Audience Building'],
                'scope' => 'High risk but limitless earning potential.',
            ],
            [
                'name' => 'Social Media Management',
                'icon' => 'fa-mobile-screen',
                'image' => 'images/career-path/social-media-content/smm.jpg',
                'courses' => ['Mass Media', 'PR Degrees'],
                'careers' => ['Social Media Manager', 'Community Manager', 'PR Executive'],
                'skills' => ['Trend Spotting', 'Communication', 'Graphic Basics'],
                'scope' => 'Every brand needs a strong social presence.',
            ],
            [
                'name' => 'Content Writing',
                'icon' => 'fa-keyboard',
                'image' => 'images/career-path/social-media-content/writing.jpg',
                'courses' => ['Literature Degrees', 'Copywriting Bootcamps'],
                'careers' => ['Copywriter', 'Blogger', 'Technical Writer'],
                'skills' => ['Grammar', 'Research', 'SEO Writing'],
                'scope' => 'Stable demand in tech, marketing, and media.',
            ]
        ],
    ],

    'gaming-esports' => [
        'title' => 'Gaming & E-sports',
        'description' => 'The booming entertainment sector encompassing game dev, design, and competitive play.',
        'theme_color' => '#8b5cf6',
        'gradient' => 'linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%)',
        'icon' => 'fa-gamepad',
        'roadmap' => [
            'after_10th' => 'Science (PCM) preferred for development; any stream for design. Play analytically.',
            'after_12th' => 'B.Tech/BCA for programming; B.Des/Animation for design. Participate in local E-sports tournaments.',
            'after_grad' => 'Join gaming studios (Nodding Heads, Ubisoft), stream full-time, or work in E-sports event management.'
        ],
        'opportunities' => [
            'Pune: A growing hub for game development studios.',
            'E-sports Events: Mumbai hosts massive LAN tournaments and E-sports franchise HQs.',
            'Streaming: Loco/Rooter platforms offer localized streaming revenues.'
        ],
        'subjects' => [
            [
                'name' => 'Game Development',
                'icon' => 'fa-code',
                'image' => 'images/career-path/gaming-esports/game-dev.jpg',
                'courses' => ['B.Tech CSE', 'Game Programming Diplomas'],
                'careers' => ['Game Developer', 'Engine Programmer', 'AR/VR Dev'],
                'skills' => ['C++/C#', 'Unity/Unreal Engine', 'Math/Physics'],
                'scope' => 'Highly technical and high paying in top studios.',
            ],
            [
                'name' => 'Game Design & Art',
                'icon' => 'fa-pen-ruler',
                'image' => 'images/career-path/gaming-esports/game-design.jpg',
                'courses' => ['B.Des', 'Animation Degrees'],
                'careers' => ['Level Designer', '3D Artist', 'Concept Artist'],
                'skills' => ['Creativity', '3D Modeling', 'World Building'],
                'scope' => 'Crucial for creating engaging game experiences.',
            ],
            [
                'name' => 'Professional E-sports',
                'icon' => 'fa-trophy',
                'image' => 'images/career-path/gaming-esports/esports.jpg',
                'courses' => ['Academy Training', 'Self-Taught'],
                'careers' => ['Pro Player', 'Coach', 'E-sports Caster/Commentator'],
                'skills' => ['Reflexes', 'Team Coordination', 'Game Sense'],
                'scope' => 'Emerging sector in India with massive prize pools.',
            ],
            [
                'name' => 'Game Testing (QA)',
                'icon' => 'fa-bug',
                'image' => 'images/career-path/gaming-esports/testing.jpg',
                'courses' => ['Software Testing Certifications'],
                'careers' => ['QA Tester', 'Quality Assurance Lead'],
                'skills' => ['Attention to detail', 'Bug Tracking', 'Patience'],
                'scope' => 'Good entry point into the gaming industry.',
            ]
        ],
    ],

    'freelancing-remote' => [
        'title' => 'Freelancing & Remote Work',
        'description' => 'The ultimate guide to building an independent, location-independent career.',
        'theme_color' => '#14b8a6',
        'gradient' => 'linear-gradient(135deg, #0d9488 0%, #14b8a6 100%)',
        'icon' => 'fa-laptop-house',
        'roadmap' => [
            'after_10th' => 'Learn digital tools. English communication is paramount.',
            'after_12th' => 'Start building skills (writing, design, basic coding). Take on small gigs on Fiverr/Upwork while studying.',
            'after_grad' => 'Transition to full-time freelancing. Build a personal brand, network on LinkedIn, and secure retainer clients.'
        ],
        'opportunities' => [
            'Global Clients: Earn in USD/EUR while living in India (geo-arbitrage).',
            'Flexibility: Perfect for those who want to avoid the Mumbai/Pune traffic commutes.',
            'Co-working: Thriving co-working spaces in tier-1 and tier-2 cities.'
        ],
        'subjects' => [
            [
                'name' => 'Freelance Web/App Dev',
                'icon' => 'fa-code',
                'image' => 'images/career-path/freelancing-remote/web-dev.jpg',
                'courses' => ['Self-Taught', 'Coding Bootcamps'],
                'careers' => ['Freelance Web Developer', 'WordPress Expert'],
                'skills' => ['HTML/CSS/JS', 'React/Node', 'Client Communication'],
                'scope' => 'Highest earning potential among freelance skills.',
            ],
            [
                'name' => 'Freelance Design',
                'icon' => 'fa-bezier-curve',
                'image' => 'images/career-path/freelancing-remote/design.jpg',
                'courses' => ['Design Software Certifications'],
                'careers' => ['Freelance Graphic Designer', 'Logo/Brand Designer'],
                'skills' => ['Illustrator', 'Photoshop', 'Creativity'],
                'scope' => 'Constant demand from startups and agencies.',
            ],
            [
                'name' => 'Virtual Assistance',
                'icon' => 'fa-headset',
                'image' => 'images/career-path/freelancing-remote/va.jpg',
                'courses' => ['Office Admin Courses'],
                'careers' => ['Virtual Assistant', 'Data Entry', 'Customer Support'],
                'skills' => ['Organization', 'Email Etiquette', 'Time Management'],
                'scope' => 'Easiest entry point into remote work.',
            ],
            [
                'name' => 'Freelance Writing',
                'icon' => 'fa-pen',
                'image' => 'images/career-path/freelancing-remote/writing.jpg',
                'courses' => ['Content Writing Courses'],
                'careers' => ['Ghostwriter', 'Copywriter', 'Technical Writer'],
                'skills' => ['Research', 'SEO', 'Flawless Grammar'],
                'scope' => 'High demand for quality English content globally.',
            ]
        ],
    ],

    'competitive-exams' => [
        'title' => 'Competitive Exams',
        'description' => 'Focused pathways for securing prestigious government and public sector jobs.',
        'theme_color' => '#ea580c',
        'gradient' => 'linear-gradient(135deg, #c2410c 0%, #ea580c 100%)',
        'icon' => 'fa-file-signature',
        'roadmap' => [
            'after_10th' => 'Choose Arts/Humanities (ideally) as it aligns with UPSC/MPSC syllabus. Build a reading habit.',
            'after_12th' => 'Attempt NDA or SSC CHSL. Pursue graduation (BA is popular) and start dedicated coaching/self-study.',
            'after_grad' => 'Attempt UPSC, MPSC, SSC CGL, Banking (IBPS), or Defence (CDS/AFCAT). Maintain persistence.'
        ],
        'opportunities' => [
            'Pune: Sadashiv Peth is the mecca for MPSC/UPSC coaching in Maharashtra.',
            'State Services: High demand for MPSC officers (Deputy Collector, DySP).',
            'Public Sector: Numerous banks and PSUs headquartered in Mumbai.'
        ],
        'subjects' => [
            [
                'name' => 'Civil Services (UPSC/MPSC)',
                'icon' => 'fa-monument',
                'image' => 'images/career-path/competitive-exams/civil-services.jpg',
                'courses' => ['Graduation (Any)', 'Dedicated Coaching'],
                'careers' => ['IAS', 'IPS', 'Deputy Collector', 'Tahsildar'],
                'skills' => ['Vast Knowledge', 'Analytical Writing', 'Perseverance'],
                'scope' => 'Highest prestige, authority, and job security in India.',
            ],
            [
                'name' => 'Banking Exams (IBPS/SBI)',
                'icon' => 'fa-building-columns',
                'image' => 'images/career-path/competitive-exams/banking.jpg',
                'courses' => ['Graduation', 'Bank Coaching'],
                'careers' => ['Probationary Officer (PO)', 'Clerk', 'Specialist Officer'],
                'skills' => ['Quantitative Aptitude', 'Logical Reasoning', 'Speed'],
                'scope' => 'Fast recruitment process and excellent financial perks.',
            ],
            [
                'name' => 'Staff Selection Commission (SSC)',
                'icon' => 'fa-file-contract',
                'image' => 'images/career-path/competitive-exams/ssc.jpg',
                'courses' => ['Graduation', 'SSC Coaching'],
                'careers' => ['Income Tax Inspector', 'Customs Officer', 'CBI Sub-Inspector'],
                'skills' => ['Math', 'English', 'General Awareness'],
                'scope' => 'Gateway to powerful central government ministries.',
            ],
            [
                'name' => 'Defence & Police',
                'icon' => 'fa-shield',
                'image' => 'images/career-path/competitive-exams/police.jpg',
                'courses' => ['CDS/AFCAT', 'State Police Exams'],
                'careers' => ['Armed Forces Officer', 'Police Sub-Inspector (PSI)'],
                'skills' => ['Physical Fitness', 'Leadership', 'Discipline'],
                'scope' => 'Respected uniform jobs with immense pride and adventure.',
            ]
        ],
    ],

    'hotel-management' => [
        'title' => 'Hotel Management & Tourism',
        'description' => 'Careers in hospitality, culinary arts, event management, and global tourism.',
        'theme_color' => '#d97706',
        'gradient' => 'linear-gradient(135deg, #b45309 0%, #d97706 100%)',
        'icon' => 'fa-bell-concierge',
        'roadmap' => [
            'after_10th' => 'Any stream. Focus on communication and personality development.',
            'after_12th' => 'Clear NCHMCT JEE. Pursue B.Sc Hospitality & Hotel Administration or BHM. Do intensive internships.',
            'after_grad' => 'Join hotel chains as management trainees, work on cruise lines, or pursue MBA in Hospitality.'
        ],
        'opportunities' => [
            'Mumbai: Hub of luxury 5-star hotel chains (Taj, Oberoi, Trident).',
            'Tourism: High scope in Maharashtra tourism (heritage sites, hill stations).',
            'Global: Excellent opportunities to work abroad or on international cruise ships.'
        ],
        'subjects' => [
            [
                'name' => 'Food Production (Culinary)',
                'icon' => 'fa-utensils',
                'image' => 'images/career-path/hotel-management/culinary.jpg',
                'courses' => ['BHM', 'Diploma in Culinary Arts'],
                'careers' => ['Executive Chef', 'Sous Chef', 'Pastry Chef'],
                'skills' => ['Cooking', 'Creativity', 'Working under pressure'],
                'scope' => 'Highly creative; can lead to starting your own restaurant.',
            ],
            [
                'name' => 'Front Office & Operations',
                'icon' => 'fa-user-tie',
                'image' => 'images/career-path/hotel-management/front-office.jpg',
                'courses' => ['B.Sc Hospitality', 'Diploma in Hotel Ops'],
                'careers' => ['Front Office Manager', 'Hotel Manager', 'Guest Relations'],
                'skills' => ['Communication', 'Problem Solving', 'Grooming'],
                'scope' => 'Fast track to General Manager roles in luxury hotels.',
            ],
            [
                'name' => 'Event Management',
                'icon' => 'fa-calendar-check',
                'image' => 'images/career-path/hotel-management/event-management.jpg',
                'courses' => ['BBA Event Management', 'Event Diplomas'],
                'careers' => ['Event Planner', 'Wedding Planner', 'Corporate Events Manager'],
                'skills' => ['Organization', 'Networking', 'Crisis Management'],
                'scope' => 'Booming industry, especially for destination weddings.',
            ],
            [
                'name' => 'Travel & Tourism',
                'icon' => 'fa-plane-departure',
                'image' => 'images/career-path/hotel-management/tourism.jpg',
                'courses' => ['BA Tourism', 'IATA Certifications'],
                'careers' => ['Travel Consultant', 'Tour Guide', 'Aviation Staff'],
                'skills' => ['Geography Knowledge', 'Customer Service', 'Languages'],
                'scope' => 'Rebounding rapidly post-pandemic; great for travel lovers.',
            ]
        ],
    ],

    'pharmaceutical-sciences' => [
        'title' => 'Pharmaceutical Sciences',
        'description' => 'The science of drug discovery, manufacturing, and clinical research.',
        'theme_color' => '#059669',
        'gradient' => 'linear-gradient(135deg, #047857 0%, #059669 100%)',
        'icon' => 'fa-capsules',
        'roadmap' => [
            'after_10th' => 'Science (PCB or PCM). Focus on Chemistry.',
            'after_12th' => 'Clear MHT-CET/NEET. Pursue B.Pharm (4 years) or D.Pharm (2 years).',
            'after_grad' => 'Pursue M.Pharm/Pharm.D, join pharma manufacturing, or clear exams for Drug Inspector roles.'
        ],
        'opportunities' => [
            'Manufacturing Hubs: Massive pharma industrial zones in Tarapur (Palghar), Pune, and Aurangabad.',
            'Clinical Research: High concentration of CROs (Clinical Research Organizations) in Mumbai.',
            'Business: Excellent scope for opening medical stores or pharma distributorships.'
        ],
        'subjects' => [
            [
                'name' => 'Pharmacy (B.Pharm/M.Pharm)',
                'icon' => 'fa-pills',
                'image' => 'images/career-path/pharmaceutical-sciences/pharmacy.jpg',
                'courses' => ['B.Pharm', 'M.Pharm Specializations'],
                'careers' => ['Pharmacist', 'R&D Scientist', 'Quality Control Officer'],
                'skills' => ['Chemistry', 'Attention to Detail', 'Lab Protocols'],
                'scope' => 'India is the pharmacy of the world; evergreen industry.',
            ],
            [
                'name' => 'Clinical Research',
                'icon' => 'fa-microscope',
                'image' => 'images/career-path/pharmaceutical-sciences/clinical-research.jpg',
                'courses' => ['PG Diploma in Clinical Research'],
                'careers' => ['Clinical Research Associate', 'Data Manager'],
                'skills' => ['Data Analysis', 'Ethics/Compliance', 'Medical Knowledge'],
                'scope' => 'Crucial for testing new drugs; heavy corporate hiring.',
            ],
            [
                'name' => 'Regulatory Affairs & Law',
                'icon' => 'fa-file-shield',
                'image' => 'images/career-path/pharmaceutical-sciences/regulatory.jpg',
                'courses' => ['Diploma in Regulatory Affairs'],
                'careers' => ['Regulatory Affairs Manager', 'Drug Inspector (Govt)'],
                'skills' => ['Legal Knowledge', 'Documentation', 'Compliance'],
                'scope' => 'High paying niche; ensures drugs meet legal standards.',
            ],
            [
                'name' => 'Pharma Management & Sales',
                'icon' => 'fa-briefcase-medical',
                'image' => 'images/career-path/pharmaceutical-sciences/sales.jpg',
                'courses' => ['MBA Pharmaceutical Management'],
                'careers' => ['Medical Representative', 'Product Manager', 'Sales Head'],
                'skills' => ['Sales', 'Communication', 'Scientific Understanding'],
                'scope' => 'Highly lucrative with heavy incentives and growth.',
            ]
        ],
    ],

    'ayush-allied-health' => [
        'title' => 'AYUSH & Allied Health',
        'description' => 'Alternative medicine, holistic healing, and crucial healthcare support systems.',
        'theme_color' => '#16a34a',
        'gradient' => 'linear-gradient(135deg, #15803d 0%, #16a34a 100%)',
        'icon' => 'fa-leaf',
        'roadmap' => [
            'after_10th' => 'Science (PCB). Prepare for NEET.',
            'after_12th' => 'Clear NEET for AYUSH degrees (BAMS/BHMS) or direct merit admission for Allied Health (Nursing/BPT).',
            'after_grad' => 'Start independent practice, join wellness centers, or pursue PG/MD in specific AYUSH branches.'
        ],
        'opportunities' => [
            'Government Push: Growing government support and funding for AYUSH hospitals and research.',
            'Wellness Tourism: Massive scope in Maharashtra resorts offering Ayurvedic healing.',
            'Allied Demand: Severe shortage of trained nurses and lab technicians ensures 100% placement.'
        ],
        'subjects' => [
            [
                'name' => 'Ayurveda & Homeopathy',
                'icon' => 'fa-mortar-pestle',
                'image' => 'images/career-path/ayush-allied-health/ayurveda.jpg',
                'courses' => ['BAMS (Ayurveda)', 'BHMS (Homeopathy)'],
                'careers' => ['Ayurvedic Doctor', 'Medical Officer', 'Wellness Consultant'],
                'skills' => ['Holistic Diagnosis', 'Patience', 'Herbology'],
                'scope' => 'Rising global demand for natural and preventive healthcare.',
            ],
            [
                'name' => 'Physiotherapy',
                'icon' => 'fa-person-walking',
                'image' => 'images/career-path/ayush-allied-health/physio.jpg',
                'courses' => ['BPT (Bachelor of Physiotherapy)', 'MPT'],
                'careers' => ['Physiotherapist', 'Sports Rehab Specialist', 'Ergonomics Consultant'],
                'skills' => ['Anatomy', 'Physical Stamina', 'Empathy'],
                'scope' => 'High demand due to sedentary corporate lifestyles and sports.',
            ],
            [
                'name' => 'Nursing',
                'icon' => 'fa-user-nurse',
                'image' => 'images/career-path/ayush-allied-health/nursing.jpg',
                'courses' => ['B.Sc Nursing', 'GNM', 'ANM'],
                'careers' => ['Registered Nurse', 'Staff Nurse', 'Nursing Superintendent'],
                'skills' => ['Patient Care', 'Stamina', 'Emergency Response'],
                'scope' => 'Backbone of healthcare; massive opportunities abroad.',
            ],
            [
                'name' => 'Diagnostics & Lab Tech',
                'icon' => 'fa-microscope',
                'image' => 'images/career-path/ayush-allied-health/lab-tech.jpg',
                'courses' => ['B.Sc MLT (Medical Lab Tech)', 'Radiology Degrees'],
                'careers' => ['Lab Technician', 'X-Ray/MRI Technician', 'Pathology Assistant'],
                'skills' => ['Equipment Handling', 'Accuracy', 'Analysis'],
                'scope' => 'Essential for diagnostics; stable jobs in labs and hospitals.',
            ]
        ],
    ],
    'non-traditional-careers' => [
        'title' => 'Non-Traditional Careers',
        'theme_color' => '#f59e0b',
        'gradient' => 'linear-gradient(135deg, #f59e0b, #d97706)',
        'icon' => 'fa-lightbulb',
        'description' => 'Explore creative, digital, and modern career paths that prioritize skills over traditional degrees.',
        'roadmap' => [
            'after_10th' => 'Identify your passion and start building foundational skills (e.g., design, coding, communication).',
            'after_12th' => 'Enroll in specialized vocational courses or certifications. Build a portfolio or start freelancing.',
            'after_grad' => 'Launch your career as an independent professional or join modern startups. Consistency and continuous learning are key.',
        ],
        'opportunities' => [
            'Mumbai & Pune: Hubs for entertainment, media, and digital marketing.',
            'Bangalore: Excellent for tech startups, gaming, and UI/UX roles.',
            'Remote/Global: High demand for freelancers, designers, and content creators globally.'
        ],
        'tips' => [
            'Skill > Degree',
            'Consistency > Marks',
            'Passion + Smart Work'
        ],
        'subjects' => [
            [
                'name' => 'Creative & Digital Careers',
                'icon' => 'fa-palette',
                'image' => 'images/career-path/non-traditional-careers/creative-digital.jpg',
                'courses' => ['Graphic Designing', 'Animation & VFX', 'Photography / Videography', 'UI/UX Design'],
                'careers' => ['Graphic Designer', 'YouTuber / Content Creator', 'Social Media Influencer'],
                'skills' => ['Creativity', 'Photoshop/Canva', 'Storytelling'],
                'scope' => 'High demand for visual content and brand building in the digital age.',
            ],
            [
                'name' => 'Culinary & Hospitality',
                'icon' => 'fa-utensils',
                'image' => 'images/career-path/non-traditional-careers/culinary-hospitality.jpg',
                'courses' => ['Culinary Arts', 'Hotel Management', 'Baking & Pastry'],
                'careers' => ['Chef / Baker', 'Food Blogger', 'Food Stylist', 'Cloud Kitchen Owner', 'Catering Business'],
                'skills' => ['Cooking', 'Presentation', 'Customer Service'],
                'scope' => 'Rapid growth in food delivery, blogging, and niche dining experiences.',
            ],
            [
                'name' => 'Gaming & Esports',
                'icon' => 'fa-gamepad',
                'image' => 'images/career-path/non-traditional-careers/gaming-esports.jpg',
                'courses' => ['Game Development', 'Esports Management', 'Game Testing'],
                'careers' => ['Professional Gamer', 'Game Streamer', 'Game Tester', 'Esports Manager', 'Game Developer'],
                'skills' => ['Gaming Skills', 'Streaming', 'Consistency'],
                'scope' => 'Multi-billion dollar industry with exponential growth in India.',
            ],
            [
                'name' => 'Agriculture & Rural Innovation',
                'icon' => 'fa-tractor',
                'image' => 'images/career-path/non-traditional-careers/agriculture-rural.jpg',
                'courses' => ['Agri-Business', 'Organic Farming Certifications'],
                'careers' => ['Organic Farming', 'Mushroom Farming', 'Beekeeping', 'Agri-Entrepreneurship', 'Dairy / Poultry Farming'],
                'skills' => ['Agriculture Knowledge', 'Business Mindset'],
                'scope' => 'Crucial for sustainable development and food security.',
            ],
            [
                'name' => 'Performing Arts & Entertainment',
                'icon' => 'fa-masks-theater',
                'image' => 'images/career-path/non-traditional-careers/performing-arts.jpg',
                'courses' => ['Acting Classes', 'Dance Academy', 'Theatre Arts'],
                'careers' => ['Acting', 'Dancing / Choreography', 'Voice-over Artist', 'Stand-up Comedian', 'Theatre Artist'],
                'skills' => ['Confidence', 'Communication', 'Practice'],
                'scope' => 'Endless opportunities across film, television, OTT, and live events.',
            ],
            [
                'name' => 'Travel & Adventure',
                'icon' => 'fa-plane',
                'image' => 'images/career-path/non-traditional-careers/travel-adventure.jpg',
                'courses' => ['Tourism Management', 'Adventure Sports Training'],
                'careers' => ['Travel Blogger / Vlogger', 'Tour Guide', 'Travel Photographer', 'Adventure Sports Trainer'],
                'skills' => ['Communication', 'Passion for Travel'],
                'scope' => 'Growing tourism sector driven by social media and experiential travel.',
            ],
            [
                'name' => 'Freelancing & Online Careers',
                'icon' => 'fa-laptop-house',
                'image' => 'images/career-path/non-traditional-careers/freelancing-online.jpg',
                'courses' => ['Digital Marketing', 'Copywriting', 'E-commerce'],
                'careers' => ['Freelance Writer', 'Digital Marketing', 'Online Tutor', 'Virtual Assistant', 'Dropshipping / E-commerce'],
                'skills' => ['Internet Skills', 'Discipline', 'Consistency'],
                'scope' => 'The gig economy is the future, offering ultimate flexibility and scale.',
            ],
            [
                'name' => 'Skill-Based & Vocational',
                'icon' => 'fa-tools',
                'image' => 'images/career-path/non-traditional-careers/vocational-careers.jpg',
                'courses' => ['ITI Diplomas', 'Vocational Training', 'Beautician Courses', 'Fashion Design'],
                'careers' => ['Electrician', 'Plumber', 'Automobile Mechanic', 'Beautician / Makeup Artist', 'Fashion Designer'],
                'skills' => ['Technical Training', 'Hands-on Practice'],
                'scope' => 'Evergreen demand for skilled professionals across all sectors.',
            ],
        ],
    ],
];
