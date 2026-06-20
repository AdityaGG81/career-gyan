<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Blog::query()->delete();

        $blogs = [
            [
                'title' => 'The Rise of AI and Automation: High-Demand Careers for 2026',
                'excerpt' => 'An in-depth analysis of which sectors are experiencing the fastest growth due to AI integration, new engineering disciplines, and upskilling strategies.',
                'content' => '<h3>Introduction</h3><p>Artificial Intelligence is no longer a futuristic concept; it is actively reshaping the Indian and global job markets. As we move into 2026, automation is creating high-growth career opportunities in tech and non-tech sectors alike.</p><h3>High-Demand Career Domains</h3><ul><li><strong>AI Prompt Engineers:</strong> Translating business requirements into effective AI queries.</li><li><strong>Data Scientists & Analysts:</strong> Managing massive datasets to guide corporate decision-making.</li><li><strong>Robotics & Automation Engineers:</strong> Designing smart systems for manufacturing and logistics.</li></ul><h3>How to Upskill</h3><p>Regardless of your stream (Science, Commerce, or Arts), learning computational thinking, basic programming, and data literacy will keep you competitive in the modern workforce.</p>',
                'cover_image' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&q=80&w=1000',
                'category' => 'Industry Insights',
                'tags' => ['AI', 'Tech Careers', 'Automation', 'Upskilling'],
                'author' => 'Dr. A. K. Sen',
                'is_published' => true,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Top 10 High-Paying Careers in India: Salary, Growth and Skills',
                'excerpt' => 'A comprehensive review of the highest-paying professions in India, spanning from technology and business management to corporate law and specialized medical fields.',
                'content' => '<h3>High-Paying Professions Overview</h3><p>Choosing a career that aligns with your passion and offers financial stability is crucial. Here are the top high-paying domains in India today:</p><ol><li><strong>Software Architect:</strong> Designing complex system architectures. (₹15L - ₹45L+ p.a.)</li><li><strong>Investment Banker:</strong> Managing corporate finance and acquisitions. (₹10L - ₹35L+ p.a.)</li><li><strong>Corporate Lawyer:</strong> Advising firms on mergers, acquisitions, and compliance. (₹8L - ₹25L+ p.a.)</li><li><strong>Data Scientist:</strong> Interpreting big data for actionable insights. (₹8L - ₹24L+ p.a.)</li></ol><h3>Key Takeaway</h3><p>High salaries are directly proportional to specialized skills and continuous learning. Developing solid communication, analytics, and leadership skills early on will accelerate your career progression.</p>',
                'cover_image' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&q=80&w=1000',
                'category' => 'Career Tips',
                'tags' => ['Salary', 'Career Growth', 'High-Paying Jobs', 'Professional'],
                'author' => 'Anjali Mehta',
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'How to Choose the Right College: Rankings, Placements and ROI',
                'excerpt' => 'A step-by-step guide for students and parents on evaluating NIRF rankings, analyzing placement reports, and computing the actual return on investment (ROI).',
                'content' => '<h3>Understanding Your Options</h3><p>With thousands of universities in India, selecting the right one can feel overwhelming. Focus on these three metrics to make an informed choice:</p><h3>1. NIRF & International Rankings</h3><p>National Institutional Ranking Framework (NIRF) rankings provide a reliable baseline for academic quality, faculty resources, and research output.</p><h3>2. Placements & Industry Links</h3><p>Look beyond the "highest package" claims. Examine the average package, median salary, and the percentage of students placed. A consistent record of top recruiters indicates strong industry credibility.</p><h3>3. Return on Investment (ROI)</h3><p>Calculate ROI by comparing the total fees (academic + hostel) with the average starting package. High ROI colleges like top NITs, IITs, and government medical institutions offer excellent value.</p>',
                'cover_image' => 'https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&q=80&w=1000',
                'category' => 'Education',
                'tags' => ['College Admission', 'Rankings', 'Placements', 'ROI'],
                'author' => 'CareerGyan Advisory Board',
                'is_published' => true,
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'A Complete Guide to Entrance Exams After 12th Standard',
                'excerpt' => 'A consolidated timeline and requirements guide for major national and state level entrance examinations in engineering, medical, law, and design.',
                'content' => '<h3>Stream-wise Entrance Examinations</h3><p>To secure admissions in top government and private universities in India, cracking entrance exams is essential. Here is a guide to major exams:</p><h3>1. Engineering & Technology</h3><ul><li><strong>JEE Main:</strong> Entrance for NITs, IIITs, and GFTIs.</li><li><strong>JEE Advanced:</strong> Entrance exclusively for IITs.</li><li><strong>MHT-CET:</strong> State-level entrance for Maharashtra colleges.</li></ul><h3>2. Medical & Allied Sciences</h3><ul><li><strong>NEET-UG:</strong> Common national entrance for MBBS, BDS, and AYUSH courses.</li></ul><h3>3. Law & Management</h3><ul><li><strong>CLAT:</strong> Common Law Admission Test for National Law Universities.</li><li><strong>IPMAT:</strong> Entrance for 5-Year Integrated Management Programme at IIMs.</li></ul>',
                'cover_image' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&q=80&w=1000',
                'category' => 'Study Abroad',
                'tags' => ['Entrance Exams', 'JEE', 'NEET', 'CLAT', 'MHT-CET'],
                'author' => 'Prof. S. R. Deshmukh',
                'is_published' => true,
                'published_at' => now()->subDays(12),
            ],
        ];

        foreach ($blogs as $blogData) {
            $blogData['slug'] = Str::slug($blogData['title']);
            Blog::create($blogData);
        }
    }
}
