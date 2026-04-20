<?php

namespace Database\Seeders;

use App\Models\College;
use App\Models\Field;
use Illuminate\Database\Seeder;

class CollegesSeeder extends Seeder
{
    public function run(): void
    {
        $colleges = [
            /* ── Technology / Engineering ── */
            ['name' => 'IIT Bombay',                         'field' => 'technology-engineering', 'location' => 'Mumbai',       'state' => 'Maharashtra', 'fees_range' => '₹2L – ₹2.5L/yr', 'type' => 'Central'],
            ['name' => 'IIT Delhi',                          'field' => 'technology-engineering', 'location' => 'New Delhi',    'state' => 'Delhi',       'fees_range' => '₹2L – ₹2.5L/yr', 'type' => 'Central'],
            ['name' => 'NIT Trichy',                         'field' => 'technology-engineering', 'location' => 'Tiruchirappalli', 'state' => 'Tamil Nadu', 'fees_range' => '₹1.5L – ₹2L/yr', 'type' => 'Central'],
            ['name' => 'VIT University',                     'field' => 'technology-engineering', 'location' => 'Vellore',      'state' => 'Tamil Nadu', 'fees_range' => '₹1.8L – ₹2.5L/yr', 'type' => 'Deemed'],
            ['name' => 'SRM Institute of Science & Tech',   'field' => 'technology-engineering', 'location' => 'Chennai',      'state' => 'Tamil Nadu', 'fees_range' => '₹2L – ₹3L/yr',   'type' => 'Deemed'],

            /* ── Medical ── */
            ['name' => 'AIIMS New Delhi',                   'field' => 'medical', 'location' => 'New Delhi',  'state' => 'Delhi',          'fees_range' => '₹1,000 – ₹5,000/yr', 'type' => 'Government'],
            ['name' => 'CMC Vellore',                       'field' => 'medical', 'location' => 'Vellore',    'state' => 'Tamil Nadu',     'fees_range' => '₹60K – ₹1L/yr',      'type' => 'Deemed'],
            ['name' => 'JIPMER Puducherry',                 'field' => 'medical', 'location' => 'Puducherry', 'state' => 'Puducherry',     'fees_range' => '₹5K – ₹20K/yr',      'type' => 'Government'],
            ['name' => 'Kasturba Medical College',          'field' => 'medical', 'location' => 'Mangaluru',  'state' => 'Karnataka',      'fees_range' => '₹5L – ₹8L/yr',       'type' => 'Deemed'],

            /* ── Commerce ── */
            ['name' => 'Shri Ram College of Commerce',      'field' => 'commerce', 'location' => 'Delhi',     'state' => 'Delhi',          'fees_range' => '₹15K – ₹25K/yr', 'type' => 'Government'],
            ['name' => 'Christ University',                 'field' => 'commerce', 'location' => 'Bengaluru', 'state' => 'Karnataka',      'fees_range' => '₹1L – ₹1.5L/yr', 'type' => 'Deemed'],
            ['name' => 'Narsee Monjee IMC',                 'field' => 'commerce', 'location' => 'Mumbai',    'state' => 'Maharashtra',    'fees_range' => '₹80K – ₹1.2L/yr', 'type' => 'Deemed'],

            /* ── Science ── */
            ['name' => 'St. Xavier\'s College Mumbai',      'field' => 'science',  'location' => 'Mumbai',    'state' => 'Maharashtra',    'fees_range' => '₹20K – ₹40K/yr', 'type' => 'Private'],
            ['name' => 'Presidency University Kolkata',     'field' => 'science',  'location' => 'Kolkata',   'state' => 'West Bengal',    'fees_range' => '₹10K – ₹20K/yr', 'type' => 'Government'],
            ['name' => 'Indian Institute of Science (IISc)','field' => 'science',  'location' => 'Bengaluru', 'state' => 'Karnataka',      'fees_range' => '₹30K – ₹60K/yr', 'type' => 'Central'],

            /* ── Business Administration ── */
            ['name' => 'IIM Ahmedabad',                     'field' => 'business', 'location' => 'Ahmedabad', 'state' => 'Gujarat',        'fees_range' => '₹24L (total)',    'type' => 'Government'],
            ['name' => 'IIM Bangalore',                     'field' => 'business', 'location' => 'Bengaluru', 'state' => 'Karnataka',      'fees_range' => '₹24L (total)',    'type' => 'Government'],
            ['name' => 'XLRI Jamshedpur',                   'field' => 'business', 'location' => 'Jamshedpur','state' => 'Jharkhand',      'fees_range' => '₹26L (total)',    'type' => 'Private'],

            /* ── Arts & Humanities ── */
            ['name' => 'NID Ahmedabad',                     'field' => 'arts-humanities', 'location' => 'Ahmedabad','state' => 'Gujarat',   'fees_range' => '₹1.8L – ₹2.5L/yr', 'type' => 'Government'],
            ['name' => 'NIFT New Delhi',                    'field' => 'arts-humanities', 'location' => 'New Delhi', 'state' => 'Delhi',    'fees_range' => '₹1.5L – ₹2L/yr', 'type' => 'Government'],

            /* ── Agriculture ── */
            ['name' => 'IARI (Indian Agricultural Research Institute)', 'field' => 'agriculture', 'location' => 'New Delhi', 'state' => 'Delhi', 'fees_range' => '₹10K – ₹30K/yr', 'type' => 'Central'],
            ['name' => 'G.B. Pant University of Agriculture',           'field' => 'agriculture', 'location' => 'Pantnagar',  'state' => 'Uttarakhand', 'fees_range' => '₹15K – ₹40K/yr', 'type' => 'Government'],

            /* ── Traditional / Govt careers ── */
            ['name' => 'LBSNAA (IAS Training)',             'field' => 'traditional', 'location' => 'Mussoorie',  'state' => 'Uttarakhand', 'fees_range' => 'Free (Govt funded)', 'type' => 'Government'],

            /* ── Sports ── */
            ['name' => 'Sports Authority of India (SAI)',   'field' => 'sports', 'location' => 'New Delhi', 'state' => 'Delhi', 'fees_range' => 'Free / Scholarship', 'type' => 'Government'],
            ['name' => 'LNIPE Gwalior',                     'field' => 'sports', 'location' => 'Gwalior',   'state' => 'Madhya Pradesh', 'fees_range' => '₹30K – ₹60K/yr', 'type' => 'Central'],
        ];

        foreach ($colleges as $data) {
            $field = Field::where('slug', $data['field'])->first();
            if (! $field) {
                continue;
            }

            College::updateOrCreate(
                ['name' => $data['name'], 'field_id' => $field->id],
                [
                    'location'   => $data['location'],
                    'state'      => $data['state'],
                    'fees_range' => $data['fees_range'],
                    'type'       => $data['type'],
                ]
            );
        }
    }
}
