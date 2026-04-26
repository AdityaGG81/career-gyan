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
            ['name' => 'Commerce',                  'slug' => 'commerce',               'icon' => 'fa-chart-line',     'color' => '#16a34a', 'bg_color' => '#dcfce7'],
            ['name' => 'Science',                   'slug' => 'science',                'icon' => 'fa-flask',          'color' => '#1d4ed8', 'bg_color' => '#dbeafe'],
            ['name' => 'Technology / Engineering',  'slug' => 'technology-engineering', 'icon' => 'fa-microchip',      'color' => '#dc2626', 'bg_color' => '#fee2e2'],
            ['name' => 'Medical',                   'slug' => 'medical',                'icon' => 'fa-stethoscope',    'color' => '#ea580c', 'bg_color' => '#ffedd5'],
            ['name' => 'Business Administration',   'slug' => 'business',               'icon' => 'fa-building',       'color' => '#0891b2', 'bg_color' => '#cffafe'],
            ['name' => 'Skill Development',         'slug' => 'skill-development',      'icon' => 'fa-tools',          'color' => '#d97706', 'bg_color' => '#fef3c7'],
            ['name' => 'Sports',                    'slug' => 'sports',                 'icon' => 'fa-futbol',         'color' => '#16a34a', 'bg_color' => '#dcfce7'],
            ['name' => 'Agriculture',               'slug' => 'agriculture',            'icon' => 'fa-seedling',       'color' => '#4d7c0f', 'bg_color' => '#d9f99d'],
            ['name' => 'Small Scale Businesses',    'slug' => 'small-scale',            'icon' => 'fa-store',          'color' => '#b45309', 'bg_color' => '#fef3c7'],
            ['name' => 'Government & Defence',       'slug' => 'government-defence',     'icon' => 'fa-shield-halved',  'color' => '#1e293b', 'bg_color' => '#f1f5f9'],
            ['name' => 'Teaching & Law',            'slug' => 'teaching-law',           'icon' => 'fa-graduation-cap',  'color' => '#1e3a8a', 'bg_color' => '#dbeafe'],
            ['name' => 'Modern Tech & AI',          'slug' => 'modern-tech',            'icon' => 'fa-brain',          'color' => '#7c3aed', 'bg_color' => '#f5f3ff'],
            ['name' => 'Creative Careers',          'slug' => 'creative-careers',       'icon' => 'fa-palette',        'color' => '#ec4899', 'bg_color' => '#fdf2f8'],
            ['name' => 'Social Media & Content',    'slug' => 'social-media',           'icon' => 'fa-clapperboard',   'color' => '#f43f5e', 'bg_color' => '#fff1f2'],
            ['name' => 'Gaming & E-sports',         'slug' => 'gaming-careers',         'icon' => 'fa-gamepad',        'color' => '#8b5cf6', 'bg_color' => '#f3f4ff'],
            ['name' => 'Freelancing & Remote',      'slug' => 'freelancing',            'icon' => 'fa-globe',          'color' => '#10b981', 'bg_color' => '#ecfdf5'],
            ['name' => 'Competitive Exams',         'slug' => 'competitive-exams',      'icon' => 'fa-file-signature', 'color' => '#be123c', 'bg_color' => '#fff1f2'],
            ['name' => 'Others',                    'slug' => 'others',                 'icon' => 'fa-ellipsis',       'color' => '#6366f1', 'bg_color' => '#e0e7ff'],
        ];

        foreach ($fields as $field) {
            Field::updateOrCreate(['slug' => $field['slug']], $field);
        }
    }
}
