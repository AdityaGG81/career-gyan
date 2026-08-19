<?php

require __DIR__ . '/../../vendor/autoload.php';
$app = require_once __DIR__ . '/../../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$f2025 = __DIR__ . '/mht_cet_cutoffs.json';
$f2026 = __DIR__ . '/mht_cet_cutoffs_2026.json';

if (!file_exists($f2025) || !file_exists($f2026)) {
    die("Error: JSON files not found.\n");
}

$data2025 = json_decode(file_get_contents($f2025), true);
$data2026 = json_decode(file_get_contents($f2026), true);

// 1. Build authoritative map of college_code -> official college_name from verified 2025 dataset
$collegeCodeMap = [];
foreach ($data2025 as $r) {
    $code = (string)$r['college_code'];
    if (!isset($collegeCodeMap[$code])) {
        $collegeCodeMap[$code] = trim($r['college_name']);
    }
}

// 2. Build authoritative branch map from choice code middle 3 digits
$branchCodeMap = [];
foreach ($data2025 as $r) {
    $bc = $r['branch_code'] ?? '';
    $bName = trim($r['branch_name'] ?? '');
    if (strlen($bc) >= 8 && !empty($bName)) {
        $mid = substr($bc, strlen($bc) - 5, 3);
        if (!isset($branchCodeMap[$mid])) {
            $branchCodeMap[$mid] = $bName;
        }
    }
}

echo "Clean 2025 College Map count: " . count($collegeCodeMap) . "\n";
echo "Clean 2025 Branch Map count: " . count($branchCodeMap) . "\n";

$sanitized2026 = [];
$tier1Codes = ['3012', '16006', '6006', '3215', '6271', '3036', '6007', '3199', '6175', '2008', '1002', '6278', '6274', '6272', '3184', '6005'];

$stats = [
    'total' => count($data2026),
    'fixed_college_name' => 0,
    'fixed_college_code' => 0,
    'fixed_branch_name' => 0,
    'dropped_corrupt' => 0,
];

foreach ($data2026 as $r) {
    $bCode = trim((string)($r['branch_code'] ?? ''));
    $cCode = (string)($r['college_code'] ?? '');
    $cName = trim($r['college_name'] ?? '');
    $bName = trim($r['branch_name'] ?? '');
    $merit = $r['merit_no'] ?? null;
    $pct = floatval($r['percentile'] ?? 0);

    // Derive college_code from 10-digit choice code prefix (first 4 or 5 digits)
    $derivedCollegeCode = null;
    if (strlen($bCode) >= 9) {
        $prefixLen = (strlen($bCode) == 9) ? 4 : 5;
        $derivedCollegeCode = ltrim(substr($bCode, 0, $prefixLen), '0');
    }

    if ($derivedCollegeCode && $derivedCollegeCode !== ltrim($cCode, '0')) {
        $cCode = $derivedCollegeCode;
        $stats['fixed_college_code']++;
    }

    $normCode = ltrim($cCode, '0');

    // Assign Official Clean College Name
    if (isset($collegeCodeMap[$normCode])) {
        if ($cName !== $collegeCodeMap[$normCode]) {
            $cName = $collegeCodeMap[$normCode];
            $stats['fixed_college_name']++;
        }
    } else {
        // Clean appended course strings from college_name
        $cName = preg_replace('/-?\s*(Computer Science|Computer|Information|Electrical|Mechanical|Civil|Bio Technology|Artificial Intelligence|Robotics|Data Science).*$/i', '', $cName);
        $cName = trim($cName, " -\t\n\r\0\x0B");
    }

    // Derive or clean Branch Name
    if (strlen($bCode) >= 8) {
        $mid = substr($bCode, strlen($bCode) - 5, 3);
        if (isset($branchCodeMap[$mid])) {
            if ($bName !== $branchCodeMap[$mid]) {
                $bName = $branchCodeMap[$mid];
                $stats['fixed_branch_name']++;
            }
        }
    }

    if (empty($bName)) {
        $bName = 'Engineering';
    }

    // Drop corrupt state-leak rows where top percentiles (>99%) and top merit ranks (<2500) were assigned to non-Tier1 colleges
    if ($pct > 99.0 && $merit !== null && $merit < 2500 && !in_array($normCode, $tier1Codes)) {
        $stats['dropped_corrupt']++;
        continue;
    }

    if (empty($cName) || $pct <= 0) {
        continue;
    }

    $r['college_code'] = is_numeric($normCode) ? (int)$normCode : $normCode;
    $r['college_name'] = $cName;
    $r['branch_name']  = $bName;
    $r['percentile']   = $pct;

    $sanitized2026[] = $r;
}

echo "Sanitization complete:\n";
print_r($stats);

// Save sanitized 2026 data back to file
file_put_contents($f2026, json_encode($sanitized2026, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "Saved " . count($sanitized2026) . " sanitized 2026 records to {$f2026}.\n";

// Re-seed the database table
echo "Running MhtCetCutoffSeeder...\n";
\Illuminate\Support\Facades\Artisan::call('db:seed', [
    '--class' => 'MhtCetCutoffSeeder',
    '--force' => true
]);
echo "Database re-seeded successfully!\n";
