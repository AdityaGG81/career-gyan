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
            ['name' => 'Traditional Careers',       'slug' => 'traditional',            'icon' => 'fa-landmark',       'color' => '#6b7280', 'bg_color' => '#f3f4f6'],
            ['name' => 'Others',                    'slug' => 'others',                 'icon' => 'fa-ellipsis',       'color' => '#6366f1', 'bg_color' => '#e0e7ff'],
        ];

        foreach ($fields as $field) {
            Field::updateOrCreate(['slug' => $field['slug']], $field);
        }
    }
}
