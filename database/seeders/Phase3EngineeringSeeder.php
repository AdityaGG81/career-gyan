<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class Phase3EngineeringSeeder extends Seeder
{
    public function run(): void
    {
        $fieldsData = [
            'computer-engineering' => [
                'prefix' => 'Computer',
                'img' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=800&q=80',
                'icon' => 'fa-computer',
                'titles' => [
                    'Hardware Engineer (Computer)', 'Embedded Systems Engineer', 'Microprocessor Designer',
                    'Computer Architect', 'Firmware Engineer', 'Systems Programmer',
                    'Network Hardware Engineer', 'ASIC Design Engineer', 'FPGA Developer',
                    'VLSI Design Engineer', 'Kernel Developer', 'Operating Systems Engineer',
                    'Peripheral Device Designer', 'Performance Test Engineer', 'Server Hardware Architect',
                    'Data Center Engineer', 'IoT Hardware Engineer', 'Mobile Device Architect',
                    'Motherboard Designer', 'GPU Architect', 'DSP Engineer',
                    'BIOS Developer', 'Real-time Systems Engineer', 'Hardware Security Engineer',
                    'Computer Vision Hardware Specialist', 'Display Technology Engineer', 'Memory Systems Architect',
                    'Computer Hardware R&D Engineer', 'Systems Integration Engineer', 'Electronics Manufacturing Engineer'
                ]
            ],
            'information-technology' => [
                'prefix' => 'IT',
                'img' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=800&q=80',
                'icon' => 'fa-network-wired',
                'titles' => [
                    'Network Administrator', 'Systems Administrator', 'IT Support Specialist',
                    'Database Administrator (DBA)', 'IT Consultant', 'IT Project Manager',
                    'Network Architect', 'Business Intelligence Analyst', 'Enterprise Architect',
                    'Helpdesk Technician', 'IT Security Specialist', 'Disaster Recovery Specialist',
                    'Information Systems Manager', 'ERP Implementation Specialist', 'Network Operations Center (NOC) Tech',
                    'IT Auditor', 'Systems Analyst', 'Application Support Analyst',
                    'SAN Storage Engineer', 'Virtualization Engineer', 'Telecommunications Specialist',
                    'IT Operations Manager', 'Business Continuity Planner', 'Data Warehouse Specialist',
                    'IT Trainer/Educator', 'Endpoint Security Administrator', 'Active Directory Specialist',
                    'IT Procurement Manager', 'ServiceNow Administrator', 'IT Infrastructure Architect'
                ]
            ],
            'software-engineering' => [
                'prefix' => 'Software',
                'img' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800&q=80',
                'icon' => 'fa-code',
                'titles' => [
                    'Frontend Developer', 'Backend Developer', 'Full Stack Developer',
                    'Mobile App Developer (iOS)', 'Mobile App Developer (Android)', 'DevOps Engineer',
                    'Quality Assurance (QA) Engineer', 'Software Architect', 'Release Manager',
                    'Game Developer', 'UI/UX Developer', 'API Developer',
                    'Site Reliability Engineer (SRE)', 'Scrum Master', 'Technical Product Manager',
                    'Test Automation Engineer', 'AR/VR Developer', 'Blockchain Developer',
                    'Smart Contract Engineer', 'Machine Learning Engineer', 'Web 3.0 Developer',
                    'Desktop Application Developer', 'CRM Developer (Salesforce)', 'E-commerce Developer',
                    'Low-Code/No-Code Developer', 'Graphics Programmer', 'Algorithm Engineer',
                    'Technical Lead', 'Engineering Manager', 'Open Source Maintainer'
                ]
            ],
            'cloud-computing' => [
                'prefix' => 'Cloud',
                'img' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=800&q=80',
                'icon' => 'fa-cloud',
                'titles' => [
                    'Cloud Solutions Architect', 'Cloud Engineer', 'AWS Developer',
                    'Azure Solutions Architect', 'GCP Cloud Engineer', 'Cloud Security Specialist',
                    'Cloud Network Engineer', 'Cloud Migration Specialist', 'Serverless Architect',
                    'Cloud Operations Manager', 'FinOps Practitioner (Cloud Finance)', 'Kubernetes Administrator',
                    'Containerization Specialist', 'SaaS Platform Developer', 'PaaS Engineer',
                    'IaaS Specialist', 'Cloud Data Engineer', 'Multi-Cloud Strategist',
                    'Cloud Automation Engineer', 'Cloud Support Engineer', 'Site Reliability Engineer (Cloud)',
                    'Cloud Database Admin', 'Cloud DevOps Engineer', 'Edge Computing Specialist',
                    'IoT Cloud Architect', 'Disaster Recovery Cloud Engineer', 'Cloud Compliance Auditor',
                    'Salesforce Administrator', 'Cloud R&D Engineer', 'Cloud Consultant'
                ]
            ],
            'cyber-security' => [
                'prefix' => 'Security',
                'img' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?auto=format&fit=crop&w=800&q=80',
                'icon' => 'fa-shield-halved',
                'titles' => [
                    'Penetration Tester (Ethical Hacker)', 'Security Analyst', 'Chief Information Security Officer (CISO)',
                    'Security Architect', 'Incident Responder', 'Forensics Investigator',
                    'Malware Analyst', 'Cryptographer', 'Application Security Engineer',
                    'Network Security Engineer', 'Identity and Access Management (IAM) Specialist', 'SOC Analyst',
                    'Vulnerability Assessor', 'Cloud Security Architect', 'Security Consultant',
                    'Information Assurance Specialist', 'Cybersecurity Manager', 'Threat Hunter',
                    'OT/ICS Security Specialist', 'Data Privacy Officer', 'Security Software Developer',
                    'Source Code Auditor', 'IoT Security Specialist', 'Mobile Security Engineer',
                    'Cyber Intelligence Analyst', 'Red Team Specialist', 'Blue Team Specialist',
                    'Cybersecurity Researcher', 'Governance, Risk, and Compliance (GRC) Analyst', 'Cybersecurity Educator'
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
                        'description'    => $title . ' is a highly sought-after role in the IT/Tech sector, focusing on digital innovation, system building, and data protection.',
                        'qualification'  => 'B.E/B.Tech in CS/IT or BCA/MCA',
                        'stream'         => 'Science/Commerce',
                        'salary_range'   => '₹8L – ₹30L+',
                        'demand_level'   => 'Very High',
                        'icon'           => $data['icon'],
                        'image'          => $data['img'],
                        'roadmap'        => [
                            'Complete 10+2 with Mathematics and Computer Science',
                            'Pursue a relevant Bachelor’s degree (B.Tech CS/IT, BCA, or B.Sc IT)',
                            'Learn core programming languages and relevant frameworks',
                            'Build a strong portfolio of projects on GitHub or similar platforms',
                            'Obtain industry-recognized certifications (e.g. AWS, CEH, CISSP)',
                            'Apply for entry-level roles, internships, or freelance gigs'
                        ],
                        'skills'         => ['Programming', 'Analytical Thinking', 'Problem Solving', 'System Architecture', 'Continuous Learning'],
                        'future_scope'   => 'The technology sector is expanding exponentially. Cloud, Security, and Software fields offer high salaries, remote work, and immense global mobility.',
                        'entrance_exams' => ['JEE Main', 'State CETs', 'NIMCET (for MCA)'],
                        'job_opportunities' => ['Tech Giants (FAANG/MAMAA)', 'IT Service Companies (TCS, Infosys)', 'Startups', 'Remote Global Roles'],
                        'related_careers' => ['Data Scientist', 'IT Consultant', 'Engineering Manager'],
                    ]
                );
            }
        }
    }
}
