<?php

namespace Database\Seeders;

use App\Models\Field;
use Illuminate\Database\Seeder;

class EngineeringFieldsSeeder extends Seeder
{
    public function run(): void
    {
        $fields = [
            ['name' => 'Electrical Engineering', 'slug' => 'electrical-engineering', 'icon' => 'fa-bolt', 'color' => '#fbbf24', 'bg_color' => '#fef3c7'],
            ['name' => 'Chemical Engineering', 'slug' => 'chemical-engineering', 'icon' => 'fa-flask', 'color' => '#10b981', 'bg_color' => '#d1fae5'],
            ['name' => 'Computer Engineering', 'slug' => 'computer-engineering', 'icon' => 'fa-computer', 'color' => '#3b82f6', 'bg_color' => '#dbeafe'],
            ['name' => 'Information Technology', 'slug' => 'information-technology', 'icon' => 'fa-network-wired', 'color' => '#0ea5e9', 'bg_color' => '#e0f2fe'],
            ['name' => 'Electronics & Telecommunication', 'slug' => 'electronics-telecommunication', 'icon' => 'fa-satellite-dish', 'color' => '#8b5cf6', 'bg_color' => '#ede9fe'],
            ['name' => 'Civil Engineering', 'slug' => 'civil-engineering', 'icon' => 'fa-helmet-safety', 'color' => '#f97316', 'bg_color' => '#ffedd5'],
            ['name' => 'AI & Data Science', 'slug' => 'ai-data-science', 'icon' => 'fa-brain', 'color' => '#ec4899', 'bg_color' => '#fce7f3'],
            ['name' => 'Mechanical Engineering', 'slug' => 'mechanical-engineering', 'icon' => 'fa-cogs', 'color' => '#64748b', 'bg_color' => '#f1f5f9'],
            ['name' => 'Automobile Engineering', 'slug' => 'automobile-engineering', 'icon' => 'fa-car', 'color' => '#ef4444', 'bg_color' => '#fee2e2'],
            ['name' => 'Aerospace Engineering', 'slug' => 'aerospace-engineering', 'icon' => 'fa-plane-up', 'color' => '#0284c7', 'bg_color' => '#e0f2fe'],
            ['name' => 'Robotics Engineering', 'slug' => 'robotics-engineering', 'icon' => 'fa-robot', 'color' => '#f59e0b', 'bg_color' => '#fef3c7'],
            ['name' => 'Cyber Security', 'slug' => 'cyber-security', 'icon' => 'fa-shield-halved', 'color' => '#14b8a6', 'bg_color' => '#ccfbf1'],
            ['name' => 'Software Engineering', 'slug' => 'software-engineering', 'icon' => 'fa-code', 'color' => '#8b5cf6', 'bg_color' => '#ede9fe'],
            ['name' => 'Cloud Computing', 'slug' => 'cloud-computing', 'icon' => 'fa-cloud', 'color' => '#0ea5e9', 'bg_color' => '#e0f2fe'],
            ['name' => 'Data Science', 'slug' => 'data-science', 'icon' => 'fa-chart-pie', 'color' => '#ec4899', 'bg_color' => '#fce7f3'],
        ];

        foreach($fields as $f) { 
            Field::firstOrCreate(['slug' => $f['slug']], $f); 
        }
    }
}
