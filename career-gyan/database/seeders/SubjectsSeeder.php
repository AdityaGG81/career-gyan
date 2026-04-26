<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectsSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            'Mathematics', 'Physics', 'Chemistry', 'Biology',
            'Computer Science', 'English', 'Hindi', 'History',
            'Geography', 'Economics', 'Accountancy', 'Business Studies',
            'Political Science', 'Sociology', 'Psychology', 'Fine Arts',
            'Physical Education', 'Agriculture', 'Home Science',
            'Environmental Science', 'Statistics', 'Electronics',
            'Drawing', 'Music', 'Yoga', 'Biotechnology',
            'Legal Studies', 'Entrepreneurship', 'Mass Media',
            'Information Technology',
        ];

        foreach ($subjects as $name) {
            $slug = strtolower(str_replace([' ', '/'], ['-', '-'], $name));
            Subject::updateOrCreate(['slug' => $slug], ['name' => $name, 'slug' => $slug]);
        }
    }
}
