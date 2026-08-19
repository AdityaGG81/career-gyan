<?php

// Find VJTI records in both files
$data2025 = json_decode(file_get_contents(__DIR__ . '/mht_cet_cutoffs.json'), true);
$data2026 = json_decode(file_get_contents(__DIR__ . '/mht_cet_cutoffs_2026.json'), true);

echo "=== VJTI (code 3012) in 2025 ===\n";
$vjti2025 = array_filter($data2025, fn($r) => ($r['college_code'] ?? '') == '3012' || ($r['college_code'] ?? '') == 3012);
usort($vjti2025, fn($a, $b) => $b['percentile'] <=> $a['percentile']);
foreach(array_slice($vjti2025, 0, 10) as $r) {
    echo $r['branch_name'] . " | " . $r['percentile'] . " | " . $r['category'] . "\n";
}

echo "\n=== VJTI (code 3012) in 2026 ===\n";
$vjti2026 = array_filter($data2026, fn($r) => ($r['college_code'] ?? '') == '3012' || ($r['college_code'] ?? '') == 3012);
usort($vjti2026, fn($a, $b) => $b['percentile'] <=> $a['percentile']);
foreach(array_slice($vjti2026, 0, 10) as $r) {
    echo $r['branch_name'] . " | " . $r['percentile'] . " | " . $r['category'] . "\n";
}
if (empty($vjti2026)) echo "NO VJTI records in 2026!\n";

echo "\n=== Sinhgad (code 6177) in 2026 top records ===\n";
$sinhgad = array_filter($data2026, fn($r) => ($r['college_code'] ?? '') == '6177' || ($r['college_code'] ?? '') == 6177);
usort($sinhgad, fn($a, $b) => $b['percentile'] <=> $a['percentile']);
foreach(array_slice($sinhgad, 0, 10) as $r) {
    echo $r['branch_name'] . " | " . $r['percentile'] . " | " . $r['category'] . "\n";
}

echo "\n=== Categories in 2026 (unique seat types) ===\n";
$cats = [];
foreach($data2026 as $r) {
    $cats[$r['category'] ?? 'NULL'] = true;
}
echo implode(', ', array_keys($cats)) . "\n";

echo "\n=== Check if 2026 data has general open GOPENS entries for VJTI ===\n";
$vjtiOpen = array_filter($data2026, fn($r) => 
    (($r['college_code'] ?? '') == '3012' || ($r['college_code'] ?? '') == 3012) &&
    strpos($r['category'] ?? '', 'GOPENS') !== false
);
echo "VJTI GOPENS count: " . count($vjtiOpen) . "\n";
