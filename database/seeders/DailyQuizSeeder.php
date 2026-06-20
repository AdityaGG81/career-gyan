<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DailyQuizQuestion;
use Carbon\Carbon;

class DailyQuizSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            // ──────────────────────────────────────────────
            // PAST DAYS (-3 to -1)
            // ──────────────────────────────────────────────
            [
                'offset' => -3,
                'question_text' => 'Which programming language is primarily used for iOS app development by Apple?',
                'option_a' => 'Kotlin',
                'option_b' => 'Swift',
                'option_c' => 'Java',
                'option_d' => 'Dart',
                'correct_option' => 'b',
                'explanation' => 'Swift is Apple\'s proprietary language developed specifically for iOS, macOS, watchOS, and tvOS applications, replacing Objective-C.',
                'category' => 'technology',
                'difficulty' => 'easy',
                'points' => 10,
            ],
            [
                'offset' => -2,
                'question_text' => 'In financial accounting, what does the abbreviation "GAAP" stand for?',
                'option_a' => 'General Association of Asset Planners',
                'option_b' => 'Government Auditing and Account Practices',
                'option_c' => 'Generally Accepted Accounting Principles',
                'option_d' => 'Global Asset Allocation Policies',
                'correct_option' => 'c',
                'explanation' => 'GAAP stands for Generally Accepted Accounting Principles. It is a common set of accounting principles, standards, and procedures issued by the Financial Accounting Standards Board (FASB).',
                'category' => 'commerce',
                'difficulty' => 'medium',
                'points' => 15,
            ],
            [
                'offset' => -1,
                'question_text' => 'Which branch of engineering is primarily focused on the design, construction, and operation of aircraft and spacecraft?',
                'option_a' => 'Civil Engineering',
                'option_b' => 'Mechanical Engineering',
                'option_c' => 'Aerospace Engineering',
                'option_d' => 'Metallurgical Engineering',
                'correct_option' => 'c',
                'explanation' => 'Aerospace engineering is the primary field of engineering concerned with the development of aircraft and spacecraft. It has two major and overlapping branches: aeronautical engineering and astronautical engineering.',
                'category' => 'engineering',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // ──────────────────────────────────────────────
            // TODAY (offset 0)
            // ──────────────────────────────────────────────
            [
                'offset' => 0,
                'question_text' => 'What is the primary responsibility of a Scrum Master in an Agile software development team?',
                'option_a' => 'Writing the source code and developing features',
                'option_b' => 'Managing budget, hiring developers, and signing contracts',
                'option_c' => 'Facilitating the agile process, removing blockers, and coaching the team',
                'option_d' => 'Designing user interfaces and creating wireframes',
                'correct_option' => 'c',
                'explanation' => 'A Scrum Master is a facilitator for an agile development team. They are responsible for managing the scrum framework, resolving obstacles/impediments, and helping the team perform at their highest level.',
                'category' => 'technology',
                'difficulty' => 'medium',
                'points' => 10,
            ],

            // ──────────────────────────────────────────────
            // FUTURE DAYS (offset 1 to 90)
            // ──────────────────────────────────────────────

            // Day 1 – Arts
            [
                'offset' => 1,
                'question_text' => 'Which of the following art terms describes a painting technique that uses thick, textured paint where the brush or palette knife strokes are clearly visible?',
                'option_a' => 'Sfumato',
                'option_b' => 'Impasto',
                'option_c' => 'Chiaroscuro',
                'option_d' => 'Fresco',
                'correct_option' => 'b',
                'explanation' => 'Impasto is a technique used in painting, where paint is laid on an area of the surface in very thick layers, usually thick enough that the brush or painting-knife strokes are visible.',
                'category' => 'arts',
                'difficulty' => 'hard',
                'points' => 20,
            ],

            // Day 2 – Science
            [
                'offset' => 2,
                'question_text' => 'In biotechnology and molecular biology, what does the acronym "CRISPR" refer to?',
                'option_a' => 'A method for fast protein sequencing',
                'option_b' => 'A revolutionary gene-editing technology',
                'option_c' => 'A chemical reagent for cell staining',
                'option_d' => 'An imaging technique for neural connections',
                'correct_option' => 'b',
                'explanation' => 'CRISPR (Clustered Regularly Interspaced Short Palindromic Repeats) is a powerful, highly precise tool used in gene editing, allowing scientists to alter DNA sequences and modify gene function.',
                'category' => 'science',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 3 – General
            [
                'offset' => 3,
                'question_text' => 'In product design and UX research, what does "A/B testing" refer to?',
                'option_a' => 'Testing two versions of a webpage or app screen to see which performs better',
                'option_b' => 'Comparing the speed performance of two databases',
                'option_c' => 'A hiring test where candidate A and B compete on a coding test',
                'option_d' => 'An automated security scan for public APIs',
                'correct_option' => 'a',
                'explanation' => 'A/B testing is a user experience research methodology. It consists of a randomized experiment with two variants, A and B, to compare user engagement, conversion rates, or other metrics.',
                'category' => 'general',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 4 – Engineering
            [
                'offset' => 4,
                'question_text' => 'What is the full form of VLSI, a crucial field in electronics engineering?',
                'option_a' => 'Very Large Scale Integration',
                'option_b' => 'Variable Length Signal Interchange',
                'option_c' => 'Virtual Logic System Interface',
                'option_d' => 'Verified Layered Semiconductor Imaging',
                'correct_option' => 'a',
                'explanation' => 'VLSI stands for Very Large Scale Integration – the process of creating integrated circuits by combining thousands of transistors into a single chip. It is the backbone of modern processors and microchips.',
                'category' => 'engineering',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 5 – Commerce
            [
                'offset' => 5,
                'question_text' => 'What does "IPO" stand for in the stock market?',
                'option_a' => 'Internal Profit Overview',
                'option_b' => 'Initial Public Offering',
                'option_c' => 'Integrated Portfolio Operations',
                'option_d' => 'Investment Planning Order',
                'correct_option' => 'b',
                'explanation' => 'An Initial Public Offering (IPO) is when a private company offers its shares to the public for the first time on a stock exchange. Companies like Zomato, Paytm, and LIC went public through IPOs in India.',
                'category' => 'commerce',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 6 – Technology
            [
                'offset' => 6,
                'question_text' => 'In cloud computing, what does "SaaS" stand for?',
                'option_a' => 'Software as a Service',
                'option_b' => 'System and Application Support',
                'option_c' => 'Secure Access and Storage',
                'option_d' => 'Server Automated Administration Software',
                'correct_option' => 'a',
                'explanation' => 'SaaS (Software as a Service) is a cloud computing model where applications are hosted by a service provider and made available to customers over the internet. Examples include Google Workspace, Salesforce, and Slack.',
                'category' => 'technology',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 7 – Science
            [
                'offset' => 7,
                'question_text' => 'Which Indian space mission successfully reached Mars orbit in its first attempt in 2014?',
                'option_a' => 'Chandrayaan-1',
                'option_b' => 'Mangalyaan (Mars Orbiter Mission)',
                'option_c' => 'ASTROSAT',
                'option_d' => 'Gaganyaan',
                'correct_option' => 'b',
                'explanation' => 'ISRO\'s Mars Orbiter Mission (Mangalyaan), launched in November 2013, made India the first Asian nation to reach Martian orbit and the first nation globally to do so on its maiden attempt.',
                'category' => 'science',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 8 – Arts
            [
                'offset' => 8,
                'question_text' => 'Which degree is most commonly pursued for a professional career in architecture?',
                'option_a' => 'B.Des (Bachelor of Design)',
                'option_b' => 'B.Arch (Bachelor of Architecture)',
                'option_c' => 'B.Tech in Civil Engineering',
                'option_d' => 'BA in Interior Design',
                'correct_option' => 'b',
                'explanation' => 'B.Arch is a 5-year professional degree recognized by the Council of Architecture (COA) in India. It is the mandatory qualification to practice as a licensed architect.',
                'category' => 'arts',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 9 – Engineering
            [
                'offset' => 9,
                'question_text' => 'Which entrance exam is required for admission to the IITs (Indian Institutes of Technology)?',
                'option_a' => 'GATE',
                'option_b' => 'JEE Advanced',
                'option_c' => 'NEET',
                'option_d' => 'CAT',
                'correct_option' => 'b',
                'explanation' => 'JEE Advanced is the entrance exam for admission to undergraduate engineering programs at all 23 IITs in India. Candidates must first qualify JEE Main to be eligible for JEE Advanced.',
                'category' => 'engineering',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 10 – Commerce
            [
                'offset' => 10,
                'question_text' => 'What is the primary role of the Securities and Exchange Board of India (SEBI)?',
                'option_a' => 'Regulating the banking sector',
                'option_b' => 'Managing India\'s foreign reserves',
                'option_c' => 'Regulating the securities/stock market and protecting investor interests',
                'option_d' => 'Setting interest rates for loans',
                'correct_option' => 'c',
                'explanation' => 'SEBI was established in 1988 and given statutory powers in 1992 to protect the interests of investors in securities and to promote the development and regulation of the securities market in India.',
                'category' => 'commerce',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 11 – Technology
            [
                'offset' => 11,
                'question_text' => 'What does API stand for in software development?',
                'option_a' => 'Advanced Programming Interface',
                'option_b' => 'Automated Process Integration',
                'option_c' => 'Application Programming Interface',
                'option_d' => 'Artificial Protocol Interaction',
                'correct_option' => 'c',
                'explanation' => 'An API (Application Programming Interface) is a set of rules and protocols that allows different software applications to communicate with each other. APIs are fundamental to modern web development, mobile apps, and cloud services.',
                'category' => 'technology',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 12 – General
            [
                'offset' => 12,
                'question_text' => 'Which of these is NOT one of the top career skills identified by the World Economic Forum for 2025?',
                'option_a' => 'Analytical thinking and innovation',
                'option_b' => 'Memorizing large datasets',
                'option_c' => 'Active learning and learning strategies',
                'option_d' => 'Complex problem-solving',
                'correct_option' => 'b',
                'explanation' => 'The World Economic Forum\'s Future of Jobs Report emphasizes analytical thinking, active learning, creativity, and problem-solving as top career skills. Pure memorization is not valued – critical thinking is.',
                'category' => 'general',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 13 – Science
            [
                'offset' => 13,
                'question_text' => 'Which branch of science deals with the study of fungi?',
                'option_a' => 'Virology',
                'option_b' => 'Mycology',
                'option_c' => 'Entomology',
                'option_d' => 'Ornithology',
                'correct_option' => 'b',
                'explanation' => 'Mycology is the branch of biology concerned with the study of fungi, including their genetic and biochemical properties. Careers in mycology include research, pharmaceuticals, agriculture, and food science.',
                'category' => 'science',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 14 – Engineering
            [
                'offset' => 14,
                'question_text' => 'In civil engineering, what does the term "RCC" stand for?',
                'option_a' => 'Rapid Concrete Composition',
                'option_b' => 'Reinforced Cement Concrete',
                'option_c' => 'Regulated Construction Code',
                'option_d' => 'Recycled Composite Compound',
                'correct_option' => 'b',
                'explanation' => 'RCC (Reinforced Cement Concrete) is concrete that has steel bars or mesh embedded in it. The steel reinforcement provides tensile strength, making it ideal for building columns, beams, slabs, and foundations.',
                'category' => 'engineering',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 15 – Commerce
            [
                'offset' => 15,
                'question_text' => 'Which professional certification is considered the gold standard in chartered accountancy in India?',
                'option_a' => 'CFA (Chartered Financial Analyst)',
                'option_b' => 'CA (Chartered Accountant) from ICAI',
                'option_c' => 'MBA in Finance',
                'option_d' => 'CS (Company Secretary)',
                'correct_option' => 'b',
                'explanation' => 'The CA qualification from ICAI (Institute of Chartered Accountants of India) is the most prestigious accounting credential in India. It requires passing three levels: CA Foundation, CA Intermediate, and CA Final.',
                'category' => 'commerce',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 16 – Technology
            [
                'offset' => 16,
                'question_text' => 'What is the primary purpose of a "firewall" in network security?',
                'option_a' => 'To speed up internet connectivity',
                'option_b' => 'To compress data during file transfers',
                'option_c' => 'To monitor and control incoming and outgoing network traffic based on security rules',
                'option_d' => 'To encrypt all emails automatically',
                'correct_option' => 'c',
                'explanation' => 'A firewall is a network security system that monitors and controls network traffic based on predetermined security rules. It establishes a barrier between trusted and untrusted networks. Cybersecurity is one of the fastest-growing career fields.',
                'category' => 'technology',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 17 – Arts
            [
                'offset' => 17,
                'question_text' => 'What does the career title "UX Designer" primarily focus on?',
                'option_a' => 'Writing backend server code',
                'option_b' => 'Designing the user experience of digital products to be intuitive and enjoyable',
                'option_c' => 'Managing marketing campaigns',
                'option_d' => 'Hardware circuit design for mobile phones',
                'correct_option' => 'b',
                'explanation' => 'UX (User Experience) Designers focus on creating meaningful and relevant experiences for users of digital products. They work on the entire process of acquiring and integrating the product, including aspects of branding, design, usability, and function.',
                'category' => 'arts',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 18 – General
            [
                'offset' => 18,
                'question_text' => 'Which examination is the gateway for admission to MBA programs at IIMs in India?',
                'option_a' => 'GMAT',
                'option_b' => 'GRE',
                'option_c' => 'CAT (Common Admission Test)',
                'option_d' => 'MAT',
                'correct_option' => 'c',
                'explanation' => 'CAT (Common Admission Test) is a computer-based test conducted by the IIMs on a rotational basis. It is the primary gateway for admission to 20+ IIMs and over 1,200 other MBA programs in India.',
                'category' => 'general',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 19 – Science
            [
                'offset' => 19,
                'question_text' => 'What is "Pharmacology" the study of?',
                'option_a' => 'Ancient Egyptian writing systems',
                'option_b' => 'The effects of drugs on living organisms',
                'option_c' => 'Farm management and agriculture',
                'option_d' => 'The physics of sound waves',
                'correct_option' => 'b',
                'explanation' => 'Pharmacology is the branch of medicine and biology concerned with the study of drug action, how drugs interact with biological systems. It is essential for careers in pharmaceutical research, drug development, and clinical pharmacology.',
                'category' => 'science',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 20 – Engineering
            [
                'offset' => 20,
                'question_text' => 'Which type of engineering focuses on water resource management, irrigation systems, and wastewater treatment?',
                'option_a' => 'Chemical Engineering',
                'option_b' => 'Environmental Engineering',
                'option_c' => 'Mining Engineering',
                'option_d' => 'Textile Engineering',
                'correct_option' => 'b',
                'explanation' => 'Environmental Engineering applies science and engineering principles to improve the natural environment. It includes water and wastewater treatment, air pollution control, and solid waste management. It is a fast-growing field in India.',
                'category' => 'engineering',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 21 – Commerce
            [
                'offset' => 21,
                'question_text' => 'In business terminology, what does "ROI" stand for?',
                'option_a' => 'Rate of Inflation',
                'option_b' => 'Return on Investment',
                'option_c' => 'Revenue of Industry',
                'option_d' => 'Risk and Opportunity Index',
                'correct_option' => 'b',
                'explanation' => 'ROI (Return on Investment) is a financial metric used to evaluate the profitability of an investment. It is calculated as (Net Profit / Cost of Investment) × 100. Understanding ROI is essential for careers in finance, consulting, and business analysis.',
                'category' => 'commerce',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 22 – Technology
            [
                'offset' => 22,
                'question_text' => 'Which of the following is a NoSQL database widely used for handling big data?',
                'option_a' => 'MySQL',
                'option_b' => 'PostgreSQL',
                'option_c' => 'MongoDB',
                'option_d' => 'Oracle Database',
                'correct_option' => 'c',
                'explanation' => 'MongoDB is a popular NoSQL document database that stores data in flexible, JSON-like documents. It is widely used in big data applications, real-time analytics, and modern web applications. NoSQL skills are highly sought in data engineering careers.',
                'category' => 'technology',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 23 – Arts
            [
                'offset' => 23,
                'question_text' => 'What is the difference between "Graphic Design" and "Visual Communication"?',
                'option_a' => 'They are exactly the same thing with different names',
                'option_b' => 'Graphic Design focuses on aesthetics while Visual Communication is broader, encompassing meaning and message through visuals',
                'option_c' => 'Visual Communication is only for video content',
                'option_d' => 'Graphic Design is only for print media',
                'correct_option' => 'b',
                'explanation' => 'While Graphic Design focuses primarily on creating visually appealing layouts and designs, Visual Communication is a broader field that encompasses conveying ideas and information through visual forms like typography, illustration, photography, and multimedia.',
                'category' => 'arts',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 24 – General
            [
                'offset' => 24,
                'question_text' => 'What does "STEM" stand for in education and career context?',
                'option_a' => 'Science, Technology, Engineering, and Mathematics',
                'option_b' => 'Students Trained in Engineering Methods',
                'option_c' => 'Standard Testing and Evaluation Metrics',
                'option_d' => 'Strategic Technology and Enterprise Management',
                'correct_option' => 'a',
                'explanation' => 'STEM stands for Science, Technology, Engineering, and Mathematics. STEM careers are among the fastest-growing and highest-paying fields globally, with a projected 10.8% growth rate from 2023-2033 according to the U.S. Bureau of Labor Statistics.',
                'category' => 'general',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 25 – Science
            [
                'offset' => 25,
                'question_text' => 'Which Indian exam is required for admission to MBBS and BDS courses in medical colleges across India?',
                'option_a' => 'JEE Main',
                'option_b' => 'NEET-UG',
                'option_c' => 'UPSC',
                'option_d' => 'AIIMS Entrance',
                'correct_option' => 'b',
                'explanation' => 'NEET-UG (National Eligibility cum Entrance Test – Undergraduate) is the single national-level entrance exam for admission to MBBS, BDS, BAMS, BHMS, and other medical courses in India, conducted by NTA.',
                'category' => 'science',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 26 – Engineering
            [
                'offset' => 26,
                'question_text' => 'Which engineering discipline deals with the design and manufacturing of prosthetic limbs and medical implants?',
                'option_a' => 'Electrical Engineering',
                'option_b' => 'Biomedical Engineering',
                'option_c' => 'Marine Engineering',
                'option_d' => 'Industrial Engineering',
                'correct_option' => 'b',
                'explanation' => 'Biomedical Engineering combines engineering principles with medical sciences to design and create equipment, devices, computer systems, and software used in healthcare. It is one of the fastest-growing engineering branches.',
                'category' => 'engineering',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 27 – Commerce
            [
                'offset' => 27,
                'question_text' => 'What is "GST" and when was it implemented in India?',
                'option_a' => 'General Sales Tax – implemented in 2010',
                'option_b' => 'Goods and Services Tax – implemented on July 1, 2017',
                'option_c' => 'Government Securities Trading – implemented in 2015',
                'option_d' => 'Gross Settlement Transfer – implemented in 2019',
                'correct_option' => 'b',
                'explanation' => 'GST (Goods and Services Tax) is a comprehensive indirect tax on the supply of goods and services. It was rolled out on July 1, 2017, replacing multiple cascading taxes. Understanding GST is essential for commerce, accounting, and tax consultancy careers.',
                'category' => 'commerce',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 28 – Technology
            [
                'offset' => 28,
                'question_text' => 'What is "Machine Learning" in the field of Artificial Intelligence?',
                'option_a' => 'Teaching machines to physically move and walk',
                'option_b' => 'A subset of AI that enables systems to learn and improve from experience without being explicitly programmed',
                'option_c' => 'Programming machines using only machine code (binary)',
                'option_d' => 'A technique for repairing broken computers',
                'correct_option' => 'b',
                'explanation' => 'Machine Learning is a subset of AI where algorithms learn patterns from data to make predictions or decisions without explicit programming. ML engineers and data scientists are among the highest-paid tech professionals globally.',
                'category' => 'technology',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 29 – Arts
            [
                'offset' => 29,
                'question_text' => 'Which renowned Indian institution is specifically dedicated to film education and has produced many Bollywood professionals?',
                'option_a' => 'NID Ahmedabad',
                'option_b' => 'FTII (Film and Television Institute of India), Pune',
                'option_c' => 'NIFT Delhi',
                'option_d' => 'IIT Bombay',
                'correct_option' => 'b',
                'explanation' => 'FTII (Film and Television Institute of India) in Pune is India\'s premier film school, established in 1960. Alumni include Naseeruddin Shah, Jaya Bachchan, Shabana Azmi, and Rajkumar Hirani. It offers courses in direction, cinematography, editing, and more.',
                'category' => 'arts',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 30 – General
            [
                'offset' => 30,
                'question_text' => 'Which government exam in India is considered the toughest and selects officers for IAS, IPS, and IFS services?',
                'option_a' => 'SSC CGL',
                'option_b' => 'UPSC Civil Services Examination',
                'option_c' => 'NDA Exam',
                'option_d' => 'RBI Grade B',
                'correct_option' => 'b',
                'explanation' => 'The UPSC Civil Services Examination is conducted by the Union Public Service Commission to recruit candidates for the All India Services (IAS, IPS, IFS) and Central Services. It has three stages: Prelims, Mains, and Interview, with a success rate below 0.1%.',
                'category' => 'general',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 31 – Science
            [
                'offset' => 31,
                'question_text' => 'What is "Bioinformatics"?',
                'option_a' => 'A type of biological fertilizer',
                'option_b' => 'An interdisciplinary field that uses computational tools to analyze biological data like DNA sequences',
                'option_c' => 'A social media platform for biologists',
                'option_d' => 'The study of information technology hardware',
                'correct_option' => 'b',
                'explanation' => 'Bioinformatics combines biology, computer science, mathematics, and statistics to analyze and interpret biological data. It plays a crucial role in genomics research, drug discovery, and personalized medicine. It\'s a rapidly growing career field.',
                'category' => 'science',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 32 – Engineering
            [
                'offset' => 32,
                'question_text' => 'What does "IoT" stand for, and which engineering field is most closely related to it?',
                'option_a' => 'Internet of Things – Electronics/Computer Engineering',
                'option_b' => 'Integration of Technology – Civil Engineering',
                'option_c' => 'Index of Turbidity – Chemical Engineering',
                'option_d' => 'Institute of Telecommunications – Mechanical Engineering',
                'correct_option' => 'a',
                'explanation' => 'IoT (Internet of Things) refers to the network of physical devices embedded with sensors, software, and connectivity to exchange data. It combines electronics, computer science, and networking engineering. By 2030, over 30 billion IoT devices are expected worldwide.',
                'category' => 'engineering',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 33 – Commerce
            [
                'offset' => 33,
                'question_text' => 'What is the difference between "B2B" and "B2C" business models?',
                'option_a' => 'B2B means Business to Business; B2C means Business to Consumer',
                'option_b' => 'B2B means Buy to Build; B2C means Buy to Create',
                'option_c' => 'They are the same thing',
                'option_d' => 'B2B is for banking; B2C is for construction',
                'correct_option' => 'a',
                'explanation' => 'B2B (Business to Business) involves transactions between companies (e.g., Infosys selling software to banks). B2C (Business to Consumer) involves selling directly to end consumers (e.g., Amazon, Flipkart). Understanding these models is fundamental for marketing and business careers.',
                'category' => 'commerce',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 34 – Technology
            [
                'offset' => 34,
                'question_text' => 'What is "DevOps" in the software industry?',
                'option_a' => 'A programming language created by Facebook',
                'option_b' => 'A culture and set of practices that brings together software development (Dev) and IT operations (Ops)',
                'option_c' => 'A hardware device for network routing',
                'option_d' => 'A project management framework similar to Agile',
                'correct_option' => 'b',
                'explanation' => 'DevOps is a set of practices that combines software development and IT operations to shorten the development lifecycle while delivering features, fixes, and updates more frequently. DevOps engineers are among the most in-demand tech professionals.',
                'category' => 'technology',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 35 – Arts
            [
                'offset' => 35,
                'question_text' => 'What is "NID" and what is it famous for?',
                'option_a' => 'National Institute of Drama – acting courses',
                'option_b' => 'National Institute of Design – India\'s premier design school offering product, textile, and graphic design',
                'option_c' => 'National Institute of Dentistry – dental education',
                'option_d' => 'National Institute of Defense – military training',
                'correct_option' => 'b',
                'explanation' => 'NID (National Institute of Design) in Ahmedabad is India\'s premier design institution, established in 1961. It offers undergraduate (GDPD/B.Des) and postgraduate (PGDPD/M.Des) programs in industrial, textile, graphic, animation, and film design.',
                'category' => 'arts',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 36 – General
            [
                'offset' => 36,
                'question_text' => 'What is the "gig economy"?',
                'option_a' => 'An economy based solely on government jobs',
                'option_b' => 'A labor market characterized by short-term contracts and freelance work as opposed to permanent jobs',
                'option_c' => 'The economy of the music and entertainment industry',
                'option_d' => 'A financial system based on cryptocurrency',
                'correct_option' => 'b',
                'explanation' => 'The gig economy refers to a free market system where temporary, flexible jobs are common and companies hire independent workers for short-term engagements. Examples include freelancing on Upwork, driving for Uber, or delivering for Swiggy.',
                'category' => 'general',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 37 – Science
            [
                'offset' => 37,
                'question_text' => 'What is "Quantum Computing" primarily concerned with?',
                'option_a' => 'Computing using quantum bits (qubits) that can exist in multiple states simultaneously',
                'option_b' => 'Making computers physically smaller',
                'option_c' => 'Using quantum physics to generate electricity',
                'option_d' => 'A type of video game development engine',
                'correct_option' => 'a',
                'explanation' => 'Quantum Computing uses quantum bits (qubits) that can exist in superposition of states (0 and 1 simultaneously), enabling them to perform complex calculations exponentially faster than classical computers. Companies like Google, IBM, and IIT research labs are actively developing quantum computers.',
                'category' => 'science',
                'difficulty' => 'hard',
                'points' => 20,
            ],

            // Day 38 – Engineering
            [
                'offset' => 38,
                'question_text' => 'What is "Mechatronics Engineering"?',
                'option_a' => 'A branch that exclusively studies mechanics',
                'option_b' => 'An interdisciplinary branch combining mechanical, electronics, computer science, and control engineering',
                'option_c' => 'Another name for automobile engineering',
                'option_d' => 'The study of ancient mechanical devices',
                'correct_option' => 'b',
                'explanation' => 'Mechatronics is an interdisciplinary engineering field that integrates mechanical engineering, electronics, computer engineering, and control systems. It is essential for robotics, automation, smart manufacturing, and the design of intelligent systems.',
                'category' => 'engineering',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 39 – Commerce
            [
                'offset' => 39,
                'question_text' => 'What does a "Chartered Financial Analyst (CFA)" certification qualify you for?',
                'option_a' => 'Teaching commerce in schools',
                'option_b' => 'Investment management, financial analysis, and portfolio management roles',
                'option_c' => 'Practicing law in financial courts',
                'option_d' => 'Government tax officer positions only',
                'correct_option' => 'b',
                'explanation' => 'CFA is a globally recognized professional credential offered by the CFA Institute. CFA charterholders typically work in investment banking, portfolio management, equity research, and financial analysis. It requires passing three levels of exams.',
                'category' => 'commerce',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 40 – Technology
            [
                'offset' => 40,
                'question_text' => 'What is "Blockchain" technology primarily known for?',
                'option_a' => 'Creating physical chain-link fences',
                'option_b' => 'A decentralized, immutable ledger technology for recording transactions securely',
                'option_c' => 'A type of antivirus software',
                'option_d' => 'Blocking unauthorized users from social media',
                'correct_option' => 'b',
                'explanation' => 'Blockchain is a distributed, decentralized ledger technology where data is stored in blocks that are chained together cryptographically. It is the foundation of cryptocurrencies like Bitcoin and has applications in supply chain, healthcare, voting systems, and more.',
                'category' => 'technology',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 41 – Arts
            [
                'offset' => 41,
                'question_text' => 'Which career field involves creating visual effects (VFX) for movies and TV shows?',
                'option_a' => 'Sound Engineering',
                'option_b' => 'VFX Artist / Compositor',
                'option_c' => 'Costume Designer',
                'option_d' => 'Script Supervisor',
                'correct_option' => 'b',
                'explanation' => 'VFX (Visual Effects) Artists create computer-generated imagery (CGI) for films, TV, advertisements, and games. They use software like Nuke, Maya, Houdini, and After Effects. India has a growing VFX industry with studios working on Hollywood and Bollywood productions.',
                'category' => 'arts',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 42 – General
            [
                'offset' => 42,
                'question_text' => 'What is an "internship" and why is it important for career development?',
                'option_a' => 'A permanent full-time job with benefits',
                'option_b' => 'A temporary work experience opportunity that provides practical exposure in a professional setting',
                'option_c' => 'An online certification course',
                'option_d' => 'A type of entrance exam',
                'correct_option' => 'b',
                'explanation' => 'An internship is a period of work experience offered by companies for a limited period. It helps students gain practical skills, build professional networks, and explore career paths. Studies show that 70% of interns receive full-time job offers from their internship companies.',
                'category' => 'general',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 43 – Science
            [
                'offset' => 43,
                'question_text' => 'What is "Nanotechnology"?',
                'option_a' => 'Technology for making very large structures',
                'option_b' => 'The manipulation of matter at atomic and molecular scale (1-100 nanometers)',
                'option_c' => 'A type of nano-sized battery',
                'option_d' => 'Software for reducing file sizes',
                'correct_option' => 'b',
                'explanation' => 'Nanotechnology involves manipulating matter at the nanoscale (1-100 nm). It has applications in medicine (targeted drug delivery), electronics (smaller chips), energy (solar cells), and materials science. IITs and IISc offer specialized programs in nanotechnology.',
                'category' => 'science',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 44 – Engineering
            [
                'offset' => 44,
                'question_text' => 'What is "GATE" exam used for in India?',
                'option_a' => 'Admission to undergraduate engineering programs',
                'option_b' => 'Admission to M.Tech/M.E. programs and recruitment to PSUs like ONGC, BHEL, IOCL',
                'option_c' => 'Getting a passport',
                'option_d' => 'Admission to MBA programs',
                'correct_option' => 'b',
                'explanation' => 'GATE (Graduate Aptitude Test in Engineering) is a national-level exam for admission to postgraduate engineering programs (M.Tech/M.E./PhD) at IITs, NITs, and IISc. A good GATE score is also used for recruitment by PSUs like ONGC, BHEL, NTPC, and IOCL.',
                'category' => 'engineering',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 45 – Commerce
            [
                'offset' => 45,
                'question_text' => 'What is "Fintech"?',
                'option_a' => 'Financial Technology – technology used to improve and automate financial services',
                'option_b' => 'A type of government bond',
                'option_c' => 'A financial penalty for late tax filing',
                'option_d' => 'A Finnish technology company',
                'correct_option' => 'a',
                'explanation' => 'Fintech (Financial Technology) refers to technology that seeks to improve and automate the delivery of financial services. Examples include UPI (Unified Payments Interface), Paytm, PhonePe, digital lending, and robo-advisors. India\'s fintech market is one of the fastest-growing globally.',
                'category' => 'commerce',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 46 – Technology
            [
                'offset' => 46,
                'question_text' => 'What does "Full-Stack Developer" mean?',
                'option_a' => 'A developer who only works on database management',
                'option_b' => 'A developer who can work on both the frontend (user interface) and backend (server/database) of a web application',
                'option_c' => 'A developer who stacks multiple monitors',
                'option_d' => 'A developer specializing in mobile app design only',
                'correct_option' => 'b',
                'explanation' => 'A Full-Stack Developer is proficient in both frontend technologies (HTML, CSS, JavaScript, React) and backend technologies (Node.js, Python, databases). Full-stack developers are among the most versatile and in-demand tech professionals with average salaries of ₹8-25 LPA in India.',
                'category' => 'technology',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 47 – Arts
            [
                'offset' => 47,
                'question_text' => 'What does a "Content Strategist" do?',
                'option_a' => 'Builds physical content storage warehouses',
                'option_b' => 'Plans, creates, and manages content to align with business goals and audience needs',
                'option_c' => 'Only writes social media captions',
                'option_d' => 'Repairs broken web pages',
                'correct_option' => 'b',
                'explanation' => 'A Content Strategist plans, develops, and manages content across various channels (websites, social media, blogs) to drive engagement and meet business objectives. It combines writing skills, data analysis, SEO knowledge, and marketing understanding.',
                'category' => 'arts',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 48 – General
            [
                'offset' => 48,
                'question_text' => 'What is "Emotional Intelligence (EQ)" and why is it important at work?',
                'option_a' => 'The ability to score high in IQ tests',
                'option_b' => 'The ability to understand, manage, and express your own emotions and empathize with others',
                'option_c' => 'A measure of how emotional someone is',
                'option_d' => 'A type of artificial intelligence that detects emotions',
                'correct_option' => 'b',
                'explanation' => 'Emotional Intelligence (EQ) is the ability to recognize, understand, and manage one\'s own emotions and those of others. Research shows that 90% of top performers have high EQ. It is crucial for leadership, teamwork, customer relations, and conflict resolution.',
                'category' => 'general',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 49 – Science
            [
                'offset' => 49,
                'question_text' => 'What is "Forensic Science"?',
                'option_a' => 'The science of forest conservation',
                'option_b' => 'The application of scientific methods to solve crimes and legal matters',
                'option_c' => 'A type of foreign exchange system',
                'option_d' => 'The study of fossils',
                'correct_option' => 'b',
                'explanation' => 'Forensic Science applies scientific principles and methods to criminal investigations. It includes fingerprint analysis, DNA profiling, ballistics, toxicology, and digital forensics. NFSU (National Forensic Sciences University) in Gandhinagar is India\'s first dedicated forensic sciences university.',
                'category' => 'science',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 50 – Engineering
            [
                'offset' => 50,
                'question_text' => 'What is "Renewable Energy Engineering" focused on?',
                'option_a' => 'Designing new fossil fuel extraction methods',
                'option_b' => 'Developing systems to harness energy from renewable sources like solar, wind, and hydro power',
                'option_c' => 'Repairing old electrical appliances',
                'option_d' => 'Studying geological formations for oil drilling',
                'correct_option' => 'b',
                'explanation' => 'Renewable Energy Engineering focuses on designing and implementing systems to generate energy from renewable sources like solar, wind, geothermal, and biomass. India has set a target of 500 GW renewable energy by 2030, creating massive career opportunities.',
                'category' => 'engineering',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 51 – Commerce
            [
                'offset' => 51,
                'question_text' => 'What is "Supply Chain Management (SCM)"?',
                'option_a' => 'Managing a chain of retail stores',
                'option_b' => 'Overseeing the entire flow of goods from raw materials to final delivery to the consumer',
                'option_c' => 'A cryptocurrency trading platform',
                'option_d' => 'Managing employee work shifts',
                'correct_option' => 'b',
                'explanation' => 'Supply Chain Management involves planning, implementing, and controlling the efficient flow and storage of goods from point of origin to point of consumption. SCM professionals are vital for companies like Amazon, Flipkart, Reliance, and all manufacturing firms.',
                'category' => 'commerce',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 52 – Technology
            [
                'offset' => 52,
                'question_text' => 'What is "Cybersecurity" as a career field?',
                'option_a' => 'Building cybercafes and gaming centers',
                'option_b' => 'Protecting computer systems, networks, and data from digital attacks, theft, and damage',
                'option_c' => 'Creating cybernetic robot parts',
                'option_d' => 'Social media content moderation',
                'correct_option' => 'b',
                'explanation' => 'Cybersecurity professionals protect organizations from cyber threats including hacking, phishing, ransomware, and data breaches. There are 3.5 million unfilled cybersecurity jobs globally. Certifications like CEH, CISSP, and CompTIA Security+ are highly valued.',
                'category' => 'technology',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 53 – Arts
            [
                'offset' => 53,
                'question_text' => 'What does a "Motion Graphics Designer" do?',
                'option_a' => 'Designs physical motion-sensor devices',
                'option_b' => 'Creates animated visual content for videos, advertisements, films, and digital media',
                'option_c' => 'Programs robots to move',
                'option_d' => 'Designs athletic workout programs',
                'correct_option' => 'b',
                'explanation' => 'Motion Graphics Designers create animated visual elements for use in video content, advertisements, title sequences, and digital media. They use tools like Adobe After Effects, Cinema 4D, and Blender. It is a growing field with demand from YouTube, OTT platforms, and ad agencies.',
                'category' => 'arts',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 54 – General
            [
                'offset' => 54,
                'question_text' => 'What is a "LinkedIn" profile primarily used for?',
                'option_a' => 'Sharing personal vacation photos',
                'option_b' => 'Professional networking, job searching, and building a career brand',
                'option_c' => 'Playing online games',
                'option_d' => 'Ordering food delivery',
                'correct_option' => 'b',
                'explanation' => 'LinkedIn is the world\'s largest professional networking platform with 900+ million members. It is used for building professional connections, job hunting, sharing industry insights, and building a personal career brand. 87% of recruiters regularly use LinkedIn to find candidates.',
                'category' => 'general',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 55 – Science
            [
                'offset' => 55,
                'question_text' => 'What career does a "Data Scientist" pursue?',
                'option_a' => 'Entering data into spreadsheets all day',
                'option_b' => 'Analyzing complex data using statistics, machine learning, and programming to derive actionable business insights',
                'option_c' => 'Physically archiving paper documents',
                'option_d' => 'Teaching science in middle schools',
                'correct_option' => 'b',
                'explanation' => 'Data Scientists analyze complex data sets using statistical methods, machine learning, and programming (Python, R, SQL) to extract insights that drive business decisions. Harvard Business Review called it "the sexiest job of the 21st century." Average salary in India: ₹10-30 LPA.',
                'category' => 'science',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 56 – Engineering
            [
                'offset' => 56,
                'question_text' => 'Which engineering field focuses on designing robots and autonomous systems?',
                'option_a' => 'Textile Engineering',
                'option_b' => 'Robotics Engineering',
                'option_c' => 'Agricultural Engineering',
                'option_d' => 'Mining Engineering',
                'correct_option' => 'b',
                'explanation' => 'Robotics Engineering is an interdisciplinary field combining mechanical, electrical, and computer engineering to design, build, and operate robots. It has applications in manufacturing, healthcare (surgical robots), exploration, and autonomous vehicles.',
                'category' => 'engineering',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 57 – Commerce
            [
                'offset' => 57,
                'question_text' => 'What is "Venture Capital" (VC)?',
                'option_a' => 'A government loan scheme for farmers',
                'option_b' => 'A form of private equity financing provided to startups and small businesses with high growth potential',
                'option_c' => 'An adventure tourism company',
                'option_d' => 'A type of fixed deposit in banks',
                'correct_option' => 'b',
                'explanation' => 'Venture Capital is a form of private equity where investors provide funding to startups and early-stage companies in exchange for equity. Notable Indian VC firms include Sequoia Capital India, Accel, and Tiger Global. VC-backed startups include Flipkart, Ola, and Razorpay.',
                'category' => 'commerce',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 58 – Technology
            [
                'offset' => 58,
                'question_text' => 'What is "Natural Language Processing (NLP)" in AI?',
                'option_a' => 'A technique for learning foreign languages faster',
                'option_b' => 'A branch of AI that helps computers understand, interpret, and respond to human language',
                'option_c' => 'A method of compressing audio files',
                'option_d' => 'A networking protocol for local area networks',
                'correct_option' => 'b',
                'explanation' => 'NLP is a branch of artificial intelligence that enables computers to understand, interpret, and generate human language. Applications include chatbots (like ChatGPT), language translation (Google Translate), voice assistants (Siri, Alexa), and sentiment analysis.',
                'category' => 'technology',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 59 – Arts
            [
                'offset' => 59,
                'question_text' => 'What is "Industrial Design" concerned with?',
                'option_a' => 'Designing the interiors of factories only',
                'option_b' => 'Creating and developing concepts and specifications for manufactured products that optimize function, value, and appearance',
                'option_c' => 'Painting industrial landscapes',
                'option_d' => 'Designing work uniforms',
                'correct_option' => 'b',
                'explanation' => 'Industrial Design is a professional practice of designing products used by millions of people daily – from smartphones and furniture to vehicles and medical devices. Industrial designers blend art, business, and engineering. NID and IIT IDC Mumbai are premier Indian institutions.',
                'category' => 'arts',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 60 – General
            [
                'offset' => 60,
                'question_text' => 'What is a "Personal Brand" in career development?',
                'option_a' => 'A clothing brand you start on your own',
                'option_b' => 'The unique combination of skills, experience, and personality that you want others to see in a professional context',
                'option_c' => 'Your social media follower count',
                'option_d' => 'A brand tattoo you get for personal identity',
                'correct_option' => 'b',
                'explanation' => 'Your personal brand is how you present yourself professionally – your unique value proposition, expertise, online presence, and reputation. Building a strong personal brand through LinkedIn, portfolios, and thought leadership is crucial for career advancement.',
                'category' => 'general',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 61 – Science
            [
                'offset' => 61,
                'question_text' => 'What is "Clinical Research" as a career?',
                'option_a' => 'Research conducted in a clinic to fix building infrastructure',
                'option_b' => 'Scientific studies conducted on human volunteers to test new drugs, treatments, and medical devices',
                'option_c' => 'Cleaning research laboratories',
                'option_d' => 'Researching ancient clinical texts',
                'correct_option' => 'b',
                'explanation' => 'Clinical Research involves testing new drugs, devices, or treatments in human volunteers to determine safety and efficacy. Clinical Research Associates (CRAs) and Clinical Data Managers are key roles. India is a major hub for clinical trials with companies like Quintiles, IQVIA, and Covance.',
                'category' => 'science',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 62 – Engineering
            [
                'offset' => 62,
                'question_text' => 'What is "3D Printing" (Additive Manufacturing) and which engineering fields use it most?',
                'option_a' => 'Printing 3D images on paper – used in graphic design',
                'option_b' => 'Creating three-dimensional objects layer by layer from digital models – used in mechanical, biomedical, and aerospace engineering',
                'option_c' => 'A type of photography technique – used in arts',
                'option_d' => 'Converting 2D movies to 3D – used in film technology',
                'correct_option' => 'b',
                'explanation' => '3D Printing (Additive Manufacturing) creates objects by depositing material layer by layer based on digital designs. It is used for rapid prototyping, custom medical implants, aerospace components, and architectural models. The global 3D printing market is expected to reach $100+ billion by 2030.',
                'category' => 'engineering',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 63 – Commerce
            [
                'offset' => 63,
                'question_text' => 'What is "Digital Marketing" and why is it in high demand?',
                'option_a' => 'Marketing digital watches and electronics',
                'option_b' => 'Promoting products/services through digital channels like search engines, social media, email, and websites',
                'option_c' => 'Converting physical marketing materials to PDF',
                'option_d' => 'Making phone calls to potential customers',
                'correct_option' => 'b',
                'explanation' => 'Digital Marketing encompasses SEO, social media marketing, email marketing, PPC advertising, content marketing, and analytics. India\'s digital advertising market crossed ₹50,000 crore in 2024. Digital marketers are among the most sought-after professionals.',
                'category' => 'commerce',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 64 – Technology
            [
                'offset' => 64,
                'question_text' => 'What is "Edge Computing"?',
                'option_a' => 'Computing performed on the edges of a computer monitor screen',
                'option_b' => 'Processing data closer to the source (at the edge of the network) rather than in a centralized data center',
                'option_c' => 'A type of graphics processing for video games',
                'option_d' => 'An extreme sports analytics platform',
                'correct_option' => 'b',
                'explanation' => 'Edge Computing processes data near the source of data generation (edge devices) rather than relying on a central data center. It reduces latency, saves bandwidth, and is critical for IoT, autonomous vehicles, and real-time applications.',
                'category' => 'technology',
                'difficulty' => 'hard',
                'points' => 20,
            ],

            // Day 65 – Arts
            [
                'offset' => 65,
                'question_text' => 'What is the role of a "Curator" in an art museum or gallery?',
                'option_a' => 'Cleaning and maintaining the museum building',
                'option_b' => 'Selecting, organizing, and managing collections of artworks and exhibitions',
                'option_c' => 'Selling tickets at the entrance',
                'option_d' => 'Creating the artwork displayed in the gallery',
                'correct_option' => 'b',
                'explanation' => 'A Curator is responsible for assembling, cataloging, managing, and presenting artistic or historical collections. They research artworks, plan exhibitions, write catalog essays, and preserve cultural heritage. Museum curation is a career for those passionate about art history and culture.',
                'category' => 'arts',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 66 – General
            [
                'offset' => 66,
                'question_text' => 'What is "Upskilling" and why is it important in today\'s job market?',
                'option_a' => 'Playing skill-based video games',
                'option_b' => 'Learning new skills or enhancing existing ones to stay relevant and advance in your career',
                'option_c' => 'Physically moving to a higher floor in the office',
                'option_d' => 'Upgrading your computer\'s hardware skills',
                'correct_option' => 'b',
                'explanation' => 'Upskilling means acquiring new and relevant competencies to stay competitive in a rapidly changing job market. The World Economic Forum estimates that by 2027, 60% of workers will require significant upskilling. Platforms like Coursera, Udemy, NPTEL, and SWAYAM offer upskilling courses.',
                'category' => 'general',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 67 – Science
            [
                'offset' => 67,
                'question_text' => 'What does an "Astrophysicist" study?',
                'option_a' => 'The physics of sports and athletics',
                'option_b' => 'The physical properties and behavior of celestial objects like stars, galaxies, and the universe',
                'option_c' => 'The design of astrology horoscope charts',
                'option_d' => 'The chemistry of food and nutrition',
                'correct_option' => 'b',
                'explanation' => 'Astrophysicists study the physical properties of celestial bodies (stars, planets, galaxies) and the universe. ISRO, IUCAA (Pune), ARIES (Nainital), and IITs offer research opportunities. Notable Indian astrophysicists include Jayant Narlikar and Subrahmanyan Chandrasekhar (Nobel laureate).',
                'category' => 'science',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 68 – Engineering
            [
                'offset' => 68,
                'question_text' => 'What is "CAD" software used for in engineering?',
                'option_a' => 'Computer Aided Detection of cyber attacks',
                'option_b' => 'Computer Aided Design – creating precise 2D drawings and 3D models of products and structures',
                'option_c' => 'Central Audio Distribution for sound engineering',
                'option_d' => 'Credit And Debit management software',
                'correct_option' => 'b',
                'explanation' => 'CAD (Computer Aided Design) software like AutoCAD, SolidWorks, CATIA, and Fusion 360 is used to create detailed 2D and 3D designs for engineering products, buildings, and machinery. CAD proficiency is essential for mechanical, civil, and product design engineers.',
                'category' => 'engineering',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 69 – Commerce
            [
                'offset' => 69,
                'question_text' => 'What is "Actuarial Science"?',
                'option_a' => 'The science of acting and theatre performance',
                'option_b' => 'A discipline that uses mathematics, statistics, and financial theory to assess financial risk in insurance and finance',
                'option_c' => 'The actual real-world application of any science',
                'option_d' => 'A branch of astronomy',
                'correct_option' => 'b',
                'explanation' => 'Actuarial Science uses mathematical and statistical methods to assess risk in the insurance and finance industries. Actuaries are among the highest-paid professionals globally. In India, the Institute of Actuaries of India (IAI) conducts the qualification exams.',
                'category' => 'commerce',
                'difficulty' => 'hard',
                'points' => 20,
            ],

            // Day 70 – Technology
            [
                'offset' => 70,
                'question_text' => 'What is the role of a "Product Manager" in a tech company?',
                'option_a' => 'Managing the physical products in a warehouse',
                'option_b' => 'Defining the product vision, strategy, and roadmap while working with engineering, design, and business teams',
                'option_c' => 'Testing products for physical defects',
                'option_d' => 'Writing the company\'s annual report',
                'correct_option' => 'b',
                'explanation' => 'A Product Manager (PM) is responsible for the strategy, roadmap, and feature definition of a product. They bridge the gap between business, technology, and user needs. PM roles at companies like Google, Microsoft, and Amazon are among the most competitive and highly paid positions.',
                'category' => 'technology',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 71 – Arts
            [
                'offset' => 71,
                'question_text' => 'What is "Typography" in the context of design?',
                'option_a' => 'The study of types of graphs and charts',
                'option_b' => 'The art and technique of arranging type (fonts) to make written language legible, readable, and visually appealing',
                'option_c' => 'A type of keyboard typing speed test',
                'option_d' => 'The classification of typewriters',
                'correct_option' => 'b',
                'explanation' => 'Typography is a core element of design that involves selecting typefaces, point sizes, line lengths, spacing, and layout. Good typography enhances readability and user experience. It is a critical skill for graphic designers, UI/UX designers, and brand designers.',
                'category' => 'arts',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 72 – General
            [
                'offset' => 72,
                'question_text' => 'What is the "80/20 Rule" (Pareto Principle) used in productivity and business?',
                'option_a' => '80% of work should be done by 20% of employees',
                'option_b' => '80% of results come from 20% of efforts/causes',
                'option_c' => '80% salary should be saved and 20% spent',
                'option_d' => '80% of time should be at work and 20% on breaks',
                'correct_option' => 'b',
                'explanation' => 'The Pareto Principle states that roughly 80% of outcomes come from 20% of causes. In business: 80% of revenue often comes from 20% of customers. In productivity: focusing on the vital 20% of tasks delivers 80% of results. It is a key concept in management and consulting.',
                'category' => 'general',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 73 – Science
            [
                'offset' => 73,
                'question_text' => 'What is "Environmental Science" as a career field?',
                'option_a' => 'A branch of social science studying office environments',
                'option_b' => 'The study of interactions between physical, chemical, and biological components of the environment and solutions to environmental problems',
                'option_c' => 'Designing eco-friendly interior decorations',
                'option_d' => 'Selling solar panels door to door',
                'correct_option' => 'b',
                'explanation' => 'Environmental Science integrates physical, biological, and information sciences to study the environment and find solutions to environmental problems like climate change, pollution, and biodiversity loss. Career options include environmental consulting, conservation biology, and sustainability management.',
                'category' => 'science',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 74 – Engineering
            [
                'offset' => 74,
                'question_text' => 'What is "Embedded Systems" engineering?',
                'option_a' => 'Embedding precious stones in jewelry',
                'option_b' => 'Designing computer systems that are integrated into other devices like cars, medical equipment, and IoT devices',
                'option_c' => 'Burying electrical cables underground',
                'option_d' => 'Installing embedded tile flooring',
                'correct_option' => 'b',
                'explanation' => 'Embedded Systems engineering involves designing computer systems within larger mechanical or electronic systems. Examples include car engine control units, pacemakers, smart watches, and washing machine controllers. It combines hardware design and software programming.',
                'category' => 'engineering',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 75 – Commerce
            [
                'offset' => 75,
                'question_text' => 'What is "E-commerce" and which Indian platform is the largest in this space?',
                'option_a' => 'E-commerce means electronic communication; LinkedIn is the largest',
                'option_b' => 'E-commerce is buying/selling goods online; Flipkart and Amazon India are the largest platforms',
                'option_c' => 'E-commerce is electronic commuting; Ola is the largest',
                'option_d' => 'E-commerce is email-based commerce; Gmail is the platform',
                'correct_option' => 'b',
                'explanation' => 'E-commerce (Electronic Commerce) involves buying and selling goods/services over the internet. India\'s e-commerce market is projected to reach $350 billion by 2030. Major platforms include Amazon India, Flipkart, Meesho, and JioMart. E-commerce has created millions of jobs in logistics, tech, and marketing.',
                'category' => 'commerce',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 76 – Technology
            [
                'offset' => 76,
                'question_text' => 'What is "Kubernetes" used for in modern software deployment?',
                'option_a' => 'A programming language developed by Microsoft',
                'option_b' => 'An open-source container orchestration platform for automating deployment, scaling, and management of containerized applications',
                'option_c' => 'A video game development engine',
                'option_d' => 'A social media analytics tool',
                'correct_option' => 'b',
                'explanation' => 'Kubernetes (K8s) is an open-source system originally developed by Google for automating the deployment, scaling, and management of containerized applications. It is one of the most in-demand DevOps skills, and Kubernetes engineers command premium salaries.',
                'category' => 'technology',
                'difficulty' => 'hard',
                'points' => 20,
            ],

            // Day 77 – Arts
            [
                'offset' => 77,
                'question_text' => 'What is "Sustainable Fashion Design"?',
                'option_a' => 'Fashion that sustains rain and wind (waterproof clothing only)',
                'option_b' => 'Designing clothing and accessories that minimize environmental impact through eco-friendly materials and ethical production',
                'option_c' => 'Making fashion that lasts forever without washing',
                'option_d' => 'Designing clothes only in natural brown and green colors',
                'correct_option' => 'b',
                'explanation' => 'Sustainable Fashion Design focuses on creating clothing with minimal environmental impact using eco-friendly fabrics, ethical labor practices, and circular design principles. NIFT (National Institute of Fashion Technology) offers courses that include sustainability in their curriculum.',
                'category' => 'arts',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 78 – General
            [
                'offset' => 78,
                'question_text' => 'What is a "Resume/CV" and what makes a strong one?',
                'option_a' => 'A document listing only your hobbies and interests',
                'option_b' => 'A document summarizing your education, skills, work experience, and achievements tailored to a job application',
                'option_c' => 'A creative story about your life experiences',
                'option_d' => 'A list of all websites you\'ve visited',
                'correct_option' => 'b',
                'explanation' => 'A Resume/CV is a formal document that summarizes your qualifications, education, work experience, and skills. A strong resume is concise (1-2 pages), tailored to the job, uses action verbs, quantifies achievements, and is formatted cleanly. Recruiters spend an average of 7 seconds on the first scan.',
                'category' => 'general',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 79 – Science
            [
                'offset' => 79,
                'question_text' => 'What is "Artificial General Intelligence (AGI)"?',
                'option_a' => 'AI that can only play chess',
                'option_b' => 'AI that possesses the ability to understand, learn, and apply intelligence across a wide range of tasks, similar to human intelligence',
                'option_c' => 'AI that generates art and images',
                'option_d' => 'A general-purpose calculator',
                'correct_option' => 'b',
                'explanation' => 'AGI refers to highly autonomous systems that outperform humans at most economically valuable work, possessing generalized human cognitive abilities. Unlike narrow AI (which excels at specific tasks), AGI would be able to reason, plan, and learn across domains like a human.',
                'category' => 'science',
                'difficulty' => 'hard',
                'points' => 20,
            ],

            // Day 80 – Engineering
            [
                'offset' => 80,
                'question_text' => 'What is "Structural Engineering" and where do structural engineers work?',
                'option_a' => 'Engineering the structure of software code',
                'option_b' => 'Designing and analyzing structures (buildings, bridges, dams) to ensure they safely support loads and resist forces',
                'option_c' => 'Structuring corporate organizations',
                'option_d' => 'Engineering structural changes in DNA',
                'correct_option' => 'b',
                'explanation' => 'Structural Engineers ensure that buildings, bridges, tunnels, and other structures are safe, stable, and strong enough to withstand environmental forces. They work in construction firms, consulting companies, government agencies, and infrastructure development organizations.',
                'category' => 'engineering',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 81 – Commerce
            [
                'offset' => 81,
                'question_text' => 'What is "Microfinance" and why is it important in India?',
                'option_a' => 'Finance for buying microscopes',
                'option_b' => 'Providing small loans and financial services to low-income individuals and entrepreneurs who lack access to traditional banking',
                'option_c' => 'A Microsoft financial software product',
                'option_d' => 'Managing finances for micro-organisms research',
                'correct_option' => 'b',
                'explanation' => 'Microfinance provides financial services (small loans, savings, insurance) to economically disadvantaged individuals, especially in rural India. Organizations like Grameen Bank, Bandhan Bank, and SKS Microfinance have empowered millions. It\'s a vital career field combining finance and social impact.',
                'category' => 'commerce',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 82 – Technology
            [
                'offset' => 82,
                'question_text' => 'What is "Augmented Reality (AR)" and how is it different from "Virtual Reality (VR)"?',
                'option_a' => 'AR and VR are the same technology with different names',
                'option_b' => 'AR overlays digital content onto the real world; VR creates a completely immersive virtual environment',
                'option_c' => 'AR is for audio; VR is for video',
                'option_d' => 'AR is for adults; VR is for children',
                'correct_option' => 'b',
                'explanation' => 'AR (Augmented Reality) adds digital elements to the real world (e.g., Pokémon Go, Instagram filters), while VR (Virtual Reality) creates a fully immersive digital environment (e.g., Oculus headsets). Both fields offer growing career opportunities in gaming, healthcare, education, and retail.',
                'category' => 'technology',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 83 – Arts
            [
                'offset' => 83,
                'question_text' => 'What is "Art Therapy" as a career?',
                'option_a' => 'Repairing damaged artworks in museums',
                'option_b' => 'Using art-making processes to help people explore emotions, reduce anxiety, improve self-esteem, and manage mental health conditions',
                'option_c' => 'Teaching art in schools as therapy for teachers',
                'option_d' => 'Selling art to fund therapy sessions',
                'correct_option' => 'b',
                'explanation' => 'Art Therapy is a mental health profession that uses the creative process of art-making to improve physical, mental, and emotional well-being. Art therapists work in hospitals, schools, rehabilitation centers, and private practice. It combines psychology with creative arts.',
                'category' => 'arts',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 84 – General
            [
                'offset' => 84,
                'question_text' => 'What is "Remote Work" and how has it changed the job market?',
                'option_a' => 'Working in remote villages only',
                'option_b' => 'Working from any location outside the traditional office using technology, which has expanded job opportunities globally',
                'option_c' => 'Remotely controlling industrial machinery',
                'option_d' => 'Working exclusively at night shifts',
                'correct_option' => 'b',
                'explanation' => 'Remote work allows employees to work from home or any location with internet connectivity. Post-COVID, 16% of companies worldwide are fully remote. It has opened global job opportunities for Indian professionals, especially in tech, design, content, and consulting fields.',
                'category' => 'general',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 85 – Science
            [
                'offset' => 85,
                'question_text' => 'What is "Genetic Counseling" as a career?',
                'option_a' => 'Advising people on which genes to buy for their wardrobe',
                'option_b' => 'Helping individuals understand and adapt to the medical, psychological, and familial implications of genetic conditions',
                'option_c' => 'General counseling sessions with friends and family',
                'option_d' => 'Counseling plants for better gene growth',
                'correct_option' => 'b',
                'explanation' => 'Genetic Counselors help people understand genetic test results, assess hereditary disease risk, and make informed medical decisions. With advances in genomic medicine, this field is growing rapidly. A Master\'s degree in Genetic Counseling is typically required.',
                'category' => 'science',
                'difficulty' => 'medium',
                'points' => 15,
            ],

            // Day 86 – Engineering
            [
                'offset' => 86,
                'question_text' => 'What does "EV" stand for and which engineering field is crucial for the EV industry?',
                'option_a' => 'Electronic Voting – Computer Science',
                'option_b' => 'Electric Vehicle – Electrical, Mechanical, and Battery Engineering',
                'option_c' => 'Environmental Visualization – Environmental Engineering',
                'option_d' => 'Emergency Vehicle – Automotive Design',
                'correct_option' => 'b',
                'explanation' => 'Electric Vehicles (EVs) are powered by electric motors instead of internal combustion engines. India aims for 30% EV penetration by 2030. Careers in EV engineering span battery technology, power electronics, motor design, and charging infrastructure. Companies like Tata Motors, Ola Electric, and Ather Energy are hiring aggressively.',
                'category' => 'engineering',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 87 – Commerce
            [
                'offset' => 87,
                'question_text' => 'What is "ESG" investing?',
                'option_a' => 'Extra Special Government bonds',
                'option_b' => 'Environmental, Social, and Governance – an investing approach that evaluates companies on sustainability and ethical impact',
                'option_c' => 'Electronic Stock Gateway – a trading platform',
                'option_d' => 'European Standard Guidelines for banking',
                'correct_option' => 'b',
                'explanation' => 'ESG (Environmental, Social, and Governance) investing evaluates companies based on their environmental impact, social responsibility, and corporate governance practices. ESG-focused investment funds have grown rapidly, and ESG analysts/consultants are in increasing demand.',
                'category' => 'commerce',
                'difficulty' => 'hard',
                'points' => 20,
            ],

            // Day 88 – Technology
            [
                'offset' => 88,
                'question_text' => 'What is a "Tech Stack" in software development?',
                'option_a' => 'A physical stack of tech books',
                'option_b' => 'The combination of programming languages, frameworks, tools, and technologies used to build a software application',
                'option_c' => 'A stack of computer hardware components',
                'option_d' => 'A file organization method on desktops',
                'correct_option' => 'b',
                'explanation' => 'A tech stack (e.g., MERN: MongoDB, Express.js, React, Node.js) is the set of technologies used to build an application. Understanding tech stacks is essential for developers, architects, and CTOs. Popular stacks include MERN, MEAN, LAMP, and Django + React.',
                'category' => 'technology',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 89 – Arts
            [
                'offset' => 89,
                'question_text' => 'What is "Game Design" as a career?',
                'option_a' => 'Playing video games professionally',
                'option_b' => 'Creating the rules, mechanics, storylines, characters, and overall experience of video games',
                'option_c' => 'Manufacturing gaming consoles',
                'option_d' => 'Designing board games for schools only',
                'correct_option' => 'b',
                'explanation' => 'Game Designers create the concepts, rules, storylines, characters, and game mechanics. They work with artists, programmers, and sound designers to build engaging experiences. India\'s gaming industry is worth over $3 billion. Studios like Ubisoft Pune, Rockstar India, and Indian startups offer opportunities.',
                'category' => 'arts',
                'difficulty' => 'easy',
                'points' => 10,
            ],

            // Day 90 – General
            [
                'offset' => 90,
                'question_text' => 'What is "Design Thinking" and why do companies like Google, Apple, and Samsung use it?',
                'option_a' => 'Thinking about design while decorating offices',
                'option_b' => 'A human-centered, iterative problem-solving approach with five stages: Empathize, Define, Ideate, Prototype, and Test',
                'option_c' => 'A thinking cap you wear while designing',
                'option_d' => 'Designing logos for corporate companies',
                'correct_option' => 'b',
                'explanation' => 'Design Thinking is a non-linear, iterative process that teams use to understand users, challenge assumptions, redefine problems, and create innovative solutions. Its five phases are: Empathize, Define, Ideate, Prototype, and Test. It is used across industries from tech to healthcare to education.',
                'category' => 'general',
                'difficulty' => 'medium',
                'points' => 15,
            ],
        ];

        // Clear existing quiz questions to avoid unique constraint issues
        // (SQLite date format mismatch with Eloquent's date cast)
        DailyQuizQuestion::query()->delete();

        foreach ($questions as $index => $q) {
            $dayOffset = floor(($index - 10) / 10);
            $quizDate = Carbon::today()->addDays($dayOffset)->toDateString();

            DailyQuizQuestion::create([
                'quiz_date'      => $quizDate,
                'question_text'  => $q['question_text'],
                'option_a'       => $q['option_a'],
                'option_b'       => $q['option_b'],
                'option_c'       => $q['option_c'],
                'option_d'       => $q['option_d'],
                'correct_option' => $q['correct_option'],
                'explanation'    => $q['explanation'],
                'category'       => $q['category'],
                'difficulty'     => $q['difficulty'],
                'points'         => $q['points'],
                'is_active'      => true,
            ]);
        }
    }
}
