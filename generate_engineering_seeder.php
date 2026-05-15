<?php

$code = <<<'EOD'
<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EngineeringIndustrialCareerSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'technology-engineering')->first();
        if (!$field) return;

        $careers = [
            [
                'title' => 'Mechatronics Engineer',
                'domain' => 'Automation & Robotics',
                'short_info' => 'Mechatronics Engineers combine mechanical, electronics, computer, and control systems to build automated machines and smart industrial systems.',
                'salary' => '₹4L – ₹14L',
                'demand' => 'High',
                'qualification' => 'B.Tech / B.E. in Mechatronics, Mechanical, Electronics, Robotics, or related field',
                'stream' => 'Science PCM / Engineering',
                'exams' => ['JEE Main', 'MHT CET', 'State CET', 'GATE for higher studies'],
                'skills' => ['Robotics', 'Automation', 'Sensors', 'Control Systems', 'CAD', 'Programming'],
                'employers' => ['Automation Companies', 'Robotics Firms', 'Manufacturing Plants', 'Automotive Industry'],
                'image' => 'mechatronics-engineer.svg'
            ],
            [
                'title' => 'Renewable Energy Engineer',
                'domain' => 'Renewable Energy & Sustainability',
                'short_info' => 'Renewable Energy Engineers design and manage clean energy systems such as solar, wind, biomass, and hybrid power projects.',
                'salary' => '₹4L – ₹15L',
                'demand' => 'Very High',
                'qualification' => 'B.Tech / B.E. in Electrical, Mechanical, Energy Engineering, or Renewable Energy',
                'stream' => 'Science PCM / Engineering',
                'exams' => ['JEE Main', 'State CET', 'GATE'],
                'skills' => ['Energy Systems', 'Sustainability', 'Project Design', 'Electrical Basics', 'Data Analysis'],
                'employers' => ['Solar Companies', 'Wind Energy Firms', 'Power Plants', 'Energy Consultancies'],
                'image' => 'renewable-energy-engineer.svg'
            ],
            [
                'title' => 'Solar Energy Engineer',
                'domain' => 'Renewable Energy & Sustainability',
                'short_info' => 'Solar Energy Engineers design, install, test, and maintain solar power systems for homes, industries, and large solar farms.',
                'salary' => '₹3.5L – ₹12L',
                'demand' => 'Very High',
                'qualification' => 'Diploma / B.Tech in Electrical, Mechanical, Energy, or Solar Technology',
                'stream' => 'Science PCM / Engineering / Diploma',
                'exams' => ['JEE Main', 'State CET', 'Polytechnic Entrance', 'GATE for higher studies'],
                'skills' => ['Solar PV Design', 'Electrical Wiring', 'Site Survey', 'AutoCAD', 'Project Execution'],
                'employers' => ['Solar EPC Companies', 'Renewable Energy Firms', 'Government Solar Projects', 'Startups'],
                'image' => 'solar-energy-engineer.svg'
            ],
            [
                'title' => 'Wind Energy Engineer',
                'domain' => 'Renewable Energy & Sustainability',
                'short_info' => 'Wind Energy Engineers work on wind turbines, wind farm planning, energy generation, and turbine maintenance systems.',
                'salary' => '₹4L – ₹14L',
                'demand' => 'High',
                'qualification' => 'B.Tech / B.E. in Mechanical, Electrical, Energy, or Renewable Energy',
                'stream' => 'Science PCM / Engineering',
                'exams' => ['JEE Main', 'State CET', 'GATE'],
                'skills' => ['Turbine Systems', 'Fluid Mechanics', 'Electrical Systems', 'Maintenance', 'Safety'],
                'employers' => ['Wind Energy Companies', 'Power Sector', 'Renewable Energy Consultancies'],
                'image' => 'wind-energy-engineer.svg'
            ],
            [
                'title' => 'Energy Auditor',
                'domain' => 'Renewable Energy & Sustainability',
                'short_info' => 'Energy Auditors inspect buildings, industries, and equipment to reduce energy waste and improve energy efficiency.',
                'salary' => '₹4L – ₹13L',
                'demand' => 'Growing',
                'qualification' => 'Engineering degree preferred; energy audit certification useful',
                'stream' => 'Science PCM / Engineering',
                'exams' => ['BEE Energy Auditor Certification', 'GATE optional'],
                'skills' => ['Energy Efficiency', 'Audit Reports', 'Electrical Systems', 'Measurement Tools', 'Sustainability'],
                'employers' => ['Energy Consultancies', 'Industries', 'Government Projects', 'Green Building Firms'],
                'image' => 'energy-auditor.svg'
            ],
            [
                'title' => 'HVAC Engineer',
                'domain' => 'Mechanical, HVAC & Maintenance',
                'short_info' => 'HVAC Engineers design and maintain heating, ventilation, and air-conditioning systems for buildings, hospitals, malls, and industries.',
                'salary' => '₹3.5L – ₹12L',
                'demand' => 'High',
                'qualification' => 'Diploma / B.Tech in Mechanical Engineering or HVAC Technology',
                'stream' => 'Science PCM / Diploma / Engineering',
                'exams' => ['Polytechnic Entrance', 'JEE Main', 'State CET'],
                'skills' => ['HVAC Design', 'Thermodynamics', 'AutoCAD', 'Load Calculation', 'Maintenance'],
                'employers' => ['Construction Companies', 'MEP Firms', 'Hospitals', 'Hotels', 'Industrial Plants'],
                'image' => 'hvac-engineer.svg'
            ],
            [
                'title' => 'Piping Engineer',
                'domain' => 'Mechanical, HVAC & Maintenance',
                'short_info' => 'Piping Engineers design pipeline layouts and piping systems for oil, gas, chemical, power, and industrial plants.',
                'salary' => '₹4L – ₹15L',
                'demand' => 'High',
                'qualification' => 'B.Tech / B.E. in Mechanical, Chemical, or related engineering',
                'stream' => 'Science PCM / Engineering',
                'exams' => ['JEE Main', 'State CET', 'GATE'],
                'skills' => ['Piping Design', 'AutoCAD', 'Plant Layout', 'Fluid Mechanics', 'Safety Standards'],
                'employers' => ['Oil & Gas', 'Chemical Plants', 'EPC Companies', 'Power Plants'],
                'image' => 'piping-engineer.svg'
            ],
            [
                'title' => 'Structural Design Engineer',
                'domain' => 'Civil Infrastructure & Urban Development',
                'short_info' => 'Structural Design Engineers design safe structures such as buildings, bridges, towers, industrial plants, and public infrastructure.',
                'salary' => '₹4L – ₹16L',
                'demand' => 'High',
                'qualification' => 'B.Tech / B.E. Civil Engineering; M.Tech Structural Engineering preferred',
                'stream' => 'Science PCM / Civil Engineering',
                'exams' => ['JEE Main', 'State CET', 'GATE'],
                'skills' => ['Structural Analysis', 'RCC Design', 'Steel Design', 'STAAD Pro', 'ETABS', 'AutoCAD'],
                'employers' => ['Construction Firms', 'Infrastructure Companies', 'Design Consultancies', 'Government Projects'],
                'image' => 'structural-design-engineer.svg'
            ],
            [
                'title' => 'Geotechnical Engineer',
                'domain' => 'Civil Infrastructure & Urban Development',
                'short_info' => 'Geotechnical Engineers study soil, rocks, and foundations to support safe construction of buildings, roads, bridges, and dams.',
                'salary' => '₹4L – ₹14L',
                'demand' => 'High',
                'qualification' => 'B.Tech Civil Engineering; M.Tech Geotechnical Engineering preferred',
                'stream' => 'Science PCM / Civil Engineering',
                'exams' => ['JEE Main', 'State CET', 'GATE'],
                'skills' => ['Soil Testing', 'Foundation Design', 'Site Investigation', 'Geology', 'Report Writing'],
                'employers' => ['Construction Firms', 'Infrastructure Companies', 'Soil Testing Labs', 'Government Projects'],
                'image' => 'geotechnical-engineer.svg'
            ],
            [
                'title' => 'Transportation Engineer',
                'domain' => 'Civil Infrastructure & Urban Development',
                'short_info' => 'Transportation Engineers plan roads, traffic systems, public transport networks, highways, and smart mobility infrastructure.',
                'salary' => '₹4L – ₹15L',
                'demand' => 'High',
                'qualification' => 'B.Tech Civil Engineering; M.Tech Transportation Engineering preferred',
                'stream' => 'Science PCM / Civil Engineering',
                'exams' => ['JEE Main', 'State CET', 'GATE'],
                'skills' => ['Traffic Planning', 'Road Design', 'Surveying', 'Transport Modelling', 'GIS'],
                'employers' => ['Highway Authorities', 'Urban Planning Firms', 'Metro Projects', 'Infrastructure Companies'],
                'image' => 'transportation-engineer.svg'
            ],
            [
                'title' => 'Highway Engineer',
                'domain' => 'Civil Infrastructure & Urban Development',
                'short_info' => 'Highway Engineers design, construct, and maintain roads, highways, expressways, and pavement systems.',
                'salary' => '₹4L – ₹15L',
                'demand' => 'High',
                'qualification' => 'B.Tech / B.E. Civil Engineering',
                'stream' => 'Science PCM / Civil Engineering',
                'exams' => ['JEE Main', 'State CET', 'GATE'],
                'skills' => ['Road Design', 'Pavement Engineering', 'Surveying', 'AutoCAD', 'Project Supervision'],
                'employers' => ['NHAI Contractors', 'Road Construction Companies', 'PWD', 'Infrastructure Firms'],
                'image' => 'highway-engineer.svg'
            ],
            [
                'title' => 'Bridge Engineer',
                'domain' => 'Civil Infrastructure & Urban Development',
                'short_info' => 'Bridge Engineers design and supervise the construction and maintenance of bridges, flyovers, and elevated structures.',
                'salary' => '₹5L – ₹18L',
                'demand' => 'High',
                'qualification' => 'B.Tech Civil Engineering; M.Tech Structural/Bridge Engineering preferred',
                'stream' => 'Science PCM / Civil Engineering',
                'exams' => ['JEE Main', 'State CET', 'GATE'],
                'skills' => ['Structural Design', 'Bridge Codes', 'RCC', 'Steel Structures', 'Site Supervision'],
                'employers' => ['Infrastructure Companies', 'Government Road Projects', 'Railways', 'Metro Projects'],
                'image' => 'bridge-engineer.svg'
            ],
            [
                'title' => 'Urban Infrastructure Engineer',
                'domain' => 'Civil Infrastructure & Urban Development',
                'short_info' => 'Urban Infrastructure Engineers plan and manage civic infrastructure such as roads, water supply, drainage, transport, and smart city systems.',
                'salary' => '₹4L – ₹16L',
                'demand' => 'Growing',
                'qualification' => 'B.Tech Civil / Urban Infrastructure / Environmental Engineering',
                'stream' => 'Science PCM / Engineering',
                'exams' => ['JEE Main', 'State CET', 'GATE'],
                'skills' => ['Urban Planning', 'Infrastructure Design', 'GIS', 'Project Management', 'Sustainability'],
                'employers' => ['Smart City Projects', 'Municipal Corporations', 'Infrastructure Firms', 'Consulting Companies'],
                'image' => 'urban-infrastructure-engineer.svg'
            ],
            [
                'title' => 'Fire Protection Engineer',
                'domain' => 'Safety, Fire & Quality',
                'short_info' => 'Fire Protection Engineers design fire safety systems, alarms, sprinklers, emergency exits, and safety plans for buildings and industries.',
                'salary' => '₹4L – ₹14L',
                'demand' => 'High',
                'qualification' => 'Fire Engineering / Mechanical / Civil / Safety Engineering',
                'stream' => 'Science PCM / Engineering',
                'exams' => ['JEE Main', 'State CET', 'Fire Engineering entrance where applicable'],
                'skills' => ['Fire Safety Design', 'Risk Assessment', 'Building Codes', 'Emergency Planning', 'Inspection'],
                'employers' => ['Construction Firms', 'MEP Companies', 'Industries', 'Airports', 'Hospitals'],
                'image' => 'fire-protection-engineer.svg'
            ],
            [
                'title' => 'Safety Engineer',
                'domain' => 'Safety, Fire & Quality',
                'short_info' => 'Safety Engineers identify workplace hazards, design safety procedures, conduct audits, and reduce accidents in industrial environments.',
                'salary' => '₹4L – ₹14L',
                'demand' => 'Very High',
                'qualification' => 'B.Tech / Diploma with Industrial Safety certification',
                'stream' => 'Science PCM / Engineering / Diploma',
                'exams' => ['State CET', 'JEE Main', 'Industrial Safety Certifications'],
                'skills' => ['Risk Assessment', 'Safety Audits', 'HSE Rules', 'Training', 'Incident Investigation'],
                'employers' => ['Manufacturing', 'Oil & Gas', 'Construction', 'Chemical Plants', 'Power Plants'],
                'image' => 'safety-engineer.svg'
            ],
            [
                'title' => 'Quality Control Engineer',
                'domain' => 'Safety, Fire & Quality',
                'short_info' => 'Quality Control Engineers inspect products, test materials, verify standards, and ensure manufacturing output meets required quality.',
                'salary' => '₹3.5L – ₹12L',
                'demand' => 'High',
                'qualification' => 'Diploma / B.Tech in Mechanical, Production, Industrial, Electrical, or related field',
                'stream' => 'Science PCM / Engineering / Diploma',
                'exams' => ['Polytechnic Entrance', 'JEE Main', 'State CET'],
                'skills' => ['Quality Testing', 'Inspection', 'ISO Standards', 'Problem Solving', 'Documentation'],
                'employers' => ['Manufacturing Plants', 'Automotive', 'Electronics', 'Pharma', 'FMCG'],
                'image' => 'quality-control-engineer.svg'
            ],
            [
                'title' => 'Maintenance Engineer',
                'domain' => 'Mechanical, HVAC & Maintenance',
                'short_info' => 'Maintenance Engineers keep machines, equipment, electrical systems, and production lines running smoothly with minimum downtime.',
                'salary' => '₹3.5L – ₹12L',
                'demand' => 'High',
                'qualification' => 'Diploma / B.Tech in Mechanical, Electrical, Electronics, or Industrial Engineering',
                'stream' => 'Science PCM / Engineering / Diploma',
                'exams' => ['Polytechnic Entrance', 'JEE Main', 'State CET'],
                'skills' => ['Troubleshooting', 'Preventive Maintenance', 'Machine Systems', 'Electrical Basics', 'Safety'],
                'employers' => ['Manufacturing', 'Power Plants', 'Automotive', 'Steel', 'Cement', 'Pharma'],
                'image' => 'maintenance-engineer.svg'
            ],
            [
                'title' => 'Production Engineer',
                'domain' => 'Manufacturing & Production',
                'short_info' => 'Production Engineers manage production processes, improve output, reduce waste, and ensure efficient manufacturing operations.',
                'salary' => '₹3.5L – ₹13L',
                'demand' => 'High',
                'qualification' => 'B.Tech / B.E. in Production, Mechanical, Industrial, or Manufacturing Engineering',
                'stream' => 'Science PCM / Engineering',
                'exams' => ['JEE Main', 'State CET', 'GATE'],
                'skills' => ['Production Planning', 'Lean Manufacturing', 'Quality Control', 'Process Improvement', 'Teamwork'],
                'employers' => ['Manufacturing Plants', 'Automobile', 'FMCG', 'Pharma', 'Electronics'],
                'image' => 'production-engineer.svg'
            ],
            [
                'title' => 'Manufacturing Process Engineer',
                'domain' => 'Manufacturing & Production',
                'short_info' => 'Manufacturing Process Engineers design and improve production methods, tools, layouts, and workflows to increase efficiency.',
                'salary' => '₹4L – ₹15L',
                'demand' => 'High',
                'qualification' => 'B.Tech / B.E. in Mechanical, Production, Industrial, or Manufacturing Engineering',
                'stream' => 'Science PCM / Engineering',
                'exams' => ['JEE Main', 'State CET', 'GATE'],
                'skills' => ['Process Design', 'Lean Manufacturing', 'CAD/CAM', 'Automation', 'Data Analysis'],
                'employers' => ['Automotive', 'Electronics', 'Industrial Manufacturing', 'Aerospace', 'Consumer Goods'],
                'image' => 'manufacturing-process-engineer.svg'
            ],
            [
                'title' => 'Packaging Engineer',
                'domain' => 'Materials, Polymer & Packaging',
                'short_info' => 'Packaging Engineers design safe, attractive, sustainable, and cost-effective packaging for food, pharma, e-commerce, and consumer goods.',
                'salary' => '₹3.5L – ₹12L',
                'demand' => 'Growing',
                'qualification' => 'B.Tech / Diploma in Packaging, Mechanical, Polymer, or Food Technology',
                'stream' => 'Science / Engineering / Diploma',
                'exams' => ['JEE Main', 'State CET', 'Packaging Institute entrance if applicable'],
                'skills' => ['Packaging Design', 'Materials', 'Sustainability', 'Testing', 'Cost Optimization'],
                'employers' => ['FMCG', 'E-commerce', 'Pharma', 'Food Processing', 'Packaging Companies'],
                'image' => 'packaging-engineer.svg'
            ],
            [
                'title' => 'Ceramic Engineer',
                'domain' => 'Materials, Polymer & Packaging',
                'short_info' => 'Ceramic Engineers develop ceramic materials used in tiles, glass, electronics, medical devices, refractories, and industrial products.',
                'salary' => '₹4L – ₹13L',
                'demand' => 'Stable',
                'qualification' => 'B.Tech / B.E. in Ceramic Engineering or Materials Engineering',
                'stream' => 'Science PCM / Engineering',
                'exams' => ['JEE Main', 'State CET', 'GATE'],
                'skills' => ['Materials Science', 'Heat Treatment', 'Testing', 'Manufacturing', 'Quality Control'],
                'employers' => ['Ceramic Industry', 'Glass Industry', 'Electronics', 'Refractory Plants', 'Research Labs'],
                'image' => 'ceramic-engineer.svg'
            ],
            [
                'title' => 'Polymer Engineer',
                'domain' => 'Materials, Polymer & Packaging',
                'short_info' => 'Polymer Engineers develop and test plastic, rubber, resin, and composite materials for industrial and consumer applications.',
                'salary' => '₹4L – ₹14L',
                'demand' => 'High',
                'qualification' => 'B.Tech / B.E. in Polymer, Chemical, Plastic, or Materials Engineering',
                'stream' => 'Science PCM / Engineering',
                'exams' => ['JEE Main', 'State CET', 'GATE'],
                'skills' => ['Polymer Science', 'Materials Testing', 'Product Development', 'Manufacturing', 'Sustainability'],
                'employers' => ['Plastics', 'Automotive', 'Packaging', 'Medical Devices', 'Chemical Companies'],
                'image' => 'polymer-engineer.svg'
            ],
            [
                'title' => 'Plastics Engineer',
                'domain' => 'Materials, Polymer & Packaging',
                'short_info' => 'Plastics Engineers design plastic products, moulds, production processes, and material solutions for industries.',
                'salary' => '₹3.5L – ₹12L',
                'demand' => 'Stable',
                'qualification' => 'Diploma / B.Tech in Plastic, Polymer, Mechanical, or Manufacturing Engineering',
                'stream' => 'Science PCM / Engineering / Diploma',
                'exams' => ['CIPET entrance', 'JEE Main', 'State CET'],
                'skills' => ['Plastic Processing', 'Mould Design', 'Injection Moulding', 'Materials', 'Quality Control'],
                'employers' => ['Plastics Manufacturing', 'Automotive', 'Consumer Goods', 'Packaging', 'Medical Products'],
                'image' => 'plastics-engineer.svg'
            ],
            [
                'title' => 'Rubber Technologist',
                'domain' => 'Materials, Polymer & Packaging',
                'short_info' => 'Rubber Technologists develop and test rubber products used in tyres, automotive parts, footwear, industrial seals, and medical goods.',
                'salary' => '₹3.5L – ₹12L',
                'demand' => 'Stable',
                'qualification' => 'Rubber Technology / Polymer / Chemical Engineering background',
                'stream' => 'Science PCM / Engineering / Diploma',
                'exams' => ['State CET', 'JEE Main', 'relevant institute entrance'],
                'skills' => ['Rubber Processing', 'Materials Testing', 'Compounding', 'Quality Control', 'Manufacturing'],
                'employers' => ['Tyre Companies', 'Automotive Industry', 'Footwear', 'Industrial Rubber Products'],
                'image' => 'rubber-technologist.svg'
            ],
            [
                'title' => 'Welding Engineer',
                'domain' => 'Manufacturing & Production',
                'short_info' => 'Welding Engineers design and supervise welding processes for structures, pipelines, vehicles, machines, and industrial equipment.',
                'salary' => '₹4L – ₹14L',
                'demand' => 'High',
                'qualification' => 'Diploma / B.Tech in Mechanical, Metallurgy, Production, or Welding Technology',
                'stream' => 'Science PCM / Engineering / Diploma',
                'exams' => ['Polytechnic Entrance', 'JEE Main', 'State CET', 'welding certifications'],
                'skills' => ['Welding Processes', 'Metallurgy', 'Inspection', 'Safety', 'Quality Standards'],
                'employers' => ['Manufacturing', 'Oil & Gas', 'Shipbuilding', 'Construction', 'Automotive'],
                'image' => 'welding-engineer.svg'
            ],
            [
                'title' => 'NDT Technician',
                'domain' => 'Inspection & Industrial Testing',
                'short_info' => 'NDT Technicians inspect materials and structures without damaging them using methods like ultrasonic, radiographic, magnetic, and dye testing.',
                'salary' => '₹3L – ₹10L',
                'demand' => 'High',
                'qualification' => 'ITI / Diploma / Engineering with NDT certification',
                'stream' => 'Technical / Diploma / Engineering',
                'exams' => ['ASNT/ISNT NDT certifications', 'technical training'],
                'skills' => ['Ultrasonic Testing', 'Radiography', 'Inspection', 'Safety', 'Report Writing'],
                'employers' => ['Oil & Gas', 'Aerospace', 'Railways', 'Manufacturing', 'Power Plants'],
                'image' => 'ndt-technician.svg'
            ],
            [
                'title' => 'Aerospace Maintenance Engineer',
                'domain' => 'Aerospace, Avionics & Drone Technology',
                'short_info' => 'Aerospace Maintenance Engineers inspect, maintain, and repair aircraft systems to ensure safe aviation operations.',
                'salary' => '₹4L – ₹18L',
                'demand' => 'High',
                'qualification' => 'Aircraft Maintenance Engineering / Aerospace / Mechanical / Aeronautical background',
                'stream' => 'Science PCM / Engineering',
                'exams' => ['AME entrance exams', 'JEE Main', 'DGCA-related licensing pathway where applicable'],
                'skills' => ['Aircraft Systems', 'Maintenance', 'Safety Checks', 'Troubleshooting', 'Documentation'],
                'employers' => ['Airlines', 'MRO Companies', 'Airports', 'Aerospace Firms', 'Defence Aviation'],
                'image' => 'aerospace-maintenance-engineer.svg'
            ],
            [
                'title' => 'Avionics Engineer',
                'domain' => 'Aerospace, Avionics & Drone Technology',
                'short_info' => 'Avionics Engineers work on aircraft electronics such as navigation, radar, communication, flight control, and onboard computer systems.',
                'salary' => '₹5L – ₹18L',
                'demand' => 'High',
                'qualification' => 'B.Tech / B.E. in Electronics, Avionics, Aerospace, or related field',
                'stream' => 'Science PCM / Engineering',
                'exams' => ['JEE Main', 'State CET', 'GATE'],
                'skills' => ['Electronics', 'Embedded Systems', 'Communication Systems', 'Radar', 'Troubleshooting'],
                'employers' => ['Aerospace Companies', 'Airlines', 'Defence', 'Avionics Firms', 'Research Labs'],
                'image' => 'avionics-engineer.svg'
            ],
            [
                'title' => 'Drone Engineer',
                'domain' => 'Aerospace, Avionics & Drone Technology',
                'short_info' => 'Drone Engineers design, build, test, and maintain UAV systems used in agriculture, defence, surveying, logistics, and media.',
                'salary' => '₹4L – ₹15L',
                'demand' => 'Very High',
                'qualification' => 'Engineering in Electronics, Mechanical, Aerospace, Robotics, or Drone Technology',
                'stream' => 'Science PCM / Engineering',
                'exams' => ['JEE Main', 'State CET', 'Drone pilot/technology certifications'],
                'skills' => ['UAV Design', 'Sensors', 'Flight Control', 'Electronics', 'Programming', 'GIS'],
                'employers' => ['Drone Startups', 'Defence', 'Agriculture Tech', 'Surveying', 'Logistics', 'Media'],
                'image' => 'drone-engineer.svg'
            ],
            [
                'title' => 'Telecommunication Engineer',
                'domain' => 'Electronics & Telecommunication',
                'short_info' => 'Telecommunication Engineers design and maintain networks, mobile communication systems, optical fiber, broadband, and wireless technologies.',
                'salary' => '₹4L – ₹14L',
                'demand' => 'High',
                'qualification' => 'B.Tech / B.E. in Electronics & Telecommunication, Electronics, or Communication Engineering',
                'stream' => 'Science PCM / Engineering',
                'exams' => ['JEE Main', 'State CET', 'GATE'],
                'skills' => ['Networking', 'Wireless Communication', 'Fiber Optics', 'Signal Processing', 'Troubleshooting'],
                'employers' => ['Telecom Companies', 'ISPs', 'Network Vendors', 'Government Telecom Projects'],
                'image' => 'telecommunication-engineer.svg'
            ]
        ];

        foreach ($careers as $c) {
            $slug = Str::slug($c['title']);
            
            // Duplicate check
            $existing = Career::where('slug', $slug)->first();
            if ($existing) {
                echo "Skipping duplicate: " . $c['title'] . "\n";
                continue;
            }
            
            Career::create([
                'name' => $c['title'],
                'slug' => $slug,
                'field_id' => $field->id,
                'sub_domain' => $c['domain'],
                'description' => $c['short_info'],
                'salary_range' => $c['salary'],
                'demand_level' => $c['demand'],
                'qualification' => $c['qualification'],
                'stream' => $c['stream'],
                'skills' => $c['skills'],
                'entrance_exams' => $c['exams'],
                'image' => '/images/careers/engineering-industrial/' . $c['image'],
                'roadmap' => [
                    'Step 1: Complete 10+2 with Physics, Chemistry, and Mathematics',
                    'Step 2: Pursue Diploma / B.Tech / B.E. in the relevant engineering field',
                    'Step 3: Learn practical tools like AutoCAD, CAD/CAM, MATLAB, simulation tools, PLC/SCADA, or domain-specific software',
                    'Step 4: Complete internships, industrial training, workshops, and project work',
                    'Step 5: Build a technical portfolio with projects, certifications, and practical experience',
                    'Step 6: Grow into senior engineer, project engineer, plant manager, design engineer, consultant, or technical leadership roles'
                ],
                'future_scope' => 'The future scope for ' . $c['title'] . ' is excellent, given the rapid industrial automation, sustainable technologies, and infrastructure modernization globally.',
                'job_opportunities' => $c['employers'],
                'related_careers' => ['Engineer', 'Consultant', 'Project Manager'],
                'icon' => 'fa-microchip'
            ]);
        }
    }
}
EOD;

file_put_contents(__DIR__ . '/database/seeders/EngineeringIndustrialCareerSeeder.php', $code);

echo "EngineeringIndustrialCareerSeeder.php created successfully.\n";
