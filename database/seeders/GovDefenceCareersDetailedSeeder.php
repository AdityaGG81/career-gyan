<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Career;
use App\Models\Field;
use Illuminate\Support\Str;

class GovDefenceCareersDetailedSeeder extends Seeder
{
    public function run(): void
    {
        $fieldId = 11; // government-defence

        $careers = [
            // Civil Services & Administration
            [
                'name' => 'IAS Officer',
                'sub_domain' => 'Civil Services & Administration',
                'description' => 'The Indian Administrative Service (IAS) is the premier administrative civil service of the Government of India. IAS officers hold key positions in the union government, state governments, and public sector undertakings.',
                'qualification' => 'Any Graduate',
                'stream' => 'Any Stream',
                'salary_range' => '₹56,100 - ₹2,50,000 per month',
                'demand_level' => 'Very High',
                'icon' => 'fa-building-columns',
                'skills' => ['Administration', 'Leadership', 'Policy Making', 'Decision Making', 'Public Relations'],
                'roadmap' => [
                    'Complete Graduation in any stream.',
                    'Clear UPSC Civil Services Preliminary Examination.',
                    'Clear UPSC Civil Services Main Examination.',
                    'Qualify the Personality Test (Interview).',
                    'Complete training at LBSNAA, Mussoorie.'
                ],
                'future_scope' => 'IAS officers rise to highest positions like Cabinet Secretary or Chief Secretary, influencing national and state policies.',
                'entrance_exams' => ['UPSC Civil Services Exam (CSE)'],
                'job_opportunities' => ['Central Government', 'State Governments', 'Public Sector Undertakings'],
            ],
            [
                'name' => 'IPS Officer',
                'sub_domain' => 'Civil Services & Administration',
                'description' => 'The Indian Police Service (IPS) is responsible for maintaining law and order, public safety, and crime prevention in the country.',
                'qualification' => 'Any Graduate',
                'stream' => 'Any Stream',
                'salary_range' => '₹56,100 - ₹2,25,000 per month',
                'demand_level' => 'High',
                'icon' => 'fa-shield-halved',
                'skills' => ['Law Enforcement', 'Physical Fitness', 'Crisis Management', 'Investigation', 'Leadership'],
                'roadmap' => [
                    'Complete Graduation.',
                    'Clear UPSC Civil Services Exam (CSE).',
                    'Qualify Physical Standards and Physical Efficiency Test.',
                    'Complete training at Sardar Vallabhbhai Patel National Police Academy (SVPNPA).'
                ],
                'future_scope' => 'Promotion to Director General of Police (DGP) or Director of CBI/IB.',
                'entrance_exams' => ['UPSC CSE'],
                'job_opportunities' => ['State Police', 'Central Armed Police Forces', 'Intelligence Bureau', 'CBI'],
            ],
            [
                'name' => 'IFS Officer',
                'sub_domain' => 'Civil Services & Administration',
                'description' => 'The Indian Foreign Service (IFS) represents India on the international stage, managing diplomatic relations and foreign policy.',
                'qualification' => 'Any Graduate',
                'stream' => 'Any Stream',
                'salary_range' => '₹56,100 - ₹2,50,000 (Plus Foreign Allowances)',
                'demand_level' => 'High',
                'icon' => 'fa-earth-americas',
                'skills' => ['Diplomacy', 'Languages', 'International Relations', 'Negotiation', 'Analytical Thinking'],
                'roadmap' => [
                    'Complete Graduation.',
                    'Clear UPSC Civil Services Exam with high rank.',
                    'Complete training at Sushma Swaraj Institute of Foreign Service.'
                ],
                'future_scope' => 'Ambassador or High Commissioner to foreign countries, Foreign Secretary of India.',
                'entrance_exams' => ['UPSC CSE'],
                'job_opportunities' => ['Ministry of External Affairs', 'Indian Embassies Abroad', 'United Nations'],
            ],
            [
                'name' => 'IRS Officer',
                'sub_domain' => 'Civil Services & Administration',
                'description' => 'The Indian Revenue Service (IRS) is responsible for the administration and collection of direct and indirect taxes for the Government of India.',
                'qualification' => 'Any Graduate',
                'stream' => 'Any Stream',
                'salary_range' => '₹56,100 - ₹2,25,000 per month',
                'demand_level' => 'Moderate',
                'icon' => 'fa-money-bill-trend-up',
                'skills' => ['Accounting', 'Taxation Law', 'Auditing', 'Investigation', 'Financial Analysis'],
                'roadmap' => [
                    'Complete Graduation.',
                    'Clear UPSC Civil Services Exam.',
                    'Complete training at NADT (Direct Taxes) or NACIN (Indirect Taxes).'
                ],
                'future_scope' => 'Chairman of CBDT or CBIC, high-level policy positions in Finance Ministry.',
                'entrance_exams' => ['UPSC CSE'],
                'job_opportunities' => ['Income Tax Department', 'Customs & Central Excise Department'],
            ],
            [
                'name' => 'IAAS Officer',
                'sub_domain' => 'Civil Services & Administration',
                'description' => 'The Indian Audit and Accounts Service (IAAS) manages the accounts and audits of the Central and State governments.',
                'qualification' => 'Any Graduate',
                'stream' => 'Any Stream',
                'salary_range' => '₹56,100 - ₹2,25,000 per month',
                'demand_level' => 'Moderate',
                'icon' => 'fa-calculator',
                'skills' => ['Auditing', 'Financial Management', 'Public Finance', 'Legal Knowledge'],
                'roadmap' => [
                    'Complete Graduation.',
                    'Clear UPSC Civil Services Exam.',
                    'Complete training at National Academy of Audit and Accounts.'
                ],
                'future_scope' => 'Deputy Comptroller and Auditor General (CAG).',
                'entrance_exams' => ['UPSC CSE'],
                'job_opportunities' => ['Comptroller and Auditor General of India (CAG)'],
            ],
            [
                'name' => 'IRTS Officer',
                'sub_domain' => 'Civil Services & Administration',
                'description' => 'The Indian Railway Traffic Service (IRTS) is responsible for the operations and commercial aspects of Indian Railways.',
                'qualification' => 'Any Graduate',
                'stream' => 'Any Stream',
                'salary_range' => '₹56,100 - ₹2,25,000 per month',
                'demand_level' => 'Moderate',
                'icon' => 'fa-train-subway',
                'skills' => ['Logistics', 'Operations Management', 'Public Relations', 'Safety Management'],
                'roadmap' => [
                    'Complete Graduation.',
                    'Clear UPSC Civil Services Exam.',
                    'Complete training at Indian Railways Institute of Transport Management (IRITM).'
                ],
                'future_scope' => 'General Manager or Board Member of Indian Railways.',
                'entrance_exams' => ['UPSC CSE'],
                'job_opportunities' => ['Ministry of Railways', 'Public Sector Logistics Firms'],
            ],

            // Revenue, Taxation & Audit
            [
                'name' => 'Income Tax Inspector',
                'sub_domain' => 'Revenue, Taxation & Audit',
                'description' => 'Responsible for assessing income tax returns, conducting raids, and ensuring tax compliance.',
                'qualification' => 'Graduation',
                'stream' => 'Any Stream',
                'salary_range' => '₹44,900 - ₹1,42,400 per month',
                'demand_level' => 'High',
                'icon' => 'fa-file-invoice-dollar',
                'skills' => ['Data Analysis', 'Tax Laws', 'Investigation', 'Documentation'],
                'roadmap' => [
                    'Graduate in any discipline.',
                    'Clear SSC CGL Tier-I and Tier-II exams.',
                    'Pass Computer Proficiency Test (CPT).'
                ],
                'future_scope' => 'Promotion to Income Tax Officer (ITO) and Assistant Commissioner.',
                'entrance_exams' => ['SSC Combined Graduate Level (CGL)'],
                'job_opportunities' => ['Income Tax Department'],
            ],
            [
                'name' => 'GST Inspector',
                'sub_domain' => 'Revenue, Taxation & Audit',
                'description' => 'Ensures businesses comply with Goods and Services Tax regulations through auditing and inspections.',
                'qualification' => 'Graduation',
                'stream' => 'Any Stream',
                'salary_range' => '₹44,900 - ₹1,42,400 per month',
                'demand_level' => 'High',
                'icon' => 'fa-percent',
                'skills' => ['Auditing', 'GST Compliance', 'Analytical Thinking', 'Teamwork'],
                'roadmap' => [
                    'Graduate in any discipline.',
                    'Clear SSC CGL Exam.',
                    'Qualify Physical Standards (if required for field work).'
                ],
                'future_scope' => 'Promotion to Superintendent and Assistant Commissioner (GST).',
                'entrance_exams' => ['SSC CGL'],
                'job_opportunities' => ['Central Board of Indirect Taxes and Customs (CBIC)'],
            ],
            [
                'name' => 'Customs Officer',
                'sub_domain' => 'Revenue, Taxation & Audit',
                'description' => 'Monitors imports and exports at airports and seaports to prevent smuggling and collect duties.',
                'qualification' => 'Graduation',
                'stream' => 'Any Stream',
                'salary_range' => '₹44,900 - ₹1,42,400 per month',
                'demand_level' => 'Moderate',
                'icon' => 'fa-ship',
                'skills' => ['Vigilance', 'Investigation', 'Customs Laws', 'Physical Alertness'],
                'roadmap' => [
                    'Graduate in any discipline.',
                    'Clear SSC CGL Exam for Preventive Officer or Examiner posts.'
                ],
                'future_scope' => 'Promotion to Superintendent and Assistant Commissioner.',
                'entrance_exams' => ['SSC CGL'],
                'job_opportunities' => ['Airports Authority of India', 'Indian Ports', 'Customs Department'],
            ],
            [
                'name' => 'CAG Auditor',
                'sub_domain' => 'Revenue, Taxation & Audit',
                'description' => 'Audits the expenditures and revenues of government departments to ensure transparency and accountability.',
                'qualification' => 'Graduation',
                'stream' => 'Commerce/Finance preferred',
                'salary_range' => '₹29,200 - ₹92,300 per month',
                'demand_level' => 'Moderate',
                'icon' => 'fa-magnifying-glass-chart',
                'skills' => ['Auditing', 'Report Writing', 'Attention to Detail', 'Finance Knowledge'],
                'roadmap' => [
                    'Graduate in any discipline (B.Com/CA Inter is a plus).',
                    'Clear SSC CGL Exam for Auditor posts.'
                ],
                'future_scope' => 'Promotion to Senior Auditor and Assistant Audit Officer (AAO).',
                'entrance_exams' => ['SSC CGL'],
                'job_opportunities' => ['Comptroller and Auditor General of India (CAG)'],
            ],
            [
                'name' => 'Enforcement Officer (ED)',
                'sub_domain' => 'Revenue, Taxation & Audit',
                'description' => 'Investigates money laundering and foreign exchange violations (PMLA and FEMA cases).',
                'qualification' => 'Graduation',
                'stream' => 'Any Stream',
                'salary_range' => '₹47,600 - ₹1,51,100 per month',
                'demand_level' => 'High',
                'icon' => 'fa-user-secret',
                'skills' => ['Financial Investigation', 'Legal Research', 'Cyber Forensics', 'Surveillance'],
                'roadmap' => [
                    'Graduate in any discipline.',
                    'Clear UPSC EPFO Enforcement Officer Exam or SSC CGL (for SI in ED).'
                ],
                'future_scope' => 'Promotion to Assistant Director and Deputy Director in Enforcement Directorate.',
                'entrance_exams' => ['UPSC EPFO EO/AO Exam', 'SSC CGL'],
                'job_opportunities' => ['Enforcement Directorate'],
            ],

            // Police & Law Enforcement
            [
                'name' => 'Sub-Inspector (State Police)',
                'sub_domain' => 'Police & Law Enforcement',
                'description' => 'In charge of a police station or a sub-unit, responsible for local crime control and order.',
                'qualification' => 'Graduation',
                'stream' => 'Any Stream',
                'salary_range' => '₹35,400 - ₹1,12,400 per month',
                'demand_level' => 'Very High',
                'icon' => 'fa-shield',
                'skills' => ['Investigation', 'Leadership', 'Physical Endurance', 'Local Language'],
                'roadmap' => [
                    'Graduate in any discipline.',
                    'Clear State Police Sub-Inspector Exam (Written).',
                    'Pass Physical Measurement and Efficiency Test (PMT/PET).',
                    'Qualify Interview/Medical Exam.'
                ],
                'future_scope' => 'Promotion to Inspector, DSP, and SP.',
                'entrance_exams' => ['State-wise SI Exams', 'SSC CPO (for Delhi Police)'],
                'job_opportunities' => ['State Police Departments', 'Delhi Police'],
            ],
            [
                'name' => 'CBI Agent',
                'sub_domain' => 'Police & Law Enforcement',
                'description' => 'Investigates high-profile crimes, corruption, and economic offenses at the national level.',
                'qualification' => 'Graduation',
                'stream' => 'Any Stream',
                'salary_range' => '₹44,900 - ₹1,42,400 per month',
                'demand_level' => 'High',
                'icon' => 'fa-fingerprint',
                'skills' => ['Criminal Investigation', 'Interrogation', 'Critical Thinking', 'Legal Knowledge'],
                'roadmap' => [
                    'Graduate in any discipline.',
                    'Clear SSC CGL Exam for Sub-Inspector in CBI post.',
                    'Pass Physical and Medical standards.'
                ],
                'future_scope' => 'Promotion to Inspector, DSP, and higher ranks in CBI.',
                'entrance_exams' => ['SSC CGL'],
                'job_opportunities' => ['Central Bureau of Investigation'],
            ],
            [
                'name' => 'Intelligence Bureau (IB) Officer',
                'sub_domain' => 'Police & Law Enforcement',
                'description' => 'Collects internal intelligence and conducts counter-intelligence and counter-terrorism operations.',
                'qualification' => 'Graduation',
                'stream' => 'Any Stream',
                'salary_range' => '₹44,900 - ₹1,42,400 per month',
                'demand_level' => 'High',
                'icon' => 'fa-mask',
                'skills' => ['Intelligence Gathering', 'Cyber Security', 'Surveillance', 'Foreign Languages'],
                'roadmap' => [
                    'Graduate in any discipline.',
                    'Clear IB ACIO (Assistant Central Intelligence Officer) Exam.',
                    'Qualify Psychometric Test and Interview.'
                ],
                'future_scope' => 'Senior Intelligence Officer, Deputy Director.',
                'entrance_exams' => ['IB ACIO Exam'],
                'job_opportunities' => ['Intelligence Bureau (MHA)'],
            ],
            [
                'name' => 'NIA Investigator',
                'sub_domain' => 'Police & Law Enforcement',
                'description' => 'Investigates offenses related to terrorism and national security across state borders.',
                'qualification' => 'Graduation',
                'stream' => 'Any Stream',
                'salary_range' => '₹44,900 - ₹1,42,400 per month',
                'demand_level' => 'High',
                'icon' => 'fa-user-ninja',
                'skills' => ['Counter-Terrorism', 'Forensics', 'Evidence Collection', 'Bravery'],
                'roadmap' => [
                    'Graduate in any discipline.',
                    'Clear SSC CGL for SI in NIA post.'
                ],
                'future_scope' => 'Specialization in terrorism investigation and national security advisory.',
                'entrance_exams' => ['SSC CGL'],
                'job_opportunities' => ['National Investigation Agency'],
            ],
            [
                'name' => 'RPF Inspector',
                'sub_domain' => 'Police & Law Enforcement',
                'description' => 'Protects railway property and ensures safety of passengers in trains and at stations.',
                'qualification' => 'Graduation',
                'stream' => 'Any Stream',
                'salary_range' => '₹35,400 - ₹1,12,400 per month',
                'demand_level' => 'Moderate',
                'icon' => 'fa-train-tram',
                'skills' => ['Security Management', 'Public Safety', 'Crowd Control', 'Physical Fitness'],
                'roadmap' => [
                    'Graduate in any discipline.',
                    'Clear RPF Sub-Inspector Recruitment Exam.',
                    'Qualify PET/PMT and Interview.'
                ],
                'future_scope' => 'Promotion to Circle Inspector and Zonal Security Commissioner.',
                'entrance_exams' => ['RPF SI Exam'],
                'job_opportunities' => ['Railway Protection Force'],
            ],

            // Defence Forces
            [
                'name' => 'Army Officer',
                'sub_domain' => 'Defence Forces',
                'description' => 'Commands soldiers and manages land-based military operations to defend the nation.',
                'qualification' => '12th (for NDA) / Graduation (for CDS)',
                'stream' => 'Science/Any Stream',
                'salary_range' => '₹56,100 - ₹2,50,000 per month',
                'demand_level' => 'Very High',
                'icon' => 'fa-person-military-pointing',
                'skills' => ['Tactical Planning', 'Leadership', 'Extreme Physical Fitness', 'Mental Resilience'],
                'roadmap' => [
                    'Pass 12th or Graduate.',
                    'Clear NDA or CDS Written Examination.',
                    'Clear SSB (Services Selection Board) Interview (5 days).',
                    'Qualify Medical Exam and complete training at IMA or OTA.'
                ],
                'future_scope' => 'Promotion to General, Chief of Army Staff.',
                'entrance_exams' => ['NDA', 'CDS', 'AFCAT (for ground duty)', 'Technical Graduate Course (TGC)'],
                'job_opportunities' => ['Indian Army'],
            ],
            [
                'name' => 'Navy Officer',
                'sub_domain' => 'Defence Forces',
                'description' => 'Manages naval operations, fleet maintenance, and maritime security.',
                'qualification' => '12th (Science) / B.E./B.Tech',
                'stream' => 'Science / Engineering',
                'salary_range' => '₹56,100 - ₹2,50,000 per month',
                'demand_level' => 'High',
                'icon' => 'fa-anchor',
                'skills' => ['Navigation', 'Marine Engineering', 'Strategic Thinking', 'Discipline'],
                'roadmap' => [
                    'Pass 12th with PCM or B.E./B.Tech.',
                    'Clear NDA or CDS/INET Exam.',
                    'Qualify SSB Interview.',
                    'Complete training at Indian Naval Academy (INA).'
                ],
                'future_scope' => 'Promotion to Admiral, Chief of Naval Staff.',
                'entrance_exams' => ['NDA', 'CDS', 'INET'],
                'job_opportunities' => ['Indian Navy'],
            ],
            [
                'name' => 'Air Force Officer',
                'sub_domain' => 'Defence Forces',
                'description' => 'Flies combat or transport aircraft and manages aerospace defense systems.',
                'qualification' => '12th (Science) / Graduation',
                'stream' => 'Science / Engineering',
                'salary_range' => '₹56,100 - ₹2,50,000 per month',
                'demand_level' => 'Very High',
                'icon' => 'fa-plane-up',
                'skills' => ['Piloting', 'Aerodynamics', 'Quick Reflexes', 'Technological Proficiency'],
                'roadmap' => [
                    'Pass 12th with PCM or Graduation.',
                    'Clear NDA or AFCAT (Air Force Common Admission Test).',
                    'Pass SSB and CPSS (Computerised Pilot Selection System).',
                    'Complete training at Air Force Academy.'
                ],
                'future_scope' => 'Promotion to Air Chief Marshal.',
                'entrance_exams' => ['NDA', 'AFCAT', 'CDS'],
                'job_opportunities' => ['Indian Air Force'],
            ],
            [
                'name' => 'Coast Guard Officer',
                'sub_domain' => 'Defence Forces',
                'description' => 'Ensures maritime safety and enforces laws in India\'s territorial waters.',
                'qualification' => '12th (Science) / Graduation',
                'stream' => 'Science / Engineering',
                'salary_range' => '₹56,100 - ₹2,25,000 per month',
                'demand_level' => 'Moderate',
                'icon' => 'fa-life-ring',
                'skills' => ['Coastal Security', 'Search & Rescue', 'Maritime Law', 'Team Coordination'],
                'roadmap' => [
                    'Graduate with Math and Physics in 12th.',
                    'Clear ICG Assistant Commandant Recruitment.',
                    'Qualify Preliminary and Final Selection Board (PSB/FSB).'
                ],
                'future_scope' => 'Director General of Coast Guard.',
                'entrance_exams' => ['ICG Assistant Commandant Exam'],
                'job_opportunities' => ['Indian Coast Guard'],
            ],
            [
                'name' => 'Short Service Commission (SSC) Officer',
                'sub_domain' => 'Defence Forces',
                'description' => 'Serves in the Armed Forces for a specified period (usually 10-14 years) as an officer.',
                'qualification' => 'Graduation / Professional Degree',
                'stream' => 'Any Stream',
                'salary_range' => '₹56,100 - ₹1,77,500 per month',
                'demand_level' => 'Moderate',
                'icon' => 'fa-clock-rotate-left',
                'skills' => ['Leadership', 'Operational Skills', 'Discipline', 'Adaptability'],
                'roadmap' => [
                    'Graduate in any stream.',
                    'Clear CDS (for SSC entry) or apply for direct entry (NCC/Technical).',
                    'Qualify SSB Interview.',
                    'Complete 11 months training at OTA Chennai.'
                ],
                'future_scope' => 'Post-service opportunities in corporate security, management, or permanent commission.',
                'entrance_exams' => ['CDS', 'NCC Direct Entry'],
                'job_opportunities' => ['Army', 'Navy', 'Air Force'],
            ],

            // Banking & Public Sector
            [
                'name' => 'Bank PO (Probationary Officer)',
                'sub_domain' => 'Banking & Public Sector',
                'description' => 'Entry-level officer in commercial banks responsible for operations, loans, and customer relations.',
                'qualification' => 'Graduation',
                'stream' => 'Any Stream',
                'salary_range' => '₹45,000 - ₹65,000 per month',
                'demand_level' => 'Very High',
                'icon' => 'fa-building-columns',
                'skills' => ['Customer Service', 'Financial Literacy', 'Sales', 'Communication'],
                'roadmap' => [
                    'Graduate in any discipline.',
                    'Clear Bank PO Prelims and Mains Exam.',
                    'Qualify Interview.'
                ],
                'future_scope' => 'Promotion to Manager, AGM, and Chairman of the Bank.',
                'entrance_exams' => ['IBPS PO', 'SBI PO'],
                'job_opportunities' => ['Public Sector Banks (SBI, PNB, BoB, etc.)'],
            ],
            [
                'name' => 'RBI Grade B Officer',
                'sub_domain' => 'Banking & Public Sector',
                'description' => 'Highly prestigious role in the central bank involved in monetary policy and financial regulation.',
                'qualification' => 'Graduation (60% min)',
                'stream' => 'Any Stream',
                'salary_range' => '₹1,08,000 - ₹1,20,000 per month',
                'demand_level' => 'Very High',
                'icon' => 'fa-piggy-bank',
                'skills' => ['Economics', 'Finance', 'Policy Analysis', 'General Awareness'],
                'roadmap' => [
                    'Graduate with high percentage.',
                    'Clear RBI Grade B Phase 1 and Phase 2 Exam.',
                    'Qualify Interview.'
                ],
                'future_scope' => 'Executive Director, Deputy Governor of RBI.',
                'entrance_exams' => ['RBI Grade B Exam'],
                'job_opportunities' => ['Reserve Bank of India'],
            ],
            [
                'name' => 'LIC AAO',
                'sub_domain' => 'Banking & Public Sector',
                'description' => 'Assistant Administrative Officer in Life Insurance Corporation, managing policy administration and claims.',
                'qualification' => 'Graduation',
                'stream' => 'Any Stream',
                'salary_range' => '₹53,600 - ₹1,02,000 per month',
                'demand_level' => 'Moderate',
                'icon' => 'fa-handshake-angle',
                'skills' => ['Insurance Knowledge', 'Administration', 'Data Analysis', 'Ethics'],
                'roadmap' => [
                    'Graduate in any discipline.',
                    'Clear LIC AAO Prelims and Mains Exam.',
                    'Qualify Interview.'
                ],
                'future_scope' => 'Zonal Manager, Director in LIC.',
                'entrance_exams' => ['LIC AAO Exam'],
                'job_opportunities' => ['Life Insurance Corporation of India'],
            ],
            [
                'name' => 'NABARD Grade A Officer',
                'sub_domain' => 'Banking & Public Sector',
                'description' => 'Officer in National Bank for Agriculture and Rural Development, focused on rural growth.',
                'qualification' => 'Graduation',
                'stream' => 'Agriculture / Any Stream',
                'salary_range' => '₹62,000 - ₹80,000 per month',
                'demand_level' => 'Moderate',
                'icon' => 'fa-wheat-awn',
                'skills' => ['Rural Development', 'Agricultural Finance', 'Policy Execution', 'Communication'],
                'roadmap' => [
                    'Graduate in relevant stream.',
                    'Clear NABARD Grade A Phase 1 and Phase 2.',
                    'Qualify Interview.'
                ],
                'future_scope' => 'High-level impact on India\'s rural economy and agrarian policies.',
                'entrance_exams' => ['NABARD Grade A Exam'],
                'job_opportunities' => ['NABARD'],
            ],
            [
                'name' => 'EPFO Commissioner',
                'sub_domain' => 'Banking & Public Sector',
                'description' => 'Assistant Provident Fund Commissioner managing employee provident funds and social security schemes.',
                'qualification' => 'Graduation',
                'stream' => 'Any Stream',
                'salary_range' => '₹56,100 - ₹1,77,500 per month',
                'demand_level' => 'Moderate',
                'icon' => 'fa-users-gear',
                'skills' => ['Labor Laws', 'Industrial Relations', 'Social Security Administration', 'Legal Knowledge'],
                'roadmap' => [
                    'Graduate in any discipline.',
                    'Clear UPSC EPFO APFC Exam.',
                    'Qualify Interview.'
                ],
                'future_scope' => 'Regional PF Commissioner, Central PF Commissioner.',
                'entrance_exams' => ['UPSC EPFO APFC Exam'],
                'job_opportunities' => ['Employees\' Provident Fund Organisation'],
            ],

            // Judiciary & Legal
            [
                'name' => 'Civil Judge (PCS-J)',
                'sub_domain' => 'Judiciary & Legal',
                'description' => 'Presides over civil cases in District Courts, delivering justice based on civil laws.',
                'qualification' => 'LL.B. (3 or 5 years)',
                'stream' => 'Law',
                'salary_range' => '₹77,840 - ₹1,36,520 per month',
                'demand_level' => 'High',
                'icon' => 'fa-gavel',
                'skills' => ['Legal Interpretation', 'Impartiality', 'Critical Thinking', 'Patience'],
                'roadmap' => [
                    'Complete LL.B. degree.',
                    'Register with Bar Council.',
                    'Clear State Judiciary Exam (PCS-J) - Prelims, Mains, and Interview.'
                ],
                'future_scope' => 'Promotion to District Judge, High Court Judge.',
                'entrance_exams' => ['State Judiciary Exams'],
                'job_opportunities' => ['District Courts', 'High Courts'],
            ],
            [
                'name' => 'Public Prosecutor',
                'sub_domain' => 'Judiciary & Legal',
                'description' => 'Represents the government in criminal trials, arguing cases against the accused.',
                'qualification' => 'LL.B. + 7 years experience (for higher posts)',
                'stream' => 'Law',
                'salary_range' => '₹56,100 - ₹1,77,500 per month',
                'demand_level' => 'Moderate',
                'icon' => 'fa-user-tie',
                'skills' => ['Litigation', 'Evidence Analysis', 'Oratory', 'Criminal Law'],
                'roadmap' => [
                    'Complete LL.B. degree.',
                    'Practice as an advocate.',
                    'Clear Assistant Public Prosecutor (APP) or Public Prosecutor (PP) Exam.'
                ],
                'future_scope' => 'Director of Prosecution, Legal Advisor to Government.',
                'entrance_exams' => ['State Public Service Commission Exams', 'UPSC (for CBI PP)'],
                'job_opportunities' => ['Central/State Prosecution Departments', 'CBI'],
            ],
            [
                'name' => 'JAG Officer (Army Legal)',
                'sub_domain' => 'Judiciary & Legal',
                'description' => 'The Judge Advocate General\'s Department is the legal branch of the Indian Army.',
                'qualification' => 'LL.B. (55% min)',
                'stream' => 'Law',
                'salary_range' => '₹56,100 - ₹2,25,000 per month',
                'demand_level' => 'Moderate',
                'icon' => 'fa-scale-balanced',
                'skills' => ['Military Law', 'Discipline', 'Legal Advice', 'Courts Martial'],
                'roadmap' => [
                    'Complete LL.B. degree with 55% aggregate.',
                    'Apply for JAG Entry Scheme.',
                    'Clear SSB Interview.',
                    'Qualify Medical and join OTA Chennai for training.'
                ],
                'future_scope' => 'Promotion to Major General (JAG).',
                'entrance_exams' => ['JAG Entry (Interview based)'],
                'job_opportunities' => ['Indian Army'],
            ],

            // Railway & Infrastructure
            [
                'name' => 'Railway Station Master',
                'sub_domain' => 'Railway & Infrastructure',
                'description' => 'In charge of the daily operations and safety at a railway station.',
                'qualification' => 'Graduation',
                'stream' => 'Any Stream',
                'salary_range' => '₹35,400 - ₹1,12,400 per month',
                'demand_level' => 'High',
                'icon' => 'fa-house-chimney-window',
                'skills' => ['Management', 'Safety Coordination', 'Communication', 'Technical Awareness'],
                'roadmap' => [
                    'Graduate in any discipline.',
                    'Clear RRB NTPC Exam (CBT 1 & 2).',
                    'Qualify Aptitude Test (Psychometric).',
                    'Medical Fitness Exam.'
                ],
                'future_scope' => 'Promotion to Station Superintendent and Operations Manager.',
                'entrance_exams' => ['RRB NTPC'],
                'job_opportunities' => ['Indian Railways'],
            ],
            [
                'name' => 'Loco Pilot',
                'sub_domain' => 'Railway & Infrastructure',
                'description' => 'Operates trains (engines) and ensures safe transit of passengers and freight.',
                'qualification' => '10th + ITI / Diploma / Degree in Engineering',
                'stream' => 'Mechanical/Electrical/Auto Engineering',
                'salary_range' => '₹19,900 - ₹63,200 per month (Plus heavy mileage allowances)',
                'demand_level' => 'High',
                'icon' => 'fa-steam-symbol',
                'skills' => ['Machine Operation', 'Vigilance', 'Technical Troubleshooting', 'Focus'],
                'roadmap' => [
                    '10th + ITI or Engineering Diploma/Degree.',
                    'Clear RRB ALP (Assistant Loco Pilot) Exam.',
                    'Qualify Computer Based Aptitude Test (CBAT).',
                    'A-1 Category Medical Test.'
                ],
                'future_scope' => 'Promotion to Senior Loco Pilot and Loco Inspector.',
                'entrance_exams' => ['RRB ALP'],
                'job_opportunities' => ['Indian Railways', 'Metro Rail Corporations'],
            ],
            [
                'name' => 'Section Engineer (Railways)',
                'sub_domain' => 'Railway & Infrastructure',
                'description' => 'Supervises maintenance and construction projects in railway tracks, bridges, and signals.',
                'qualification' => 'B.E./B.Tech',
                'stream' => 'Civil/Electrical/Mechanical/S&T',
                'salary_range' => '₹44,900 - ₹1,42,400 per month',
                'demand_level' => 'Moderate',
                'icon' => 'fa-gears',
                'skills' => ['Engineering Design', 'Project Supervision', 'Safety Compliance', 'Budgeting'],
                'roadmap' => [
                    'B.E./B.Tech in relevant engineering stream.',
                    'Clear RRB SSE (Senior Section Engineer) or JE Exam.'
                ],
                'future_scope' => 'Assistant Divisional Engineer (ADEN).',
                'entrance_exams' => ['RRB SSE/JE'],
                'job_opportunities' => ['Indian Railways'],
            ],

            // Para-Military Forces
            [
                'name' => 'BSF Commandant',
                'sub_domain' => 'Para-Military Forces',
                'description' => 'High-ranking officer in Border Security Force, guarding India\'s borders.',
                'qualification' => 'Graduation',
                'stream' => 'Any Stream',
                'salary_range' => '₹78,800 - ₹2,09,200 per month',
                'demand_level' => 'Moderate',
                'icon' => 'fa-tent',
                'skills' => ['Border Management', 'Leadership', 'Survival Skills', 'Strategy'],
                'roadmap' => [
                    'Graduate in any discipline.',
                    'Clear UPSC CAPF (Assistant Commandant) Exam.',
                    'Qualify Physical and Medical Tests.',
                    'Pass SSB/Interview and complete training.'
                ],
                'future_scope' => 'Inspector General (IG) and Director General (DG) of BSF.',
                'entrance_exams' => ['UPSC CAPF (AC)'],
                'job_opportunities' => ['Border Security Force (BSF)'],
            ],
            [
                'name' => 'CRPF Officer',
                'sub_domain' => 'Para-Military Forces',
                'description' => 'Officer in Central Reserve Police Force, specialized in internal security and counter-insurgency.',
                'qualification' => 'Graduation',
                'stream' => 'Any Stream',
                'salary_range' => '₹56,100 - ₹2,25,000 per month',
                'demand_level' => 'High',
                'icon' => 'fa-person-military-rifle',
                'skills' => ['Internal Security', 'Tactical Operations', 'Public Management', 'Bravery'],
                'roadmap' => [
                    'Graduate in any discipline.',
                    'Clear UPSC CAPF (AC) Exam.',
                    'Pass Physical and Medical standards.'
                ],
                'future_scope' => 'Involvement in sensitive internal security missions, promotion to higher command.',
                'entrance_exams' => ['UPSC CAPF (AC)'],
                'job_opportunities' => ['Central Reserve Police Force (CRPF)'],
            ],
            [
                'name' => 'CISF Inspector',
                'sub_domain' => 'Para-Military Forces',
                'description' => 'Ensures security of industrial units, airports, and major government infrastructure.',
                'qualification' => 'Graduation',
                'stream' => 'Any Stream',
                'salary_range' => '₹35,400 - ₹1,12,400 per month',
                'demand_level' => 'Moderate',
                'icon' => 'fa-building-shield',
                'skills' => ['Security Auditing', 'Industrial Safety', 'Surveillance', 'Access Control'],
                'roadmap' => [
                    'Graduate in any discipline.',
                    'Clear SSC CPO Exam for SI in CISF or UPSC CAPF for AC in CISF.'
                ],
                'future_scope' => 'Promotion to Assistant Commandant, Deputy Commandant.',
                'entrance_exams' => ['SSC CPO', 'UPSC CAPF'],
                'job_opportunities' => ['Central Industrial Security Force (CISF)'],
            ],
        ];

        foreach ($careers as $c) {
            $slugName = strtolower(str_replace([' ', '&', '(', ')'], ['-', '', '', ''], $c['name']));
            $slugName = str_replace('--', '-', $slugName);
            
            Career::updateOrCreate(
                ['slug' => $slugName],
                [
                    'name' => $c['name'],
                    'field_id' => $fieldId,
                    'sub_domain' => $c['sub_domain'],
                    'description' => $c['description'],
                    'qualification' => $c['qualification'],
                    'stream' => $c['stream'],
                    'salary_range' => $c['salary_range'],
                    'demand_level' => $c['demand_level'],
                    'icon' => $c['icon'],
                    'skills' => $c['skills'],
                    'roadmap' => $c['roadmap'],
                    'future_scope' => $c['future_scope'],
                    'entrance_exams' => $c['entrance_exams'],
                    'job_opportunities' => $c['job_opportunities'],
                    'image' => '/images/careers/government-defence/' . $slugName . '.svg',
                ]
            );
        }
    }
}
