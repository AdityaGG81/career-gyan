<?php

// Find autoload.php
$autoloadPaths = [
    __DIR__.'/../vendor/autoload.php',
    __DIR__.'/../repositories/career-gyan/vendor/autoload.php',
];

$autoload = null;
foreach ($autoloadPaths as $path) {
    if (file_exists($path)) {
        $autoload = $path;
        break;
    }
}

if (!$autoload) {
    die("Could not find autoload.php. Checked:<br>" . implode("<br>", $autoloadPaths));
}

require $autoload;

// Find app.php
$appPaths = [
    __DIR__.'/../bootstrap/app.php',
    __DIR__.'/../repositories/career-gyan/bootstrap/app.php',
];

$appFile = null;
foreach ($appPaths as $path) {
    if (file_exists($path)) {
        $appFile = $path;
        break;
    }
}

if (!$appFile) {
    die("Could not find bootstrap/app.php. Checked:<br>" . implode("<br>", $appPaths));
}

$app = require_once $appFile;

use Illuminate\Contracts\Console\Kernel;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\BufferedOutput;

$kernel = $app->make(Kernel::class);

function runCommand($kernel, $commandName) {
    $output = new BufferedOutput();
    try {
        $status = $kernel->handle(new StringInput($commandName), $output);
        return "[" . $commandName . "] (status: $status) " . nl2br(e($output->fetch()));
    } catch (\Exception $e) {
        return "[" . $commandName . "] Error: " . $e->getMessage();
    }
}

echo "<h3>Clearing Laravel Caches</h3>";
echo runCommand($kernel, 'config:clear') . "<br>";
echo runCommand($kernel, 'route:clear') . "<br>";
echo runCommand($kernel, 'cache:clear') . "<br>";
echo runCommand($kernel, 'view:clear') . "<br>";

echo "<h3>Running Database Migrations</h3>";
echo runCommand($kernel, 'migrate --force') . "<br>";

echo "<h3>Ensuring Upload Directories Exist</h3>";
$uploadsDir = __DIR__ . '/uploads/jobs';
if (!is_dir($uploadsDir)) {
    if (mkdir($uploadsDir, 0755, true)) {
        echo "✅ Created: public/uploads/jobs/<br>";
    } else {
        echo "❌ Failed to create: public/uploads/jobs/<br>";
    }
} else {
    echo "✅ Already exists: public/uploads/jobs/<br>";
}

echo "<h4>Done! All caches cleared, migrations run, and directories verified.</h4>";
echo "<p>Please delete this file (<code>public_html/clear-cache.php</code>) from your hosting server via cPanel for security reasons once you're done.</p>";

