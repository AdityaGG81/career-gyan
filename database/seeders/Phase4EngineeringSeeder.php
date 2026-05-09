<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class Phase4EngineeringSeeder extends Seeder
{
    public function run(): void
    {
        $fieldsData = [
            'ai-data-science' => [
                'prefix' => 'AI',
                'img' => 'https://images.unsplash.com/photo-1555255707-c07966088b7b?auto=format&fit=crop&w=800&q=80',
                'icon' => 'fa-brain',
                'titles' => [
                    'Machine Learning Engineer', 'Deep Learning Specialist', 'NLP (Natural Language Processing) Engineer',
                    'Computer Vision Engineer', 'AI Research Scientist', 'AI Ethics Consultant',
                    'Autonomous Systems Engineer', 'Robotics Software Engineer', 'AI Architect',
                    'Predictive Modeler', 'Cognitive Computing Engineer', 'Speech Recognition Engineer',
                    'Generative AI Developer', 'AI Hardware Specialist', 'Expert Systems Developer',
                    'Reinforcement Learning Engineer', 'Prompt Engineer', 'AI Product Manager',
                    'AI Solutions Architect', 'Data Labeling Operations Manager', 'AI Operations (AIOps) Engineer',
                    'Recommendation Systems Engineer', 'Algorithm Engineer (AI)', 'Neuromorphic Engineer',
                    'AI Quality Assurance Tester', 'Bioinformatics AI Specialist', 'Quant (AI Finance)',
                    'Smart City AI Planner', 'AI Compliance Officer', 'AI Educator'
                ]
            ],
            'data-science' => [
                'prefix' => 'Data',
                'img' => 'https://images.unsplash.com/photo-1551288049-bbda38a594a0?auto=format&fit=crop&w=800&q=80',
                'icon' => 'fa-chart-pie',
                'titles' => [
                    'Data Scientist', 'Data Analyst', 'Data Engineer',
                    'Big Data Engineer', 'Business Intelligence (BI) Developer', 'Quantitative Analyst',
                    'Statistician', 'Data Architect', 'Data Storyteller',
                    'Marketing Data Analyst', 'Healthcare Data Analyst', 'Financial Data Analyst',
                    'Sports Analytics Specialist', 'Supply Chain Data Analyst', 'Data Privacy Officer',
                    'Master Data Management Specialist', 'Data Quality Analyst', 'Database Administrator (NoSQL)',
                    'ETL Developer', 'Data Warehouse Architect', 'Machine Learning Analyst',
                    'Fraud Analytics Specialist', 'Customer Insights Analyst', 'Geospatial Data Analyst',
                    'People/HR Analytics Specialist', 'Operations Research Analyst', 'Data Governance Specialist',
                    'Data Visualization Engineer', 'Data Strategy Consultant', 'Chief Data Officer'
                ]
            ],
            'robotics-engineering' => [
                'prefix' => 'Robotics',
                'img' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?auto=format&fit=crop&w=800&q=80',
                'icon' => 'fa-robot',
                'titles' => [
                    'Robotics Engineer', 'Automation Engineer', 'Mechatronics Engineer',
                    'UAV/Drone Engineer', 'Industrial Robotics Programmer', 'Robotics Systems Architect',
                    'Control Systems Engineer (Robotics)', 'Human-Robot Interaction (HRI) Specialist', 'Surgical Robotics Engineer',
                    'Swarm Robotics Researcher', 'Robotics Maintenance Technician', 'Robotic Process Automation (RPA) Dev',
                    'Vision Systems Engineer', 'Actuator Design Engineer', 'Kinematics and Dynamics Specialist',
                    'Mobile Robotics Engineer', 'Underwater Robotics Specialist', 'Space Robotics Engineer',
                    'Robotics UI/UX Designer', 'Machine Vision Specialist', 'Biorobotics Specialist',
                    'Prosthetics Engineer', 'Robotics Safety Standard Inspector', 'Robotics Simulation Engineer',
                    'Soft Robotics Researcher', 'Robotics Integration Engineer', 'Automation Consultant',
                    'Factory Automation Manager', 'AGV (Automated Guided Vehicle) Systems Engineer', 'Robotics Project Manager'
                ]
            ],
            'aerospace-engineering' => [
                'prefix' => 'Aerospace',
                'img' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=800&q=80',
                'icon' => 'fa-plane-up',
                'titles' => [
                    'Aerospace Engineer', 'Aeronautical Engineer', 'Astronautical Engineer',
                    'Avionics Engineer', 'Flight Test Engineer', 'Aerodynamics Specialist',
                    'Propulsion Systems Engineer', 'Spacecraft Design Engineer', 'Satellite Communications Engineer',
                    'Structural Design Engineer (Aerospace)', 'Aircraft Maintenance Engineer', 'Flight Dynamics Engineer',
                    'UAV Systems Engineer', 'Missile Systems Engineer', 'Orbital Mechanics Specialist',
                    'Aerospace Materials Specialist', 'Payload Systems Engineer', 'Thermal Control Engineer',
                    'Aircraft Certification Specialist', 'Radar Systems Engineer', 'Hypersonic Flight Researcher',
                    'Space Systems Operator', 'Aerospace Manufacturing Engineer', 'Cockpit Design Engineer',
                    'Navigation Systems Engineer', 'Aeroelasticity Specialist', 'Commercial Pilot (Tech background)',
                    'Astronaut / Mission Specialist', 'Space Policy Analyst', 'Aerospace Project Manager'
                ]
            ],
            'electronics-telecommunication' => [
                'prefix' => 'E&TC',
                'img' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80',
                'icon' => 'fa-satellite-dish',
                'titles' => [
                    'Telecommunications Engineer', 'RF (Radio Frequency) Engineer', 'Embedded Systems Engineer',
                    'VLSI Design Engineer', 'Network Support Engineer', 'Broadcast Engineer',
                    'Optical Networks Engineer', 'IoT Solutions Architect', 'Signal Processing Engineer',
                    'Mobile Communications Engineer', 'Satellite Telecom Engineer', 'Wireless Network Architect',
                    'Microwave Engineer', 'Antenna Design Engineer', 'Switching Systems Engineer',
                    'VoIP Engineer', 'Telematics Engineer', 'Broadband Engineer',
                    'Electronics Design Engineer', 'Fiber Optics Technician', 'Test and Measurement Engineer',
                    'Analog/Mixed Signal IC Designer', 'Digital Design Engineer', 'Consumer Electronics Architect',
                    'Avionics Technician', 'Telecommunications Project Manager', 'Field Service Engineer',
                    'Network Operations Center (NOC) Manager', 'Telecommunications Researcher', 'Regulatory Compliance Engineer'
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
                        'description'    => $title . ' is a cutting-edge career in ' . $data['prefix'] . ' focusing on the next generation of technological advancement and research.',
                        'qualification'  => 'B.E/B.Tech / B.Sc / M.Sc in relevant field',
                        'stream'         => 'Science (PCM)',
                        'salary_range'   => '₹6L – ₹30L+',
                        'demand_level'   => 'Very High',
                        'icon'           => $data['icon'],
                        'image'          => $data['img'],
                        'roadmap'        => [
                            'Complete 10+2 with Physics, Chemistry, and Mathematics',
                            'Pursue a relevant Bachelor’s degree (B.Tech or B.Sc)',
                            'Master the necessary tools (e.g. Python, ROS, MATLAB, CAD)',
                            'Complete research projects or industrial internships',
                            'Consider pursuing a Master’s degree or PhD for specialized R&D roles',
                            'Stay updated with rapidly evolving global tech trends'
                        ],
                        'skills'         => ['Advanced Mathematics', 'Programming', 'Analytical Thinking', 'Research Methodology', 'Innovation'],
                        'future_scope'   => 'Fields like AI, Robotics, and Aerospace are defining the future of humanity. They offer the highest growth, global opportunities, and intellectual satisfaction.',
                        'entrance_exams' => ['JEE Main', 'JEE Advanced', 'GATE', 'GRE (for abroad)'],
                        'job_opportunities' => ['Tech Giants', 'Space Agencies (ISRO/NASA)', 'Research Institutes', 'Deep Tech Startups'],
                        'related_careers' => ['Research Scientist', 'Software Engineer', 'Product Manager'],
                    ]
                );
            }
        }
    }
}
