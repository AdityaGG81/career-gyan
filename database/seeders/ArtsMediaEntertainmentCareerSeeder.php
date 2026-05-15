<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Career;
use App\Models\Field;

class ArtsMediaEntertainmentCareerSeeder extends Seeder
{
    public function run(): void
    {
        $fieldSlug = 'arts-media-entertainment';
        $field = Field::where('slug', $fieldSlug)->first();

        if (!$field) {
            $this->command->error("Field '$fieldSlug' not found. Please run FieldsSeeder first.");
            return;
        }

        $careers = [
            [
                'slug' => 'animator',
                'name' => 'Animator',
                'sub_domain' => 'Animation, VFX & Digital Art',
                'description' => 'Animators create moving visuals, characters, scenes, and effects for films, games, advertisements, educational videos, and digital platforms.',
                'salary_range' => '₹3L – ₹12L',
                'demand_level' => 'High',
                'qualification' => 'Diploma / B.Sc / B.Des in Animation, Multimedia, or VFX',
                'stream' => 'Arts / Design / Any Stream',
                'entrance_exams' => ['NID DAT', 'UCEED', 'CUET', 'Institute Entrance Exams'],
                'skills' => ['2D Animation', '3D Animation', 'Storyboarding', 'Adobe Animate', 'Blender', 'Maya'],
                'job_opportunities' => ['Animation Studios', 'Game Studios', 'Film Studios', 'EdTech Companies', 'Advertising Agencies'],
                'image' => 'images/careers/arts-media-entertainment/animator.svg'
            ],
            [
                'slug' => 'archivist',
                'name' => 'Archivist',
                'sub_domain' => 'Archives, Museums & Art Business',
                'description' => 'Archivists preserve, organize, classify, and manage historical records, documents, photographs, manuscripts, and cultural materials.',
                'salary_range' => '₹3L – ₹10L',
                'demand_level' => 'Moderate',
                'qualification' => 'BA / MA in History, Library Science, Archival Studies, or Museology',
                'stream' => 'Arts / Humanities',
                'entrance_exams' => ['CUET', 'University Entrance Exams'],
                'skills' => ['Documentation', 'Preservation', 'Cataloguing', 'Digital Archiving', 'Research'],
                'job_opportunities' => ['Museums', 'Archives', 'Libraries', 'Universities', 'Government Departments'],
                'image' => 'images/careers/arts-media-entertainment/archivist.svg'
            ],
            [
                'slug' => 'art-dealer',
                'name' => 'Art Dealer',
                'sub_domain' => 'Archives, Museums & Art Business',
                'description' => 'Art Dealers buy, sell, promote, and manage artworks by connecting artists, collectors, galleries, and auction houses.',
                'salary_range' => '₹3L – ₹20L+',
                'demand_level' => 'Moderate',
                'qualification' => 'Fine Arts / Art History / Business background',
                'stream' => 'Arts / Commerce / Any Stream',
                'entrance_exams' => ['None'],
                'skills' => ['Art Knowledge', 'Sales', 'Negotiation', 'Networking', 'Market Research'],
                'job_opportunities' => ['Art Galleries', 'Auction Houses', 'Private Collectors', 'Museums'],
                'image' => 'images/careers/arts-media-entertainment/art-dealer.svg'
            ],
            [
                'slug' => 'art-director',
                'name' => 'Art Director',
                'sub_domain' => 'Advertising, Branding & Public Relations',
                'description' => 'Art Directors lead the visual style of advertisements, films, magazines, campaigns, and brand communication.',
                'salary_range' => '₹8L – ₹25L+',
                'demand_level' => 'High',
                'qualification' => 'BFA / B.Des / Graphic Design / Visual Communication',
                'stream' => 'Arts / Design / Any Stream',
                'entrance_exams' => ['NID DAT', 'UCEED', 'NIFT', 'CUET'],
                'skills' => ['Visual Direction', 'Branding', 'Layout Design', 'Leadership', 'Creative Software'],
                'job_opportunities' => ['Advertising Agencies', 'Design Studios', 'Film Studios', 'Media Houses', 'Brands'],
                'image' => 'images/careers/arts-media-entertainment/art-director.svg'
            ],
            [
                'slug' => 'artist',
                'name' => 'Artist',
                'sub_domain' => 'Fine Arts & Traditional Art',
                'description' => 'Artists create original paintings, drawings, sculptures, and creative works for exhibitions, galleries, and public spaces.',
                'salary_range' => '₹2L – ₹15L+',
                'demand_level' => 'Moderate',
                'qualification' => 'BFA / MFA / Fine Arts Diploma',
                'stream' => 'Arts / Any Stream',
                'entrance_exams' => ['CUET', 'State Fine Arts Entrance'],
                'skills' => ['Drawing', 'Painting', 'Creativity', 'Concept Development', 'Art Techniques'],
                'job_opportunities' => ['Art Galleries', 'Studios', 'Schools', 'Creative Agencies', 'Self-Employment'],
                'image' => 'images/careers/arts-media-entertainment/artist.svg'
            ],
            [
                'slug' => 'blogger',
                'name' => 'Blogger',
                'sub_domain' => 'Journalism, Writing & Publishing',
                'description' => 'Bloggers create written, visual, or multimedia content for websites on topics such as lifestyle, travel, technology, and careers.',
                'salary_range' => '₹1.5L – ₹12L+',
                'demand_level' => 'Moderate',
                'qualification' => 'Graduation with Writing & Digital Skills',
                'stream' => 'Any Stream',
                'entrance_exams' => ['None'],
                'skills' => ['Writing', 'SEO', 'Content Planning', 'WordPress', 'Audience Engagement'],
                'job_opportunities' => ['Personal Blogs', 'Media Websites', 'Brands', 'Digital Agencies'],
                'image' => 'images/careers/arts-media-entertainment/blogger.svg'
            ],
            [
                'slug' => 'brand-manager',
                'name' => 'Brand Manager',
                'sub_domain' => 'Advertising, Branding & Public Relations',
                'description' => 'Brand Managers plan brand strategy, campaigns, positioning, customer perception, and market communication.',
                'salary_range' => '₹6L – ₹25L+',
                'demand_level' => 'High',
                'qualification' => 'BBA / MBA Marketing / Mass Communication',
                'stream' => 'Commerce / Management / Arts',
                'entrance_exams' => ['CAT', 'MAT', 'CMAT', 'CUET'],
                'skills' => ['Branding', 'Marketing Strategy', 'Consumer Research', 'Campaign Planning', 'Data Analysis'],
                'job_opportunities' => ['FMCG Companies', 'Startups', 'Advertising Agencies', 'Retail Brands'],
                'image' => 'images/careers/arts-media-entertainment/brand-manager.svg'
            ],
            [
                'slug' => 'calligrapher',
                'name' => 'Calligrapher',
                'sub_domain' => 'Fine Arts & Traditional Art',
                'description' => 'Calligraphers create artistic lettering for invitations, branding, certificates, packaging, and decorative designs.',
                'salary_range' => '₹1.5L – ₹8L+',
                'demand_level' => 'Moderate',
                'qualification' => 'Calligraphy Course / Fine Arts Background',
                'stream' => 'Arts / Any Stream',
                'entrance_exams' => ['None'],
                'skills' => ['Hand Lettering', 'Typography', 'Ink Control', 'Design Sense', 'Patience'],
                'job_opportunities' => ['Wedding Industry', 'Design Studios', 'Event Companies', 'Stationery Brands'],
                'image' => 'images/careers/arts-media-entertainment/calligrapher.svg'
            ],
            [
                'slug' => 'cameraperson',
                'name' => 'Cameraperson',
                'sub_domain' => 'Film, Camera & Direction',
                'description' => 'Camerapersons operate cameras for films, news, television, documentaries, interviews, and digital content.',
                'salary_range' => '₹2.5L – ₹10L',
                'demand_level' => 'High',
                'qualification' => 'Diploma / Degree in Cinematography or Camera Operation',
                'stream' => 'Arts / Media / Any Stream',
                'entrance_exams' => ['FTII Entrance', 'SRFTI Entrance', 'CUET'],
                'skills' => ['Camera Operation', 'Framing', 'Lighting Basics', 'Focus Control', 'Equipment Handling'],
                'job_opportunities' => ['TV Channels', 'Film Studios', 'News Channels', 'Production Houses', 'YouTube Channels'],
                'image' => 'images/careers/arts-media-entertainment/cameraperson.svg'
            ],
            [
                'slug' => 'cartoonist',
                'name' => 'Cartoonist',
                'sub_domain' => 'Fine Arts & Traditional Art',
                'description' => 'Cartoonists create humorous, political, or story-based drawings for newspapers, magazines, comics, and social media.',
                'salary_range' => '₹2L – ₹10L',
                'demand_level' => 'Moderate',
                'qualification' => 'Fine Arts / Illustration / Graphic Design',
                'stream' => 'Arts / Design / Any Stream',
                'entrance_exams' => ['NID DAT', 'UCEED', 'CUET'],
                'skills' => ['Drawing', 'Visual Storytelling', 'Character Design', 'Digital Illustration', 'Humor'],
                'job_opportunities' => ['Newspapers', 'Magazines', 'Publishing Houses', 'Animation Studios', 'Digital Platforms'],
                'image' => 'images/careers/arts-media-entertainment/cartoonist.svg'
            ],
            [
                'slug' => 'choreographer',
                'name' => 'Choreographer',
                'sub_domain' => 'Dance, Theatre & Performing Arts',
                'description' => 'Choreographers design dance movements, stage performances, music video routines, and cultural events.',
                'salary_range' => '₹2L – ₹15L+',
                'demand_level' => 'Moderate',
                'qualification' => 'Dance Training / Performing Arts Degree',
                'stream' => 'Arts / Any Stream',
                'entrance_exams' => ['Performing Arts Auditions'],
                'skills' => ['Dance Technique', 'Creativity', 'Rhythm', 'Teaching', 'Stage Planning'],
                'job_opportunities' => ['Film Industry', 'Dance Academies', 'Event Companies', 'Schools', 'Theatre Groups'],
                'image' => 'images/careers/arts-media-entertainment/choreographer.svg'
            ],
            [
                'slug' => 'cinematographer',
                'name' => 'Cinematographer',
                'sub_domain' => 'Film, Camera & Direction',
                'description' => 'Cinematographers plan the visual look of films, web series, and advertisements through camera work and lighting.',
                'salary_range' => '₹4L – ₹25L+',
                'demand_level' => 'High',
                'qualification' => 'Diploma / Degree in Cinematography or Visual Communication',
                'stream' => 'Arts / Media / Any Stream',
                'entrance_exams' => ['FTII Entrance', 'SRFTI Entrance', 'CUET'],
                'skills' => ['Camera Framing', 'Lighting', 'Lens Selection', 'Visual Storytelling', 'Color Sense'],
                'job_opportunities' => ['Film Studios', 'OTT Productions', 'Advertising Films', 'Production Houses'],
                'image' => 'images/careers/arts-media-entertainment/cinematographer.svg'
            ],
            [
                'slug' => 'content-writer',
                'name' => 'Content Writer',
                'sub_domain' => 'Journalism, Writing & Publishing',
                'description' => 'Content Writers create articles, blogs, social media content, product descriptions, and scripts.',
                'salary_range' => '₹2.5L – ₹9L',
                'demand_level' => 'High',
                'qualification' => 'BA English / Mass Communication / Journalism',
                'stream' => 'Arts / Media / Any Stream',
                'entrance_exams' => ['CUET', 'Media Institute Entrance'],
                'skills' => ['Writing', 'SEO', 'Research', 'Editing', 'Content Planning'],
                'job_opportunities' => ['Digital Agencies', 'EdTech Companies', 'Media Websites', 'Startups'],
                'image' => 'images/careers/arts-media-entertainment/content-writer.svg'
            ],
            [
                'slug' => 'copywriter',
                'name' => 'Copywriter',
                'sub_domain' => 'Advertising, Branding & Public Relations',
                'description' => 'Copywriters write slogans, advertisements, brand messages, product campaigns, and promotional scripts.',
                'salary_range' => '₹3L – ₹12L',
                'demand_level' => 'High',
                'qualification' => 'Advertising / Mass Communication / Marketing Degree',
                'stream' => 'Arts / Commerce / Media',
                'entrance_exams' => ['CUET', 'Media Institute Entrance'],
                'skills' => ['Creative Writing', 'Brand Communication', 'Campaign Ideas', 'Storytelling', 'Grammar'],
                'job_opportunities' => ['Advertising Agencies', 'Digital Agencies', 'Brands', 'Startups'],
                'image' => 'images/careers/arts-media-entertainment/copywriter.svg'
            ],
            [
                'slug' => 'dancer',
                'name' => 'Dancer',
                'sub_domain' => 'Dance, Theatre & Performing Arts',
                'description' => 'Dancers perform in stage shows, films, music videos, cultural events, and digital entertainment.',
                'salary_range' => '₹1.5L – ₹12L+',
                'demand_level' => 'Moderate',
                'qualification' => 'Dance Training / Performing Arts Degree',
                'stream' => 'Arts / Any Stream',
                'entrance_exams' => ['Performing Arts Auditions'],
                'skills' => ['Dance Technique', 'Fitness', 'Rhythm', 'Expression', 'Stage Presence'],
                'job_opportunities' => ['Dance Companies', 'Film Industry', 'Event Companies', 'Cultural Groups'],
                'image' => 'images/careers/arts-media-entertainment/dancer.svg'
            ],
            [
                'slug' => 'digital-marketing-expert',
                'name' => 'Digital Marketing Expert',
                'sub_domain' => 'Digital Marketing & Social Media',
                'description' => 'Digital Marketing Experts promote brands online using SEO, social media, paid ads, and analytics.',
                'salary_range' => '₹3L – ₹15L',
                'demand_level' => 'Very High',
                'qualification' => 'Graduation + Digital Marketing Certification',
                'stream' => 'Commerce / Arts / Management',
                'entrance_exams' => ['None'],
                'skills' => ['SEO', 'Google Ads', 'Social Media Marketing', 'Analytics', 'Content Strategy'],
                'job_opportunities' => ['Digital Agencies', 'E-commerce Companies', 'Startups', 'IT Companies', 'Brands'],
                'image' => 'images/careers/arts-media-entertainment/digital-marketing-expert.svg'
            ],
            [
                'slug' => 'film-director',
                'name' => 'Film Director',
                'sub_domain' => 'Film, Camera & Direction',
                'description' => 'Film Directors guide actors, scripts, and creative decisions to bring a film or video story to life.',
                'salary_range' => '₹5L – ₹30L+',
                'demand_level' => 'Moderate',
                'qualification' => 'Film Direction Course / Mass Media / Theatre background',
                'stream' => 'Arts / Media / Any Stream',
                'entrance_exams' => ['FTII Entrance', 'SRFTI Entrance', 'Private Film Entrance'],
                'skills' => ['Storytelling', 'Direction', 'Leadership', 'Visual Planning', 'Actor Handling'],
                'job_opportunities' => ['Film Industry', 'OTT Platforms', 'Production Houses', 'Advertising Films'],
                'image' => 'images/careers/arts-media-entertainment/film-director.svg'
            ],
            [
                'slug' => 'journalist',
                'name' => 'Journalist',
                'sub_domain' => 'Journalism, Writing & Publishing',
                'description' => 'Journalists research, report, write, and present news stories for newspapers, TV channels, and digital platforms.',
                'salary_range' => '₹3L – ₹12L',
                'demand_level' => 'High',
                'qualification' => 'BJMC / BA Journalism / Mass Communication',
                'stream' => 'Arts / Media / Any Stream',
                'entrance_exams' => ['CUET', 'IIMC Entrance', 'Media Institute Entrance'],
                'skills' => ['Reporting', 'Research', 'Writing', 'News Sense', 'Communication'],
                'job_opportunities' => ['Newspapers', 'TV Channels', 'Digital News Platforms', 'Magazines'],
                'image' => 'images/careers/arts-media-entertainment/journalist.svg'
            ],
            [
                'slug' => 'photographer',
                'name' => 'Photographer',
                'sub_domain' => 'Photography & Visual Media',
                'description' => 'Photographers capture professional images for weddings, products, fashion, journalism, and advertising.',
                'salary_range' => '₹2L – ₹15L+',
                'demand_level' => 'High',
                'qualification' => 'Photography Course / Diploma / Visual Arts Background',
                'stream' => 'Any Stream',
                'entrance_exams' => ['None'],
                'skills' => ['Camera Handling', 'Lighting', 'Composition', 'Editing', 'Creativity'],
                'job_opportunities' => ['Media Houses', 'Wedding Industry', 'Fashion Brands', 'Advertising Agencies'],
                'image' => 'images/careers/arts-media-entertainment/photographer.svg'
            ],
            [
                'slug' => 'public-relations-officer',
                'name' => 'Public Relations Officer',
                'sub_domain' => 'Advertising, Branding & Public Relations',
                'description' => 'Public Relations Officers manage public image, press communication, and reputation of organizations.',
                'salary_range' => '₹4L – ₹15L',
                'demand_level' => 'High',
                'qualification' => 'Mass Communication / PR / Advertising / Journalism',
                'stream' => 'Arts / Commerce / Media / Management',
                'entrance_exams' => ['CUET', 'IIMC Entrance'],
                'skills' => ['Communication', 'Media Relations', 'Press Release Writing', 'Crisis Handling', 'Networking'],
                'job_opportunities' => ['Corporates', 'PR Agencies', 'NGOs', 'Government Departments'],
                'image' => 'images/careers/arts-media-entertainment/public-relations-officer.svg'
            ],
            [
                'slug' => 'radio-jockey',
                'name' => 'Radio Jockey',
                'sub_domain' => 'Radio, Audio & Broadcast Media',
                'description' => 'Radio Jockeys host radio shows, present music, conduct interviews, and create entertaining audio content.',
                'salary_range' => '₹2L – ₹12L+',
                'demand_level' => 'Moderate',
                'qualification' => 'Mass Communication / RJ Course / Voice Training',
                'stream' => 'Arts / Media / Any Stream',
                'entrance_exams' => ['Auditions'],
                'skills' => ['Voice Modulation', 'Communication', 'Humor', 'Audience Engagement', 'Interviewing'],
                'job_opportunities' => ['FM Radio Stations', 'Online Radio', 'Podcasts', 'Audio Platforms'],
                'image' => 'images/careers/arts-media-entertainment/radio-jockey.svg'
            ],
            [
                'slug' => 'screenwriter',
                'name' => 'Screenwriter',
                'sub_domain' => 'Film, Camera & Direction',
                'description' => 'Screenwriters write scripts, dialogues, scenes, and story structures for films, web series, and TV shows.',
                'salary_range' => '₹3L – ₹18L+',
                'demand_level' => 'Moderate',
                'qualification' => 'Creative Writing / Film Writing / Mass Media',
                'stream' => 'Arts / Media / Any Stream',
                'entrance_exams' => ['FTII Entrance', 'SRFTI Entrance'],
                'skills' => ['Storytelling', 'Dialogue Writing', 'Character Development', 'Script Formatting'],
                'job_opportunities' => ['Film Studios', 'OTT Platforms', 'TV Channels', 'Production Houses'],
                'image' => 'images/careers/arts-media-entertainment/screenwriter.svg'
            ],
            [
                'slug' => 'social-media-manager',
                'name' => 'Social Media Manager',
                'sub_domain' => 'Digital Marketing & Social Media',
                'description' => 'Social Media Managers plan, create, and analyze content for platforms like Instagram, YouTube, and LinkedIn.',
                'salary_range' => '₹3L – ₹12L',
                'demand_level' => 'Very High',
                'qualification' => 'Graduation + Digital Marketing / Social Media Certification',
                'stream' => 'Any Stream',
                'entrance_exams' => ['None'],
                'skills' => ['Content Planning', 'Copywriting', 'Analytics', 'Trend Research', 'Community Management'],
                'job_opportunities' => ['Digital Agencies', 'Startups', 'Brands', 'Influencers', 'Media Houses'],
                'image' => 'images/careers/arts-media-entertainment/social-media-manager.svg'
            ],
            [
                'slug' => 'theatre-artist',
                'name' => 'Theatre Artist',
                'sub_domain' => 'Dance, Theatre & Performing Arts',
                'description' => 'Theatre Artists perform in stage plays, dramas, street plays, and live performance productions.',
                'salary_range' => '₹1.5L – ₹10L+',
                'demand_level' => 'Moderate',
                'qualification' => 'Theatre Training / Performing Arts Degree',
                'stream' => 'Arts / Any Stream',
                'entrance_exams' => ['NSD Entrance', 'University Theatre Admissions'],
                'skills' => ['Acting', 'Voice Control', 'Expression', 'Stage Presence', 'Improvisation'],
                'job_opportunities' => ['Theatre Groups', 'Film Industry', 'Acting Schools', 'Cultural Organizations'],
                'image' => 'images/careers/arts-media-entertainment/theatre-artist.svg'
            ],
            [
                'slug' => 'vfx-editor',
                'name' => 'VFX Editor',
                'sub_domain' => 'Animation, VFX & Digital Art',
                'description' => 'VFX Editors combine visual effects, CGI, and edited footage to create realistic screen visuals.',
                'salary_range' => '₹3L – ₹15L',
                'demand_level' => 'High',
                'qualification' => 'Diploma / Degree in VFX, Animation, or Multimedia',
                'stream' => 'Arts / Design / Any Stream',
                'entrance_exams' => ['FTII Entrance', 'SRFTI Entrance', 'NID DAT'],
                'skills' => ['Compositing', 'After Effects', 'Nuke', 'Color Matching', 'Visual Storytelling'],
                'job_opportunities' => ['VFX Studios', 'Film Studios', 'OTT Platforms', 'Advertising Agencies'],
                'image' => 'images/careers/arts-media-entertainment/vfx-editor.svg'
            ]
        ];

        $futureScopeCommon = "The Arts, Media & Entertainment industry is witnessing explosive growth due to digital platforms, OTT services, and global demand for high-quality creative content.";

        foreach ($careers as $careerData) {
            $roadmap = [
                "Step 1: Explore your creative interest (Writing, Acting, Design, Photography) during schooling.",
                "Step 2: Pursue a specialized Bachelor's degree (BFA, B.Des, BA Journalism, Performing Arts).",
                "Step 3: Build a strong digital portfolio showcasing your best creative work.",
                "Step 4: Gain hands-on experience through internships in studios, agencies, or media houses.",
                "Step 5: Master industry-standard tools (Adobe Creative Suite, Final Cut Pro, Maya, Nuke).",
                "Step 6: Network with industry professionals and start as a freelancer or junior creative professional."
            ];

            Career::updateOrCreate(
                ['slug' => $careerData['slug']],
                array_merge($careerData, [
                    'field_id' => $field->id,
                    'roadmap' => $roadmap,
                    'future_scope' => $futureScopeCommon . "\n\nNote: Creativity paired with technical skills (VFX, SEO, Digital Design) is the most sought-after combination in the current market."
                ])
            );
        }

        $this->command->info('Arts, Media & Entertainment careers seeded successfully.');
    }
}
