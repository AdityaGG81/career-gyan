<?php

namespace Database\Seeders;

use App\Models\Field;
use Illuminate\Database\Seeder;

class FieldsSeeder extends Seeder
{
    public function run(): void
    {
        $fields = [
            ['name' => 'Arts & Humanities',        'slug' => 'arts-humanities',       'icon' => 'fa-palette',        'color' => '#7c3aed', 'bg_color' => '#ede9fe'],
            ['name' => 'Commerce, Banking & Corporate', 'slug' => 'commerce',               'icon' => 'fa-chart-line',     'color' => '#16a34a', 'bg_color' => '#dcfce7'],
            ['name' => 'Science',                   'slug' => 'science',                'icon' => 'fa-flask',          'color' => '#1d4ed8', 'bg_color' => '#dbeafe'],
            ['name' => 'Technology / Engineering',  'slug' => 'technology-engineering', 'icon' => 'fa-microchip',      'color' => '#dc2626', 'bg_color' => '#fee2e2'],
            ['name' => 'Medical',                   'slug' => 'medical',                'icon' => 'fa-stethoscope',    'color' => '#ea580c', 'bg_color' => '#ffedd5'],
            ['name' => 'Business Administration',   'slug' => 'business',               'icon' => 'fa-building',       'color' => '#0891b2', 'bg_color' => '#cffafe'],
            ['name' => 'Skill Development',         'slug' => 'skill-development',      'icon' => 'fa-tools',          'color' => '#d97706', 'bg_color' => '#fef3c7'],
            ['name' => 'Sports',                    'slug' => 'sports',                 'icon' => 'fa-futbol',         'color' => '#16a34a', 'bg_color' => '#dcfce7'],
            ['name' => 'Agriculture',               'slug' => 'agriculture',            'icon' => 'fa-seedling',       'color' => '#4d7c0f', 'bg_color' => '#d9f99d'],
            ['name' => 'Agriculture, Food & Environment', 'slug' => 'agriculture-food-environment', 'icon' => 'fa-leaf', 'color' => '#059669', 'bg_color' => '#d1fae5'],
            ['name' => 'Creative, Design & Media', 'slug' => 'creative-design-media', 'icon' => 'fa-palette', 'color' => '#d946ef', 'bg_color' => '#fdf4ff'],
            ['name' => 'Hospitality, Aviation, Tourism & Logistics', 'slug' => 'hospitality-aviation-tourism-logistics', 'icon' => 'fa-plane-departure', 'color' => '#0ea5e9', 'bg_color' => '#f0f9ff'],
            ['name' => 'Education, Social, Law & Policy', 'slug' => 'education-social-law-policy', 'icon' => 'fa-scale-balanced', 'color' => '#4f46e5', 'bg_color' => '#eef2ff'],
            ['name' => 'Skill Trades, Manufacturing & Retail', 'slug' => 'skill-trades-manufacturing-retail', 'icon' => 'fa-industry', 'color' => '#ea580c', 'bg_color' => '#fff7ed'],
            ['name' => 'Agriculture & Allied Sciences', 'slug' => 'agriculture-allied-sciences', 'icon' => 'fa-wheat-awn', 'color' => '#15803d', 'bg_color' => '#f0fdf4'],
            ['name' => 'Arts, Media & Entertainment', 'slug' => 'arts-media-entertainment', 'icon' => 'fa-clapperboard', 'color' => '#f43f5e', 'bg_color' => '#fff1f2'],
            ['name' => 'Small Scale Businesses',    'slug' => 'small-scale',            'icon' => 'fa-store',          'color' => '#b45309', 'bg_color' => '#fef3c7'],
            ['name' => 'Government & Defence',       'slug' => 'government-defence',     'icon' => 'fa-shield-halved',  'color' => '#1e293b', 'bg_color' => '#f1f5f9'],
            ['name' => 'Teaching & Law',            'slug' => 'teaching-law',           'icon' => 'fa-graduation-cap',  'color' => '#1e3a8a', 'bg_color' => '#dbeafe'],
            ['name' => 'Modern Tech & AI',          'slug' => 'modern-tech',            'icon' => 'fa-brain',          'color' => '#7c3aed', 'bg_color' => '#f5f3ff'],
            ['name' => 'IT & Digital Technology',   'slug' => 'it-digital-technology',  'icon' => 'fa-laptop-code',    'color' => '#0ea5e9', 'bg_color' => '#e0f2fe'],
            ['name' => 'Creative Careers',          'slug' => 'creative-careers',       'icon' => 'fa-palette',        'color' => '#ec4899', 'bg_color' => '#fdf2f8'],
            ['name' => 'Social Media & Content',    'slug' => 'social-media',           'icon' => 'fa-clapperboard',   'color' => '#f43f5e', 'bg_color' => '#fff1f2'],
            ['name' => 'Gaming & E-sports',         'slug' => 'gaming-careers',         'icon' => 'fa-gamepad',        'color' => '#8b5cf6', 'bg_color' => '#f3f4ff'],
            ['name' => 'Freelancing & Remote',      'slug' => 'freelancing',            'icon' => 'fa-globe',          'color' => '#10b981', 'bg_color' => '#ecfdf5'],
            ['name' => 'Competitive Exams',         'slug' => 'competitive-exams',      'icon' => 'fa-file-signature', 'color' => '#be123c', 'bg_color' => '#fff1f2'],
            ['name' => 'AYUSH & Allied Health',     'slug' => 'ayush-allied',           'icon' => 'fa-heart-pulse',    'color' => '#059669', 'bg_color' => '#d1fae5'],
            ['name' => 'Healthcare & Allied Medical', 'slug' => 'healthcare-allied-medical', 'icon' => 'fa-user-md', 'color' => '#ef4444', 'bg_color' => '#fee2e2'],
            ['name' => 'Pharmacy',                  'slug' => 'pharmacy',               'icon' => 'fa-pills',          'color' => '#7c3aed', 'bg_color' => '#ede9fe'],
            ['name' => 'Hotel Management',          'slug' => 'hotel-management',       'icon' => 'fa-bed',            'color' => '#dc2626', 'bg_color' => '#fee2e2'],
            ['name' => 'Others',                    'slug' => 'others',                 'icon' => 'fa-ellipsis',       'color' => '#6366f1', 'bg_color' => '#e0e7ff'],
        ];

        foreach ($fields as $field) {
            Field::updateOrCreate(['slug' => $field['slug']], $field);
        }
    }
}
