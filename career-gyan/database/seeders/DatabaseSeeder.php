<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            ['name'  => 'Test User', 'password' => bcrypt('password')]
        );

        $this->call([
            FieldsSeeder::class,
            SubjectsSeeder::class,
            CareersSeeder::class,
            CollegesSeeder::class,
            EngineeringCollegeSeeder::class,
            MedicalCollegeSeeder::class,
            HotelManagementCollegeSeeder::class,
            ManagementCollegeSeeder::class,
            PharmacyCollegeSeeder::class,
            NonMbbsCollegeSeeder::class,
            ScienceCollegeSeeder::class,
            ArtsCollegeSeeder::class,
            CommerceCollegeSeeder::class,
            AgricultureCollegeSeeder::class,
            SkillDevelopmentSeeder::class,
            SmallScaleBusinessSeeder::class,
            CompetitiveExamSeeder::class,
            NonTraditionalCareerSeeder::class,
            PortableDataSeeder::class,
        ]);
    }
}

