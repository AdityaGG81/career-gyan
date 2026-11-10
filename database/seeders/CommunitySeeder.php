<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CommunityPost;
use App\Models\CommunityAnswer;
use Illuminate\Support\Str;

class CommunitySeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'channel' => 'college-admissions',
                'title' => 'MHT CET 98.4 Percentile — Can I get COEP Pune or VJTI Mumbai for Computer Engineering / IT?',
                'content' => "Hey everyone! I just calculated my MHT CET score and estimating around 98.4 to 98.7 percentile (General Open category, Maharashtra State candidate).

My primary target has always been COEP Technological University or VJTI Mumbai for Computer Engineering or Information Technology. If not CS/IT, what are my chances in EnTC or Electrical in these colleges? Also, how does PICT Pune or SPIT Mumbai compare for CS placements?

Would really appreciate insights from seniors or counselors who navigated CAP rounds recently!",
                'author_name' => 'Prathamesh Kulkarni',
                'author_persona' => '10th/12th Student',
                'author_headline' => 'MHT-CET 2026 Aspirant &bull; Target CS/IT',
                'tags' => ['MHT-CET', 'COEP', 'VJTI', 'Cutoffs', 'Engineering Admissions'],
                'upvotes_count' => 42,
                'views_count' => 610,
                'answers' => [
                    [
                        'author_name' => 'Prof. K. Deshmukh',
                        'author_persona' => 'Career Counselor',
                        'author_headline' => 'Ex-DTE Admissions Counselor &bull; 14+ Yrs Exp',
                        'content' => "At 98.4–98.7 percentile in Open General:

1. **COEP & VJTI CS/IT**: The closing cutoff in CAP Round 1 & 2 for Computer Engineering typically hovers between **99.75 to 99.85 percentile**. So direct CS/IT in Round 1 will be tough in COEP/VJTI.
2. **COEP / VJTI EnTC**: Highly achievable! EnTC at COEP usually closes around 98.5–98.8 percentile. EnTC students are allowed in 85%+ of tech placement drives.
3. **Top Alternatives**:
   - **PICT Pune (CS/IT)**: Excellent placement track record, average package 12–14 LPA. Round 3 cutoff is around 98.8–99.1.
   - **SPIT Mumbai**: Extensively sought-after, cutoff ~99.0+.
   - **Walchand Sangli (CS/IT)**: Strongly recommended as a guaranteed safe tier-1 option.

Make sure you participate in the Institute-level Spot Rounds after CAP 3—that is where many students snag vacant CS/IT seats!",
                        'upvotes_count' => 38,
                        'is_accepted' => true,
                        'is_expert_answer' => true,
                    ],
                    [
                        'author_name' => 'Rohan Mehta',
                        'author_persona' => 'College Student',
                        'author_headline' => '3rd Year B.Tech IT @ VJTI Mumbai',
                        'content' => "VJTI senior here! Don't get disheartened if you don't get pure CS in Round 1. EnTC at VJTI is phenomenal, and you share almost all placement opportunities with CS/IT folks (Google, Microsoft, Morgan Stanley, Barclays visit regularly). Also, PICT Pune is a coding powerhouse if you strictly want a software-focused environment.",
                        'upvotes_count' => 19,
                        'is_accepted' => false,
                        'is_expert_answer' => false,
                    ]
                ]
            ],
            [
                'channel' => 'medical-ayush',
                'title' => 'Is BAMS (Ayurveda) a viable career path in 2026 compared to MBBS / BDS? Realistic scope & earnings?',
                'content' => "I scored around 480 in NEET. Government MBBS seems out of reach in my state quota, and private MBBS fees (Rs. 60-80 Lakhs) are completely unaffordable for my middle-class family.

I am getting a good Govt / Semi-Govt BAMS seat. However, relatives are skeptical and saying 'Ayurveda has no future'. 

Could practitioners or students tell me the ground reality? What is the clinical scope, post-graduation (MD/MS Ayurveda), hospital jobs, and private practice potential?",
                'author_name' => 'Sneha Patil',
                'author_persona' => '10th/12th Student',
                'author_headline' => 'NEET Aspirant &bull; Exploring BAMS vs BDS',
                'tags' => ['NEET', 'BAMS', 'Ayurveda', 'Medical Careers', 'Doctor'],
                'upvotes_count' => 56,
                'views_count' => 840,
                'answers' => [
                    [
                        'author_name' => 'Dr. Aniruddha Joshi',
                        'author_persona' => 'Working Professional',
                        'author_headline' => 'BAMS, MD (Ayurveda) &bull; Clinical Director @ AyurWellness',
                        'content' => "Sneha, ignore the uninformed skepticism. Here is the objective truth:

1. **Hospital & Emergency Jobs**: In Maharashtra and several states, BAMS graduates work extensively as Resident Medical Officers (RMOs) in major private multi-specialty hospitals earning 45k–70k/month right after internship.
2. **Post-Graduation (AIAPGET)**: If you clear MD/MS Ayurveda (in Panchakarma, Shalya Tantra / Surgery, Kaumarbhritya), you become a recognized consultant with very high patient trust.
3. **Wellness & Global Demand**: With integrative medicine gaining immense traction globally (Europe, US, Gulf), Ayurvedic wellness, lifestyle management, and Panchakarma clinics are flourishing.
4. **Financial Autonomy**: In private practice, after 3–5 years of building patient trust, BAMS doctors earn 1.5–3+ Lakhs/month with significantly lower startup capital than a dental clinic.

Choose BAMS proudly over a crippling 70-Lakh education loan for private MBBS.",
                        'upvotes_count' => 49,
                        'is_accepted' => true,
                        'is_expert_answer' => true,
                    ]
                ]
            ],
            [
                'channel' => 'engineering',
                'title' => 'Mechanical Engineer wanting to switch to AI & Data Science: What is the realistic roadmap?',
                'content' => "I graduated in Mechanical Engineering in 2024 and currently work at an auto parts manufacturing firm (salary 3.6 LPA). I have developed a strong passion for Python, statistics, and machine learning.

I want to pivot to a Junior Data Analyst or Machine Learning Engineer role within 8 months. Will tech recruiters consider a non-CS graduate? What should my portfolio look like to stand out?",
                'author_name' => 'Vikas Shinde',
                'author_persona' => 'Working Professional',
                'author_headline' => 'Mechanical Engineer &bull; Transitioning to Data Science',
                'tags' => ['AI', 'Data Science', 'Career Switch', 'Python', 'Mechanical to IT'],
                'upvotes_count' => 31,
                'views_count' => 490,
                'answers' => [
                    [
                        'author_name' => 'Siddharth Rao',
                        'author_persona' => 'Working Professional',
                        'author_headline' => 'Senior ML Engineer @ Microsoft &bull; Ex-Mechanical',
                        'content' => "I made the exact same switch 5 years ago! Here is your step-by-step roadmap:

- **Phase 1 (Month 1-2)**: Master Python (pandas, numpy), SQL (crucial—80% of analyst interviews test advanced joins/window functions), and Exploratory Data Analysis.
- **Phase 2 (Month 3-4)**: Core ML (Scikit-Learn, regression, classification, random forests) and PowerBI / Tableau.
- **Phase 3 (Month 5-6)**: Build 3 end-to-end deployed projects. **Do NOT just copy Titanic or Iris datasets.** Build a real predictive maintenance model for mechanical equipment or an automated scraper analyzing car prices. Deploy them on Streamlit / Hugging Face with clean GitHub READMEs.
- **Phase 4 (Month 7-8)**: Target Data Analyst / BI Engineer roles first. Once inside a tech organization, transition internally to Data Science within 18 months.",
                        'upvotes_count' => 28,
                        'is_accepted' => true,
                        'is_expert_answer' => true,
                    ]
                ]
            ],
            [
                'channel' => 'business-startups',
                'title' => 'Starting a small D2C Millet & Organic Snacks brand in Pune with Rs. 2-3 Lakh initial capital',
                'content' => "My mother and I make traditional millet snacks, roasted ragi chips, and flaxseed cookies that friends and neighbors rave about. We want to formalize this into a small packaged food business.

What are the mandatory compliance requirements (FSSAI, GST, packaging)? Should we sell on Amazon/Flipkart first, or focus on local WhatsApp groups and society stalls?",
                'author_name' => 'Amitabh Nair',
                'author_persona' => 'Working Professional',
                'author_headline' => 'Aspiring Food Entrepreneur &bull; Pune',
                'tags' => ['Startups', 'FSSAI', 'Small Business', 'Food Business', 'D2C'],
                'upvotes_count' => 24,
                'views_count' => 380,
                'answers' => [
                    [
                        'author_name' => 'Neha Gupta',
                        'author_persona' => 'Working Professional',
                        'author_headline' => 'Founder @ NatureBites &bull; D2C FMCG',
                        'content' => "Great initiative! Millets (Shree Anna) are booming right now.

1. **Licenses First**: Get basic FSSAI Registration (Rs. 100/yr online at foscos.fssai.gov.in) and Udyam MSME certificate (free). GST is only mandatory once turnover crosses 40 Lakhs (or if selling on Amazon).
2. **Distribution Strategy**: **Start hyperlocal!** Do NOT list on Amazon immediately—their seller fees (25–35%) and advertising costs will eat all your small capital.
3. **Execution**: Set up stalls in upscale residential societies on weekends, offer free tastings, collect WhatsApp numbers, and create a weekly subscription model. Once you have 100 regular repeat buyers, then launch an e-commerce storefront.",
                        'upvotes_count' => 22,
                        'is_accepted' => true,
                        'is_expert_answer' => true,
                    ]
                ]
            ],
            [
                'channel' => 'arts-creative',
                'title' => 'UI/UX Design as a career in India: Is a formal B.Des degree necessary or can self-taught designers get hired?',
                'content' => "I am currently in 2nd year B.Com. I love designing interfaces, typography, and micro-interactions on Figma. 

Do top tech startups (Swiggy, Razorpay, CRED, Zomato) hire self-taught product designers without an NID/IIT design degree? How important is having a case study portfolio?",
                'author_name' => 'Pooja Sawant',
                'author_persona' => 'College Student',
                'author_headline' => 'Self-Taught UI/UX Enthusiast',
                'tags' => ['UI/UX', 'Product Design', 'Figma', 'Design Careers'],
                'upvotes_count' => 37,
                'views_count' => 520,
                'answers' => [
                    [
                        'author_name' => 'Karan Patel',
                        'author_persona' => 'Working Professional',
                        'author_headline' => 'Staff Product Designer @ Fintech Startup',
                        'content' => "Product Design is one of the most meritocratic fields in tech!

Degrees from NID/IDC IIT give alumni leverage, but **90% of hiring decisions depend purely on your portfolio**. A good case study does NOT just show pretty Figma mockups; it shows your thought process:
- What user problem were you solving?
- What were the constraints?
- What user research did you conduct?
- What metrics did you improve?

Build 2 deep, original case studies and publish them on Behance / personal website. Share breakdown threads on Twitter/LinkedIn, and recruiters will reach out to you directly.",
                        'upvotes_count' => 33,
                        'is_accepted' => true,
                        'is_expert_answer' => true,
                    ]
                ]
            ],
            [
                'channel' => 'exams-prep',
                'title' => 'Overwhelmed with 12th Board + JEE/MHT-CET prep — how do you handle burnout and backlog anxiety?',
                'content' => "I feel like I'm drowning in physics derivations and chemistry reactions. My mock scores are fluctuating wildly and whenever I sit to study, guilt about backlogs paralyzes me. 

How did past toppers and seniors balance state board expectations with entrance exams without losing their sanity?",
                'author_name' => 'Aditya Ranade',
                'author_persona' => '10th/12th Student',
                'author_headline' => '12th Science Student &bull; HSC + MHT CET',
                'tags' => ['Exam Stress', 'MHT-CET', 'Board Exam', 'Study Routine'],
                'upvotes_count' => 65,
                'views_count' => 910,
                'answers' => [
                    [
                        'author_name' => 'Dr. Radhika Iyer',
                        'author_persona' => 'Career Counselor',
                        'author_headline' => 'Adolescent Psychologist & Academic Counselor',
                        'content' => "Aditya, what you are experiencing is 'Backlog Paralysis'—a very common cognitive trap. When your brain sees 40 pending chapters, it treats it as a threat and shuts down focus.

Here is the antidote:
1. **Declare a Backlog Amnesty**: Pick the top 5 high-weightage chapters in each subject. Ignore the rest for now.
2. **The 50/10 Rule**: Study for 50 minutes with your phone in another room, take a 10-minute walk.
3. **Synergy over Separation**: Board textbook theory (especially HSC textbook line-by-line reading for Chemistry) directly answers 70%+ of MHT CET questions. You are not preparing two separate universes—they are the same concepts tested differently.
4. Remember: Your worth as a human being is not defined by an exam rank. Give your honest best today and take it one question at a time.",
                        'upvotes_count' => 54,
                        'is_accepted' => true,
                        'is_expert_answer' => true,
                    ],
                    [
                        'author_name' => 'Sunita Kulkarni',
                        'author_persona' => 'Parent / Guardian',
                        'author_headline' => 'Mother of an Engineering Student',
                        'content' => "As a mother whose son went through this exact phase 2 years ago: please sleep for 7 hours, eat healthy meals, and talk to your parents openly. We care about your mental peace and happiness far more than any percentile. Stay strong beta!",
                        'upvotes_count' => 41,
                        'is_accepted' => false,
                        'is_expert_answer' => false,
                    ]
                ]
            ],
        ];

        foreach ($posts as $postData) {
            $answers = $postData['answers'] ?? [];
            unset($postData['answers']);

            $post = CommunityPost::updateOrCreate(
                ['title' => $postData['title']],
                array_merge($postData, [
                    'uuid' => (string) Str::uuid(),
                    'slug' => Str::slug($postData['title']),
                    'answers_count' => count($answers),
                ])
            );

            foreach ($answers as $ansData) {
                CommunityAnswer::updateOrCreate(
                    [
                        'post_id' => $post->id,
                        'content' => $ansData['content']
                    ],
                    array_merge($ansData, [
                        'uuid' => (string) Str::uuid(),
                        'post_id' => $post->id,
                    ])
                );
            }
        }
    }
}

