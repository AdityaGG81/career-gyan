<?php

namespace Database\Seeders\States;

use App\Models\IndianCollege;
use App\Models\College;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class WestBengalCollegeSeeder extends Seeder
{
    /**
     * Run the West Bengal colleges and universities database seeder.
     */
    public function run(): void
    {
        $this->command?->info("🏛️  Seeding West Bengal Public & Private Universities and Degree Colleges...");

        $institutions = $this->getWestBengalInstitutionsData();
        $fieldsMap = Field::pluck('id', 'slug')->toArray();

        $totalColleges = 0;
        $totalCourseRows = 0;
        $totalFeaturedColleges = 0;

        foreach ($institutions as $inst) {
            $totalColleges++;
            $collegeName = $inst['name'];

            // 1. Remove legacy stub records in West Bengal to prevent duplication
            DB::table('indian_colleges')
                ->where('state', 'West Bengal')
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
                    'state'                  => 'West Bengal',
                    'district'               => $inst['district'] ?? 'Kolkata',
                    'taluka'                 => $inst['taluka'] ?? $inst['district'] ?? 'Kolkata',
                    'university_type'        => $inst['university_type'] ?? 'State University',
                    'university_name'        => $inst['university_name'] ?? $collegeName,
                    'college_type'           => $inst['college_type'] ?? 'University / College',
                    'affiliation'            => $inst['affiliation'] ?? 'UGC Recognized',
                    'management'             => $inst['management'] ?? 'Private (Unaided)',
                    'website'                => $inst['website'] ?? null,
                    'year_of_establishment'  => $inst['year_of_establishment'] ?? null,
                    'address'                => $inst['address'] ?? null,
                    'city'                   => $inst['city'] ?? 'Kolkata',
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
                    'state'    => 'West Bengal',
                    'field_id' => $fieldId,
                ],
                [
                    'location'                 => $inst['city'] ?? 'Kolkata',
                    'fees_range'               => $inst['fees_range'] ?? '₹25,000 – ₹1,80,000/yr',
                    'type'                     => str_contains(strtolower($inst['management'] ?? ''), 'gov') || str_contains(strtolower($inst['management'] ?? ''), 'central') ? 'Government' : 'Private',
                    'website'                  => $inst['website'] ?? null,
                    'rank'                     => $inst['nirf_rank'] ?? null,
                    'government_rank'          => $inst['nirf_rank'] ?? null,
                    'naac_grade'               => $inst['naac_grade'] ?? 'A+',
                    'popular_branches'         => $inst['popular_branches'] ?? implode(', ', array_slice(array_column($courses, 'course_name'), 0, 4)),
                    'cutoff'                   => $inst['cutoff'] ?? 'Based on WBJEE / JEE Main / NEET / CUET / CAT entrance scores',
                    'placement_support'        => $inst['placement_support'] ?? 'Active central placement cell with top research organizations and Fortune 500 recruiters',
                    'facilities'               => $inst['facilities'] ?? 'Heritage Library, High-End Computing Labs, Wi-Fi Campus, Cultural Auditorium, Hostels, Sports Complex',
                    'description'              => $inst['description'] ?? "{$collegeName} is a premier educational institution in West Bengal recognized for rich academic heritage and scientific research.",
                    'average_package'          => $inst['average_package'] ?? '₹6.5 - ₹17.0 LPA',
                    'tier'                     => $inst['tier'] ?? 'Tier 1',
                    'duration'                 => '3 - 5 Years',
                    'specializations'          => $inst['specializations'] ?? 'Undergraduate, Postgraduate & Doctoral Degrees',
                    'research_support'         => 'Extensive central government grants, DST-SERB funded laboratories, and foreign university partnerships',
                    'internship_opportunities' => 'Mandatory industrial training, corporate internships, and live research fellowships',
                ]
            );
            $totalFeaturedColleges++;
        }

        // Clear cache so new colleges appear in autocomplete and fuzzy search
        Cache::forget('indian_college_names');

        $this->command?->info("✅ West Bengal Chunk Completed: {$totalColleges} institutions seeded with {$totalCourseRows} course records and {$totalFeaturedColleges} featured colleges!");
    }

    /**
     * Get comprehensive dataset of West Bengal's Public & Private Universities and Degree Colleges.
     */
    private function getWestBengalInstitutionsData(): array
    {
        return [
            // =========================================================================
            // 1. INSTITUTES OF NATIONAL IMPORTANCE & PREMIER CENTRAL INSTITUTIONS
            // =========================================================================
            [
                'name' => 'Indian Institute of Technology Kharagpur (IIT Kharagpur)',
                'district' => 'Paschim Medinipur',
                'taluka' => 'Kharagpur',
                'city' => 'Kharagpur',
                'pin_code' => '721302',
                'address' => 'IIT Kharagpur Campus, Kharagpur',
                'university_type' => 'Institute of National Importance (IoE)',
                'university_name' => 'Indian Institute of Technology Kharagpur',
                'college_type' => 'Institute of National Importance',
                'management' => 'Central Government',
                'website' => 'https://www.iitkgp.ac.in',
                'year_of_establishment' => 1951,
                'total_enrollment' => 15000,
                'faculty_count' => 850,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹2,10,000 – ₹2,50,000/yr',
                'nirf_rank' => 6,
                'naac_grade' => 'A++',
                'average_package' => '₹24.0 LPA',
                'popular_branches' => 'B.Tech CSE, Electrical, Ocean & Naval Architecture, Mining, Aerospace, B.Arch, MBA (VGSOM)',
                'description' => 'IIT Kharagpur is the first IIT established in India, spread over 2,100 acres, boasting the largest campus and highest number of academic departments and students among all IITs.',
                'courses' => [
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Ocean Engineering and Naval Architecture', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Mining Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Electrical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Bachelor of Architecture (B.Arch)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 60, 'course_category' => 'Architecture & Planning'],
                    ['course_name' => 'LL.B. in Intellectual Property Law (Rajiv Gandhi SOIPL)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Law & Legal Studies'],
                ],
            ],
            [
                'name' => 'Indian Institute of Management Calcutta (IIM Calcutta)',
                'district' => 'Kolkata',
                'taluka' => 'Joka',
                'city' => 'Kolkata',
                'pin_code' => '700104',
                'address' => 'Diamond Harbour Road, Joka, Kolkata',
                'university_type' => 'Institute of National Importance',
                'university_name' => 'Indian Institute of Management Calcutta',
                'college_type' => 'Institute of National Importance / Standalone Management',
                'management' => 'Central Government',
                'website' => 'https://www.iimcal.ac.in',
                'year_of_establishment' => 1961,
                'total_enrollment' => 1400,
                'faculty_count' => 110,
                'featured_field_slug' => 'business',
                'fees_range' => '₹12,00,000 – ₹24,00,000/yr',
                'nirf_rank' => 4,
                'naac_grade' => 'Triple Crown (AACSB, AMBA, EQUIS)',
                'average_package' => '₹35.0 LPA',
                'popular_branches' => 'MBA (PGP), Executive MBA (MBAEx), Post Graduate Diploma in Business Analytics (PGDBA)',
                'description' => 'IIM Calcutta was the first IIM established in India, renowned worldwide as India\'s finance capital of management education and the first to achieve the prestigious Triple Crown accreditation.',
                'courses' => [
                    ['course_name' => 'Master of Business Administration (MBA PGP)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'Post Graduate Diploma in Business Analytics (PGDBA - Joint with ISI & IIT KGP)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Business Analytics & Data Science'],
                    ['course_name' => 'Executive MBA (MBAEx)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 12, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'Doctor of Philosophy (Ph.D.) in Management', 'course_type' => 'Doctoral Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 60, 'course_category' => 'Research & Ph.D.'],
                ],
            ],
            [
                'name' => 'Indian Statistical Institute (ISI Kolkata)',
                'district' => 'Kolkata',
                'taluka' => 'Baranagar',
                'city' => 'Kolkata',
                'pin_code' => '700108',
                'address' => '203 Barrackpore Trunk Road, Baranagar, Kolkata',
                'university_type' => 'Institute of National Importance',
                'university_name' => 'Indian Statistical Institute',
                'college_type' => 'Institute of National Importance',
                'management' => 'Central Government',
                'website' => 'https://www.isical.ac.in',
                'year_of_establishment' => 1931,
                'total_enrollment' => 900,
                'faculty_count' => 160,
                'featured_field_slug' => 'science',
                'fees_range' => '₹0 – ₹10,000/yr (Fully Funded Fellowship)',
                'nirf_rank' => 2,
                'naac_grade' => 'A++',
                'average_package' => '₹27.5 LPA',
                'popular_branches' => 'B.Stat (Hons), B.Math (Hons), M.Stat, M.Math, M.Tech Computer Science, Ph.D.',
                'description' => 'Founded by Professor P. C. Mahalanobis, ISI Kolkata is a legendary Institute of National Importance celebrated globally as the cradle of modern statistical and mathematical science in India.',
                'courses' => [
                    ['course_name' => 'Bachelor of Statistics (B.Stat Honours)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Mathematics & Statistics'],
                    ['course_name' => 'Master of Statistics (M.Stat)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Mathematics & Statistics'],
                    ['course_name' => 'M.Tech in Computer Science', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'M.Tech in Cryptology and Security', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Cybersecurity & Computing'],
                    ['course_name' => 'Doctor of Philosophy (Ph.D.) in Statistics & Mathematics', 'course_type' => 'Doctoral Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 60, 'course_category' => 'Research & Ph.D.'],
                ],
            ],
            [
                'name' => 'Indian Institute of Engineering Science and Technology, Shibpur (IIEST Shibpur)',
                'district' => 'Howrah',
                'taluka' => 'Shibpur',
                'city' => 'Howrah',
                'pin_code' => '711103',
                'address' => 'PO Botanic Garden, Shalimar, Shibpur, Howrah',
                'university_type' => 'Institute of National Importance',
                'university_name' => 'IIEST Shibpur',
                'college_type' => 'Institute of National Importance / Engineering',
                'management' => 'Central Government',
                'website' => 'https://www.iiests.ac.in',
                'year_of_establishment' => 1856,
                'total_enrollment' => 4500,
                'faculty_count' => 260,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹1,40,000 – ₹1,80,000/yr',
                'nirf_rank' => 35,
                'naac_grade' => 'A',
                'average_package' => '₹12.5 LPA',
                'popular_branches' => 'B.Tech CSE, IT, ECE, Mechanical, Civil, Mining, Aerospace, B.Arch',
                'description' => 'Formerly Bengal Engineering College Shibpur, IIEST Shibpur is the second oldest engineering college in India, renowned for its heritage campus and distinguished alumni in public infrastructure.',
                'courses' => [
                    ['course_name' => 'B.Tech in Computer Science and Technology', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Information Technology', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Electronics and Telecommunication Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Civil Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Bachelor of Architecture (B.Arch)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 60, 'course_category' => 'Architecture & Planning'],
                ],
            ],

            // =========================================================================
            // 2. PREMIER STATE UNIVERSITIES
            // =========================================================================
            [
                'name' => 'Jadavpur University (Kolkata)',
                'district' => 'Kolkata',
                'taluka' => 'Jadavpur',
                'city' => 'Kolkata',
                'pin_code' => '700032',
                'address' => '188, Raja S.C. Mallick Rd, Jadavpur, Kolkata',
                'university_type' => 'State Public University',
                'university_name' => 'Jadavpur University',
                'college_type' => 'State University',
                'management' => 'State Government',
                'website' => 'http://www.jaduniv.edu.in',
                'year_of_establishment' => 1955,
                'total_enrollment' => 12000,
                'faculty_count' => 650,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹3,000 – ₹25,000/yr (Highly Subsidized)',
                'nirf_rank' => 4,
                'naac_grade' => 'A++',
                'average_package' => '₹18.5 LPA',
                'popular_branches' => 'B.E. Computer Science, IT, Electronics, Mechanical, Chemical, Printing, B.A. English/Comparative Lit',
                'description' => 'Jadavpur University is consistently ranked among the top 5 universities in India, renowned for world-class engineering and arts education at nominal government tuition fees.',
                'courses' => [
                    ['course_name' => 'B.E. in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.E. in Information Technology', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.E. in Electronics and Telecommunication Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.E. in Mechanical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Bachelor of Pharmacy (B.Pharm)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Pharmacy'],
                    ['course_name' => 'B.A. (Hons.) in Comparative Literature', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Languages & Literature'],
                ],
            ],
            [
                'name' => 'University of Calcutta (Kolkata)',
                'district' => 'Kolkata',
                'taluka' => 'College Street',
                'city' => 'Kolkata',
                'pin_code' => '700073',
                'address' => '87/1, College Street, Kolkata',
                'university_type' => 'State Public University',
                'university_name' => 'University of Calcutta',
                'college_type' => 'State University',
                'management' => 'State Government',
                'website' => 'https://www.caluniv.ac.in',
                'year_of_establishment' => 1857,
                'total_enrollment' => 28000,
                'faculty_count' => 900,
                'featured_field_slug' => 'science',
                'fees_range' => '₹4,000 – ₹35,000/yr',
                'nirf_rank' => 12,
                'naac_grade' => 'A++',
                'average_package' => '₹6.2 LPA',
                'popular_branches' => 'B.Tech Radio Physics/Optics, M.Sc Physics/Chemistry, B.A. LL.B., M.Com, MBA, Ph.D.',
                'description' => 'The University of Calcutta is the first multidisciplinary modern university in South Asia, alma mater to four Chief Ministers of West Bengal, five Nobel laureates, and prominent national leaders.',
                'courses' => [
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Radio Physics and Electronics', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.A. LL.B. (5-Year Integrated Course)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 60, 'course_category' => 'Law & Legal Studies'],
                    ['course_name' => 'Master of Science (M.Sc) in Pure Physics', 'course_type' => 'Post Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Natural Sciences'],
                    ['course_name' => 'Master of Commerce (M.Com)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Commerce & Accountancy'],
                ],
            ],
            [
                'name' => 'Presidency University (Kolkata)',
                'district' => 'Kolkata',
                'taluka' => 'College Street',
                'city' => 'Kolkata',
                'pin_code' => '700073',
                'address' => '86/1, College Street, Kolkata',
                'university_type' => 'State Public University',
                'university_name' => 'Presidency University',
                'college_type' => 'State University',
                'management' => 'State Government',
                'website' => 'https://www.presiuniv.ac.in',
                'year_of_establishment' => 1817,
                'total_enrollment' => 3500,
                'faculty_count' => 220,
                'featured_field_slug' => 'arts-humanities',
                'fees_range' => '₹5,000 – ₹20,000/yr',
                'nirf_rank' => 54,
                'naac_grade' => 'A',
                'average_package' => '₹7.0 LPA',
                'popular_branches' => 'B.A. (Hons) Economics, English, History, B.Sc (Hons) Physics, Geology, Mathematics',
                'description' => 'Formerly Hindoo College (1817) and Presidency College, this historic institution educated Swami Vivekananda, Satyajit Ray, Amartya Sen, and Subhas Chandra Bose.',
                'courses' => [
                    ['course_name' => 'Bachelor of Arts (B.A. Hons.) in Economics', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Economics & Social Sciences'],
                    ['course_name' => 'Bachelor of Science (B.Sc. Hons.) in Physics', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Natural Sciences'],
                    ['course_name' => 'Bachelor of Science (B.Sc. Hons.) in Geology', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Earth & Environmental Sciences'],
                    ['course_name' => 'Bachelor of Arts (B.A. Hons.) in History', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Humanities & Social Sciences'],
                    ['course_name' => 'Master of Science (M.Sc) in Applied Mathematics', 'course_type' => 'Post Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Mathematics & Statistics'],
                ],
            ],

            // =========================================================================
            // 3. TOP AUTONOMOUS & DEGREE COLLEGES
            // =========================================================================
            [
                'name' => 'St. Xavier\'s College (Autonomous, Kolkata)',
                'district' => 'Kolkata',
                'taluka' => 'Park Street',
                'city' => 'Kolkata',
                'pin_code' => '700016',
                'address' => '30, Mother Teresa Sarani (Park Street), Kolkata',
                'university_type' => 'Autonomous College affiliated to University of Calcutta',
                'university_name' => 'University of Calcutta',
                'college_type' => 'Autonomous Jesuit College',
                'management' => 'Private (Aided/Unaided)',
                'website' => 'https://www.sxccal.edu',
                'year_of_establishment' => 1860,
                'total_enrollment' => 9000,
                'faculty_count' => 340,
                'featured_field_slug' => 'commerce',
                'fees_range' => '₹45,000 – ₹1,20,000/yr',
                'nirf_rank' => 5,
                'naac_grade' => 'A++',
                'average_package' => '₹7.5 LPA',
                'popular_branches' => 'B.Com (Hons), BBA, B.Sc Computer Science/Microbiology/Statistics, B.A. English, M.Sc, M.Com',
                'description' => 'St. Xavier\'s College Kolkata is an iconic Jesuit institution on Park Street, consistently ranked among the top 5 colleges in India, alma mater of Nobel laureate Rabindranath Tagore and Lakshmi Mittal.',
                'courses' => [
                    ['course_name' => 'Bachelor of Commerce (B.Com Honours)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Aided', 'course_duration_months' => 36, 'course_category' => 'Commerce & Accountancy'],
                    ['course_name' => 'Bachelor of Business Administration (BBA)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 36, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'Bachelor of Science (B.Sc. Hons.) in Computer Science', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 36, 'course_category' => 'Computer Applications'],
                    ['course_name' => 'Bachelor of Science (B.Sc. Hons.) in Microbiology', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 36, 'course_category' => 'Life Sciences'],
                    ['course_name' => 'Master of Science (M.Sc) in Computer Science', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 24, 'course_category' => 'Computer Applications'],
                ],
            ],
            [
                'name' => 'Medical College and Hospital, Kolkata (Calcutta Medical College)',
                'district' => 'Kolkata',
                'taluka' => 'College Square',
                'city' => 'Kolkata',
                'pin_code' => '700073',
                'address' => '88, College Street, Kolkata',
                'university_type' => 'Affiliated to WBUHS',
                'university_name' => 'West Bengal University of Health Sciences',
                'college_type' => 'Government Medical College',
                'management' => 'State Government',
                'website' => 'https://www.medicalcollegekolkata.in',
                'year_of_establishment' => 1835,
                'total_enrollment' => 1800,
                'faculty_count' => 390,
                'featured_field_slug' => 'medical',
                'fees_range' => '₹12,000 – ₹35,000/yr',
                'nirf_rank' => 32,
                'naac_grade' => 'A+',
                'average_package' => '₹14.0 LPA',
                'popular_branches' => 'MBBS, MD General Medicine, MS General Surgery, DM Cardiology, M.Ch Urology',
                'description' => 'Established in 1835, Calcutta Medical College is the oldest medical teaching college in Asia teaching European medicine, with monumental heritage and premier patient volume.',
                'courses' => [
                    ['course_name' => 'Bachelor of Medicine and Bachelor of Surgery (MBBS)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 66, 'course_category' => 'Medicine & Health Sciences'],
                    ['course_name' => 'Doctor of Medicine (MD) in General Medicine', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Medicine & Health Sciences'],
                    ['course_name' => 'Master of Surgery (MS) in General Surgery', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Medicine & Health Sciences'],
                    ['course_name' => 'Doctor of Medicine (MD) in Paediatrics', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Medicine & Health Sciences'],
                ],
            ],

            // =========================================================================
            // 4. TOP PRIVATE & AFFILIATED ENGINEERING COLLEGES
            // =========================================================================
            [
                'name' => 'Heritage Institute of Technology (HIT Kolkata)',
                'district' => 'Kolkata',
                'taluka' => 'Anandapur',
                'city' => 'Kolkata',
                'pin_code' => '700107',
                'address' => '994, Chowbaga Road, Anandapur, Kolkata',
                'university_type' => 'Autonomous College affiliated to MAKAUT',
                'university_name' => 'Maulana Abul Kalam Azad University of Technology',
                'college_type' => 'Private Autonomous Engineering College',
                'management' => 'Private (Unaided)',
                'website' => 'https://www.heritageit.edu',
                'year_of_establishment' => 2001,
                'total_enrollment' => 4500,
                'faculty_count' => 280,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹95,000 – ₹1,40,000/yr',
                'nirf_rank' => 150,
                'naac_grade' => 'A',
                'average_package' => '₹6.5 LPA',
                'popular_branches' => 'B.Tech CSE, IT, AI & ML, Chemical, Biotechnology, Applied Electronics, MCA',
                'description' => 'Heritage Institute of Technology is one of Kolkata\'s top private autonomous engineering colleges, located on a lush campus near the EM Bypass with high IT placement ratios.',
                'courses' => [
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Artificial Intelligence & Machine Learning', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Biotechnology', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Biotechnology'],
                    ['course_name' => 'B.Tech in Chemical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Master of Computer Applications (MCA)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 24, 'course_category' => 'Computer Applications'],
                ],
            ],
            [
                'name' => 'Institute of Engineering and Management (IEM Kolkata)',
                'district' => 'Kolkata',
                'taluka' => 'Salt Lake',
                'city' => 'Kolkata',
                'pin_code' => '700091',
                'address' => 'Sector V, Salt Lake Electronics Complex, Kolkata',
                'university_type' => 'Autonomous College affiliated to MAKAUT',
                'university_name' => 'Maulana Abul Kalam Azad University of Technology',
                'college_type' => 'Private Autonomous Engineering College',
                'management' => 'Private (Unaided)',
                'website' => 'https://iem.edu.in',
                'year_of_establishment' => 1989,
                'total_enrollment' => 4200,
                'faculty_count' => 270,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹1,00,000 – ₹1,60,000/yr',
                'nirf_rank' => 160,
                'naac_grade' => 'A',
                'average_package' => '₹6.8 LPA',
                'popular_branches' => 'B.Tech CSE, IT, Electronics, BCA, BBA, MBA, MCA',
                'description' => 'IEM Kolkata is the oldest private engineering and management college in West Bengal, located right in Kolkata\'s IT epicenter (Sector V, Salt Lake).',
                'courses' => [
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Information Technology', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Bachelor of Business Administration (BBA)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 36, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'Bachelor of Computer Applications (BCA)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 36, 'course_category' => 'Computer Applications'],
                    ['course_name' => 'Master of Business Administration (MBA)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 24, 'course_category' => 'Management & Business Administration'],
                ],
            ],
        ];
    }
}
