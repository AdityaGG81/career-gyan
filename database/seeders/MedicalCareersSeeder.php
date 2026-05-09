<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MedicalCareersSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'medical')->first();
        if (!$field) return;

        $careers = [
            ['name' => 'MBBS Doctor',              'icon' => 'fa-user-doctor',      'img' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹60L', 'qual' => 'MBBS via NEET UG', 'demand' => 'Very High'],
            ['name' => 'Surgeon',                  'icon' => 'fa-scalpel',          'img' => 'https://images.unsplash.com/photo-1527613426441-4da17471b66d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹12L – ₹80L', 'qual' => 'MBBS + MS Surgery', 'demand' => 'Very High'],
            ['name' => 'Dentist',                  'icon' => 'fa-tooth',            'img' => 'https://images.unsplash.com/photo-1588776814546-ec7e74f56b8e?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹30L', 'qual' => 'BDS via NEET', 'demand' => 'High'],
            ['name' => 'Pharmacist',               'icon' => 'fa-pills',            'img' => 'https://images.unsplash.com/photo-1631549916768-4119b2e5f926?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3.5L – ₹15L', 'qual' => 'B.Pharm', 'demand' => 'High'],
            ['name' => 'Nurse',                    'icon' => 'fa-user-nurse',       'img' => 'https://images.unsplash.com/photo-1594824476967-48c8b964273f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'qual' => 'B.Sc Nursing', 'demand' => 'Very High'],
            ['name' => 'Physiotherapist',          'icon' => 'fa-person-walking',   'img' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹18L', 'qual' => 'BPT', 'demand' => 'High'],
            ['name' => 'Psychologist',             'icon' => 'fa-brain',            'img' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹20L', 'qual' => 'MA/M.Sc Psychology', 'demand' => 'Growing'],
            ['name' => 'Medical Lab Technician',   'icon' => 'fa-flask',            'img' => 'https://images.unsplash.com/photo-1579154204601-01588f351e67?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2.5L – ₹10L', 'qual' => 'DMLT / B.Sc MLT', 'demand' => 'High'],
            ['name' => 'Radiologist',              'icon' => 'fa-x-ray',            'img' => 'https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=800&q=80', 'salary' => '₹10L – ₹50L', 'qual' => 'MBBS + MD Radiology', 'demand' => 'Very High'],
            ['name' => 'Optometrist',              'icon' => 'fa-eye',              'img' => 'https://images.unsplash.com/photo-1511117833895-4b473c0b85d6?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'qual' => 'B.Optom', 'demand' => 'Growing'],
            ['name' => 'Dietitian',                'icon' => 'fa-apple-whole',      'img' => 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'qual' => 'B.Sc Dietetics', 'demand' => 'Growing'],
            ['name' => 'Veterinarian',             'icon' => 'fa-paw',              'img' => 'https://images.unsplash.com/photo-1415369629372-26f2fe60c467?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹20L', 'qual' => 'BVSc & AH', 'demand' => 'High'],
            ['name' => 'Anesthesiologist',         'icon' => 'fa-syringe',          'img' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹12L – ₹60L', 'qual' => 'MBBS + MD Anaesthesia', 'demand' => 'Very High'],
            ['name' => 'Public Health Specialist', 'icon' => 'fa-earth-asia',       'img' => 'https://images.unsplash.com/photo-1530026405186-ed1f139313f8?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹25L', 'qual' => 'MPH / MBBS + DPH', 'demand' => 'Growing'],
            ['name' => 'Biotechnologist',          'icon' => 'fa-dna',              'img' => 'https://images.unsplash.com/photo-1507413245164-6160d8298b31?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹22L', 'qual' => 'B.Sc / M.Sc Biotech', 'demand' => 'High'],
            ['name' => 'Cardiologist',             'icon' => 'fa-heart-pulse',      'img' => 'https://images.unsplash.com/photo-1628348070889-cb656235b4eb?auto=format&fit=crop&w=800&q=80', 'salary' => '₹15L – ₹80L', 'qual' => 'MBBS + MD + DM Cardiology', 'demand' => 'Very High'],
            ['name' => 'Neurologist',              'icon' => 'fa-brain-circuit',    'img' => 'https://images.unsplash.com/photo-1559757175-0eb30cd8c063?auto=format&fit=crop&w=800&q=80', 'salary' => '₹12L – ₹70L', 'qual' => 'MBBS + MD + DM Neurology', 'demand' => 'Very High'],
            ['name' => 'Dermatologist',            'icon' => 'fa-hand-sparkles',    'img' => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹45L', 'qual' => 'MBBS + MD Dermatology', 'demand' => 'Very High'],
            ['name' => 'Pediatrician',             'icon' => 'fa-baby',             'img' => 'https://images.unsplash.com/photo-1551884170-09fb70a3a2ed?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹45L', 'qual' => 'MBBS + MD Paediatrics', 'demand' => 'High'],
            ['name' => 'Gynecologist',             'icon' => 'fa-venus',            'img' => 'https://images.unsplash.com/photo-1584515933487-779824d29309?auto=format&fit=crop&w=800&q=80', 'salary' => '₹10L – ₹60L', 'qual' => 'MBBS + MS Gynecology', 'demand' => 'Very High'],
            ['name' => 'Orthopedic Doctor',        'icon' => 'fa-bone',             'img' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&w=800&q=80', 'salary' => '₹10L – ₹55L', 'qual' => 'MBBS + MS Orthopaedics', 'demand' => 'High'],
            ['name' => 'ENT Specialist',           'icon' => 'fa-ear-listen',       'img' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹40L', 'qual' => 'MBBS + MS ENT', 'demand' => 'High'],
            ['name' => 'Ophthalmologist',          'icon' => 'fa-eye-dropper',      'img' => 'https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹45L', 'qual' => 'MBBS + MS Ophthalmology', 'demand' => 'High'],
            ['name' => 'Psychiatrist',             'icon' => 'fa-brain',            'img' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹40L', 'qual' => 'MBBS + MD Psychiatry', 'demand' => 'Growing'],
            ['name' => 'Emergency Medicine Doctor','icon' => 'fa-truck-medical',    'img' => 'https://images.unsplash.com/photo-1530026405186-ed1f139313f8?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹40L', 'qual' => 'MBBS + DNB EM', 'demand' => 'Very High'],
            ['name' => 'Pathologist',              'icon' => 'fa-microscope',       'img' => 'https://images.unsplash.com/photo-1579154204601-01588f351e67?auto=format&fit=crop&w=800&q=80', 'salary' => '₹8L – ₹35L', 'qual' => 'MBBS + MD Pathology', 'demand' => 'High'],
            ['name' => 'Microbiologist',           'icon' => 'fa-bacteria',         'img' => 'https://images.unsplash.com/photo-1507413245164-6160d8298b31?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹20L', 'qual' => 'M.Sc Microbiology', 'demand' => 'Growing'],
            ['name' => 'Biomedical Engineer',      'icon' => 'fa-stethoscope',      'img' => 'https://images.unsplash.com/photo-1581093588401-fbb62a02f120?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹22L', 'qual' => 'B.Tech Biomedical', 'demand' => 'Growing'],
            ['name' => 'Clinical Research Associate','icon' => 'fa-clipboard-list', 'img' => 'https://images.unsplash.com/photo-1532094349884-543559c6571f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'qual' => 'Life Sciences + CRA Cert', 'demand' => 'Growing'],
            ['name' => 'Hospital Administrator',   'icon' => 'fa-hospital',         'img' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹25L', 'qual' => 'MHA / MBA Healthcare', 'demand' => 'High'],
            ['name' => 'Medical Officer',          'icon' => 'fa-file-medical',     'img' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?auto=format&fit=crop&w=800&q=80', 'salary' => '₹6L – ₹20L', 'qual' => 'MBBS', 'demand' => 'High'],
            ['name' => 'Ayurveda Doctor',          'icon' => 'fa-leaf',             'img' => 'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'qual' => 'BAMS', 'demand' => 'Growing'],
            ['name' => 'Homeopathy Doctor',        'icon' => 'fa-mortar-pestle',    'img' => 'https://images.unsplash.com/photo-1631549916768-4119b2e5f926?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'qual' => 'BHMS', 'demand' => 'Stable'],
            ['name' => 'Unani Doctor',             'icon' => 'fa-spa',              'img' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'qual' => 'BUMS', 'demand' => 'Stable'],
            ['name' => 'Radiotherapy Technologist','icon' => 'fa-radiation',        'img' => 'https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹14L', 'qual' => 'B.Sc Radiotherapy', 'demand' => 'Growing'],
            ['name' => 'Operation Theatre Technician','icon' => 'fa-scalpel',       'img' => 'https://images.unsplash.com/photo-1527613426441-4da17471b66d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2.5L – ₹10L', 'qual' => 'Diploma OT Tech', 'demand' => 'High'],
            ['name' => 'Dialysis Technician',      'icon' => 'fa-droplet',          'img' => 'https://images.unsplash.com/photo-1581093588401-fbb62a02f120?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2.5L – ₹10L', 'qual' => 'CDDT / B.Sc Dialysis', 'demand' => 'High'],
            ['name' => 'ECG Technician',           'icon' => 'fa-heart-pulse',      'img' => 'https://images.unsplash.com/photo-1628348070889-cb656235b4eb?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2.5L – ₹8L', 'qual' => 'Diploma ECG Tech', 'demand' => 'High'],
            ['name' => 'X-Ray Technician',         'icon' => 'fa-x-ray',            'img' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2.5L – ₹9L', 'qual' => 'DRIT / B.Sc Radiology', 'demand' => 'High'],
            ['name' => 'MRI Technician',           'icon' => 'fa-magnet',           'img' => 'https://images.unsplash.com/photo-1559757175-0eb30cd8c063?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹12L', 'qual' => 'B.Sc MRI Technology', 'demand' => 'High'],
            ['name' => 'Nutritionist',             'icon' => 'fa-bowl-food',        'img' => 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹16L', 'qual' => 'B.Sc Nutrition', 'demand' => 'Growing'],
            ['name' => 'Speech Therapist',         'icon' => 'fa-microphone',       'img' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'qual' => 'B.ASLP', 'demand' => 'Growing'],
            ['name' => 'Occupational Therapist',   'icon' => 'fa-hands-holding',    'img' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹15L', 'qual' => 'BOT', 'demand' => 'Growing'],
            ['name' => 'Paramedic',                'icon' => 'fa-kit-medical',      'img' => 'https://images.unsplash.com/photo-1586534408788-e5d0d34e3c6a?auto=format&fit=crop&w=800&q=80', 'salary' => '₹2.5L – ₹10L', 'qual' => 'Diploma Paramedic', 'demand' => 'High'],
            ['name' => 'Medical Coder',            'icon' => 'fa-file-code',        'img' => 'https://images.unsplash.com/photo-1532094349884-543559c6571f?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3L – ₹14L', 'qual' => 'CPC / CCS Certification', 'demand' => 'Growing'],
            ['name' => 'Health Inspector',         'icon' => 'fa-clipboard-check',  'img' => 'https://images.unsplash.com/photo-1530026405186-ed1f139313f8?auto=format&fit=crop&w=800&q=80', 'salary' => '₹3.5L – ₹12L', 'qual' => 'B.Sc Public Health', 'demand' => 'Stable'],
            ['name' => 'Forensic Medicine Expert', 'icon' => 'fa-magnifying-glass', 'img' => 'https://images.unsplash.com/photo-1583912267550-d974b4e1b73d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹20L', 'qual' => 'MBBS + MD Forensic Med', 'demand' => 'Stable'],
            ['name' => 'Genetic Counselor',        'icon' => 'fa-dna',              'img' => 'https://images.unsplash.com/photo-1507413245164-6160d8298b31?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹22L', 'qual' => 'M.Sc Genetics', 'demand' => 'Growing'],
            ['name' => 'Perfusionist',             'icon' => 'fa-heart',            'img' => 'https://images.unsplash.com/photo-1628348070889-cb656235b4eb?auto=format&fit=crop&w=800&q=80', 'salary' => '₹5L – ₹25L', 'qual' => 'B.Sc Perfusion Technology', 'demand' => 'Growing'],
            ['name' => 'Prosthetist and Orthotist','icon' => 'fa-person-walking',   'img' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=800&q=80', 'salary' => '₹4L – ₹18L', 'qual' => 'B.Sc Prosthetics', 'demand' => 'Growing'],
        ];

        foreach ($careers as $c) {
            Career::updateOrCreate(
                ['slug' => Str::slug($c['name'])],
                [
                    'name'           => $c['name'],
                    'field_id'       => $field->id,
                    'description'    => $c['name'] . ' is a vital healthcare professional dedicated to patient care, diagnosis, and treatment within the Indian healthcare system.',
                    'qualification'  => $c['qual'],
                    'stream'         => 'Science / PCB',
                    'salary_range'   => $c['salary'],
                    'demand_level'   => $c['demand'],
                    'icon'           => $c['icon'],
                    'image'          => $c['img'],
                    'roadmap'        => [
                        'Complete 12th with Science (PCB)',
                        'Clear NEET UG / relevant entrance exam',
                        'Pursue ' . $c['qual'],
                        'Complete mandatory internship',
                        'Register with State / National Medical Council',
                        'Gain clinical experience',
                        'Specialise or start independent practice',
                    ],
                    'skills'         => ['Patient Care', 'Clinical Diagnosis', 'Medical Knowledge', 'Empathy', 'Team Collaboration'],
                    'future_scope'   => 'Healthcare is one of the fastest growing sectors in India. Demand for skilled medical professionals is rising with expanding hospital networks, telemedicine, and government health schemes.',
                    'entrance_exams' => ['NEET UG', 'NEET PG', 'AIIMS', 'JIPMER'],
                    'job_opportunities' => ['Government Hospitals', 'Private Hospitals', 'Clinics', 'Research Institutes', 'NGOs', 'Abroad Opportunities'],
                    'related_careers' => ['Nurse', 'Pharmacist', 'Medical Lab Technician'],
                ]
            );
        }
    }
}
