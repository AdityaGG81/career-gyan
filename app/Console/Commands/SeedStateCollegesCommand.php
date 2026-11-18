<?php

namespace App\Console\Commands;

use App\Models\IndianCollege;
use App\Models\College;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SeedStateCollegesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'colleges:seed-state 
                            {state? : State name or slug (e.g., delhi, karnataka, uttar-pradesh, all)} 
                            {--list : List all available state seeders and their database counts}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed comprehensive public and private universities and degree colleges with full courses state-by-state';

    /**
     * Map of state slugs to their metadata and seeder class.
     */
    protected array $stateMap = [
        'delhi' => [
            'name'   => 'Delhi',
            'label'  => 'Delhi (NCT)',
            'class'  => \Database\Seeders\States\DelhiCollegeSeeder::class,
        ],
        'karnataka' => [
            'name'   => 'Karnataka',
            'label'  => 'Karnataka',
            'class'  => \Database\Seeders\States\KarnatakaCollegeSeeder::class,
        ],
        'uttar-pradesh' => [
            'name'   => 'Uttar Pradesh',
            'label'  => 'Uttar Pradesh',
            'class'  => \Database\Seeders\States\UttarPradeshCollegeSeeder::class,
        ],
        'tamil-nadu' => [
            'name'   => 'Tamil Nadu',
            'label'  => 'Tamil Nadu',
            'class'  => \Database\Seeders\States\TamilNaduCollegeSeeder::class,
        ],
        'maharashtra' => [
            'name'   => 'Maharashtra',
            'label'  => 'Maharashtra (Enrichment)',
            'class'  => \Database\Seeders\States\MaharashtraEnrichmentSeeder::class,
        ],
        'west-bengal' => [
            'name'   => 'West Bengal',
            'label'  => 'West Bengal',
            'class'  => \Database\Seeders\States\WestBengalCollegeSeeder::class,
        ],
        'telangana' => [
            'name'   => 'Telangana',
            'label'  => 'Telangana',
            'class'  => \Database\Seeders\States\TelanganaCollegeSeeder::class,
        ],
        'gujarat' => [
            'name'   => 'Gujarat',
            'label'  => 'Gujarat',
            'class'  => \Database\Seeders\States\GujaratCollegeSeeder::class,
        ],
        'rajasthan' => [
            'name'   => 'Rajasthan',
            'label'  => 'Rajasthan',
            'class'  => \Database\Seeders\States\RajasthanCollegeSeeder::class,
        ],
        'kerala' => [
            'name'   => 'Kerala',
            'label'  => 'Kerala',
            'class'  => \Database\Seeders\States\KeralaCollegeSeeder::class,
        ],
    ];

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        if ($this->option('list')) {
            $this->displayStateList();
            return 0;
        }

        $inputState = $this->argument('state');

        if (!$inputState) {
            $this->info("Available State Chunks:");
            $options = array_keys($this->stateMap);
            $options[] = 'all';
            $inputState = $this->choice('Select state chunk to seed:', $options, 0);
        }

        $inputState = strtolower(trim($inputState));

        if ($inputState === 'all') {
            $this->info("🚀 Starting batch seeding of all implemented state chunks...");
            foreach ($this->stateMap as $slug => $info) {
                if (class_exists($info['class'])) {
                    $this->seedState($slug, $info);
                } else {
                    $this->warn("⚠️  Skipping {$info['label']}: Seeder class {$info['class']} not yet generated.");
                }
            }
            $this->info("✨ Batch state seeding completed!");
            return 0;
        }

        // Normalize slug
        $matchedSlug = null;
        foreach ($this->stateMap as $slug => $info) {
            if ($slug === $inputState || strtolower($info['name']) === $inputState || strtolower($info['label']) === $inputState) {
                $matchedSlug = $slug;
                break;
            }
        }

        if (!$matchedSlug) {
            $this->error("❌ Unknown state: '{$inputState}'. Run `php artisan colleges:seed-state --list` to view available chunks.");
            return 1;
        }

        $info = $this->stateMap[$matchedSlug];
        if (!class_exists($info['class'])) {
            $this->error("❌ Seeder class {$info['class']} does not exist yet.");
            return 1;
        }

        $this->seedState($matchedSlug, $info);
        return 0;
    }

    /**
     * Run individual state seeder and print verification stats.
     */
    protected function seedState(string $slug, array $info): void
    {
        $this->info("\n========================================================");
        $this->info("📌 Processing State: {$info['label']}");
        $this->info("========================================================");

        $this->call($info['class']);

        // Report stats from DB
        $stateName = $info['name'];
        $indianCollegeRows = IndianCollege::where('state', $stateName)->count();
        $collegesWithCourses = IndianCollege::where('state', $stateName)
            ->whereNotNull('course_name')
            ->where('course_name', '!=', '')
            ->distinct('college_name')
            ->count('college_name');
        $featuredExploreColleges = College::where('state', $stateName)->count();

        $this->line("📊 Database Status for {$stateName}:");
        $this->line("   • Total Rows in `indian_colleges`: {$indianCollegeRows}");
        $this->line("   • Distinct Colleges with Courses: {$collegesWithCourses}");
        $this->line("   • Featured Colleges in Explore Hubs (`colleges` table): {$featuredExploreColleges}");
    }

    /**
     * Display status table of all states.
     */
    protected function displayStateList(): void
    {
        $this->info("📋 State College Database Status Table:");

        $rows = [];
        foreach ($this->stateMap as $slug => $info) {
            $classExists = class_exists($info['class']) ? '✅ Implemented' : '⏳ Pending';
            $stateName = $info['name'];
            $collegesWithCourses = IndianCollege::where('state', $stateName)
                ->whereNotNull('course_name')
                ->where('course_name', '!=', '')
                ->distinct('college_name')
                ->count('college_name');
            $exploreCount = College::where('state', $stateName)->count();

            $rows[] = [
                'Slug'               => $slug,
                'State'              => $info['label'],
                'Seeder Status'      => $classExists,
                'Colleges w/ Courses'=> $collegesWithCourses,
                'Explore Hub Count'  => $exploreCount,
            ];
        }

        $this->table(['Slug', 'State', 'Seeder Status', 'Colleges w/ Courses', 'Explore Hub Count'], $rows);
    }
}
