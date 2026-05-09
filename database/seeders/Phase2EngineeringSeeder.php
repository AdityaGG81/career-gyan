<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class Phase2EngineeringSeeder extends Seeder
{
    public function run(): void
    {
        $fieldsData = [
            'electrical-engineering' => [
                'prefix' => 'Electrical',
                'img' => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?auto=format&fit=crop&w=800&q=80',
                'icon' => 'fa-bolt',
                'titles' => [
                    'Power Systems Engineer', 'Control Systems Engineer', 'Electrical Design Engineer',
                    'Instrumentation Engineer', 'Renewable Energy Engineer', 'Substation Engineer',
                    'Microelectronics Engineer', 'Signal Processing Engineer', 'Telecommunications Engineer',
                    'Hardware Engineer', 'Automation Engineer', 'Lighting Design Engineer',
                    'Motor Design Engineer', 'Grid Integration Engineer', 'High Voltage Engineer',
                    'Smart Grid Specialist', 'SCADA Engineer', 'Protection Engineer',
                    'Electrical Maintenance Engineer', 'Traction Engineer', 'Avionics Engineer',
                    'RF Engineer', 'Optoelectronics Engineer', 'Energy Auditor',
                    'Battery Management Engineer', 'Electrical R&D Scientist', 'Testing & Commissioning Engineer',
                    'Naval Electrical Engineer', 'Acoustics Engineer', 'PCB Design Engineer'
                ]
            ],
            'mechanical-engineering' => [
                'prefix' => 'Mechanical',
                'img' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80',
                'icon' => 'fa-cogs',
                'titles' => [
                    'Mechanical Design Engineer', 'HVAC Engineer', 'Manufacturing Engineer',
                    'Thermodynamics Engineer', 'Fluid Mechanics Engineer', 'Robotics Hardware Engineer',
                    'Mechatronics Engineer', 'Automotive Design Engineer', 'Aerodynamics Engineer',
                    'Materials Engineer', 'Quality Control Engineer', 'CAD/CAM Engineer',
                    'Maintenance Engineer', 'Piping Engineer', 'Acoustical Engineer',
                    'Biomedical Mechanical Engineer', 'Nuclear Engineer', 'Systems Engineer',
                    'Kinematics Expert', 'Energy Systems Engineer', 'Tribologist',
                    'FEA Analyst', 'Reliability Engineer', 'Tooling Engineer',
                    'Plant Engineer', 'Marine Mechanical Engineer', 'Project Engineer (Mechanical)',
                    'R&D Mechanical Engineer', 'Sales Engineer (Technical)', 'Packaging Engineer'
                ]
            ],
            'civil-engineering' => [
                'prefix' => 'Civil',
                'img' => 'https://images.unsplash.com/photo-1541888086925-920a0b22a0ce?auto=format&fit=crop&w=800&q=80',
                'icon' => 'fa-helmet-safety',
                'titles' => [
                    'Structural Engineer', 'Geotechnical Engineer', 'Transportation Engineer',
                    'Environmental Engineer', 'Water Resources Engineer', 'Construction Manager',
                    'Urban Planner', 'Surveyor', 'Highway Engineer',
                    'Bridge Engineer', 'Materials Engineer (Civil)', 'Coastal Engineer',
                    'Earthquake Engineer', 'Tunnel Engineer', 'Railroad Engineer',
                    'Municipal Engineer', 'Public Health Engineer', 'Site Engineer',
                    'Estimation Engineer', 'Quantity Surveyor', 'BIM Modeler',
                    'Fire Protection Engineer', 'Town Planner', 'Hydraulic Engineer',
                    'Pavement Engineer', 'Traffic Engineer', 'Foundation Engineer',
                    'Airport Design Engineer', 'Smart City Planner', 'Civil R&D Engineer'
                ]
            ],
            'chemical-engineering' => [
                'prefix' => 'Chemical',
                'img' => 'https://images.unsplash.com/photo-1581093588401-fbb62a02f120?auto=format&fit=crop&w=800&q=80',
                'icon' => 'fa-flask',
                'titles' => [
                    'Process Engineer', 'Biochemical Engineer', 'Petrochemical Engineer',
                    'Materials Scientist', 'Polymer Engineer', 'Environmental Chemical Engineer',
                    'Food & Flavor Chemist', 'Pharmaceutical Engineer', 'Safety Engineer',
                    'Plant Process Manager', 'Reaction Engineer', 'Thermodynamics Specialist',
                    'Catalysis Engineer', 'Electrochemical Engineer', 'Paper & Pulp Engineer',
                    'Textile Chemical Engineer', 'Water Treatment Engineer', 'Energy Engineer',
                    'Nanotechnologist', 'Corrosion Engineer', 'Quality Assurance Engineer',
                    'Plastics Engineer', 'Metallurgical Engineer', 'Oil & Gas Engineer',
                    'Cosmetic Formulation Scientist', 'Explosives Engineer', 'Fertilizer Plant Engineer',
                    'R&D Chemical Engineer', 'Production Chemical Engineer', 'Process Simulation Engineer'
                ]
            ],
            'automobile-engineering' => [
                'prefix' => 'Automobile',
                'img' => 'https://images.unsplash.com/photo-1503376713835-1f81d1136bdf?auto=format&fit=crop&w=800&q=80',
                'icon' => 'fa-car',
                'titles' => [
                    'Vehicle Design Engineer', 'Powertrain Engineer', 'NVH (Noise, Vibration, Harshness) Engineer',
                    'Chassis Engineer', 'Electric Vehicle (EV) Engineer', 'Battery Systems Engineer',
                    'Autonomous Driving Engineer', 'Automotive Aerodynamics Engineer', 'Vehicle Dynamics Engineer',
                    'Safety Systems Engineer', 'Crash Test Engineer', 'Engine Calibration Engineer',
                    'Automotive Electronics Engineer', 'Telematics Engineer', 'Manufacturing Engineer (Auto)',
                    'Two-Wheeler Design Engineer', 'Commercial Vehicle Engineer', 'Motorsport Engineer',
                    'Homologation Engineer', 'Automotive Software Engineer', 'Connected Car Specialist',
                    'Brake Systems Engineer', 'Suspension Engineer', 'Automotive UI/UX Designer',
                    'Automotive Materials Engineer', 'Quality Control Engineer (Auto)', 'Supply Chain Engineer (Auto)',
                    'Automotive Service Engineer', 'Dealership Operations Manager', 'R&D Automotive Engineer'
                ]
            ],
        ];

        foreach ($fieldsData as $slug => $data) {
            $field = Field::where('slug', $slug)->first();
            if (!$field) continue;

            foreach ($data['titles'] as $title) {
                Career::updateOrCreate(
                    ['slug' => Str::slug($title)],
                    [
                        'name'           => $title,
                        'field_id'       => $field->id,
                        'description'    => $title . ' is a specialized role within ' . $data['prefix'] . ' Engineering focusing on innovation, design, and practical application.',
                        'qualification'  => 'B.E / B.Tech in ' . $data['prefix'] . ' Engineering',
                        'stream'         => 'Science (PCM)',
                        'salary_range'   => '₹5L – ₹20L',
                        'demand_level'   => 'High',
                        'icon'           => $data['icon'],
                        'image'          => $data['img'],
                        'roadmap'        => [
                            'Complete 10+2 with Physics, Chemistry, and Mathematics',
                            'Clear engineering entrance exams like JEE or State CET',
                            'Enroll in a B.E/B.Tech program in ' . $data['prefix'] . ' Engineering',
                            'Undertake relevant software training (e.g. AutoCAD, MATLAB, SolidWorks)',
                            'Complete industrial internships in the core sector',
                            'Apply for entry-level roles or pursue M.Tech for specialization'
                        ],
                        'skills'         => ['Technical Design', 'Analytical Thinking', 'Problem Solving', 'Project Management', 'Software Proficiency'],
                        'future_scope'   => 'As technology advances, core engineering fields are integrating with AI, automation, and sustainable practices, ensuring strong future growth.',
                        'entrance_exams' => ['JEE Main', 'JEE Advanced', 'GATE', 'State Level CETs'],
                        'job_opportunities' => ['Core Engineering Firms', 'MNCs', 'Government PSUs', 'Startups', 'Research Labs'],
                        'related_careers' => ['Project Manager', 'Systems Analyst', 'Research Scientist'],
                    ]
                );
            }
        }
    }
}
