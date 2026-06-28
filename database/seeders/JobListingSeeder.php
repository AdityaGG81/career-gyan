<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobListing;

class JobListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobListing::query()->delete();

        $jobs = [
            // --- Government Jobs (job_type: govt) ---
            [
                'company_name' => 'Union Public Service Commission (UPSC)',
                'job_title' => 'Civil Services Examination 2026',
                'job_type' => 'govt',
                'category' => 'State Govt',
                'qualification' => 'Graduate',
                'location' => 'Across India',
                'last_date' => now()->addDays(20)->format('Y-m-d'),
                'apply_link' => 'https://upsconline.nic.in',
                'notification_file' => null,
                'description' => 'Recruitment for IAS, IPS, IFS and other group A services. Candidate must hold a degree from any recognized university.',
                'status' => 'active',
            ],
            [
                'company_name' => 'Railway Recruitment Board (RRB)',
                'job_title' => 'NTPC Graduate & Under Graduate Posts',
                'job_type' => 'govt',
                'category' => 'Railway',
                'qualification' => '12th Pass',
                'location' => 'Across India',
                'last_date' => now()->addDays(15)->format('Y-m-d'),
                'apply_link' => 'https://indianrailways.gov.in',
                'notification_file' => null,
                'description' => 'Recruitment for Non-Technical Popular Categories (NTPC) including Clerk, Typist, Ticket Keeper, and Goods Guard.',
                'status' => 'active',
            ],
            [
                'company_name' => 'Staff Selection Commission (SSC)',
                'job_title' => 'Combined Graduate Level (CGL) 2026',
                'job_type' => 'govt',
                'category' => 'SSC',
                'qualification' => 'Graduate',
                'location' => 'Across India',
                'last_date' => now()->addDays(30)->format('Y-m-d'),
                'apply_link' => 'https://ssc.gov.in',
                'notification_file' => null,
                'description' => 'Recruitment for Group B and C posts in various Ministries, Departments, and Organizations of the Government of India.',
                'status' => 'active',
            ],
            [
                'company_name' => 'State Bank of India (SBI)',
                'job_title' => 'Probationary Officers (PO)',
                'job_type' => 'govt',
                'category' => 'Banking',
                'qualification' => 'Graduate',
                'location' => 'Across India',
                'last_date' => now()->addDays(12)->format('Y-m-d'),
                'apply_link' => 'https://sbi.co.in/careers',
                'notification_file' => null,
                'description' => 'SBI PO recruitment for junior management grade scale I officers. Candidates in the final year of graduation are also eligible.',
                'status' => 'active',
            ],
            [
                'company_name' => 'Indian Army',
                'job_title' => 'Agniveer Recruitment Rally 2026',
                'job_type' => 'govt',
                'category' => 'Defense',
                'qualification' => '10th Pass',
                'location' => 'Maharashtra',
                'last_date' => now()->addDays(25)->format('Y-m-d'),
                'apply_link' => 'https://joinindianarmy.nic.in',
                'notification_file' => null,
                'description' => 'Agniveer General Duty, Agniveer Technical, Agniveer Clerk, and Agniveer Tradesman recruitment under the Agnipath scheme.',
                'status' => 'active',
            ],
            [
                'company_name' => 'Maharashtra Public Service Commission (MPSC)',
                'job_title' => 'State Services Preliminary Exam 2026',
                'job_type' => 'govt',
                'category' => 'State Govt',
                'qualification' => 'Graduate',
                'location' => 'Maharashtra',
                'last_date' => now()->addDays(8)->format('Y-m-d'),
                'apply_link' => 'https://mpsc.gov.in',
                'notification_file' => null,
                'description' => 'Recruitment for Deputy Collector, Deputy Superintendent of Police (DySP), and other administrative roles in Maharashtra state.',
                'status' => 'active',
            ],
            [
                'company_name' => 'Reserve Bank of India (RBI)',
                'job_title' => 'Grade B Officers Recruitment',
                'job_type' => 'govt',
                'category' => 'Banking',
                'qualification' => 'Post Graduate',
                'location' => 'Across India',
                'last_date' => now()->addDays(5)->format('Y-m-d'),
                'apply_link' => 'https://opportunities.rbi.org.in',
                'notification_file' => null,
                'description' => 'Recruitment for Officers in Grade B (General/DEPR/DSIM). Minimum 60% marks in graduation or equivalent.',
                'status' => 'active',
            ],
            [
                'company_name' => 'Indian Navy',
                'job_title' => 'Short Service Commission (SSC) Officers',
                'job_type' => 'govt',
                'category' => 'Defense',
                'qualification' => 'Diploma',
                'location' => 'Across India',
                'last_date' => now()->addDays(18)->format('Y-m-d'),
                'apply_link' => 'https://joinindiannavy.gov.in',
                'notification_file' => null,
                'description' => 'Recruitment of Short Service Commission Officers in Executive, Technical and Education branches for the course starting Jan 2027.',
                'status' => 'active',
            ],
            
            // --- Private Jobs (job_type: pvt) ---
            [
                'company_name' => 'Salesforce India',
                'job_title' => 'Associate Software Engineer (AI Cloud)',
                'job_type' => 'pvt',
                'category' => 'IT/Software',
                'qualification' => 'Graduate',
                'location' => 'Bengaluru',
                'last_date' => now()->addDays(22)->format('Y-m-d'),
                'apply_link' => 'https://www.salesforce.com/company/careers',
                'notification_file' => null,
                'description' => 'Join Salesforce AI Cloud team to build the future of CRM. Looking for candidates with strong foundational knowledge in Java, Python, and cloud APIs.',
                'status' => 'active',
            ],
            [
                'company_name' => 'Google India',
                'job_title' => 'Software Engineering Intern - 2026',
                'job_type' => 'pvt',
                'category' => 'IT/Software',
                'qualification' => 'Graduate',
                'location' => 'Pune',
                'last_date' => now()->addDays(10)->format('Y-m-d'),
                'apply_link' => 'https://careers.google.com',
                'notification_file' => null,
                'description' => '10-week summer internship for university students. Work alongside Googlers on challenging engineering projects in Search, Maps, or Cloud.',
                'status' => 'active',
            ],
            [
                'company_name' => 'Tata Consultancy Services (TCS)',
                'job_title' => 'TCS Ninja Recruitment Drive',
                'job_type' => 'pvt',
                'category' => 'IT/Software',
                'qualification' => 'Graduate',
                'location' => 'Across India',
                'last_date' => now()->addDays(14)->format('Y-m-d'),
                'apply_link' => 'https://www.tcs.com/careers',
                'notification_file' => null,
                'description' => 'Mass hiring drive for freshers. Graduates of 2025/2026 batch are eligible. Online coding & aptitude test followed by technical interview.',
                'status' => 'active',
            ],
            [
                'company_name' => 'Career Gyan Institute',
                'job_title' => 'Subject Matter Expert (EdTech)',
                'job_type' => 'pvt',
                'category' => 'Education',
                'qualification' => 'Post Graduate',
                'location' => 'Pune',
                'last_date' => now()->addDays(15)->format('Y-m-d'),
                'apply_link' => 'https://careergyan.in/careers',
                'notification_file' => null,
                'description' => 'Develop high-quality study materials, test series, and guide candidates preparing for competitive exams like UPSC, SSC, and Banking.',
                'status' => 'active',
            ],
            
            // --- Expired Jobs for Archiving Test ---
            [
                'company_name' => 'Intelligence Bureau (IB)',
                'job_title' => 'Assistant Central Intelligence Officer (ACIO) Grade II',
                'job_type' => 'govt',
                'category' => 'Others',
                'qualification' => 'Graduate',
                'location' => 'New Delhi',
                'last_date' => now()->subDays(5)->format('Y-m-d'),
                'apply_link' => 'https://mha.gov.in',
                'notification_file' => null,
                'description' => 'Expired: Recruitment for ACIO Executive posts. Highly confidential and critical security roles.',
                'status' => 'active',
            ],
            [
                'company_name' => 'ISRO Propulsion Complex (IPRC)',
                'job_title' => 'Graduate & Technician Apprentices',
                'job_type' => 'govt',
                'category' => 'Others',
                'qualification' => 'Diploma',
                'location' => 'Tamil Nadu',
                'last_date' => now()->subDays(12)->format('Y-m-d'),
                'apply_link' => 'https://iprc.gov.in',
                'notification_file' => null,
                'description' => 'Expired: Apprenticeship training under the Apprentices Act in various Engineering disciplines.',
                'status' => 'active',
            ],
            [
                'company_name' => 'Infosys Limited',
                'job_title' => 'Systems Engineer Trainee',
                'job_type' => 'pvt',
                'category' => 'IT/Software',
                'qualification' => 'Graduate',
                'location' => 'Mysuru',
                'last_date' => now()->subDays(3)->format('Y-m-d'),
                'apply_link' => 'https://careers.infosys.com',
                'notification_file' => null,
                'description' => 'Expired: 3-month comprehensive training at Infosys Global Education Center in Mysuru before onboarding as Systems Engineer.',
                'status' => 'active',
            ],
        ];

        foreach ($jobs as $job) {
            JobListing::create($job);
        }
    }
}
