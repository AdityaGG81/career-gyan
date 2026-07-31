<?php
/**
 * One-time script to update district and university names in the live database.
 * 
 * Visit: https://yoursite.com/update-names.php?key=CareerGyaan2026Update
 * 
 * DELETE THIS FILE after running it once!
 */

// Security key - only runs if the correct key is provided
$SECRET_KEY = 'CareerGyaan2026Update';

if (!isset($_GET['key']) || $_GET['key'] !== $SECRET_KEY) {
    http_response_code(403);
    die('Access denied. Provide the correct key as ?key=YOUR_KEY');
}

// Find the database - try common Laravel paths
$possiblePaths = [
    __DIR__ . '/../repositories/career-gyan/database/database.sqlite',
    __DIR__ . '/../database/database.sqlite',
    dirname(__DIR__) . '/database/database.sqlite',
];

$dbPath = null;
foreach ($possiblePaths as $path) {
    if (file_exists($path)) {
        $dbPath = realpath($path);
        break;
    }
}

if (!$dbPath) {
    die("ERROR: Could not find database.sqlite. Tried:\n" . implode("\n", $possiblePaths));
}

echo "<pre>\n";
echo "Found database at: $dbPath\n";
echo "File size: " . number_format(filesize($dbPath)) . " bytes\n\n";

try {
    $db = new PDO("sqlite:$dbPath");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get all tables
    $tables = [];
    $result = $db->query("SELECT name FROM sqlite_master WHERE type='table' ORDER BY name");
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $tables[] = $row['name'];
    }
    echo "Tables: " . implode(', ', $tables) . "\n\n";
    
    // Replacements to make (covering all case variations)
    $replacements = [
        'Ahmadnagar' => 'Ahilyanagar',
        'Ahmednagar' => 'Ahilyanagar',
        'AHMADNAGAR' => 'AHILYANAGAR',
        'AHMEDNAGAR' => 'AHILYANAGAR',
        'ahmadnagar' => 'ahilyanagar',
        'ahmednagar' => 'ahilyanagar',
        'Osmanabad' => 'Dharashiv',
        'OSMANABAD' => 'DHARASHIV',
        'osmanabad' => 'dharashiv',
        'Aurangabad' => 'Chhatrapati Sambhajinagar',
        'AURANGABAD' => 'CHHATRAPATI SAMBHAJINAGAR',
        'aurangabad' => 'chhatrapati sambhajinagar',
        'North Maharashtra University' => 'Kavayitri Bahinabai Chaudhari North Maharashtra University',
        'north maharashtra university' => 'Kavayitri Bahinabai Chaudhari North Maharashtra University',
    ];
    
    $totalUpdated = 0;
    
    foreach ($tables as $table) {
        // Get all text columns
        $columns = [];
        $pragma = $db->query("PRAGMA table_info(\"$table\")");
        while ($col = $pragma->fetch(PDO::FETCH_ASSOC)) {
            $type = strtolower($col['type']);
            if (strpos($type, 'text') !== false || strpos($type, 'varchar') !== false || strpos($type, 'char') !== false || $type === '') {
                $columns[] = $col['name'];
            }
        }
        
        if (empty($columns)) continue;
        
        foreach ($columns as $column) {
            foreach ($replacements as $old => $new) {
                $checkStmt = $db->prepare("SELECT COUNT(*) as cnt FROM \"$table\" WHERE \"$column\" LIKE :search");
                $checkStmt->execute([':search' => '%' . $old . '%']);
                $count = $checkStmt->fetch(PDO::FETCH_ASSOC)['cnt'];
                
                if ($count > 0) {
                    $stmt = $db->prepare("UPDATE \"$table\" SET \"$column\" = REPLACE(\"$column\", :old, :new) WHERE \"$column\" LIKE :search");
                    $stmt->execute([
                        ':old' => $old,
                        ':new' => $new,
                        ':search' => '%' . $old . '%'
                    ]);
                    echo "✅ Updated $count rows in '$table'.'$column': '$old' → '$new'\n";
                    $totalUpdated += $count;
                }
            }
        }
    }
    
    echo "\n========================================\n";
    if ($totalUpdated > 0) {
        echo "🎉 SUCCESS! Total rows updated: $totalUpdated\n";
    } else {
        echo "ℹ️  No old names found - database is already up to date!\n";
    }
    echo "========================================\n";
    echo "\n⚠️  IMPORTANT: Delete this file (update-names.php) from your server now!\n";
    echo "</pre>";
    
} catch (PDOException $e) {
    echo "DATABASE ERROR: " . $e->getMessage() . "\n";
    echo "</pre>";
}
