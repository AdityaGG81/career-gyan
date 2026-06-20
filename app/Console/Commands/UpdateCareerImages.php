<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Career;
use App\Models\Field;
use Illuminate\Support\Facades\DB;

class UpdateCareerImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'careers:update-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Replace abstract SVG or empty career cover images with professional, highly accurate Unsplash stock photo URLs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Starting career cover images update...");

        // Map keywords to specific Unsplash photo IDs
        $keywordMap = [
            // --- IT & Modern Technology ---
            'devops' => '1558494949-ef010cbdcc31', // server room
            'site-reliability' => '1558494949-ef010cbdcc31', // server room
            'sre' => '1558494949-ef010cbdcc31', // server room
            'system-administrator' => '1558494949-ef010cbdcc31', // server room
            'sysadmin' => '1558494949-ef010cbdcc31', // server room
            
            'machine-learning' => '1677442136019-21780efad99a', // AI neural network
            'deep-learning' => '1677442136019-21780efad99a', // AI neural network
            'artificial-intelligence' => '1677442136019-21780efad99a', // AI neural network
            'ai-ml' => '1677442136019-21780efad99a', // AI neural network
            'data-scientist' => '1677442136019-21780efad99a', // AI neural network
            'data-analyst' => '1551288049-bbda38a594a0', // Business analytics dashboard
            
            'cybersecurity' => '1550751827-4bd374c3f58b', // Computer security lock screen
            'cyber-security' => '1550751827-4bd374c3f58b',
            'information-security' => '1550751827-4bd374c3f58b',
            'hacker' => '1550751827-4bd374c3f58b',
            'cryptography' => '1550751827-4bd374c3f58b',
            
            'database' => '1544383835-bda2bc66a55d', // blue database servers
            'dba' => '1544383835-bda2bc66a55d',
            'sql' => '1544383835-bda2bc66a55d',
            
            'blockchain' => '1621416894569-0f39ed31d247', // crypto/bitcoin charts
            'crypto' => '1621416894569-0f39ed31d247',
            
            'network' => '1544197150-b99a580bb7a8', // ethernet cables and networking
            'telecom' => '1544197150-b99a580bb7a8',
            
            'ui-ux' => '1581291518633-83b4ebd1d83e', // wireframing / user experience designing
            'user-experience' => '1581291518633-83b4ebd1d83e',
            'product-designer' => '1581291518633-83b4ebd1d83e',
            
            'software' => '1517694712202-14dd9538aa97', // coding on laptop
            'developer' => '1517694712202-14dd9538aa97',
            'programmer' => '1517694712202-14dd9538aa97',
            'coder' => '1517694712202-14dd9538aa97',
            'webmaster' => '1517694712202-14dd9538aa97',
            
            'hardware' => '1518770660439-4636190af475', // hardware printed circuit board
            'embedded' => '1518770660439-4636190af475',
            'semiconductor' => '1518770660439-4636190af475',
            
            'game-developer' => '1552820728-8b83bb6b773f', // game dev setup
            'game-designer' => '1552820728-8b83bb6b773f',
            'game-programmer' => '1552820728-8b83bb6b773f',
            
            'qa' => '1516321318423-f06f85e504b3', // software testing
            'testing' => '1516321318423-f06f85e504b3',
            'tester' => '1516321318423-f06f85e504b3',
            
            'cloud' => '1558494949-ef010cbdcc31', // cloud datacenter

            // --- Creative, Arts & Media ---
            'graphic' => '1561070791-de6112d3480f', // digital graphic design
            'design' => '1561070791-de6112d3480f',
            'illustrat' => '1513364776144-60967b0f800f', // paints and canvas
            'artist' => '1513364776144-60967b0f800f',
            'painter' => '1513364776144-60967b0f800f',
            'sculptor' => '1513364776144-60967b0f800f',
            'art' => '1513364776144-60967b0f800f',
            
            '3d-artist' => '1618005182384-a83a8bd57fbe', // 3D graphics/rendering
            'animator' => '1618005182384-a83a8bd57fbe',
            'animation' => '1618005182384-a83a8bd57fbe',
            'vfx' => '1618005182384-a83a8bd57fbe',
            
            'video-editor' => '1574717024458-7f2404efc81f', // video editor monitor
            'videographer' => '1574717024458-7f2404efc81f',
            'editor' => '1455390582263-14dd55722ba9', // writer/editor desk
            
            'audio' => '1598488035139-bdbb2231ce04', // audio recording mixer board
            'sound' => '1598488035139-bdbb2231ce04',
            'music' => '1511671782779-c97d3d27a1d4', // guitar and microphone
            'singer' => '1511671782779-c97d3d27a1d4',
            'producer' => '1598488035139-bdbb2231ce04',
            'composer' => '1598488035139-bdbb2231ce04',
            'podcaster' => '1590602847861-f357a9332bbc', // microphone close up
            'voice' => '1590602847861-f357a9332bbc',
            
            'fashion' => '1558769132-cb1aea458c5e', // tailoring designer room
            'textile' => '1558769132-cb1aea458c5e',
            'costume' => '1558769132-cb1aea458c5e',
            'apparel' => '1558769132-cb1aea458c5e',
            
            'interior-designer' => '1618221195710-dd6b41faaea6', // modern indoor space
            'interior' => '1618221195710-dd6b41faaea6',
            
            'jewelry' => '1599643478518-a784e5dc4c8f', // jeweler working on a ring
            'jewellery' => '1599643478518-a784e5dc4c8f',
            
            'photographer' => '1516035069371-29a1b244cc32', // holding professional camera lens
            'photography' => '1516035069371-29a1b244cc32',
            
            'tattoo' => '1598104358204-87cefc7c5986', // tattoo gun and artist drawing
            
            'writer' => '1455390582263-14dd55722ba9', // typing on keyboard with coffee
            'copywriter' => '1455390582263-14dd55722ba9',
            'journalist' => '1455390582263-14dd55722ba9',
            'reporter' => '1455390582263-14dd55722ba9',
            'author' => '1455390582263-14dd55722ba9',
            'media' => '1611162617213-7d7a39e9b1d7',

            // --- Commerce, Banking & Corporate ---
            'accountant' => '1554224155-8d04cb21cd6c', // spreadsheet & calculator
            'auditor' => '1554224155-8d04cb21cd6c',
            'tax' => '1554224155-8d04cb21cd6c',
            'ca' => '1554224155-8d04cb21cd6c',
            
            'banker' => '1559526324-4b87b5e36e44', // counting money / bank desk
            'banking' => '1559526324-4b87b5e36e44',
            'clerk' => '1559526324-4b87b5e36e44',
            
            'stock-broker' => '1590283603385-17ffb3a7f29f', // trading monitors
            'trader' => '1590283603385-17ffb3a7f29f',
            'investment' => '1590283603385-17ffb3a7f29f',
            
            'marketing' => '1460925895917-afdab827c52f', // digital analytics screen
            'pr' => '1460925895917-afdab827c52f',
            'advertising' => '1460925895917-afdab827c52f',
            
            'sales' => '1557804506-669a67965ba0', // handshake in business suit
            'business-development' => '1557804506-669a67965ba0',
            
            'consultant' => '1454165804606-c3d57bc86b40', // consulting meeting
            'advisor' => '1454165804606-c3d57bc86b40',
            
            'hr' => '1573497019940-1c28c88b4f3e', // human resources interview
            'human-resources' => '1573497019940-1c28c88b4f3e',

            // --- Agriculture, Food & Environment ---
            'farmer' => '1500937386664-56d1dfef3854', // green farm field / tractor
            'agriculture' => '1500937386664-56d1dfef3854',
            'agronomist' => '1500937386664-56d1dfef3854',
            'crop' => '1500937386664-56d1dfef3854',
            
            'horticulture' => '1585320806297-9794b3e4eeae', // garden plants in greenhouse
            'floriculture' => '1585320806297-9794b3e4eeae',
            'gardener' => '1585320806297-9794b3e4eeae',
            
            'veterinary' => '1581888227599-779811939961', // vet holding cute puppy
            'vet' => '1581888227599-779811939961',
            
            'dairy' => '1527324688151-0e627063f26f', // farm cows
            'poultry' => '1527324688151-0e627063f26f',
            
            'food-technologist' => '1556910103-1c02745aae4d', // food service / prep
            'food-processing' => '1556910103-1c02745aae4d',
            
            'forestry' => '1473448912268-2022ce9509d8', // forest trees
            'forest' => '1473448912268-2022ce9509d8',
            
            'fishery' => '1518084224482-62b14a8a0f9e', // fisherman / ocean boat
            'aquaculture' => '1518084224482-62b14a8a0f9e',

            // --- Hospitality, Aviation, Tourism & Logistics ---
            'pilot' => '1506012787146-f92b2d7d6d96', // flight cockpit controls
            'flight' => '1506012787146-f92b2d7d6d96',
            'aviation' => '1506012787146-f92b2d7d6d96',
            
            'flight-attendant' => '1540339830292-45c479b4de5b', // cabin worker smiling
            'cabin-crew' => '1540339830292-45c479b4de5b',
            
            'chef' => '1577219491135-ce391730fb2c', // chef cooking in kitchen
            'cook' => '1577219491135-ce391730fb2c',
            'baker' => '1577219491135-ce391730fb2c',
            'pastry' => '1577219491135-ce391730fb2c',
            
            'hotel-manager' => '1566073171526-8731302eb8ed', // hotel front desk
            'hospitality' => '1566073171526-8731302eb8ed',
            'steward' => '1566073171526-8731302eb8ed',
            
            'travel' => '1488646953014-85cb44e25828', // travel passport and map
            'tourism' => '1488646953014-85cb44e25828',
            'guide' => '1488646953014-85cb44e25828',
            
            'logistics' => '1586528116311-ad8dd3c8310d', // warehouse cardboard boxes
            'supply-chain' => '1586528116311-ad8dd3c8310d',
            'warehouse' => '1586528116311-ad8dd3c8310d',
            
            'delivery' => '1520038410233-7141be7e6f97', // courier delivery
            'courier' => '1520038410233-7141be7e6f97',

            // --- Education, Social, Law & Policy ---
            'teacher' => '1524178232363-1fb2b075b655', // school teacher
            'school' => '1524178232363-1fb2b075b655',
            'educator' => '1524178232363-1fb2b075b655',
            
            'professor' => '1523240795612-9a054b0db644', // university lecture hall
            'lecturer' => '1523240795612-9a054b0db644',
            
            'lawyer' => '1589829085413-56de8ae18c73', // courtroom gavel on books
            'advocate' => '1589829085413-56de8ae18c73',
            'judge' => '1589829085413-56de8ae18c73',
            'legal' => '1589829085413-56de8ae18c73',
            
            'social-worker' => '1469571486292-0ba58a3f068b', // hands coming together
            'counselor' => '1469571486292-0ba58a3f068b',
            
            'policy' => '1541872703-74c5e44368f9', // government parliament building
            'governance' => '1541872703-74c5e44368f9',

            // --- Skill Trades, Manufacturing & Retail ---
            'electrician' => '1621905251189-08b45d6a269e', // electrician wiring box
            'electrical' => '1621905251189-08b45d6a269e',
            
            'plumber' => '1504307651254-35680f356dfd', // pipe wrench fixing leak
            'pipe' => '1504307651254-35680f356dfd',
            
            'carpenter' => '1533090161767-e6ffed986c88', // carpenter woodshop
            'woodworker' => '1533090161767-e6ffed986c88',
            'polisher' => '1533090161767-e6ffed986c88',
            
            'welder' => '1504917595217-d4dc5ebe6122', // welding mask and sparks
            'welding' => '1504917595217-d4dc5ebe6122',
            
            'machinist' => '1581092160607-ee22621dd758', // CNC metal mill
            'cnc' => '1581092160607-ee22621dd758',
            
            'mechanic' => '1486006920555-c77dce18193b', // mechanic under car
            'automotive' => '1486006920555-c77dce18193b',
            'fitter' => '1486006920555-c77dce18193b',
            
            'mason' => '1590069261209-f8e9b8642343', // laying bricks and cement
            'brick' => '1590069261209-f8e9b8642343',
            'tiling' => '1590069261209-f8e9b8642343',
            
            'tailor' => '1520038410233-7141be7e6f97', // sewing machine close up
            'sewing' => '1520038410233-7141be7e6f97',
            
            'barber' => '1560066984-138dadb4c035', // scissors and hairdresser
            'hairdresser' => '1560066984-138dadb4c035',
            'beautician' => '1560066984-138dadb4c035',
            'makeup' => '1560066984-138dadb4c035',
            'spa' => '1560066984-138dadb4c035',
            
            'cashier' => '1556742049-0cfed4f6a45d', // retail payment checkout
            'retail-store' => '1556742049-0cfed4f6a45d',

            // --- Government, Defence & Safety ---
            'soldier' => '1579713192194-c7f8a7e0ebde', // army camouflage
            'army' => '1579713192194-c7f8a7e0ebde',
            'military' => '1579713192194-c7f8a7e0ebde',
            'defence' => '1579713192194-c7f8a7e0ebde',
            
            'police' => '1508182314998-3bd49473002f', // police patrol lights
            'law-enforcement' => '1508182314998-3bd49473002f',
            'inspector' => '1508182314998-3bd49473002f',
            
            'navy' => '1516062423079-7ca13cca993c', // navy warship
            'marine' => '1516062423079-7ca13cca993c',
            
            'air-force' => '1519074069444-1ba4e6664104', // fighter jet
            'fighter' => '1519074069444-1ba4e6664104',
            
            'ias' => '1541872703-74c5e44368f9', // government assembly room
            'civil-servant' => '1541872703-74c5e44368f9',
            'officer' => '1541872703-74c5e44368f9',

            // --- Gaming & E-sports ---
            'gamer' => '1542751371-adc38448a05e', // gaming mechanical keyboard RGB
            'esports' => '1542751371-adc38448a05e',
            'pro-player' => '1542751371-adc38448a05e',
            'streamer' => '1542751371-adc38448a05e',
            'caster' => '1542751371-adc38448a05e',
            'game-artist' => '1542751371-adc38448a05e',

            // --- Healthcare & Medical ---
            'radiologist' => '1559757148-5c350d0d3c56', // doctor checking MRI brain scans
            'mri' => '1559757148-5c350d0d3c56',
            'x-ray' => '1559757148-5c350d0d3c56',
            'imaging' => '1559757148-5c350d0d3c56',
            
            'physiotherapist' => '1576091160550-2173dba999ef', // physical stretch therapy
            'therapy' => '1576091160550-2173dba999ef',
            
            'dentist' => '1606811971618-4486d14f3f99', // dental inspection chair
            'dental' => '1606811971618-4486d14f3f99',
            
            'lab-technician' => '1581093588401-fbb62a02f120', // chemist with microscope
            'bmlt' => '1581093588401-fbb62a02f120',
            'pathologist' => '1581093588401-fbb62a02f120',
            
            'optometrist' => '1589829085413-56de8ae18c73', // optometry lenses checkup
            'eye' => '1589829085413-56de8ae18c73'
        ];

        // Group fields fallback by slug
        $fieldFallbacks = [
            'arts-humanities' => '1513364776144-60967b0f800f', // paint brush
            'commerce-banking-corporate' => '1611974789855-9c2a0a7236a3', // financial stats chart
            'science' => '1532094349884-543bc11b234d', // microscope lab
            'technology-engineering' => '1518770660439-4636190af475', // microchips
            'medical' => '1579684385127-1ef15d508118', // medical clinic
            'business-administration' => '1486406146926-c627a92ad1ab', // corporate skyscraper
            'skill-development' => '1517048676732-d65bc937f952', // workshop team
            'sports' => '1461896836934-ffe607ba8211', // running track
            'agriculture' => '1625246333195-78d9c38ad449', // crop fields
            'agriculture-food-environment' => '1625246333195-78d9c38ad449',
            'creative-design-media' => '1561070791-de6112d3480f', // graphic design / digital art
            'hospitality-aviation-tourism-logistics' => '1586528116311-ad8dd3c8310d', // warehouse
            'education-social-law-policy' => '1524178232363-1fb2b075b655', // classroom teacher
            'skill-trades-manufacturing-retail' => '1517048676732-d65bc937f952', // workshop
            'agriculture-allied-sciences' => '1625246333195-78d9c38ad449',
            'arts-media-entertainment' => '1511671782779-c97d3d27a1d4', // guitar / microphone
            'small-scale-businesses' => '1556742049-0cfed4f6a45d', // register desk
            'government-defence' => '1508182314998-3bd49473002f', // police lights
            'teaching-law' => '1589829085413-56de8ae18c73', // legal gavel
            'modern-tech-ai' => '1677442136019-21780efad99a', // AI neural network
            'it-digital-technology' => '1518770660439-4636190af475', // microchips
            'creative-careers' => '1513364776144-60967b0f800f', // paint brush
            'social-media-content' => '1611162617474-5b21e879e113', // social icons
            'gaming-esports' => '1542751371-adc38448a05e', // rgb setup
            'freelancing-remote' => '1522202176988-66273c2fd55f', // laptop in cafe
            'competitive-exams' => '1434030216411-0b793f4b4173', // study books
            'ayush-allied-health' => '1579684385127-1ef15d508118',
            'healthcare-allied-medical' => '1579684385127-1ef15d508118',
            'pharmacy' => '1587854692152-cbe660dbde88',
            'hotel-management' => '1566073171526-8731302eb8ed'
        ];

        // Fetch careers that have SVG or NULL images
        $careers = Career::where('image', 'like', '%.svg')
                         ->orWhereNull('image')
                         ->get();

        $this->info("Found " . $careers->count() . " careers to update.");

        $updatedCount = 0;

        DB::beginTransaction();

        try {
            foreach ($careers as $career) {
                $slug = strtolower($career->slug);
                $name = strtolower($career->name);

                $photoId = null;

                // Match by keyword in name or slug
                foreach ($keywordMap as $keyword => $id) {
                    if (str_contains($name, $keyword) || str_contains($slug, $keyword)) {
                        $photoId = $id;
                        break; // Stop at first match
                    }
                }

                // Fall back to field/category fallback if no keyword match
                if (!$photoId) {
                    $fieldSlug = $career->field->slug ?? 'others';
                    $photoId = $fieldFallbacks[$fieldSlug] ?? '1507679799987-c73779587ccf'; // general fallback
                }

                // Construct full Unsplash Regular image URL optimized for web
                $unsplashUrl = "https://images.unsplash.com/photo-{$photoId}?auto=format&fit=crop&w=800&q=80";

                $career->image = $unsplashUrl;
                $career->save();
                $updatedCount++;
            }

            DB::commit();
            $this->info("Successfully updated {$updatedCount} careers in the database.");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("Failed to update career images: " . $e->getMessage());
        }
    }
}
