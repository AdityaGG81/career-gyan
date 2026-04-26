<?php

namespace Database\Seeders;

use App\Models\Field;
use App\Models\SkillCourse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SkillDevelopmentSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'skill-development')->firstOrFail();

        $categories = [
            [
                'title' => 'Programming & IT',
                'skills' => [
                    ['name' => 'Web Development', 'desc' => 'Building websites and web apps', 'tools' => 'HTML, CSS, JS, React, PHP', 'duration' => '4-6 Months', 'diff' => 'Intermediate', 'salary' => '₹4L - ₹12L', 'jobs' => 'Frontend, Backend, Fullstack Developer'],
                    ['name' => 'Python for Data Science', 'desc' => 'Analyzing data and building AI models', 'tools' => 'Python, Pandas, NumPy, Scikit-learn', 'duration' => '6 Months', 'diff' => 'Intermediate', 'salary' => '₹5L - ₹15L', 'jobs' => 'Data Analyst, ML Engineer'],
                ]
            ],
            [
                'title' => 'Design & Creative',
                'skills' => [
                    ['name' => 'Graphic Design', 'desc' => 'Visual communication and branding', 'tools' => 'Photoshop, Illustrator, Canva', 'duration' => '3 Months', 'diff' => 'Beginner', 'salary' => '₹3L - ₹8L', 'jobs' => 'UI Designer, Brand Identity Artist'],
                    ['name' => 'Video Editing', 'desc' => 'Creating and polishing video content', 'tools' => 'Premiere Pro, After Effects', 'duration' => '3-4 Months', 'diff' => 'Intermediate', 'salary' => '₹4L - ₹10L', 'jobs' => 'Video Editor, Motion Graphics Designer'],
                ]
            ],
            [
                'title' => 'Business & Finance',
                'skills' => [
                    ['name' => 'Tally & GST', 'desc' => 'Modern accounting and taxation', 'tools' => 'Tally Prime, Excel, GST Portal', 'duration' => '2 Months', 'diff' => 'Beginner', 'salary' => '₹2.5L - ₹6L', 'jobs' => 'Accountant, GST Consultant'],
                    ['name' => 'Stock Market Trading', 'desc' => 'Technical analysis and investment', 'tools' => 'TradingView, Zerodha', 'duration' => '3 Months', 'diff' => 'Advanced', 'salary' => 'Profit-based', 'jobs' => 'Portfolio Manager, Trader'],
                ]
            ],
            [
                'title' => 'Digital Marketing',
                'skills' => [
                    ['name' => 'Social Media Marketing', 'desc' => 'Growing brands on FB, IG, LinkedIn', 'tools' => 'Meta Ads, Buffer, Analytics', 'duration' => '3 Months', 'diff' => 'Beginner', 'salary' => '₹3L - ₹9L', 'jobs' => 'SMM Specialist, Content Planner'],
                    ['name' => 'SEO Specialist', 'desc' => 'Ranking websites on Google', 'tools' => 'Ahrefs, Semrush, Console', 'duration' => '4 Months', 'diff' => 'Intermediate', 'salary' => '₹4L - ₹10L', 'jobs' => 'SEO Strategist, Web Analyst'],
                ]
            ]
        ];

        foreach ($categories as $cat) {
            foreach ($cat['skills'] as $skill) {
                SkillCourse::updateOrCreate(
                    ['slug' => Str::slug($skill['name'])],
                    [
                        'name' => $skill['name'],
                        'field_id' => $field->id,
                        'category_title' => $cat['title'],
                        'description' => $skill['desc'],
                        'tools' => $skill['tools'],
                        'duration' => $skill['duration'],
                        'difficulty' => $skill['diff'],
                        'salary_potential' => $skill['salary'],
                        'job_roles' => $skill['jobs'],
                    ]
                );
            }
        }
    }
}
