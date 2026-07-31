<?php
/**
 * One-time script to clear Laravel caches on the live server.
 * Visit: https://yoursite.com/clear-cache.php?key=CareerGyaan2026Update
 */

$SECRET_KEY = 'CareerGyaan2026Update';

if (!isset($_GET['key']) || $_GET['key'] !== $SECRET_KEY) {
    http_response_code(403);
    die('Access denied.');
}

// Find the base path
$basePath = realpath(__DIR__ . '/../repositories/career-gyan');
if (!$basePath) {
    $basePath = realpath(dirname(__DIR__));
}

echo "<pre>";
echo "Base path: $basePath\n\n";

if (file_exists($basePath . '/artisan')) {
    echo "Running Artisan commands...\n";
    
    $commands = [
        'cache:clear',
        'config:clear',
        'view:clear',
        'route:clear',
        'optimize:clear'
    ];
    
    foreach ($commands as $cmd) {
        echo "\nExecuting: php artisan $cmd\n";
        $output = [];
        $returnVar = 0;
        exec("php " . escapeshellarg($basePath . '/artisan') . " $cmd 2>&1", $output, $returnVar);
        echo implode("\n", $output) . "\n";
        echo "Exit code: $returnVar\n";
    }
} else {
    echo "Artisan not found at $basePath/artisan\n";
    
    // Fallback: manually delete cached files
    echo "\nTrying to manually delete cached views and config...\n";
    
    $cachePaths = [
        $basePath . '/storage/framework/cache/data',
        $basePath . '/storage/framework/views',
        $basePath . '/bootstrap/cache',
    ];
    
    foreach ($cachePaths as $path) {
        if (is_dir($path)) {
            echo "Scanning $path...\n";
            $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::CHILD_FIRST
            );
            
            $deleted = 0;
            foreach ($files as $fileinfo) {
                if ($fileinfo->isFile() && $fileinfo->getFilename() !== '.gitignore') {
                    unlink($fileinfo->getRealPath());
                    $deleted++;
                }
            }
            echo "Deleted $deleted files from $path\n";
        }
    }
}

// Check database cache table if using database cache
$dbPath = $basePath . '/database/database.sqlite';
if (file_exists($dbPath)) {
    try {
        $db = new PDO("sqlite:$dbPath");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Truncate cache table
        $db->exec("DELETE FROM cache");
        echo "\nCleared database cache table.\n";
    } catch (Exception $e) {
        echo "\nCould not clear DB cache: " . $e->getMessage() . "\n";
    }
}

echo "\n========================================\n";
echo "🎉 SUCCESS! Cache cleared.\n";
echo "========================================\n";
echo "Please check your website now (you may need to hard refresh: Ctrl+F5).\n";
echo "\n⚠️ IMPORTANT: Delete this file (clear-cache.php) from your server now!\n";
echo "</pre>";
