<?php

namespace Database\Seeders\States;

use App\Models\IndianCollege;
use App\Models\College;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class GujaratCollegeSeeder extends Seeder
{
    /**
     * Run the Gujarat colleges and universities database seeder.
     */
    public function run(): void
    {
        $this->command?->info("🏛️  Seeding Gujarat Public & Private Universities and Degree Colleges...");

        $institutions = $this->getGujaratInstitutionsData();
        $fieldsMap = Field::pluck('id', 'slug')->toArray();

        $totalColleges = 0;
        $totalCourseRows = 0;
        $totalFeaturedColleges = 0;

        foreach ($institutions as $inst) {
            $totalColleges++;
            $collegeName = $inst['name'];

            // 1. Remove legacy stub records in Gujarat to prevent duplication
            DB::table('indian_colleges')
                ->where('state', 'Gujarat')
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
                    'state'                  => 'Gujarat',
                    'district'               => $inst['district'] ?? 'Ahmedabad',
                    'taluka'                 => $inst['taluka'] ?? $inst['district'] ?? 'Ahmedabad',
                    'university_type'        => $inst['university_type'] ?? 'State University',
                    'university_name'        => $inst['university_name'] ?? $collegeName,
                    'college_type'           => $inst['college_type'] ?? 'University / College',
                    'affiliation'            => $inst['affiliation'] ?? 'UGC Recognized',
                    'management'             => $inst['management'] ?? 'Private (Unaided)',
                    'website'                => $inst['website'] ?? null,
                    'year_of_establishment'  => $inst['year_of_establishment'] ?? null,
                    'address'                => $inst['address'] ?? null,
                    'city'                   => $inst['city'] ?? 'Ahmedabad',
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
                    'state'    => 'Gujarat',
                    'field_id' => $fieldId,
                ],
                [
                    'location'                 => $inst['city'] ?? 'Ahmedabad',
                    'fees_range'               => $inst['fees_range'] ?? '₹35,000 – ₹2,20,000/yr',
                    'type'                     => str_contains(strtolower($inst['management'] ?? ''), 'gov') || str_contains(strtolower($inst['management'] ?? ''), 'central') ? 'Government' : 'Private',
                    'website'                  => $inst['website'] ?? null,
                    'rank'                     => $inst['nirf_rank'] ?? null,
                    'government_rank'          => $inst['nirf_rank'] ?? null,
                    'naac_grade'               => $inst['naac_grade'] ?? 'A+',
                    'popular_branches'         => $inst['popular_branches'] ?? implode(', ', array_slice(array_column($courses, 'course_name'), 0, 4)),
                    'cutoff'                   => $inst['cutoff'] ?? 'Based on GUJCET / JEE Main / NEET / ACPC Gujarat',
                    'placement_support'        => $inst['placement_support'] ?? 'Strong corporate linkages across chemical, petrochemical, manufacturing, and IT sectors',
                    'facilities'               => $inst['facilities'] ?? 'Central Library, Advanced Laboratories, Modern Auditoriums, Wi-Fi Campus, Hostels, Innovation Start-up Center',
                    'description'              => $inst['description'] ?? "{$collegeName} is a premier educational institution in Gujarat offering industry-aligned degrees and entrepreneurial culture.",
                    'average_package'          => $inst['average_package'] ?? '₹6.5 - ₹17.5 LPA',
                    'tier'                     => $inst['tier'] ?? 'Tier 1',
                    'duration'                 => '3 - 5 Years',
                    'specializations'          => $inst['specializations'] ?? 'Undergraduate, Postgraduate & Doctoral Degrees',
                    'research_support'         => 'Extensive state and central research grants, industrial MOUs, and incubators',
                    'internship_opportunities' => 'Mandatory industrial training, corporate internships, and live research fellowships',
                ]
            );
            $totalFeaturedColleges++;
        }

        // Clear cache so new colleges appear in autocomplete and fuzzy search
        Cache::forget('indian_college_names');

        $this->command?->info("✅ Gujarat Chunk Completed: {$totalColleges} institutions seeded with {$totalCourseRows} course records and {$totalFeaturedColleges} featured colleges!");
    }

    /**
     * Get comprehensive dataset of Gujarat's Public & Private Universities and Degree Colleges.
     */
    private function getGujaratInstitutionsData(): array
    {
        return [
            // =========================================================================
            // 1. INSTITUTES OF NATIONAL IMPORTANCE & PREMIER CENTRAL INSTITUTIONS
            // =========================================================================
            [
                'name' => 'Indian Institute of Management Ahmedabad (IIM Ahmedabad)',
                'district' => 'Ahmedabad',
                'taluka' => 'Vastrapur',
                'city' => 'Ahmedabad',
                'pin_code' => '380015',
                'address' => 'Sargam Marg, Vastrapur, Ahmedabad',
                'university_type' => 'Institute of National Importance',
                'university_name' => 'Indian Institute of Management Ahmedabad',
                'college_type' => 'Institute of National Importance / Standalone Management',
                'management' => 'Central Government',
                'website' => 'https://www.iima.ac.in',
                'year_of_establishment' => 1961,
                'total_enrollment' => 1200,
                'faculty_count' => 105,
                'featured_field_slug' => 'business',
                'fees_range' => '₹12,50,000 – ₹25,00,000/yr',
                'nirf_rank' => 1,
                'naac_grade' => 'EQUIS Accredited',
                'average_package' => '₹36.5 LPA',
                'popular_branches' => 'MBA (PGP), PGP in Food and Agribusiness (FABM), Executive MBA (PGPX), Ph.D.',
                'description' => 'IIM Ahmedabad is India\'s undisputed #1 business school and a globally revered institution, pioneer of the Case Study method and incubator of global business icons.',
                'courses' => [
                    ['course_name' => 'Master of Business Administration (MBA - PGP)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'MBA in Food & Agri-Business Management (PGP-FABM)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Agribusiness Management'],
                    ['course_name' => 'Post Graduate Programme in Management for Executives (PGPX)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 12, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'Doctoral Programme in Management (Ph.D.)', 'course_type' => 'Doctoral Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 60, 'course_category' => 'Research & Ph.D.'],
                ],
            ],
            [
                'name' => 'Indian Institute of Technology Gandhinagar (IITGN)',
                'district' => 'Gandhinagar',
                'taluka' => 'Palaj',
                'city' => 'Gandhinagar',
                'pin_code' => '382355',
                'address' => 'Palaj, Gandhinagar',
                'university_type' => 'Institute of National Importance',
                'university_name' => 'Indian Institute of Technology Gandhinagar',
                'college_type' => 'Institute of National Importance',
                'management' => 'Central Government',
                'website' => 'https://iitgn.ac.in',
                'year_of_establishment' => 2008,
                'total_enrollment' => 2400,
                'faculty_count' => 170,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹2,10,000 – ₹2,50,000/yr',
                'nirf_rank' => 18,
                'naac_grade' => 'A++',
                'average_package' => '₹19.5 LPA',
                'popular_branches' => 'B.Tech CSE, Electrical, Mechanical, Chemical, Civil, Materials, M.Sc, M.A.',
                'description' => 'Located on the banks of the Sabarmati river, IITGN is known for holistic undergraduate education, five-week foundation programs, and modern research facilities.',
                'courses' => [
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Electrical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Mechanical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Chemical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'M.Sc. in Cognitive Science', 'course_type' => 'Post Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Cognitive Sciences'],
                ],
            ],
            [
                'name' => 'Sardar Vallabhbhai National Institute of Technology (SVNIT Surat)',
                'district' => 'Surat',
                'taluka' => 'Ichchhanath',
                'city' => 'Surat',
                'pin_code' => '395007',
                'address' => 'Ichchhanath Circle, Dumas Road, Surat',
                'university_type' => 'Institute of National Importance',
                'university_name' => 'SVNIT Surat',
                'college_type' => 'Institute of National Importance',
                'management' => 'Central Government',
                'website' => 'https://www.svnit.ac.in',
                'year_of_establishment' => 1961,
                'total_enrollment' => 5200,
                'faculty_count' => 260,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹1,40,000 – ₹1,80,000/yr',
                'nirf_rank' => 65,
                'naac_grade' => 'A+',
                'average_package' => '₹14.2 LPA',
                'popular_branches' => 'B.Tech CSE, AI, Mechanical, Chemical, Electrical, Civil, Integrated M.Sc',
                'description' => 'SVNIT Surat is a premier National Institute of Technology located in the diamond and textile hub of Surat, celebrated for strong chemical and mechanical engineering traditions.',
                'courses' => [
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Artificial Intelligence', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Chemical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Mechanical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Integrated M.Sc. in Applied Physics (5-Year)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 60, 'course_category' => 'Natural Sciences'],
                ],
            ],
            [
                'name' => 'Gujarat National Law University (GNLU Gandhinagar)',
                'district' => 'Gandhinagar',
                'taluka' => 'Koba',
                'city' => 'Gandhinagar',
                'pin_code' => '382426',
                'address' => 'Attalika Avenue, Knowledge Corridor, Koba, Gandhinagar',
                'university_type' => 'National Law University',
                'university_name' => 'Gujarat National Law University',
                'college_type' => 'National Law University',
                'management' => 'State Government',
                'website' => 'https://www.gnlu.ac.in',
                'year_of_establishment' => 2003,
                'total_enrollment' => 1400,
                'faculty_count' => 85,
                'featured_field_slug' => 'teaching-law',
                'fees_range' => '₹2,50,000 – ₹3,20,000/yr',
                'nirf_rank' => 7,
                'naac_grade' => 'A++',
                'average_package' => '₹15.0 LPA',
                'popular_branches' => 'B.A. LL.B., B.Com. LL.B., B.Sc. LL.B., BBA LL.B., BSW LL.B., LL.M., Ph.D.',
                'description' => 'GNLU is the only NLU in India offering five distinct integrated undergraduate law streams (Arts, Commerce, Science, Business, and Social Work), renowned for maritime and corporate law.',
                'courses' => [
                    ['course_name' => 'B.A. LL.B. (Hons.) 5-Year Integrated', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 60, 'course_category' => 'Law & Legal Studies'],
                    ['course_name' => 'B.Com. LL.B. (Hons.) 5-Year Integrated', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 60, 'course_category' => 'Law & Legal Studies'],
                    ['course_name' => 'BBA LL.B. (Hons.) 5-Year Integrated', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 60, 'course_category' => 'Law & Legal Studies'],
                    ['course_name' => 'B.Sc. LL.B. (Hons.) 5-Year Integrated', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 60, 'course_category' => 'Law & Legal Studies'],
                    ['course_name' => 'Master of Laws (LL.M.) in Maritime Law', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 12, 'course_category' => 'Law & Legal Studies'],
                ],
            ],

            // =========================================================================
            // 2. PREMIER STATE UNIVERSITIES
            // =========================================================================
            [
                'name' => 'Maharaja Sayajirao University of Baroda (MSU Baroda, Vadodara)',
                'district' => 'Vadodara',
                'taluka' => 'Vadodara',
                'city' => 'Vadodara',
                'pin_code' => '390002',
                'address' => 'Pratapgunj, Vadodara',
                'university_type' => 'State Public Residential University',
                'university_name' => 'Maharaja Sayajirao University of Baroda',
                'college_type' => 'State University',
                'management' => 'State Government',
                'website' => 'https://www.msubaroda.ac.in',
                'year_of_establishment' => 1949,
                'total_enrollment' => 38000,
                'faculty_count' => 1200,
                'featured_field_slug' => 'science',
                'fees_range' => '₹10,000 – ₹50,000/yr',
                'nirf_rank' => 88,
                'naac_grade' => 'A+',
                'average_package' => '₹6.5 LPA',
                'popular_branches' => 'B.E. (Faculty of Tech & Engg), Fine Arts, Commerce, Pharmacy, B.Sc, M.Sc, Ph.D.',
                'description' => 'MSU Baroda is the only English-medium state university in Gujarat, with world-famous faculties of Fine Arts, Performing Arts, Technology & Engineering (FTE), and Commerce.',
                'courses' => [
                    ['course_name' => 'B.E. in Computer Science and Engineering (FTE MSU)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.E. in Chemical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Bachelor of Visual Arts (BVA in Painting / Applied Arts)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Design & Fine Arts'],
                    ['course_name' => 'Bachelor of Pharmacy (B.Pharm)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Pharmacy'],
                    ['course_name' => 'Bachelor of Commerce (B.Com)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Commerce & Accountancy'],
                ],
            ],
            [
                'name' => 'L.D. College of Engineering (LDCE Ahmedabad)',
                'district' => 'Ahmedabad',
                'taluka' => 'Navrangpura',
                'city' => 'Ahmedabad',
                'pin_code' => '380015',
                'address' => 'Opposite Gujarat University, Navrangpura, Ahmedabad',
                'university_type' => 'Autonomous Government College affiliated to GTU',
                'university_name' => 'Gujarat Technological University',
                'college_type' => 'Government Engineering College',
                'management' => 'State Government',
                'website' => 'https://ldce.ac.in',
                'year_of_establishment' => 1948,
                'total_enrollment' => 6000,
                'faculty_count' => 310,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹1,500 – ₹5,000/yr (Highly Subsidized)',
                'nirf_rank' => 120,
                'naac_grade' => 'A',
                'average_package' => '₹7.8 LPA',
                'popular_branches' => 'B.E. Computer Engineering, IT, Mechanical, Chemical, Civil, Electrical, Automobile',
                'description' => 'Established in 1948 by industrialist Kasturbhai Lalbhai, LDCE is the premier government engineering institution in Gujarat, attracting top GUJCET rankers.',
                'courses' => [
                    ['course_name' => 'B.E. in Computer Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.E. in Information Technology', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.E. in Chemical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.E. in Mechanical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Master of Computer Applications (MCA)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Computer Applications'],
                ],
            ],

            // =========================================================================
            // 3. PROMINENT PRIVATE & DEEMED UNIVERSITIES IN GUJARAT
            // =========================================================================
            [
                'name' => 'Dhirubhai Ambani Institute of Information and Communication Technology (DA-IICT Gandhinagar)',
                'district' => 'Gandhinagar',
                'taluka' => 'Gandhinagar',
                'city' => 'Gandhinagar',
                'pin_code' => '382007',
                'address' => 'Near Indroda Circle, Gandhinagar',
                'university_type' => 'State Private University',
                'university_name' => 'DA-IICT',
                'college_type' => 'Private University / ICT Specialization',
                'management' => 'Private (Unaided)',
                'website' => 'https://www.daiict.ac.in',
                'year_of_establishment' => 2001,
                'total_enrollment' => 2200,
                'faculty_count' => 110,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹2,20,000 – ₹3,20,000/yr',
                'nirf_rank' => 85,
                'naac_grade' => 'A+',
                'average_package' => '₹17.5 LPA',
                'popular_branches' => 'B.Tech Information & Communication Technology (ICT), Mathematics & Computing, M.Tech, M.Des',
                'description' => 'DA-IICT is Gujarat\'s premier ICT research university, founded by Reliance Group, renowned for elite coding culture, Google Summer of Code selections, and top compensation packages.',
                'courses' => [
                    ['course_name' => 'B.Tech in Information and Communication Technology (ICT)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech (Honours) in ICT with Minor in Computational Science', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Mathematics and Computing (MnC)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Master of Science in Data Science (M.Sc. DS)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 24, 'course_category' => 'Data Science'],
                    ['course_name' => 'Master of Design (M.Des in Communication Design)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 24, 'course_category' => 'Design & Fine Arts'],
                ],
            ],
            [
                'name' => 'Pandit Deendayal Energy University (PDEU / PDPU Gandhinagar)',
                'district' => 'Gandhinagar',
                'taluka' => 'Koba',
                'city' => 'Gandhinagar',
                'pin_code' => '382007',
                'address' => 'Knowledge Corridor, Raisan Village, Gandhinagar',
                'university_type' => 'State Private University',
                'university_name' => 'Pandit Deendayal Energy University',
                'college_type' => 'Private University',
                'management' => 'Private (Unaided)',
                'website' => 'https://www.pdeu.ac.in',
                'year_of_establishment' => 2007,
                'total_enrollment' => 7500,
                'faculty_count' => 380,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹2,40,000 – ₹3,40,000/yr',
                'nirf_rank' => 90,
                'naac_grade' => 'A++',
                'average_package' => '₹9.0 LPA',
                'popular_branches' => 'B.Tech Petroleum, Computer Science, Chemical, Solar Energy, MBA (Energy & Infrastructure)',
                'description' => 'Established by GERMI and supported by Reliance & ONGC, PDEU is India\'s top energy sector university, expanding into computing, renewable energy, and liberal studies.',
                'courses' => [
                    ['course_name' => 'B.Tech in Petroleum Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Petroleum & Energy Engineering'],
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Chemical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'MBA in Energy and Infrastructure', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 24, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'Bachelor of Business Administration (BBA Honours)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 36, 'course_category' => 'Management & Business Administration'],
                ],
            ],
            [
                'name' => 'Nirma University (Ahmedabad)',
                'district' => 'Ahmedabad',
                'taluka' => 'Chharodi',
                'city' => 'Ahmedabad',
                'pin_code' => '382481',
                'address' => 'Sarkhej - Gandhinagar Hwy, Gota, Ahmedabad',
                'university_type' => 'State Private University',
                'university_name' => 'Nirma University',
                'college_type' => 'Private University',
                'management' => 'Private (Unaided)',
                'website' => 'https://nirmauni.ac.in',
                'year_of_establishment' => 2003,
                'total_enrollment' => 9000,
                'faculty_count' => 480,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹1,90,000 – ₹3,50,000/yr',
                'nirf_rank' => 95,
                'naac_grade' => 'A+',
                'average_package' => '₹9.2 LPA',
                'popular_branches' => 'B.Tech CSE, Mechanical, Chemical, Institute of Management MBA, B.Pharm, Law (BA/BBA LL.B)',
                'description' => 'Founded by industrialist Dr. Karsanbhai Patel (Nirma Group), Nirma University is a premier private multidisciplinary university on SG Highway known for academic discipline and placements.',
                'courses' => [
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Chemical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Bachelor of Pharmacy (B.Pharm)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Pharmacy'],
                    ['course_name' => 'Master of Business Administration (MBA)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 24, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'B.A. LL.B. (Hons.) 5-Year Integrated', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 60, 'course_category' => 'Law & Legal Studies'],
                ],
            ],
            [
                'name' => 'Parul University (Vadodara)',
                'district' => 'Vadodara',
                'taluka' => 'Waghodia',
                'city' => 'Vadodara',
                'pin_code' => '391760',
                'address' => 'PO Limda, Tal. Waghodia, Vadodara',
                'university_type' => 'State Private University',
                'university_name' => 'Parul University',
                'college_type' => 'Private University',
                'management' => 'Private (Unaided)',
                'website' => 'https://paruluniversity.ac.in',
                'year_of_establishment' => 2015,
                'total_enrollment' => 35000,
                'faculty_count' => 1900,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹80,000 – ₹1,90,000/yr',
                'nirf_rank' => 130,
                'naac_grade' => 'A++',
                'average_package' => '₹6.2 LPA',
                'popular_branches' => 'B.Tech CSE, AI, Robotics, MBBS (PIMSR), B.Pharm, BAMS, BHMS, BBA, MBA, Design',
                'description' => 'Parul University is one of India\'s largest composite private universities, awarded NAAC A++ in its very first cycle, with 150+-acre green campus and international student presence from 60+ countries.',
                'courses' => [
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Artificial Intelligence & Machine Learning', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Bachelor of Medicine and Bachelor of Surgery (MBBS - PIMSR)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 66, 'course_category' => 'Medicine & Health Sciences'],
                    ['course_name' => 'Bachelor of Pharmacy (B.Pharm)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Pharmacy'],
                    ['course_name' => 'Bachelor of Ayurvedic Medicine and Surgery (BAMS)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 66, 'course_category' => 'Ayush & Traditional Medicine'],
                    ['course_name' => 'Master of Business Administration (MBA)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 24, 'course_category' => 'Management & Business Administration'],
                ],
            ],
        ];
    }
}
