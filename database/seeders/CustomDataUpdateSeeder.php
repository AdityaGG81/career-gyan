<?php

namespace Database\Seeders;

use App\Models\Field;
use App\Models\College;
use App\Models\Career;
use Illuminate\Database\Seeder;

class CustomDataUpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Update cover images for fields (categories) to avoid repeated fallbacks
        $covers = [
            'arts-humanities' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&q=80&w=1000',
            'commerce' => 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?auto=format&fit=crop&q=80&w=1000',
            'science' => 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?auto=format&fit=crop&q=80&w=1000',
            'technology-engineering' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&q=80&w=1000',
            'medical' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&q=80&w=1000',
            'business' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=1000',
            'skill-development' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&q=80&w=1000',
            'sports' => 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&q=80&w=1000',
            'agriculture' => 'https://images.unsplash.com/photo-1625246333195-78d9c38ad449?auto=format&fit=crop&q=80&w=1000',
            'agriculture-food-environment' => 'https://images.unsplash.com/photo-1625246333195-78d9c38ad449?auto=format&fit=crop&q=80&w=1000',
            'creative-design-media' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&q=80&w=1000',
            'hospitality-aviation-tourism-logistics' => 'https://images.unsplash.com/photo-1566073171526-8731302eb8ed?auto=format&fit=crop&q=80&w=1000',
            'education-social-law-policy' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&q=80&w=1000',
            'skill-trades-manufacturing-retail' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&q=80&w=1000',
            'agriculture-allied-sciences' => 'https://images.unsplash.com/photo-1625246333195-78d9c38ad449?auto=format&fit=crop&q=80&w=1000',
            'arts-media-entertainment' => 'https://images.unsplash.com/photo-1611162617474-5b21e879e113?auto=format&fit=crop&q=80&w=1000',
            'small-scale' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&q=80&w=1000',
            'government-defence' => 'https://images.unsplash.com/photo-1508182314998-3bd49473002f?auto=format&fit=crop&q=80&w=1000',
            'teaching-law' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&q=80&w=1000',
            'modern-tech' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&q=80&w=1000',
            'it-digital-technology' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&q=80&w=1000',
            'creative-careers' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&q=80&w=1000',
            'social-media' => 'https://images.unsplash.com/photo-1611162617474-5b21e879e113?auto=format&fit=crop&q=80&w=1000',
            'gaming-careers' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&q=80&w=1000',
            'freelancing' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&q=80&w=1000',
            'competitive-exams' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&q=80&w=1000',
            'ayush-allied' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&q=80&w=1000',
            'healthcare-allied-medical' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&q=80&w=1000',
            'pharmacy' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?auto=format&fit=crop&q=80&w=1000',
            'hotel-management' => 'https://images.unsplash.com/photo-1566073171526-8731302eb8ed?auto=format&fit=crop&q=80&w=1000',
            'others' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&q=80&w=1000'
        ];

        foreach ($covers as $slug => $url) {
            Field::where('slug', $slug)->update(['cover_image' => $url]);
        }

        // 2. Add FLAME University in database under Business/Management
        $mgmtField = Field::where('slug', 'business')->first();
        if ($mgmtField) {
            College::updateOrCreate(
                ['name' => 'FLAME University'],
                [
                    'field_id' => $mgmtField->id,
                    'location' => 'Pune',
                    'state' => 'Maharashtra',
                    'fees_range' => '₹7L - ₹9L/year',
                    'type' => 'Private',
                    'website' => 'https://www.flame.edu.in',
                    'rank' => 1,
                    'popular_branches' => 'BBA, MBA, BA Liberal Arts',
                    'cutoff' => 'FEAT / SAT / ACT / CAT / MAT',
                    'placement_support' => '100% placement assistance, major recruiters include PwC, EY, Deloitte, HDFC Bank, etc.',
                    'facilities' => 'World-class campus, library, sports complex, state-of-the-art labs, housing',
                    'description' => 'FLAME University is the pioneer of liberal education in India, providing an interdisciplinary learning experience with a global outlook.',
                    'youtube_url' => 'https://youtu.be/lsUCLpJZE4I?si=KaFjo6QhPmdVH9x8',
                ]
            );
        }

        // Make sure all FLAME University matches (e.g. Flame University Pune) get the youtube URL
        College::where('name', 'like', '%Flame%')->update([
            'youtube_url' => 'https://youtu.be/lsUCLpJZE4I?si=KaFjo6QhPmdVH9x8'
        ]);

        // 3. Add video URL for astrophysicist / astronomer careers
        Career::where('slug', 'astrophysicist')
            ->orWhere('slug', 'astronomer-astrophysicist')
            ->update([
                'video_url' => 'https://youtu.be/WmGTWKnR8Fw?si=iIjscdjUgSoppCGl'
            ]);

        // 4. Update Rankings and NAAC grades for top colleges
        // IIT Bombay
        College::where('name', 'like', '%IIT Bombay%')
            ->orWhere('name', 'like', '%Indian Institute of Technology Bombay%')
            ->update([
                'rank' => 1,
                'government_rank' => 3,
                'naac_grade' => 'A++'
            ]);

        // IIT Delhi
        College::where('name', 'like', '%IIT Delhi%')
            ->orWhere('name', 'like', '%Indian Institute of Technology Delhi%')
            ->update([
                'rank' => 2,
                'government_rank' => 2,
                'naac_grade' => 'A++'
            ]);

        // FLAME University
        College::where('name', 'like', '%FLAME University%')
            ->update([
                'rank' => 3,
                'government_rank' => 101,
                'naac_grade' => 'A'
            ]);

        // SRM Institute
        College::where('name', 'like', '%SRM Institute%')
            ->update([
                'rank' => 4,
                'government_rank' => 32,
                'naac_grade' => 'A++'
            ]);
    }
}
