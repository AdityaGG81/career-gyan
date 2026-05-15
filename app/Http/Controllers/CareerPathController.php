<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Field;
use App\Models\Career;

class CareerPathController extends Controller
{
    /**
     * Display the specified career path stream.
     *
     * @param  string  $stream
     * @return \Illuminate\View\View
     */
    public function show($stream)
    {
        if ($stream === 'medical') {
            $field = Field::where('slug', 'medical')->firstOrFail();
            $careers = Career::where('field_id', $field->id)->orderBy('name')->paginate(15);
            return view('career_paths.medical', compact('field', 'careers'));
        }

        if ($stream === 'business') {
            $field = Field::where('slug', 'business')->firstOrFail();
            $careers = Career::where('field_id', $field->id)->orderBy('name')->paginate(15);
            return view('career_paths.business', compact('field', 'careers'));
        }

        if ($stream === 'skill-development') {
            $field = Field::where('slug', 'skill-development')->firstOrFail();
            $careers = Career::where('field_id', $field->id)->orderBy('name')->paginate(15);
            return view('career_paths.skill-development', compact('field', 'careers'));
        }

        if ($stream === 'sports') {
            $field = Field::where('slug', 'sports')->firstOrFail();
            $careers = Career::where('field_id', $field->id)->orderBy('name')->paginate(15);
            return view('career_paths.sports', compact('field', 'careers'));
        }

        if ($stream === 'gaming-esports') {
            $field = Field::where('slug', 'gaming-careers')->firstOrFail();
            $careers = Career::where('field_id', $field->id)
                ->orderBy('name')
                ->limit(50)
                ->get();
            return view('career_paths.gaming-esports', compact('field', 'careers'));
        }

        $dynamicStreams = [
            'agriculture' => [
                'title' => 'Agriculture & Allied Sciences',
                'description' => 'Explore careers in modern farming, agribusiness, food technology, and sustainable agriculture.',
                'theme' => [
                    'primary' => '#10b981',
                    'secondary' => '#34d399',
                    'gradient' => 'linear-gradient(135deg, #064e3b 0%, #047857 40%, #10b981 75%, #34d399 100%)',
                    'button_gradient' => 'linear-gradient(to right, #059669, #10b981)'
                ],
                'stats' => [
                    ['value' => '10+', 'label' => 'Agri Sectors'],
                    ['value' => '500+', 'label' => 'Colleges'],
                    ['value' => '100%', 'label' => 'Demand Growth'],
                ]
            ],
            'small-scale' => [
                'title' => 'Small Scale Businesses',
                'description' => 'Start your entrepreneurial journey. Explore low-investment, high-return business opportunities.',
                'theme' => [
                    'primary' => '#f59e0b',
                    'secondary' => '#fbbf24',
                    'gradient' => 'linear-gradient(135deg, #78350f 0%, #b45309 40%, #d97706 75%, #f59e0b 100%)',
                    'button_gradient' => 'linear-gradient(to right, #d97706, #f59e0b)'
                ],
                'stats' => [
                    ['value' => '15+', 'label' => 'Sectors'],
                    ['value' => 'Low', 'label' => 'Investment'],
                    ['value' => 'High', 'label' => 'Growth Potential'],
                ]
            ],
            'government-defence' => [
                'title' => 'Government & Defence',
                'description' => 'Serve the nation with pride. Explore prestigious careers in civil services, defence forces, and public sector.',
                'theme' => [
                    'primary' => '#3b82f6',
                    'secondary' => '#60a5fa',
                    'gradient' => 'linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 40%, #2563eb 75%, #3b82f6 100%)',
                    'button_gradient' => 'linear-gradient(to right, #2563eb, #3b82f6)'
                ],
                'stats' => [
                    ['value' => '3+', 'label' => 'Core Forces'],
                    ['value' => '100+', 'label' => 'Exams'],
                    ['value' => 'High', 'label' => 'Job Security'],
                ]
            ],
            'teaching-law' => [
                'title' => 'Teaching & Law',
                'description' => 'Shape minds or fight for justice. Explore rewarding careers in education, legal services, and judiciary.',
                'theme' => [
                    'primary' => '#8b5cf6',
                    'secondary' => '#a78bfa',
                    'gradient' => 'linear-gradient(135deg, #4c1d95 0%, #6d28d9 40%, #7c3aed 75%, #8b5cf6 100%)',
                    'button_gradient' => 'linear-gradient(to right, #7c3aed, #8b5cf6)'
                ],
                'stats' => [
                    ['value' => '2+', 'label' => 'Core Fields'],
                    ['value' => '500+', 'label' => 'Institutions'],
                    ['value' => 'High', 'label' => 'Social Impact'],
                ]
            ],
            'modern-tech' => [
                'title' => 'Modern Tech & AI',
                'description' => 'Build the future. Explore cutting-edge careers in Artificial Intelligence, Data Science, and Software Development.',
                'theme' => [
                    'primary' => '#06b6d4',
                    'secondary' => '#22d3ee',
                    'gradient' => 'linear-gradient(135deg, #164e63 0%, #0e7490 40%, #0891b2 75%, #06b6d4 100%)',
                    'button_gradient' => 'linear-gradient(to right, #0891b2, #06b6d4)'
                ],
                'stats' => [
                    ['value' => '10+', 'label' => 'Tech Stacks'],
                    ['value' => '200%', 'label' => 'Growth Rate'],
                    ['value' => 'Global', 'label' => 'Opportunities'],
                ]
            ],
            'it-digital-technology' => [
                'db_slug' => 'it-digital-technology',
                'title' => 'IT & Digital Technology',
                'description' => 'Discover the vast world of software, AI, cloud computing, and cyber security.',
                'theme' => [
                    'primary' => '#0ea5e9', // sky-500
                    'secondary' => '#38bdf8', // sky-400
                    'gradient' => 'linear-gradient(135deg, #0f172a 0%, #1e40af 40%, #0284c7 75%, #0ea5e9 100%)',
                    'button_gradient' => 'linear-gradient(to right, #0284c7, #0ea5e9)'
                ],
                'stats' => [
                    ['value' => '35+', 'label' => 'Roles'],
                    ['value' => 'High', 'label' => 'Demand'],
                    ['value' => 'Global', 'label' => 'Scope'],
                ]
            ],
            'healthcare-allied-medical' => [
                'db_slug' => 'healthcare-allied-medical',
                'title' => 'Healthcare & Allied Medical',
                'description' => 'Save lives and support health. Explore rewarding careers in medical specialization, diagnostics, nursing, and therapy.',
                'theme' => [
                    'primary' => '#ef4444', // red-500
                    'secondary' => '#f87171', // red-400
                    'gradient' => 'linear-gradient(135deg, #450a0a 0%, #991b1b 40%, #dc2626 75%, #ef4444 100%)',
                    'button_gradient' => 'linear-gradient(to right, #dc2626, #ef4444)'
                ],
                'stats' => [
                    ['value' => '30+', 'label' => 'Roles'],
                    ['value' => 'Critical', 'label' => 'Demand'],
                    ['value' => 'Stable', 'label' => 'Growth'],
                ]
            ],
            'agriculture-food-environment' => [
                'db_slug' => 'agriculture-food-environment',
                'title' => 'Agriculture, Food & Environment',
                'description' => 'Drive sustainability and food security. Explore diverse careers in modern farming, agribusiness, food technology, and environmental conservation.',
                'theme' => [
                    'primary' => '#059669', // emerald-600
                    'secondary' => '#10b981', // emerald-500
                    'gradient' => 'linear-gradient(135deg, #064e3b 0%, #065f46 40%, #059669 75%, #10b981 100%)',
                    'button_gradient' => 'linear-gradient(to right, #059669, #10b981)'
                ],
                'stats' => [
                    ['value' => '25+', 'label' => 'New Roles'],
                    ['value' => 'High', 'label' => 'Impact'],
                    ['value' => 'Evergreen', 'label' => 'Demand'],
                ]
            ],
            'creative-design-media' => [
                'db_slug' => 'creative-design-media',
                'title' => 'Creative, Design & Media',
                'description' => 'Unleash your imagination. Explore careers in visual design, animation, film production, advertising, and creative arts.',
                'theme' => [
                    'primary' => '#d946ef', // fuchsia-500
                    'secondary' => '#c026d3', // fuchsia-600
                    'gradient' => 'linear-gradient(135deg, #701a75 0%, #a21caf 40%, #d946ef 75%, #f0abfc 100%)',
                    'button_gradient' => 'linear-gradient(to right, #d946ef, #c026d3)'
                ],
                'stats' => [
                    ['value' => '25+', 'label' => 'Creative Roles'],
                    ['value' => 'Global', 'label' => 'Opportunity'],
                    ['value' => 'Growing', 'label' => 'Industry'],
                ]
            ],
            'hospitality-aviation-tourism-logistics' => [
                'db_slug' => 'hospitality-aviation-tourism-logistics',
                'title' => 'Hospitality, Aviation, Tourism & Logistics',
                'description' => 'Connect the world. Explore careers in luxury hospitality, aviation operations, global tourism, and supply chain logistics.',
                'theme' => [
                    'primary' => '#0ea5e9', // sky-500
                    'secondary' => '#0284c7', // sky-600
                    'gradient' => 'linear-gradient(135deg, #0c4a6e 0%, #075985 40%, #0ea5e9 75%, #7dd3fc 100%)',
                    'button_gradient' => 'linear-gradient(to right, #0ea5e9, #0284c7)'
                ],
                'stats' => [
                    ['value' => '25+', 'label' => 'Key Roles'],
                    ['value' => 'Worldwide', 'label' => 'Reach'],
                    ['value' => 'High', 'label' => 'Demand'],
                ]
            ],
            'education-social-law-policy' => [
                'db_slug' => 'education-social-law-policy',
                'title' => 'Education, Social, Law & Policy',
                'description' => 'Shape the future. Explore careers in teaching, social impact, legal advocacy, and public policy governance.',
                'theme' => [
                    'primary' => '#4f46e5', // indigo-600
                    'secondary' => '#4338ca', // indigo-700
                    'gradient' => 'linear-gradient(135deg, #312e81 0%, #3730a3 40%, #4f46e5 75%, #818cf8 100%)',
                    'button_gradient' => 'linear-gradient(to right, #4f46e5, #4338ca)'
                ],
                'stats' => [
                    ['value' => '25+', 'label' => 'Impact Roles'],
                    ['value' => 'High', 'label' => 'Social Value'],
                    ['value' => 'Steady', 'label' => 'Growth'],
                ]
            ],
            'skill-trades-manufacturing-retail' => [
                'db_slug' => 'skill-trades-manufacturing-retail',
                'title' => 'Skill Trades, Manufacturing & Retail',
                'description' => 'Master a craft. Explore careers in technical trades, industrial manufacturing, and modern retail management.',
                'theme' => [
                    'primary' => '#ea580c', // orange-600
                    'secondary' => '#c2410c', // orange-700
                    'gradient' => 'linear-gradient(135deg, #7c2d12 0%, #9a3412 40%, #ea580c 75%, #fb923c 100%)',
                    'button_gradient' => 'linear-gradient(to right, #ea580c, #c2410c)'
                ],
                'stats' => [
                    ['value' => '33+', 'label' => 'Trades'],
                    ['value' => 'High', 'label' => 'Demand'],
                    ['value' => 'Essential', 'label' => 'Sector'],
                ]
            ],
            'agriculture-allied-sciences' => [
                'db_slug' => 'agriculture-allied-sciences',
                'title' => 'Agriculture & Allied Sciences',
                'description' => 'Nurture the earth. Explore careers in crop science, livestock health, fisheries, and sustainable agri-business.',
                'theme' => [
                    'primary' => '#15803d', // green-700
                    'secondary' => '#166534', // green-800
                    'gradient' => 'linear-gradient(135deg, #064e3b 0%, #065f46 40%, #15803d 75%, #22c55e 100%)',
                    'button_gradient' => 'linear-gradient(to right, #15803d, #166534)'
                ],
                'stats' => [
                    ['value' => '14+', 'label' => 'Expert Roles'],
                    ['value' => 'Very High', 'label' => 'Necessity'],
                    ['value' => 'Growing', 'label' => 'AgriTech'],
                ]
            ],
            'arts-media-entertainment' => [
                'db_slug' => 'arts-media-entertainment',
                'title' => 'Arts, Media & Entertainment',
                'description' => 'Unleash your creativity. Explore careers in digital arts, filmmaking, journalism, and performing arts.',
                'theme' => [
                    'primary' => '#f43f5e', // rose-500
                    'secondary' => '#e11d48', // rose-600
                    'gradient' => 'linear-gradient(135deg, #881337 0%, #9f1239 40%, #f43f5e 75%, #fb7185 100%)',
                    'button_gradient' => 'linear-gradient(to right, #f43f5e, #e11d48)'
                ],
                'stats' => [
                    ['value' => '25+', 'label' => 'Creative Roles'],
                    ['value' => 'High', 'label' => 'Demand'],
                    ['value' => 'Global', 'label' => 'Reach'],
                ]
            ],
            'creative-careers' => [
                'title' => 'Creative Careers',
                'description' => 'Unleash your imagination. Explore careers in design, writing, performing arts, and media.',
                'theme' => [
                    'primary' => '#ec4899',
                    'secondary' => '#f472b6',
                    'gradient' => 'linear-gradient(135deg, #831843 0%, #be185d 40%, #db2777 75%, #ec4899 100%)',
                    'button_gradient' => 'linear-gradient(to right, #db2777, #ec4899)'
                ],
                'stats' => [
                    ['value' => '12+', 'label' => 'Creative Fields'],
                    ['value' => 'High', 'label' => 'Freelance Scope'],
                    ['value' => 'Global', 'label' => 'Demand'],
                ]
            ],
            'social-media' => [
                'title' => 'Social Media & Content',
                'description' => 'Engage the world. Explore dynamic careers in digital marketing, content creation, and brand management.',
                'theme' => [
                    'primary' => '#f43f5e',
                    'secondary' => '#fb7185',
                    'gradient' => 'linear-gradient(135deg, #881337 0%, #be123c 40%, #e11d48 75%, #f43f5e 100%)',
                    'button_gradient' => 'linear-gradient(to right, #e11d48, #f43f5e)'
                ],
                'stats' => [
                    ['value' => '5+', 'label' => 'Platforms'],
                    ['value' => 'High', 'label' => 'Remote Scope'],
                    ['value' => 'Booming', 'label' => 'Industry'],
                ]
            ],
            'gaming-esports' => [
                'db_slug' => 'gaming-careers',
                'title' => 'Gaming & E-sports',
                'description' => 'Turn your hobby into a profession. Explore careers in game development, competitive gaming, and streaming.',
                'theme' => [
                    'primary' => '#9333ea',
                    'secondary' => '#a855f7',
                    'gradient' => 'linear-gradient(135deg, #3b0764 0%, #6b21a8 40%, #7e22ce 75%, #9333ea 100%)',
                    'button_gradient' => 'linear-gradient(to right, #7e22ce, #9333ea)'
                ],
                'stats' => [
                    ['value' => '4+', 'label' => 'Core Areas'],
                    ['value' => 'Global', 'label' => 'Tournaments'],
                    ['value' => '300%', 'label' => 'Market Growth'],
                ]
            ],
            'freelancing-remote' => [
                'db_slug' => 'freelancing',
                'title' => 'Freelancing & Remote Work',
                'description' => 'Work from anywhere. Explore top independent and remote career paths across various industries.',
                'theme' => [
                    'primary' => '#14b8a6', // teal-500
                    'secondary' => '#2dd4bf', // teal-400
                    'gradient' => 'linear-gradient(135deg, #042f2e 0%, #0f766e 40%, #0d9488 75%, #14b8a6 100%)',
                    'button_gradient' => 'linear-gradient(to right, #0d9488, #14b8a6)'
                ],
                'stats' => [
                    ['value' => '20+', 'label' => 'Freelance Niches'],
                    ['value' => '100%', 'label' => 'Remote Scope'],
                    ['value' => 'Global', 'label' => 'Clientele'],
                ]
            ],
            'competitive-exams' => [
                'db_slug' => 'competitive-exams',
                'title' => 'Competitive Exams',
                'description' => 'Prepare for top government, banking, and professional entrance examinations.',
                'theme' => [
                    'primary' => '#eab308', // yellow-500
                    'secondary' => '#facc15', // yellow-400
                    'gradient' => 'linear-gradient(135deg, #422006 0%, #854d0e 40%, #ca8a04 75%, #eab308 100%)',
                    'button_gradient' => 'linear-gradient(to right, #ca8a04, #eab308)'
                ],
                'stats' => [
                    ['value' => '100+', 'label' => 'Top Exams'],
                    ['value' => 'High', 'label' => 'Competition'],
                    ['value' => 'Lifetime', 'label' => 'Job Security'],
                ]
            ],
            'hotel-management' => [
                'db_slug' => 'hotel-management',
                'title' => 'Hotel Management & Tourism',
                'description' => 'Explore the world of hospitality, luxury hotels, culinary arts, and global tourism.',
                'theme' => [
                    'primary' => '#f97316', // orange-500
                    'secondary' => '#fb923c', // orange-400
                    'gradient' => 'linear-gradient(135deg, #431407 0%, #9a3412 40%, #ea580c 75%, #f97316 100%)',
                    'button_gradient' => 'linear-gradient(to right, #ea580c, #f97316)'
                ],
                'stats' => [
                    ['value' => '5+', 'label' => 'Core Sectors'],
                    ['value' => 'Global', 'label' => 'Opportunities'],
                    ['value' => 'High', 'label' => 'Growth'],
                ]
            ],
            'pharmaceutical-sciences' => [
                'db_slug' => 'pharmacy',
                'title' => 'Pharmaceutical Sciences',
                'description' => 'Discover careers in drug research, clinical trials, pharmacy, and healthcare manufacturing.',
                'theme' => [
                    'primary' => '#6366f1', // indigo-500
                    'secondary' => '#818cf8', // indigo-400
                    'gradient' => 'linear-gradient(135deg, #1e1b4b 0%, #3730a3 40%, #4f46e5 75%, #6366f1 100%)',
                    'button_gradient' => 'linear-gradient(to right, #4f46e5, #6366f1)'
                ],
                'stats' => [
                    ['value' => '6+', 'label' => 'Core Domains'],
                    ['value' => 'Top 3', 'label' => 'Global Pharma Hub'],
                    ['value' => 'Stable', 'label' => 'Career Path'],
                ]
            ],
            'ayush-allied-health' => [
                'db_slug' => 'ayush-allied',
                'title' => 'AYUSH & Allied Health',
                'description' => 'Heal the world. Explore careers in Ayurveda, Yoga, Homeopathy, and allied medical sciences.',
                'theme' => [
                    'primary' => '#84cc16', // lime-500
                    'secondary' => '#a3e635', // lime-400
                    'gradient' => 'linear-gradient(135deg, #1a2e05 0%, #3f6212 40%, #65a30d 75%, #84cc16 100%)',
                    'button_gradient' => 'linear-gradient(to right, #65a30d, #84cc16)'
                ],
                'stats' => [
                    ['value' => '5+', 'label' => 'AYUSH Systems'],
                    ['value' => 'Global', 'label' => 'Demand'],
                    ['value' => 'Rising', 'label' => 'Popularity'],
                ]
            ],
            // === Main Fields ===
            'arts-humanities' => [
                'db_slug' => 'arts-humanities',
                'title' => 'Arts & Humanities',
                'description' => 'Unleash your creativity and explore diverse cultures, languages, history, and human behavior.',
                'theme' => [
                    'primary' => '#8b5cf6', // soft violet for glow
                    'secondary' => '#a78bfa', // lighter violet
                    'gradient' => 'linear-gradient(135deg, #0f172a, #1e3a8a, #6d28d9)',
                    'button_gradient' => 'linear-gradient(to right, #1e3a8a, #6d28d9)'
                ],
                'stats' => [
                    ['value' => '50+', 'label' => 'Career Paths'],
                    ['value' => 'High', 'label' => 'Versatility'],
                    ['value' => 'Global', 'label' => 'Scope'],
                ]
            ],
            'commerce' => [
                'db_slug' => 'commerce',
                'title' => 'Commerce & Finance',
                'description' => 'Drive the global economy. Explore dynamic paths in finance, accounting, banking, and business management.',
                'theme' => [
                    'primary' => '#0ea5e9', // sky-500
                    'secondary' => '#38bdf8', // sky-400
                    'gradient' => 'linear-gradient(135deg, #082f49 0%, #0369a1 40%, #0284c7 75%, #0ea5e9 100%)',
                    'button_gradient' => 'linear-gradient(to right, #0284c7, #0ea5e9)'
                ],
                'stats' => [
                    ['value' => '50+', 'label' => 'Career Paths'],
                    ['value' => 'Evergreen', 'label' => 'Demand'],
                    ['value' => 'High', 'label' => 'Earnings'],
                ]
            ],
            'science' => [
                'db_slug' => 'science',
                'title' => 'Pure & Applied Science',
                'description' => 'Discover the unknown. Build a career in research, biology, chemistry, physics, and environmental sciences.',
                'theme' => [
                    'primary' => '#10b981', // emerald-500
                    'secondary' => '#34d399', // emerald-400
                    'gradient' => 'linear-gradient(135deg, #064e3b 0%, #047857 40%, #059669 75%, #10b981 100%)',
                    'button_gradient' => 'linear-gradient(to right, #059669, #10b981)'
                ],
                'stats' => [
                    ['value' => '50+', 'label' => 'Career Paths'],
                    ['value' => 'R&D', 'label' => 'Focus'],
                    ['value' => 'Crucial', 'label' => 'Impact'],
                ]
            ],
            'technology-engineering' => [
                'db_slug' => 'technology-engineering',
                'title' => 'Technology & Engineering',
                'description' => 'Innovate and build the future. Explore the vast domain of engineering and technological advancements.',
                'theme' => [
                    'primary' => '#3b82f6', // blue-500
                    'secondary' => '#60a5fa', // blue-400
                    'gradient' => 'linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 40%, #2563eb 75%, #3b82f6 100%)',
                    'button_gradient' => 'linear-gradient(to right, #2563eb, #3b82f6)'
                ],
                'stats' => [
                    ['value' => '50+', 'label' => 'Career Paths'],
                    ['value' => '15+', 'label' => 'Sub-Fields'],
                    ['value' => 'Massive', 'label' => 'Job Market'],
                ]
            ],

            // === Engineering Sub-Fields ===
            'electrical-engineering' => [
                'db_slug' => 'electrical-engineering',
                'title' => 'Electrical Engineering',
                'description' => 'Power the world. Design, develop, and maintain electrical control systems, machinery, and equipment.',
                'theme' => [
                    'primary' => '#f59e0b', // amber-500
                    'secondary' => '#fbbf24', // amber-400
                    'gradient' => 'linear-gradient(135deg, #78350f 0%, #b45309 40%, #d97706 75%, #f59e0b 100%)',
                    'button_gradient' => 'linear-gradient(to right, #d97706, #f59e0b)'
                ],
                'stats' => [['value' => '30+', 'label' => 'Paths'], ['value' => 'High', 'label' => 'Demand'], ['value' => 'Core', 'label' => 'Branch']]
            ],
            'chemical-engineering' => [
                'db_slug' => 'chemical-engineering',
                'title' => 'Chemical Engineering',
                'description' => 'Transform raw materials into valuable products in pharmaceuticals, energy, and materials science.',
                'theme' => [
                    'primary' => '#10b981', // emerald-500
                    'secondary' => '#34d399', // emerald-400
                    'gradient' => 'linear-gradient(135deg, #022c22 0%, #047857 40%, #059669 75%, #10b981 100%)',
                    'button_gradient' => 'linear-gradient(to right, #059669, #10b981)'
                ],
                'stats' => [['value' => '30+', 'label' => 'Paths'], ['value' => 'Industrial', 'label' => 'Focus'], ['value' => 'Niche', 'label' => 'Expertise']]
            ],
            'computer-engineering' => [
                'db_slug' => 'computer-engineering',
                'title' => 'Computer Engineering',
                'description' => 'Blend computer science and electrical engineering to build advanced hardware and software systems.',
                'theme' => [
                    'primary' => '#3b82f6', // blue-500
                    'secondary' => '#60a5fa', // blue-400
                    'gradient' => 'linear-gradient(135deg, #172554 0%, #1e40af 40%, #2563eb 75%, #3b82f6 100%)',
                    'button_gradient' => 'linear-gradient(to right, #2563eb, #3b82f6)'
                ],
                'stats' => [['value' => '50+', 'label' => 'Paths'], ['value' => 'Massive', 'label' => 'Scope'], ['value' => 'Tech', 'label' => 'Driven']]
            ],
            'information-technology' => [
                'db_slug' => 'information-technology',
                'title' => 'Information Technology',
                'description' => 'Manage and process data. Specialize in networking, databases, software, and IT infrastructure.',
                'theme' => [
                    'primary' => '#0ea5e9', // sky-500
                    'secondary' => '#38bdf8', // sky-400
                    'gradient' => 'linear-gradient(135deg, #082f49 0%, #0369a1 40%, #0284c7 75%, #0ea5e9 100%)',
                    'button_gradient' => 'linear-gradient(to right, #0284c7, #0ea5e9)'
                ],
                'stats' => [['value' => '40+', 'label' => 'Paths'], ['value' => 'Global', 'label' => 'Demand'], ['value' => 'Fast', 'label' => 'Growth']]
            ],
            'electronics-telecommunication' => [
                'db_slug' => 'electronics-telecommunication',
                'title' => 'Electronics & Telecommunication',
                'description' => 'Connect the globe. Design communication networks, IoT devices, and semiconductor technologies.',
                'theme' => [
                    'primary' => '#8b5cf6', // violet-500
                    'secondary' => '#a78bfa', // violet-400
                    'gradient' => 'linear-gradient(135deg, #2e1065 0%, #5b21b6 40%, #7c3aed 75%, #8b5cf6 100%)',
                    'button_gradient' => 'linear-gradient(to right, #7c3aed, #8b5cf6)'
                ],
                'stats' => [['value' => '30+', 'label' => 'Paths'], ['value' => 'Hardware', 'label' => 'Focus'], ['value' => '5G/IoT', 'label' => 'Trends']]
            ],
            'civil-engineering' => [
                'db_slug' => 'civil-engineering',
                'title' => 'Civil Engineering',
                'description' => 'Build the world around you. Design and construct buildings, bridges, dams, and modern infrastructure.',
                'theme' => [
                    'primary' => '#f97316', // orange-500
                    'secondary' => '#fb923c', // orange-400
                    'gradient' => 'linear-gradient(135deg, #431407 0%, #9a3412 40%, #ea580c 75%, #f97316 100%)',
                    'button_gradient' => 'linear-gradient(to right, #ea580c, #f97316)'
                ],
                'stats' => [['value' => '30+', 'label' => 'Paths'], ['value' => 'Core', 'label' => 'Branch'], ['value' => 'Stable', 'label' => 'Career']]
            ],
            'ai-data-science' => [
                'db_slug' => 'ai-data-science',
                'title' => 'AI & Data Science',
                'description' => 'Train machines to think. Develop intelligent algorithms, neural networks, and big data solutions.',
                'theme' => [
                    'primary' => '#ec4899', // pink-500
                    'secondary' => '#f472b6', // pink-400
                    'gradient' => 'linear-gradient(135deg, #500724 0%, #9d174d 40%, #db2777 75%, #ec4899 100%)',
                    'button_gradient' => 'linear-gradient(to right, #db2777, #ec4899)'
                ],
                'stats' => [['value' => '30+', 'label' => 'Paths'], ['value' => 'Peak', 'label' => 'Demand'], ['value' => 'Future', 'label' => 'Proof']]
            ],
            'mechanical-engineering' => [
                'db_slug' => 'mechanical-engineering',
                'title' => 'Mechanical Engineering',
                'description' => 'Design the machines of tomorrow. Specialize in thermodynamics, manufacturing, and kinetic systems.',
                'theme' => [
                    'primary' => '#64748b', // slate-500
                    'secondary' => '#94a3b8', // slate-400
                    'gradient' => 'linear-gradient(135deg, #0f172a 0%, #334155 40%, #475569 75%, #64748b 100%)',
                    'button_gradient' => 'linear-gradient(to right, #475569, #64748b)'
                ],
                'stats' => [['value' => '40+', 'label' => 'Paths'], ['value' => 'Core', 'label' => 'Branch'], ['value' => 'Evergreen', 'label' => 'Demand']]
            ],
            'automobile-engineering' => [
                'db_slug' => 'automobile-engineering',
                'title' => 'Automobile Engineering',
                'description' => 'Drive innovation. Design, manufacture, and test next-generation vehicles and EV technologies.',
                'theme' => [
                    'primary' => '#ef4444', // red-500
                    'secondary' => '#f87171', // red-400
                    'gradient' => 'linear-gradient(135deg, #450a0a 0%, #991b1b 40%, #dc2626 75%, #ef4444 100%)',
                    'button_gradient' => 'linear-gradient(to right, #dc2626, #ef4444)'
                ],
                'stats' => [['value' => '30+', 'label' => 'Paths'], ['value' => 'EV', 'label' => 'Trend'], ['value' => 'Fast', 'label' => 'Growth']]
            ],
            'aerospace-engineering' => [
                'db_slug' => 'aerospace-engineering',
                'title' => 'Aerospace Engineering',
                'description' => 'Reach for the stars. Engineer aircraft, spacecraft, satellites, and advanced propulsion systems.',
                'theme' => [
                    'primary' => '#0284c7', // light blue-600
                    'secondary' => '#38bdf8', // light blue-400
                    'gradient' => 'linear-gradient(135deg, #082f49 0%, #0369a1 40%, #0284c7 75%, #0ea5e9 100%)',
                    'button_gradient' => 'linear-gradient(to right, #0284c7, #0ea5e9)'
                ],
                'stats' => [['value' => '30+', 'label' => 'Paths'], ['value' => 'Niche', 'label' => 'Sector'], ['value' => 'High', 'label' => 'Salary']]
            ],
            'robotics-engineering' => [
                'db_slug' => 'robotics-engineering',
                'title' => 'Robotics Engineering',
                'description' => 'Build automated solutions. Combine computer science, mechanical, and electronic engineering.',
                'theme' => [
                    'primary' => '#f59e0b', // amber-500
                    'secondary' => '#fbbf24', // amber-400
                    'gradient' => 'linear-gradient(135deg, #78350f 0%, #b45309 40%, #d97706 75%, #f59e0b 100%)',
                    'button_gradient' => 'linear-gradient(to right, #d97706, #f59e0b)'
                ],
                'stats' => [['value' => '30+', 'label' => 'Paths'], ['value' => 'Future', 'label' => 'Tech'], ['value' => 'High', 'label' => 'Demand']]
            ],
            'cyber-security' => [
                'db_slug' => 'cyber-security',
                'title' => 'Cyber Security',
                'description' => 'Defend the digital world. Protect networks, systems, and programs from digital attacks and threats.',
                'theme' => [
                    'primary' => '#14b8a6', // teal-500
                    'secondary' => '#2dd4bf', // teal-400
                    'gradient' => 'linear-gradient(135deg, #042f2e 0%, #0f766e 40%, #0d9488 75%, #14b8a6 100%)',
                    'button_gradient' => 'linear-gradient(to right, #0d9488, #14b8a6)'
                ],
                'stats' => [['value' => '30+', 'label' => 'Paths'], ['value' => 'Crucial', 'label' => 'Role'], ['value' => 'Global', 'label' => 'Need']]
            ],
            'software-engineering' => [
                'db_slug' => 'software-engineering',
                'title' => 'Software Engineering',
                'description' => 'Write the code that runs the world. Design, develop, and test scalable software applications.',
                'theme' => [
                    'primary' => '#8b5cf6', // violet-500
                    'secondary' => '#a78bfa', // violet-400
                    'gradient' => 'linear-gradient(135deg, #2e1065 0%, #5b21b6 40%, #7c3aed 75%, #8b5cf6 100%)',
                    'button_gradient' => 'linear-gradient(to right, #7c3aed, #8b5cf6)'
                ],
                'stats' => [['value' => '40+', 'label' => 'Paths'], ['value' => 'Massive', 'label' => 'Demand'], ['value' => 'Remote', 'label' => 'Friendly']]
            ],
            'cloud-computing' => [
                'db_slug' => 'cloud-computing',
                'title' => 'Cloud Computing',
                'description' => 'Architect digital infrastructure. Manage servers, storage, databases, and networking over the cloud.',
                'theme' => [
                    'primary' => '#0ea5e9', // sky-500
                    'secondary' => '#38bdf8', // sky-400
                    'gradient' => 'linear-gradient(135deg, #082f49 0%, #0369a1 40%, #0284c7 75%, #0ea5e9 100%)',
                    'button_gradient' => 'linear-gradient(to right, #0284c7, #0ea5e9)'
                ],
                'stats' => [['value' => '30+', 'label' => 'Paths'], ['value' => 'Growing', 'label' => 'Market'], ['value' => 'Top', 'label' => 'Pay']]
            ],
            'data-science' => [
                'db_slug' => 'data-science',
                'title' => 'Data Science',
                'description' => 'Extract insights from data. Use mathematics, statistics, and programming to solve complex problems.',
                'theme' => [
                    'primary' => '#ec4899', // pink-500
                    'secondary' => '#f472b6', // pink-400
                    'gradient' => 'linear-gradient(135deg, #500724 0%, #9d174d 40%, #db2777 75%, #ec4899 100%)',
                    'button_gradient' => 'linear-gradient(to right, #db2777, #ec4899)'
                ],
                'stats' => [['value' => '30+', 'label' => 'Paths'], ['value' => 'Very High', 'label' => 'Demand'], ['value' => 'Global', 'label' => 'Opportunities']]
            ],
        ];

        if (array_key_exists($stream, $dynamicStreams)) {
            $config = $dynamicStreams[$stream];
            $dbSlug = $config['db_slug'] ?? $stream;
            $field = Field::where('slug', $dbSlug)->firstOrFail();
            $careers = Career::where('field_id', $field->id)->orderBy('name')->paginate(15);
            $config = $dynamicStreams[$stream];
            return view('career_paths.stream', [
                'field' => $field,
                'careers' => $careers,
                'pageTitle' => $config['title'],
                'pageDescription' => $config['description'],
                'theme' => $config['theme'],
                'stats' => $config['stats']
            ]);
        }

        if ($stream === 'arts-humanities') {
            return view('career_paths.arts');
        }

        $careerPaths = config('career_paths');

        if (!array_key_exists($stream, $careerPaths)) {
            return back()->with('error', 'Career path guide for this stream is not available yet.');
        }

        $pathData = $careerPaths[$stream];
        $pathData['slug'] = $stream;

        return view('career-path.show', compact('pathData'));
    }
}
