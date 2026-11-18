<?php

namespace Database\Seeders\States;

use App\Models\IndianCollege;
use App\Models\College;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class RajasthanCollegeSeeder extends Seeder
{
    /**
     * Run the Rajasthan colleges and universities database seeder.
     */
    public function run(): void
    {
        $this->command?->info("🏛️  Seeding Rajasthan Public & Private Universities and Degree Colleges...");

        $institutions = $this->getRajasthanInstitutionsData();
        $fieldsMap = Field::pluck('id', 'slug')->toArray();

        $totalColleges = 0;
        $totalCourseRows = 0;
        $totalFeaturedColleges = 0;

        foreach ($institutions as $inst) {
            $totalColleges++;
            $collegeName = $inst['name'];

            // 1. Remove legacy stub records in Rajasthan to prevent duplication
            DB::table('indian_colleges')
                ->where('state', 'Rajasthan')
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
                    'state'                  => 'Rajasthan',
                    'district'               => $inst['district'] ?? 'Jaipur',
                    'taluka'                 => $inst['taluka'] ?? $inst['district'] ?? 'Jaipur',
                    'university_type'        => $inst['university_type'] ?? 'State University',
                    'university_name'        => $inst['university_name'] ?? $collegeName,
                    'college_type'           => $inst['college_type'] ?? 'University / College',
                    'affiliation'            => $inst['affiliation'] ?? 'UGC Recognized',
                    'management'             => $inst['management'] ?? 'Private (Unaided)',
                    'website'                => $inst['website'] ?? null,
                    'year_of_establishment'  => $inst['year_of_establishment'] ?? null,
                    'address'                => $inst['address'] ?? null,
                    'city'                   => $inst['city'] ?? 'Jaipur',
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
                    'state'    => 'Rajasthan',
                    'field_id' => $fieldId,
                ],
                [
                    'location'                 => $inst['city'] ?? 'Jaipur',
                    'fees_range'               => $inst['fees_range'] ?? '₹35,000 – ₹2,40,000/yr',
                    'type'                     => str_contains(strtolower($inst['management'] ?? ''), 'gov') || str_contains(strtolower($inst['management'] ?? ''), 'central') ? 'Government' : 'Private',
                    'website'                  => $inst['website'] ?? null,
                    'rank'                     => $inst['nirf_rank'] ?? null,
                    'government_rank'          => $inst['nirf_rank'] ?? null,
                    'naac_grade'               => $inst['naac_grade'] ?? 'A+',
                    'popular_branches'         => $inst['popular_branches'] ?? implode(', ', array_slice(array_column($courses, 'course_name'), 0, 4)),
                    'cutoff'                   => $inst['cutoff'] ?? 'Based on BITSAT / JEE Main / NEET / REAP Rajasthan',
                    'placement_support'        => $inst['placement_support'] ?? 'Active training and placement cell with leading national and global tech enterprises',
                    'facilities'               => $inst['facilities'] ?? 'Central Library, Modern Laboratories, High-Speed Campus Wi-Fi, Sports Stadium, Hostels, Innovation Incubation Hub',
                    'description'              => $inst['description'] ?? "{$collegeName} is a premier educational institution in Rajasthan offering comprehensive degrees and excellent career opportunities.",
                    'average_package'          => $inst['average_package'] ?? '₹6.5 - ₹18.0 LPA',
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

        $this->command?->info("✅ Rajasthan Chunk Completed: {$totalColleges} institutions seeded with {$totalCourseRows} course records and {$totalFeaturedColleges} featured colleges!");
    }

    /**
     * Get comprehensive dataset of Rajasthan's Public & Private Universities and Degree Colleges.
     */
    private function getRajasthanInstitutionsData(): array
    {
        return [
            // =========================================================================
            // 1. INSTITUTES OF NATIONAL IMPORTANCE & PREMIER CENTRAL INSTITUTIONS
            // =========================================================================
            [
                'name' => 'Birla Institute of Technology and Science, Pilani (BITS Pilani - Main Campus)',
                'district' => 'Jhunjhunu',
                'taluka' => 'Pilani',
                'city' => 'Pilani',
                'pin_code' => '333031',
                'address' => 'Vidya Vihar, Pilani, Rajasthan',
                'university_type' => 'Deemed to be University (Institution of Eminence)',
                'university_name' => 'Birla Institute of Technology and Science, Pilani',
                'college_type' => 'Deemed University (IoE)',
                'management' => 'Private (Unaided)',
                'website' => 'https://www.bits-pilani.ac.in',
                'year_of_establishment' => 1964,
                'total_enrollment' => 5000,
                'faculty_count' => 310,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹4,50,000 – ₹5,80,000/yr',
                'nirf_rank' => 20,
                'naac_grade' => 'A',
                'average_package' => '₹22.5 LPA',
                'popular_branches' => 'B.E. Computer Science, Electrical & Electronics, Mechanical, Chemical, B.Pharm, M.Sc Dual Degree',
                'description' => 'BITS Pilani is India\'s top private technical university, granted Institution of Eminence (IoE) status, famous for no reservation policy, 0% attendance requirement, and premier global alumni network.',
                'courses' => [
                    ['course_name' => 'B.E. in Computer Science', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.E. in Electrical and Electronics Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.E. in Mechanical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.E. in Chemical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Bachelor of Pharmacy (B.Pharm)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Pharmacy'],
                    ['course_name' => 'M.Sc. (Hons.) in Economics (Dual Degree Program)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 60, 'course_category' => 'Economics & Social Sciences'],
                ],
            ],
            [
                'name' => 'Malaviya National Institute of Technology Jaipur (MNIT Jaipur)',
                'district' => 'Jaipur',
                'taluka' => 'Malviya Nagar',
                'city' => 'Jaipur',
                'pin_code' => '302017',
                'address' => 'Jawahar Lal Nehru Marg, Jhalana Doongri, Jaipur',
                'university_type' => 'Institute of National Importance',
                'university_name' => 'MNIT Jaipur',
                'college_type' => 'Institute of National Importance',
                'management' => 'Central Government',
                'website' => 'http://www.mnit.ac.in',
                'year_of_establishment' => 1963,
                'total_enrollment' => 5800,
                'faculty_count' => 290,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹1,40,000 – ₹1,80,000/yr',
                'nirf_rank' => 37,
                'naac_grade' => 'A+',
                'average_package' => '₹15.5 LPA',
                'popular_branches' => 'B.Tech CSE, AI & Data Science, ECE, Mechanical, Chemical, Metallurgical, B.Arch, MBA',
                'description' => 'MNIT Jaipur is one of the premier NITs in India, situated over a lush 317-acre campus in the heart of Jaipur with state-of-the-art materials characterization and computing infrastructure.',
                'courses' => [
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Artificial Intelligence & Data Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Electronics and Communication Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Mechanical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Bachelor of Architecture (B.Arch)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 60, 'course_category' => 'Architecture & Planning'],
                ],
            ],
            [
                'name' => 'Indian Institute of Technology Jodhpur (IIT Jodhpur)',
                'district' => 'Jodhpur',
                'taluka' => 'Karwar',
                'city' => 'Jodhpur',
                'pin_code' => '342037',
                'address' => 'NH 62, Nagaur Road, Karwar, Jodhpur',
                'university_type' => 'Institute of National Importance',
                'university_name' => 'Indian Institute of Technology Jodhpur',
                'college_type' => 'Institute of National Importance',
                'management' => 'Central Government',
                'website' => 'https://www.iitj.ac.in',
                'year_of_establishment' => 2008,
                'total_enrollment' => 3800,
                'faculty_count' => 210,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹2,10,000 – ₹2,50,000/yr',
                'nirf_rank' => 30,
                'naac_grade' => 'A++',
                'average_package' => '₹18.0 LPA',
                'popular_branches' => 'B.Tech CSE, AI & Data Science, Electrical, Mechanical, Bioscience, B.Sc Physics, MBA',
                'description' => 'IIT Jodhpur features a sustainable zero-discharge 852-acre smart campus in the Thar desert, pioneering deep-tech research in cyber-physical systems, AI, and clean energy.',
                'courses' => [
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Artificial Intelligence and Data Science', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Electrical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Mechanical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Master of Business Administration (MBA - SME IIT Jodhpur)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Management & Business Administration'],
                ],
            ],
            [
                'name' => 'National Law University Jodhpur (NLU Jodhpur)',
                'district' => 'Jodhpur',
                'taluka' => 'Mandore',
                'city' => 'Jodhpur',
                'pin_code' => '342304',
                'address' => 'NH-65, Nagaur Road, Mandore, Jodhpur',
                'university_type' => 'National Law University',
                'university_name' => 'National Law University Jodhpur',
                'college_type' => 'National Law University',
                'management' => 'State Government',
                'website' => 'http://www.nlujodhpur.ac.in',
                'year_of_establishment' => 1999,
                'total_enrollment' => 950,
                'faculty_count' => 60,
                'featured_field_slug' => 'teaching-law',
                'fees_range' => '₹2,40,000 – ₹3,00,000/yr',
                'nirf_rank' => 8,
                'naac_grade' => 'A',
                'average_package' => '₹14.5 LPA',
                'popular_branches' => 'B.A. LL.B. (Hons.), BBA LL.B. (Hons.), LL.M. Corporate Law, Intellectual Property Law',
                'description' => 'NLU Jodhpur is ranked consistently among the top 10 law schools in India, renowned for producing top corporate transaction attorneys, supreme court litigators, and Rhodes scholars.',
                'courses' => [
                    ['course_name' => 'B.A. LL.B. (Hons.) 5-Year Integrated', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 60, 'course_category' => 'Law & Legal Studies'],
                    ['course_name' => 'BBA LL.B. (Hons.) 5-Year Integrated', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 60, 'course_category' => 'Law & Legal Studies'],
                    ['course_name' => 'Master of Laws (LL.M.) in Corporate Law', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 12, 'course_category' => 'Law & Legal Studies'],
                    ['course_name' => 'Master of Laws (LL.M.) in Intellectual Property Law', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 12, 'course_category' => 'Law & Legal Studies'],
                ],
            ],
            [
                'name' => 'All India Institute of Medical Sciences Jodhpur (AIIMS Jodhpur)',
                'district' => 'Jodhpur',
                'taluka' => 'Basni',
                'city' => 'Jodhpur',
                'pin_code' => '342005',
                'address' => 'Basni Industrial Area, Phase-2, Jodhpur',
                'university_type' => 'Institute of National Importance',
                'university_name' => 'AIIMS Jodhpur',
                'college_type' => 'Institute of National Importance / Medical',
                'management' => 'Central Government',
                'website' => 'https://www.aiimsjodhpur.edu.in',
                'year_of_establishment' => 2012,
                'total_enrollment' => 1200,
                'faculty_count' => 260,
                'featured_field_slug' => 'medical',
                'fees_range' => '₹1,500 – ₹6,000/total course (Fully Subsidized)',
                'nirf_rank' => 13,
                'naac_grade' => 'A++',
                'average_package' => '₹17.0 LPA',
                'popular_branches' => 'MBBS, B.Sc (Hons) Nursing, MD General Medicine, MS General Surgery, DM/M.Ch Super Specialities',
                'description' => 'AIIMS Jodhpur is one of India\'s top 15 medical institutes, delivering cutting-edge robotic surgeries, super-speciality patient healthcare, and world-class medical education.',
                'courses' => [
                    ['course_name' => 'Bachelor of Medicine and Bachelor of Surgery (MBBS)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 66, 'course_category' => 'Medicine & Health Sciences'],
                    ['course_name' => 'B.Sc. (Hons.) in Nursing', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 48, 'course_category' => 'Nursing & Healthcare'],
                    ['course_name' => 'Doctor of Medicine (MD) in General Medicine', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Medicine & Health Sciences'],
                    ['course_name' => 'Master of Surgery (MS) in General Surgery', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Medicine & Health Sciences'],
                ],
            ],

            // =========================================================================
            // 2. PREMIER STATE UNIVERSITIES & MEDICAL INSTITUTIONS
            // =========================================================================
            [
                'name' => 'Sawai Man Singh Medical College (SMS Medical College Jaipur)',
                'district' => 'Jaipur',
                'taluka' => 'JL Marg',
                'city' => 'Jaipur',
                'pin_code' => '302004',
                'address' => 'Jawaharlal Nehru Marg, Gangawal Park, Adarsh Nagar, Jaipur',
                'university_type' => 'Affiliated to RUHS',
                'university_name' => 'Rajasthan University of Health Sciences',
                'college_type' => 'Government Medical College',
                'management' => 'State Government',
                'website' => 'http://medicaleducation.rajasthan.gov.in/jaipur',
                'year_of_establishment' => 1947,
                'total_enrollment' => 2800,
                'faculty_count' => 520,
                'featured_field_slug' => 'medical',
                'fees_range' => '₹40,000 – ₹70,000/yr',
                'nirf_rank' => 46,
                'naac_grade' => 'A+',
                'average_package' => '₹14.5 LPA',
                'popular_branches' => 'MBBS, MD General Medicine, MS Orthopaedics, DM Cardiology, M.Ch Urology',
                'description' => 'SMS Medical College is Rajasthan\'s largest and oldest premier medical college, attached to the sprawling SMS Hospital treating over 10,000 patients every day.',
                'courses' => [
                    ['course_name' => 'Bachelor of Medicine and Bachelor of Surgery (MBBS)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 66, 'course_category' => 'Medicine & Health Sciences'],
                    ['course_name' => 'Doctor of Medicine (MD) in General Medicine', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Medicine & Health Sciences'],
                    ['course_name' => 'Master of Surgery (MS) in General Surgery', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Medicine & Health Sciences'],
                    ['course_name' => 'Doctor of Medicine (MD) in Paediatrics', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Medicine & Health Sciences'],
                ],
            ],
            [
                'name' => 'University of Rajasthan (Jaipur)',
                'district' => 'Jaipur',
                'taluka' => 'JL Marg',
                'city' => 'Jaipur',
                'pin_code' => '302004',
                'address' => 'Jawaharlal Nehru Marg, Jaipur',
                'university_type' => 'State Public University',
                'university_name' => 'University of Rajasthan',
                'college_type' => 'State University',
                'management' => 'State Government',
                'website' => 'https://www.uniraj.ac.in',
                'year_of_establishment' => 1947,
                'total_enrollment' => 35000,
                'faculty_count' => 850,
                'featured_field_slug' => 'science',
                'fees_range' => '₹6,000 – ₹35,000/yr',
                'nirf_rank' => 98,
                'naac_grade' => 'A',
                'average_package' => '₹5.5 LPA',
                'popular_branches' => 'B.Com, B.Sc (Maharaja\'s), B.A. (Maharani\'s), MBA (PIM), LL.B., M.Sc, Ph.D.',
                'description' => 'The University of Rajasthan is the oldest institution of higher learning in Rajasthan, affiliating several hundred colleges with iconic constituent colleges across Jaipur.',
                'courses' => [
                    ['course_name' => 'Bachelor of Commerce (B.Com Honours)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Commerce & Accountancy'],
                    ['course_name' => 'Bachelor of Science (B.Sc) in Physics, Chemistry & Mathematics', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Natural Sciences'],
                    ['course_name' => 'Bachelor of Business Administration (BBA)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'Bachelor of Laws (LL.B. 3-Year)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 36, 'course_category' => 'Law & Legal Studies'],
                    ['course_name' => 'Master of Business Administration (MBA R.A. Podar)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Government', 'course_duration_months' => 24, 'course_category' => 'Management & Business Administration'],
                ],
            ],

            // =========================================================================
            // 3. PROMINENT DEEMED & PRIVATE UNIVERSITIES
            // =========================================================================
            [
                'name' => 'Banasthali Vidyapith (Niwai, Tonk)',
                'district' => 'Tonk',
                'taluka' => 'Niwai',
                'city' => 'Banasthali',
                'pin_code' => '304022',
                'address' => 'Banasthali Vidyapith, PO Banasthali Vidyapith, Tonk District',
                'university_type' => 'Deemed to be University (All-Women)',
                'university_name' => 'Banasthali Vidyapith',
                'college_type' => 'Deemed University (Women\'s University)',
                'management' => 'Private (Unaided)',
                'website' => 'http://www.banasthali.org',
                'year_of_establishment' => 1935,
                'total_enrollment' => 16000,
                'faculty_count' => 780,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹1,20,000 – ₹2,40,000/yr',
                'nirf_rank' => 58,
                'naac_grade' => 'A++',
                'average_package' => '₹8.0 LPA',
                'popular_branches' => 'B.Tech CSE, IT, Aviation & Flying Club, B.Pharm, MBA, Design, B.Sc, B.A.',
                'description' => 'Banasthali Vidyapith is the world\'s largest fully residential women\'s university, featuring its own flying club, licensed airfield, horse riding academy, and top technical placements.',
                'courses' => [
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Information Technology', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Bachelor of Pharmacy (B.Pharm)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Pharmacy'],
                    ['course_name' => 'Master of Business Administration (MBA)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 24, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'B.Sc. in Aviation Science & Commercial Pilot License Training', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 36, 'course_category' => 'Aviation & Aerospace'],
                ],
            ],
            [
                'name' => 'Manipal University Jaipur (MUJ)',
                'district' => 'Jaipur',
                'taluka' => 'Dehmi Kalan',
                'city' => 'Jaipur',
                'pin_code' => '303007',
                'address' => 'Jaipur-Ajmer Express Highway, Dehmi Kalan, Near GVK Toll Plaza, Jaipur',
                'university_type' => 'State Private University',
                'university_name' => 'Manipal University Jaipur',
                'college_type' => 'Private University',
                'management' => 'Private (Unaided)',
                'website' => 'https://jaipur.manipal.edu',
                'year_of_establishment' => 2011,
                'total_enrollment' => 11000,
                'faculty_count' => 610,
                'featured_field_slug' => 'technology-engineering',
                'fees_range' => '₹2,20,000 – ₹3,80,000/yr',
                'nirf_rank' => 64,
                'naac_grade' => 'A+',
                'average_package' => '₹9.0 LPA',
                'popular_branches' => 'B.Tech CSE, AI, Data Science, B.Des, B.Arch, BBA, Law (BA/BBA LL.B), MBA',
                'description' => 'Manipal University Jaipur is a premier private university in Rajasthan, offering a 122-acre modern residential campus, innovative engineering programs, and high MNC placements.',
                'courses' => [
                    ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'B.Tech in Artificial Intelligence & Machine Learning', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                    ['course_name' => 'Bachelor of Business Administration (BBA)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 36, 'course_category' => 'Management & Business Administration'],
                    ['course_name' => 'Bachelor of Architecture (B.Arch)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 60, 'course_category' => 'Architecture & Planning'],
                    ['course_name' => 'B.A. LL.B. (Hons.) 5-Year Integrated', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_aided_unaided' => 'Un-Aided', 'course_duration_months' => 60, 'course_category' => 'Law & Legal Studies'],
                ],
            ],
        ];
    }
}
