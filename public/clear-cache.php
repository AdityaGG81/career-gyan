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

echo "<pre>";
echo "Starting cache clear...\n\n";

// Find the base path
$basePath = realpath(__DIR__ . '/../repositories/career-gyan');
if (!$basePath) {
    $basePath = realpath(dirname(__DIR__));
}

echo "Base path: $basePath\n\n";

// Try to use Laravel's internal Artisan kernel instead of shell exec
try {
    if (file_exists($basePath . '/vendor/autoload.php') && file_exists($basePath . '/bootstrap/app.php')) {
        echo "Bootstrapping Laravel...\n";
        require $basePath . '/vendor/autoload.php';
        $app = require_once $basePath . '/bootstrap/app.php';
        $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
        
        $commands = [
            'cache:clear',
            'config:clear',
            'view:clear',
            'route:clear',
            'optimize:clear'
        ];
        
        foreach ($commands as $cmd) {
            echo "Executing: artisan $cmd...\n";
            $kernel->call($cmd);
            echo $kernel->output() . "\n";
        }
    } else {
        echo "Could not find Laravel bootstrap files.\n";
    }
} catch (Throwable $e) {
    echo "Laravel Artisan Error: " . $e->getMessage() . "\n\n";
}

// ALWAYS forcefully delete cached files as a backup
echo "\nForcefully deleting cached views and config files...\n";
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
                @unlink($fileinfo->getRealPath());
                $deleted++;
            }
        }
        echo "Deleted $deleted files from $path\n";
    }
}

// Clear SQLite cache table
$dbPath = $basePath . '/database/database.sqlite';
if (file_exists($dbPath)) {
    try {
        $db = new PDO("sqlite:$dbPath");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $db->exec("DELETE FROM cache");
        echo "\nCleared database cache table directly.\n";
    } catch (Exception $e) {
        echo "\nCould not clear DB cache: " . $e->getMessage() . "\n";
    }
}

echo "\n========================================\n";
echo "🎉 SUCCESS! Cache cleared.\n";
echo "========================================\n";
echo "Please check your website now (you may need to hard refresh: Ctrl+F5).\n";
echo "</pre>";
