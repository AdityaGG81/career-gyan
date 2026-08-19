<?php

$data = json_decode(file_get_contents(__DIR__ . '/mht_cet_cutoffs_2026.json'), true);
usort($data, fn($a, $b) => $b['percentile'] <=> $a['percentile']);
echo "Total 2026 records: " . count($data) . "\n";
echo "Top 30 entries:\n";
for($i = 0; $i < 30; $i++) {
    $r = $data[$i];
    echo ($r['college_code'] ?? 'N/A') . " | " . ($r['college_name'] ?? 'N/A') . " | " . ($r['branch_name'] ?? 'N/A') . " | " . ($r['percentile'] ?? 'N/A') . " | " . ($r['category'] ?? 'N/A') . "\n";
}

echo "\n--- Checking for mismatches (college code vs college name) ---\n";
$codeNames = [];
foreach($data as $r) {
    $code = (string)($r['college_code'] ?? '');
    $name = $r['college_name'] ?? '';
    if (!isset($codeNames[$code])) $codeNames[$code] = [];
    $codeNames[$code][$name] = true;
}

$mismatches = 0;
foreach($codeNames as $code => $names) {
    if (count($names) > 1) {
        $mismatches++;
        echo "Code $code has multiple names: " . implode(' | ', array_keys($names)) . "\n";
    }
}
echo "Total college codes with multiple names: $mismatches\n";

// Check what categories have extreme percentile ranges per college
echo "\n--- Colleges with suspicious high percentiles in 2026 ---\n";
$collegePcts = [];
foreach($data as $r) {
    $name = $r['college_name'] ?? 'Unknown';
    $pct = floatval($r['percentile'] ?? 0);
    if (!isset($collegePcts[$name])) $collegePcts[$name] = [];
    $collegePcts[$name][] = $pct;
}
$highThreshold = 99.5;
foreach($collegePcts as $name => $pcts) {
    $max = max($pcts);
    if ($max >= $highThreshold) {
        echo "$name: max=" . number_format($max, 4) . "\n";
    }
}
