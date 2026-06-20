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
            QuestionsSeeder::class,
            QuickTestQuestionSeeder::class,
            // New Explore Seeders
            EngineeringFieldsSeeder::class,
            TechnologyEngineeringSeeder::class,
            TechnologyEngineeringMainExpansionSeeder::class,
            TechnologyEngineeringExpansionSeeder::class,
            Phase2EngineeringSeeder::class,
            Phase3EngineeringSeeder::class,
            Phase4EngineeringSeeder::class,
            MedicalCareersSeeder::class,
            PharmaCareersSeeder::class,
            AyushCareersSeeder::class,
            CommerceSeeder::class,
            BusinessCareersSeeder::class,
            ScienceSeeder::class,
            ArtsHumanitiesSeeder::class,
            GovDefenceCareersSeeder::class,
            TeachingLawCareersSeeder::class,
            AgricultureCareersSeeder::class,
            ModernTechCareersSeeder::class,
            CreativeCareersSeeder::class,
            SocialMediaCareersSeeder::class,
            GamingCareersSeeder::class,
            FreelancingCareersSeeder::class,
            CompetitiveExamsCareersSeeder::class,
            HotelManagementCareersSeeder::class,
            SmallScaleCareersSeeder::class,
            SkillDevelopmentCareersSeeder::class,
            SportsCareersSeeder::class,
            CommerceBankingCorporateCareerSeeder::class,
            EngineeringIndustrialCareerSeeder::class,
            ITDigitalTechnologyCareerSeeder::class,
            HealthcareAlliedMedicalCareerSeeder::class,
            AgricultureFoodEnvironmentCareerSeeder::class,
            CreativeDesignMediaCareerSeeder::class,
            HospitalityAviationTourismLogisticsCareerSeeder::class,
            EducationSocialLawPolicyCareerSeeder::class,
            SkillTradesManufacturingRetailCareerSeeder::class,
            AgricultureAlliedSciencesCareerSeeder::class,
            ArtsMediaEntertainmentCareerSeeder::class,
            MassCareersExpansionSeeder::class,
            BlogSeeder::class,
            CustomDataUpdateSeeder::class,
            DailyQuizSeeder::class,
        ]);
    }
}
