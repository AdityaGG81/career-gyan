<?php

namespace Database\Seeders\States;

use App\Models\IndianCollege;
use App\Models\College;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class TamilNaduCollegeSeeder extends Seeder
{
    /**
     * Run the Tamil Nadu colleges and universities database seeder.
     */
    public function run(): void
    {
        $this->command?->info("🏛️  Seeding Tamil Nadu Public & Private Universities and Degree Colleges...");

        $institutions = $this->getTamilNaduInstitutionsData();
        $fieldsMap = Field::pluck('id', 'slug')->toArray();

        $totalColleges = 0;
        $totalCourseRows = 0;
        $totalFeaturedColleges = 0;

        foreach ($institutions as $inst) {
            $totalColleges++;
            $collegeName = $inst['name'];

            // 1. Remove legacy stub records in Tamil Nadu to prevent duplication
            DB::table('indian_colleges')
                ->where('state', 'Tamil Nadu')
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
                    'state'                  => 'Tamil Nadu',
                    'district'               => $inst['district'] ?? 'Chennai',
                    'taluka'                 => $inst['taluka'] ?? $inst['district'] ?? 'Chennai',
                    'university_type'        => $inst['university_type'] ?? 'State University',
                    'university_name'        => $inst['university_name'] ?? $collegeName,
                    'college_type'           => $inst['college_type'] ?? 'University / College',
                    'affiliation'            => $inst['affiliation'] ?? 'UGC Recognized',
                    'management'             => $inst['management'] ?? 'Private (Unaided)',
                    'website'                => $inst['website'] ?? null,
                    'year_of_establishment'  => $inst['year_of_establishment'] ?? null,
                    'address'                => $inst['address'] ?? null,
                    'city'                   => $inst['city'] ?? 'Chennai',
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
                    'state'    => 'Tamil Nadu',
                    'field_id' => $fieldId,
                ],
                [
                    'location'                 => $inst['city'] ?? 'Chennai',
                    'fees_range'               => $inst['fees_range'] ?? '₹40,000 – ₹2,50,000/yr',
                    'type'                     => str_contains(strtolower($inst['management'] ?? ''), 'gov') || str_contains(strtolower($inst['management'] ?? ''), 'central') ? 'Government' : 'Private',
                    'website'                  => $inst['website'] ?? null,
                    'rank'                     => $inst['nirf_rank'] ?? null,
                    'government_rank'          => $inst['nirf_rank'] ?? null,
                    'naac_grade'               => $inst['naac_grade'] ?? 'A+',
                    'popular_branches'         => $inst['popular_branches'] ?? implode(', ', array_slice(array_column($courses, 'course_name'), 0, 4)),
                    'cutoff'                   => $inst['cutoff'] ?? 'Based on TNEA / JEE Main / NEET / TANCET entrance scores',
                    'placement_support'        => $inst['placement_support'] ?? 'Robust corporate placement cell with leading multinational software and core engineering firms',
                    'facilities'               => $inst['facilities'] ?? 'Central Library, Research Parks, Wi-Fi Campus, Modern Auditoriums, Hostels, Sports Complex',
                    'description'              => $inst['description'] ?? "{$collegeName} is a top educational institution in Tamil Nadu recognized for academic excellence and technical innovation.",
                    'average_package'          => $inst['average_package'] ?? '₹7.0 - ₹18.0 LPA',
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

        $this->command?->info("✅ Tamil Nadu Chunk Completed: {$totalColleges} institutions seeded with {$totalCourseRows} course records and {$totalFeaturedColleges} featured colleges!");
    }

    /**
     * Get comprehensive dataset of Tamil Nadu's Public & Private Universities and Degree Colleges.
     */
    private function getTamilNaduInstitutionsData(): array
    {
        return [
            // =========================================================================
            // 1. INSTITUTES OF NATIONAL IMPORTANCE & PREMIER CENTRAL INSTITUTIONS
            // =========================================================================
            [
                'name' => 'Indian Institute of Technology Madras (IIT Madras)',
                'district' => 'Chennai',
                'taluka' => 'Guindy',
                'city' => 'Chennai',
                'pin_code' => '600036',
                'address' => 'Sardar Patel Road, Adyar, Chennai',
                'university_type' => 'Institute of National Importance (IoE)',
                'university_name' => 'Indian Institute of Technology Madras',
                'college_type' => 'Institute of National Importance',
                'management' => 'Central Government',
                'website' => 'https://www.iitm.ac.in',
                'year_of_establishment' => 1959,
                'total_enrollment' => 11000,
                'faculty_count' => 630,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹2,10,000 – ₹2,50,000/yr',
                'nirf_rank' => 1,
                'naac_grade' => 'A++',
                'average_package' => '₹28.5 LPA',
                'popular_branches' => 'B.Tech CSE, Electrical, Mechanical, Aerospace, BS Data Science, Dual Degree',
                'description' => 'IIT Madras is India\'s #1 overall higher educational institution (NIRF rank 1 for multiple consecutive years), housing India\'s first university-based research park (IITM Research Park).',
                'courses' => [
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Electrical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Aerospace Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Mechanical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Bachelor of Science (BS) in Data Science & Applications', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Data Science'],
                    ['course_name' => 'M.Tech in Artificial Intelligence', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Engineering & Technology'],
                ],
            ],
            [
                'name' => 'National Institute of Technology Tiruchirappalli (NIT Trichy)',
                'district' => 'Tiruchirappalli',
                'taluka' => 'Thuvakudi',
                'city' => 'Tiruchirappalli',
                'pin_code' => '620015',
                'address' => 'Tanjore Main Road, National Highway 67, Near BHEL, Tiruchirappalli',
                'university_type' => 'Institute of National Importance',
                'university_name' => 'NIT Tiruchirappalli',
                'college_type' => 'Institute of National Importance',
                'management' => 'Central Government',
                'website' => 'https://www.nitt.edu',
                'year_of_establishment' => 1964,
                'total_enrollment' => 6800,
                'faculty_count' => 320,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹1,50,000 – ₹1,90,000/yr',
                'nirf_rank' => 9,
                'naac_grade' => 'A++',
                'average_package' => '₹19.2 LPA',
                'popular_branches' => 'B.Tech CSE, ECE, Mechanical, Chemical, Production, Metallurgical, B.Arch, MCA',
                'description' => 'NIT Trichy is India\'s top-ranked National Institute of Technology, famed for academic excellence, state-of-the-art Siemens Centre of Excellence, and stellar placements.',
                'courses' => [
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Electronics & Communication Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Mechanical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Chemical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Bachelor of Architecture (B.Arch)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 60, 'course_category' => 'Architecture & Planning'],
                    ['course_name' => 'Master of Computer Applications (MCA)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Computer Applications'],
                ],
            ],

            // =========================================================================
            // 2. PREMIER STATE UNIVERSITIES & CONSTITUENT ENGINEERING CAMPUSES
            // =========================================================================
            [
                'name' => 'College of Engineering, Guindy (CEG - Anna University)',
                'district' => 'Chennai',
                'taluka' => 'Guindy',
                'city' => 'Chennai',
                'pin_code' => '600025',
                'address' => 'Sardar Patel Road, Guindy, Chennai',
                'university_type' => 'State University Main Campus',
                'university_name' => 'Anna University',
                'college_type' => 'Government Engineering College / University Campus',
                'management' => 'State Government',
                'website' => 'https://ceg.annauniv.edu',
                'year_of_establishment' => 1794,
                'total_enrollment' => 8500,
                'faculty_count' => 460,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹35,000 – ₹70,000/yr',
                'nirf_rank' => 13,
                'naac_grade' => 'A++',
                'average_package' => '₹12.0 LPA',
                'popular_branches' => 'B.E. Computer Science, Information Tech, ECE, Mechanical, Geo-informatics, Civil',
                'description' => 'CEG Guindy is the oldest technical institution in Asia, established in 1794 as a survey school, serving as the flagship engineering campus of Anna University.',
                'courses' => [
                    ['course_name' => 'B.E. in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Information Technology', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.E. in Electronics and Communication Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.E. in Mechanical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.E. in Geo-informatics Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                ],
            ],
            [
                'name' => 'Madras Institute of Technology (MIT Chromepet - Anna University)',
                'district' => 'Chengalpattu',
                'taluka' => 'Pallavaram',
                'city' => 'Chennai',
                'pin_code' => '600044',
                'address' => 'MIT Road, Chromepet, Chennai',
                'university_type' => 'State University Campus',
                'university_name' => 'Anna University',
                'college_type' => 'Government Engineering College / University Campus',
                'management' => 'State Government',
                'website' => 'https://mitindia.edu',
                'year_of_establishment' => 1949,
                'total_enrollment' => 4500,
                'faculty_count' => 240,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹35,000 – ₹65,000/yr',
                'nirf_rank' => 13,
                'naac_grade' => 'A++',
                'average_package' => '₹11.5 LPA',
                'popular_branches' => 'B.Tech Aeronautical (Dr. APJ Abdul Kalam Alma Mater), Automobile, Rubber & Plastics, CSE',
                'description' => 'MIT Chromepet is the revered alma mater of former President Dr. A.P.J. Abdul Kalam, pioneer in aeronautical, automobile, and avionics engineering education in India.',
                'courses' => [
                    ['course_name' => 'B.Tech in Aeronautical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Automobile Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Rubber and Plastics Technology', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Chemical & Process Technology'],
                ],
            ],
            [
                'name' => 'University of Madras (Chennai)',
                'district' => 'Chennai',
                'taluka' => 'Chepauk',
                'city' => 'Chennai',
                'pin_code' => '600005',
                'address' => 'Navalar Nagar, Chepauk, Triplicane, Chennai',
                'university_type' => 'State Public University',
                'university_name' => 'University of Madras',
                'college_type' => 'State University',
                'management' => 'State Government',
                'website' => 'https://www.unom.ac.in',
                'year_of_establishment' => 1857,
                'total_enrollment' => 25000,
                'faculty_count' => 650,
                'featured_field_slug' => 'science',
                'fees_range' => '₹8,000 – ₹45,000/yr',
                'nirf_rank' => 50,
                'naac_grade' => 'A++',
                'average_package' => '₹5.5 LPA',
                'popular_branches' => 'M.Sc, M.Com, MBA, M.A. Econometrics, Journalism, Criminology, Ph.D.',
                'description' => 'The University of Madras is one of India\'s three historic founding universities incorporated in 1857, boasting alumni that include two Nobel laureates (C.V. Raman and S. Chandrasekhar).',
                'courses' => [
                    ['course_name' => 'Master of Science (M.Sc) in Computer Science', 'course_type' => 'Post Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Aided', 'course_duration_months' => 24, 'course_category' => 'Computer Applications'],
                    ['course_name' => 'Master of Science (M.Sc) in Biotechnology', 'course_type' => 'Post Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Aided', 'course_duration_months' => 24, 'course_category' => 'Life Sciences'],
                    ['course_name' => 'Master of Business Administration (MBA)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Aided', 'course_duration_months' => 24, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'Master of Science (M.Sc) in Criminology & Criminal Justice', 'course_type' => 'Post Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Aided', 'course_duration_months' => 24, 'course_category' => 'Social Sciences'],
                    ['course_name' => 'Master of Commerce (M.Com)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Aided', 'course_duration_months' => 24, 'course_category' => 'Commerce & Accountancy'],
                ],
            ],

            // =========================================================================
            // 3. TOP AUTONOMOUS & AFFILIATED ENGINEERING COLLEGES
            // =========================================================================
            [
                'name' => 'PSG College of Technology (PSG Tech Coimbatore)',
                'district' => 'Coimbatore',
                'taluka' => 'Peelamedu',
                'city' => 'Coimbatore',
                'pin_code' => '641004',
                'address' => 'Avinashi Road, Peelamedu, Coimbatore',
                'university_type' => 'Autonomous College affiliated to Anna University',
                'university_name' => 'Anna University',
                'college_type' => 'Private Aided Autonomous College',
                'management' => 'Private (Aided)',
                'website' => 'https://www.psgtech.edu',
                'year_of_establishment' => 1951,
                'total_enrollment' => 8500,
                'faculty_count' => 450,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹70,000 – ₹2,40,000/yr',
                'nirf_rank' => 63,
                'naac_grade' => 'A',
                'average_package' => '₹11.2 LPA',
                'popular_branches' => 'B.E. Computer Science, Robotics, Mechanical, Production, Textile Tech, Automobile',
                'description' => 'PSG Tech is one of India\'s top premier autonomous engineering institutions with deep industry-institute collaboration and extensive manufacturing workshops.',
                'courses' => [
                    ['course_name' => 'B.E. in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.E. in Robotics and Automation Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.E. in Mechanical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Textile Technology', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Aided', 'course_duration_months' => 48, 'course_category' => 'Textile Engineering'],
                    ['course_name' => 'Master of Computer Applications (MCA)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Aided', 'course_duration_months' => 24, 'course_category' => 'Computer Applications'],
                ],
            ],
            [
                'name' => 'Sri Sivasubramaniya Nadar College of Engineering (SSN College of Engineering Chennai)',
                'district' => 'Chengalpattu',
                'taluka' => 'Thiruporur',
                'city' => 'Chennai',
                'pin_code' => '603110',
                'address' => 'Rajiv Gandhi Salai (OMR), Kalavakkam, Chennai',
                'university_type' => 'Autonomous College affiliated to Anna University',
                'university_name' => 'Anna University',
                'college_type' => 'Private Autonomous Engineering College',
                'management' => 'Private (Unaided)',
                'website' => 'https://www.ssn.edu.in',
                'year_of_establishment' => 1996,
                'total_enrollment' => 4800,
                'faculty_count' => 310,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹1,00,000 – ₹2,50,000/yr',
                'nirf_rank' => 45,
                'naac_grade' => 'A++',
                'average_package' => '₹10.5 LPA',
                'popular_branches' => 'B.E. Computer Science, IT, ECE, Biomedical, Chemical, Mechanical, Electrical',
                'description' => 'Founded by Padma Bhushan Shiv Nadar (HCL Founder), SSN is widely ranked as the #1 private engineering college under Anna University in Tamil Nadu.',
                'courses' => [
                    ['course_name' => 'B.E. in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Information Technology', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.E. in Biomedical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.E. in Electronics & Communication Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'M.E. in VLSI Design', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 24, 'course_category' => 'Engineering & Technology'],
                ],
            ],

            // =========================================================================
            // 4. PREMIER MEDICAL & HEALTHCARE INSTITUTIONS
            // =========================================================================
            [
                'name' => 'Christian Medical College (CMC Vellore)',
                'district' => 'Vellore',
                'taluka' => 'Vellore',
                'city' => 'Vellore',
                'pin_code' => '632002',
                'address' => 'Ida Scudder Road, Vellore',
                'university_type' => 'Affiliated to TN Dr. MGR Medical University',
                'university_name' => 'Tamil Nadu Dr. M.G.R. Medical University',
                'college_type' => 'Private Minority Medical College',
                'management' => 'Private (Unaided)',
                'website' => 'https://www.cmch-vellore.edu',
                'year_of_establishment' => 1900,
                'total_enrollment' => 2600,
                'faculty_count' => 610,
                'featured_field_slug' => 'medical',
                'fees_range' => '₹40,000 – ₹70,000/yr',
                'nirf_rank' => 3,
                'naac_grade' => 'A++',
                'average_package' => '₹18.0 LPA',
                'popular_branches' => 'MBBS, MD General Medicine, MS Orthopaedics, DM Hematology, M.Ch Neurosurgery, Nursing',
                'description' => 'CMC Vellore is one of India\'s finest medical colleges and tertiary hospitals, founded by Dr. Ida S. Scudder, pioneer in open-heart surgery, kidney transplantation, and hematology.',
                'courses' => [
                    ['course_name' => 'Bachelor of Medicine and Bachelor of Surgery (MBBS)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 66, 'course_category' => 'Medicine & Health Sciences'],
                    ['course_name' => 'Doctor of Medicine (MD) in General Medicine', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 36, 'course_category' => 'Medicine & Health Sciences'],
                    ['course_name' => 'Master of Surgery (MS) in Orthopaedics', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 36, 'course_category' => 'Medicine & Health Sciences'],
                    ['course_name' => 'B.Sc. in Nursing', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Nursing & Healthcare'],
                    ['course_name' => 'Bachelor of Occupational Therapy (BOT)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 54, 'course_category' => 'Rehabilitation Sciences'],
                ],
            ],
            [
                'name' => 'Madras Medical College (MMC Chennai)',
                'district' => 'Chennai',
                'taluka' => 'Park Town',
                'city' => 'Chennai',
                'pin_code' => '600003',
                'address' => 'EVR Periyar Salai, Park Town, Chennai',
                'university_type' => 'Affiliated to TN Dr. MGR Medical University',
                'university_name' => 'Tamil Nadu Dr. M.G.R. Medical University',
                'college_type' => 'Government Medical College',
                'management' => 'State Government',
                'website' => 'https://mmc.tn.gov.in',
                'year_of_establishment' => 1835,
                'total_enrollment' => 2200,
                'faculty_count' => 450,
                'featured_field_slug' => 'medical',
                'fees_range' => '₹40,000 – ₹80,000/yr',
                'nirf_rank' => 11,
                'naac_grade' => 'A+',
                'average_package' => '₹15.5 LPA',
                'popular_branches' => 'MBBS, MD Cardiology, MS Surgery, B.Pharm, B.Sc Nursing, MD Paediatrics',
                'description' => 'Established in 1835, MMC Chennai is the third oldest medical college in India, attached to Rajiv Gandhi Government General Hospital (RGGGH), treating thousands of patients daily.',
                'courses' => [
                    ['course_name' => 'Bachelor of Medicine and Bachelor of Surgery (MBBS)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 66, 'course_category' => 'Medicine & Health Sciences'],
                    ['course_name' => 'Doctor of Medicine (MD) in Anaesthesia', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Medicine & Health Sciences'],
                    ['course_name' => 'Master of Surgery (MS) in General Surgery', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Medicine & Health Sciences'],
                    ['course_name' => 'Bachelor of Pharmacy (B.Pharm)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Pharmacy'],
                ],
            ],

            // =========================================================================
            // 5. TOP ARTS, COMMERCE & SCIENCE DEGREE COLLEGES
            // =========================================================================
            [
                'name' => 'Loyola College (Chennai)',
                'district' => 'Chennai',
                'taluka' => 'Nungambakkam',
                'city' => 'Chennai',
                'pin_code' => '600034',
                'address' => 'Sterling Road, Nungambakkam, Chennai',
                'university_type' => 'Autonomous College affiliated to University of Madras',
                'university_name' => 'University of Madras',
                'college_type' => 'Autonomous Jesuit College',
                'management' => 'Private (Aided/Unaided)',
                'website' => 'https://www.loyolacollege.edu',
                'year_of_establishment' => 1925,
                'total_enrollment' => 9500,
                'faculty_count' => 360,
                'featured_field_slug' => 'commerce',
                'fees_range' => '₹30,000 – ₹90,000/yr',
                'nirf_rank' => 4,
                'naac_grade' => 'A++',
                'average_package' => '₹6.8 LPA',
                'popular_branches' => 'B.Com (General/Corporate/Honours), B.A. Economics, B.Sc Visual Comm, BBA, M.Sc Data Science',
                'description' => 'Loyola College Chennai is a prestigious Jesuit institution ranked consistently among India\'s top 5 degree colleges, acclaimed for commerce, economics, and media studies.',
                'courses' => [
                    ['course_name' => 'Bachelor of Commerce (B.Com)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Aided', 'course_duration_months' => 36, 'course_category' => 'Commerce & Accountancy'],
                    ['course_name' => 'Bachelor of Business Administration (BBA)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 36, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'B.Sc. in Visual Communication', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 36, 'course_category' => 'Media & Visual Arts'],
                    ['course_name' => 'Bachelor of Arts (B.A.) in Economics', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Aided', 'course_duration_months' => 36, 'course_category' => 'Economics & Social Sciences'],
                    ['course_name' => 'M.Sc. in Data Science', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 24, 'course_category' => 'Data Science'],
                ],
            ],
            [
                'name' => 'Presidency College (Chennai)',
                'district' => 'Chennai',
                'taluka' => 'Kamarajar Salai',
                'city' => 'Chennai',
                'pin_code' => '600005',
                'address' => 'Kamarajar Salai, Chepauk, Triplicane, Chennai',
                'university_type' => 'Autonomous College affiliated to University of Madras',
                'university_name' => 'University of Madras',
                'college_type' => 'Government Autonomous College',
                'management' => 'State Government',
                'website' => 'https://presidencycollegechennai.ac.in',
                'year_of_establishment' => 1840,
                'total_enrollment' => 5000,
                'faculty_count' => 280,
                'featured_field_slug' => 'arts-humanities',
                'fees_range' => '₹4,000 – ₹15,000/yr',
                'nirf_rank' => 3,
                'naac_grade' => 'A+',
                'average_package' => '₹5.2 LPA',
                'popular_branches' => 'B.A. History, Political Science, B.Sc Mathematics, B.Com, M.Sc, Ph.D.',
                'description' => 'Presidency College Chennai is ranked #3 in India across all colleges in NIRF, celebrated as the "Mother of the University of Madras" with two Nobel laureate alumni.',
                'courses' => [
                    ['course_name' => 'Bachelor of Arts (B.A.) in Political Science', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Humanities & Social Sciences'],
                    ['course_name' => 'Bachelor of Science (B.Sc) in Mathematics', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Mathematics & Statistics'],
                    ['course_name' => 'Bachelor of Commerce (B.Com)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Commerce & Accountancy'],
                    ['course_name' => 'Bachelor of Science (B.Sc) in Physics', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Natural Sciences'],
                    ['course_name' => 'Master of Science (M.Sc) in Chemistry', 'course_type' => 'Post Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Natural Sciences'],
                ],
            ],

            // =========================================================================
            // 6. PROMINENT DEEMED & PRIVATE UNIVERSITIES IN TAMIL NADU
            // =========================================================================
            [
                'name' => 'Vellore Institute of Technology (VIT Vellore)',
                'district' => 'Vellore',
                'taluka' => 'Katpadi',
                'city' => 'Vellore',
                'pin_code' => '632014',
                'address' => 'VIT, Katpadi, Vellore',
                'university_type' => 'Deemed to be University (Institution of Eminence)',
                'university_name' => 'Vellore Institute of Technology',
                'college_type' => 'Deemed University (IoE)',
                'management' => 'Private (Unaided)',
                'website' => 'https://vit.ac.in',
                'year_of_establishment' => 1984,
                'total_enrollment' => 38000,
                'faculty_count' => 2200,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹1,90,000 – ₹3,80,000/yr',
                'nirf_rank' => 11,
                'naac_grade' => 'A++',
                'average_package' => '₹9.2 LPA',
                'popular_branches' => 'B.Tech CSE, AI, Data Science, ECE, Mechanical, Biotechnology, Integrated M.Tech, MBA',
                'description' => 'VIT Vellore is one of India\'s largest and most famous private deemed universities, recognized as an Institution of Eminence (IoE) with world records in campus placements.',
                'courses' => [
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Computer Science and Engineering (Data Science)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Electronics and Communication Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Mechanical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Master of Business Administration (MBA)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 24, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'Master of Computer Applications (MCA)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 24, 'course_category' => 'Computer Applications'],
                ],
            ],
            [
                'name' => 'SRM Institute of Science and Technology (SRMIST Kattankulathur, Chennai)',
                'district' => 'Chengalpattu',
                'taluka' => 'Kattankulathur',
                'city' => 'Chennai',
                'pin_code' => '603203',
                'address' => 'SRM Nagar, Kattankulathur, Chengalpattu District',
                'university_type' => 'Deemed to be University',
                'university_name' => 'SRM Institute of Science and Technology',
                'college_type' => 'Deemed University',
                'management' => 'Private (Unaided)',
                'website' => 'https://www.srmist.edu.in',
                'year_of_establishment' => 1985,
                'total_enrollment' => 52000,
                'faculty_count' => 3100,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹2,50,000 – ₹4,50,000/yr',
                'nirf_rank' => 18,
                'naac_grade' => 'A++',
                'average_package' => '₹8.5 LPA',
                'popular_branches' => 'B.Tech CSE/Cloud Computing/AI, MBBS, BDS, B.Pharm, BBA, B.Sc Agriculture, Law',
                'description' => 'SRMIST Kattankulathur is a mega-university campus spread over 250 acres with medical colleges, super-speciality hospital, and massive engineering faculties.',
                'courses' => [
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Artificial Intelligence & Machine Learning', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Bachelor of Medicine and Bachelor of Surgery (MBBS)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 66, 'course_category' => 'Medicine & Health Sciences'],
                    ['course_name' => 'Bachelor of Pharmacy (B.Pharm)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Pharmacy'],
                    ['course_name' => 'Bachelor of Business Administration (BBA)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 36, 'course_category' => 'Management & Business Administration'],
                ],
            ],
            [
                'name' => 'SASTRA Deemed University (Thanjavur)',
                'district' => 'Thanjavur',
                'taluka' => 'Thirumalaisamudram',
                'city' => 'Thanjavur',
                'pin_code' => '613401',
                'address' => 'Tirumalaisamudram, Thanjavur',
                'university_type' => 'Deemed to be University',
                'university_name' => 'Shanmugha Arts, Science, Technology & Research Academy',
                'college_type' => 'Deemed University',
                'management' => 'Private (Unaided)',
                'website' => 'https://www.sastra.edu',
                'year_of_establishment' => 1984,
                'total_enrollment' => 12000,
                'faculty_count' => 750,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹1,50,000 – ₹2,20,000/yr',
                'nirf_rank' => 26,
                'naac_grade' => 'A++',
                'average_package' => '₹9.0 LPA',
                'popular_branches' => 'B.Tech CSE, ICT, Bioengineering, Law (BA/BBA LL.B), M.Tech, Ph.D.',
                'description' => 'SASTRA Deemed University in the cultural capital of Thanjavur is renowned for academic rigor, transparent merit admissions, Srinivasa Ramanujan research center, and top tier placements.',
                'courses' => [
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Information and Communication Technology (ICT)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Bioengineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Biotechnology'],
                    ['course_name' => 'B.A. LL.B. (Hons.) 5-Year Integrated', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 60, 'course_category' => 'Law & Legal Studies'],
                    ['course_name' => 'Master of Computer Applications (MCA)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 24, 'course_category' => 'Computer Applications'],
                ],
            ],
            [
                'name' => 'Amrita Vishwa Vidyapeetham (Coimbatore Campus)',
                'district' => 'Coimbatore',
                'taluka' => 'Ettimadai',
                'city' => 'Coimbatore',
                'pin_code' => '641112',
                'address' => 'Amritanagar, Ettimadai, Coimbatore',
                'university_type' => 'Deemed to be University (Institution of Eminence)',
                'university_name' => 'Amrita Vishwa Vidyapeetham',
                'college_type' => 'Deemed University (IoE)',
                'management' => 'Private (Unaided)',
                'website' => 'https://www.amrita.edu',
                'year_of_establishment' => 1994,
                'total_enrollment' => 24000,
                'faculty_count' => 1800,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹2,00,000 – ₹3,50,000/yr',
                'nirf_rank' => 7,
                'naac_grade' => 'A++',
                'average_package' => '₹9.5 LPA',
                'popular_branches' => 'B.Tech CSE, AI, Cybersecurity, Aerospace, MBA, Social Work, Mass Comm',
                'description' => 'Amrita Vishwa Vidyapeetham is an Institution of Eminence (IoE) ranked #7 in NIRF Universities, famous for research patents, humanitarian technology innovations, and global rankings.',
                'courses' => [
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Artificial Intelligence & Data Science', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Aerospace Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Master of Business Administration (MBA)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 24, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'Master of Social Work (MSW)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 24, 'course_category' => 'Social Work'],
                ],
            ],
        ];
    }
}
