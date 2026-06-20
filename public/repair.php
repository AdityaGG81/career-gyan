<?php
// SELF-HEALING REPAIR SCRIPT
// Reads the old bootstrap cache to recover DB credentials automatically
// Visit: https://careergyan.in/repair.php

$envPaths = [
    dirname(__DIR__) . '/repositories/career-gyan/.env',
    dirname(__DIR__) . '/.env',
    __DIR__ . '/../.env',
];

$cachePaths = [
    dirname(__DIR__) . '/repositories/career-gyan/bootstrap/cache/config.php',
    dirname(__DIR__) . '/bootstrap/cache/config.php',
    __DIR__ . '/../bootstrap/cache/config.php',
];

// Find .env
$envPath = null;
foreach ($envPaths as $p) {
    if (file_exists(dirname($p))) { $envPath = $p; break; }
}

// Try to read bootstrap cache for credentials
$cachedConfig = null;
foreach ($cachePaths as $p) {
    if (file_exists($p)) {
        try {
            $cachedConfig = include($p);
        } catch(\Throwable $e) {}
        if (is_array($cachedConfig)) break;
    }
}

// Extract DB credentials from cache
$dbFromCache = [];
if ($cachedConfig && isset($cachedConfig['database']['connections'])) {
    $conns = $cachedConfig['database']['connections'];
    foreach (['mysql', 'sqlite', 'pgsql'] as $driver) {
        if (!empty($conns[$driver]['database'])) {
            $dbFromCache['connection'] = $driver;
            $dbFromCache['host']     = $conns[$driver]['host'] ?? 'localhost';
            $dbFromCache['port']     = $conns[$driver]['port'] ?? '3306';
            $dbFromCache['database'] = $conns[$driver]['database'];
            $dbFromCache['username'] = $conns[$driver]['username'] ?? '';
            $dbFromCache['password'] = $conns[$driver]['password'] ?? '';
            break;
        }
    }
    // Also check default connection
    if (empty($dbFromCache) && isset($cachedConfig['database']['default'])) {
        $default = $cachedConfig['database']['default'];
        if (!empty($conns[$default])) {
            $dbFromCache['connection'] = $default;
            $dbFromCache['host']     = $conns[$default]['host'] ?? 'localhost';
            $dbFromCache['port']     = $conns[$default]['port'] ?? '3306';
            $dbFromCache['database'] = $conns[$default]['database'] ?? '';
            $dbFromCache['username'] = $conns[$default]['username'] ?? '';
            $dbFromCache['password'] = $conns[$default]['password'] ?? '';
        }
    }
}

// Get mail from cache too
$mailFromCache = [];
if ($cachedConfig && isset($cachedConfig['mail'])) {
    $mailers = $cachedConfig['mail']['mailers'] ?? [];
    $smtp = $mailers['smtp'] ?? [];
    $mailFromCache = [
        'host'     => $smtp['host'] ?? 'smtp.gmail.com',
        'port'     => $smtp['port'] ?? '587',
        'username' => $cachedConfig['mail']['from']['address'] ?? 'ffczmy26@gmail.com',
        'from'     => $cachedConfig['mail']['from']['address'] ?? 'ffczmy26@gmail.com',
        'from_name'=> $cachedConfig['mail']['from']['name'] ?? 'CareerGyan',
    ];
    if (isset($smtp['username'])) $mailFromCache['username'] = $smtp['username'];
}

// Auto-fix if cache found with DB info
$autoFixed = false;
$fixLog = [];

if (!empty($dbFromCache['database']) && $envPath) {
    $db = $dbFromCache;
    
    $newEnv = 'APP_NAME=CareerGyan
APP_ENV=production
APP_KEY=base64:qDwI7vvz5XdwzEkcAJXt4KeoUYwdmYoPtr87g0Byw2M=
APP_DEBUG=false
APP_URL=https://careergyan.in

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

AICREDITS_BASE_URL=https://api.aicredits.in/v1
AICREDITS_API_KEY=
AICREDITS_MODEL=openai/gpt-4.1-mini

DB_CONNECTION=' . ($db['connection'] ?? 'mysql') . '
DB_HOST=' . ($db['host'] ?? 'localhost') . '
DB_PORT=' . ($db['port'] ?? '3306') . '
DB_DATABASE=' . ($db['database']) . '
DB_USERNAME=' . ($db['username']) . '
DB_PASSWORD=' . ($db['password']) . '

SESSION_DRIVER=file
SESSION_LIFETIME=180
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database

MAIL_MAILER=smtp
MAIL_SCHEME=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=ffczmy26@gmail.com
MAIL_PASSWORD="bama juuw acix bpzw"
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=ffczmy26@gmail.com
MAIL_FROM_NAME="CareerGyan"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="CareerGyan"
';

    if (file_put_contents($envPath, $newEnv)) {
        $autoFixed = true;
        $fixLog[] = "✅ .env written successfully";
        
        // Clear all bootstrap cache
        $cacheDir = dirname($envPath) . '/bootstrap/cache/';
        if (is_dir($cacheDir)) {
            foreach (glob($cacheDir . '*.php') as $f) {
                unlink($f);
                $fixLog[] = "🗑️ Cleared: " . basename($f);
            }
        }
        
        // Clear storage/framework caches
        $frameworkCaches = [
            dirname($envPath) . '/storage/framework/cache/data/',
            dirname($envPath) . '/storage/framework/sessions/',
            dirname($envPath) . '/storage/framework/views/',
        ];
        foreach ($frameworkCaches as $dir) {
            if (is_dir($dir)) {
                foreach (glob($dir . '*') as $f) {
                    if (is_file($f)) { unlink($f); }
                }
                $fixLog[] = "🗑️ Cleared cache dir: " . basename(dirname($dir)) . '/' . basename($dir);
            }
        }
    } else {
        $fixLog[] = "❌ Could not write .env (permission denied)";
    }
}

