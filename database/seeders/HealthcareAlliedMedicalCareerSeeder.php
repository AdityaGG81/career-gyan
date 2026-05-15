<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Career;
use App\Models\Field;

class HealthcareAlliedMedicalCareerSeeder extends Seeder
{
    public function run(): void
    {
        $fieldSlug = 'healthcare-allied-medical';
        $field = Field::where('slug', $fieldSlug)->first();

        if (!$field) {
            $this->command->error("Field not found: {$fieldSlug}");
            return;
        }

        $careers = [
            [
                'slug' => 'anaesthesiologist',
                'title' => 'Anaesthesiologist',
                'domain' => 'Medical Specialists',
                'short_info' => 'Anaesthesiologists are specialist doctors who provide anaesthesia, pain control, and critical care support during surgeries and medical procedures.',
                'salary_range' => '₹10L – ₹35L+',
                'demand_level' => 'Very High',
                'qualification' => 'MBBS + MD/DNB Anaesthesiology',
                'preferred_stream' => 'Science PCB',
                'entrance_exams' => 'NEET UG, NEET PG / INI-CET',
                'key_skills' => 'Critical Care, Patient Monitoring, Decision Making, Emergency Handling, Medical Knowledge',
                'top_employers' => 'Hospitals, Surgical Centres, ICUs, Medical Colleges, Emergency Care Units',
                'image' => 'images/careers/healthcare-allied-medical/anaesthesiologist.svg'
            ],
            [
                'slug' => 'bacteriologist',
                'title' => 'Bacteriologist',
                'domain' => 'Allied Health & Diagnostics',
                'short_info' => 'Bacteriologists study bacteria, infections, lab cultures, and disease-causing microorganisms to support diagnosis, research, and public health.',
                'salary_range' => '₹4L – ₹14L',
                'demand_level' => 'High',
                'qualification' => 'B.Sc / M.Sc Microbiology, Biotechnology, Life Sciences, or related field',
                'preferred_stream' => 'Science PCB',
                'entrance_exams' => 'CUET UG, University Entrance Exams, GATE/JAM for higher studies',
                'key_skills' => 'Microbiology, Lab Testing, Research, Sterilization, Data Analysis',
                'top_employers' => 'Diagnostic Labs, Research Institutes, Hospitals, Pharma Companies, Public Health Labs',
                'image' => 'images/careers/healthcare-allied-medical/bacteriologist.svg'
            ],
            [
                'slug' => 'acupuncturist',
                'title' => 'Acupuncturist',
                'domain' => 'Alternative & Complementary Health',
                'short_info' => 'Acupuncturists use traditional needle-based therapy techniques to support pain relief, wellness, and complementary health treatment.',
                'salary_range' => '₹3L – ₹10L',
                'demand_level' => 'Growing',
                'qualification' => 'Certified Acupuncture Course / Relevant Health Science Background',
                'preferred_stream' => 'Science / Healthcare',
                'entrance_exams' => 'Institute-specific entrance or certification requirements',
                'key_skills' => 'Patient Care, Anatomy Basics, Wellness Counselling, Precision, Communication',
                'top_employers' => 'Wellness Centres, Rehabilitation Clinics, Private Practice, Alternative Therapy Centres',
                'image' => 'images/careers/healthcare-allied-medical/acupuncturist.svg'
            ],
            [
                'slug' => 'clinical-psychologist',
                'title' => 'Clinical Psychologist',
                'domain' => 'Rehabilitation & Therapy',
                'short_info' => 'Clinical Psychologists assess, diagnose, and support people facing emotional, behavioural, and mental health challenges.',
                'salary_range' => '₹4L – ₹18L',
                'demand_level' => 'Very High',
                'qualification' => 'Psychology degree + RCI-recognized Clinical Psychology qualification',
                'preferred_stream' => 'Arts / Science',
                'entrance_exams' => 'CUET UG, University Entrance Exams, RCI-approved program admission',
                'key_skills' => 'Counselling, Assessment, Empathy, Research, Communication',
                'top_employers' => 'Hospitals, Mental Health Clinics, Rehabilitation Centres, Schools, Private Practice',
                'image' => 'images/careers/healthcare-allied-medical/clinical-psychologist.svg'
            ],
            [
                'slug' => 'dermatologist',
                'title' => 'Dermatologist',
                'domain' => 'Medical Specialists',
                'short_info' => 'Dermatologists diagnose and treat skin, hair, nail, allergy, cosmetic, and infection-related conditions.',
                'salary_range' => '₹10L – ₹40L+',
                'demand_level' => 'Very High',
                'qualification' => 'MBBS + MD/DNB Dermatology',
                'preferred_stream' => 'Science PCB',
                'entrance_exams' => 'NEET UG, NEET PG / INI-CET',
                'key_skills' => 'Diagnosis, Patient Care, Skin Procedures, Cosmetic Treatment, Medical Knowledge',
                'top_employers' => 'Hospitals, Skin Clinics, Cosmetic Clinics, Medical Colleges, Private Practice',
                'image' => 'images/careers/healthcare-allied-medical/dermatologist.svg'
            ],
            [
                'slug' => 'orthodontist',
                'title' => 'Orthodontist',
                'domain' => 'Dental & Eye Care',
                'short_info' => 'Orthodontists are dental specialists who correct teeth alignment, jaw irregularities, and bite problems using braces and aligners.',
                'salary_range' => '₹6L – ₹30L+',
                'demand_level' => 'High',
                'qualification' => 'BDS + MDS Orthodontics',
                'preferred_stream' => 'Science PCB',
                'entrance_exams' => 'NEET UG, NEET MDS',
                'key_skills' => 'Dental Diagnosis, Precision, Patient Counselling, Treatment Planning, Manual Skills',
                'top_employers' => 'Dental Clinics, Hospitals, Orthodontic Centres, Dental Colleges, Private Practice',
                'image' => 'images/careers/healthcare-allied-medical/orthodontist.svg'
            ],
            [
                'slug' => 'optometrist',
                'title' => 'Optometrist',
                'domain' => 'Dental & Eye Care',
                'short_info' => 'Optometrists examine vision, prescribe corrective lenses, detect eye problems, and support eye-care services.',
                'salary_range' => '₹3L – ₹10L',
                'demand_level' => 'High',
                'qualification' => 'B.Optom / Diploma in Optometry',
                'preferred_stream' => 'Science PCB',
                'entrance_exams' => 'University/Institute Entrance Exams, CUET UG where applicable',
                'key_skills' => 'Vision Testing, Lens Prescription, Patient Handling, Eye Screening, Accuracy',
                'top_employers' => 'Eye Hospitals, Optical Chains, Clinics, Vision Centres, NGOs',
                'image' => 'images/careers/healthcare-allied-medical/optometrist.svg'
            ],
            [
                'slug' => 'radiographer',
                'title' => 'Radiographer',
                'domain' => 'Medical Imaging & Radiology',
                'short_info' => 'Radiographers operate imaging equipment such as X-ray, CT scan, and MRI systems under medical supervision.',
                'salary_range' => '₹3L – ₹12L',
                'demand_level' => 'High',
                'qualification' => 'Diploma / B.Sc Radiography or Medical Imaging Technology',
                'preferred_stream' => 'Science PCB',
                'entrance_exams' => 'State Paramedical Entrance, University Entrance Exams',
                'key_skills' => 'Imaging Equipment, Patient Positioning, Radiation Safety, Report Support, Accuracy',
                'top_employers' => 'Hospitals, Diagnostic Centres, Imaging Labs, Trauma Centres',
                'image' => 'images/careers/healthcare-allied-medical/radiographer.svg'
            ],
            [
                'slug' => 'lab-technician',
                'title' => 'Lab Technician',
                'domain' => 'Allied Health & Diagnostics',
                'short_info' => 'Lab Technicians collect samples, perform diagnostic tests, maintain lab equipment, and support disease diagnosis.',
                'salary_range' => '₹2.5L – ₹8L',
                'demand_level' => 'Very High',
                'qualification' => 'DMLT / BMLT / Medical Laboratory Technology course',
                'preferred_stream' => 'Science PCB',
                'entrance_exams' => 'State Paramedical Entrance, University Entrance Exams',
                'key_skills' => 'Sample Collection, Lab Testing, Microscope Use, Safety Protocols, Record Keeping',
                'top_employers' => 'Pathology Labs, Hospitals, Diagnostic Centres, Blood Banks, Research Labs',
                'image' => 'images/careers/healthcare-allied-medical/lab-technician.svg'
            ],
            [
                'slug' => 'dialysis-technician',
                'title' => 'Dialysis Technician',
                'domain' => 'Emergency & Critical Care',
                'short_info' => 'Dialysis Technicians operate dialysis machines and assist patients with kidney failure during dialysis procedures.',
                'salary_range' => '₹2.5L – ₹8L',
                'demand_level' => 'High',
                'qualification' => 'Diploma / Certificate in Dialysis Technology',
                'preferred_stream' => 'Science PCB',
                'entrance_exams' => 'State Paramedical Entrance, Institute Entrance Exams',
                'key_skills' => 'Dialysis Machine Operation, Patient Monitoring, Sterilization, Emergency Support, Documentation',
                'top_employers' => 'Hospitals, Dialysis Centres, Kidney Care Clinics, Nephrology Units',
                'image' => 'images/careers/healthcare-allied-medical/dialysis-technician.svg'
            ],
            [
                'slug' => 'operation-theatre-technician',
                'title' => 'Operation Theatre Technician',
                'domain' => 'Emergency & Critical Care',
                'short_info' => 'Operation Theatre Technicians prepare operating rooms, arrange surgical equipment, support surgeons, and maintain sterile conditions.',
                'salary_range' => '₹2.5L – ₹8L',
                'demand_level' => 'High',
                'qualification' => 'Diploma / B.Sc Operation Theatre Technology',
                'preferred_stream' => 'Science PCB',
                'entrance_exams' => 'State Paramedical Entrance, University Entrance Exams',
                'key_skills' => 'OT Preparation, Sterilization, Surgical Instruments, Teamwork, Emergency Readiness',
                'top_employers' => 'Hospitals, Surgical Centres, Trauma Centres, Medical Colleges',
                'image' => 'images/careers/healthcare-allied-medical/operation-theatre-technician.svg'
            ],
            [
                'slug' => 'x-ray-technician',
                'title' => 'X-Ray Technician',
                'domain' => 'Medical Imaging & Radiology',
                'short_info' => 'X-Ray Technicians operate X-ray machines, position patients, follow radiation safety rules, and assist diagnostic imaging.',
                'salary_range' => '₹2.5L – ₹7L',
                'demand_level' => 'High',
                'qualification' => 'Diploma / Certificate in X-Ray Technology',
                'preferred_stream' => 'Science PCB',
                'entrance_exams' => 'State Paramedical Entrance, Institute Entrance Exams',
                'key_skills' => 'X-Ray Imaging, Radiation Safety, Patient Positioning, Equipment Handling, Record Keeping',
                'top_employers' => 'Hospitals, Diagnostic Centres, Orthopaedic Clinics, Trauma Centres',
                'image' => 'images/careers/healthcare-allied-medical/x-ray-technician.svg'
            ],
            [
                'slug' => 'mri-technician',
                'title' => 'MRI Technician',
                'domain' => 'Medical Imaging & Radiology',
                'short_info' => 'MRI Technicians operate MRI scanners, prepare patients, follow imaging protocols, and support radiologists in diagnosis.',
                'salary_range' => '₹3L – ₹10L',
                'demand_level' => 'High',
                'qualification' => 'Diploma / B.Sc Medical Imaging Technology',
                'preferred_stream' => 'Science PCB',
                'entrance_exams' => 'State Paramedical Entrance, University Entrance Exams',
                'key_skills' => 'MRI Operation, Patient Safety, Imaging Protocols, Anatomy Basics, Attention to Detail',
                'top_employers' => 'Hospitals, Diagnostic Centres, Imaging Labs, Neurology Centres',
                'image' => 'images/careers/healthcare-allied-medical/mri-technician.svg'
            ],
            [
                'slug' => 'ambulance-driver',
                'title' => 'Ambulance Driver',
                'domain' => 'Emergency & Critical Care',
                'short_info' => 'Ambulance Drivers transport patients safely during emergencies and support basic emergency response coordination.',
                'salary_range' => '₹2L – ₹5L',
                'demand_level' => 'Stable',
                'qualification' => '10th/12th + valid driving license + emergency response training preferred',
                'preferred_stream' => 'Any Stream',
                'entrance_exams' => 'No mandatory entrance exam',
                'key_skills' => 'Safe Driving, Emergency Response, Route Knowledge, Calmness, Patient Handling Support',
                'top_employers' => 'Hospitals, Ambulance Services, Emergency Medical Services, NGOs',
                'image' => 'images/careers/healthcare-allied-medical/ambulance-driver.svg'
            ],
            [
                'slug' => 'medical-coder',
                'title' => 'Medical Coder',
                'domain' => 'Medical Records & Health Information',
                'short_info' => 'Medical Coders convert patient diagnosis, procedures, and medical records into standardized healthcare codes for billing and insurance.',
                'salary_range' => '₹3L – ₹10L',
                'demand_level' => 'High',
                'qualification' => 'Life Science / Medical / Paramedical / Nursing / Pharmacy background preferred',
                'preferred_stream' => 'Science / Healthcare',
                'entrance_exams' => 'Medical Coding Certifications such as CPC/CCS preferred',
                'key_skills' => 'Medical Terminology, ICD/CPT Coding, Accuracy, Documentation, Insurance Process',
                'top_employers' => 'Hospitals, Health Insurance Companies, Medical Billing Firms, KPOs',
                'image' => 'images/careers/healthcare-allied-medical/medical-coder.svg'
            ],
            [
                'slug' => 'medical-transcriptionist',
                'title' => 'Medical Transcriptionist',
                'domain' => 'Medical Records & Health Information',
                'short_info' => 'Medical Transcriptionists convert doctors’ voice notes and clinical dictations into accurate written medical records.',
                'salary_range' => '₹2.5L – ₹7L',
                'demand_level' => 'Stable',
                'qualification' => 'Graduation / Medical transcription training / Healthcare documentation course',
                'preferred_stream' => 'Any Stream with English and medical terminology skills',
                'entrance_exams' => 'No mandatory entrance exam',
                'key_skills' => 'Listening, Typing, Medical Terminology, English, Accuracy',
                'top_employers' => 'Hospitals, Medical Documentation Firms, KPOs, Clinics, Remote Healthcare Services',
                'image' => 'images/careers/healthcare-allied-medical/medical-transcriptionist.svg'
            ],
            [
                'slug' => 'public-health-analyst',
                'title' => 'Public Health Analyst',
                'domain' => 'Public Health & Hospital Administration',
                'short_info' => 'Public Health Analysts study health data, disease trends, community programs, and policies to improve population health.',
                'salary_range' => '₹4L – ₹14L',
                'demand_level' => 'Growing',
                'qualification' => 'BPH / MPH / Life Sciences / Statistics / Public Health degree',
                'preferred_stream' => 'Science / Arts / Statistics',
                'entrance_exams' => 'CUET UG, University Entrance Exams, MPH entrance where applicable',
                'key_skills' => 'Data Analysis, Public Health, Research, Policy Understanding, Reporting',
                'top_employers' => 'Government Health Departments, NGOs, WHO Projects, Research Institutes, Hospitals',
                'image' => 'images/careers/healthcare-allied-medical/public-health-analyst.svg'
            ],
            [
                'slug' => 'epidemiologist',
                'title' => 'Epidemiologist',
                'domain' => 'Public Health & Hospital Administration',
                'short_info' => 'Epidemiologists investigate disease patterns, outbreaks, risk factors, and prevention strategies for public health protection.',
                'salary_range' => '₹5L – ₹18L',
                'demand_level' => 'High',
                'qualification' => 'MPH / M.Sc Epidemiology / Community Medicine background',
                'preferred_stream' => 'Science / Public Health',
                'entrance_exams' => 'University Entrance Exams, NEET PG for medical route, MPH entrances',
                'key_skills' => 'Disease Surveillance, Statistics, Research, Data Analysis, Field Investigation',
                'top_employers' => 'Public Health Departments, Research Institutes, NGOs, Hospitals, International Health Agencies',
                'image' => 'images/careers/healthcare-allied-medical/epidemiologist.svg'
            ],
            [
                'slug' => 'health-inspector',
                'title' => 'Health Inspector',
                'domain' => 'Public Health & Hospital Administration',
                'short_info' => 'Health Inspectors monitor sanitation, public hygiene, food safety, disease prevention, and health regulation compliance.',
                'salary_range' => '₹3L – ₹8L',
                'demand_level' => 'Stable',
                'qualification' => 'Diploma in Health/Sanitary Inspection or relevant public health course',
                'preferred_stream' => 'Science / Any Stream',
                'entrance_exams' => 'State Health Inspector Recruitment / Institute Entrance',
                'key_skills' => 'Inspection, Public Health Rules, Sanitation, Reporting, Communication',
                'top_employers' => 'Municipal Corporations, Health Departments, Food Safety Units, Public Health Projects',
                'image' => 'images/careers/healthcare-allied-medical/health-inspector.svg'
            ],
            [
                'slug' => 'hospital-administrator',
                'title' => 'Hospital Administrator',
                'domain' => 'Public Health & Hospital Administration',
                'short_info' => 'Hospital Administrators manage hospital operations, staff coordination, patient services, finance, quality, and compliance.',
                'salary_range' => '₹5L – ₹20L',
                'demand_level' => 'High',
                'qualification' => 'BHA / MHA / MBA Healthcare Management',
                'preferred_stream' => 'Any Stream / Management / Healthcare',
                'entrance_exams' => 'CUET UG, CAT/MAT/CMAT for MBA, University Entrance Exams',
                'key_skills' => 'Hospital Operations, Leadership, Communication, Healthcare Quality, Problem Solving',
                'top_employers' => 'Hospitals, Medical Colleges, Healthcare Chains, Clinics, HealthTech Companies',
                'image' => 'images/careers/healthcare-allied-medical/hospital-administrator.svg'
            ],
            [
                'slug' => 'nursing-assistant',
                'title' => 'Nursing Assistant',
                'domain' => 'Nursing & Patient Care',
                'short_info' => 'Nursing Assistants support nurses and doctors by helping patients with basic care, hygiene, mobility, and daily needs.',
                'salary_range' => '₹2L – ₹5L',
                'demand_level' => 'High',
                'qualification' => 'Nursing Assistant / General Duty Assistant training',
                'preferred_stream' => 'Any Stream / Healthcare',
                'entrance_exams' => 'Skill training admission / Institute-based admission',
                'key_skills' => 'Patient Care, Hygiene Support, Empathy, Teamwork, Basic Vital Monitoring',
                'top_employers' => 'Hospitals, Nursing Homes, Home Healthcare, Elder Care Centres',
                'image' => 'images/careers/healthcare-allied-medical/nursing-assistant.svg'
            ],
            [
                'slug' => 'gnm-nurse',
                'title' => 'GNM Nurse',
                'domain' => 'Nursing & Patient Care',
                'short_info' => 'GNM Nurses provide patient care, administer medicines under medical direction, assist doctors, and manage ward-level nursing duties.',
                'salary_range' => '₹3L – ₹9L',
                'demand_level' => 'Very High',
                'qualification' => 'GNM Nursing Diploma',
                'preferred_stream' => 'Science PCB preferred',
                'entrance_exams' => 'State Nursing Entrance / Institute Entrance',
                'key_skills' => 'Patient Care, Medicine Administration Support, Ward Management, Empathy, Emergency Support',
                'top_employers' => 'Hospitals, Clinics, Nursing Homes, Government Health Centres, Home Healthcare',
                'image' => 'images/careers/healthcare-allied-medical/gnm-nurse.svg'
            ],
            [
                'slug' => 'anm-nurse',
                'title' => 'ANM Nurse',
                'domain' => 'Nursing & Patient Care',
                'short_info' => 'ANM Nurses support community healthcare, maternal health, vaccination, basic nursing care, and rural health services.',
                'salary_range' => '₹2.5L – ₹7L',
                'demand_level' => 'High',
                'qualification' => 'ANM Nursing Course',
                'preferred_stream' => 'Any Stream / Science preferred',
                'entrance_exams' => 'State Nursing Entrance / Institute Entrance',
                'key_skills' => 'Community Health, Maternal Care, Vaccination Support, Patient Counselling, Record Keeping',
                'top_employers' => 'Primary Health Centres, Government Health Departments, NGOs, Rural Clinics',
                'image' => 'images/careers/healthcare-allied-medical/anm-nurse.svg'
            ],
            [
                'slug' => 'midwife',
                'title' => 'Midwife',
                'domain' => 'Nursing & Patient Care',
                'short_info' => 'Midwives support pregnancy care, childbirth assistance, newborn care, maternal health education, and postnatal support.',
                'salary_range' => '₹3L – ₹9L',
                'demand_level' => 'High',
                'qualification' => 'Nursing / Midwifery qualification such as ANM/GNM/B.Sc Nursing with midwifery training',
                'preferred_stream' => 'Science PCB preferred',
                'entrance_exams' => 'Nursing Entrance Exams / Institute Entrance',
                'key_skills' => 'Maternal Care, Childbirth Support, Emergency Awareness, Counselling, Patient Monitoring',
                'top_employers' => 'Hospitals, Maternity Homes, PHCs, NGOs, Women’s Health Clinics',
                'image' => 'images/careers/healthcare-allied-medical/midwife.svg'
            ],
            [
                'slug' => 'speech-therapist',
                'title' => 'Speech Therapist',
                'domain' => 'Rehabilitation & Therapy',
                'short_info' => 'Speech Therapists help people with speech, language, swallowing, voice, and communication difficulties.',
                'salary_range' => '₹3.5L – ₹12L',
                'demand_level' => 'High',
                'qualification' => 'BASLP / MASLP or recognized speech-language pathology qualification',
                'preferred_stream' => 'Science / Healthcare',
                'entrance_exams' => 'University Entrance Exams, Institute Entrance Exams',
                'key_skills' => 'Speech Assessment, Therapy Planning, Patience, Communication, Rehabilitation',
                'top_employers' => 'Hospitals, Rehabilitation Centres, Schools, Speech Clinics, Special Education Centres',
                'image' => 'images/careers/healthcare-allied-medical/speech-therapist.svg'
            ],
            [
                'slug' => 'audiologist',
                'title' => 'Audiologist',
                'domain' => 'Rehabilitation & Therapy',
                'short_info' => 'Audiologists diagnose hearing problems, conduct hearing tests, recommend hearing aids, and support hearing rehabilitation.',
                'salary_range' => '₹3.5L – ₹12L',
                'demand_level' => 'High',
                'qualification' => 'BASLP / Audiology degree or recognized qualification',
                'preferred_stream' => 'Science / Healthcare',
                'entrance_exams' => 'University Entrance Exams, Institute Entrance Exams',
                'key_skills' => 'Hearing Assessment, Audiometry, Patient Counselling, Hearing Aid Fitting, Rehabilitation',
                'top_employers' => 'ENT Clinics, Hospitals, Hearing Aid Centres, Rehabilitation Centres',
                'image' => 'images/careers/healthcare-allied-medical/audiologist.svg'
            ],
            [
                'slug' => 'prosthetist',
                'title' => 'Prosthetist',
                'domain' => 'Rehabilitation & Therapy',
                'short_info' => 'Prosthetists design, fit, and maintain artificial limbs and assistive devices for people with limb loss or mobility limitations.',
                'salary_range' => '₹3.5L – ₹12L',
                'demand_level' => 'Growing',
                'qualification' => 'Bachelor’s/Diploma in Prosthetics and Orthotics',
                'preferred_stream' => 'Science / Healthcare',
                'entrance_exams' => 'Institute/University Entrance Exams',
                'key_skills' => 'Biomechanics, Patient Assessment, Device Fitting, Technical Design, Empathy',
                'top_employers' => 'Rehabilitation Centres, Hospitals, Prosthetic Clinics, NGOs, Assistive Technology Firms',
                'image' => 'images/careers/healthcare-allied-medical/prosthetist.svg'
            ],
            [
                'slug' => 'perfusionist',
                'title' => 'Perfusionist',
                'domain' => 'Emergency & Critical Care',
                'short_info' => 'Perfusionists operate heart-lung machines and support circulation during cardiac surgeries and critical procedures.',
                'salary_range' => '₹4L – ₹15L',
                'demand_level' => 'High',
                'qualification' => 'B.Sc / M.Sc Perfusion Technology',
                'preferred_stream' => 'Science PCB',
                'entrance_exams' => 'University Entrance Exams, State Paramedical Entrance',
                'key_skills' => 'Heart-Lung Machine Operation, Critical Care, Patient Monitoring, Emergency Readiness, Teamwork',
                'top_employers' => 'Cardiac Hospitals, Multispecialty Hospitals, Surgical Centres, Medical Colleges',
                'image' => 'images/careers/healthcare-allied-medical/perfusionist.svg'
            ],
            [
                'slug' => 'respiratory-therapist',
                'title' => 'Respiratory Therapist',
                'domain' => 'Emergency & Critical Care',
                'short_info' => 'Respiratory Therapists support patients with breathing problems, ventilator care, oxygen therapy, and pulmonary rehabilitation.',
                'salary_range' => '₹3.5L – ₹12L',
                'demand_level' => 'High',
                'qualification' => 'B.Sc Respiratory Therapy / Diploma in Respiratory Care',
                'preferred_stream' => 'Science PCB',
                'entrance_exams' => 'University Entrance Exams, State Paramedical Entrance',
                'key_skills' => 'Ventilator Support, Oxygen Therapy, Patient Monitoring, Pulmonary Care, Emergency Response',
                'top_employers' => 'ICUs, Hospitals, Pulmonary Clinics, Emergency Units, Rehabilitation Centres',
                'image' => 'images/careers/healthcare-allied-medical/respiratory-therapist.svg'
            ],
            [
                'slug' => 'emergency-medical-technician',
                'title' => 'Emergency Medical Technician',
                'domain' => 'Emergency & Critical Care',
                'short_info' => 'Emergency Medical Technicians provide immediate medical support, basic life support, and patient transport during emergencies.',
                'salary_range' => '₹2.5L – ₹8L',
                'demand_level' => 'High',
                'qualification' => 'EMT-Basic / EMT-Advanced / Paramedic training',
                'preferred_stream' => 'Science / Healthcare',
                'entrance_exams' => 'Skill training admission / Institute-based admission',
                'key_skills' => 'First Aid, CPR, Emergency Response, Patient Transport, Calm Decision Making',
                'top_employers' => 'Ambulance Services, Hospitals, Emergency Response Teams, Disaster Response Units',
                'image' => 'images/careers/healthcare-allied-medical/emergency-medical-technician.svg'
            ]
        ];

        $future_scope = "Healthcare and allied medical careers have strong future scope because hospitals, diagnostics, digital health, medical imaging, public health, critical care, rehabilitation, elder care, and preventive healthcare are growing rapidly.";

        foreach ($careers as $careerData) {
            // Medical accuracy based roadmap logic
            $isDoctor = in_array($careerData['slug'], ['anaesthesiologist', 'dermatologist', 'orthodontist']);
            
            $roadmap = [
                "Step 1: Complete 10+2 with Science PCB (Physics, Chemistry, Biology).",
                $isDoctor ? "Step 2: Pursue " . ($careerData['slug'] == 'orthodontist' ? 'BDS' : 'MBBS') . " degree followed by relevant PG specialization (MD/MDS/DNB)." : "Step 2: Pursue required degree (B.Sc/B.Optom/BASLP) or diploma in " . $careerData['title'] . " or related field.",
                "Step 3: Complete mandatory internship, clinical training, lab rotations, or hospital posting.",
                "Step 4: Register with the relevant Medical/Dental/Nursing/Paramedical Council or Authority.",
                "Step 5: Start as a junior " . strtolower($careerData['title']) . " or resident in a hospital, clinic, or diagnostic center.",
                "Step 6: Grow into a specialist, consultant, department head, or senior practitioner with experience."
            ];

            Career::updateOrCreate(
                ['slug' => $careerData['slug']],
                [
                    'field_id' => $field->id,
                    'name' => $careerData['title'],
                    'sub_domain' => $careerData['domain'],
                    'description' => $careerData['short_info'],
                    'salary_range' => $careerData['salary_range'],
                    'demand_level' => $careerData['demand_level'],
                    'qualification' => $careerData['qualification'],
                    'stream' => $careerData['preferred_stream'],
                    'skills' => array_map('trim', explode(',', $careerData['key_skills'])),
                    'entrance_exams' => array_map('trim', explode(',', $careerData['entrance_exams'])),
                    'roadmap' => $roadmap,
                    'future_scope' => $future_scope . "\n\nNote: Eligibility, licensing, and registration rules may vary by state, council, and institution. Students should verify from official admission/recruitment notifications.",
                    'job_opportunities' => array_map('trim', explode(',', $careerData['top_employers'])),
                    'image' => $careerData['image']
                ]
            );
        }

        $this->command->info('Healthcare & Allied Medical careers seeded successfully.');
    }
}
