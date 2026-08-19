<?php
/**
 * rebuild_from_csv.php
 * 
 * Reads the authoritative 2025 CSV and rebuilds mht_cet_cutoffs.json
 * then re-seeds the database - ensuring 100% accuracy.
 */

require __DIR__ . '/../../vendor/autoload.php';
$app = require_once __DIR__ . '/../../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$csvFile = __DIR__ . '/../../public/downloads/Maharashtra_MHT_CET_Engineering_Cutoffs_2025.csv';
$jsonOut = __DIR__ . '/mht_cet_cutoffs.json';

if (!file_exists($csvFile)) {
    die("ERROR: CSV file not found at $csvFile\n");
}

$handle = fopen($csvFile, 'r');
if (!$handle) die("Cannot open CSV\n");

// Read header row
$header = fgetcsv($handle);
echo "CSV Headers: " . implode(', ', $header) . "\n";

$records = [];
$lineNum = 1;
while (($row = fgetcsv($handle)) !== false) {
    $lineNum++;
    if (count($row) < 7) continue;

    $collegeCode = trim($row[0] ?? '');
    $collegeName = trim($row[1] ?? '');
    $branchCode  = trim($row[2] ?? '');
    $branchName  = trim($row[3] ?? '');
    $category    = trim($row[4] ?? '');
    $meritNo     = trim($row[5] ?? '');
    $percentile  = trim($row[6] ?? '');
    $percentileBand = trim($row[7] ?? '');
    $round       = trim($row[8] ?? '');
    $year        = trim($row[9] ?? '2025');

    // Skip invalid rows
    if (empty($collegeCode) || empty($collegeName) || !is_numeric($percentile)) {
        echo "Skipping invalid row $lineNum: code=$collegeCode, pct=$percentile\n";
        continue;
    }

    $records[] = [
        'college_code'    => is_numeric($collegeCode) ? (int)$collegeCode : $collegeCode,
        'college_name'    => $collegeName,
        'branch_code'     => $branchCode,
        'branch_name'     => $branchName,
        'category'        => $category,
        'category_full'   => null,
        'percentile'      => (float)$percentile,
        'merit_no'        => is_numeric($meritNo) ? (int)$meritNo : null,
        'percentile_band' => !empty($percentileBand) ? $percentileBand : null,
        'round'           => $round,
        'year'            => is_numeric($year) ? (int)$year : 2025,
        'status'          => null,
        'quota'           => null,
    ];
}
fclose($handle);

echo "Total records parsed from CSV: " . count($records) . "\n";

// Sort by percentile descending
usort($records, fn($a, $b) => $b['percentile'] <=> $a['percentile']);

echo "Top 10 after sort:\n";
for($i = 0; $i < 10; $i++) {
    $r = $records[$i];
    echo $r['college_code'] . " | " . $r['college_name'] . " | " . $r['branch_name'] . " | " . $r['percentile'] . " | " . $r['category'] . "\n";
}

// Save to JSON
file_put_contents($jsonOut, json_encode($records, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "\nSaved " . count($records) . " records to $jsonOut\n";

// Wipe mht_cet_cutoffs.json (2026 is separate - keep it but fix the seeder to only use 2025)
echo "\nNow re-seeding database ONLY from 2025 CSV data...\n";

use Illuminate\Support\Facades\DB;
DB::table('mht_cet_cutoffs')->truncate();
echo "Table truncated.\n";

$chunks = array_chunk($records, 500);
$totalInserted = 0;
$now = now();

foreach ($chunks as $chunk) {
    $rows = array_map(function($record) use ($now) {
        return [
            'college_code'    => $record['college_code'],
            'college_name'    => $record['college_name'],
            'branch_code'     => $record['branch_code'],
            'branch_name'     => $record['branch_name'],
            'category'        => $record['category'],
            'category_full'   => $record['category_full'],
            'percentile'      => $record['percentile'],
            'year'            => $record['year'],
            'round'           => $record['round'],
            'status'          => $record['status'],
            'quota'           => $record['quota'],
            'merit_no'        => $record['merit_no'],
            'percentile_band' => $record['percentile_band'],
            'created_at'      => $now,
            'updated_at'      => $now,
        ];
    }, $chunk);
    DB::table('mht_cet_cutoffs')->insert($rows);
    $totalInserted += count($rows);
}

echo "Database seeded with $totalInserted records.\n";

// Verify top 10 in database
echo "\nVerification - Top 10 in DB:\n";
$topRows = DB::table('mht_cet_cutoffs')
    ->orderBy('percentile', 'desc')
    ->limit(10)
    ->get(['college_code', 'college_name', 'branch_name', 'percentile', 'category']);
foreach($topRows as $r) {
    echo $r->college_code . " | " . $r->college_name . " | " . $r->branch_name . " | " . $r->percentile . " | " . $r->category . "\n";
}

echo "\nDone! Database now has clean, accurate 2025 data sorted by percentile desc.\n";
