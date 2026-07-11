<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class HighQualityBlogSeeder extends Seeder
{
    public function run(): void
    {
        $blogs = [
            [
                'title' => 'The Complete Guide to Choosing the Right Career Path After 12th',
                'excerpt' => 'Feeling overwhelmed after your board exams? Discover the most effective, step-by-step framework for evaluating your strengths, analyzing market trends, and selecting a career path that guarantees long-term success and personal fulfillment.',
                'content' => '<h3>Introduction: The Crossroads of Your Future</h3>
<p>Completing your 12th standard is one of the most significant milestones in your academic journey. However, it often brings a wave of anxiety: <em>What comes next?</em> With thousands of degree programs, emerging technologies, and traditional professions all vying for your attention, choosing the right career path can feel like navigating a maze blindfolded.</p>
<p>This comprehensive guide is designed to walk you through a proven, step-by-step framework for making an informed, confident decision about your future.</p>

<h3>Step 1: Self-Assessment – Know Thyself</h3>
<p>Before you look at the job market, you must look inward. A successful career is found at the intersection of what you are good at, what you love doing, and what the world is willing to pay for.</p>
<ul>
    <li><strong>Identify Your Strengths:</strong> Are you highly analytical? Do you excel in creative writing? Are you a natural leader? Make a list of subjects and activities where you consistently perform well without feeling drained.</li>
    <li><strong>Acknowledge Your Weaknesses:</strong> Be honest about areas you struggle with. If advanced calculus gives you nightmares, a core engineering path might lead to burnout.</li>
    <li><strong>Take an Aptitude Test:</strong> Professional psychometric and aptitude tests (like the ones offered here at CareerGyan) can provide unbiased, data-driven insights into your inherent traits and cognitive abilities.</li>
</ul>

<h3>Step 2: Explore the Horizon</h3>
<p>The biggest mistake students make is limiting their choices to the traditional "Big Three": Engineering, Medicine, and Law. While these are excellent fields, the modern economy has birthed entirely new industries.</p>
<h4>Emerging Sectors to Consider:</h4>
<ol>
    <li><strong>Artificial Intelligence & Machine Learning:</strong> The backbone of the next technological revolution.</li>
    <li><strong>Data Science & Analytics:</strong> Every major corporation now relies on big data to make decisions.</li>
    <li><strong>Renewable Energy:</strong> As the world shifts away from fossil fuels, green tech is booming.</li>
    <li><strong>Digital Marketing & UX Design:</strong> The digital storefront is now more important than the physical one.</li>
    <li><strong>Biotechnology:</strong> A critical field blending technology with biology to solve global health and environmental issues.</li>
</ol>

<h3>Step 3: Analyze the Market Demand and ROI</h3>
<p>Passion is important, but financial stability is crucial. Once you have a shortlist of 3 to 5 potential careers, research their market viability.</p>
<p>Look up the average starting salary, the projected growth rate over the next decade, and the saturation level of the market. For instance, while software engineering is highly lucrative, it is also highly competitive. Conversely, niche fields like cybersecurity currently have a massive shortage of qualified professionals, meaning higher starting salaries and incredible job security.</p>

<h3>Step 4: The Educational Pathway</h3>
<p>Every career requires a specific roadmap. Map out the educational requirements for your shortlisted careers.</p>
<ul>
    <li>What entrance exams are required (JEE, NEET, CLAT, CUET)?</li>
    <li>What are the top-tier institutions for this field?</li>
    <li>What is the total cost of education, and what is the expected Return on Investment (ROI)?</li>
</ul>

<h3>Conclusion: Embrace Flexibility</h3>
<p>Finally, remember that a career choice is not a life sentence. The modern professional will change careers 5 to 7 times in their lifetime. Choose a path that builds versatile, transferable skills like critical thinking, communication, and technological literacy. Stay curious, keep learning, and trust the process.</p>',
                'cover_image' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&q=80&w=1000',
                'category' => 'Career Guidance',
                'tags' => ['After 12th', 'Career Planning', 'Aptitude', 'Future Skills'],
                'author' => 'Dr. A. K. Sen',
                'is_published' => true,
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => 'Top 10 Emerging Technologies That Will Dominate the Job Market by 2030',
                'excerpt' => 'From Quantum Computing to CRISPR gene editing, explore the cutting-edge technologies that are creating entirely new industries and discover how you can future-proof your career.',
                'content' => '<h3>The Pace of Innovation</h3>
<p>The technological landscape is evolving at a breakneck speed. What was considered science fiction a decade ago is now everyday reality. For students and young professionals, understanding these shifts is critical. If you align your career with emerging tech, you secure not just a job, but a high-paying, future-proof trajectory.</p>
<p>Here are the top 10 technologies that will define the job market in 2030 and beyond.</p>

<h3>1. Artificial Intelligence and Machine Learning</h3>
<p>AI is no longer just a buzzword; it is the new electricity. By 2030, AI will be deeply integrated into healthcare diagnostics, financial forecasting, autonomous logistics, and even creative arts.</p>
<p><strong>Careers to watch:</strong> AI Ethicist, Machine Learning Engineer, NLP Specialist.</p>

<h3>2. Quantum Computing</h3>
<p>While classical computers process bits (0s and 1s), quantum computers use qubits, allowing them to process complex data exponentially faster. This will revolutionize cryptography, drug discovery, and climate modeling.</p>
<p><strong>Careers to watch:</strong> Quantum Algorithm Researcher, Quantum Hardware Engineer.</p>

<h3>3. Green Tech and Renewable Energy</h3>
<p>As global governments push for net-zero carbon emissions, the green tech sector is experiencing unprecedented funding. This includes advanced solar tech, wind turbine engineering, and high-capacity battery storage (solid-state batteries).</p>
<p><strong>Careers to watch:</strong> Renewable Energy Engineer, Sustainability Consultant, Smart Grid Architect.</p>

<h3>4. Biotechnology and Genomics (CRISPR)</h3>
<p>The ability to edit genes with precision using CRISPR technology is opening doors to curing genetic diseases, creating drought-resistant crops, and extending human longevity.</p>
<p><strong>Careers to watch:</strong> Genetic Counselor, Bioinformatics Scientist, Biomolecular Engineer.</p>

<h3>5. The Internet of Things (IoT) and Edge Computing</h3>
<p>By 2030, billions of devices will be connected, from smart refrigerators to entire smart cities. Managing this massive flow of data requires robust Edge Computing—processing data locally rather than in a distant cloud.</p>
<p><strong>Careers to watch:</strong> IoT Security Specialist, Network Architect, Cloud Infrastructure Engineer.</p>

<h3>6. Advanced Robotics and Automation</h3>
<p>Robots are moving out of factories and into our homes, hospitals, and delivery routes. The integration of AI with robotics (cobots) is creating machines that can work safely alongside humans.</p>
<p><strong>Careers to watch:</strong> Robotics Programmer, Mechatronics Engineer, Automation Technician.</p>

<h3>7. Cybersecurity and Cyber Warfare Defense</h3>
<p>With data becoming the world\'s most valuable resource, protecting it is paramount. Cyber threats are becoming more sophisticated, necessitating advanced, AI-driven defense mechanisms.</p>
<p><strong>Careers to watch:</strong> Penetration Tester, Cybersecurity Analyst, Cryptographer.</p>

<h3>8. Augmented Reality (AR) and Virtual Reality (VR)</h3>
<p>Beyond gaming, AR and VR are transforming medical training, remote work, architecture, and retail. The creation of immersive digital environments will require massive creative and technical talent.</p>
<p><strong>Careers to watch:</strong> AR/VR Developer, 3D Modeler, Spatial Designer.</p>

<h3>9. Blockchain and Decentralized Finance (DeFi)</h3>
<p>Blockchain is moving beyond cryptocurrency. It is being adopted for secure supply chain management, secure voting systems, and decentralized finance, bypassing traditional banking.</p>
<p><strong>Careers to watch:</strong> Blockchain Developer, Smart Contract Auditor.</p>

<h3>10. 3D Printing and Advanced Manufacturing</h3>
<p>From printing affordable housing to creating bio-printed human organs, 3D printing is disrupting traditional manufacturing and logistics.</p>
<p><strong>Careers to watch:</strong> Materials Scientist, 3D Printing Technician, CAD Designer.</p>

<h3>How to Prepare</h3>
<p>You don\'t necessarily need a hardcore computer science degree to work in these fields. Every emerging industry requires project managers, technical writers, marketers, and legal experts. The key is to stay adaptable, commit to lifelong learning, and keep your finger on the pulse of innovation.</p>',
                'cover_image' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&q=80&w=1000',
                'category' => 'Industry Insights',
                'tags' => ['Technology', 'Future Jobs', 'AI', 'Innovation'],
                'author' => 'Anjali Mehta',
                'is_published' => true,
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Mastering the Art of the Interview: A Step-by-Step Guide for Freshers',
                'excerpt' => 'Ace your first job interview with this comprehensive guide. Learn how to craft a compelling introduction, answer behavioral questions, and negotiate your first salary with confidence.',
                'content' => '<h3>The First Impression</h3>
<p>For a fresher, the job interview is often the most intimidating part of the transition from college to the corporate world. However, an interview is not an interrogation; it is a professional conversation to determine mutual fit. By mastering a few key strategies, you can turn interview anxiety into a powerful, confident presentation of your skills.</p>

<h3>1. The "Tell Me About Yourself" Formula</h3>
<p>This is almost always the first question, and it sets the tone for the entire interview. Do not recite your resume line-by-line, and avoid sharing overly personal information. Use the <strong>Present-Past-Future</strong> formula:</p>
<ul>
    <li><strong>Present:</strong> Briefly state what you are doing right now (e.g., "I recently graduated with a degree in Computer Science...").</li>
    <li><strong>Past:</strong> Highlight 1-2 relevant academic projects, internships, or achievements that demonstrate your skills.</li>
    <li><strong>Future:</strong> Explain why you are excited about *this* specific role and how it aligns with your career goals.</li>
</ul>

<h3>2. Mastering Behavioral Questions (The STAR Method)</h3>
<p>Interviewers love behavioral questions (e.g., "Tell me about a time you faced a conflict"). They want to see how you react under pressure. Always answer using the <strong>STAR</strong> method:</p>
<ul>
    <li><strong>Situation:</strong> Set the scene. Give the necessary context.</li>
    <li><strong>Task:</strong> Explain what your specific responsibility was.</li>
    <li><strong>Action:</strong> Describe the exact steps *you* took to address the situation.</li>
    <li><strong>Result:</strong> Share the positive outcome, quantifying it with numbers if possible (e.g., "reduced loading time by 20%").</li>
</ul>

<h3>3. Research the Company Deeply</h3>
<p>Spending 10 minutes on the company\'s "About Us" page is not enough. You need to understand their products, their competitors, and their recent news. Mentioning a recent product launch or a recent industry challenge shows that you are genuinely invested in the company, not just desperately looking for a job.</p>

<h3>4. Ask Insightful Questions</h3>
<p>At the end of the interview, the hiring manager will ask, "Do you have any questions for us?" Never say no. Asking good questions demonstrates critical thinking. Try these:</p>
<ul>
    <li>"What does a typical day look like for someone in this role?"</li>
    <li>"What are the most important metrics you use to measure success in this position?"</li>
    <li>"Can you tell me about the team culture and how collaboration happens here?"</li>
</ul>

<h3>5. Body Language and Professionalism</h3>
<p>Non-verbal communication speaks volumes. Maintain good posture, make consistent (but not aggressive) eye contact, and offer a firm handshake. If the interview is virtual, look directly into the camera, ensure your background is clean, and use a high-quality microphone.</p>

<h3>6. The Follow-Up</h3>
<p>Within 24 hours of the interview, send a brief, polite "Thank You" email to your interviewers. Express your continued interest in the role and reference a specific interesting point from your conversation. This keeps you at the top of their minds and shows exceptional professionalism.</p>

<h3>Conclusion</h3>
<p>Interviewing is a skill, and like any skill, it improves with practice. Conduct mock interviews with friends or mentors, record yourself speaking, and refine your answers. Remember, the company invited you because they believe you have potential—your job is simply to confirm it.</p>',
                'cover_image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&q=80&w=1000',
                'category' => 'Career Tips',
                'tags' => ['Interview', 'Freshers', 'Resume', 'Communication'],
                'author' => 'Prof. S. R. Deshmukh',
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Why Soft Skills are Just as Important as Technical Degrees in 2026',
                'excerpt' => 'As AI automates technical tasks, human-centric soft skills like emotional intelligence, adaptability, and complex problem-solving are becoming the most highly valued traits by top recruiters.',
                'content' => '<h3>The Changing Landscape of Employability</h3>
<p>For decades, the recipe for career success was straightforward: get a prestigious technical degree, memorize the formulas, learn the coding languages, and you were guaranteed a secure job. However, as we move deeper into the 2020s, the paradigm has shifted drastically.</p>
<p>Artificial Intelligence can now write code, analyze massive datasets, and draft legal documents faster than any human. So, what is left for us? The answer lies in <strong>Soft Skills</strong>—the uniquely human traits that machines cannot replicate.</p>

<h3>1. Emotional Intelligence (EQ)</h3>
<p>Emotional intelligence is the ability to understand, use, and manage your own emotions in positive ways to relieve stress, communicate effectively, empathize with others, and defuse conflict. In a corporate environment, a brilliant engineer with low EQ who cannot work in a team is a liability, not an asset. High EQ leaders foster collaboration and drive team success.</p>

<h3>2. Adaptability and Continuous Learning</h3>
<p>The half-life of a learned skill is shrinking. A programming language you learn in your first year of college might be obsolete by the time you graduate. Employers are no longer looking for "know-it-alls"; they are looking for "learn-it-alls." The ability to pivot, learn new software quickly, and adapt to shifting market trends is arguably the most critical skill of the 21st century.</p>

<h3>3. Complex Problem Solving and Critical Thinking</h3>
<p>While AI can solve structured problems (where the rules are clearly defined), it struggles with ambiguity. Human professionals are needed to navigate messy, poorly defined problems. Critical thinking involves analyzing information objectively and making a reasoned judgment. It requires understanding the nuances of human behavior, market psychology, and ethical implications.</p>

<h3>4. Effective Communication</h3>
<p>You might have the most groundbreaking idea in the world, but if you cannot articulate it to your stakeholders, it is worthless. Effective communication encompasses writing clear emails, delivering persuasive presentations, and, most importantly, active listening. As remote and asynchronous work becomes the norm, the ability to communicate concisely across digital platforms is highly prized.</p>

<h3>5. Creativity and Innovation</h3>
<p>Creativity is connecting the unconnected. It is looking at a traditional business model and imagining a disruptive alternative. While generative AI can produce art and text based on historical data, true innovation—the spark that creates a new industry—remains a deeply human endeavor.</p>

<h3>How to Develop Soft Skills</h3>
<p>Unlike hard skills, you cannot learn emotional intelligence by reading a textbook. Soft skills are developed through experience:</p>
<ul>
    <li><strong>Join clubs and societies</strong> in college to build leadership and teamwork skills.</li>
    <li><strong>Volunteer</strong> for NGOs to develop empathy and communication.</li>
    <li><strong>Read widely</strong> outside your discipline to foster creativity.</li>
    <li><strong>Seek feedback</strong> actively from mentors and peers to improve your self-awareness.</li>
</ul>

<h3>Conclusion</h3>
<p>Your technical degree will get your foot in the door, but your soft skills will determine how high you climb the corporate ladder. Start treating communication, adaptability, and emotional intelligence with the same rigor you apply to your academic studies.</p>',
                'cover_image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&q=80&w=1000',
                'category' => 'Personal Growth',
                'tags' => ['Soft Skills', 'Leadership', 'Emotional Intelligence', 'Career Growth'],
                'author' => 'CareerGyan Advisory Board',
                'is_published' => true,
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'Navigating the World of Freelancing: A Beginner\'s Blueprint',
                'excerpt' => 'The gig economy is booming. Learn how to build a profitable freelance business from scratch, find high-paying clients, manage your finances, and achieve true work-life balance.',
                'content' => '<h3>The Rise of the Gig Economy</h3>
<p>The traditional 9-to-5 corporate job is no longer the only path to a successful career. Millions of professionals worldwide are embracing the freelance lifestyle, drawn by the promise of flexible hours, location independence, and limitless earning potential. But freelancing is not just "working from the couch"—it is running a one-person business.</p>
<p>If you are considering stepping into the gig economy, here is a comprehensive blueprint to get you started on the right foot.</p>

<h3>1. Define Your Niche and Value Proposition</h3>
<p>The freelance market is highly competitive. To stand out, you must avoid being a "jack of all trades." Instead, specialize. Don\'t just be a "writer"; be a "B2B SaaS copywriter." Don\'t just be a "developer"; be a "Shopify e-commerce specialist."</p>
<p>A specific niche allows you to target high-paying clients who need specialized solutions. Clearly define what problem you solve and why you are the best person to solve it.</p>

<h3>2. Build a Stunning Portfolio</h3>
<p>Your portfolio is your resume, your interview, and your sales pitch rolled into one. If you are just starting and don\'t have client work, create spec work. Design a mock website, write a sample article, or build a personal software project. Ensure your portfolio is easily accessible via a personal website (e.g., yourname.com).</p>

<h3>3. Finding Your First Clients</h3>
<p>While platforms like Upwork and Fiverr are good for getting your feet wet, they often lead to a race to the bottom in terms of pricing. To find premium clients:</p>
<ul>
    <li><strong>Leverage LinkedIn:</strong> Optimize your profile for your niche and actively reach out to founders, marketing managers, and agency owners.</li>
    <li><strong>Cold Emailing:</strong> Send highly personalized emails to companies you want to work with, highlighting exactly how you can add value to their current operations.</li>
    <li><strong>Networking:</strong> Attend industry webinars, join specialized Discord/Slack communities, and ask your existing network for referrals.</li>
</ul>

<h3>4. Master the Art of Pricing</h3>
<p>Pricing is the biggest hurdle for new freelancers. Avoid charging by the hour if possible; it penalizes you for working quickly and efficiently. Instead, transition to <strong>Value-Based Pricing</strong> or fixed-project rates. Quote based on the value your work brings to the client\'s business. Always draft a clear contract defining the scope of work, revisions, and payment terms before starting.</p>

<h3>5. Financial Management and Discipline</h3>
<p>Freelance income is notoriously unpredictable. To survive the "feast and famine" cycle:</p>
<ul>
    <li><strong>Save for Taxes:</strong> Immediately set aside 20-30% of every payment you receive for taxes.</li>
    <li><strong>Build an Emergency Fund:</strong> Aim for 3-6 months of living expenses saved up to weather dry spells.</li>
    <li><strong>Track Everything:</strong> Use software like Wave or QuickBooks to track your invoices, expenses, and profitability.</li>
</ul>

<h3>6. Guard Your Time and Mental Health</h3>
<p>When your home is your office, the boundaries between work and life blur. You can easily find yourself working 14-hour days to please demanding clients. Set strict working hours, create a dedicated workspace, and learn to say "no" to toxic clients. Your mental health is your most valuable business asset.</p>

<h3>Conclusion</h3>
<p>Freelancing offers incredible freedom, but it demands immense discipline. Treat your freelance practice like a serious business from day one, focus on delivering exceptional value, and you will build a sustainable, highly rewarding career on your own terms.</p>',
                'cover_image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&q=80&w=1000',
                'category' => 'Freelancing',
                'tags' => ['Freelance', 'Gig Economy', 'Business', 'Remote Work'],
                'author' => 'Anjali Mehta',
                'is_published' => true,
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'Digital Marketing in 2026: Trends, Tools, and Career Opportunities',
                'excerpt' => 'An in-depth look at how AI, data privacy laws, and short-form video are reshaping digital marketing. Discover the skills you need to thrive in this high-growth industry.',
                'content' => '<h3>The Evolution of Digital Marketing</h3>
<p>Digital marketing is one of the most dynamic industries on the planet. What worked flawlessly three years ago is often completely obsolete today. As we navigate through 2026, the landscape is being reshaped by artificial intelligence, stringent data privacy regulations, and shifting consumer attention spans.</p>
<p>Whether you are a business owner or an aspiring marketer, understanding these trends is vital for success.</p>

<h3>1. AI-Driven Content and Personalization</h3>
<p>Generative AI tools are now deeply integrated into the marketing stack. However, the focus has shifted from merely generating generic blog posts to hyper-personalization. AI is used to analyze user behavior in real-time, dynamically adjusting website content, email copy, and ad creatives to match the exact psychological profile of the viewer.</p>
<p><strong>Required Skill:</strong> Marketers must learn to be "AI Directors"—managing AI tools, engineering prompts, and ensuring the output aligns with brand voice and ethical standards.</p>

<h3>2. The Era of First-Party Data</h3>
<p>With the death of third-party cookies and the enforcement of strict global privacy laws (like GDPR and its successors), tracking users across the web has become incredibly difficult. The new gold rush is <strong>First-Party Data</strong>. Brands are investing heavily in building their own email lists, loyalty programs, and zero-party data collection methods (like interactive quizzes and surveys).</p>
<p><strong>Required Skill:</strong> Data literacy, CRM management (HubSpot, Salesforce), and email marketing mastery.</p>

<h3>3. Short-Form Video Dominance</h3>
<p>The TikTok effect has permanently altered consumer attention. Short-form, highly engaging video content is the dominant format across Instagram Reels, YouTube Shorts, and LinkedIn. However, production quality is taking a backseat to authenticity and storytelling. Consumers crave raw, relatable, and educational content from actual human faces, not polished corporate ads.</p>
<p><strong>Required Skill:</strong> Video editing, scriptwriting for retention, and on-camera confidence.</p>

<h3>4. SEO in the Age of AI Search</h3>
<p>Search Engine Optimization (SEO) has changed radically with the introduction of AI-generated search overviews. Users are getting answers directly on the search engine results page (SERP) without clicking through to websites. To survive, SEO strategies must focus on highly original research, expert opinions (E-E-A-T: Experience, Expertise, Authoritativeness, Trustworthiness), and long-tail conversational keywords optimized for voice search.</p>
<p><strong>Required Skill:</strong> Advanced content strategy, technical SEO, and thought leadership development.</p>

<h3>5. Omni-channel Customer Journeys</h3>
<p>Consumers no longer buy a product after seeing a single ad. They might discover a brand on TikTok, research it on YouTube, sign up for a newsletter on the website, and finally convert via a retargeted Instagram ad three weeks later. Marketers must build seamless omni-channel funnels that track and nurture leads across multiple touchpoints.</p>
<p><strong>Required Skill:</strong> Funnel building, marketing automation, and multi-touch attribution analysis.</p>

<h3>Building a Career in Digital Marketing</h3>
<p>The beauty of digital marketing is its low barrier to entry. You do not need a specialized degree to succeed. To build a career:</p>
<ol>
    <li><strong>Build Your Own Assets:</strong> Start a blog, grow a niche Instagram page, or run a small ad campaign for a local business. Practical proof beats a resume.</li>
    <li><strong>Get Certified:</strong> Complete free certifications from Google Analytics, Meta Blueprint, and HubSpot Academy.</li>
    <li><strong>Specialize Early, Generalize Later:</strong> Become a master in one specific channel (e.g., Google Ads or SEO) before branching out to become a T-shaped marketer.</li>
</ol>
<p>Digital marketing is a thrilling, fast-paced career that rewards creativity, data-driven thinking, and constant curiosity.</p>',
                'cover_image' => 'https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?auto=format&fit=crop&q=80&w=1000',
                'category' => 'Marketing',
                'tags' => ['Digital Marketing', 'SEO', 'Social Media', 'Trends'],
                'author' => 'Dr. A. K. Sen',
                'is_published' => true,
                'published_at' => now()->subDays(14),
            ]
        ];

        foreach ($blogs as $blogData) {
            $blogData['slug'] = Str::slug($blogData['title']);
            
            // Avoid duplicates
            if (!Blog::where('slug', $blogData['slug'])->exists()) {
                Blog::create($blogData);
            }
        }
    }
}
