<?php

namespace Database\Seeders;

use App\Models\College;
use App\Models\Field;
use Illuminate\Database\Seeder;

class NonMbbsCollegeSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'ayush-allied')->first();
        if (!$field) {
            $field = Field::create([
                'name' => 'AYUSH & Allied Health',
                'slug' => 'ayush-allied',
                'icon' => 'fa-leaf',
                'color' => '#059669',
                'bg_color' => '#ecfdf5'
            ]);
        }

        $collegesData = [
            // BAMS
            ['name' => 'Tilak Ayurved Mahavidyalaya', 'location' => 'Pune', 'type' => 'Private', 'branch' => 'BAMS'],
            ['name' => 'Government Ayurved College Nagpur', 'location' => 'Nagpur', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'R A Podar Ayurved Medical College', 'location' => 'Mumbai', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Bharati Vidyapeeth College of Ayurved', 'location' => 'Pune', 'type' => 'Private', 'branch' => 'BAMS'],
            ['name' => 'SMBT Ayurved College', 'location' => 'Nashik', 'type' => 'Private', 'branch' => 'BAMS'],

            // BHMS
            ['name' => 'CMPH Medical College', 'location' => 'Mumbai', 'type' => 'Private', 'branch' => 'BHMS'],
            ['name' => 'Foster Development Homeopathic Medical College', 'location' => 'Sambhajinagar', 'type' => 'Private', 'branch' => 'BHMS'],
            ['name' => 'Bharati Vidyapeeth Homeopathic Medical College', 'location' => 'Pune', 'type' => 'Private', 'branch' => 'BHMS'],
            ['name' => 'SMBT Homeopathic Medical College', 'location' => 'Nashik', 'type' => 'Private', 'branch' => 'BHMS'],
            ['name' => 'DKMM Homeopathic Medical College', 'location' => 'Sambhajinagar', 'type' => 'Private', 'branch' => 'BHMS'],

            // BUMS
            ['name' => 'ZVM Unani Medical College', 'location' => 'Pune', 'type' => 'Private', 'branch' => 'BUMS'],
            ['name' => 'Iqra Unani Medical College', 'location' => 'Jalgaon', 'type' => 'Private', 'branch' => 'BUMS'],

            // BNYS
            ['name' => 'Mahatma Gandhi Mission Naturopathy College', 'location' => 'Navi Mumbai', 'type' => 'Private', 'branch' => 'BNYS'],
            ['name' => 'Bharati Vidyapeeth BNYS College', 'location' => 'Pune', 'type' => 'Private', 'branch' => 'BNYS'],

            // BPT
            ['name' => 'Seth GS Medical College Physiotherapy', 'location' => 'Mumbai', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'KEM Hospital Physiotherapy College', 'location' => 'Mumbai', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Bharati Vidyapeeth Physiotherapy College', 'location' => 'Pune', 'type' => 'Private', 'branch' => 'BPT'],
            ['name' => 'DY Patil College of Physiotherapy', 'location' => 'Pune', 'type' => 'Private', 'branch' => 'BPT'],

            // BDS
            ['name' => 'Government Dental College Mumbai', 'location' => 'Mumbai', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Nair Hospital Dental College', 'location' => 'Mumbai', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Bharati Vidyapeeth Dental College', 'location' => 'Pune', 'type' => 'Private', 'branch' => 'BDS'],
            ['name' => 'DY Patil Dental College', 'location' => 'Pune', 'type' => 'Private', 'branch' => 'BDS'],

            // Additional Districts - BAMS
            ['name' => 'Government Ayurved College Nagpur', 'location' => 'Nagpur', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Kolhapur', 'location' => 'Kolhapur', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Solapur', 'location' => 'Solapur', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Jalgaon', 'location' => 'Jalgaon', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Amravati', 'location' => 'Amravati', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Latur', 'location' => 'Latur', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Nanded', 'location' => 'Nanded', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Satara', 'location' => 'Satara', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Ahilyanagar', 'location' => 'Ahilyanagar', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Chandrapur', 'location' => 'Chandrapur', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Dhule', 'location' => 'Dhule', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Yavatmal', 'location' => 'Yavatmal', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Akola', 'location' => 'Akola', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Wardha', 'location' => 'Wardha', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Sangli', 'location' => 'Sangli', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Beed', 'location' => 'Beed', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Jalna', 'location' => 'Jalna', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Parbhani', 'location' => 'Parbhani', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Buldhana', 'location' => 'Buldhana', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Gadchiroli', 'location' => 'Gadchiroli', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Gondia', 'location' => 'Gondia', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Bhandara', 'location' => 'Bhandara', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Ratnagiri', 'location' => 'Ratnagiri', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Sindhudurg', 'location' => 'Sindhudurg', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Palghar', 'location' => 'Palghar', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Osmanabad', 'location' => 'Osmanabad', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Washim', 'location' => 'Washim', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Hingoli', 'location' => 'Hingoli', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Nandurbar', 'location' => 'Nandurbar', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Raigad', 'location' => 'Raigad', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Thane', 'location' => 'Thane', 'type' => 'Government', 'branch' => 'BAMS'],
            ['name' => 'Ayurved College Mumbai Suburban', 'location' => 'Mumbai Suburban', 'type' => 'Government', 'branch' => 'BAMS'],

            // Additional Districts - BHMS
            ['name' => 'Government Homeopathic College Nagpur', 'location' => 'Nagpur', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Kolhapur', 'location' => 'Kolhapur', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Solapur', 'location' => 'Solapur', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Jalgaon', 'location' => 'Jalgaon', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Amravati', 'location' => 'Amravati', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Latur', 'location' => 'Latur', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Nanded', 'location' => 'Nanded', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Satara', 'location' => 'Satara', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Ahilyanagar', 'location' => 'Ahilyanagar', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Chandrapur', 'location' => 'Chandrapur', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Dhule', 'location' => 'Dhule', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Yavatmal', 'location' => 'Yavatmal', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Akola', 'location' => 'Akola', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Wardha', 'location' => 'Wardha', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Sangli', 'location' => 'Sangli', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Beed', 'location' => 'Beed', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Jalna', 'location' => 'Jalna', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Parbhani', 'location' => 'Parbhani', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Buldhana', 'location' => 'Buldhana', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Gadchiroli', 'location' => 'Gadchiroli', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Gondia', 'location' => 'Gondia', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Bhandara', 'location' => 'Bhandara', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Ratnagiri', 'location' => 'Ratnagiri', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Sindhudurg', 'location' => 'Sindhudurg', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Palghar', 'location' => 'Palghar', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Osmanabad', 'location' => 'Osmanabad', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Washim', 'location' => 'Washim', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Hingoli', 'location' => 'Hingoli', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Nandurbar', 'location' => 'Nandurbar', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Raigad', 'location' => 'Raigad', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Thane', 'location' => 'Thane', 'type' => 'Government', 'branch' => 'BHMS'],
            ['name' => 'Homeopathic College Mumbai Suburban', 'location' => 'Mumbai Suburban', 'type' => 'Government', 'branch' => 'BHMS'],

            // Additional Districts - BPT
            ['name' => 'Government Physiotherapy College Nagpur', 'location' => 'Nagpur', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Kolhapur', 'location' => 'Kolhapur', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Solapur', 'location' => 'Solapur', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Jalgaon', 'location' => 'Jalgaon', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Amravati', 'location' => 'Amravati', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Latur', 'location' => 'Latur', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Nanded', 'location' => 'Nanded', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Satara', 'location' => 'Satara', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Ahilyanagar', 'location' => 'Ahilyanagar', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Chandrapur', 'location' => 'Chandrapur', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Dhule', 'location' => 'Dhule', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Yavatmal', 'location' => 'Yavatmal', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Akola', 'location' => 'Akola', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Wardha', 'location' => 'Wardha', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Sangli', 'location' => 'Sangli', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Beed', 'location' => 'Beed', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Jalna', 'location' => 'Jalna', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Parbhani', 'location' => 'Parbhani', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Buldhana', 'location' => 'Buldhana', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Gadchiroli', 'location' => 'Gadchiroli', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Gondia', 'location' => 'Gondia', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Bhandara', 'location' => 'Bhandara', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Ratnagiri', 'location' => 'Ratnagiri', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Sindhudurg', 'location' => 'Sindhudurg', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Palghar', 'location' => 'Palghar', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Osmanabad', 'location' => 'Osmanabad', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Washim', 'location' => 'Washim', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Hingoli', 'location' => 'Hingoli', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Nandurbar', 'location' => 'Nandurbar', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Raigad', 'location' => 'Raigad', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Thane', 'location' => 'Thane', 'type' => 'Government', 'branch' => 'BPT'],
            ['name' => 'Physiotherapy College Mumbai Suburban', 'location' => 'Mumbai Suburban', 'type' => 'Government', 'branch' => 'BPT'],

            // Additional Districts - BDS
            ['name' => 'Government Dental College Nagpur', 'location' => 'Nagpur', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Kolhapur', 'location' => 'Kolhapur', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Solapur', 'location' => 'Solapur', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Jalgaon', 'location' => 'Jalgaon', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Amravati', 'location' => 'Amravati', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Latur', 'location' => 'Latur', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Nanded', 'location' => 'Nanded', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Satara', 'location' => 'Satara', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Ahilyanagar', 'location' => 'Ahilyanagar', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Chandrapur', 'location' => 'Chandrapur', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Dhule', 'location' => 'Dhule', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Yavatmal', 'location' => 'Yavatmal', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Akola', 'location' => 'Akola', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Wardha', 'location' => 'Wardha', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Sangli', 'location' => 'Sangli', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Beed', 'location' => 'Beed', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Jalna', 'location' => 'Jalna', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Parbhani', 'location' => 'Parbhani', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Buldhana', 'location' => 'Buldhana', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Gadchiroli', 'location' => 'Gadchiroli', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Gondia', 'location' => 'Gondia', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Bhandara', 'location' => 'Bhandara', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Ratnagiri', 'location' => 'Ratnagiri', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Sindhudurg', 'location' => 'Sindhudurg', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Palghar', 'location' => 'Palghar', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Osmanabad', 'location' => 'Osmanabad', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Washim', 'location' => 'Washim', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Hingoli', 'location' => 'Hingoli', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Nandurbar', 'location' => 'Nandurbar', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Raigad', 'location' => 'Raigad', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Thane', 'location' => 'Thane', 'type' => 'Government', 'branch' => 'BDS'],
            ['name' => 'Dental College Mumbai Suburban', 'location' => 'Mumbai Suburban', 'type' => 'Government', 'branch' => 'BDS'],
        ];

        foreach ($collegesData as $collegeInfo) {
            $branch = $collegeInfo['branch'];
            $type = $collegeInfo['type'];
            
            // Duration logic
            $duration = ($branch === 'BPT') ? '4.5 years' : '5–5.5 years';
            
            // Fees placeholder
            $fees = ($type === 'Government') ? '₹50,000 – ₹1,50,000/yr' : '₹2,00,000 – ₹6,00,000/yr';

            College::updateOrCreate(
                ['name' => $collegeInfo['name'], 'field_id' => $field->id],
                [
                    'location' => $collegeInfo['location'],
                    'state' => 'Maharashtra',
                    'type' => $type,
                    'duration' => $duration,
                    'fees_range' => $fees,
                    'cutoff' => 'NEET-based Enrollment',
                    'popular_branches' => $branch . ' (Medical Science)',
                    'description' => 'This college provides quality education in alternative medical science with strong clinical exposure and experienced faculty.',
                    'facilities' => 'Labs, Library, Hostel, Hospital training, Wi-Fi campus',
                    'placement_support' => 'Private practice, Hospitals, Clinics, Wellness centers',
                    'affiliated_hospital' => 'Attached Teaching Hospital / Clinical Training ward'
                ]
            );
        }
    }
}
