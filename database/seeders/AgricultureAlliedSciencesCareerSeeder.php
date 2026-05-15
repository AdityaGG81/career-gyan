<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Career;
use App\Models\Field;

class AgricultureAlliedSciencesCareerSeeder extends Seeder
{
    public function run(): void
    {
        $fieldSlug = 'agriculture-allied-sciences';
        $field = Field::where('slug', $fieldSlug)->first();

        if (!$field) {
            $this->command->error("Field '$fieldSlug' not found. Please run FieldsSeeder first.");
            return;
        }

        $careers = [
            [
                'slug' => 'agronomist',
                'name' => 'Agronomist',
                'sub_domain' => 'Crop Science & Agronomy',
                'description' => 'Agronomists study crops, soil, irrigation, fertilizers, and farming methods to improve crop production and farm productivity.',
                'salary_range' => '₹3L – ₹12L',
                'demand_level' => 'High',
                'qualification' => 'B.Sc Agriculture / M.Sc Agronomy',
                'stream' => 'Science / Agriculture',
                'entrance_exams' => ['CUET (ICAR-UG)', 'ICAR AIEEA PG', 'State University Entrance'],
                'skills' => ['Crop Production', 'Soil Fertility', 'Irrigation Planning', 'Field Trials', 'Data Analysis', 'Pest Management'],
                'job_opportunities' => ['Agriculture Companies', 'Seed Companies', 'Fertilizer Firms', 'Research Institutes'],
                'image' => 'images/careers/agriculture-allied-sciences/agronomist.svg'
            ],
            [
                'slug' => 'animal-health-worker',
                'name' => 'Animal Health Worker',
                'sub_domain' => 'Animal Health & Livestock Support',
                'description' => 'Animal Health Workers assist in basic animal care, vaccination support, disease awareness, first aid, and livestock health monitoring.',
                'salary_range' => '₹1.8L – ₹6L',
                'demand_level' => 'High',
                'qualification' => '10th / 12th + Animal Health Worker Training / Veterinary Paramedical Course',
                'stream' => 'Science / Any Stream',
                'entrance_exams' => ['Skill Certifications', 'State Livestock Recruitment', 'Veterinary Paramedical Admissions'],
                'skills' => ['Livestock Handling', 'Vaccination Support', 'Animal First Aid', 'Disease Observation', 'Farmer Communication'],
                'job_opportunities' => ['Dairy Farms', 'Livestock Farms', 'Veterinary Clinics', 'NGOs', 'Animal Husbandry Departments'],
                'image' => 'images/careers/agriculture-allied-sciences/animal-health-worker.svg'
            ],
            [
                'slug' => 'aquaculture-worker',
                'name' => 'Aquaculture Worker',
                'sub_domain' => 'Fisheries & Aquaculture',
                'description' => 'Aquaculture Workers manage fish, prawn, and aquatic farming activities including feeding, pond care, water quality, and harvesting.',
                'salary_range' => '₹1.8L – ₹6L',
                'demand_level' => 'High',
                'qualification' => '10th / 12th + Aquaculture Training / Fisheries Skill Course',
                'stream' => 'Science / Any Stream',
                'entrance_exams' => ['Skill Certification Programs', 'ICAR-UG (B.F.Sc Pathway)', 'State Fisheries Training'],
                'skills' => ['Fish Feeding', 'Pond Management', 'Water Quality Testing', 'Hatchery Support', 'Harvesting'],
                'job_opportunities' => ['Fish Farms', 'Aquaculture Units', 'Hatcheries', 'Fisheries Cooperatives', 'Seafood Companies'],
                'image' => 'images/careers/agriculture-allied-sciences/aquaculture-worker.svg'
            ],
            [
                'slug' => 'dairy-farmer-entrepreneur',
                'name' => 'Dairy Farmer/Entrepreneur',
                'sub_domain' => 'Dairy Farming & Dairy Technology',
                'description' => 'Dairy Farmer/Entrepreneurs manage milk production, animal feeding, breeding, hygiene, milk sales, and dairy business operations.',
                'salary_range' => '₹2L – ₹15L+',
                'demand_level' => 'High',
                'qualification' => '10th / 12th + Dairy Farming Training / Agriculture background',
                'stream' => 'Any Stream / Agriculture',
                'entrance_exams' => ['Dairy Skill Training', 'Agriculture Training Programs'],
                'skills' => ['Animal Care', 'Milking Management', 'Feed Planning', 'Herd Health', 'Dairy Business', 'Marketing'],
                'job_opportunities' => ['Self-Employment', 'Dairy Farms', 'Milk Cooperatives', 'Rural Enterprises'],
                'image' => 'images/careers/agriculture-allied-sciences/dairy-farmer-entrepreneur.svg'
            ],
            [
                'slug' => 'dairy-technologist',
                'name' => 'Dairy Technologist',
                'sub_domain' => 'Dairy Farming & Dairy Technology',
                'description' => 'Dairy Technologists process milk and dairy products while ensuring quality, hygiene, packaging, storage, and food safety standards.',
                'salary_range' => '₹3L – ₹12L',
                'demand_level' => 'High',
                'qualification' => 'B.Tech Dairy Technology / B.Sc Dairy Science / Food Technology',
                'stream' => 'Science',
                'entrance_exams' => ['CUET (ICAR-UG)', 'State Agriculture Entrance', 'ICAR AIEEA PG'],
                'skills' => ['Milk Processing', 'Quality Control', 'Food Safety', 'Dairy Microbiology', 'Packaging', 'Plant Operations'],
                'job_opportunities' => ['Dairy Plants', 'Milk Cooperatives', 'Food Processing Companies', 'Ice Cream Brands'],
                'image' => 'images/careers/agriculture-allied-sciences/dairy-technologist.svg'
            ],
            [
                'slug' => 'fisheries-officer',
                'name' => 'Fisheries Officer',
                'sub_domain' => 'Fisheries & Aquaculture',
                'description' => 'Fisheries Officers manage fisheries development, fish farming schemes, aquatic resources, farmer support, inspections, and government programs.',
                'salary_range' => '₹4L – ₹12L',
                'demand_level' => 'High',
                'qualification' => 'B.F.Sc / M.F.Sc / Fisheries Science Degree',
                'stream' => 'Science',
                'entrance_exams' => ['CUET (ICAR-UG)', 'ICAR AIEEA PG', 'State PSC Exams', 'Fisheries Dept Recruitment'],
                'skills' => ['Fisheries Management', 'Aquaculture Planning', 'Government Schemes', 'Field Inspection', 'Farmer Training'],
                'job_opportunities' => ['Fisheries Departments', 'Government Agencies', 'Research Institutes', 'Fisheries Cooperatives'],
                'image' => 'images/careers/agriculture-allied-sciences/fisheries-officer.svg'
            ],
            [
                'slug' => 'horticulturist',
                'name' => 'Horticulturist',
                'sub_domain' => 'Horticulture & Protected Cultivation',
                'description' => 'Horticulturists grow and manage fruits, vegetables, flowers, spices, medicinal plants, nurseries, and landscape crops.',
                'salary_range' => '₹3L – ₹12L',
                'demand_level' => 'High',
                'qualification' => 'B.Sc Horticulture / B.Sc Agriculture / M.Sc Horticulture',
                'stream' => 'Science / Agriculture',
                'entrance_exams' => ['CUET (ICAR-UG)', 'ICAR AIEEA PG', 'State University Entrance'],
                'skills' => ['Plant Propagation', 'Nursery Management', 'Crop Protection', 'Greenhouse Cultivation', 'Soil & Irrigation'],
                'job_opportunities' => ['Nurseries', 'Floriculture Units', 'Fruit Farms', 'Greenhouse Companies', 'Landscaping Firms'],
                'image' => 'images/careers/agriculture-allied-sciences/horticulturist.svg'
            ],
            [
                'slug' => 'hydroponics-technician',
                'name' => 'Hydroponics Technician',
                'sub_domain' => 'Horticulture & Protected Cultivation',
                'description' => 'Hydroponics Technicians grow plants without soil using nutrient solutions, controlled environments, sensors, and modern farming systems.',
                'salary_range' => '₹2.5L – ₹9L',
                'demand_level' => 'High',
                'qualification' => 'Diploma / Certificate in Hydroponics, Protected Cultivation, or Agriculture',
                'stream' => 'Science / Agriculture / Any Stream',
                'entrance_exams' => ['Skill Certifications', 'Agriculture Institute Courses'],
                'skills' => ['Nutrient Management', 'pH & EC Monitoring', 'Greenhouse Operations', 'Plant Health', 'Sensor Use'],
                'job_opportunities' => ['Hydroponic Farms', 'Urban Farming Startups', 'Greenhouse Companies', 'AgriTech Firms'],
                'image' => 'images/careers/agriculture-allied-sciences/hydroponics-technician.svg'
            ],
            [
                'slug' => 'pisciculturist',
                'name' => 'Pisciculturist',
                'sub_domain' => 'Fisheries & Aquaculture',
                'description' => 'Pisciculturists specialize in fish breeding, pond preparation, feeding, hatchery care, disease control, and commercial fish production.',
                'salary_range' => '₹2L – ₹10L',
                'demand_level' => 'High',
                'qualification' => 'Fisheries Training / B.F.Sc / Aquaculture Course',
                'stream' => 'Science / Agriculture',
                'entrance_exams' => ['CUET (ICAR-UG)', 'Fisheries Institute Admissions', 'State Training Programs'],
                'skills' => ['Fish Breeding', 'Hatchery Management', 'Pond Culture', 'Water Testing', 'Feed Management'],
                'job_opportunities' => ['Fish Farms', 'Hatcheries', 'Aquaculture Companies', 'Self-Employment'],
                'image' => 'images/careers/agriculture-allied-sciences/pisciculturist.svg'
            ],
            [
                'slug' => 'seed-technologist',
                'name' => 'Seed Technologist',
                'sub_domain' => 'Seed Science & Soil Science',
                'description' => 'Seed Technologists test, process, store, certify, and improve seeds to ensure better germination, crop quality, and farmer productivity.',
                'salary_range' => '₹3L – ₹12L',
                'demand_level' => 'High',
                'qualification' => 'B.Sc Agriculture / M.Sc Seed Science & Technology',
                'stream' => 'Science / Agriculture',
                'entrance_exams' => ['CUET (ICAR-UG)', 'ICAR AIEEA PG', 'State University Entrance'],
                'skills' => ['Seed Testing', 'Germination Analysis', 'Seed Processing', 'Storage Management', 'Quality Control'],
                'job_opportunities' => ['Seed Companies', 'Agriculture Departments', 'Seed Testing Labs', 'Research Institutes'],
                'image' => 'images/careers/agriculture-allied-sciences/seed-technologist.svg'
            ],
            [
                'slug' => 'soil-scientist',
                'name' => 'Soil Scientist',
                'sub_domain' => 'Seed Science & Soil Science',
                'description' => 'Soil Scientists study soil health, nutrients, fertility, erosion, salinity, and land use to improve sustainable agriculture.',
                'salary_range' => '₹4L – ₹15L',
                'demand_level' => 'High',
                'qualification' => 'B.Sc Agriculture + M.Sc Soil Science / Agricultural Chemistry',
                'stream' => 'Science / Agriculture',
                'entrance_exams' => ['CUET (ICAR-UG)', 'ICAR AIEEA PG', 'ASRB NET'],
                'skills' => ['Soil Testing', 'Nutrient Management', 'GIS Basics', 'Lab Analysis', 'Soil Conservation'],
                'job_opportunities' => ['Soil Testing Labs', 'Agriculture Universities', 'Research Institutes', 'Fertilizer Companies'],
                'image' => 'images/careers/agriculture-allied-sciences/soil-scientist.svg'
            ],
            [
                'slug' => 'tea-plantation-manager',
                'name' => 'Tea Plantation Manager',
                'sub_domain' => 'Plantation & Vineyard Management',
                'description' => 'Tea Plantation Managers supervise tea cultivation, labour, harvesting, processing coordination, quality control, and plantation business operations.',
                'salary_range' => '₹4L – ₹15L',
                'demand_level' => 'Moderate',
                'qualification' => 'B.Sc Agriculture / B.Sc Horticulture / Plantation Management Course',
                'stream' => 'Science / Agriculture / Management',
                'entrance_exams' => ['CUET (ICAR-UG)', 'State University Entrance', 'Plantation Management Admissions'],
                'skills' => ['Plantation Operations', 'Crop Management', 'Labour Supervision', 'Quality Control', 'Administration'],
                'job_opportunities' => ['Tea Estates', 'Plantation Companies', 'Beverage Brands', 'Export Firms'],
                'image' => 'images/careers/agriculture-allied-sciences/tea-plantation-manager.svg'
            ],
            [
                'slug' => 'veterinarian',
                'name' => 'Veterinarian',
                'sub_domain' => 'Veterinary Medicine & Animal Healthcare',
                'description' => 'Veterinarians diagnose, treat, and prevent diseases in animals and provide medical care for pets, livestock, poultry, and wildlife.',
                'salary_range' => '₹5L – ₹18L+',
                'demand_level' => 'Very High',
                'qualification' => 'B.V.Sc & A.H.',
                'stream' => 'Science PCB',
                'entrance_exams' => ['NEET UG', 'VCI Counselling', 'State Veterinary Admissions'],
                'skills' => ['Animal Diagnosis', 'Surgery Basics', 'Vaccination', 'Animal Handling', 'Emergency Care'],
                'job_opportunities' => ['Veterinary Hospitals', 'Animal Husbandry Depts', 'Pet Clinics', 'Dairy Farms', 'Wildlife Centres'],
                'image' => 'images/careers/agriculture-allied-sciences/veterinarian.svg'
            ],
            [
                'slug' => 'vineyard-grower',
                'name' => 'Vineyard Grower',
                'sub_domain' => 'Plantation & Vineyard Management',
                'description' => 'Vineyard Growers cultivate grapes for table use, raisins, juice, and wine by managing pruning, irrigation, pest control, and harvesting.',
                'salary_range' => '₹2.5L – ₹12L+',
                'demand_level' => 'Moderate',
                'qualification' => 'B.Sc Agriculture / B.Sc Horticulture / Viticulture Training',
                'stream' => 'Science / Agriculture',
                'entrance_exams' => ['CUET (ICAR-UG)', 'State University Entrance', 'Horticulture Training'],
                'skills' => ['Grape Cultivation', 'Pruning', 'Drip Irrigation', 'Pest Management', 'Harvest Planning'],
                'job_opportunities' => ['Vineyards', 'Grape Farms', 'Wineries', 'Horticulture Farms', 'Self-Employment'],
                'image' => 'images/careers/agriculture-allied-sciences/vineyard-grower.svg'
            ]
        ];

        $futureScopeCommon = "Agriculture & Allied Sciences are critical for food security and sustainability, with increasing focus on precision farming, biotechnology, and value-added processing.";

        foreach ($careers as $careerData) {
            $roadmap = [
                "Step 1: Complete 10+2 with Science (PCB/PCM) or Agriculture stream.",
                "Step 2: Appear for ICAR (CUET) or State-level Agriculture entrance exams.",
                "Step 3: Pursue a Bachelor's degree (B.Sc Ag, B.F.Sc, B.V.Sc) in your area of interest.",
                "Step 4: Gain hands-on experience through internships at research stations, KVKs, or commercial farms.",
                "Step 5: Opt for a Master's (M.Sc / M.Tech) for specialized roles in research, technology, or management.",
                "Step 6: Clear NET/ARS exams for research roles or start your own agri-enterprise."
            ];

            Career::updateOrCreate(
                ['slug' => $careerData['slug']],
                array_merge($careerData, [
                    'field_id' => $field->id,
                    'roadmap' => $roadmap,
                    'future_scope' => $futureScopeCommon . "\n\nNote: The sector is evolving with AgriTech, offering high-growth opportunities for tech-savvy professionals."
                ])
            );
        }

        $this->command->info('Agriculture & Allied Sciences careers seeded successfully.');
    }
}
