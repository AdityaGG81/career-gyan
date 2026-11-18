<?php

namespace Database\Seeders\States;

use App\Models\IndianCollege;
use App\Models\College;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class MaharashtraEnrichmentSeeder extends Seeder
{
    /**
     * Run the Maharashtra premier colleges and universities database enrichment seeder.
     */
    public function run(): void
    {
        $this->command?->info("🏛️  Enriching Maharashtra Premier Public & Private Universities and Degree Colleges...");

        $institutions = $this->getMaharashtraInstitutionsData();
        $fieldsMap = Field::pluck('id', 'slug')->toArray();

        $totalColleges = 0;
        $totalCourseRows = 0;
        $totalFeaturedColleges = 0;

        foreach ($institutions as $inst) {
            $totalColleges++;
            $collegeName = $inst['name'];

            // 1. Remove outdated/unverified stub duplicates if any
            DB::table('indian_colleges')
                ->where('state', 'Maharashtra')
                ->where(function ($q) use ($collegeName) {
                    $q->where('college_name', $collegeName)
                      ->orWhere('college_name', 'like', $collegeName . ' (%')
                      ->orWhere('college_name', 'like', '%(' . $collegeName . ')%');
                })
                ->delete();

            // 2. Insert course rows into indian_colleges table
            $courses = $inst['courses'] ?? [];
            if (empty($courses)) {
                $courses = [[
                    'course_name'            => 'General Degree Program',
                    'course_type'            => 'Under Graduate Course',
                    'is_professional'        => 'General Course',
                    'course_aided_unaided'   => str_contains(strtolower($inst['management'] ?? ''), 'gov') ? 'Aided' : 'Un-Aided',
                    'course_duration_months' => 36,
                    'course_category'        => 'General Education',
                ]];
            }

            foreach ($courses as $c) {
                $totalCourseRows++;
                IndianCollege::create([
                    'college_name'           => $collegeName,
                    'state'                  => 'Maharashtra',
                    'district'               => $inst['district'] ?? 'Mumbai',
                    'taluka'                 => $inst['taluka'] ?? $inst['district'] ?? 'Mumbai',
                    'university_type'        => $inst['university_type'] ?? 'State University',
                    'university_name'        => $inst['university_name'] ?? $collegeName,
                    'college_type'           => $inst['college_type'] ?? 'University / College',
                    'affiliation'            => $inst['affiliation'] ?? 'UGC Recognized',
                    'management'             => $inst['management'] ?? 'Private (Unaided)',
                    'website'                => $inst['website'] ?? null,
                    'year_of_establishment'  => $inst['year_of_establishment'] ?? null,
                    'address'                => $inst['address'] ?? null,
                    'city'                   => $inst['city'] ?? 'Mumbai',
                    'pin_code'               => $inst['pin_code'] ?? null,
                    'total_enrollment'       => $inst['total_enrollment'] ?? null,
                    'faculty_count'          => $inst['faculty_count'] ?? null,
                    'course_name'            => $c['course_name'],
                    'course_type'            => $c['course_type'] ?? 'Under Graduate Course',
                    'is_professional'        => $c['is_professional'] ?? 'General Course',
                    'course_aided_unaided'   => $c['course_aided_unaided'] ?? 'Un-Aided',
                    'course_duration_months' => $c['course_duration_months'] ?? 36,
                    'course_category'        => $c['course_category'] ?? 'General Education',
                ]);
            }

            // 3. Upsert into College model (for explore field pages)
            $fieldSlug = $inst['featured_field_slug'] ?? 'technology-engineering';
            $fieldId = $fieldsMap[$fieldSlug] ?? ($fieldsMap['technology-engineering'] ?? 4);

            College::updateOrCreate(
                [
                    'name'     => $collegeName,
                    'state'    => 'Maharashtra',
                    'field_id' => $fieldId,
                ],
                [
                    'location'                 => $inst['city'] ?? 'Mumbai',
                    'fees_range'               => $inst['fees_range'] ?? '₹40,000 – ₹2,50,000/yr',
                    'type'                     => str_contains(strtolower($inst['management'] ?? ''), 'gov') || str_contains(strtolower($inst['management'] ?? ''), 'central') ? 'Government' : 'Private',
                    'website'                  => $inst['website'] ?? null,
                    'rank'                     => $inst['nirf_rank'] ?? null,
                    'government_rank'          => $inst['nirf_rank'] ?? null,
                    'naac_grade'               => $inst['naac_grade'] ?? 'A+',
                    'popular_branches'         => $inst['popular_branches'] ?? implode(', ', array_slice(array_column($courses, 'course_name'), 0, 4)),
                    'cutoff'                   => $inst['cutoff'] ?? 'Based on MHT CET / JEE Main / NEET / CAT',
                    'placement_support'        => $inst['placement_support'] ?? 'Active central placement cell with top tier multinational recruiters',
                    'facilities'               => $inst['facilities'] ?? 'Central Library, Research Labs, Wi-Fi Campus, Modern Auditoriums, Hostels, Sports Complex',
                    'description'              => $inst['description'] ?? "{$collegeName} is an elite higher educational institution in Maharashtra offering world-class academic education and research opportunities.",
                    'average_package'          => $inst['average_package'] ?? '₹8.0 - ₹24.0 LPA',
                    'tier'                     => $inst['tier'] ?? 'Tier 1',
                    'duration'                 => '3 - 5 Years',
                    'specializations'          => $inst['specializations'] ?? 'Undergraduate, Postgraduate & Doctoral Degrees',
                    'research_support'         => 'Extensive funded research projects, international university MOUs, and innovation incubators',
                    'internship_opportunities' => 'Mandatory industrial training, corporate internships, and live research fellowships',
                ]
            );
            $totalFeaturedColleges++;
        }

        // Clear cache so new colleges appear in autocomplete and fuzzy search
        Cache::forget('indian_college_names');

        $this->command?->info("✅ Maharashtra Enrichment Completed: {$totalColleges} institutions enriched with {$totalCourseRows} course records and {$totalFeaturedColleges} featured colleges!");
    }

    /**
     * Get comprehensive dataset of Maharashtra's Premier Public & Private Universities and Degree Colleges.
     */
    private function getMaharashtraInstitutionsData(): array
    {
        return [
            // =========================================================================
            // 1. INSTITUTES OF NATIONAL IMPORTANCE & PREMIER CENTRAL INSTITUTIONS
            // =========================================================================
            [
                'name' => 'Indian Institute of Technology Bombay (IIT Bombay)',
                'district' => 'Mumbai Suburban',
                'taluka' => 'Powai',
                'city' => 'Mumbai',
                'pin_code' => '400076',
                'address' => 'Main Gate Road, IIT Area, Powai, Mumbai',
                'university_type' => 'Institute of National Importance (IoE)',
                'university_name' => 'Indian Institute of Technology Bombay',
                'college_type' => 'Institute of National Importance',
                'management' => 'Central Government',
                'website' => 'https://www.iitb.ac.in',
                'year_of_establishment' => 1958,
                'total_enrollment' => 13000,
                'faculty_count' => 710,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹2,10,000 – ₹2,50,000/yr',
                'nirf_rank' => 3,
                'naac_grade' => 'A++',
                'average_package' => '₹28.8 LPA',
                'popular_branches' => 'B.Tech Computer Science, Electrical, Mechanical, Aerospace, BS Economics, B.Des, MBA (SJMSOM)',
                'description' => 'IIT Bombay is India\'s top destination for JEE Advanced toppers, situated adjacent to Powai and Vihar lakes, celebrated globally for world-class tech innovation and entrepreneurship (Society for Innovation and Entrepreneurship - SINE).',
                'courses' => [
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Electrical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Mechanical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Aerospace Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Bachelor of Design (B.Des - IDC)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Design & Fine Arts'],
                    ['course_name' => 'Master of Business Administration (MBA - SJMSOM)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Management & Business Administration'],
                ],
            ],
            [
                'name' => 'Institute of Chemical Technology (ICT Mumbai)',
                'district' => 'Mumbai City',
                'taluka' => 'Matunga',
                'city' => 'Mumbai',
                'pin_code' => '400019',
                'address' => 'Nathalal Parekh Marg, Matunga East, Mumbai',
                'university_type' => 'Deemed to be University (Elite Status by Govt of Maharashtra)',
                'university_name' => 'Institute of Chemical Technology',
                'college_type' => 'Deemed University',
                'management' => 'State Government',
                'website' => 'https://www.ictmumbai.edu.in',
                'year_of_establishment' => 1933,
                'total_enrollment' => 3200,
                'faculty_count' => 180,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹85,000 – ₹1,20,000/yr',
                'nirf_rank' => 24,
                'naac_grade' => 'A++',
                'average_package' => '₹12.0 LPA',
                'popular_branches' => 'B.Chem.Engg, B.Tech Dyestuff, Food Engineering, Oils/Surfactants, Polymers, B.Pharm',
                'description' => 'Formerly UDCT, ICT Mumbai is a world-renowned institute for chemical engineering, polymer science, pharmaceuticals, and dyes, alma mater to Mukesh Ambani and Padma Vibhushan scientists.',
                'courses' => [
                    ['course_name' => 'Bachelor of Chemical Engineering (B.Chem.Engg.)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Food Engineering and Technology', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Chemical & Process Technology'],
                    ['course_name' => 'B.Tech in Polymer and Surface Coating Technology', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Chemical & Process Technology'],
                    ['course_name' => 'B.Tech in Dyestuff Technology', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Chemical & Process Technology'],
                    ['course_name' => 'Bachelor of Pharmacy (B.Pharm)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Pharmacy'],
                ],
            ],

            // =========================================================================
            // 2. PREMIER STATE UNIVERSITIES & AUTONOMOUS INSTITUTIONS
            // =========================================================================
            [
                'name' => 'COEP Technological University (College of Engineering Pune)',
                'district' => 'Pune',
                'taluka' => 'Shivajinagar',
                'city' => 'Pune',
                'pin_code' => '411005',
                'address' => 'Wellesley Road, Shivajinagar, Pune',
                'university_type' => 'Unitary State Technological University',
                'university_name' => 'COEP Technological University',
                'college_type' => 'State University / Engineering',
                'management' => 'State Government',
                'website' => 'https://www.coeptech.ac.in',
                'year_of_establishment' => 1854,
                'total_enrollment' => 4800,
                'faculty_count' => 280,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹45,000 – ₹90,000/yr',
                'nirf_rank' => 73,
                'naac_grade' => 'A+',
                'average_package' => '₹11.8 LPA',
                'popular_branches' => 'B.Tech Computer Engineering, AI & Robotics, Mechanical, Electronics, Civil, Metallurgy',
                'description' => 'COEP is the third oldest engineering college in Asia, founded in 1854, Alma Mater of Bharat Ratna Sir M. Visvesvaraya, granted Unitary State University status with historic boat club on Mula river.',
                'courses' => [
                    ['course_name' => 'B.Tech in Computer Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Artificial Intelligence and Machine Learning', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Electronics and Telecommunication Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Mechanical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Metallurgical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Master of Technology (M.Tech) in Automotive Technology', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Engineering & Technology'],
                ],
            ],
            [
                'name' => 'Veermata Jijabai Technological Institute (VJTI Mumbai)',
                'district' => 'Mumbai City',
                'taluka' => 'Matunga',
                'city' => 'Mumbai',
                'pin_code' => '400019',
                'address' => 'H. R. Mahajani Marg, Matunga East, Mumbai',
                'university_type' => 'Autonomous Institute affiliated to University of Mumbai',
                'university_name' => 'University of Mumbai',
                'college_type' => 'Government Autonomous Engineering College',
                'management' => 'State Government',
                'website' => 'https://vjti.ac.in',
                'year_of_establishment' => 1887,
                'total_enrollment' => 4500,
                'faculty_count' => 250,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹45,000 – ₹85,000/yr',
                'nirf_rank' => 82,
                'naac_grade' => 'A+',
                'average_package' => '₹12.5 LPA',
                'popular_branches' => 'B.Tech Computer Engineering, Information Technology, Electronics, Mechanical, Electrical, MCA',
                'description' => 'Established in 1887 as Victoria Jubilee Technical Institute, VJTI is Mumbai\'s most prestigious state engineering institute, attracting the top MHT-CET rankers with premier software and core placements.',
                'courses' => [
                    ['course_name' => 'B.Tech in Computer Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Information Technology', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Electronics Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Mechanical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Master of Computer Applications (MCA)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Computer Applications'],
                ],
            ],
            [
                'name' => 'Savitribai Phule Pune University (SPPU Pune)',
                'district' => 'Pune',
                'taluka' => 'Ganeshkhind',
                'city' => 'Pune',
                'pin_code' => '411007',
                'address' => 'Ganeshkhind Road, Pune',
                'university_type' => 'State Public Collegiate University',
                'university_name' => 'Savitribai Phule Pune University',
                'college_type' => 'State University',
                'management' => 'State Government',
                'website' => 'http://www.unipune.ac.in',
                'year_of_establishment' => 1949,
                'total_enrollment' => 650000,
                'faculty_count' => 1800,
                'featured_field_slug' => 'science',
                'fees_range' => '₹12,000 – ₹55,000/yr',
                'nirf_rank' => 19,
                'naac_grade' => 'A++',
                'average_package' => '₹6.8 LPA',
                'popular_branches' => 'M.Sc (Physics, Chemistry, Biotech, Computer Science), MBA (PUMBA), MCA, LL.M, Ph.D.',
                'description' => 'SPPU, fondly called the "Oxford of the East", spans 411 acres in Ganeshkhind, affiliating over 700 colleges and research institutes across Pune, Ahmednagar, and Nashik districts.',
                'courses' => [
                    ['course_name' => 'Master of Science (M.Sc) in Computer Science', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Aided', 'course_duration_months' => 24, 'course_category' => 'Computer Applications'],
                    ['course_name' => 'Master of Business Administration (MBA - PUMBA)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'Master of Science (M.Sc) in Biotechnology', 'course_type' => 'Post Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Life Sciences'],
                    ['course_name' => 'Master of Computer Applications (MCA)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Computer Applications'],
                    ['course_name' => 'Master of Arts (M.A.) in English Literature', 'course_type' => 'Post Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Aided', 'course_duration_months' => 24, 'course_category' => 'Languages & Literature'],
                ],
            ],

            // =========================================================================
            // 3. PREMIER MEDICAL & HEALTHCARE INSTITUTIONS
            // =========================================================================
            [
                'name' => 'Seth G.S. Medical College and KEM Hospital (Mumbai)',
                'district' => 'Mumbai City',
                'taluka' => 'Parel',
                'city' => 'Mumbai',
                'pin_code' => '400012',
                'address' => 'Acharya Donde Marg, Parel, Mumbai',
                'university_type' => 'Affiliated to MUHS Nashik',
                'university_name' => 'Maharashtra University of Health Sciences',
                'college_type' => 'Municipal Medical College',
                'management' => 'Municipal Corporation of Greater Mumbai (MCGM)',
                'website' => 'https://www.kem.edu',
                'year_of_establishment' => 1926,
                'total_enrollment' => 2200,
                'faculty_count' => 450,
                'featured_field_slug' => 'medical',
                'fees_range' => '₹60,000 – ₹1,20,000/yr',
                'nirf_rank' => 12,
                'naac_grade' => 'A+',
                'average_package' => '₹16.0 LPA',
                'popular_branches' => 'MBBS, MD Medicine, MS Surgery, DM Cardiology, M.Ch Neurosurgery, B.P.Th, B.O.Th',
                'description' => 'Seth GS Medical College and KEM Hospital is one of India\'s finest medical institutions, premier tertiary referral hospital with 1,800 beds treating 1.8 million outpatients annually.',
                'courses' => [
                    ['course_name' => 'Bachelor of Medicine and Bachelor of Surgery (MBBS)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 66, 'course_category' => 'Medicine & Health Sciences'],
                    ['course_name' => 'Doctor of Medicine (MD) in General Medicine', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Medicine & Health Sciences'],
                    ['course_name' => 'Master of Surgery (MS) in General Surgery', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Medicine & Health Sciences'],
                    ['course_name' => 'Bachelor of Physiotherapy (BPTh)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 54, 'course_category' => 'Physiotherapy & Rehabilitation'],
                    ['course_name' => 'Bachelor of Occupational Therapy (BOTh)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 54, 'course_category' => 'Rehabilitation Sciences'],
                ],
            ],
            [
                'name' => 'Armed Forces Medical College (AFMC Pune)',
                'district' => 'Pune',
                'taluka' => 'Wanowrie',
                'city' => 'Pune',
                'pin_code' => '411040',
                'address' => 'Southern Command, Solapur Road, Wanowrie, Pune',
                'university_type' => 'Affiliated to MUHS Nashik',
                'university_name' => 'Maharashtra University of Health Sciences',
                'college_type' => 'Armed Forces Medical College',
                'management' => 'Ministry of Defence / Central Government',
                'website' => 'https://afmc.nic.in',
                'year_of_establishment' => 1948,
                'total_enrollment' => 1200,
                'faculty_count' => 280,
                'featured_field_slug' => 'medical',
                'fees_range' => '₹0 – ₹10,000/yr (Commission into Armed Forces Medical Services)',
                'nirf_rank' => 11,
                'naac_grade' => 'A++',
                'average_package' => '₹18.0 LPA (Armed Forces Medical Officers)',
                'popular_branches' => 'MBBS (AFMC Entrance), B.Sc Nursing, MD, MS, M.Ch, Military Medicine',
                'description' => 'AFMC Pune is India\'s premier defense medical institution, providing graduate medical education to cadets commissioned as medical officers in the Indian Army, Navy, and Air Force.',
                'courses' => [
                    ['course_name' => 'Bachelor of Medicine and Bachelor of Surgery (MBBS)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 66, 'course_category' => 'Medicine & Health Sciences'],
                    ['course_name' => 'B.Sc. in Nursing (Military Nursing Service)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Nursing & Healthcare'],
                    ['course_name' => 'Doctor of Medicine (MD) in Anaesthesiology', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Medicine & Health Sciences'],
                    ['course_name' => 'Master of Surgery (MS) in Orthopaedics', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Medicine & Health Sciences'],
                ],
            ],

            // =========================================================================
            // 4. TOP COMMERCE, ARTS & LAW INSTITUTIONS
            // =========================================================================
            [
                'name' => 'St. Xavier\'s College (Autonomous, Mumbai)',
                'district' => 'Mumbai City',
                'taluka' => 'Fort',
                'city' => 'Mumbai',
                'pin_code' => '400001',
                'address' => '5, Mahapalika Marg, Dhobi Talao, Chhatrapati Shivaji Terminus Area, Fort, Mumbai',
                'university_type' => 'Autonomous College affiliated to University of Mumbai',
                'university_name' => 'University of Mumbai',
                'college_type' => 'Autonomous Jesuit College',
                'management' => 'Private (Aided/Unaided)',
                'website' => 'https://xaviers.ac',
                'year_of_establishment' => 1869,
                'total_enrollment' => 5200,
                'faculty_count' => 210,
                'featured_field_slug' => 'arts-humanities',
                'fees_range' => '₹25,000 – ₹60,000/yr',
                'nirf_rank' => 35,
                'naac_grade' => 'A+',
                'average_package' => '₹6.5 LPA',
                'popular_branches' => 'B.A., B.Sc, B.Com, BMS, B.A. in Film Television & New Media Production, M.Sc Biotechnology',
                'description' => 'St. Xavier\'s College Mumbai is a celebrated Victorian-Gothic heritage institution in South Mumbai, renowned for Malhar cultural festival, liberal arts, media, and science.',
                'courses' => [
                    ['course_name' => 'Bachelor of Management Studies (BMS)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 36, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'Bachelor of Arts (B.A.) in Economics and Psychology', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Aided', 'course_duration_months' => 36, 'course_category' => 'Humanities & Social Sciences'],
                    ['course_name' => 'Bachelor of Science (B.Sc) in Geology and Chemistry', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Aided', 'course_duration_months' => 36, 'course_category' => 'Earth & Environmental Sciences'],
                    ['course_name' => 'Bachelor of Commerce (B.Com)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Aided', 'course_duration_months' => 36, 'course_category' => 'Commerce & Accountancy'],
                    ['course_name' => 'Master of Science (M.Sc) in Biotechnology', 'course_type' => 'Post Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 24, 'course_category' => 'Life Sciences'],
                ],
            ],
            [
                'name' => 'Government Law College (GLC Mumbai)',
                'district' => 'Mumbai City',
                'taluka' => 'Churchgate',
                'city' => 'Mumbai',
                'pin_code' => '400020',
                'address' => '\'A\' Road, Churchgate, Mumbai',
                'university_type' => 'Affiliated to University of Mumbai',
                'university_name' => 'University of Mumbai',
                'college_type' => 'Government Law College',
                'management' => 'State Government',
                'website' => 'https://www.glcmumbai.com',
                'year_of_establishment' => 1855,
                'total_enrollment' => 2500,
                'faculty_count' => 90,
                'featured_field_slug' => 'teaching-law',
                'fees_range' => '₹7,000 – ₹15,000/yr',
                'nirf_rank' => 15,
                'naac_grade' => 'A',
                'average_package' => '₹9.0 LPA',
                'popular_branches' => 'B.L.S. LL.B. (5-Year Integrated), LL.B. (3-Year), Post Graduate Diplomas in Securities Law',
                'description' => 'Established in 1855, GLC Mumbai is the oldest law school in Asia, alma mater to Dr. B.R. Ambedkar, Nani Palkhivala, Soli Sorabjee, and six Chief Justices of India.',
                'courses' => [
                    ['course_name' => 'B.L.S. LL.B. 5-Year Integrated', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 60, 'course_category' => 'Law & Legal Studies'],
                    ['course_name' => 'Bachelor of Laws (LL.B. 3-Year)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Law & Legal Studies'],
                    ['course_name' => 'Post Graduate Diploma in Securities Law', 'course_type' => 'Diploma Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 12, 'course_category' => 'Financial Law & Regulations'],
                    ['course_name' => 'Post Graduate Diploma in Cyber Law', 'course_type' => 'Diploma Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 12, 'course_category' => 'Cybersecurity & IT Law'],
                ],
            ],
            [
                'name' => 'Narsee Monjee Institute of Management Studies (NMIMS Deemed University, Mumbai)',
                'district' => 'Mumbai Suburban',
                'taluka' => 'Vile Parle',
                'city' => 'Mumbai',
                'pin_code' => '400056',
                'address' => 'V. L. Mehta Road, Vile Parle West, Mumbai',
                'university_type' => 'Deemed to be University',
                'university_name' => 'SVKM\'s NMIMS',
                'college_type' => 'Deemed University',
                'management' => 'Private (Unaided)',
                'website' => 'https://www.nmims.edu',
                'year_of_establishment' => 1981,
                'total_enrollment' => 18000,
                'faculty_count' => 850,
                'featured_field_slug' => 'business',
                'fees_range' => '₹3,00,000 – ₹11,50,000/yr',
                'nirf_rank' => 21,
                'naac_grade' => 'A+',
                'average_package' => '₹19.5 LPA',
                'popular_branches' => 'MBA (SBM NMIMS), BBA, B.Com (Hons), B.Tech Data Science (MPSTME), B.Pharm, Law',
                'description' => 'NMIMS is one of India\'s top private business and multi-disciplinary universities, acclaimed for its flagship School of Business Management (SBM) and modern urban campuses.',
                'courses' => [
                    ['course_name' => 'Master of Business Administration (MBA - SBM)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 24, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'MBA in Business Analytics', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 24, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'Bachelor of Business Administration (BBA - ASMSOC)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 36, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'B.Tech in Computer Science and Engineering (Data Science)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.A. LL.B. (Hons.) 5-Year Integrated (KPMSOL)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 60, 'course_category' => 'Law & Legal Studies'],
                ],
            ],
            [
                'name' => 'Symbiosis International University (SIU Pune)',
                'district' => 'Pune',
                'taluka' => 'Lavale / Viman Nagar',
                'city' => 'Pune',
                'pin_code' => '412115',
                'address' => 'Gram Lavale, Taluka Mulshi, Pune',
                'university_type' => 'Deemed to be University',
                'university_name' => 'Symbiosis International (Deemed University)',
                'college_type' => 'Deemed University',
                'management' => 'Private (Unaided)',
                'website' => 'https://www.siu.edu.in',
                'year_of_establishment' => 1971,
                'total_enrollment' => 24000,
                'faculty_count' => 1100,
                'featured_field_slug' => 'business',
                'fees_range' => '₹2,50,000 – ₹10,50,000/yr',
                'nirf_rank' => 31,
                'naac_grade' => 'A++',
                'average_package' => '₹18.5 LPA',
                'popular_branches' => 'MBA (SIBM Pune), Law (SLS Pune), BBA (SCMS), B.Tech (SIT Pune), Mass Comm (SIMC)',
                'description' => 'Symbiosis International University is a premier international higher education hub in Pune, awarded NAAC A++ (CGPA 3.58), housing famous institutions like SIBM, SLS, and SCMHRD.',
                'courses' => [
                    ['course_name' => 'Master of Business Administration (MBA - SIBM Pune)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 24, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'B.A. LL.B. (Hons.) 5-Year Integrated (SLS Pune)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 60, 'course_category' => 'Law & Legal Studies'],
                    ['course_name' => 'Bachelor of Business Administration (BBA - SCMS)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 36, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'B.Tech in Computer Science and Engineering (SIT Pune)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'M.A. in Mass Communication (SIMC Pune)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 24, 'course_category' => 'Journalism & Mass Media'],
                ],
            ],
        ];
    }
}
