<?php

namespace App\Console\Commands;

use App\Models\College;
use App\Models\Field;
use App\Models\IndianCollege;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PopulateExploreHubsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'colleges:populate-explore-hubs {--min-per-state=15 : Minimum colleges per state per explore field}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ensure every explore category (Engineering, Medical, Hotel Management, Business, Pharmacy, AYUSH, Agriculture, Science, Arts, Commerce) has abundant colleges across all states';

    /**
     * Target states configuration.
     */
    protected array $targetStates = [
        'Delhi' => ['city' => 'New Delhi', 'dist' => 'Central Delhi', 'pin' => 110001, 'univ' => 'University of Delhi / GGSIPU'],
        'Karnataka' => ['city' => 'Bengaluru', 'dist' => 'Bengaluru Urban', 'pin' => 560001, 'univ' => 'Visvesvaraya Technological University'],
        'Uttar Pradesh' => ['city' => 'Lucknow', 'dist' => 'Lucknow', 'pin' => 226001, 'univ' => 'Dr. A.P.J. Abdul Kalam Technical University'],
        'Tamil Nadu' => ['city' => 'Chennai', 'dist' => 'Chennai', 'pin' => 600001, 'univ' => 'Anna University / University of Madras'],
        'West Bengal' => ['city' => 'Kolkata', 'dist' => 'Kolkata', 'pin' => 700001, 'univ' => 'MAKAUT / University of Calcutta'],
        'Telangana' => ['city' => 'Hyderabad', 'dist' => 'Hyderabad', 'pin' => 500001, 'univ' => 'JNTU Hyderabad / Osmania University'],
        'Gujarat' => ['city' => 'Ahmedabad', 'dist' => 'Ahmedabad', 'pin' => 380001, 'univ' => 'Gujarat Technological University'],
        'Rajasthan' => ['city' => 'Jaipur', 'dist' => 'Jaipur', 'pin' => 302001, 'univ' => 'Rajasthan Technical University'],
        'Kerala' => ['city' => 'Thiruvananthapuram', 'dist' => 'Thiruvananthapuram', 'pin' => 695001, 'univ' => 'KTU / University of Kerala'],
        'Maharashtra' => ['city' => 'Mumbai', 'dist' => 'Mumbai', 'pin' => 400001, 'univ' => 'University of Mumbai / SPPU'],
    ];

    /**
     * Field definitions and matching keyword patterns.
     */
    protected array $fieldConfigs = [
        'hotel-management' => [
            'name'       => 'Hotel Management',
            'keywords'   => ['%hotel%', '%hospitality%', '%catering%', '%ihm%', '%culinary%'],
            'courses'    => [
                ['course_name' => 'BHMCT - Bachelor of Hotel Management & Catering Tech', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 48, 'course_category' => 'Hospitality & Tourism'],
                ['course_name' => 'B.Sc in Hospitality & Hotel Administration', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 36, 'course_category' => 'Hospitality & Tourism'],
                ['course_name' => 'Diploma in Food & Beverage Production', 'course_type' => 'Diploma Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 18, 'course_category' => 'Hospitality & Tourism'],
                ['course_name' => 'M.Sc in Hospitality Administration', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 24, 'course_category' => 'Hospitality & Tourism'],
            ],
            'branches'   => 'Food Production, Front Office Management, Food & Beverage Service, Housekeeping',
            'fees'       => '₹65,000 – ₹1,80,000/yr',
            'avg_pkg'    => '₹4.5 - ₹9.0 LPA',
            'cutoff'     => 'Based on NCHMCT JEE / State Entrance Ranks',
        ],
        'pharmacy' => [
            'name'       => 'Pharmacy',
            'keywords'   => ['%pharm%', '%d.pharm%', '%b.pharm%'],
            'courses'    => [
                ['course_name' => 'B.Pharm - Bachelor of Pharmacy', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 48, 'course_category' => 'Pharmacy'],
                ['course_name' => 'M.Pharm in Pharmaceutics', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 24, 'course_category' => 'Pharmacy'],
                ['course_name' => 'Pharm.D - Doctor of Pharmacy', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 72, 'course_category' => 'Pharmacy'],
                ['course_name' => 'D.Pharm - Diploma in Pharmacy', 'course_type' => 'Diploma Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 24, 'course_category' => 'Pharmacy'],
            ],
            'branches'   => 'Pharmaceutics, Pharmacology, Pharmaceutical Chemistry, Pharmacognosy',
            'fees'       => '₹55,000 – ₹1,60,000/yr',
            'avg_pkg'    => '₹4.8 - ₹9.5 LPA',
            'cutoff'     => 'Based on GPAT / State CET Pharmacy Merit',
        ],
        'agriculture' => [
            'name'       => 'Agriculture',
            'keywords'   => ['%agri%', '%horticult%', '%veterinar%', '%crop%', '%krishi%'],
            'courses'    => [
                ['course_name' => 'B.Sc (Honours) in Agriculture', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 48, 'course_category' => 'Agriculture & Allied Sciences'],
                ['course_name' => 'B.Sc (Honours) in Horticulture', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 48, 'course_category' => 'Agriculture & Allied Sciences'],
                ['course_name' => 'M.Sc in Agronomy & Crop Physiology', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 24, 'course_category' => 'Agriculture & Allied Sciences'],
                ['course_name' => 'B.Tech in Agricultural Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 48, 'course_category' => 'Agriculture Engineering'],
            ],
            'branches'   => 'Agronomy, Horticulture, Soil Science, Agricultural Entomology, Plant Pathology',
            'fees'       => '₹30,000 – ₹95,000/yr',
            'avg_pkg'    => '₹4.5 - ₹8.5 LPA',
            'cutoff'     => 'Based on ICAR AIEEA / State Agriculture Entrance',
        ],
        'ayush-allied' => [
            'name'       => 'AYUSH & Allied Health',
            'keywords'   => ['%ayush%', '%ayurved%', '%homoeo%', '%unani%', '%naturopath%', '%siddha%', '%yoga%'],
            'courses'    => [
                ['course_name' => 'BAMS - Bachelor of Ayurvedic Medicine and Surgery', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 66, 'course_category' => 'AYUSH'],
                ['course_name' => 'BHMS - Bachelor of Homeopathic Medicine and Surgery', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 66, 'course_category' => 'AYUSH'],
                ['course_name' => 'MD Ayurveda (Kayachikitsa / Dravyaguna)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 36, 'course_category' => 'AYUSH'],
                ['course_name' => 'Diploma in Naturopathy & Yogic Sciences', 'course_type' => 'Diploma Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 36, 'course_category' => 'AYUSH'],
            ],
            'branches'   => 'Kayachikitsa, Dravyaguna, Panchakarma, Shalya Tantra, Homeopathic Materia Medica',
            'fees'       => '₹40,000 – ₹1,80,000/yr',
            'avg_pkg'    => '₹5.0 - ₹10.0 LPA',
            'cutoff'     => 'Based on NEET-UG AYUSH Counseling',
        ],
        'medical' => [
            'name'       => 'Medical',
            'keywords'   => ['%medic%', '%dental%', '%nursing%', '%hospital%', '%health science%', '%paramedic%', '%physiotherap%'],
            'courses'    => [
                ['course_name' => 'MBBS - Bachelor of Medicine & Bachelor of Surgery', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 66, 'course_category' => 'Medical & Health Sciences'],
                ['course_name' => 'MD General Medicine', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 36, 'course_category' => 'Medical & Health Sciences'],
                ['course_name' => 'MS General Surgery', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 36, 'course_category' => 'Medical & Health Sciences'],
                ['course_name' => 'B.Sc Nursing', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 48, 'course_category' => 'Nursing & Paramedical'],
            ],
            'branches'   => 'General Medicine, General Surgery, Pediatrics, Orthopedics, Obstetrics & Gynecology',
            'fees'       => '₹25,000 – ₹7,50,000/yr',
            'avg_pkg'    => '₹8.0 - ₹18.0 LPA',
            'cutoff'     => 'Based on NEET-UG All India & State Quota Merit',
        ],
        'business' => [
            'name'       => 'Business & Management',
            'keywords'   => ['%manage%', '%business%', '%iim%', '%pgdm%', '%mba%', '%bba%'],
            'courses'    => [
                ['course_name' => 'Master of Business Administration (MBA)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 24, 'course_category' => 'Management & Business'],
                ['course_name' => 'Bachelor of Business Administration (BBA)', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 36, 'course_category' => 'Management & Business'],
                ['course_name' => 'MBA in Human Resource Management', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 24, 'course_category' => 'Management & Business'],
                ['course_name' => 'PGDM in Financial Management', 'course_type' => 'Post Graduate Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 24, 'course_category' => 'Management & Business'],
            ],
            'branches'   => 'Finance, Marketing, Human Resource Management, Operations, Business Analytics',
            'fees'       => '₹90,000 – ₹3,50,000/yr',
            'avg_pkg'    => '₹6.5 - ₹16.0 LPA',
            'cutoff'     => 'Based on CAT / MAT / CMAT / XAT / State MBA CET',
        ],
        'technology-engineering' => [
            'name'       => 'Technology & Engineering',
            'keywords'   => ['%engin%', '%technol%', '%polytech%', '%architect%', '%iit%', '%nit%', '%iiit%'],
            'courses'    => [
                ['course_name' => 'B.Tech in Computer Science and Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                ['course_name' => 'B.Tech in Electronics & Communication', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                ['course_name' => 'B.Tech in Information Technology', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
                ['course_name' => 'B.Tech in Mechanical Engineering', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 48, 'course_category' => 'Engineering & Technology'],
            ],
            'branches'   => 'Computer Science, Electronics & Communication, Information Technology, Mechanical, Civil',
            'fees'       => '₹60,000 – ₹2,20,000/yr',
            'avg_pkg'    => '₹5.5 - ₹14.5 LPA',
            'cutoff'     => 'Based on JEE Main / State Engineering CET Ranks',
        ],
        'commerce' => [
            'name'       => 'Commerce',
            'keywords'   => ['%commerc%', '%account%', '%bank%', '%finance%'],
            'courses'    => [
                ['course_name' => 'B.Com (Honours) in Accounting & Finance', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_duration_months' => 36, 'course_category' => 'Commerce & Accountancy'],
                ['course_name' => 'B.Com in Banking and Insurance', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_duration_months' => 36, 'course_category' => 'Commerce & Accountancy'],
                ['course_name' => 'Master of Commerce (M.Com)', 'course_type' => 'Post Graduate Course', 'is_professional' => 'General Course', 'course_duration_months' => 24, 'course_category' => 'Commerce & Accountancy'],
                ['course_name' => 'B.Com in Financial Markets', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_duration_months' => 36, 'course_category' => 'Commerce & Accountancy'],
            ],
            'branches'   => 'Accounting & Finance, Banking & Insurance, Taxation, Financial Markets, Business Economics',
            'fees'       => '₹20,000 – ₹75,000/yr',
            'avg_pkg'    => '₹4.0 - ₹8.0 LPA',
            'cutoff'     => 'Based on 12th Board Merit / CUET Score',
        ],
        'science' => [
            'name'       => 'Science',
            'keywords'   => ['%science%', '%applied sci%', '%physics%', '%chemist%', '%biotech%'],
            'courses'    => [
                ['course_name' => 'B.Sc in Physics, Chemistry & Mathematics', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_duration_months' => 36, 'course_category' => 'Natural & Applied Sciences'],
                ['course_name' => 'B.Sc in Computer Science & Data Analytics', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 36, 'course_category' => 'Computer Applications & IT'],
                ['course_name' => 'B.Sc in Biotechnology & Life Sciences', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 36, 'course_category' => 'Biological & Life Sciences'],
                ['course_name' => 'M.Sc in Applied Chemistry / Physics', 'course_type' => 'Post Graduate Course', 'is_professional' => 'General Course', 'course_duration_months' => 24, 'course_category' => 'Natural Sciences'],
            ],
            'branches'   => 'Physics, Chemistry, Mathematics, Computer Science, Biotechnology, Microbiology',
            'fees'       => '₹15,000 – ₹65,000/yr',
            'avg_pkg'    => '₹4.2 - ₹8.5 LPA',
            'cutoff'     => 'Based on 12th Science Aggregate / CUET Ranks',
        ],
        'arts-humanities' => [
            'name'       => 'Arts & Humanities',
            'keywords'   => ['%arts%', '%humanit%', '%social sci%', '%language%', '%journalism%', '%literature%'],
            'courses'    => [
                ['course_name' => 'B.A (Honours) in English Literature', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_duration_months' => 36, 'course_category' => 'Humanities & Social Sciences'],
                ['course_name' => 'B.A in Political Science & International Relations', 'course_type' => 'Under Graduate Course', 'is_professional' => 'General Course', 'course_duration_months' => 36, 'course_category' => 'Humanities & Social Sciences'],
                ['course_name' => 'B.A in Journalism & Mass Communication', 'course_type' => 'Under Graduate Course', 'is_professional' => 'Professional Course', 'course_duration_months' => 36, 'course_category' => 'Media & Communication'],
                ['course_name' => 'Master of Arts (M.A) in English / History', 'course_type' => 'Post Graduate Course', 'is_professional' => 'General Course', 'course_duration_months' => 24, 'course_category' => 'Post Graduate Education'],
            ],
            'branches'   => 'English Literature, Political Science, History, Psychology, Journalism & Mass Comm',
            'fees'       => '₹12,000 – ₹55,000/yr',
            'avg_pkg'    => '₹3.8 - ₹7.5 LPA',
            'cutoff'     => 'Based on 12th Merit / CUET Score',
        ],
    ];

    /**
     * Curated premier institutions for categories where stubs may be sparse in certain states.
     */
    protected array $curatedColleges = [
        'Delhi' => [
            'hotel-management' => [
                'Institute of Hotel Management, Catering & Nutrition, Pusa' => ['city' => 'Pusa, New Delhi', 'rank' => 1, 'type' => 'Government', 'fees' => '₹1,25,000/yr'],
                'Delhi Institute of Hotel Management (DIHM), Lajpat Nagar' => ['city' => 'Lajpat Nagar, New Delhi', 'rank' => 3, 'type' => 'Government', 'fees' => '₹95,000/yr'],
                'Banarsidas Chandiwala Institute of Hotel Management & Catering Technology' => ['city' => 'Kalkaji, New Delhi', 'rank' => 7, 'type' => 'Private', 'fees' => '₹1,45,000/yr'],
                'Ashok Institute of Hospitality and Tourism Management (ITDC)' => ['city' => 'Chanakyapuri, New Delhi', 'rank' => 12, 'type' => 'Government', 'fees' => '₹85,000/yr'],
                'Guru Nanak Institute of Management (Hospitality Wing)' => ['city' => 'Punjabi Bagh, New Delhi', 'rank' => 18, 'type' => 'Private', 'fees' => '₹1,10,000/yr'],
            ],
            'pharmacy' => [
                'Delhi Pharmaceutical Sciences and Research University (DPSRU)' => ['city' => 'Pushp Vihar, New Delhi', 'rank' => 1, 'type' => 'Government', 'fees' => '₹65,000/yr'],
                'Delhi Institute of Pharmaceutical Sciences and Research (DIPSAR)' => ['city' => 'Sector 3, Pushp Vihar, New Delhi', 'rank' => 2, 'type' => 'Government', 'fees' => '₹55,000/yr'],
                'Jamia Hamdard Faculty of Pharmacy (School of Pharmaceutical Education & Research)' => ['city' => 'Hamdard Nagar, New Delhi', 'rank' => 1, 'type' => 'Deemed University', 'fees' => '₹1,75,000/yr'],
                'Guru Gobind Singh Indraprastha University (School of Pharmacy)' => ['city' => 'Dwarka, New Delhi', 'rank' => 6, 'type' => 'Government', 'fees' => '₹85,000/yr'],
            ],
            'agriculture' => [
                'ICAR - Indian Agricultural Research Institute (Pusa Institute)' => ['city' => 'Pusa Campus, New Delhi', 'rank' => 1, 'type' => 'Central Government', 'fees' => '₹25,000/yr'],
                'Division of Agricultural Engineering, ICAR-IARI' => ['city' => 'Pusa Road, New Delhi', 'rank' => 2, 'type' => 'Central Government', 'fees' => '₹28,000/yr'],
                'Centre for Environment Science and Climate Resilient Agriculture (CESCRA)' => ['city' => 'New Delhi', 'rank' => 5, 'type' => 'Central Government', 'fees' => '₹30,000/yr'],
            ],
            'ayush-allied' => [
                'All India Institute of Ayurveda (AIIA), New Delhi' => ['city' => 'Sarita Vihar, New Delhi', 'rank' => 1, 'type' => 'Central Government', 'fees' => '₹35,000/yr'],
                'Nehru Homoeopathic Medical College & Hospital' => ['city' => 'Defence Colony, New Delhi', 'rank' => 2, 'type' => 'Government', 'fees' => '₹15,000/yr'],
                'Ayurvedic and Unani Tibbia College, Karol Bagh' => ['city' => 'Karol Bagh, New Delhi', 'rank' => 3, 'type' => 'Government', 'fees' => '₹18,000/yr'],
                'Ch. Brahm Prakash Ayurved Charak Sansthan' => ['city' => 'Khera Dabar, Najafgarh, New Delhi', 'rank' => 4, 'type' => 'Government', 'fees' => '₹24,000/yr'],
            ],
        ],
        'Karnataka' => [
            'hotel-management' => [
                'IHM Bangalore - Institute of Hotel Management' => ['city' => 'Seshadri Road, Bengaluru', 'rank' => 2, 'type' => 'Government', 'fees' => '₹1,15,000/yr'],
                'Welcomgroup Graduate School of Hotel Administration (WGSHA), Manipal' => ['city' => 'Manipal, Udupi', 'rank' => 1, 'type' => 'Private', 'fees' => '₹3,20,000/yr'],
                'M.S. Ramaiah College of Hotel Management' => ['city' => 'MSRIT Post, Bengaluru', 'rank' => 5, 'type' => 'Private', 'fees' => '₹1,65,000/yr'],
                'Christ University Department of Hotel Management' => ['city' => 'Hosur Road, Bengaluru', 'rank' => 4, 'type' => 'Deemed University', 'fees' => '₹1,85,000/yr'],
                'Army Institute of Hotel Management & Catering Technology (AIHMCT)' => ['city' => 'Kothanur Post, Bengaluru', 'rank' => 6, 'type' => 'Private', 'fees' => '₹1,40,000/yr'],
                'Garden City University School of Hospitality & Tourism' => ['city' => 'Old Madras Road, Bengaluru', 'rank' => 10, 'type' => 'Private', 'fees' => '₹1,50,000/yr'],
            ],
            'agriculture' => [
                'University of Agricultural Sciences (UAS), GKVK Bangalore' => ['city' => 'GKVK Campus, Bengaluru', 'rank' => 1, 'type' => 'State Government', 'fees' => '₹32,000/yr'],
                'University of Agricultural Sciences (UAS), Dharwad' => ['city' => 'Dharwad', 'rank' => 2, 'type' => 'State Government', 'fees' => '₹30,000/yr'],
                'University of Horticultural Sciences (UHS), Bagalkot' => ['city' => 'Bagalkot', 'rank' => 4, 'type' => 'State Government', 'fees' => '₹28,000/yr'],
                'College of Agriculture, Mandya' => ['city' => 'Mandya', 'rank' => 8, 'type' => 'State Government', 'fees' => '₹25,000/yr'],
                'College of Agricultural Engineering, Raichur' => ['city' => 'Raichur', 'rank' => 9, 'type' => 'State Government', 'fees' => '₹35,000/yr'],
            ],
            'ayush-allied' => [
                'Government Ayurvedic Medical College, Bengaluru' => ['city' => 'Dhanwanthari Road, Bengaluru', 'rank' => 1, 'type' => 'State Government', 'fees' => '₹22,000/yr'],
                'Government Homeopathic Medical College, Bengaluru' => ['city' => 'Basavanagudi, Bengaluru', 'rank' => 2, 'type' => 'State Government', 'fees' => '₹20,000/yr'],
                'SDM College of Ayurveda and Hospital, Udupi' => ['city' => 'Kuthpady, Udupi', 'rank' => 3, 'type' => 'Private', 'fees' => '₹1,80,000/yr'],
                'Sri Dharmasthala Manjunatheshwara College of Ayurveda, Hassan' => ['city' => 'Hassan', 'rank' => 4, 'type' => 'Private', 'fees' => '₹1,75,000/yr'],
            ],
        ],
        'Uttar Pradesh' => [
            'hotel-management' => [
                'Institute of Hotel Management (IHM Lucknow)' => ['city' => 'Aliganj, Lucknow', 'rank' => 3, 'type' => 'Government', 'fees' => '₹1,05,000/yr'],
                'Amity Institute of Hospitality & Hotel Management, Noida' => ['city' => 'Sector 125, Noida', 'rank' => 4, 'type' => 'Private', 'fees' => '₹1,85,000/yr'],
                'Babu Banarasi Das Institute of Hotel Management, Lucknow' => ['city' => 'Faizabad Road, Lucknow', 'rank' => 8, 'type' => 'Private', 'fees' => '₹95,000/yr'],
                'Dr. Ambedkar Institute of Hotel Management, Meerut' => ['city' => 'Meerut', 'rank' => 11, 'type' => 'Private', 'fees' => '₹85,000/yr'],
                'Institute of Hotel Management, Catering Technology & Applied Nutrition, Meerut' => ['city' => 'Delhi-Dehradun Bypass, Meerut', 'rank' => 12, 'type' => 'Private', 'fees' => '₹90,000/yr'],
            ],
            'agriculture' => [
                'Chandra Shekhar Azad University of Agriculture & Technology (CSAUAT), Kanpur' => ['city' => 'Kanpur', 'rank' => 1, 'type' => 'State Government', 'fees' => '₹28,000/yr'],
                'Acharya Narendra Deva University of Agriculture & Technology, Ayodhya' => ['city' => 'Kumarganj, Ayodhya', 'rank' => 2, 'type' => 'State Government', 'fees' => '₹25,000/yr'],
                'Sam Higginbottom University of Agriculture, Technology and Sciences (SHUATS)' => ['city' => 'Naini, Prayagraj', 'rank' => 3, 'type' => 'Deemed University', 'fees' => '₹75,000/yr'],
                'Sardar Vallabhbhai Patel University of Agriculture and Technology, Meerut' => ['city' => 'Meerut', 'rank' => 4, 'type' => 'State Government', 'fees' => '₹30,000/yr'],
                'Banda University of Agriculture and Technology, Banda' => ['city' => 'Banda', 'rank' => 6, 'type' => 'State Government', 'fees' => '₹22,000/yr'],
            ],
            'ayush-allied' => [
                'State Ayurvedic College and Hospital, Lucknow' => ['city' => 'Tulsidas Marg, Lucknow', 'rank' => 1, 'type' => 'State Government', 'fees' => '₹18,000/yr'],
                'Faculty of Ayurveda, Institute of Medical Sciences BHU' => ['city' => 'Varanasi', 'rank' => 1, 'type' => 'Central Government', 'fees' => '₹24,000/yr'],
                'National Homeopathic Medical College & Hospital, Lucknow' => ['city' => 'Gomti Nagar, Lucknow', 'rank' => 2, 'type' => 'State Government', 'fees' => '₹16,000/yr'],
                'Lal Bahadur Shastri Homoeopathic Medical College, Prayagraj' => ['city' => 'Prayagraj', 'rank' => 5, 'type' => 'State Government', 'fees' => '₹15,000/yr'],
            ],
        ],
        'Tamil Nadu' => [
            'hotel-management' => [
                'Institute of Hotel Management (IHM Chennai)' => ['city' => 'Taramani, Chennai', 'rank' => 2, 'type' => 'Government', 'fees' => '₹1,10,000/yr'],
                'SRM Institute of Hotel Management, Kattankulathur' => ['city' => 'Chennai', 'rank' => 4, 'type' => 'Private', 'fees' => '₹1,65,000/yr'],
                'Madras Institute of Hotel Management & Catering Technology' => ['city' => 'Porur, Chennai', 'rank' => 7, 'type' => 'Private', 'fees' => '₹1,15,000/yr'],
                'State Institute of Hotel Management and Catering Technology, Thuvakkudi' => ['city' => 'Tiruchirappalli', 'rank' => 8, 'type' => 'State Government', 'fees' => '₹75,000/yr'],
                'Asan Memorial Institute of Hotel Management' => ['city' => 'Jaladampet, Chennai', 'rank' => 11, 'type' => 'Private', 'fees' => '₹95,000/yr'],
            ],
            'agriculture' => [
                'Tamil Nadu Agricultural University (TNAU), Coimbatore' => ['city' => 'Coimbatore', 'rank' => 1, 'type' => 'State Government', 'fees' => '₹35,000/yr'],
                'Agricultural College and Research Institute, Madurai' => ['city' => 'Madurai', 'rank' => 2, 'type' => 'State Government', 'fees' => '₹30,000/yr'],
                'Anbil Dharmalingam Agricultural College and Research Institute, Trichy' => ['city' => 'Tiruchirappalli', 'rank' => 4, 'type' => 'State Government', 'fees' => '₹28,000/yr'],
                'Horticultural College and Research Institute, Periyakulam' => ['city' => 'Periyakulam, Theni', 'rank' => 5, 'type' => 'State Government', 'fees' => '₹26,000/yr'],
            ],
            'ayush-allied' => [
                'National Institute of Siddha (NIS), Chennai' => ['city' => 'Tambaram Sanatorium, Chennai', 'rank' => 1, 'type' => 'Central Government', 'fees' => '₹25,000/yr'],
                'Government Siddha Medical College, Palayamkottai' => ['city' => 'Tirunelveli', 'rank' => 2, 'type' => 'State Government', 'fees' => '₹15,000/yr'],
                'Government Ayurveda Medical College & Hospital, Kottar' => ['city' => 'Nagercoil', 'rank' => 3, 'type' => 'State Government', 'fees' => '₹18,000/yr'],
                'Government Homoeopathic Medical College, Thirumangalam' => ['city' => 'Madurai', 'rank' => 4, 'type' => 'State Government', 'fees' => '₹16,000/yr'],
            ],
        ],
        'West Bengal' => [
            'hotel-management' => [
                'Institute of Hotel Management (IHM Kolkata)' => ['city' => 'Taratala Road, Kolkata', 'rank' => 2, 'type' => 'Government', 'fees' => '₹1,15,000/yr'],
                'Guru Nanak Institute of Hotel Management, Sodepur' => ['city' => 'Kolkata', 'rank' => 5, 'type' => 'Private', 'fees' => '₹1,35,000/yr'],
                'NIPS Hotel Management, Salt Lake' => ['city' => 'Salt Lake, Kolkata', 'rank' => 6, 'type' => 'Private', 'fees' => '₹1,45,000/yr'],
                'IIHM Kolkata - International Institute of Hotel Management' => ['city' => 'Salt Lake Sector V, Kolkata', 'rank' => 3, 'type' => 'Private', 'fees' => '₹2,10,000/yr'],
                'State Institute of Hotel Management, Durgapur' => ['city' => 'Durgapur', 'rank' => 8, 'type' => 'State Government', 'fees' => '₹75,000/yr'],
            ],
            'agriculture' => [
                'Bidhan Chandra Krishi Viswavidyalaya (BCKV), Mohanpur' => ['city' => 'Mohanpur, Nadia', 'rank' => 1, 'type' => 'State Government', 'fees' => '₹24,000/yr'],
                'Uttar Banga Krishi Viswavidyalaya (UBKV), Pundibari' => ['city' => 'Cooch Behar', 'rank' => 2, 'type' => 'State Government', 'fees' => '₹22,000/yr'],
                'Palli Siksha Bhavana (Institute of Agriculture), Visva-Bharati' => ['city' => 'Sriniketan, Santiniketan', 'rank' => 3, 'type' => 'Central University', 'fees' => '₹18,000/yr'],
            ],
            'ayush-allied' => [
                'National Institute of Homoeopathy (NIH), Kolkata' => ['city' => 'Salt Lake, Kolkata', 'rank' => 1, 'type' => 'Central Government', 'fees' => '₹20,000/yr'],
                'Calcutta Homoeopathic Medical College & Hospital' => ['city' => 'Acharya Prafulla Chandra Road, Kolkata', 'rank' => 2, 'type' => 'State Government', 'fees' => '₹15,000/yr'],
                'J.B. Roy State Ayurvedic Medical College and Hospital' => ['city' => 'Raja Dinendra Street, Kolkata', 'rank' => 3, 'type' => 'State Government', 'fees' => '₹16,000/yr'],
            ],
        ],
        'Telangana' => [
            'hotel-management' => [
                'Institute of Hotel Management (IHM Hyderabad)' => ['city' => 'Vidyanagar, Hyderabad', 'rank' => 2, 'type' => 'Government', 'fees' => '₹1,10,000/yr'],
                'Culinary Academy of India, Hyderabad' => ['city' => 'Begumpet, Hyderabad', 'rank' => 3, 'type' => 'Private', 'fees' => '₹2,25,000/yr'],
                'Pioneer Institute of Hotel Management' => ['city' => 'Ramanthapur, Hyderabad', 'rank' => 6, 'type' => 'Private', 'fees' => '₹95,000/yr'],
                'Shri Shakti College of Hotel Management' => ['city' => 'Begumpet, Hyderabad', 'rank' => 7, 'type' => 'Private', 'fees' => '₹1,20,000/yr'],
                'Regency College of Culinary Arts & Hotel Management' => ['city' => 'Khairatabad, Hyderabad', 'rank' => 8, 'type' => 'Private', 'fees' => '₹1,15,000/yr'],
            ],
            'agriculture' => [
                'Professor Jayashankar Telangana State Agricultural University (PJTSAU)' => ['city' => 'Rajendranagar, Hyderabad', 'rank' => 1, 'type' => 'State Government', 'fees' => '₹32,000/yr'],
                'College of Agricultural Engineering, Kandi, Sangareddy' => ['city' => 'Sangareddy', 'rank' => 3, 'type' => 'State Government', 'fees' => '₹35,000/yr'],
                'Sri Konda Laxman Telangana State Horticultural University (SKLTSHU)' => ['city' => 'Mulugu, Siddipet', 'rank' => 4, 'type' => 'State Government', 'fees' => '₹28,000/yr'],
            ],
        ],
        'Gujarat' => [
            'hotel-management' => [
                'Institute of Hotel Management (IHM Ahmedabad)' => ['city' => 'Gandhinagar', 'rank' => 3, 'type' => 'Government', 'fees' => '₹1,05,000/yr'],
                'State Institute of Hotel Management, Siddhpur' => ['city' => 'Patan', 'rank' => 7, 'type' => 'State Government', 'fees' => '₹75,000/yr'],
                'Parul Institute of Hotel Management and Catering Technology, Vadodara' => ['city' => 'Vadodara', 'rank' => 6, 'type' => 'Private', 'fees' => '₹1,30,000/yr'],
                'Institute of Hotel Management & Catering Technology, Surat' => ['city' => 'Surat', 'rank' => 9, 'type' => 'Private', 'fees' => '₹95,000/yr'],
            ],
        ],
        'Rajasthan' => [
            'hotel-management' => [
                'Institute of Hotel Management (IHM Jaipur)' => ['city' => 'Bani Park, Jaipur', 'rank' => 3, 'type' => 'Government', 'fees' => '₹1,05,000/yr'],
                'Institute of Hotel Management (IHM Jodhpur)' => ['city' => 'Jodhpur', 'rank' => 5, 'type' => 'State Government', 'fees' => '₹85,000/yr'],
                'State Institute of Hotel Management, Udaipur' => ['city' => 'Udaipur', 'rank' => 6, 'type' => 'State Government', 'fees' => '₹80,000/yr'],
                'Amity Institute of Hospitality, Jaipur' => ['city' => 'Kant Kalwar, Jaipur', 'rank' => 8, 'type' => 'Private', 'fees' => '₹1,50,000/yr'],
            ],
        ],
        'Kerala' => [
            'hotel-management' => [
                'Institute of Hotel Management and Catering Technology (IHM Kovalam)' => ['city' => 'Thiruvananthapuram', 'rank' => 2, 'type' => 'Government', 'fees' => '₹1,15,000/yr'],
                'State Institute of Hospitality Management, Kozhikode' => ['city' => 'Kozhikode', 'rank' => 5, 'type' => 'State Government', 'fees' => '₹78,000/yr'],
                'Oriental School of Hotel Management, Wayanad' => ['city' => 'Lakkidi, Wayanad', 'rank' => 4, 'type' => 'Private', 'fees' => '₹1,65,000/yr'],
                'Munnar Catering College' => ['city' => 'Munnar, Idukki', 'rank' => 7, 'type' => 'Private', 'fees' => '₹1,45,000/yr'],
            ],
            'agriculture' => [
                'Kerala Agricultural University (KAU), Vellanikkara' => ['city' => 'Thrissur', 'rank' => 1, 'type' => 'State Government', 'fees' => '₹28,000/yr'],
                'College of Agriculture, Vellayani' => ['city' => 'Thiruvananthapuram', 'rank' => 2, 'type' => 'State Government', 'fees' => '₹26,000/yr'],
                'College of Horticulture, Vellanikkara' => ['city' => 'Thrissur', 'rank' => 3, 'type' => 'State Government', 'fees' => '₹25,000/yr'],
                'Kelappaji College of Agricultural Engineering and Technology, Tavanur' => ['city' => 'Malappuram', 'rank' => 4, 'type' => 'State Government', 'fees' => '₹34,000/yr'],
            ],
        ],
    ];

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $minPerState = (int) $this->option('min-per-state');
        $fieldsMap = Field::pluck('id', 'slug')->toArray();

        $this->info("🏛️  Populating Explore Hubs Across All 10 Disciplines and All 10 States...");
        $this->info("🎯 Minimum target: At least {$minPerState} colleges per state per explore category\n");

        $totalAddedToExplore = 0;
        $totalCoursesAdded = 0;

        foreach ($this->fieldConfigs as $fieldSlug => $config) {
            $fieldId = $fieldsMap[$fieldSlug] ?? null;
            if (!$fieldId) {
                continue;
            }

            $fieldName = $config['name'];
            $this->line("────────────────────────────────────────────────────────────────────────────────");
            $this->info("📚 Category: [{$fieldName}] (Slug: {$fieldSlug}, Field ID: {$fieldId})");
            $this->line("────────────────────────────────────────────────────────────────────────────────");

            foreach ($this->targetStates as $stateName => $meta) {
                $currentCount = College::where('field_id', $fieldId)->where('state', $stateName)->count();

                if ($currentCount >= $minPerState) {
                    $this->line("   ✓ State [{$stateName}]: Already has {$currentCount} colleges");
                    continue;
                }

                $needed = $minPerState - $currentCount;
                $addedThisState = 0;

                // 1. First, check if curated premier colleges exist for this state & category
                if (isset($this->curatedColleges[$stateName][$fieldSlug])) {
                    foreach ($this->curatedColleges[$stateName][$fieldSlug] as $instName => $instData) {
                        if ($addedThisState >= $needed) break;

                        // Insert or get in indian_colleges
                        $slug = Str::slug($instName);
                        $website = "https://www.{$slug}.ac.in";
                        $city = $instData['city'] ?? $meta['city'];
                        $rank = $instData['rank'] ?? rand(1, 20);
                        $type = $instData['type'] ?? 'Government';
                        $fees = $instData['fees'] ?? $config['fees'];

                        // Insert courses in indian_colleges
                        $hasCourses = IndianCollege::where('college_name', $instName)->where('state', $stateName)->exists();
                        if (!$hasCourses) {
                            foreach ($config['courses'] as $c) {
                                IndianCollege::create([
                                    'college_name'           => $instName,
                                    'state'                  => $stateName,
                                    'district'               => $meta['dist'],
                                    'taluka'                 => $meta['dist'],
                                    'university_type'        => str_contains($type, 'Central') ? 'Central University' : 'State Public University',
                                    'university_name'        => $meta['univ'],
                                    'college_type'           => str_contains($type, 'Deemed') ? 'Deemed University' : 'Autonomous College',
                                    'affiliation'            => 'UGC & Statutory Councils Approved',
                                    'management'             => $type,
                                    'website'                => $website,
                                    'year_of_establishment'  => 1970 + rand(0, 45),
                                    'address'                => "{$instName}, {$city}, {$stateName}",
                                    'city'                   => $city,
                                    'pin_code'               => $meta['pin'],
                                    'total_enrollment'       => 1500 + rand(200, 3500),
                                    'faculty_count'          => 80 + rand(20, 150),
                                    'course_name'            => $c['course_name'],
                                    'course_type'            => $c['course_type'],
                                    'is_professional'        => $c['is_professional'],
                                    'course_aided_unaided'   => str_contains($type, 'Gov') ? 'Aided' : 'Un-Aided',
                                    'course_duration_months' => $c['course_duration_months'],
                                    'course_category'        => $c['course_category'],
                                ]);
                                $totalCoursesAdded++;
                            }
                        }

                        // Upsert into College explore model
                        College::updateOrCreate(
                            [
                                'name'     => $instName,
                                'state'    => $stateName,
                                'field_id' => $fieldId,
                            ],
                            [
                                'location'                 => $city,
                                'fees_range'               => $fees,
                                'type'                     => str_contains(strtolower($type), 'gov') ? 'Government' : 'Private',
                                'website'                  => $website,
                                'rank'                     => $rank,
                                'government_rank'          => $rank,
                                'naac_grade'               => 'A+',
                                'popular_branches'         => $config['branches'],
                                'cutoff'                   => $config['cutoff'],
                                'placement_support'        => 'Central training and placement cell with top industry tie-ups & recruiters',
                                'facilities'               => 'Modern Campus, Central Library, State-of-the-Art Labs, Hostels, Sports Complex',
                                'description'              => "{$instName} is a premier institution in {$city}, {$stateName}, renowned for exceptional academic training in {$fieldName}.",
                                'average_package'          => $config['avg_pkg'],
                                'tier'                     => $rank <= 10 ? 'Tier 1' : 'Tier 2',
                                'duration'                 => '3 - 5 Years',
                                'specializations'          => 'Undergraduate & Postgraduate Degree Programs',
                                'research_support'         => 'Funded research projects, advanced departmental laboratories and international MOUs',
                                'internship_opportunities' => 'Mandatory industrial training, corporate internships and field projects',
                            ]
                        );

                        $addedThisState++;
                        $totalAddedToExplore++;
                    }
                }

                // 2. Next, check if matching unseeded stubs exist in indian_colleges for this state
                if ($addedThisState < $needed) {
                    $remaining = $needed - $addedThisState;
                    $stubsQuery = DB::table('indian_colleges')
                        ->where('state', $stateName)
                        ->where(function ($q) use ($config) {
                            foreach ($config['keywords'] as $kw) {
                                $q->orWhere('college_name', 'like', $kw);
                            }
                        });

                    $stubs = $stubsQuery->limit($remaining * 2)->get();

                    foreach ($stubs as $stub) {
                        if ($addedThisState >= $needed) break;

                        $rawName = $stub->college_name;
                        $cleanName = preg_replace('/\s*\(Id:\s*[A-Za-z0-9\-_]+\)\s*$/i', '', $rawName);
                        $cleanName = preg_replace('/\s*\(id:[^\)]+\)/i', '', $cleanName);
                        $cleanName = trim($cleanName);

                        if (empty($cleanName) || strlen($cleanName) < 4) continue;

                        // Check if already in College for this field
                        if (College::where('field_id', $fieldId)->where('name', $cleanName)->exists()) {
                            continue;
                        }

                        $slug = Str::slug($cleanName);
                        if (strlen($slug) > 30) $slug = substr($slug, 0, 30);
                        $website = "https://www.{$slug}.edu.in";
                        $city = !empty($stub->city) ? trim($stub->city) : $meta['city'];
                        $dist = !empty($stub->district) ? trim($stub->district) : $meta['dist'];
                        $pin = $meta['pin'] + (abs(crc32($cleanName)) % 800);
                        $mgmt = !empty($stub->management) ? $stub->management : (str_contains(strtolower($cleanName), 'govt') || str_contains(strtolower($cleanName), 'government') ? 'State Government' : 'Private Unaided');
                        $rank = (abs(crc32($cleanName . 'r')) % 70) + 1;

                        // Insert courses into indian_colleges
                        DB::table('indian_colleges')->where('id', $stub->id)->delete();
                        foreach ($config['courses'] as $c) {
                            IndianCollege::create([
                                'college_name'           => $cleanName,
                                'state'                  => $stateName,
                                'district'               => $dist,
                                'taluka'                 => $dist,
                                'university_type'        => 'State Public University',
                                'university_name'        => $stub->university_name ?? $meta['univ'],
                                'college_type'           => 'Affiliated College',
                                'affiliation'            => 'UGC & Statutory Bodies Approved',
                                'management'             => $mgmt,
                                'website'                => $website,
                                'year_of_establishment'  => 1980 + (abs(crc32($cleanName)) % 40),
                                'address'                => "{$cleanName}, {$dist}, {$stateName} - {$pin}",
                                'city'                   => $city,
                                'pin_code'               => $pin,
                                'total_enrollment'       => 1200 + (abs(crc32($cleanName . 'e')) % 3500),
                                'faculty_count'          => 60 + (abs(crc32($cleanName . 'f')) % 120),
                                'course_name'            => $c['course_name'],
                                'course_type'            => $c['course_type'],
                                'is_professional'        => $c['is_professional'],
                                'course_aided_unaided'   => str_contains(strtolower($mgmt), 'gov') ? 'Aided' : 'Un-Aided',
                                'course_duration_months' => $c['course_duration_months'],
                                'course_category'        => $c['course_category'],
                            ]);
                            $totalCoursesAdded++;
                        }

                        // Upsert into College explore model
                        College::updateOrCreate(
                            [
                                'name'     => $cleanName,
                                'state'    => $stateName,
                                'field_id' => $fieldId,
                            ],
                            [
                                'location'                 => $city,
                                'fees_range'               => $config['fees'],
                                'type'                     => str_contains(strtolower($mgmt), 'gov') ? 'Government' : 'Private',
                                'website'                  => $website,
                                'rank'                     => $rank,
                                'government_rank'          => $rank,
                                'naac_grade'               => 'A',
                                'popular_branches'         => $config['branches'],
                                'cutoff'                   => $config['cutoff'],
                                'placement_support'        => 'Dedicated placement cell offering campus interviews and career counseling',
                                'facilities'               => 'Modern Classrooms, High-Tech Laboratories, Digital Library, Sports Facilities',
                                'description'              => "{$cleanName} is a recognized institution in {$dist}, {$stateName}, providing quality education in {$fieldName}.",
                                'average_package'          => $config['avg_pkg'],
                                'tier'                     => $rank <= 30 ? 'Tier 1' : 'Tier 2',
                                'duration'                 => '3 - 5 Years',
                                'specializations'          => 'Undergraduate & Postgraduate Degree Programs',
                                'research_support'         => 'Faculty research initiatives and academic conferences',
                                'internship_opportunities' => 'Mandatory industrial training and internships',
                            ]
                        );

                        $addedThisState++;
                        $totalAddedToExplore++;
                    }
                }

                // 3. If still needed, look for existing colleges in indian_colleges for this state that have matching courses
                if ($addedThisState < $needed) {
                    $existingNames = IndianCollege::where('state', $stateName)
                        ->where(function ($q) use ($config) {
                            foreach ($config['keywords'] as $kw) {
                                $q->orWhere('college_name', 'like', $kw)
                                  ->orWhere('course_name', 'like', $kw);
                            }
                        })
                        ->distinct('college_name')
                        ->limit($needed - $addedThisState)
                        ->pluck('college_name');

                    foreach ($existingNames as $eName) {
                        if ($addedThisState >= $needed) break;
                        if (College::where('field_id', $fieldId)->where('name', $eName)->exists()) continue;

                        $eRecord = IndianCollege::where('college_name', $eName)->where('state', $stateName)->first();
                        if (!$eRecord) continue;

                        College::create([
                            'name'                     => $eName,
                            'state'                    => $stateName,
                            'field_id'                 => $fieldId,
                            'location'                 => $eRecord->city ?? $eRecord->district ?? $meta['city'],
                            'fees_range'               => $config['fees'],
                            'type'                     => str_contains(strtolower($eRecord->management ?? ''), 'gov') ? 'Government' : 'Private',
                            'website'                  => $eRecord->website ?? "https://www." . Str::slug(substr($eName, 0, 25)) . ".edu.in",
                            'rank'                     => rand(1, 50),
                            'government_rank'          => rand(1, 50),
                            'naac_grade'               => 'A',
                            'popular_branches'         => $config['branches'],
                            'cutoff'                   => $config['cutoff'],
                            'placement_support'        => 'Active placement cell with campus recruitment drives',
                            'facilities'               => 'Central Library, Research Labs, Sports Grounds, Hostels',
                            'description'              => "{$eName} is a premier educational institution in {$stateName} providing recognized degree programs in {$fieldName}.",
                            'average_package'          => $config['avg_pkg'],
                            'tier'                     => 'Tier 2',
                            'duration'                 => '3 - 5 Years',
                            'specializations'          => 'Accredited Undergraduate & Postgraduate Degrees',
                            'research_support'         => 'Active faculty research projects and industry MOUs',
                            'internship_opportunities' => 'Mandatory internships and industry exposure programs',
                        ]);

                        $addedThisState++;
                        $totalAddedToExplore++;
                    }
                }

                $finalCount = College::where('field_id', $fieldId)->where('state', $stateName)->count();
                $this->line("   ▸ State [{$stateName}]: +{$addedThisState} added (New Total: {$finalCount})");
            }
        }

        // Fix all tiers to ensure no NULL tier remains in explore table
        DB::table('colleges')->whereNull('tier')->update(['tier' => 'Tier 2']);

        Cache::forget('indian_college_names');

        $this->line("\n" . str_repeat('=', 80));
        $this->info("🎉 ALL EXPLORE HUBS SYNCHRONIZATION COMPLETE!");
        $this->info("🏛️  Total Institutions Added to Explore : {$totalAddedToExplore}");
        $this->info("📚 Total Degree Courses Added          : {$totalCoursesAdded}");
        $this->line(str_repeat('=', 80));

        return 0;
    }
}
