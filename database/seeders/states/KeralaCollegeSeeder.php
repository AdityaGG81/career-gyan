<?php

namespace Database\Seeders\States;

use App\Models\IndianCollege;
use App\Models\College;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class KeralaCollegeSeeder extends Seeder
{
    /**
     * Run the Kerala colleges and universities database seeder.
     */
    public function run(): void
    {
        $this->command?->info("🏛️  Seeding Kerala Public & Private Universities and Degree Colleges...");

        $institutions = $this->getKeralaInstitutionsData();
        $fieldsMap = Field::pluck('id', 'slug')->toArray();

        $totalColleges = 0;
        $totalCourseRows = 0;
        $totalFeaturedColleges = 0;

        foreach ($institutions as $inst) {
            $totalColleges++;
            $collegeName = $inst['name'];

            // 1. Remove legacy stub records in Kerala to prevent duplication
            DB::table('indian_colleges')
                ->where('state', 'Kerala')
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
                    'state'                  => 'Kerala',
                    'district'               => $inst['district'] ?? 'Thiruvananthapuram',
                    'taluka'                 => $inst['taluka'] ?? $inst['district'] ?? 'Thiruvananthapuram',
                    'university_type'        => $inst['university_type'] ?? 'State University',
                    'university_name'        => $inst['university_name'] ?? $collegeName,
                    'college_type'           => $inst['college_type'] ?? 'University / College',
                    'affiliation'            => $inst['affiliation'] ?? 'UGC Recognized',
                    'management'             => $inst['management'] ?? 'Private (Unaided)',
                    'website'                => $inst['website'] ?? null,
                    'year_of_establishment'  => $inst['year_of_establishment'] ?? null,
                    'address'                => $inst['address'] ?? null,
                    'city'                   => $inst['city'] ?? 'Thiruvananthapuram',
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
                    'state'    => 'Kerala',
                    'field_id' => $fieldId,
                ],
                [
                    'location'                 => $inst['city'] ?? 'Thiruvananthapuram',
                    'fees_range'               => $inst['fees_range'] ?? '₹30,000 – ₹1,80,000/yr',
                    'type'                     => str_contains(strtolower($inst['management'] ?? ''), 'gov') || str_contains(strtolower($inst['management'] ?? ''), 'central') ? 'Government' : 'Private',
                    'website'                  => $inst['website'] ?? null,
                    'rank'                     => $inst['nirf_rank'] ?? null,
                    'government_rank'          => $inst['nirf_rank'] ?? null,
                    'naac_grade'               => $inst['naac_grade'] ?? 'A+',
                    'popular_branches'         => $inst['popular_branches'] ?? implode(', ', array_slice(array_column($courses, 'course_name'), 0, 4)),
                    'cutoff'                   => $inst['cutoff'] ?? 'Based on KEAM / JEE Main / NEET / CAT / CUSAT CAT',
                    'placement_support'        => $inst['placement_support'] ?? 'Active career counselling and campus placement cell with leading global technology employers',
                    'facilities'               => $inst['facilities'] ?? 'Central Library, Research Laboratories, High-Speed Wi-Fi, Sports Stadium, Hostels, Innovation Incubation Hub',
                    'description'              => $inst['description'] ?? "{$collegeName} is a premier educational institution in Kerala known for high academic quality and research standard.",
                    'average_package'          => $inst['average_package'] ?? '₹6.5 - ₹17.0 LPA',
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

        $this->command?->info("✅ Kerala Chunk Completed: {$totalColleges} institutions seeded with {$totalCourseRows} course records and {$totalFeaturedColleges} featured colleges!");
    }

    /**
     * Get comprehensive dataset of Kerala's Public & Private Universities and Degree Colleges.
     */
    private function getKeralaInstitutionsData(): array
    {
        return [
            // =========================================================================
            // 1. INSTITUTES OF NATIONAL IMPORTANCE & PREMIER CENTRAL INSTITUTIONS
            // =========================================================================
            [
                'name' => 'National Institute of Technology Calicut (NITC)',
                'district' => 'Kozhikode',
                'taluka' => 'Kozhikode',
                'city' => 'Chathamangalam, Kozhikode',
                'pin_code' => '673601',
                'address' => 'Calicut Muckam Road, Chathamangalam, Kozhikode',
                'university_type' => 'Institute of National Importance',
                'university_name' => 'NIT Calicut',
                'college_type' => 'Institute of National Importance',
                'management' => 'Central Government',
                'website' => 'https://nitc.ac.in',
                'year_of_establishment' => 1961,
                'total_enrollment' => 6800,
                'faculty_count' => 320,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹1,40,000 – ₹1,80,000/yr',
                'nirf_rank' => 23,
                'naac_grade' => 'A+',
                'average_package' => '₹16.5 LPA',
                'popular_branches' => 'B.Tech CSE, ECE, Mechanical, Chemical, Biotechnology, B.Arch, MCA',
                'description' => 'NIT Calicut is one of India\'s top 5 NITs, nestled at the foothills of the Western Ghats, celebrated for stellar computer science placements and high faculty research output.',
                'courses' => [
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Electronics and Communication Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Mechanical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Biotechnology', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Biotechnology'],
                    ['course_name' => 'Bachelor of Architecture (B.Arch)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 60, 'course_category' => 'Architecture & Planning'],
                    ['course_name' => 'Master of Computer Applications (MCA)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Computer Applications'],
                ],
            ],
            [
                'name' => 'Indian Institute of Management Kozhikode (IIM Kozhikode)',
                'district' => 'Kozhikode',
                'taluka' => 'Kunnamangalam',
                'city' => 'Kozhikode',
                'pin_code' => '673570',
                'address' => 'IIMK Campus P.O, Kunnamangalam, Kozhikode',
                'university_type' => 'Institute of National Importance',
                'university_name' => 'Indian Institute of Management Kozhikode',
                'college_type' => 'Institute of National Importance / Standalone Management',
                'management' => 'Central Government',
                'website' => 'https://www.iimk.ac.in',
                'year_of_establishment' => 1996,
                'total_enrollment' => 1200,
                'faculty_count' => 105,
                'featured_field_slug' => 'business',
                'fees_range' => '₹11,00,000 – ₹20,50,000/yr',
                'nirf_rank' => 3,
                'naac_grade' => 'AMBA / EQUIS Accredited',
                'average_package' => '₹31.0 LPA',
                'popular_branches' => 'MBA (PGP), PGP in Finance, PGP in Liberal Studies & Management, Ph.D.',
                'description' => 'Perched atop two picturesque hillocks in Kunnamangalam, IIM Kozhikode is ranked #3 in India for management education, pioneer of gender diversity and digital executive education.',
                'courses' => [
                    ['course_name' => 'Master of Business Administration (PGP)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'PGP in Finance (PGP-Finance)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'PGP in Liberal Studies & Management (PGP-LSM)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'Executive Post Graduate Programme in Management (EPGP)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Management & Business Administration'],
                ],
            ],
            [
                'name' => 'Indian Institute of Space Science and Technology (IIST Thiruvananthapuram)',
                'district' => 'Thiruvananthapuram',
                'taluka' => 'Nedumangad',
                'city' => 'Valiamala, Thiruvananthapuram',
                'pin_code' => '695547',
                'address' => 'Valiamala P.O., Nedumangad, Thiruvananthapuram',
                'university_type' => 'Deemed to be University under Department of Space (ISRO)',
                'university_name' => 'IIST Thiruvananthapuram',
                'college_type' => 'Deemed University / Space Technology Institute',
                'management' => 'Central Government',
                'website' => 'https://www.iist.ac.in',
                'year_of_establishment' => 2007,
                'total_enrollment' => 900,
                'faculty_count' => 110,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹70,000 – ₹1,20,000/yr (Direct ISRO Absorption for High CGPA)',
                'nirf_rank' => 48,
                'naac_grade' => 'A+',
                'average_package' => '₹16.0 LPA',
                'popular_branches' => 'B.Tech Aerospace Engineering, B.Tech Avionics, Dual Degree (B.Tech + MS Astronomy/Earth Science)',
                'description' => 'IIST is Asia\'s first space university, functioning under the Department of Space (ISRO), offering direct absorption opportunities into ISRO centers for top performing graduates.',
                'courses' => [
                    ['course_name' => 'B.Tech in Aerospace Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Avionics', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Dual Degree (B.Tech in Engineering Physics + M.S. in Astronomy & Astrophysics)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 60, 'course_category' => 'Space & Astronomical Sciences'],
                    ['course_name' => 'M.Tech in Optical Engineering', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Engineering & Technology'],
                ],
            ],

            // =========================================================================
            // 2. PREMIER STATE UNIVERSITIES
            // =========================================================================
            [
                'name' => 'Cochin University of Science and Technology (CUSAT Kochi)',
                'district' => 'Ernakulam',
                'taluka' => 'Kalamassery',
                'city' => 'Kochi',
                'pin_code' => '682022',
                'address' => 'University Road, South Kalamassery, Kochi',
                'university_type' => 'State Public University',
                'university_name' => 'Cochin University of Science and Technology',
                'college_type' => 'State University',
                'management' => 'State Government',
                'website' => 'https://cusat.ac.in',
                'year_of_establishment' => 1971,
                'total_enrollment' => 9500,
                'faculty_count' => 450,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹45,000 – ₹90,000/yr',
                'nirf_rank' => 37,
                'naac_grade' => 'A++',
                'average_package' => '₹8.8 LPA',
                'popular_branches' => 'B.Tech Marine Engineering, Naval Architecture, CSE, IT, Safety & Fire Engineering, Polymer Science',
                'description' => 'CUSAT is an A++ grade science and technology university in Kochi, famous worldwide for specialized disciplines like Naval Architecture, Marine Engineering, and Fire & Safety Engineering.',
                'courses' => [
                    ['course_name' => 'B.Tech in Marine Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Marine & Naval Engineering'],
                    ['course_name' => 'B.Tech in Naval Architecture and Ship Building', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Marine & Naval Engineering'],
                    ['course_name' => 'B.Tech in Safety and Fire Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Master of Computer Applications (MCA)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Computer Applications'],
                ],
            ],
            [
                'name' => 'College of Engineering, Trivandrum (CET Thiruvananthapuram)',
                'district' => 'Thiruvananthapuram',
                'taluka' => 'Kulathoor',
                'city' => 'Thiruvananthapuram',
                'pin_code' => '695016',
                'address' => 'Engineering College P.O, Sreekaryam, Thiruvananthapuram',
                'university_type' => 'Autonomous College affiliated to KTU',
                'university_name' => 'APJ Abdul Kalam Technological University',
                'college_type' => 'Government Autonomous Engineering College',
                'management' => 'State Government',
                'website' => 'https://www.cet.ac.in',
                'year_of_establishment' => 1939,
                'total_enrollment' => 5200,
                'faculty_count' => 310,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹12,000 – ₹35,000/yr',
                'nirf_rank' => 85,
                'naac_grade' => 'A',
                'average_package' => '₹9.0 LPA',
                'popular_branches' => 'B.Tech CSE, Applied Electronics, Mechanical, Electrical, Civil, B.Arch, MCA',
                'description' => 'CET is the first engineering college in the erstwhile princely state of Travancore, established in 1939 by Maharaja Chithira Thirunal, widely ranked as #1 in KEAM.',
                'courses' => [
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Applied Electronics and Instrumentation Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Mechanical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Bachelor of Architecture (B.Arch)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 60, 'course_category' => 'Architecture & Planning'],
                    ['course_name' => 'Master of Computer Applications (MCA)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Computer Applications'],
                ],
            ],

            // =========================================================================
            // 3. PREMIER MEDICAL & HEALTHCARE INSTITUTIONS
            // =========================================================================
            [
                'name' => 'Government Medical College, Thiruvananthapuram (GMC Trivandrum)',
                'district' => 'Thiruvananthapuram',
                'taluka' => 'Medical College P.O',
                'city' => 'Thiruvananthapuram',
                'pin_code' => '695011',
                'address' => 'Medical College P.O., Thiruvananthapuram',
                'university_type' => 'Affiliated to KUHS',
                'university_name' => 'Kerala University of Health Sciences',
                'college_type' => 'Government Medical College',
                'management' => 'State Government',
                'website' => 'http://tmc.kerala.gov.in',
                'year_of_establishment' => 1951,
                'total_enrollment' => 2200,
                'faculty_count' => 460,
                'featured_field_slug' => 'medical',
                'fees_range' => '₹25,000 – ₹50,000/yr',
                'nirf_rank' => 44,
                'naac_grade' => 'A+',
                'average_package' => '₹14.0 LPA',
                'popular_branches' => 'MBBS, B.Pharm, B.Sc Nursing, MD Medicine, MS Surgery, DM Neurology, M.Ch Cardiovascular',
                'description' => 'Inaugurated by Prime Minister Jawaharlal Nehru in 1951, GMC Trivandrum is Kerala\'s oldest and premier medical institution, handling over 3,000 inpatient beds.',
                'courses' => [
                    ['course_name' => 'Bachelor of Medicine and Bachelor of Surgery (MBBS)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 66, 'course_category' => 'Medicine & Health Sciences'],
                    ['course_name' => 'Bachelor of Pharmacy (B.Pharm)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Pharmacy'],
                    ['course_name' => 'B.Sc. in Nursing', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Nursing & Healthcare'],
                    ['course_name' => 'Doctor of Medicine (MD) in General Medicine', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Medicine & Health Sciences'],
                    ['course_name' => 'Master of Surgery (MS) in General Surgery', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Medicine & Health Sciences'],
                ],
            ],

            // =========================================================================
            // 4. TOP AUTONOMOUS DEGREE COLLEGES
            // =========================================================================
            [
                'name' => 'St. Teresa\'s College (Autonomous, Ernakulam)',
                'district' => 'Ernakulam',
                'taluka' => 'Kochi',
                'city' => 'Ernakulam, Kochi',
                'pin_code' => '682011',
                'address' => 'Park Avenue Road, Marine Drive, Ernakulam, Kochi',
                'university_type' => 'Autonomous College affiliated to MG University',
                'university_name' => 'Mahatma Gandhi University',
                'college_type' => 'Autonomous Women\'s College',
                'management' => 'Private (Aided/Unaided)',
                'website' => 'https://teresas.ac.in',
                'year_of_establishment' => 1925,
                'total_enrollment' => 4800,
                'faculty_count' => 220,
                'featured_field_slug' => 'commerce',
                'fees_range' => '₹25,000 – ₹75,000/yr',
                'nirf_rank' => 41,
                'naac_grade' => 'A++',
                'average_package' => '₹5.5 LPA',
                'popular_branches' => 'B.Com, BBA, B.A. English/Economics, B.Sc Apparel & Fashion Design, M.Sc, M.Com',
                'description' => 'Awarded NAAC A++ with a 3.57 CGPA, St. Teresa\'s is one of Kerala\'s premier autonomous women\'s colleges located overlooking the Cochin backwaters.',
                'courses' => [
                    ['course_name' => 'Bachelor of Commerce (B.Com)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Aided', 'course_duration_months' => 36, 'course_category' => 'Commerce & Accountancy'],
                    ['course_name' => 'Bachelor of Business Administration (BBA)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 36, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'B.Sc. in Apparel and Fashion Design', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 36, 'course_category' => 'Design & Fashion'],
                    ['course_name' => 'Bachelor of Arts (B.A.) in English Language and Literature', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Aided', 'course_duration_months' => 36, 'course_category' => 'Languages & Literature'],
                    ['course_name' => 'Master of Science (M.Sc) in Chemistry', 'course_type' => 'Post Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Aided', 'course_duration_months' => 24, 'course_category' => 'Natural Sciences'],
                ],
            ],
            [
                'name' => 'Sacred Heart College (Autonomous, Thevara, Kochi)',
                'district' => 'Ernakulam',
                'taluka' => 'Thevara',
                'city' => 'Kochi',
                'pin_code' => '682013',
                'address' => 'Pandit Karuppan Road, Thevara, Kochi',
                'university_type' => 'Autonomous College affiliated to MG University',
                'university_name' => 'Mahatma Gandhi University',
                'college_type' => 'Autonomous College',
                'management' => 'Private (Aided/Unaided)',
                'website' => 'https://www.shcollege.ac.in',
                'year_of_establishment' => 1944,
                'total_enrollment' => 4500,
                'faculty_count' => 210,
                'featured_field_slug' => 'science',
                'fees_range' => '₹25,000 – ₹80,000/yr',
                'nirf_rank' => 72,
                'naac_grade' => 'A+',
                'average_package' => '₹5.5 LPA',
                'popular_branches' => 'B.Sc Computer Science/Physics, B.Com, BBA, B.A. Animation & Graphic Design, M.Sc, M.Com',
                'description' => 'Established in 1944 by the Carmelites of Mary Immaculate (CMI), Sacred Heart College is a premier arts and science institution on the tranquil backwaters of Kochi.',
                'courses' => [
                    ['course_name' => 'Bachelor of Commerce (B.Com)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Aided', 'course_duration_months' => 36, 'course_category' => 'Commerce & Accountancy'],
                    ['course_name' => 'B.A. in Animation and Graphic Design', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 36, 'course_category' => 'Design & Animation'],
                    ['course_name' => 'Bachelor of Science (B.Sc) in Computer Applications', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 36, 'course_category' => 'Computer Applications'],
                    ['course_name' => 'Bachelor of Science (B.Sc) in Physics', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Aided', 'course_duration_months' => 36, 'course_category' => 'Natural Sciences'],
                    ['course_name' => 'Master of Science (M.Sc) in Environmental Science', 'course_type' => 'Post Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Aided', 'course_duration_months' => 24, 'course_category' => 'Environmental Science'],
                ],
            ],
        ];
    }
}