header('Content-Type: text/html; charset=utf-8');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>CareerGyan - Site Repair</title>
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: 'Segoe UI', sans-serif; background: #0f0f0f; color: #e0e0e0; padding: 40px 20px; }
  .card { max-width: 700px; margin: 0 auto; background: #1a1a2e; border-radius: 12px; padding: 30px; border: 1px solid #333; }
  h1 { font-size: 22px; color: #4fc3f7; margin-bottom: 20px; }
  h2 { font-size: 18px; margin: 20px 0 10px; }
  .ok   { color: #69f0ae; }
  .bad  { color: #ff5252; }
  .warn { color: #ffab40; }
  .info { color: #4fc3f7; }
  pre, code { background: #000; padding: 12px; border-radius: 6px; display: block; margin: 10px 0; font-size: 13px; line-height: 1.6; overflow-x: auto; }
  .badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 13px; font-weight: bold; }
  .badge-ok  { background: #1b5e20; color: #69f0ae; }
  .badge-bad { background: #b71c1c; color: #ff8a80; }
  a { color: #4fc3f7; }
  .big-btn { display: inline-block; margin-top: 20px; padding: 14px 30px; background: #00c853; color: #000; border-radius: 8px; font-size: 16px; font-weight: bold; text-decoration: none; }
  hr { border-color: #333; margin: 25px 0; }
</style>
</head>
<body>
<div class="card">
  <h1>🔧 CareerGyan Emergency Repair</h1>

  <?php if ($autoFixed): ?>
  <p><span class="badge badge-ok">✅ FIXED AUTOMATICALLY</span></p>
  <br>
  <p class="ok"><strong>Database credentials were recovered from server cache and .env has been restored!</strong></p>
  <pre><?= implode("\n", $fixLog) ?></pre>
  <p>DB found: <strong><?= htmlspecialchars($dbFromCache['connection'] . '://' . $dbFromCache['username'] . '@' . $dbFromCache['host'] . '/' . $dbFromCache['database']) ?></strong></p>
  <a class="big-btn" href="/">🏠 Go to Homepage</a>
  <hr>
  <p class="bad"><strong>⚠️ IMPORTANT: Delete repair.php from the server after this!</strong><br>Push an empty commit or ask someone to remove <code>public/repair.php</code> via FTP.</p>

  <?php elseif (!empty($dbFromCache)): ?>
  <p><span class="badge badge-bad">⚠️ PARTIAL - Could not write .env</span></p>
  <p>Found DB credentials in cache but couldn't write the .env file. Permission issue.</p>
  <p>Please create the file manually with this content:</p>
  <pre><?= htmlspecialchars('DB_DATABASE=' . ($dbFromCache['database'] ?? '') . "\nDB_USERNAME=" . ($dbFromCache['username'] ?? '') . "\nDB_HOST=" . ($dbFromCache['host'] ?? '')) ?></pre>

  <?php else: ?>
  <p><span class="badge badge-bad">❌ Cache Not Found</span></p>
  <p class="warn">Could not auto-detect DB credentials (bootstrap cache was already cleared).</p>
  
  <hr>
  <h2 class="info">📋 Current .env on server:</h2>
  <?php if ($envPath && file_exists($envPath)): ?>
  <pre><?php
    $env = file_get_contents($envPath);
    // Show only non-sensitive parts
    $lines = explode("\n", $env);
    foreach ($lines as $line) {
        $line = trim($line);
        if (stripos($line, 'PASSWORD') !== false || stripos($line, 'SECRET') !== false || stripos($line, 'APP_KEY') !== false) {
            $parts = explode('=', $line, 2);
            echo htmlspecialchars($parts[0] . '=' . (isset($parts[1]) && $parts[1] ? '[SET]' : '[EMPTY]')) . "\n";
        } else {
            echo htmlspecialchars($line) . "\n";
        }
    }
  ?></pre>
  <?php else: ?>
  <p class="bad">No .env file found.</p>
  <?php endif; ?>

  <hr>
  <h2 class="warn">⚡ Quick Options:</h2>
  <p>1. <strong>Check your hosting email</strong> — when the database was created, credentials were emailed to you.</p>
  <p>2. <strong>Check GitHub Secrets</strong> — go to GitHub repo → Settings → Secrets → see if DB credentials are saved.</p>
  <p>3. <strong>Ask your hosting provider</strong> — they can tell you or reset your DB password.</p>
  
  <?php endif; ?>

  <hr>
  <p style="font-size:12px;color:#666">Repair script by CareerGyan emergency system. Remove after use.</p>
</div>
</body>
</html>
