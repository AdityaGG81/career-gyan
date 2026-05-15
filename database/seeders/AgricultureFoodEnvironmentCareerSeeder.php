<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Career;
use App\Models\Field;

class AgricultureFoodEnvironmentCareerSeeder extends Seeder
{
    public function run(): void
    {
        $fieldSlug = 'agriculture-food-environment';
        $field = Field::where('slug', $fieldSlug)->first();

        if (!$field) {
            $this->command->error("Field '$fieldSlug' not found. Please run FieldsSeeder first.");
            return;
        }

        $careers = [
            [
                'slug' => 'agricultural-extension-officer',
                'name' => 'Agricultural Extension Officer',
                'field_id' => $field->id,
                'description' => 'Agricultural Extension Officers guide farmers on modern farming practices, crop management, government schemes, soil health, and technology adoption.',
                'salary_range' => '₹4L – ₹10L',
                'demand_level' => 'High',
                'qualification' => 'B.Sc Agriculture / B.Tech Agriculture / related degree',
                'stream' => 'Science / Agriculture',
                'skills' => ['Farmer Communication', 'Crop Knowledge', 'Field Work', 'Scheme Awareness', 'Problem Solving'],
                'entrance_exams' => ['ICAR AIEEA', 'MCAER CET', 'State Agriculture/PSC Exams'],
                'roadmap' => [
                    'Step 1: Complete 10+2 with Science/Agriculture subjects where possible.',
                    'Step 2: Pursue B.Sc Agriculture / B.Tech Agriculture / related degree based on the role.',
                    'Step 3: Gain field knowledge through farm visits, internships, KVK training, or agri-business projects.',
                    'Step 4: Learn modern tools like soil testing, drip irrigation, GIS, farm machinery, or food processing methods.',
                    'Step 5: Start as trainee, assistant, field officer, or junior analyst.',
                    'Step 6: Grow into officer, specialist, consultant, manager, or government/private sector leader.'
                ],
                'future_scope' => 'Strong future scope due to India\'s focus on food security and modern technology adoption in farming.',
                'job_opportunities' => ['Agriculture Department', 'Krishi Vigyan Kendras', 'NGOs', 'AgriTech Companies'],
                'image' => 'images/careers/agriculture-food-environment/agricultural-extension-officer.svg',
                'sub_domain' => 'Agricultural Services & Extension'
            ],
            [
                'slug' => 'agricultural-officer',
                'name' => 'Agricultural Officer',
                'field_id' => $field->id,
                'description' => 'Agricultural Officers work in government or private sectors to support farming development, crop planning, inspections, subsidies, and agricultural schemes.',
                'salary_range' => '₹4L – ₹12L',
                'demand_level' => 'High',
                'qualification' => 'B.Sc Agriculture / B.Tech Agriculture',
                'stream' => 'Science / Agriculture',
                'skills' => ['Agriculture Knowledge', 'Documentation', 'Field Inspection', 'Farmer Support', 'Policy Awareness'],
                'entrance_exams' => ['State PSC Agriculture Officer Exam', 'ICAR AIEEA', 'MCAER CET'],
                'roadmap' => [
                    'Step 1: Complete 10+2 with Science/Agriculture subjects.',
                    'Step 2: Pursue B.Sc Agriculture / B.Tech Agriculture.',
                    'Step 3: Gain field knowledge through internships or agri-business projects.',
                    'Step 4: Learn modern tools like soil testing and irrigation systems.',
                    'Step 5: Start as an assistant agriculture officer.',
                    'Step 6: Grow into a senior officer, manager, or government leader.'
                ],
                'future_scope' => 'Critical for implementing government schemes and ensuring agricultural productivity.',
                'job_opportunities' => ['State Agriculture Departments', 'Banks', 'Fertilizer Companies', 'Agri Input Companies'],
                'image' => 'images/careers/agriculture-food-environment/agricultural-officer.svg',
                'sub_domain' => 'Agricultural Services & Extension'
            ],
            [
                'slug' => 'farm-manager',
                'name' => 'Farm Manager',
                'field_id' => $field->id,
                'description' => 'Farm Managers plan and supervise crop production, labour, machinery, irrigation, storage, budgeting, and farm profitability.',
                'salary_range' => '₹3L – ₹10L',
                'demand_level' => 'High',
                'qualification' => 'B.Sc Agriculture / Diploma in Agriculture / Farm Management course',
                'stream' => 'Science / Agriculture',
                'skills' => ['Farm Planning', 'Team Management', 'Irrigation', 'Crop Scheduling', 'Budgeting'],
                'entrance_exams' => ['ICAR AIEEA', 'Agriculture Diploma/University Entrance Exams'],
                'roadmap' => [
                    'Step 1: Complete 10+2 with Science/Agriculture subjects.',
                    'Step 2: Pursue B.Sc Agriculture or Diploma in Farm Management.',
                    'Step 3: Gain practical experience on large farms or through internships.',
                    'Step 4: Learn about farm machinery and irrigation management.',
                    'Step 5: Start as an assistant farm manager.',
                    'Step 6: Advance to senior management or consultancy roles.'
                ],
                'future_scope' => 'Increasing demand in corporate farming and large-scale agribusiness operations.',
                'job_opportunities' => ['Large Farms', 'Agri Companies', 'Organic Farms', 'Plantation Companies'],
                'image' => 'images/careers/agriculture-food-environment/farm-manager.svg',
                'sub_domain' => 'Farm Management & Agribusiness'
            ],
            [
                'slug' => 'organic-farmer',
                'name' => 'Organic Farmer',
                'field_id' => $field->id,
                'description' => 'Organic Farmers grow crops using natural inputs, composting, biofertilizers, crop rotation, and chemical-free farming methods.',
                'salary_range' => '₹2L – ₹12L',
                'demand_level' => 'Growing',
                'qualification' => '10+2 / Agriculture training / B.Sc Agriculture preferred',
                'stream' => 'Any Stream / Agriculture',
                'skills' => ['Organic Farming', 'Composting', 'Soil Health', 'Marketing', 'Sustainability'],
                'entrance_exams' => ['No mandatory entrance exam'],
                'roadmap' => [
                    'Step 1: Complete 10+2 and pursue agriculture training.',
                    'Step 2: Learn organic certification standards and natural farming methods.',
                    'Step 3: Start with a small-scale organic farm or join a collective.',
                    'Step 4: Build market linkages through local markets or online platforms.',
                    'Step 5: Scale operations or provide consultancy to other farmers.'
                ],
                'future_scope' => 'High growth potential due to increasing consumer demand for chemical-free food.',
                'job_opportunities' => ['Self-Employment', 'Organic Farms', 'Farmer Producer Companies', 'Agri Startups'],
                'image' => 'images/careers/agriculture-food-environment/organic-farmer.svg',
                'sub_domain' => 'Sustainable & Organic Farming'
            ],
            [
                'slug' => 'agricultural-economist',
                'name' => 'Agricultural Economist',
                'field_id' => $field->id,
                'description' => 'Agricultural Economists study farm markets, prices, rural finance, crop demand, policies, and agricultural business decisions.',
                'salary_range' => '₹5L – ₹16L',
                'demand_level' => 'High',
                'qualification' => 'BA/B.Sc Agriculture Economics / M.Sc Agricultural Economics / Economics degree',
                'stream' => 'Commerce / Arts / Agriculture',
                'skills' => ['Economics', 'Data Analysis', 'Policy Research', 'Market Study', 'Report Writing'],
                'entrance_exams' => ['CUET UG', 'ICAR PG', 'University Entrance Exams'],
                'roadmap' => [
                    'Step 1: Complete 10+2 in any stream.',
                    'Step 2: Pursue a degree in Agriculture Economics or General Economics.',
                    'Step 3: Obtain a Master\'s degree for better career prospects.',
                    'Step 4: Gain research experience in agri-markets and policy.',
                    'Step 5: Work with research institutes, banks, or government departments.'
                ],
                'future_scope' => 'Essential for shaping agricultural policies and understanding global market dynamics.',
                'job_opportunities' => ['Research Institutes', 'Government Departments', 'Banks', 'Agri Consultancies'],
                'image' => 'images/careers/agriculture-food-environment/agricultural-economist.svg',
                'sub_domain' => 'Agricultural Economics & Data'
            ],
            [
                'slug' => 'agricultural-data-analyst',
                'name' => 'Agricultural Data Analyst',
                'field_id' => $field->id,
                'description' => 'Agricultural Data Analysts use farm data, satellite data, weather data, yield data, and market trends to support better agriculture decisions.',
                'salary_range' => '₹4L – ₹14L',
                'demand_level' => 'Very High',
                'qualification' => 'B.Sc Agriculture / B.Tech / Data Analytics certification',
                'stream' => 'Agriculture / IT / Science',
                'skills' => ['Excel', 'Python', 'GIS', 'Data Analysis', 'Agriculture Knowledge'],
                'entrance_exams' => ['CUET UG', 'ICAR', 'Data Analytics Certifications'],
                'roadmap' => [
                    'Step 1: Complete 10+2 with Science or Agriculture.',
                    'Step 2: Pursue B.Sc Agriculture or B.Tech with a focus on data.',
                    'Step 3: Obtain certifications in data analytics and GIS tools.',
                    'Step 4: Gain experience in analyzing agricultural data through projects.',
                    'Step 5: Work with AgriTech companies or research firms.'
                ],
                'future_scope' => 'Booming field driven by the digitalization of agriculture and precision farming.',
                'job_opportunities' => ['AgriTech Companies', 'Research Firms', 'Insurance Companies', 'Government Projects'],
                'image' => 'images/careers/agriculture-food-environment/agricultural-data-analyst.svg',
                'sub_domain' => 'Agricultural Economics & Data'
            ],
            [
                'slug' => 'agricultural-marketing-manager',
                'name' => 'Agricultural Marketing Manager',
                'field_id' => $field->id,
                'description' => 'Agricultural Marketing Managers handle sales, pricing, branding, supply chains, and promotion of agricultural products.',
                'salary_range' => '₹4L – ₹14L',
                'demand_level' => 'High',
                'qualification' => 'BBA Agribusiness / B.Sc Agriculture / MBA Agribusiness',
                'stream' => 'Agriculture / Commerce / Management',
                'skills' => ['Marketing', 'Sales', 'Agri Markets', 'Communication', 'Supply Chain'],
                'entrance_exams' => ['CAT', 'MAT', 'CMAT', 'ICAR', 'University Entrance Exams'],
                'roadmap' => [
                    'Step 1: Complete 10+2 and pursue a degree in Agribusiness or Marketing.',
                    'Step 2: Gain experience in sales and supply chain management.',
                    'Step 3: Learn about agri-commodity markets and branding.',
                    'Step 4: Start as a marketing executive in an agri-input company.',
                    'Step 5: Advance to management roles in FMCG or food processing firms.'
                ],
                'future_scope' => 'Vital for bridging the gap between farmers and consumers in a growing market.',
                'job_opportunities' => ['Agri Input Companies', 'FMCG', 'Food Processing Firms', 'Farmer Producer Companies'],
                'image' => 'images/careers/agriculture-food-environment/agricultural-marketing-manager.svg',
                'sub_domain' => 'Farm Management & Agribusiness'
            ],
            [
                'slug' => 'sericulture-farmer',
                'name' => 'Sericulture Farmer',
                'field_id' => $field->id,
                'description' => 'Sericulture Farmers rear silkworms and manage mulberry cultivation to produce silk cocoons for the textile industry.',
                'salary_range' => '₹2L – ₹8L',
                'demand_level' => 'Stable',
                'qualification' => '10th/12th + sericulture training / agriculture background preferred',
                'stream' => 'Any Stream / Agriculture',
                'skills' => ['Silkworm Rearing', 'Mulberry Farming', 'Hygiene', 'Farm Management', 'Market Linkage'],
                'entrance_exams' => ['No mandatory entrance exam'],
                'roadmap' => [
                    'Step 1: Complete basic education and obtain sericulture training.',
                    'Step 2: Establish a mulberry plantation and silkworm rearing unit.',
                    'Step 3: Focus on maintaining hygiene and optimal conditions for silkworms.',
                    'Step 4: Sell cocoons to silk boards or textile manufacturers.',
                    'Step 5: Expand operations or venture into value-added silk products.'
                ],
                'future_scope' => 'Steady demand for silk products ensures a stable career in sericulture.',
                'job_opportunities' => ['Self-Employment', 'Silk Boards', 'Sericulture Farms', 'Textile Supply Chains'],
                'image' => 'images/careers/agriculture-food-environment/sericulture-farmer.svg',
                'sub_domain' => 'Animal Husbandry & Allied Farming'
            ],
            [
                'slug' => 'apiculture-specialist',
                'name' => 'Apiculture Specialist',
                'field_id' => $field->id,
                'description' => 'Apiculture Specialists manage honeybee colonies for honey production, wax production, pollination services, and bee health.',
                'salary_range' => '₹2L – ₹9L',
                'demand_level' => 'Growing',
                'qualification' => 'Beekeeping training / Agriculture or Life Science background preferred',
                'stream' => 'Any Stream / Agriculture / Science',
                'skills' => ['Beekeeping', 'Colony Management', 'Honey Processing', 'Pollination', 'Entrepreneurship'],
                'entrance_exams' => ['No mandatory entrance exam'],
                'roadmap' => [
                    'Step 1: Complete training in apiculture and colony management.',
                    'Step 2: Set up beehives in suitable locations with high floral diversity.',
                    'Step 3: Manage bee health and honey harvesting processes.',
                    'Step 4: Sell honey, wax, and other bee products to local markets or companies.',
                    'Step 5: Offer pollination services to horticulture farms.'
                ],
                'future_scope' => 'Growing interest in natural honey and the importance of bees for pollination.',
                'job_opportunities' => ['Self-Employment', 'Honey Companies', 'Agri Startups', 'Horticulture Farms'],
                'image' => 'images/careers/agriculture-food-environment/apiculture-specialist.svg',
                'sub_domain' => 'Animal Husbandry & Allied Farming'
            ],
            [
                'slug' => 'florist',
                'name' => 'Florist',
                'field_id' => $field->id,
                'description' => 'Florists design floral arrangements, manage flower decoration, handle flower sales, and support events, hotels, and gifting businesses.',
                'salary_range' => '₹2L – ₹8L',
                'demand_level' => 'Growing',
                'qualification' => '10+2 / Floriculture training / Horticulture course preferred',
                'stream' => 'Any Stream',
                'skills' => ['Creativity', 'Flower Handling', 'Design Sense', 'Customer Service', 'Event Decoration'],
                'entrance_exams' => ['No mandatory entrance exam'],
                'roadmap' => [
                    'Step 1: Complete 10+2 and obtain training in floriculture or design.',
                    'Step 2: Gain experience in flower handling and arrangement styles.',
                    'Step 3: Work with event management companies or floral shops.',
                    'Step 4: Build a portfolio of floral designs for various occasions.',
                    'Step 5: Start your own florist business or event decoration firm.'
                ],
                'future_scope' => 'High demand in the event industry and the growing gifting culture.',
                'job_opportunities' => ['Flower Shops', 'Event Companies', 'Hotels', 'Wedding Decor Firms', 'Self-Employment'],
                'image' => 'images/careers/agriculture-food-environment/florist.svg',
                'sub_domain' => 'Horticulture, Floriculture & Landscaping'
            ],
            [
                'slug' => 'mushroom-cultivator',
                'name' => 'Mushroom Cultivator',
                'field_id' => $field->id,
                'description' => 'Mushroom Cultivators grow edible mushrooms in controlled environments using scientific cultivation, hygiene, and marketing practices.',
                'salary_range' => '₹2L – ₹10L',
                'demand_level' => 'Growing',
                'qualification' => '10+2 / Mushroom cultivation training / Agriculture background preferred',
                'stream' => 'Any Stream / Agriculture',
                'skills' => ['Mushroom Production', 'Hygiene', 'Temperature Control', 'Packaging', 'Marketing'],
                'entrance_exams' => ['No mandatory entrance exam'],
                'roadmap' => [
                    'Step 1: Complete 10+2 and pursue mushroom cultivation training.',
                    'Step 2: Set up a controlled environment for growing mushrooms.',
                    'Step 3: Focus on maintaining strict hygiene and climate control.',
                    'Step 4: Develop marketing channels for selling fresh or processed mushrooms.',
                    'Step 5: Expand production or provide training to other entrepreneurs.'
                ],
                'future_scope' => 'Rising demand for nutritious and protein-rich mushroom products.',
                'job_opportunities' => ['Self-Employment', 'Food Businesses', 'Agri Startups', 'Farmer Producer Companies'],
                'image' => 'images/careers/agriculture-food-environment/mushroom-cultivator.svg',
                'sub_domain' => 'Sustainable & Organic Farming'
            ],
            [
                'slug' => 'poultry-farmer',
                'name' => 'Poultry Farmer',
                'field_id' => $field->id,
                'description' => 'Poultry Farmers rear birds for eggs and meat while managing feed, health, housing, vaccination, and farm profitability.',
                'salary_range' => '₹2L – ₹12L',
                'demand_level' => 'High',
                'qualification' => '10+2 / Poultry farming training / Veterinary or Agriculture support knowledge',
                'stream' => 'Any Stream / Agriculture',
                'skills' => ['Poultry Management', 'Feed Planning', 'Disease Prevention', 'Farm Accounting', 'Marketing'],
                'entrance_exams' => ['No mandatory entrance exam'],
                'roadmap' => [
                    'Step 1: Complete basic education and obtain poultry farming training.',
                    'Step 2: Set up housing and infrastructure for poultry rearing.',
                    'Step 3: Manage feed, health, and vaccination of the birds.',
                    'Step 4: Sell poultry products to local markets or large food companies.',
                    'Step 5: Optimize farm profitability through efficient management.'
                ],
                'future_scope' => 'Steady demand for poultry products in the food industry.',
                'job_opportunities' => ['Self-Employment', 'Poultry Farms', 'Hatcheries', 'Food Companies'],
                'image' => 'images/careers/agriculture-food-environment/poultry-farmer.svg',
                'sub_domain' => 'Animal Husbandry & Allied Farming'
            ],
            [
                'slug' => 'goat-farming-entrepreneur',
                'name' => 'Goat Farming Entrepreneur',
                'field_id' => $field->id,
                'description' => 'Goat Farming Entrepreneurs manage goat rearing for milk, meat, breeding, manure, and rural agribusiness opportunities.',
                'salary_range' => '₹2L – ₹10L',
                'demand_level' => 'Growing',
                'qualification' => '10+2 / Animal husbandry or goat farming training',
                'stream' => 'Any Stream / Agriculture',
                'skills' => ['Animal Care', 'Feeding', 'Breeding', 'Disease Prevention', 'Business Planning'],
                'entrance_exams' => ['No mandatory entrance exam'],
                'roadmap' => [
                    'Step 1: Obtain training in animal husbandry and goat farming.',
                    'Step 2: Set up suitable infrastructure for goat rearing.',
                    'Step 3: Manage feeding, breeding, and health of the goats.',
                    'Step 4: Market goat products like meat, milk, and breeding stock.',
                    'Step 5: Expand into value-added products or consultancy.'
                ],
                'future_scope' => 'High potential for rural entrepreneurship and meat export.',
                'job_opportunities' => ['Self-Employment', 'Livestock Farms', 'Rural Enterprises', 'Farmer Producer Companies'],
                'image' => 'images/careers/agriculture-food-environment/goat-farming-entrepreneur.svg',
                'sub_domain' => 'Animal Husbandry & Allied Farming'
            ],
            [
                'slug' => 'dairy-farm-manager',
                'name' => 'Dairy Farm Manager',
                'field_id' => $field->id,
                'description' => 'Dairy Farm Managers supervise milk production, cattle health, feeding, breeding, hygiene, staff, and dairy business operations.',
                'salary_range' => '₹3L – ₹12L',
                'demand_level' => 'High',
                'qualification' => 'Dairy Technology / Animal Husbandry / Agriculture background preferred',
                'stream' => 'Science / Agriculture',
                'skills' => ['Dairy Management', 'Animal Health', 'Milk Quality', 'Team Management', 'Farm Accounting'],
                'entrance_exams' => ['ICAR', 'Dairy Technology Entrance Exams', 'University Entrance Exams'],
                'roadmap' => [
                    'Step 1: Complete 10+2 with Science and pursue a degree in Dairy Technology or Animal Husbandry.',
                    'Step 2: Gain practical experience on modern dairy farms.',
                    'Step 3: Learn about cattle nutrition and milk quality management.',
                    'Step 4: Start as an assistant dairy farm manager.',
                    'Step 5: Grow into a senior manager or start your own dairy enterprise.'
                ],
                'future_scope' => 'Crucial role in a country with high milk consumption and export potential.',
                'job_opportunities' => ['Dairy Farms', 'Milk Cooperatives', 'Dairy Companies', 'Self-Employment'],
                'image' => 'images/careers/agriculture-food-environment/dairy-farm-manager.svg',
                'sub_domain' => 'Animal Husbandry & Allied Farming'
            ],
            [
                'slug' => 'food-processing-entrepreneur',
                'name' => 'Food Processing Entrepreneur',
                'field_id' => $field->id,
                'description' => 'Food Processing Entrepreneurs create value-added food products such as pickles, jams, snacks, dairy products, grains, and packaged foods.',
                'salary_range' => '₹2L – ₹20L+',
                'demand_level' => 'Very High',
                'qualification' => 'Food Processing training / Food Technology / Entrepreneurship course',
                'stream' => 'Any Stream / Science / Agriculture',
                'skills' => ['Food Safety', 'Packaging', 'Branding', 'Business Planning', 'Marketing'],
                'entrance_exams' => ['No mandatory entrance exam'],
                'roadmap' => [
                    'Step 1: Pursue training in food processing or a degree in food technology.',
                    'Step 2: Identify a niche for value-added food products.',
                    'Step 3: Ensure compliance with food safety and quality standards.',
                    'Step 4: Build a brand and establish distribution channels.',
                    'Step 5: Scale up production and explore export opportunities.'
                ],
                'future_scope' => 'High demand for processed and packaged food in both urban and rural markets.',
                'job_opportunities' => ['Self-Employment', 'Food Startups', 'MSMEs', 'Farmer Producer Companies'],
                'image' => 'images/careers/agriculture-food-environment/food-processing-entrepreneur.svg',
                'sub_domain' => 'Food Processing & Entrepreneurship'
            ],
            [
                'slug' => 'agricultural-machinery-operator',
                'name' => 'Agricultural Machinery Operator',
                'field_id' => $field->id,
                'description' => 'Agricultural Machinery Operators run and maintain tractors, harvesters, seed drills, sprayers, irrigation pumps, and other farm equipment.',
                'salary_range' => '₹2L – ₹7L',
                'demand_level' => 'High',
                'qualification' => '10th/12th + machine operation training / ITI preferred',
                'stream' => 'Technical / Any Stream',
                'skills' => ['Machinery Operation', 'Maintenance', 'Safety', 'Field Work', 'Troubleshooting'],
                'entrance_exams' => ['No mandatory entrance exam'],
                'roadmap' => [
                    'Step 1: Complete basic education and obtain machine operation training or ITI certification.',
                    'Step 2: Gain experience in operating various farm implements.',
                    'Step 3: Learn basic maintenance and troubleshooting skills.',
                    'Step 4: Work with large farms or custom hiring centers.',
                    'Step 5: Start your own machinery services business.'
                ],
                'future_scope' => 'Increasing mechanization in agriculture ensures a steady demand for skilled operators.',
                'job_opportunities' => ['Farms', 'Custom Hiring Centres', 'Agri Machinery Companies', 'Contractors'],
                'image' => 'images/careers/agriculture-food-environment/agricultural-machinery-operator.svg',
                'sub_domain' => 'Agriculture Machinery & Field Operations'
            ],
            [
                'slug' => 'irrigation-technician',
                'name' => 'Irrigation Technician',
                'field_id' => $field->id,
                'description' => 'Irrigation Technicians install, maintain, and repair drip irrigation, sprinkler systems, pumps, pipes, and water distribution systems.',
                'salary_range' => '₹2.5L – ₹8L',
                'demand_level' => 'High',
                'qualification' => 'ITI / Diploma / Irrigation or agriculture training',
                'stream' => 'Technical / Agriculture',
                'skills' => ['Drip Irrigation', 'Pump Systems', 'Pipe Fitting', 'Water Management', 'Field Service'],
                'entrance_exams' => ['ITI/Polytechnic Admission'],
                'roadmap' => [
                    'Step 1: Obtain ITI or diploma in irrigation or a related technical field.',
                    'Step 2: Gain field experience in installing irrigation systems.',
                    'Step 3: Learn about different types of irrigation technologies.',
                    'Step 4: Work with irrigation companies or large-scale farms.',
                    'Step 5: Advance to service management or consultancy roles.'
                ],
                'future_scope' => 'Crucial for efficient water management in agriculture.',
                'job_opportunities' => ['Irrigation Companies', 'Farms', 'Government Projects', 'AgriTech Firms'],
                'image' => 'images/careers/agriculture-food-environment/irrigation-technician.svg',
                'sub_domain' => 'Water, Irrigation & Conservation'
            ],
            [
                'slug' => 'water-conservation-officer',
                'name' => 'Water Conservation Officer',
                'field_id' => $field->id,
                'description' => 'Water Conservation Officers plan and support watershed management, rainwater harvesting, soil-water conservation, and sustainable water use.',
                'salary_range' => '₹4L – ₹12L',
                'demand_level' => 'Growing',
                'qualification' => 'Agriculture / Civil / Environmental Science / Water Resource background',
                'stream' => 'Science / Agriculture / Engineering',
                'skills' => ['Water Management', 'Watershed Planning', 'Field Survey', 'GIS', 'Community Work'],
                'entrance_exams' => ['State PSC', 'University Entrance Exams', 'GATE optional'],
                'roadmap' => [
                    'Step 1: Complete a degree in Agriculture, Civil Engineering, or Environmental Science.',
                    'Step 2: Gain knowledge in watershed management and rainwater harvesting.',
                    'Step 3: Learn to use GIS tools for water resource mapping.',
                    'Step 4: Work with government departments or NGOs on water projects.',
                    'Step 5: Advance to policy-making or senior advisory roles.'
                ],
                'future_scope' => 'Increasing focus on sustainability and water security makes this a vital career path.',
                'job_opportunities' => ['Government Departments', 'NGOs', 'Watershed Projects', 'Rural Development Agencies'],
                'image' => 'images/careers/agriculture-food-environment/water-conservation-officer.svg',
                'sub_domain' => 'Water, Irrigation & Conservation'
            ],
            [
                'slug' => 'crop-insurance-advisor',
                'name' => 'Crop Insurance Advisor',
                'field_id' => $field->id,
                'description' => 'Crop Insurance Advisors help farmers understand crop insurance schemes, risk coverage, claim processes, and weather-related crop loss protection.',
                'salary_range' => '₹3L – ₹9L',
                'demand_level' => 'Growing',
                'qualification' => 'Graduation / Agriculture / Insurance training preferred',
                'stream' => 'Agriculture / Commerce / Any Stream',
                'skills' => ['Insurance Knowledge', 'Farmer Counselling', 'Documentation', 'Risk Assessment', 'Communication'],
                'entrance_exams' => ['Insurance certifications, recruitment exams where applicable'],
                'roadmap' => [
                    'Step 1: Complete graduation and obtain training in agriculture or insurance.',
                    'Step 2: Learn about various government and private crop insurance schemes.',
                    'Step 3: Gain experience in risk assessment and claim documentation.',
                    'Step 4: Work with insurance companies or agri-tech firms.',
                    'Step 5: Start your own insurance consultancy for farmers.'
                ],
                'future_scope' => 'Growing need for financial protection against climate-related crop losses.',
                'job_opportunities' => ['Insurance Companies', 'Banks', 'AgriTech Firms', 'Government Scheme Partners'],
                'image' => 'images/careers/agriculture-food-environment/crop-insurance-advisor.svg',
                'sub_domain' => 'Agricultural Economics & Data'
            ],
            [
                'slug' => 'plant-pathologist',
                'name' => 'Plant Pathologist',
                'field_id' => $field->id,
                'description' => 'Plant Pathologists study plant diseases, diagnose crop infections, and develop disease control methods to protect crop production.',
                'salary_range' => '₹4L – ₹15L',
                'demand_level' => 'High',
                'qualification' => 'B.Sc Agriculture + M.Sc Plant Pathology preferred',
                'stream' => 'Science / Agriculture',
                'skills' => ['Disease Diagnosis', 'Lab Testing', 'Crop Protection', 'Research', 'Field Survey'],
                'entrance_exams' => ['ICAR PG', 'CUET UG', 'University Entrance Exams'],
                'roadmap' => [
                    'Step 1: Complete B.Sc Agriculture and pursue M.Sc in Plant Pathology.',
                    'Step 2: Gain lab and field research experience in diagnosing plant diseases.',
                    'Step 3: Learn about various disease control methods.',
                    'Step 4: Work with research institutes or seed companies.',
                    'Step 5: Grow into a senior researcher or consultant.'
                ],
                'future_scope' => 'Essential for ensuring crop health and global food security.',
                'job_opportunities' => ['Research Institutes', 'Seed Companies', 'Agrochemical Companies', 'Universities'],
                'image' => 'images/careers/agriculture-food-environment/plant-pathologist.svg',
                'sub_domain' => 'Plant Protection & Crop Science'
            ],
            [
                'slug' => 'entomologist',
                'name' => 'Entomologist',
                'field_id' => $field->id,
                'description' => 'Entomologists study insects, pests, pollinators, and pest management methods for agriculture, public health, and biodiversity.',
                'salary_range' => '₹4L – ₹15L',
                'demand_level' => 'High',
                'qualification' => 'B.Sc Agriculture / Zoology + M.Sc Entomology preferred',
                'stream' => 'Science / Agriculture',
                'skills' => ['Insect Identification', 'Pest Management', 'Research', 'Lab Work', 'Field Survey'],
                'entrance_exams' => ['ICAR PG', 'CUET UG', 'University Entrance Exams'],
                'roadmap' => [
                    'Step 1: Complete B.Sc in Agriculture or Zoology and pursue M.Sc in Entomology.',
                    'Step 2: Gain experience in identifying insects and understanding their life cycles.',
                    'Step 3: Research sustainable pest management strategies.',
                    'Step 4: Work with seed companies or research institutes.',
                    'Step 5: Contribute to public health and biodiversity projects.'
                ],
                'future_scope' => 'Growing importance of sustainable pest control and protecting pollinators.',
                'job_opportunities' => ['Research Institutes', 'Agrochemical Companies', 'Seed Companies', 'Universities', 'Public Health Projects'],
                'image' => 'images/careers/agriculture-food-environment/entomologist.svg',
                'sub_domain' => 'Plant Protection & Crop Science'
            ],
            [
                'slug' => 'weed-scientist',
                'name' => 'Weed Scientist',
                'field_id' => $field->id,
                'description' => 'Weed Scientists study harmful weeds and develop control strategies to improve crop yield and reduce farm losses.',
                'salary_range' => '₹4L – ₹14L',
                'demand_level' => 'Stable',
                'qualification' => 'B.Sc Agriculture + M.Sc Agronomy / Weed Science preferred',
                'stream' => 'Science / Agriculture',
                'skills' => ['Weed Identification', 'Herbicide Knowledge', 'Agronomy', 'Field Trials', 'Research'],
                'entrance_exams' => ['ICAR PG', 'CUET UG', 'University Entrance Exams'],
                'roadmap' => [
                    'Step 1: Pursue a degree in Agriculture and a Master\'s in Agronomy or Weed Science.',
                    'Step 2: Gain research experience in weed management and field trials.',
                    'Step 3: Stay updated on herbicide technologies and alternative control methods.',
                    'Step 4: Work with agrochemical firms or research institutes.',
                    'Step 5: Provide advisory services to large farms and government bodies.'
                ],
                'future_scope' => 'Essential for optimizing crop yields and reducing production costs.',
                'job_opportunities' => ['Research Institutes', 'Agrochemical Firms', 'Universities', 'Agriculture Departments'],
                'image' => 'images/careers/agriculture-food-environment/weed-scientist.svg',
                'sub_domain' => 'Plant Protection & Crop Science'
            ],
            [
                'slug' => 'agroforestry-specialist',
                'name' => 'Agroforestry Specialist',
                'field_id' => $field->id,
                'description' => 'Agroforestry Specialists combine trees, crops, and livestock systems to improve farm income, biodiversity, soil health, and climate resilience.',
                'salary_range' => '₹4L – ₹14L',
                'demand_level' => 'Growing',
                'qualification' => 'Agriculture / Forestry / Environmental Science degree',
                'stream' => 'Science / Agriculture',
                'skills' => ['Tree-Crop Systems', 'Sustainability', 'Soil Conservation', 'Biodiversity', 'Field Planning'],
                'entrance_exams' => ['ICAR', 'Forestry Entrance Exams', 'University Entrance Exams'],
                'roadmap' => [
                    'Step 1: Obtain a degree in Agriculture, Forestry, or Environmental Science.',
                    'Step 2: Learn about tree-crop interactions and sustainable land management.',
                    'Step 3: Gain field experience in designing agroforestry systems.',
                    'Step 4: Work with forestry departments or NGOs on climate projects.',
                    'Step 5: Consult with farmers to integrate trees into their farming systems.'
                ],
                'future_scope' => 'Vital for climate change mitigation and improving rural livelihoods.',
                'job_opportunities' => ['Forestry Departments', 'NGOs', 'Climate Projects', 'Research Institutes', 'Agri Consultancies'],
                'image' => 'images/careers/agriculture-food-environment/agroforestry-specialist.svg',
                'sub_domain' => 'Sustainable & Organic Farming'
            ],
            [
                'slug' => 'nursery-manager',
                'name' => 'Nursery Manager',
                'field_id' => $field->id,
                'description' => 'Nursery Managers grow and sell plants, saplings, ornamental plants, fruit plants, seedlings, and manage nursery operations.',
                'salary_range' => '₹2.5L – ₹10L',
                'demand_level' => 'Growing',
                'qualification' => 'Horticulture training / B.Sc Horticulture preferred',
                'stream' => 'Science / Agriculture / Any Stream',
                'skills' => ['Plant Propagation', 'Nursery Operations', 'Customer Handling', 'Pest Control', 'Business Management'],
                'entrance_exams' => ['Horticulture/Agriculture Entrance Exams'],
                'roadmap' => [
                    'Step 1: Obtain training in horticulture or a related agriculture degree.',
                    'Step 2: Gain practical knowledge in plant propagation techniques.',
                    'Step 3: Learn about nursery management and business operations.',
                    'Step 4: Work with established nurseries or landscaping firms.',
                    'Step 5: Start your own plant nursery or seedling business.'
                ],
                'future_scope' => 'High demand for plants in urban gardening and commercial horticulture.',
                'job_opportunities' => ['Plant Nurseries', 'Landscaping Firms', 'Horticulture Departments', 'Self-Employment'],
                'image' => 'images/careers/agriculture-food-environment/nursery-manager.svg',
                'sub_domain' => 'Horticulture, Floriculture & Landscaping'
            ],
            [
                'slug' => 'landscape-horticulturist',
                'name' => 'Landscape Horticulturist',
                'field_id' => $field->id,
                'description' => 'Landscape Horticulturists design and maintain gardens, parks, resorts, campuses, green spaces, and urban landscapes.',
                'salary_range' => '₹3L – ₹12L',
                'demand_level' => 'Growing',
                'qualification' => 'B.Sc Horticulture / Landscape Design / Agriculture background',
                'stream' => 'Science / Agriculture / Design',
                'skills' => ['Landscape Design', 'Plant Selection', 'Soil Knowledge', 'Creativity', 'Project Management'],
                'entrance_exams' => ['ICAR', 'CUET UG', 'University Entrance Exams'],
                'roadmap' => [
                    'Step 1: Pursue a degree in Horticulture or Landscape Design.',
                    'Step 2: Develop a strong sense of plant selection and design aesthetics.',
                    'Step 3: Gain experience in urban landscaping and green space maintenance.',
                    'Step 4: Work with landscaping companies or real estate projects.',
                    'Step 5: Build a portfolio of successful landscape designs.'
                ],
                'future_scope' => 'Rising trend of urban beautification and demand for professional landscaping.',
                'job_opportunities' => ['Landscaping Companies', 'Resorts', 'Municipal Bodies', 'Real Estate Projects', 'Self-Employment'],
                'image' => 'images/careers/agriculture-food-environment/landscape-horticulturist.svg',
                'sub_domain' => 'Horticulture, Floriculture & Landscaping'
            ]
        ];

        $futureScopeCommon = "Agriculture, Food & Environment careers have strong future scope because India needs food security, sustainable farming, agri-tech, water conservation, value-added food processing, organic farming, climate-resilient agriculture, and rural entrepreneurship.";

        foreach ($careers as $careerData) {
            $careerData['future_scope'] = $careerData['future_scope'] . "\n\n" . $futureScopeCommon;
            Career::updateOrCreate(['slug' => $careerData['slug']], $careerData);
        }
    }
}
