<?php

namespace Database\Seeders\States;

use App\Models\IndianCollege;
use App\Models\College;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class TelanganaCollegeSeeder extends Seeder
{
    /**
     * Run the Telangana colleges and universities database seeder.
     */
    public function run(): void
    {
        $this->command?->info("🏛️  Seeding Telangana Public & Private Universities and Degree Colleges...");

        $institutions = $this->getTelanganaInstitutionsData();
        $fieldsMap = Field::pluck('id', 'slug')->toArray();

        $totalColleges = 0;
        $totalCourseRows = 0;
        $totalFeaturedColleges = 0;

        foreach ($institutions as $inst) {
            $totalColleges++;
            $collegeName = $inst['name'];

            // 1. Remove legacy stub records in Telangana to prevent duplication
            DB::table('indian_colleges')
                ->where('state', 'Telangana')
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
                    'state'                  => 'Telangana',
                    'district'               => $inst['district'] ?? 'Hyderabad',
                    'taluka'                 => $inst['taluka'] ?? $inst['district'] ?? 'Hyderabad',
                    'university_type'        => $inst['university_type'] ?? 'State University',
                    'university_name'        => $inst['university_name'] ?? $collegeName,
                    'college_type'           => $inst['college_type'] ?? 'University / College',
                    'affiliation'            => $inst['affiliation'] ?? 'UGC Recognized',
                    'management'             => $inst['management'] ?? 'Private (Unaided)',
                    'website'                => $inst['website'] ?? null,
                    'year_of_establishment'  => $inst['year_of_establishment'] ?? null,
                    'address'                => $inst['address'] ?? null,
                    'city'                   => $inst['city'] ?? 'Hyderabad',
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
                    'state'    => 'Telangana',
                    'field_id' => $fieldId,
                ],
                [
                    'location'                 => $inst['city'] ?? 'Hyderabad',
                    'fees_range'               => $inst['fees_range'] ?? '₹45,000 – ₹2,50,000/yr',
                    'type'                     => str_contains(strtolower($inst['management'] ?? ''), 'gov') || str_contains(strtolower($inst['management'] ?? ''), 'central') ? 'Government' : 'Private',
                    'website'                  => $inst['website'] ?? null,
                    'rank'                     => $inst['nirf_rank'] ?? null,
                    'government_rank'          => $inst['nirf_rank'] ?? null,
                    'naac_grade'               => $inst['naac_grade'] ?? 'A+',
                    'popular_branches'         => $inst['popular_branches'] ?? implode(', ', array_slice(array_column($courses, 'course_name'), 0, 4)),
                    'cutoff'                   => $inst['cutoff'] ?? 'Based on TS EAMCET / JEE Main / NEET / TS ICET / GATE',
                    'placement_support'        => $inst['placement_support'] ?? 'Active career guidance cell with high placements in HITEC City and global tech enterprises',
                    'facilities'               => $inst['facilities'] ?? 'Modern Tech Laboratories, Digital Library, High-Speed Wi-Fi, Sports Complex, Hostels, T-Hub Innovation Linkages',
                    'description'              => $inst['description'] ?? "{$collegeName} is a top institution in Telangana offering modern higher education aligned with industry and research needs.",
                    'average_package'          => $inst['average_package'] ?? '₹7.5 - ₹18.0 LPA',
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

        $this->command?->info("✅ Telangana Chunk Completed: {$totalColleges} institutions seeded with {$totalCourseRows} course records and {$totalFeaturedColleges} featured colleges!");
    }

    /**
     * Get comprehensive dataset of Telangana's Public & Private Universities and Degree Colleges.
     */
    private function getTelanganaInstitutionsData(): array
    {
        return [
            // =========================================================================
            // 1. INSTITUTES OF NATIONAL IMPORTANCE & PREMIER CENTRAL INSTITUTIONS
            // =========================================================================
            [
                'name' => 'Indian Institute of Technology Hyderabad (IIT Hyderabad)',
                'district' => 'Sangareddy',
                'taluka' => 'Kandi',
                'city' => 'Hyderabad',
                'pin_code' => '502284',
                'address' => 'IITH Main Road, Near NH-65, Sangareddy, Kandi',
                'university_type' => 'Institute of National Importance',
                'university_name' => 'Indian Institute of Technology Hyderabad',
                'college_type' => 'Institute of National Importance',
                'management' => 'Central Government',
                'website' => 'https://www.iith.ac.in',
                'year_of_establishment' => 2008,
                'total_enrollment' => 4500,
                'faculty_count' => 310,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹2,10,000 – ₹2,50,000/yr',
                'nirf_rank' => 8,
                'naac_grade' => 'A++',
                'average_package' => '₹20.5 LPA',
                'popular_branches' => 'B.Tech CSE, AI (1st in India), Electrical, Biomedical, B.Des, M.Tech, Ph.D.',
                'description' => 'IIT Hyderabad is celebrated for cutting-edge innovation, fractal academic curriculum, being the first in India to launch B.Tech in AI, and close ties with Japan (JICA).',
                'courses' => [
                    ['course_name' => 'B.Tech in Artificial Intelligence', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Electrical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Bachelor of Design (B.Des)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Design & Fine Arts'],
                    ['course_name' => 'B.Tech in Biomedical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Biotechnology & Medical Tech'],
                    ['course_name' => 'M.Tech in Data Science & Machine Learning', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Data Science'],
                ],
            ],
            [
                'name' => 'International Institute of Information Technology Hyderabad (IIIT Hyderabad)',
                'district' => 'Hyderabad',
                'taluka' => 'Gachibowli',
                'city' => 'Hyderabad',
                'pin_code' => '500032',
                'address' => 'Prof. C R Rao Road, Gachibowli, Hyderabad',
                'university_type' => 'Deemed to be University (Autonomous PPP)',
                'university_name' => 'IIIT Hyderabad',
                'college_type' => 'Deemed University',
                'management' => 'Public-Private Partnership',
                'website' => 'https://www.iiit.ac.in',
                'year_of_establishment' => 1998,
                'total_enrollment' => 2200,
                'faculty_count' => 120,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹3,50,000 – ₹4,50,000/yr',
                'nirf_rank' => 55,
                'naac_grade' => 'A++',
                'average_package' => '₹32.0 LPA',
                'popular_branches' => 'B.Tech CSE, ECE, Dual Degree B.Tech + MS by Research in CSE/ECE/CL, Ph.D.',
                'description' => 'IIIT Hyderabad is widely regarded as India\'s foremost computer science and AI research institute, boasting legendary coding teams in ACM-ICPC World Finals and exceptional compensation packages.',
                'courses' => [
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Electronics and Communication Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Dual Degree B.Tech in CSE and Master of Science in Exact Humanities', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 60, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Dual Degree B.Tech in CSE and MS by Research in Computational Natural Sciences', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 60, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'M.Tech in Computer Science and Information Security', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 24, 'course_category' => 'Cybersecurity'],
                ],
            ],
            [
                'name' => 'University of Hyderabad (UoH / HCU)',
                'district' => 'Hyderabad',
                'taluka' => 'Gachibowli',
                'city' => 'Hyderabad',
                'pin_code' => '500046',
                'address' => 'Prof. C.R. Rao Road, Gachibowli, Hyderabad',
                'university_type' => 'Central University (Institution of Eminence)',
                'university_name' => 'University of Hyderabad',
                'college_type' => 'Central University (IoE)',
                'management' => 'Central Government',
                'website' => 'https://uohyd.ac.in',
                'year_of_establishment' => 1974,
                'total_enrollment' => 5500,
                'faculty_count' => 420,
                'featured_field_slug' => 'science',
                'fees_range' => '₹10,000 – ₹60,000/yr',
                'nirf_rank' => 10,
                'naac_grade' => 'A++',
                'average_package' => '₹8.5 LPA',
                'popular_branches' => 'Integrated M.Sc Physics/Maths/Life Sciences, MCA, MBA, M.A. Economics/English, Ph.D.',
                'description' => 'The University of Hyderabad is an Institution of Eminence (IoE) nestled in a 2,300-acre biodiversity-rich campus, acclaimed for pure sciences, social sciences, and research output.',
                'courses' => [
                    ['course_name' => 'Integrated M.Sc. in Physics (5-Year)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 60, 'course_category' => 'Natural Sciences'],
                    ['course_name' => 'Integrated M.Sc. in Mathematical Sciences', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 60, 'course_category' => 'Mathematics & Statistics'],
                    ['course_name' => 'Master of Computer Applications (MCA)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Computer Applications'],
                    ['course_name' => 'Master of Business Administration (MBA)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'Master of Arts (M.A.) in Economics', 'course_type' => 'Post Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Economics & Social Sciences'],
                ],
            ],
            [
                'name' => 'National Institute of Technology Warangal (NIT Warangal)',
                'district' => 'Hanamkonda',
                'taluka' => 'Warangal',
                'city' => 'Warangal',
                'pin_code' => '506004',
                'address' => 'Fatima Nagar, Kazipet, Warangal',
                'university_type' => 'Institute of National Importance',
                'university_name' => 'NIT Warangal',
                'college_type' => 'Institute of National Importance',
                'management' => 'Central Government',
                'website' => 'https://www.nitw.ac.in',
                'year_of_establishment' => 1959,
                'total_enrollment' => 6500,
                'faculty_count' => 310,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹1,50,000 – ₹1,90,000/yr',
                'nirf_rank' => 21,
                'naac_grade' => 'A++',
                'average_package' => '₹17.8 LPA',
                'popular_branches' => 'B.Tech CSE, ECE, Mechanical, Electrical, Chemical, Civil, Metallurgy, MCA',
                'description' => 'NIT Warangal was the very first Regional Engineering College (REC) in India, foundation stone laid by Pandit Jawaharlal Nehru, known across India for legendary tech alumni.',
                'courses' => [
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Electronics & Communication Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Mechanical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Chemical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Master of Computer Applications (MCA)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Computer Applications'],
                ],
            ],
            [
                'name' => 'BITS Pilani – Hyderabad Campus',
                'district' => 'Medchal Malkajgiri',
                'taluka' => 'Shamirpet',
                'city' => 'Hyderabad',
                'pin_code' => '500078',
                'address' => 'Jawahar Nagar, Kapra Mandal, Medchal District, Hyderabad',
                'university_type' => 'Deemed to be University Campus (IoE)',
                'university_name' => 'Birla Institute of Technology and Science, Pilani',
                'college_type' => 'Deemed University Campus',
                'management' => 'Private (Unaided)',
                'website' => 'https://www.bits-pilani.ac.in/hyderabad',
                'year_of_establishment' => 2008,
                'total_enrollment' => 5200,
                'faculty_count' => 280,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹4,50,000 – ₹5,80,000/yr',
                'nirf_rank' => 20,
                'naac_grade' => 'A',
                'average_package' => '₹19.5 LPA',
                'popular_branches' => 'B.E. Computer Science, ECE, Mechanical, Chemical, B.Pharm, M.Sc Dual Degree, Ph.D.',
                'description' => 'Spanning 200 acres in Shamirpet, BITS Pilani Hyderabad offers the famous flexible BITSian curriculum, Practice School (PS-I & PS-II) internships, and top-tier silicon valley placements.',
                'courses' => [
                    ['course_name' => 'B.E. in Computer Science', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.E. in Electronics and Communication', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.E. in Mechanical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Bachelor of Pharmacy (B.Pharm)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Pharmacy'],
                    ['course_name' => 'M.Sc. (Hons.) in Economics (Dual Degree Program)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 60, 'course_category' => 'Economics & Social Sciences'],
                ],
            ],
            [
                'name' => 'NALSAR University of Law (Hyderabad)',
                'district' => 'Medchal Malkajgiri',
                'taluka' => 'Shamirpet',
                'city' => 'Hyderabad',
                'pin_code' => '500101',
                'address' => 'Justice City, Shamirpet, Medchal District, Hyderabad',
                'university_type' => 'National Law University',
                'university_name' => 'NALSAR University of Law',
                'college_type' => 'National Law University',
                'management' => 'State Government',
                'website' => 'https://www.nalsar.ac.in',
                'year_of_establishment' => 1998,
                'total_enrollment' => 1200,
                'faculty_count' => 80,
                'featured_field_slug' => 'teaching-law',
                'fees_range' => '₹2,60,000 – ₹3,20,000/yr',
                'nirf_rank' => 3,
                'naac_grade' => 'A++',
                'average_package' => '₹16.0 LPA',
                'popular_branches' => 'B.A. LL.B. (Hons.), LL.M., MBA, IPM (BBA+MBA), Ph.D.',
                'description' => 'NALSAR is ranked among India\'s top 3 National Law Universities, pioneer of aviation law and space law, producing leading corporate lawyers, appellate litigators, and judges.',
                'courses' => [
                    ['course_name' => 'B.A. LL.B. (Hons.) 5-Year Integrated', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 60, 'course_category' => 'Law & Legal Studies'],
                    ['course_name' => 'Master of Laws (LL.M.)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 12, 'course_category' => 'Law & Legal Studies'],
                    ['course_name' => 'Integrated BBA-MBA in Management (5-Year IPM)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 60, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'Master of Business Administration (MBA Corporate Governance)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Management & Business Administration'],
                ],
            ],

            // =========================================================================
            // 2. PREMIER STATE UNIVERSITIES
            // =========================================================================
            [
                'name' => 'Osmania University (OU Hyderabad)',
                'district' => 'Hyderabad',
                'taluka' => 'Amberpet',
                'city' => 'Hyderabad',
                'pin_code' => '500007',
                'address' => 'Osmania University Main Road, Amberpet, Hyderabad',
                'university_type' => 'State Public University',
                'university_name' => 'Osmania University',
                'college_type' => 'State University',
                'management' => 'State Government',
                'website' => 'https://www.osmania.ac.in',
                'year_of_establishment' => 1918,
                'total_enrollment' => 32000,
                'faculty_count' => 1100,
                'featured_field_slug' => 'science',
                'fees_range' => '₹12,000 – ₹55,000/yr',
                'nirf_rank' => 36,
                'naac_grade' => 'A+',
                'average_package' => '₹6.5 LPA',
                'popular_branches' => 'B.E. (UCE OU), B.Tech (UCT OU), MBA, MCA, M.Sc, LL.B., B.Com, Ph.D.',
                'description' => 'Founded in 1918 by Mir Osman Ali Khan, Osmania University is one of the largest and oldest higher educational powerhouses in South India, with an iconic Arts College facade.',
                'courses' => [
                    ['course_name' => 'B.E. in Computer Science and Engineering (UCE OU)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Chemical Engineering (UCT OU)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Master of Business Administration (MBA)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'Master of Computer Applications (MCA)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Computer Applications'],
                    ['course_name' => 'Bachelor of Laws (LL.B. 3-Year)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Law & Legal Studies'],
                ],
            ],
            [
                'name' => 'Jawaharlal Nehru Technological University Hyderabad (JNTUH)',
                'district' => 'Hyderabad',
                'taluka' => 'Kukatpally',
                'city' => 'Hyderabad',
                'pin_code' => '500085',
                'address' => 'Ashok Nagar, Kukatpally Housing Board Colony, Kukatpally, Hyderabad',
                'university_type' => 'State Technological University',
                'university_name' => 'JNTU Hyderabad',
                'college_type' => 'State Technical University',
                'management' => 'State Government',
                'website' => 'https://jntuh.ac.in',
                'year_of_establishment' => 1972,
                'total_enrollment' => 150000,
                'faculty_count' => 1200,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹40,000 – ₹1,00,000/yr',
                'nirf_rank' => 83,
                'naac_grade' => 'A+',
                'average_package' => '₹7.2 LPA',
                'popular_branches' => 'B.Tech (CSE, AI/ML, Data Science, ECE, Mechanical), B.Pharm, M.Tech, MBA',
                'description' => 'JNTUH is Telangana\'s premier technical university, affiliating over 250 engineering, pharmacy, and management colleges, running top constituent college JNTUH College of Engineering.',
                'courses' => [
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Artificial Intelligence & Machine Learning', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Electronics & Communication Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Bachelor of Pharmacy (B.Pharm)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Pharmacy'],
                    ['course_name' => 'Master of Business Administration (MBA)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Management & Business Administration'],
                ],
            ],

            // =========================================================================
            // 3. TOP AUTONOMOUS & AFFILIATED ENGINEERING COLLEGES
            // =========================================================================
            [
                'name' => 'Chaitanya Bharathi Institute of Technology (CBIT Hyderabad)',
                'district' => 'Rangareddy',
                'taluka' => 'Gandipet',
                'city' => 'Hyderabad',
                'pin_code' => '500075',
                'address' => 'Gandipet, Hyderabad',
                'university_type' => 'Autonomous College affiliated to Osmania University',
                'university_name' => 'Osmania University',
                'college_type' => 'Private Autonomous Engineering College',
                'management' => 'Private (Unaided)',
                'website' => 'https://www.cbit.ac.in',
                'year_of_establishment' => 1979,
                'total_enrollment' => 5800,
                'faculty_count' => 380,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹1,40,000 – ₹1,80,000/yr',
                'nirf_rank' => 151,
                'naac_grade' => 'A++',
                'average_package' => '₹9.2 LPA',
                'popular_branches' => 'B.E. Computer Science, AI & ML, IoT, IT, ECE, Chemical, Mechanical, MBA, MCA',
                'description' => 'CBIT Gandipet is universally recognized as the #1 private engineering college in Telangana, capturing top TS EAMCET rankers and recording exceptional multinational corporate placements.',
                'courses' => [
                    ['course_name' => 'B.E. in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.E. in Artificial Intelligence and Machine Learning', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.E. in Information Technology', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.E. in Electronics and Communication Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Master of Business Administration (MBA)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 24, 'course_category' => 'Management & Business Administration'],
                ],
            ],
            [
                'name' => 'Vasavi College of Engineering (Hyderabad)',
                'district' => 'Hyderabad',
                'taluka' => 'Ibrahimbagh',
                'city' => 'Hyderabad',
                'pin_code' => '500031',
                'address' => '9-5-81, Ibrahimbagh, Hyderabad',
                'university_type' => 'Autonomous College affiliated to Osmania University',
                'university_name' => 'Osmania University',
                'college_type' => 'Private Autonomous Engineering College',
                'management' => 'Private (Unaided)',
                'website' => 'https://www.vce.ac.in',
                'year_of_establishment' => 1981,
                'total_enrollment' => 4200,
                'faculty_count' => 290,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹1,30,000 – ₹1,60,000/yr',
                'nirf_rank' => 170,
                'naac_grade' => 'A++',
                'average_package' => '₹8.8 LPA',
                'popular_branches' => 'B.E. CSE, IT, ECE, AI & ML, Mechanical, Civil, Electrical, MCA',
                'description' => 'Vasavi College of Engineering, affiliated to Osmania University, is renowned for discipline, academic rigor, modern hardware-software labs, and top-tier software recruits.',
                'courses' => [
                    ['course_name' => 'B.E. in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.E. in Information Technology', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.E. in Electronics and Communication Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Master of Computer Applications (MCA)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 24, 'course_category' => 'Computer Applications'],
                ],
            ],
            [
                'name' => 'VNR Vignana Jyothi Institute of Engineering and Technology (VNR VJIET)',
                'district' => 'Medchal Malkajgiri',
                'taluka' => 'Bachupally',
                'city' => 'Hyderabad',
                'pin_code' => '500090',
                'address' => 'Vignana Jyothi Nagar, Pragathi Nagar, Nizampet (S.O), Bachupally, Hyderabad',
                'university_type' => 'Autonomous College affiliated to JNTUH',
                'university_name' => 'JNTU Hyderabad',
                'college_type' => 'Private Autonomous Engineering College',
                'management' => 'Private (Unaided)',
                'website' => 'http://www.vnrvjiet.ac.in',
                'year_of_establishment' => 1995,
                'total_enrollment' => 5500,
                'faculty_count' => 360,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹1,30,000 – ₹1,65,000/yr',
                'nirf_rank' => 113,
                'naac_grade' => 'A++',
                'average_package' => '₹8.5 LPA',
                'popular_branches' => 'B.Tech CSE, AI & Data Science, IoT, ECE, Civil, Automobile',
                'description' => 'VNR VJIET is known for innovation culture, student projects winning Smart India Hackathon repeatedly, and high volume campus recruitment by top IT leaders.',
                'courses' => [
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Artificial Intelligence & Data Science', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Electronics and Communication Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Automobile Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                ],
            ],

            // =========================================================================
            // 4. PREMIER MEDICAL & HEALTHCARE INSTITUTIONS
            // =========================================================================
            [
                'name' => 'Osmania Medical College (OMC Koti, Hyderabad)',
                'district' => 'Hyderabad',
                'taluka' => 'Koti',
                'city' => 'Hyderabad',
                'pin_code' => '500095',
                'address' => 'Turrebaz Khan Road, Koti, Hyderabad',
                'university_type' => 'Affiliated to KNRUHS',
                'university_name' => 'Kaloji Narayana Rao University of Health Sciences',
                'college_type' => 'Government Medical College',
                'management' => 'State Government',
                'website' => 'http://osmaniamedicalcollege.edu.in',
                'year_of_establishment' => 1846,
                'total_enrollment' => 2200,
                'faculty_count' => 480,
                'featured_field_slug' => 'medical',
                'fees_range' => '₹40,000 – ₹85,000/yr',
                'nirf_rank' => 24,
                'naac_grade' => 'A+',
                'average_package' => '₹14.5 LPA',
                'popular_branches' => 'MBBS, MD General Medicine, MS Surgery, DM Cardiology, M.Ch Neurosurgery',
                'description' => 'Founded in 1846 during the Nizam rule, OMC is one of the oldest and most prestigious medical colleges in South Asia, linked to Osmania General Hospital and Sarojini Devi Eye Hospital.',
                'courses' => [
                    ['course_name' => 'Bachelor of Medicine and Bachelor of Surgery (MBBS)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 66, 'course_category' => 'Medicine & Health Sciences'],
                    ['course_name' => 'Doctor of Medicine (MD) in General Medicine', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Medicine & Health Sciences'],
                    ['course_name' => 'Master of Surgery (MS) in General Surgery', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Medicine & Health Sciences'],
                    ['course_name' => 'Doctor of Medicine (MD) in Paediatrics', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Medicine & Health Sciences'],
                ],
            ],
            [
                'name' => 'Gandhi Medical College (Secunderabad)',
                'district' => 'Hyderabad',
                'taluka' => 'Musheerabad',
                'city' => 'Secunderabad',
                'pin_code' => '500003',
                'address' => 'Musheerabad, Padmarao Nagar, Secunderabad',
                'university_type' => 'Affiliated to KNRUHS',
                'university_name' => 'Kaloji Narayana Rao University of Health Sciences',
                'college_type' => 'Government Medical College',
                'management' => 'State Government',
                'website' => 'http://gandhihospital.telangana.gov.in',
                'year_of_establishment' => 1954,
                'total_enrollment' => 1900,
                'faculty_count' => 420,
                'featured_field_slug' => 'medical',
                'fees_range' => '₹40,000 – ₹80,000/yr',
                'nirf_rank' => 30,
                'naac_grade' => 'A+',
                'average_package' => '₹14.0 LPA',
                'popular_branches' => 'MBBS, MD Anaesthesiology, MS Orthopaedics, DM Nephrology, M.Ch Urology',
                'description' => 'Gandhi Medical College and Hospital in Secunderabad is a premier government teaching hospital in Telangana, serving as a nodal referral super-speciality medical center.',
                'courses' => [
                    ['course_name' => 'Bachelor of Medicine and Bachelor of Surgery (MBBS)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 66, 'course_category' => 'Medicine & Health Sciences'],
                    ['course_name' => 'Doctor of Medicine (MD) in Anaesthesiology', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Medicine & Health Sciences'],
                    ['course_name' => 'Master of Surgery (MS) in Orthopaedics', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Medicine & Health Sciences'],
                    ['course_name' => 'B.Sc. in Nursing', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Nursing & Healthcare'],
                ],
            ],

            // =========================================================================
            // 5. TOP DEGREE & PRIVATE UNIVERSITIES
            // =========================================================================
            [
                'name' => 'Nizam College (Autonomous, Hyderabad)',
                'district' => 'Hyderabad',
                'taluka' => 'Basheerbagh',
                'city' => 'Hyderabad',
                'pin_code' => '500001',
                'address' => 'LB Stadium Road, Basheer Bagh, Hyderabad',
                'university_type' => 'Autonomous Constituent College of Osmania University',
                'university_name' => 'Osmania University',
                'college_type' => 'Government Autonomous College',
                'management' => 'State Government',
                'website' => 'https://www.nizamcollege.ac.in',
                'year_of_establishment' => 1887,
                'total_enrollment' => 4200,
                'faculty_count' => 190,
                'featured_field_slug' => 'commerce',
                'fees_range' => '₹8,000 – ₹45,000/yr',
                'nirf_rank' => 72,
                'naac_grade' => 'A+',
                'average_package' => '₹5.5 LPA',
                'popular_branches' => 'B.Com, BBA, B.Sc Computer Science/Genetics, B.A., M.Sc, MBA, MCA',
                'description' => 'Established in 1887 during the reign of Nizam Asaf Jah VI, Nizam College is one of the most elite undergraduate colleges in Telangana.',
                'courses' => [
                    ['course_name' => 'Bachelor of Commerce (B.Com)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Commerce & Accountancy'],
                    ['course_name' => 'Bachelor of Business Administration (BBA)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'Bachelor of Computer Applications (BCA)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Computer Applications'],
                    ['course_name' => 'Bachelor of Science (B.Sc) in Genetics & Biotechnology', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Life Sciences'],
                ],
            ],
            [
                'name' => 'Mahindra University (Hyderabad)',
                'district' => 'Medchal Malkajgiri',
                'taluka' => 'Bahadurpally',
                'city' => 'Hyderabad',
                'pin_code' => '500043',
                'address' => 'Survey No: 62/1A, Bahadurpally, Jeedimetla, Hyderabad',
                'university_type' => 'State Private University',
                'university_name' => 'Mahindra University',
                'college_type' => 'Private University',
                'management' => 'Private (Unaided)',
                'website' => 'https://www.mahindrauniversity.edu.in',
                'year_of_establishment' => 2014,
                'total_enrollment' => 3200,
                'faculty_count' => 210,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹4,00,000 – ₹5,00,000/yr',
                'nirf_rank' => 92,
                'naac_grade' => 'A',
                'average_package' => '₹11.0 LPA',
                'popular_branches' => 'B.Tech CSE/AI/Robotics (École Centrale partnership), BBA, Law, Executive MBA',
                'description' => 'Founded by the Mahindra Group in collaboration with École Centrale Paris, Mahindra University delivers French pedagogy, cutting-edge labs, and automotive supercomputing facilities.',
                'courses' => [
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Artificial Intelligence', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Mechatronics & Robotics', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'BBA in Computational Business Analytics', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 36, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'B.A. LL.B. (Hons.) 5-Year Integrated', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 60, 'course_category' => 'Law & Legal Studies'],
                ],
            ],
        ];
    }
}
