<?php

namespace Database\Seeders;

use App\Models\NonTraditionalCareer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NonTraditionalCareerSeeder extends Seeder
{
    public function run(): void
    {
        $careers = [
            // Tech & Digital
            [
                'name' => 'Data Scientist',
                'category' => 'Tech & Digital Careers',
                'description' => 'Unlocking insights from big data to solve complex business problems.',
                'required_skills' => 'Python, Statistics, Machine Learning, Data Visualization',
                'learning_path' => ['Step 1: Learn Statistics & Python', 'Step 2: Master SQL and Data Libraries', 'Step 3: Work on Real Datasets (Kaggle)', 'Step 4: Build a Portfolio of Insights'],
                'tools_platforms' => 'Jupyter, Pandas, Tableau, Scikit-learn',
                'duration' => '6-8 Months',
                'income_potential' => '₹6L - ₹20L PA',
                'work_type' => 'Job / Remote',
                'risk_level' => 'Low',
                'icon' => 'fa-database'
            ],
            [
                'name' => 'AI Engineer',
                'category' => 'Tech & Digital Careers',
                'description' => 'Developing and deploying artificial intelligence models and neural networks.',
                'required_skills' => 'Deep Learning, Neural Networks, PyTorch/TensorFlow',
                'learning_path' => ['Step 1: Master Python and Calculus', 'Step 2: Learn Machine Learning Basics', 'Step 3: Specialize in NLP or Computer Vision', 'Step 4: Build AI Apps and Deploy on Cloud'],
                'tools_platforms' => 'TensorFlow, PyTorch, OpenAI API, AWS',
                'duration' => '8-12 Months',
                'income_potential' => '₹8L - ₹30L PA',
                'work_type' => 'Job / Remote',
                'risk_level' => 'Low',
                'icon' => 'fa-brain'
            ],
            [
                'name' => 'Ethical Hacker',
                'category' => 'Tech & Digital Careers',
                'description' => 'Finding and fixing security vulnerabilities in computer systems and networks.',
                'required_skills' => 'Networking, Linux, Penetration Testing, Python',
                'learning_path' => ['Step 1: Learn Networking & OS Basics', 'Step 2: Get CEH or CompTIA Security+ Cert', 'Step 3: Practice on TryHackMe or HackTheBox', 'Step 4: Participate in Bug Bounties'],
                'tools_platforms' => 'Kali Linux, Burp Suite, Metasploit, Wireshark',
                'duration' => '6-10 Months',
                'income_potential' => '₹5L - ₹18L PA',
                'work_type' => 'Job / Freelance',
                'risk_level' => 'Low',
                'icon' => 'fa-user-secret'
            ],

            // Creative
            [
                'name' => 'Animator',
                'category' => 'Creative Careers',
                'description' => 'Bringing characters and stories to life through 2D or 3D animation.',
                'required_skills' => 'Drawing, Timing, 3D Modeling, Storyboarding',
                'learning_path' => ['Step 1: Learn 12 Principles of Animation', 'Step 2: Master Maya or Blender', 'Step 3: Create a 30-second Animation Reel', 'Step 4: Apply for Studios or Freelance'],
                'tools_platforms' => 'Blender, Maya, After Effects, Toon Boom',
                'duration' => '12 Months',
                'income_potential' => '₹4L - ₹12L PA',
                'work_type' => 'Job / Freelance',
                'risk_level' => 'Medium',
                'icon' => 'fa-person-running'
            ],
            [
                'name' => 'Photographer',
                'category' => 'Creative Careers',
                'description' => 'Capturing moments, products, or landscapes with professional precision.',
                'required_skills' => 'Composition, Lighting, Photo Editing, Business Networking',
                'learning_path' => ['Step 1: Learn Camera Manual Settings', 'Step 2: Master Lighting and Framing', 'Step 3: Learn Post-processing (Lightroom)', 'Step 4: Build an Instagram Portfolio & Network'],
                'tools_platforms' => 'DSLR/Mirrorless, Adobe Lightroom, Photoshop',
                'duration' => '4-6 Months',
                'income_potential' => '₹30K - ₹2L PM',
                'work_type' => 'Freelance / Business',
                'risk_level' => 'Medium',
                'icon' => 'fa-camera-retro'
            ],

            // Social Media
            [
                'name' => 'YouTuber',
                'category' => 'Social Media Careers',
                'description' => 'Creating video content and building a loyal community on YouTube.',
                'required_skills' => 'Content Planning, Video Editing, SEO, Consistency',
                'learning_path' => ['Step 1: Choose a Profitable Niche', 'Step 2: Learn Basic Filming & Editing', 'Step 3: Understand YouTube Algorithm & SEO', 'Step 4: Post Weekly and Build Community'],
                'tools_platforms' => 'YouTube, Premiere Pro, Canva, VidIQ',
                'duration' => '6-12 Months (Growth)',
                'income_potential' => '₹10K - ₹10L+ PM',
                'work_type' => 'Self-employed / Business',
                'risk_level' => 'High',
                'icon' => 'fa-youtube'
            ],

            // Gaming
            [
                'name' => 'Game Developer',
                'category' => 'Gaming Careers',
                'description' => 'Programming and building the mechanics of video games.',
                'required_skills' => 'C#, C++, Unity/Unreal Engine, Game Math',
                'learning_path' => ['Step 1: Learn Programming Basics (C#)', 'Step 2: Master Unity or Unreal Engine', 'Step 3: Build 2 Small Games for Portfolio', 'Step 4: Publish on Play Store or Steam'],
                'tools_platforms' => 'Unity, Unreal Engine, GitHub, Visual Studio',
                'duration' => '8-12 Months',
                'income_potential' => '₹5L - ₹20L PA',
                'work_type' => 'Job / Freelance / Business',
                'risk_level' => 'Low',
                'icon' => 'fa-code'
            ],
            [
                'name' => 'Game Tester',
                'category' => 'Gaming Careers',
                'description' => 'Finding bugs and providing feedback to improve game quality.',
                'required_skills' => 'Attention to Detail, Quality Assurance, Bug Reporting',
                'learning_path' => ['Step 1: Understand Game Development Lifecycle', 'Step 2: Learn Bug Tracking Tools (Jira)', 'Step 3: Practice Systematic Testing', 'Step 4: Apply for QA roles at Game Studios'],
                'tools_platforms' => 'Jira, Excel, Bugzilla, Console/PC',
                'duration' => '2-3 Months',
                'income_potential' => '₹2.5L - ₹6L PA',
                'work_type' => 'Job',
                'risk_level' => 'Low',
                'icon' => 'fa-bug'
            ],

            // Freelancing & Digital Marketing
            [
                'name' => 'Digital Marketer',
                'category' => 'Freelancing & Remote Work',
                'description' => 'Helping brands grow online through SEO, Ads, and Social Media.',
                'required_skills' => 'SEO, SEM, Copywriting, Data Analytics',
                'learning_path' => ['Step 1: Understand Digital Marketing Basics', 'Step 2: Get Certified (Google/HubSpot)', 'Step 3: Run Small Campaigns or Freelance', 'Step 4: Work as a Consultant or Agency'],
                'tools_platforms' => 'Google Ads, Meta Ads Manager, SEMrush',
                'duration' => '4 Months',
                'income_potential' => '₹40K - ₹3L PM',
                'work_type' => 'Freelance / Job / Business',
                'risk_level' => 'Low',
                'icon' => 'fa-chart-line'
            ]
        ];

        foreach ($careers as $career) {
            NonTraditionalCareer::updateOrCreate(
                ['slug' => Str::slug($career['name'])],
                $career
            );
        }
    }
}
