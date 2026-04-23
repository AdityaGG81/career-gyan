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
            ['name' => 'Foster Development Homeopathic Medical College', 'location' => 'Aurangabad', 'type' => 'Private', 'branch' => 'BHMS'],
            ['name' => 'Bharati Vidyapeeth Homeopathic Medical College', 'location' => 'Pune', 'type' => 'Private', 'branch' => 'BHMS'],
            ['name' => 'SMBT Homeopathic Medical College', 'location' => 'Nashik', 'type' => 'Private', 'branch' => 'BHMS'],
            ['name' => 'DKMM Homeopathic Medical College', 'location' => 'Aurangabad', 'type' => 'Private', 'branch' => 'BHMS'],

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
