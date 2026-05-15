<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Career;
use App\Models\Field;

class HospitalityAviationTourismLogisticsCareerSeeder extends Seeder
{
    public function run(): void
    {
        $fieldSlug = 'hospitality-aviation-tourism-logistics';
        $field = Field::where('slug', $fieldSlug)->first();

        if (!$field) {
            $this->command->error("Field '$fieldSlug' not found. Please run FieldsSeeder first.");
            return;
        }

        $careers = [
            [
                'slug' => 'hotel-manager',
                'name' => 'Hotel Manager',
                'sub_domain' => 'Hotel & Hospitality Management',
                'description' => 'Hotel Managers oversee hotel operations including guest services, staff management, rooms, food services, budgeting, and customer satisfaction.',
                'salary_range' => '₹4L – ₹18L',
                'demand_level' => 'High',
                'qualification' => 'BHM / BBA Hospitality / Diploma in Hotel Management',
                'stream' => 'Any Stream',
                'entrance_exams' => ['NCHM JEE', 'CUET', 'HMI Entrance Exams'],
                'skills' => ['Leadership', 'Guest Handling', 'Operations Management', 'Communication', 'Problem Solving'],
                'job_opportunities' => ['Hotels', 'Resorts', 'Luxury Chains', 'Business Hotels', 'Hospitality Groups'],
                'image' => 'images/careers/hospitality-aviation-tourism-logistics/hotel-manager.svg'
            ],
            [
                'slug' => 'restaurant-manager',
                'name' => 'Restaurant Manager',
                'sub_domain' => 'Restaurant & Food Service Management',
                'description' => 'Restaurant Managers handle restaurant operations, staff scheduling, customer service, inventory, billing, and food service quality.',
                'salary_range' => '₹3L – ₹12L',
                'demand_level' => 'High',
                'qualification' => 'BHM / Diploma in Food & Beverage Service / Hospitality Management',
                'stream' => 'Any Stream',
                'entrance_exams' => ['NCHM JEE', 'CUET', 'Private Hospitality Exams'],
                'skills' => ['Customer Service', 'Team Management', 'Food Service Operations', 'Inventory Control', 'Communication'],
                'job_opportunities' => ['Restaurants', 'Cafes', 'Hotels', 'Food Chains', 'Fine Dining Brands'],
                'image' => 'images/careers/hospitality-aviation-tourism-logistics/restaurant-manager.svg'
            ],
            [
                'slug' => 'front-office-manager',
                'name' => 'Front Office Manager',
                'sub_domain' => 'Hotel & Hospitality Management',
                'description' => 'Front Office Managers supervise reception, guest check-in, reservations, billing coordination, complaint handling, and front desk staff.',
                'salary_range' => '₹3L – ₹10L',
                'demand_level' => 'High',
                'qualification' => 'BHM / Diploma in Front Office Operations / Hospitality Management',
                'stream' => 'Any Stream',
                'entrance_exams' => ['NCHM JEE', 'CUET', 'Hospitality Institute Exams'],
                'skills' => ['Guest Relations', 'Communication', 'Reservation Systems', 'Problem Solving', 'Team Coordination'],
                'job_opportunities' => ['Hotels', 'Resorts', 'Guest Houses', 'Luxury Hospitality Chains', 'Business Hotels'],
                'image' => 'images/careers/hospitality-aviation-tourism-logistics/front-office-manager.svg'
            ],
            [
                'slug' => 'housekeeping-manager',
                'name' => 'Housekeeping Manager',
                'sub_domain' => 'Hotel & Hospitality Management',
                'description' => 'Housekeeping Managers manage cleanliness, room readiness, laundry, hygiene standards, housekeeping staff, and guest comfort in hotels.',
                'salary_range' => '₹3L – ₹10L',
                'demand_level' => 'Moderate',
                'qualification' => 'BHM / Diploma in Housekeeping / Hospitality Management',
                'stream' => 'Any Stream',
                'entrance_exams' => ['NCHM JEE', 'CUET', 'Hotel Management Institute Exams'],
                'skills' => ['Hygiene Management', 'Staff Supervision', 'Attention to Detail', 'Inventory Control', 'Guest Service'],
                'job_opportunities' => ['Hotels', 'Resorts', 'Hospitals', 'Cruise Lines', 'Facility Management Companies'],
                'image' => 'images/careers/hospitality-aviation-tourism-logistics/housekeeping-manager.svg'
            ],
            [
                'slug' => 'chef-de-partie',
                'name' => 'Chef de Partie',
                'sub_domain' => 'Culinary Arts & Bakery',
                'description' => 'Chef de Partie is responsible for managing a specific kitchen section such as sauces, grill, pastry, vegetables, or cold kitchen.',
                'salary_range' => '₹3L – ₹9L',
                'demand_level' => 'High',
                'qualification' => 'Diploma / Degree in Culinary Arts or Hotel Management',
                'stream' => 'Any Stream',
                'entrance_exams' => ['NCHM JEE', 'Culinary Institute Entrance Exams'],
                'skills' => ['Cooking Techniques', 'Kitchen Management', 'Food Presentation', 'Hygiene', 'Time Management'],
                'job_opportunities' => ['Hotels', 'Restaurants', 'Resorts', 'Cruise Ships', 'Catering Companies'],
                'image' => 'images/careers/hospitality-aviation-tourism-logistics/chef-de-partie.svg'
            ],
            [
                'slug' => 'sous-chef',
                'name' => 'Sous Chef',
                'sub_domain' => 'Culinary Arts & Bakery',
                'description' => 'Sous Chefs are second-in-command in professional kitchens and assist the head chef in menu planning, staff supervision, and food quality control.',
                'salary_range' => '₹4L – ₹14L',
                'demand_level' => 'High',
                'qualification' => 'Diploma / Degree in Culinary Arts or Hotel Management',
                'stream' => 'Any Stream',
                'entrance_exams' => ['NCHM JEE', 'Private Culinary Institute Exams'],
                'skills' => ['Culinary Expertise', 'Leadership', 'Menu Planning', 'Kitchen Operations', 'Food Safety'],
                'job_opportunities' => ['Hotels', 'Fine Dining Restaurants', 'Resorts', 'Cruise Ships', 'Catering Brands'],
                'image' => 'images/careers/hospitality-aviation-tourism-logistics/sous-chef.svg'
            ],
            [
                'slug' => 'bakery-chef',
                'name' => 'Bakery Chef',
                'sub_domain' => 'Culinary Arts & Bakery',
                'description' => 'Bakery Chefs prepare breads, cakes, pastries, desserts, cookies, and bakery products for hotels, cafes, bakeries, and restaurants.',
                'salary_range' => '₹2.5L – ₹10L',
                'demand_level' => 'High',
                'qualification' => 'Diploma in Bakery & Confectionery / Culinary Arts / Hotel Management',
                'stream' => 'Any Stream',
                'entrance_exams' => ['Culinary Institute Entrance Exams', 'Hotel Management Institute Exams'],
                'skills' => ['Baking', 'Pastry Making', 'Decoration', 'Recipe Development', 'Food Hygiene', 'Creativity'],
                'job_opportunities' => ['Bakeries', 'Hotels', 'Cafes', 'Restaurants', 'Dessert Brands'],
                'image' => 'images/careers/hospitality-aviation-tourism-logistics/bakery-chef.svg'
            ],
            [
                'slug' => 'barista',
                'name' => 'Barista',
                'sub_domain' => 'Beverage & Cafe Services',
                'description' => 'Baristas prepare coffee, espresso drinks, beverages, and cafe items while maintaining service quality and customer experience.',
                'salary_range' => '₹1.8L – ₹6L',
                'demand_level' => 'High',
                'qualification' => 'Barista Training / Diploma in Food & Beverage Service',
                'stream' => 'Any Stream',
                'entrance_exams' => ['Skill-based Training Programs'],
                'skills' => ['Coffee Brewing', 'Latte Art', 'Customer Service', 'Beverage Knowledge', 'Cleanliness', 'Communication'],
                'job_opportunities' => ['Cafes', 'Coffee Chains', 'Hotels', 'Restaurants', 'Premium Beverage Brands'],
                'image' => 'images/careers/hospitality-aviation-tourism-logistics/barista.svg'
            ],
            [
                'slug' => 'sommelier',
                'name' => 'Sommelier',
                'sub_domain' => 'Beverage & Cafe Services',
                'description' => 'Sommeliers are beverage specialists who guide guests in wine and beverage selection, pairing, storage, and premium dining service.',
                'salary_range' => '₹4L – ₹18L+',
                'demand_level' => 'Moderate',
                'qualification' => 'Hospitality Degree / Beverage Service Certification / Sommelier Certification',
                'stream' => 'Any Stream',
                'entrance_exams' => ['Certification-based Exams'],
                'skills' => ['Beverage Knowledge', 'Guest Advisory', 'Pairing Skills', 'Fine Dining Service', 'Communication'],
                'job_opportunities' => ['Luxury Hotels', 'Fine Dining Restaurants', 'Resorts', 'Cruise Ships'],
                'image' => 'images/careers/hospitality-aviation-tourism-logistics/sommelier.svg'
            ],
            [
                'slug' => 'travel-agent',
                'name' => 'Travel Agent',
                'sub_domain' => 'Travel & Tourism',
                'description' => 'Travel Agents help customers plan trips, book tickets, arrange hotels, design tour packages, and provide travel guidance.',
                'salary_range' => '₹2L – ₹8L',
                'demand_level' => 'Moderate',
                'qualification' => 'Diploma / Degree in Travel & Tourism Management',
                'stream' => 'Arts / Commerce / Any Stream',
                'entrance_exams' => ['CUET', 'Tourism Institute Entrance Exams'],
                'skills' => ['Itinerary Planning', 'Ticketing', 'Customer Service', 'Communication', 'Destination Knowledge'],
                'job_opportunities' => ['Travel Agencies', 'Tour Operators', 'Online Travel Companies', 'Airlines'],
                'image' => 'images/careers/hospitality-aviation-tourism-logistics/travel-agent.svg'
            ],
            [
                'slug' => 'tourism-manager',
                'name' => 'Tourism Manager',
                'sub_domain' => 'Travel & Tourism',
                'description' => 'Tourism Managers plan, promote, and manage tourism services, travel packages, customer experiences, and tourism business operations.',
                'salary_range' => '₹3L – ₹12L',
                'demand_level' => 'High',
                'qualification' => 'BA / BBA / MBA in Tourism or Travel Management',
                'stream' => 'Arts / Commerce / Any Stream',
                'entrance_exams' => ['CUET', 'University Entrance Exams', 'MBA Entrance Exams'],
                'skills' => ['Tourism Planning', 'Marketing', 'Customer Handling', 'Operations', 'Communication', 'Cultural Knowledge'],
                'job_opportunities' => ['Tourism Departments', 'Travel Companies', 'Resorts', 'Tour Operators'],
                'image' => 'images/careers/hospitality-aviation-tourism-logistics/tourism-manager.svg'
            ],
            [
                'slug' => 'destination-manager',
                'name' => 'Destination Manager',
                'sub_domain' => 'Travel & Tourism',
                'description' => 'Destination Managers develop and promote tourist destinations by coordinating tourism services, local attractions, events, and visitor experiences.',
                'salary_range' => '₹4L – ₹14L',
                'demand_level' => 'Moderate',
                'qualification' => 'Degree in Tourism Management, Hospitality, Marketing, or Event Management',
                'stream' => 'Arts / Commerce / Management / Any Stream',
                'entrance_exams' => ['CUET', 'Tourism Institute Exams', 'MBA Entrance Exams'],
                'skills' => ['Destination Promotion', 'Planning', 'Local Coordination', 'Marketing', 'Research', 'Communication'],
                'job_opportunities' => ['Tourism Boards', 'Travel Companies', 'Resorts', 'Government Tourism Departments'],
                'image' => 'images/careers/hospitality-aviation-tourism-logistics/destination-manager.svg'
            ],
            [
                'slug' => 'cruise-ship-staff',
                'name' => 'Cruise Ship Staff',
                'sub_domain' => 'Cruise & Luxury Hospitality',
                'description' => 'Cruise Ship Staff work in hospitality, housekeeping, food service, guest relations, entertainment, and operations on cruise ships.',
                'salary_range' => '₹3L – ₹15L+',
                'demand_level' => 'Moderate',
                'qualification' => 'Hotel Management / Hospitality Diploma / Relevant Skill Certification',
                'stream' => 'Any Stream',
                'entrance_exams' => ['Skill Tests and Interviews'],
                'skills' => ['Guest Service', 'Communication', 'Hospitality Operations', 'Teamwork', 'Adaptability', 'Safety Awareness'],
                'job_opportunities' => ['Cruise Lines', 'Luxury Hospitality Companies', 'Marine Tourism Companies'],
                'image' => 'images/careers/hospitality-aviation-tourism-logistics/cruise-ship-staff.svg'
            ],
            [
                'slug' => 'airport-ground-staff',
                'name' => 'Airport Ground Staff',
                'sub_domain' => 'Aviation Operations',
                'description' => 'Airport Ground Staff assist passengers with check-in, boarding, baggage, customer queries, airport coordination, and airline ground operations.',
                'salary_range' => '₹2L – ₹7L',
                'demand_level' => 'High',
                'qualification' => '12th / Diploma in Aviation, Airport Management, or Hospitality',
                'stream' => 'Any Stream',
                'entrance_exams' => ['Aviation Institute Entrance Exams', 'Airline Interviews'],
                'skills' => ['Customer Service', 'Communication', 'Airport Procedures', 'Problem Solving', 'Grooming', 'Teamwork'],
                'job_opportunities' => ['Airlines', 'Airports', 'Ground Handling Companies', 'Aviation Service Providers'],
                'image' => 'images/careers/hospitality-aviation-tourism-logistics/airport-ground-staff.svg'
            ],
            [
                'slug' => 'cabin-crew',
                'name' => 'Cabin Crew',
                'sub_domain' => 'Aviation Operations',
                'description' => 'Cabin Crew members ensure passenger safety, comfort, in-flight service, emergency handling, and professional airline hospitality.',
                'salary_range' => '₹4L – ₹15L+',
                'demand_level' => 'High',
                'qualification' => '12th / Diploma in Aviation, Hospitality, or Cabin Crew Training',
                'stream' => 'Any Stream',
                'entrance_exams' => ['Airline Selection Process', 'Medical Tests'],
                'skills' => ['Communication', 'Safety Procedures', 'Customer Service', 'Grooming', 'Emergency Handling', 'Teamwork'],
                'job_opportunities' => ['Domestic Airlines', 'International Airlines', 'Charter Airlines', 'Private Aviation'],
                'image' => 'images/careers/hospitality-aviation-tourism-logistics/cabin-crew.svg'
            ],
            [
                'slug' => 'air-traffic-controller',
                'name' => 'Air Traffic Controller',
                'sub_domain' => 'Aviation Operations',
                'description' => 'Air Traffic Controllers manage aircraft movement, guide pilots, prevent collisions, and ensure safe takeoff, landing, and flight navigation.',
                'salary_range' => '₹8L – ₹25L+',
                'demand_level' => 'Very High',
                'qualification' => 'B.Sc / B.Tech / Graduation with required subjects',
                'stream' => 'Science / Engineering',
                'entrance_exams' => ['AAI ATC Recruitment Exam', 'GATE'],
                'skills' => ['Decision Making', 'Attention to Detail', 'Communication', 'Pressure Handling', 'Aviation Knowledge'],
                'job_opportunities' => ['Airports Authority', 'Air Navigation Services', 'Civil Aviation Sector'],
                'image' => 'images/careers/hospitality-aviation-tourism-logistics/air-traffic-controller.svg'
            ],
            [
                'slug' => 'aircraft-maintenance-technician',
                'name' => 'Aircraft Maintenance Technician',
                'sub_domain' => 'Aircraft Maintenance & Safety',
                'description' => 'Aircraft Maintenance Technicians inspect, repair, and maintain aircraft systems, engines, structures, and safety equipment.',
                'salary_range' => '₹3L – ₹12L',
                'demand_level' => 'High',
                'qualification' => 'AME Course / Diploma in Aircraft Maintenance / Aeronautical Engineering',
                'stream' => 'Science / Engineering',
                'entrance_exams' => ['AME CET', 'Aviation Institute Entrance Exams'],
                'skills' => ['Aircraft Systems', 'Mechanical Skills', 'Electrical Knowledge', 'Safety Checks', 'Technical Documentation'],
                'job_opportunities' => ['Airlines', 'MRO Companies', 'Airports', 'Aircraft Manufacturing'],
                'image' => 'images/careers/hospitality-aviation-tourism-logistics/aircraft-maintenance-technician.svg'
            ],
            [
                'slug' => 'cargo-manager',
                'name' => 'Cargo Manager',
                'sub_domain' => 'Cargo, Logistics & Supply Chain',
                'description' => 'Cargo Managers supervise cargo handling, shipment documentation, warehousing, customs coordination, and transport movement.',
                'salary_range' => '₹4L – ₹14L',
                'demand_level' => 'High',
                'qualification' => 'BBA / MBA / Diploma in Logistics, Supply Chain, or Aviation Cargo Management',
                'stream' => 'Commerce / Management / Any Stream',
                'entrance_exams' => ['CUET', 'MBA Entrance Exams', 'Logistics Institute Exams'],
                'skills' => ['Cargo Handling', 'Documentation', 'Supply Chain Coordination', 'Customs Knowledge', 'Inventory Control'],
                'job_opportunities' => ['Airlines', 'Airports', 'Logistics Companies', 'Freight Forwarders', 'Shipping Companies'],
                'image' => 'images/careers/hospitality-aviation-tourism-logistics/cargo-manager.svg'
            ],
            [
                'slug' => 'logistics-manager',
                'name' => 'Logistics Manager',
                'sub_domain' => 'Cargo, Logistics & Supply Chain',
                'description' => 'Logistics Managers plan and manage movement of goods, transport networks, delivery systems, vendors, and supply chain operations.',
                'salary_range' => '₹5L – ₹18L',
                'demand_level' => 'Very High',
                'qualification' => 'BBA / MBA / Diploma in Logistics or Supply Chain Management',
                'stream' => 'Commerce / Management / Engineering / Any Stream',
                'entrance_exams' => ['CUET', 'CAT', 'MAT', 'CMAT', 'Logistics Institute Exams'],
                'skills' => ['Supply Chain Management', 'Transport Planning', 'Vendor Management', 'Data Analysis', 'Problem Solving'],
                'job_opportunities' => ['E-commerce Companies', 'Manufacturing Firms', 'Logistics Companies', 'Retail Chains'],
                'image' => 'images/careers/hospitality-aviation-tourism-logistics/logistics-manager.svg'
            ],
            [
                'slug' => 'warehouse-manager',
                'name' => 'Warehouse Manager',
                'sub_domain' => 'Cargo, Logistics & Supply Chain',
                'description' => 'Warehouse Managers oversee storage, stock movement, dispatch, inventory records, warehouse staff, and safety procedures.',
                'salary_range' => '₹3L – ₹12L',
                'demand_level' => 'High',
                'qualification' => 'Graduation / Diploma in Logistics, Warehouse Management, or Supply Chain',
                'stream' => 'Commerce / Management / Any Stream',
                'entrance_exams' => ['Logistics Institute Exams'],
                'skills' => ['Inventory Management', 'Team Supervision', 'Safety Procedures', 'ERP Systems', 'Planning', 'Coordination'],
                'job_opportunities' => ['Warehouses', 'E-commerce Companies', 'Retail Companies', 'Logistics Firms'],
                'image' => 'images/careers/hospitality-aviation-tourism-logistics/warehouse-manager.svg'
            ],
            [
                'slug' => 'inventory-controller',
                'name' => 'Inventory Controller',
                'sub_domain' => 'Cargo, Logistics & Supply Chain',
                'description' => 'Inventory Controllers track stock levels, maintain records, prevent shortages, manage reorder points, and support warehouse efficiency.',
                'salary_range' => '₹2.5L – ₹8L',
                'demand_level' => 'High',
                'qualification' => 'Graduation / Diploma in Inventory, Logistics, Supply Chain, or Commerce',
                'stream' => 'Commerce / Management / Any Stream',
                'entrance_exams' => ['None'],
                'skills' => ['Stock Control', 'Data Entry', 'ERP Software', 'Attention to Detail', 'Reporting', 'Coordination'],
                'job_opportunities' => ['Warehouses', 'Retail Chains', 'Manufacturing Companies', 'E-commerce Firms'],
                'image' => 'images/careers/hospitality-aviation-tourism-logistics/inventory-controller.svg'
            ],
            [
                'slug' => 'event-coordinator',
                'name' => 'Event Coordinator',
                'sub_domain' => 'Event, Wedding & Facility Management',
                'description' => 'Event Coordinators plan and execute events by managing vendors, schedules, venues, budgets, guests, and event operations.',
                'salary_range' => '₹2.5L – ₹10L',
                'demand_level' => 'High',
                'qualification' => 'Diploma / Degree in Event Management, Hospitality, or Mass Communication',
                'stream' => 'Any Stream',
                'entrance_exams' => ['CUET', 'Event Management Institute Exams'],
                'skills' => ['Planning', 'Vendor Coordination', 'Budgeting', 'Communication', 'Problem Solving', 'Creativity'],
                'job_opportunities' => ['Event Companies', 'Hotels', 'Corporate Firms', 'Wedding Agencies', 'Media Houses'],
                'image' => 'images/careers/hospitality-aviation-tourism-logistics/event-coordinator.svg'
            ],
            [
                'slug' => 'wedding-planner',
                'name' => 'Wedding Planner',
                'sub_domain' => 'Event, Wedding & Facility Management',
                'description' => 'Wedding Planners organize wedding ceremonies, venues, decoration, catering, guest management, budgets, schedules, and vendor coordination.',
                'salary_range' => '₹3L – ₹15L+',
                'demand_level' => 'High',
                'qualification' => 'Event Management Course / Hospitality Degree / Wedding Planning Certification',
                'stream' => 'Any Stream',
                'entrance_exams' => ['Event Institute Exams'],
                'skills' => ['Creativity', 'Vendor Management', 'Budget Planning', 'Client Handling', 'Decoration Planning', 'Communication'],
                'job_opportunities' => ['Wedding Planning Firms', 'Event Companies', 'Hotels', 'Resorts', 'Freelance Services'],
                'image' => 'images/careers/hospitality-aviation-tourism-logistics/wedding-planner.svg'
            ],
            [
                'slug' => 'facility-manager',
                'name' => 'Facility Manager',
                'sub_domain' => 'Event, Wedding & Facility Management',
                'description' => 'Facility Managers manage building services, maintenance, safety, housekeeping, utilities, vendor services, and workplace operations.',
                'salary_range' => '₹4L – ₹15L',
                'demand_level' => 'High',
                'qualification' => 'Graduation / Diploma in Facility Management, Hospitality, Engineering, or Administration',
                'stream' => 'Management / Engineering / Any Stream',
                'entrance_exams' => ['MBA Entrance Exams for Advanced Roles'],
                'skills' => ['Facility Operations', 'Vendor Management', 'Maintenance Planning', 'Safety Compliance', 'Budgeting', 'Leadership'],
                'job_opportunities' => ['Corporate Offices', 'Hospitals', 'Malls', 'Hotels', 'IT Parks', 'Real Estate Companies'],
                'image' => 'images/careers/hospitality-aviation-tourism-logistics/facility-manager.svg'
            ],
            [
                'slug' => 'food-safety-inspector',
                'name' => 'Food Safety Inspector',
                'sub_domain' => 'Food Safety & Quality Inspection',
                'description' => 'Food Safety Inspectors check food quality, hygiene, safety standards, storage practices, licenses, and compliance with food regulations.',
                'salary_range' => '₹3L – ₹10L',
                'demand_level' => 'High',
                'qualification' => 'B.Sc Food Technology / Microbiology / Chemistry / Agriculture / Relevant Science Degree',
                'stream' => 'Science',
                'entrance_exams' => ['FSSAI Recruitment Exam', 'State PSC Exams', 'FSO Exams'],
                'skills' => ['Food Safety Rules', 'Inspection', 'Documentation', 'Hygiene Standards', 'Scientific Knowledge', 'Reporting'],
                'job_opportunities' => ['Food Safety Departments', 'FSSAI', 'State Government', 'Food Manufacturing Units', 'Hotels'],
                'image' => 'images/careers/hospitality-aviation-tourism-logistics/food-safety-inspector.svg'
            ]
        ];

        $futureScopeCommon = "The Hospitality, Aviation, Tourism & Logistics industry is a critical pillar of the global economy, offering dynamic career paths with rapid advancement opportunities and international exposure.";

        foreach ($careers as $careerData) {
            $roadmap = [
                "Step 1: Complete 10+2 in any stream (Science/Commerce preferred for Aviation/Logistics).",
                "Step 2: Pursue a relevant Degree, Diploma, or Certification (BHM/BBA/B.Sc/AME) based on the specific career.",
                "Step 3: Gain practical experience through internships or entry-level roles in hotels, airlines, or logistics firms.",
                "Step 4: Obtain mandatory licenses or certifications (e.g., AME license, Food Safety certification) where required.",
                "Step 5: Develop soft skills like communication, leadership, and crisis management.",
                "Step 6: Advance to managerial roles or specialize in niche sectors like luxury travel or supply chain optimization."
            ];

            Career::updateOrCreate(
                ['slug' => $careerData['slug']],
                array_merge($careerData, [
                    'field_id' => $field->id,
                    'roadmap' => $roadmap,
                    'future_scope' => $futureScopeCommon . "\n\nNote: This sector values operational efficiency and exceptional service quality above all else."
                ])
            );
        }

        $this->command->info('Hospitality, Aviation, Tourism & Logistics careers seeded successfully.');
    }
}
