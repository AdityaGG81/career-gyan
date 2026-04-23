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
        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
        ]);

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
        ]);
    }
}

