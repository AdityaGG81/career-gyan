<?php

namespace App\Services;

use App\Models\College;
use App\Models\IndianCollege;
use App\Models\MhtCetCutoff;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class CollegeCutoffService
{
    /**
     * Get MHT-CET cutoffs matching a given college (model instance or name string).
     */
    public static function getCutoffsForCollege($college, int $limit = 100)
    {
        $collegeName = is_string($college) ? $college : ($college->college_name ?? $college->name ?? '');
        if (empty($collegeName)) {
            return collect();
        }

        // 1. Try exact or LIKE match on cutoff college_name
        $query = MhtCetCutoff::query();
        $synonyms = CollegeSynonymService::resolveQuery($collegeName);

        $query->where(function ($q) use ($collegeName, $synonyms) {
            $q->where('college_name', 'like', "%{$collegeName}%");
            foreach ($synonyms as $syn) {
                if (strlen($syn) > 2) {
                    $q->orWhere('college_name', 'like', "%{$syn}%");
                }
            }
        });

        $results = $query->orderBy('percentile', 'desc')->limit($limit)->get();

        // 2. If nothing found, try token-based search for key institutional words
        if ($results->isEmpty()) {
            $cleaned = CollegeSynonymService::normalizeName($collegeName);
            $words = array_filter(explode(' ', $cleaned), fn($w) => strlen($w) >= 4);

            if (!empty($words)) {
                $subQuery = MhtCetCutoff::query();
                $subQuery->where(function ($q) use ($words) {
                    foreach ($words as $w) {
                        $q->where('college_name', 'like', "%{$w}%");
                    }
                });
                $results = $subQuery->orderBy('percentile', 'desc')->limit($limit)->get();
            }
        }

        return $results;
    }

    /**
     * Compute cutoff summary stats for a college.
     */
    public static function getCutoffStats($college): array
    {
        $cutoffs = self::getCutoffsForCollege($college, 200);

        if ($cutoffs->isEmpty()) {
            return [
                'has_cutoffs' => false,
                'total_records' => 0,
                'total_branches' => 0,
                'highest_percentile' => null,
                'lowest_percentile' => null,
                'top_branch' => null,
                'top_gopens_percentile' => null,
                'college_code' => null,
                'official_college_name' => null,
                'cutoffs_url' => null,
            ];
        }

        $branches = $cutoffs->pluck('branch_name')->unique()->values();
        $topCutoff = $cutoffs->first();
        $gopensCutoffs = $cutoffs->filter(fn($c) => strtoupper($c->category) === 'GOPENS' || strtoupper($c->category) === 'GOPENH');
        $topGopens = $gopensCutoffs->sortByDesc('percentile')->first();

        $collegeCode = $topCutoff->college_code;
        $officialName = $topCutoff->college_name;

        return [
            'has_cutoffs' => true,
            'total_records' => $cutoffs->count(),
            'total_branches' => $branches->count(),
            'branches' => $branches->toArray(),
            'highest_percentile' => number_format((float)$cutoffs->max('percentile'), 2) . '%',
            'lowest_percentile' => number_format((float)$cutoffs->min('percentile'), 2) . '%',
            'top_branch' => $topCutoff->branch_name,
            'top_gopens_percentile' => $topGopens ? number_format((float)$topGopens->percentile, 2) . '%' : null,
            'college_code' => $collegeCode,
            'official_college_name' => $officialName,
            'cutoffs_url' => url('/tools/maharashtra-colleges-cutoff?q=' . urlencode($officialName)),
        ];
    }

    /**
     * Find institutional details (IndianCollege / College) for a cutoff college name or code.
     */
    public static function getCollegeProfileForCutoff(string $cutoffCollegeName, ?string $collegeCode = null): array
    {
        $synonyms = CollegeSynonymService::resolveQuery($cutoffCollegeName);
        $norm = CollegeSynonymService::normalizeName($cutoffCollegeName);

        // Try to find in IndianCollege
        $icQuery = IndianCollege::query();
        $icQuery->where(function ($q) use ($cutoffCollegeName, $synonyms) {
            $q->where('college_name', 'like', "%{$cutoffCollegeName}%");
            foreach ($synonyms as $syn) {
                if (strlen($syn) > 2) {
                    $q->orWhere('college_name', 'like', "%{$syn}%");
                }
            }
        });

        $ic = $icQuery->first();

        // If not found, try token match on IndianCollege
        if (!$ic) {
            $words = array_filter(explode(' ', $norm), fn($w) => strlen($w) >= 4);
            if (!empty($words)) {
                $subQuery = IndianCollege::query()->where('state', 'like', '%Maharashtra%');
                $subQuery->where(function ($q) use ($words) {
                    foreach ($words as $w) {
                        $q->where('college_name', 'like', "%{$w}%");
                    }
                });
                $ic = $subQuery->first();
            }
        }

        // Try to find in College
        $cQuery = College::query();
        $cQuery->where(function ($q) use ($cutoffCollegeName, $synonyms) {
            $q->where('name', 'like', "%{$cutoffCollegeName}%");
            foreach ($synonyms as $syn) {
                if (strlen($syn) > 2) {
                    $q->orWhere('name', 'like', "%{$syn}%");
                }
            }
        });
        $college = $cQuery->first();

        // Build composite profile
        $resolvedName = $ic?->college_name ?? $college?->name ?? $cutoffCollegeName;
        $cleanName = trim(preg_replace('/\(Id:\s*[^\)]+\)/i', '', $resolvedName));
        $address = $ic?->address ?? $college?->address ?? $college?->location;
        $city = $ic?->city ?? $college?->city ?? $college?->location;
        $district = $ic?->district;
        $state = $ic?->state ?? ($college?->state ?? 'Maharashtra');

        $mapParts = array_filter([$cleanName, $address, $city, $district, $state, 'India']);
        $mapQuery = implode(', ', array_unique($mapParts));
        $mapEmbedUrl = 'https://maps.google.com/maps?q=' . urlencode($mapQuery) . '&z=15&output=embed';
        $mapDirectionsUrl = 'https://www.google.com/maps/search/?api=1&query=' . urlencode($mapQuery);

        return [
            'found' => ($ic !== null || $college !== null),
            'id' => $ic?->id ?? $college?->id,
            'college_name' => $resolvedName,
            'college_code' => $collegeCode,
            'district' => $ic?->district ?? ($college?->city ?? 'Maharashtra'),
            'city' => $ic?->city ?? $college?->city,
            'state' => $state,
            'management' => $ic?->management ?? ($college?->type ?? 'Government / Autonomous / Private'),
            'college_type' => $ic?->college_type ?? 'Engineering',
            'university_name' => $ic?->university_name ?? $college?->affiliated_to,
            'year_of_establishment' => $ic?->year_of_establishment ?? $college?->established_year,
            'website' => $ic?->website ?? $college?->website,
            'total_enrollment' => $ic?->total_enrollment,
            'faculty_count' => $ic?->faculty_count,
            'address' => $address,
            'show_url' => $ic ? url('/colleges/' . $ic->id) : ($college ? url('/explore/colleges/' . $college->id) : null),
            'map_query' => $mapQuery,
            'map_embed_url' => $mapEmbedUrl,
            'map_directions_url' => $mapDirectionsUrl,
        ];
    }
}
