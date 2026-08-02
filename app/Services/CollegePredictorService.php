<?php

namespace App\Services;

use App\Models\MhtCetCutoff;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CollegePredictorService
{
    /**
     * Common branch categories mapped to database keyword patterns.
     */
    public const BRANCH_GROUPS = [
        'cs_it' => [
            'label' => 'Computer Science, IT & AI-DS',
            'keywords' => ['computer', 'information technology', 'artificial intelligence', 'data science', 'cyber', 'software', 'machine learning'],
        ],
        'electronics' => [
            'label' => 'Electronics & Telecommunication (ENTC)',
            'keywords' => ['electronics', 'telecommunication', 'entc', 'vlsi', 'instrumentation'],
        ],
        'mechanical' => [
            'label' => 'Mechanical & Automobile Engineering',
            'keywords' => ['mechanical', 'automobile', 'manufacturing', 'production', 'mechatronics'],
        ],
        'civil' => [
            'label' => 'Civil & Environmental Engineering',
            'keywords' => ['civil', 'structural', 'environmental', 'infrastructure'],
        ],
        'electrical' => [
            'label' => 'Electrical Engineering',
            'keywords' => ['electrical', 'power engineering'],
        ],
        'chemical' => [
            'label' => 'Chemical, Biotech & Textile',
            'keywords' => ['chemical', 'biotechnology', 'bio medical', 'textile', 'petroleum', 'pharmaceutical'],
        ],
    ];

    /**
     * Common CAP categories.
     */
    public const CATEGORY_OPTIONS = [
        'GOPENS' => 'General Open (State Level - GOPENS)',
        'GOPENH' => 'General Open (Home University - GOPENH)',
        'LOPENS' => 'Ladies Open (State Level - LOPENS)',
        'LOPENH' => 'Ladies Open (Home University - LOPENH)',
        'GOBCS'  => 'OBC (State Level - GOBCS)',
        'GOBCH'  => 'OBC (Home University - GOBCH)',
        'LOBCS'  => 'Ladies OBC (State Level - LOBCS)',
        'GSCHS'  => 'SC (State Level - GSCHS)',
        'GSTHS'  => 'ST (State Level - GSTHS)',
        'EWS'    => 'Economically Weaker Section (EWS)',
        'TFWS'   => 'Tuition Fee Waiver Scheme (TFWS)',
        'AI'     => 'All India Seats (JEE Main / Non-Mah)',
    ];

    /**
     * Major Maharashtra Engineering Districts.
     */
    public const DISTRICTS = [
        'Pune', 'Mumbai', 'Mumbai Suburban', 'Thane', 'Nagpur', 'Nashik', 
        'Aurangabad', 'Kolhapur', 'Sangli', 'Solapur', 'Ahmednagar', 'Amravati', 
        'Jalgaon', 'Satara', 'Nanded', 'Latur', 'Dhule', 'Chandrapur', 'Raigad'
    ];

    /**
     * Execute prediction algorithm and return classified colleges.
     */
    public static function predictColleges(array $filters): array
    {
        $percentile = (float) ($filters['percentile'] ?? 90.0);
        $category = strtoupper(trim($filters['category'] ?? 'GOPENS'));
        $district = trim($filters['district'] ?? '');
        $branchGroup = trim($filters['branch_group'] ?? '');
        $chanceFilter = strtolower(trim($filters['chance_level'] ?? 'all'));
        $collegeType = strtolower(trim($filters['college_type'] ?? 'all'));
        $searchQuery = trim($filters['search'] ?? '');
        $limit = (int) ($filters['limit'] ?? 150);

        // Bounds for query: include everything from tough reach to safe bets
        $minCutoff = max(1.0, $percentile - 15.0);
        $maxCutoff = min(100.0, $percentile + 8.0);

        $query = MhtCetCutoff::query()
            ->where('percentile', '>=', $minCutoff)
            ->where('percentile', '<=', $maxCutoff);

        // Category filter (match exact or partial e.g. GOPENS vs GOPEN)
        if (!empty($category)) {
            $catPrefix = preg_replace('/[SH]$/i', '', $category);
            $query->where(function ($q) use ($category, $catPrefix) {
                $q->where('category', $category)
                  ->orWhere('category', 'like', "{$category}%")
                  ->orWhere('category', 'like', "%{$catPrefix}%");
            });
        }

        // District / Location filter
        if (!empty($district) && strtolower($district) !== 'all') {
            $query->where('college_name', 'like', "%{$district}%");
        }

        // Branch domain filter
        if (!empty($branchGroup) && isset(self::BRANCH_GROUPS[$branchGroup])) {
            $keywords = self::BRANCH_GROUPS[$branchGroup]['keywords'];
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $kw) {
                    $q->orWhere('branch_name', 'like', "%{$kw}%");
                }
            });
        }

        // Free text search
        if (!empty($searchQuery)) {
            $synonyms = CollegeSynonymService::resolveQuery($searchQuery);
            $query->where(function ($q) use ($searchQuery, $synonyms) {
                $q->where('college_name', 'like', "%{$searchQuery}%")
                  ->orWhere('branch_name', 'like', "%{$searchQuery}%");
                foreach ($synonyms as $syn) {
                    if (strlen($syn) > 2) {
                        $q->orWhere('college_name', 'like', "%{$syn}%");
                    }
                }
            });
        }

        $cutoffs = $query->orderByDesc('percentile')->limit(400)->get();

        // Process and classify results
        $results = [];
        $counts = [
            'total'  => 0,
            'safe'   => 0,
            'target' => 0,
            'reach'  => 0,
            'dream'  => 0,
        ];

        // Cache resolved college profiles to keep response time super fast (<20ms)
        $profileCache = [];

        foreach ($cutoffs as $c) {
            $cPercentile = (float) $c->percentile;
            $delta = $percentile - $cPercentile;

            // Classification Logic
            if ($delta >= 1.5) {
                $chance = 'safe';
                $chanceLabel = 'High Chance / Safe Bet';
                $chanceBadge = 'Safe';
                $chanceColor = '#059669';
                $chanceBg = '#ecfdf5';
                $probPct = min(99, round(90 + ($delta * 2.5)));
                $counts['safe']++;
            } elseif ($delta >= -1.0) {
                $chance = 'target';
                $chanceLabel = 'Good Chance / Target';
                $chanceBadge = 'Target';
                $chanceColor = '#2563eb';
                $chanceBg = '#eff6ff';
                $probPct = round(65 + (($delta + 1.0) / 2.5 * 25));
                $counts['target']++;
            } elseif ($delta >= -3.5) {
                $chance = 'reach';
                $chanceLabel = 'Tough Chance / Reach';
                $chanceBadge = 'Reach';
                $chanceColor = '#d97706';
                $chanceBg = '#fffbeb';
                $probPct = round(30 + (($delta + 3.5) / 2.5 * 30));
                $counts['reach']++;
            } else {
                $chance = 'dream';
                $chanceLabel = 'Dream / Low Chance';
                $chanceBadge = 'Dream';
                $chanceColor = '#dc2626';
                $chanceBg = '#fef2f2';
                $probPct = max(10, round(10 + (($delta + 8.0) / 4.5 * 18)));
                $counts['dream']++;
            }

            $counts['total']++;

            // Filter by chance level if requested
            if ($chanceFilter !== 'all' && $chanceFilter !== $chance) {
                continue;
            }

            // Resolve Institutional Details
            $collegeKey = $c->college_name;
            if (!isset($profileCache[$collegeKey])) {
                $profileCache[$collegeKey] = CollegeCutoffService::getCollegeProfileForCutoff($c->college_name, $c->college_code);
            }
            $profile = $profileCache[$collegeKey];

            // Filter by management if requested
            if ($collegeType !== 'all') {
                $mgmt = strtolower($profile['management'] ?? '');
                $type = strtolower($profile['college_type'] ?? '');
                if ($collegeType === 'autonomous' && !str_contains($mgmt, 'autonomous') && !str_contains(strtolower($c->college_name), 'autonomous')) {
                    continue;
                }
                if ($collegeType === 'government' && !str_contains($mgmt, 'government') && !str_contains($type, 'government')) {
                    continue;
                }
            }

            $results[] = [
                'id' => $c->id,
                'college_name' => $c->college_name,
                'college_code' => $c->college_code,
                'branch_name' => $c->branch_name,
                'category' => $c->category,
                'cutoff_percentile' => $cPercentile,
                'cutoff_formatted' => number_format($cPercentile, 2) . '%',
                'user_percentile' => $percentile,
                'delta' => round($delta, 2),
                'delta_formatted' => ($delta >= 0 ? '+' : '') . number_format($delta, 2) . '%',
                'merit_no' => $c->merit_no ? number_format((int)$c->merit_no) : 'N/A',
                'chance' => $chance,
                'chance_label' => $chanceLabel,
                'chance_badge' => $chanceBadge,
                'chance_color' => $chanceColor,
                'chance_bg' => $chanceBg,
                'probability' => $probPct . '%',
                'district' => $profile['district'] ?? 'Maharashtra',
                'management' => $profile['management'] ?? 'Autonomous / Reputed',
                'website' => $profile['website'] ?? null,
                'show_url' => $profile['show_url'] ?? null,
                'map_query' => $profile['map_query'] ?? ($c->college_name . ', Maharashtra, India'),
                'map_embed_url' => $profile['map_embed_url'] ?? ('https://maps.google.com/maps?q=' . urlencode($c->college_name . ', Maharashtra, India') . '&z=15&output=embed'),
                'map_directions_url' => $profile['map_directions_url'] ?? ('https://www.google.com/maps/search/?api=1&query=' . urlencode($c->college_name . ', Maharashtra, India')),
                'cutoffs_url' => url('/tools/maharashtra-colleges-cutoff?q=' . urlencode($c->college_name)),
            ];

            if (count($results) >= $limit) {
                break;
            }
        }

        return [
            'user_percentile' => $percentile,
            'category' => $category,
            'district' => $district,
            'branch_group' => $branchGroup,
            'counts' => $counts,
            'results_count' => count($results),
            'results' => $results,
        ];
    }
}
