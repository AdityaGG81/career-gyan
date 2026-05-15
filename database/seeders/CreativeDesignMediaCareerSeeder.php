<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Career;
use App\Models\Field;

class CreativeDesignMediaCareerSeeder extends Seeder
{
    public function run(): void
    {
        $fieldSlug = 'creative-design-media';
        $field = Field::where('slug', $fieldSlug)->first();

        if (!$field) {
            $this->command->error("Field '$fieldSlug' not found. Please run FieldsSeeder first.");
            return;
        }

        $careers = [
            [
                'slug' => 'graphic-designer',
                'name' => 'Graphic Designer',
                'sub_domain' => 'Visual Design & Communication',
                'description' => 'Graphic Designers create visual designs for branding, advertising, websites, social media, packaging, and print materials.',
                'salary_range' => '₹2L – ₹8L',
                'demand_level' => 'High',
                'qualification' => 'Diploma / B.Des / BFA / Certification in Graphic Design',
                'stream' => 'Arts / Design / Any Stream',
                'entrance_exams' => ['UCEED', 'NID DAT', 'NIFT', 'CUET'],
                'skills' => ['Typography', 'Layout Design', 'Branding', 'Adobe Photoshop', 'Illustrator', 'Creativity'],
                'job_opportunities' => ['Design Studios', 'Advertising Agencies', 'IT Companies', 'Startups', 'Media Houses'],
                'image' => 'images/careers/creative-design-media/graphic-designer.svg'
            ],
            [
                'slug' => 'illustrator',
                'name' => 'Illustrator',
                'sub_domain' => 'Illustration & Fine Arts',
                'description' => 'Illustrators create drawings and visual artwork for books, magazines, advertisements, games, animations, products, and digital media.',
                'salary_range' => '₹2L – ₹10L',
                'demand_level' => 'Moderate',
                'qualification' => 'BFA / B.Des / Diploma in Illustration or Fine Arts',
                'stream' => 'Arts / Design / Any Stream',
                'entrance_exams' => ['NID DAT', 'UCEED', 'CUET', 'State Fine Arts Exams'],
                'skills' => ['Drawing', 'Digital Illustration', 'Concept Art', 'Storytelling', 'Adobe Illustrator', 'Procreate'],
                'job_opportunities' => ['Publishing Houses', 'Animation Studios', 'Game Studios', 'Advertising Agencies', 'EdTech Companies'],
                'image' => 'images/careers/creative-design-media/illustrator.svg'
            ],
            [
                'slug' => '3d-artist',
                'name' => '3D Artist',
                'sub_domain' => 'Animation, 3D & Game Art',
                'description' => '3D Artists create three-dimensional models, characters, environments, products, and visual assets for films, games, architecture, and advertising.',
                'salary_range' => '₹3L – ₹12L',
                'demand_level' => 'High',
                'qualification' => 'Diploma / B.Sc / B.Des in Animation, VFX, Game Design, or 3D Art',
                'stream' => 'Arts / Science / Design / Any Stream',
                'entrance_exams' => ['NID DAT', 'UCEED', 'CUET'],
                'skills' => ['3D Modelling', 'Texturing', 'Lighting', 'Blender', 'Maya', 'ZBrush', 'Creativity'],
                'job_opportunities' => ['Animation Studios', 'VFX Companies', 'Game Studios', 'Architecture Firms', 'Advertising Agencies'],
                'image' => 'images/careers/creative-design-media/3d-artist.svg'
            ],
            [
                'slug' => 'motion-graphics-designer',
                'name' => 'Motion Graphics Designer',
                'sub_domain' => 'Animation, 3D & Game Art',
                'description' => 'Motion Graphics Designers create animated graphics, title sequences, explainer videos, advertisements, and digital visual effects.',
                'salary_range' => '₹3L – ₹12L',
                'demand_level' => 'High',
                'qualification' => 'Diploma / Degree in Animation, Graphic Design, VFX, or Multimedia',
                'stream' => 'Arts / Design / Any Stream',
                'entrance_exams' => ['NID DAT', 'UCEED', 'CUET'],
                'skills' => ['Animation', 'After Effects', 'Visual Storytelling', 'Typography', 'Video Editing', 'Creative Thinking'],
                'job_opportunities' => ['Advertising Agencies', 'Media Houses', 'YouTube Channels', 'Film Studios', 'IT Companies'],
                'image' => 'images/careers/creative-design-media/motion-graphics-designer.svg'
            ],
            [
                'slug' => 'video-editor',
                'name' => 'Video Editor',
                'sub_domain' => 'Video, Audio & Media Production',
                'description' => 'Video Editors arrange, cut, and enhance video footage for films, YouTube videos, advertisements, social media, documentaries, and corporate videos.',
                'salary_range' => '₹2.5L – ₹10L',
                'demand_level' => 'High',
                'qualification' => 'Diploma / Degree in Film Editing, Mass Media, Multimedia, or Video Production',
                'stream' => 'Arts / Media / Any Stream',
                'entrance_exams' => ['FTII Entrance Exam', 'SRFTI Entrance Exam', 'CUET'],
                'skills' => ['Premiere Pro', 'Final Cut Pro', 'Storytelling', 'Color Correction', 'Sound Syncing', 'Creativity'],
                'job_opportunities' => ['Film Studios', 'Media Companies', 'Advertising Agencies', 'YouTube Creators', 'OTT Platforms'],
                'image' => 'images/careers/creative-design-media/video-editor.svg'
            ],
            [
                'slug' => 'audio-engineer',
                'name' => 'Audio Engineer',
                'sub_domain' => 'Video, Audio & Media Production',
                'description' => 'Audio Engineers record, mix, edit, and master sound for music, films, podcasts, live events, advertisements, and broadcasting.',
                'salary_range' => '₹2.5L – ₹9L',
                'demand_level' => 'Moderate',
                'qualification' => 'Diploma / Degree in Sound Engineering, Audio Production, or Music Technology',
                'stream' => 'Arts / Science / Any Stream',
                'entrance_exams' => ['FTII Entrance Exam', 'SRFTI Entrance Exam'],
                'skills' => ['Sound Recording', 'Mixing', 'Mastering', 'Pro Tools', 'Logic Pro', 'Studio Equipment Handling'],
                'job_opportunities' => ['Recording Studios', 'Film Studios', 'Radio Stations', 'Event Companies', 'OTT Platforms'],
                'image' => 'images/careers/creative-design-media/audio-engineer.svg'
            ],
            [
                'slug' => 'music-producer',
                'name' => 'Music Producer',
                'sub_domain' => 'Video, Audio & Media Production',
                'description' => 'Music Producers create, arrange, record, and manage music tracks for films, albums, advertisements, games, and digital platforms.',
                'salary_range' => '₹2L – ₹15L+',
                'demand_level' => 'Moderate',
                'qualification' => 'Diploma / Degree in Music Production, Sound Engineering, or Music Technology',
                'stream' => 'Arts / Music / Any Stream',
                'entrance_exams' => ['University Music Exams'],
                'skills' => ['Music Composition', 'Beat Making', 'Recording', 'Mixing', 'DAW Software', 'Creativity'],
                'job_opportunities' => ['Music Studios', 'Film Industry', 'Advertising Agencies', 'Independent Artists', 'OTT Platforms'],
                'image' => 'images/careers/creative-design-media/music-producer.svg'
            ],
            [
                'slug' => 'voice-artist',
                'name' => 'Voice Artist',
                'sub_domain' => 'Performing Arts & Voice Media',
                'description' => 'Voice Artists provide voice recordings for advertisements, audiobooks, animations, films, documentaries, IVR systems, and digital content.',
                'salary_range' => '₹1L – ₹12L+',
                'demand_level' => 'Moderate',
                'qualification' => 'Voice Training / Theatre Training / Diploma in Performing Arts or Media',
                'stream' => 'Arts / Any Stream',
                'entrance_exams' => ['Auditions Required'],
                'skills' => ['Voice Modulation', 'Diction', 'Language Fluency', 'Expression', 'Script Reading', 'Recording Skills'],
                'job_opportunities' => ['Advertising Agencies', 'Animation Studios', 'Radio Stations', 'Audiobook Platforms', 'YouTube Channels'],
                'image' => 'images/careers/creative-design-media/voice-artist.svg'
            ],
            [
                'slug' => 'dubbing-artist',
                'name' => 'Dubbing Artist',
                'sub_domain' => 'Performing Arts & Voice Media',
                'description' => 'Dubbing Artists provide voiceovers for films, TV shows, animations, web series, documentaries, and regional language adaptations.',
                'salary_range' => '₹1.5L – ₹10L+',
                'demand_level' => 'Moderate',
                'qualification' => 'Voice Training / Acting Course / Diploma in Media or Theatre',
                'stream' => 'Arts / Any Stream',
                'entrance_exams' => ['Auditions Required'],
                'skills' => ['Voice Acting', 'Lip Sync', 'Dialogue Delivery', 'Language Fluency', 'Emotion Control', 'Timing'],
                'job_opportunities' => ['Film Studios', 'OTT Platforms', 'Animation Studios', 'Dubbing Studios', 'TV Channels'],
                'image' => 'images/careers/creative-design-media/dubbing-artist.svg'
            ],
            [
                'slug' => 'podcast-producer',
                'name' => 'Podcast Producer',
                'sub_domain' => 'Video, Audio & Media Production',
                'description' => 'Podcast Producers plan, record, edit, publish, and manage podcast episodes for brands, creators, media platforms, and educational channels.',
                'salary_range' => '₹2.5L – ₹10L',
                'demand_level' => 'High',
                'qualification' => 'Degree / Diploma in Mass Media, Journalism, Audio Production, or Communication',
                'stream' => 'Arts / Media / Any Stream',
                'entrance_exams' => ['CUET'],
                'skills' => ['Audio Editing', 'Script Planning', 'Interviewing', 'Storytelling', 'Content Strategy', 'Publishing Tools'],
                'job_opportunities' => ['Media Companies', 'Digital Agencies', 'YouTube Channels', 'EdTech Companies', 'Brands'],
                'image' => 'images/careers/creative-design-media/podcast-producer.svg'
            ],
            [
                'slug' => 'advertising-copywriter',
                'name' => 'Advertising Copywriter',
                'sub_domain' => 'Advertising & Creative Strategy',
                'description' => 'Advertising Copywriters write catchy slogans, ad scripts, campaign ideas, social media captions, brand messages, and promotional content.',
                'salary_range' => '₹3L – ₹12L',
                'demand_level' => 'High',
                'qualification' => 'BA / BMM / BJMC / Degree in Advertising, Mass Communication, or English',
                'stream' => 'Arts / Commerce / Any Stream',
                'entrance_exams' => ['CUET'],
                'skills' => ['Creative Writing', 'Brand Communication', 'Storytelling', 'Marketing Thinking', 'Grammar', 'Campaign Ideation'],
                'job_opportunities' => ['Advertising Agencies', 'Digital Marketing Agencies', 'Brands', 'Startups', 'Media Houses'],
                'image' => 'images/careers/creative-design-media/advertising-copywriter.svg'
            ],
            [
                'slug' => 'creative-director',
                'name' => 'Creative Director',
                'sub_domain' => 'Advertising & Creative Strategy',
                'description' => 'Creative Directors lead creative teams and guide the overall visual, content, branding, and campaign direction for companies and clients.',
                'salary_range' => '₹12L – ₹35L+',
                'demand_level' => 'High',
                'qualification' => 'Degree in Design, Advertising, Mass Communication, Fine Arts, or Marketing',
                'stream' => 'Arts / Design / Commerce / Any Stream',
                'entrance_exams' => ['NID DAT', 'UCEED', 'CUET'],
                'skills' => ['Leadership', 'Branding', 'Campaign Strategy', 'Visual Direction', 'Team Management', 'Creative Thinking'],
                'job_opportunities' => ['Advertising Agencies', 'Design Studios', 'Media Companies', 'Film Studios', 'Brands'],
                'image' => 'images/careers/creative-design-media/creative-director.svg'
            ],
            [
                'slug' => 'ux-researcher',
                'name' => 'UX Researcher',
                'sub_domain' => 'UX, Research & Digital Experience',
                'description' => 'UX Researchers study user behavior, needs, pain points, and feedback to help teams design better websites, apps, and digital products.',
                'salary_range' => '₹5L – ₹18L',
                'demand_level' => 'Very High',
                'qualification' => 'B.Des / B.Tech / Psychology / HCI / UX Design Certification',
                'stream' => 'Design / Science / Arts / Any Stream',
                'entrance_exams' => ['UCEED', 'NID DAT', 'CEED', 'CUET'],
                'skills' => ['User Research', 'Interviews', 'Surveys', 'Usability Testing', 'Data Analysis', 'Empathy', 'Product Thinking'],
                'job_opportunities' => ['IT Companies', 'Product Companies', 'Startups', 'UX Agencies', 'FinTech'],
                'image' => 'images/careers/creative-design-media/ux-researcher.svg'
            ],
            [
                'slug' => 'game-artist',
                'name' => 'Game Artist',
                'sub_domain' => 'Animation, 3D & Game Art',
                'description' => 'Game Artists create characters, backgrounds, props, textures, icons, and visual assets used in mobile, PC, console, and AR/VR games.',
                'salary_range' => '₹3L – ₹12L',
                'demand_level' => 'High',
                'qualification' => 'Diploma / Degree in Game Art, Animation, Fine Arts, or Digital Design',
                'stream' => 'Arts / Design / Any Stream',
                'entrance_exams' => ['NID DAT', 'UCEED', 'CUET'],
                'skills' => ['Concept Art', 'Character Design', 'Environment Design', 'Photoshop', 'Blender', 'Unity Asset Creation'],
                'job_opportunities' => ['Game Studios', 'Animation Studios', 'AR/VR Companies', 'EdTech Gaming Firms', 'Mobile Game Companies'],
                'image' => 'images/careers/creative-design-media/game-artist.svg'
            ],
            [
                'slug' => 'game-animator',
                'name' => 'Game Animator',
                'sub_domain' => 'Animation, 3D & Game Art',
                'description' => 'Game Animators create movement and actions for game characters, creatures, vehicles, weapons, and interactive environments.',
                'salary_range' => '₹3L – ₹14L',
                'demand_level' => 'High',
                'qualification' => 'Diploma / Degree in Animation, Game Design, VFX, or Multimedia',
                'stream' => 'Arts / Design / Any Stream',
                'entrance_exams' => ['NID DAT', 'UCEED', 'CUET'],
                'skills' => ['Character Animation', 'Motion Timing', 'Maya', 'Blender', 'Unity', 'Unreal Engine', 'Creativity'],
                'job_opportunities' => ['Game Studios', 'Animation Companies', 'AR/VR Studios', 'Simulation Companies'],
                'image' => 'images/careers/creative-design-media/game-animator.svg'
            ],
            [
                'slug' => 'game-writer',
                'name' => 'Game Writer',
                'sub_domain' => 'Animation, 3D & Game Art',
                'description' => 'Game Writers create storylines, dialogues, missions, character backgrounds, world-building content, and interactive narratives for games.',
                'salary_range' => '₹3L – ₹12L',
                'demand_level' => 'Moderate',
                'qualification' => 'BA / MA in English, Creative Writing, Game Design, or Mass Communication',
                'stream' => 'Arts / Media / Any Stream',
                'entrance_exams' => ['CUET'],
                'skills' => ['Creative Writing', 'Storytelling', 'Dialogue Writing', 'Game Logic', 'World Building', 'Character Development'],
                'job_opportunities' => ['Game Studios', 'Interactive Media Companies', 'AR/VR Companies', 'EdTech Gaming Firms'],
                'image' => 'images/careers/creative-design-media/game-writer.svg'
            ],
            [
                'slug' => 'set-designer',
                'name' => 'Set Designer',
                'sub_domain' => 'Film, Theatre & Production Design',
                'description' => 'Set Designers create physical or digital sets for films, television, theatre, advertisements, events, and web series.',
                'salary_range' => '₹3L – ₹15L',
                'demand_level' => 'Moderate',
                'qualification' => 'Degree / Diploma in Set Design, Production Design, Interior Design, or Fine Arts',
                'stream' => 'Arts / Design / Any Stream',
                'entrance_exams' => ['NID DAT', 'UCEED', 'FTII Entrance Exam'],
                'skills' => ['Spatial Design', 'Sketching', 'Material Knowledge', 'Art Direction', 'Creativity', 'Team Coordination'],
                'job_opportunities' => ['Film Studios', 'TV Channels', 'Theatre Groups', 'Event Companies', 'Advertising Agencies'],
                'image' => 'images/careers/creative-design-media/set-designer.svg'
            ],
            [
                'slug' => 'costume-designer',
                'name' => 'Costume Designer',
                'sub_domain' => 'Film, Theatre & Production Design',
                'description' => 'Costume Designers plan and create costumes for films, theatre, television, fashion shows, advertisements, and cultural performances.',
                'salary_range' => '₹3L – ₹15L',
                'demand_level' => 'Moderate',
                'qualification' => 'Diploma / Degree in Fashion Design, Costume Design, or Textile Design',
                'stream' => 'Arts / Design / Any Stream',
                'entrance_exams' => ['NIFT', 'NID DAT', 'UCEED', 'CUET'],
                'skills' => ['Fashion Styling', 'Fabric Knowledge', 'Character Study', 'Sketching', 'Color Sense', 'Creativity'],
                'job_opportunities' => ['Film Industry', 'Theatre Groups', 'Fashion Houses', 'TV Channels', 'OTT Platforms'],
                'image' => 'images/careers/creative-design-media/costume-designer.svg'
            ],
            [
                'slug' => 'makeup-artist',
                'name' => 'Makeup Artist',
                'sub_domain' => 'Fashion, Beauty & Body Art',
                'description' => 'Makeup Artists apply professional makeup for weddings, films, fashion shows, photoshoots, theatre, television, and special effects.',
                'salary_range' => '₹2L – ₹12L+',
                'demand_level' => 'High',
                'qualification' => 'Professional Makeup Course / Diploma in Cosmetology or Beauty Arts',
                'stream' => 'Any Stream',
                'entrance_exams' => ['Portfolio Review'],
                'skills' => ['Bridal Makeup', 'Fashion Makeup', 'SFX Makeup', 'Skin Tone Knowledge', 'Creativity', 'Client Handling'],
                'job_opportunities' => ['Salons', 'Film Industry', 'Fashion Industry', 'Beauty Brands', 'Wedding Industry'],
                'image' => 'images/careers/creative-design-media/makeup-artist.svg'
            ],
            [
                'slug' => 'tattoo-artist',
                'name' => 'Tattoo Artist',
                'sub_domain' => 'Fashion, Beauty & Body Art',
                'description' => 'Tattoo Artists create permanent body art designs using tattoo machines, hygiene practices, custom illustrations, and client consultation.',
                'salary_range' => '₹2L – ₹15L+',
                'demand_level' => 'Moderate',
                'qualification' => 'Tattoo Art Training / Fine Arts Background / Apprenticeship',
                'stream' => 'Arts / Any Stream',
                'entrance_exams' => ['Portfolio Required'],
                'skills' => ['Drawing', 'Line Art', 'Shading', 'Hygiene Safety', 'Skin Knowledge', 'Client Communication'],
                'job_opportunities' => ['Tattoo Studios', 'Beauty Studios', 'Independent Studios', 'Creative Art Businesses'],
                'image' => 'images/careers/creative-design-media/tattoo-artist.svg'
            ],
            [
                'slug' => 'jewellery-designer',
                'name' => 'Jewellery Designer',
                'sub_domain' => 'Fashion, Beauty & Body Art',
                'description' => 'Jewellery Designers create ornaments and accessories using sketching, CAD tools, gemstones, metals, trends, and market requirements.',
                'salary_range' => '₹3L – ₹15L',
                'demand_level' => 'High',
                'qualification' => 'Diploma / Degree in Jewellery Design, Fashion Design, or Accessory Design',
                'stream' => 'Arts / Design / Commerce / Any Stream',
                'entrance_exams' => ['NIFT', 'NID DAT', 'UCEED', 'CUET'],
                'skills' => ['Sketching', 'CAD Jewellery Design', 'Gemstone Knowledge', 'Trend Analysis', 'Creativity', 'Detailing'],
                'job_opportunities' => ['Jewellery Brands', 'Export Houses', 'Luxury Brands', 'Design Studios', 'E-commerce Brands'],
                'image' => 'images/careers/creative-design-media/jewellery-designer.svg'
            ],
            [
                'slug' => 'interior-designer',
                'name' => 'Interior Designer',
                'sub_domain' => 'Interior, Exhibition & Cultural Design',
                'description' => 'Interior Designers plan and design indoor spaces such as homes, offices, hotels, showrooms, restaurants, and commercial spaces.',
                'salary_range' => '₹3L – ₹15L+',
                'demand_level' => 'High',
                'qualification' => 'Diploma / B.Des / B.Sc in Interior Design or Architecture-related Field',
                'stream' => 'Arts / Design / Science / Any Stream',
                'entrance_exams' => ['NID DAT', 'UCEED', 'NATA', 'CUET'],
                'skills' => ['Space Planning', 'AutoCAD', 'SketchUp', 'Material Knowledge', 'Color Theory', 'Client Handling'],
                'job_opportunities' => ['Interior Design Firms', 'Architecture Firms', 'Real Estate Companies', 'Furniture Brands'],
                'image' => 'images/careers/creative-design-media/interior-designer.svg'
            ],
            [
                'slug' => 'exhibition-designer',
                'name' => 'Exhibition Designer',
                'sub_domain' => 'Interior, Exhibition & Cultural Design',
                'description' => 'Exhibition Designers create temporary and permanent display spaces for trade fairs, museums, galleries, expos, events, and brand promotions.',
                'salary_range' => '₹3L – ₹12L',
                'demand_level' => 'Moderate',
                'qualification' => 'Degree / Diploma in Exhibition Design, Interior Design, Spatial Design, or Visual Communication',
                'stream' => 'Arts / Design / Any Stream',
                'entrance_exams' => ['NID DAT', 'UCEED', 'CUET'],
                'skills' => ['Spatial Design', 'Display Planning', '3D Visualization', 'Branding', 'Material Knowledge', 'Project Coordination'],
                'job_opportunities' => ['Event Companies', 'Museums', 'Trade Fair Organizers', 'Design Studios', 'Advertising Agencies'],
                'image' => 'images/careers/creative-design-media/exhibition-designer.svg'
            ],
            [
                'slug' => 'museum-curator',
                'name' => 'Museum Curator',
                'sub_domain' => 'Interior, Exhibition & Cultural Design',
                'description' => 'Museum Curators manage collections, exhibitions, historical objects, artworks, research materials, and educational displays in museums and galleries.',
                'salary_range' => '₹3L – ₹12L',
                'demand_level' => 'Moderate',
                'qualification' => 'BA / MA in History, Archaeology, Museology, Fine Arts, or Cultural Studies',
                'stream' => 'Arts / Humanities',
                'entrance_exams' => ['CUET', 'University Entrance Exams', 'Museology Entrance Exams'],
                'skills' => ['Research', 'Collection Management', 'Documentation', 'Exhibition Planning', 'Art History', 'Communication'],
                'job_opportunities' => ['Museums', 'Art Galleries', 'Cultural Institutions', 'Heritage Centres', 'Government Departments'],
                'image' => 'images/careers/creative-design-media/museum-curator.svg'
            ],
            [
                'slug' => 'art-therapist',
                'name' => 'Art Therapist',
                'sub_domain' => 'Art Therapy & Creative Wellness',
                'description' => 'Art Therapists use creative art activities to support emotional expression, mental wellness, rehabilitation, and personal development.',
                'salary_range' => '₹3L – ₹10L',
                'demand_level' => 'Moderate',
                'qualification' => 'Psychology / Fine Arts Degree + Art Therapy Certification or Master’s in Art Therapy',
                'stream' => 'Arts / Psychology / Any Stream',
                'entrance_exams' => ['CUET', 'University Psychology Entrance Exams'],
                'skills' => ['Counseling Basics', 'Creative Expression', 'Empathy', 'Observation', 'Communication', 'Therapeutic Planning'],
                'job_opportunities' => ['Hospitals', 'Mental Health Centres', 'Schools', 'Rehabilitation Centres', 'NGOs'],
                'image' => 'images/careers/creative-design-media/art-therapist.svg'
            ]
        ];

        $futureScopeCommon = "Creative, Design & Media careers have immense future potential as industries increasingly rely on visual storytelling, digital experience, branding, and creative wellness in a highly connected world.";

        foreach ($careers as $careerData) {
            $roadmap = [
                "Step 1: Complete 10+2 in any stream (Arts/Design preferred for some roles).",
                "Step 2: Pursue a relevant degree or diploma (B.Des/BFA/Certification) in " . $careerData['name'] . ".",
                "Step 3: Build a strong portfolio showcasing your creative projects and style.",
                "Step 4: Learn essential industry tools (Adobe Suite, Blender, Maya, etc.) as per your specialization.",
                "Step 5: Gain experience through internships, freelance projects, or junior positions in studios/agencies.",
                "Step 6: Advance to senior roles, lead creative teams, or start your own creative studio."
            ];

            Career::updateOrCreate(
                ['slug' => $careerData['slug']],
                array_merge($careerData, [
                    'field_id' => $field->id,
                    'roadmap' => $roadmap,
                    'future_scope' => $futureScopeCommon . "\n\nNote: The creative industry values portfolios and practical skills as much as formal qualifications."
                ])
            );
        }

        $this->command->info('Creative, Design & Media careers seeded successfully.');
    }
}
