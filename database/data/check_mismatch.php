<?php

$data = json_decode(file_get_contents(__DIR__ . '/mht_cet_cutoffs.json'), true);
usort($data, fn($a, $b) => $b['percentile'] <=> $a['percentile']);
echo "Total 2025 records: " . count($data) . "\n";
echo "Top 30 entries:\n";
for($i = 0; $i < 30; $i++) {
    $r = $data[$i];
    echo ($r['college_code'] ?? 'N/A') . " | " . ($r['college_name'] ?? 'N/A') . " | " . ($r['branch_name'] ?? 'N/A') . " | " . ($r['percentile'] ?? 'N/A') . " | " . ($r['category'] ?? 'N/A') . "\n";
}

echo "\n--- Checking for mismatches (college code vs college name) ---\n";
// Group by college_code and check if names are consistent
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
