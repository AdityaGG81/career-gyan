<?php
// Enable error reporting so we don't get a blank 500 screen
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$SECRET_KEY = 'CareerGyaan2026Update';
if (!isset($_GET['key']) || $_GET['key'] !== $SECRET_KEY) {
    http_response_code(403);
    die('Access denied.');
}

echo "<pre>";
echo "Starting MySQL database update (Raw PDO)...\n\n";

$basePath = realpath(__DIR__ . '/../repositories/career-gyan');
if (!$basePath) {
    $basePath = realpath(dirname(__DIR__));
}

$envFile = $basePath . '/.env';
if (!file_exists($envFile)) {
    die("Could not find .env file at $envFile");
}

echo "Found .env file at $envFile\n";

// Parse .env
$env = parse_ini_file($envFile);
if (!$env) {
    // If parse_ini_file fails, parse manually
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $env = [];
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            list($key, $val) = explode('=', $line, 2);
            $env[trim($key)] = trim($val, '"\'');
        }
    }
}

$host = $env['DB_HOST'] ?? '127.0.0.1';
$port = $env['DB_PORT'] ?? '3306';
$db = $env['DB_DATABASE'] ?? '';
$user = $env['DB_USERNAME'] ?? '';
$pass = $env['DB_PASSWORD'] ?? '';

if (empty($db) || empty($user)) {
    die("Database credentials not found in .env");
}

echo "Connecting to MySQL Database: $db on $host\n\n";

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $queries = [
        "UPDATE `colleges` SET `name` = REPLACE(`name`, 'Ahmadnagar', 'Ahilyanagar')",
        "UPDATE `colleges` SET `name` = REPLACE(`name`, 'Ahmednagar', 'Ahilyanagar')",
        "UPDATE `colleges` SET `name` = REPLACE(`name`, 'AHMADNAGAR', 'AHILYANAGAR')",
        "UPDATE `colleges` SET `name` = REPLACE(`name`, 'AHMEDNAGAR', 'AHILYANAGAR')",
        "UPDATE `colleges` SET `name` = REPLACE(`name`, 'ahmadnagar', 'ahilyanagar')",
        "UPDATE `colleges` SET `name` = REPLACE(`name`, 'ahmednagar', 'ahilyanagar')",
        
        "UPDATE `colleges` SET `name` = REPLACE(`name`, 'Osmanabad', 'Dharashiv')",
        "UPDATE `colleges` SET `name` = REPLACE(`name`, 'OSMANABAD', 'DHARASHIV')",
        "UPDATE `colleges` SET `name` = REPLACE(`name`, 'osmanabad', 'dharashiv')",
        
        "UPDATE `colleges` SET `name` = REPLACE(`name`, 'Aurangabad', 'Chhatrapati Sambhajinagar')",
        "UPDATE `colleges` SET `name` = REPLACE(`name`, 'AURANGABAD', 'CHHATRAPATI SAMBHAJINAGAR')",
        "UPDATE `colleges` SET `name` = REPLACE(`name`, 'aurangabad', 'chhatrapati sambhajinagar')",
        
        "UPDATE `colleges` SET `name` = REPLACE(`name`, 'North Maharashtra University', 'Kavayitri Bahinabai Chaudhari North Maharashtra University')",
        "UPDATE `colleges` SET `name` = REPLACE(`name`, 'north maharashtra university', 'Kavayitri Bahinabai Chaudhari North Maharashtra University')",
        
        "UPDATE `colleges` SET `location` = REPLACE(`location`, 'Osmanabad', 'Dharashiv')",
        "UPDATE `colleges` SET `description` = REPLACE(`description`, 'Osmanabad', 'Dharashiv')",
        
        "UPDATE `indian_colleges` SET `college_name` = REPLACE(`college_name`, 'Ahmadnagar', 'Ahilyanagar')",
        "UPDATE `indian_colleges` SET `college_name` = REPLACE(`college_name`, 'Ahmednagar', 'Ahilyanagar')",
        "UPDATE `indian_colleges` SET `college_name` = REPLACE(`college_name`, 'AHMADNAGAR', 'AHILYANAGAR')",
        "UPDATE `indian_colleges` SET `college_name` = REPLACE(`college_name`, 'AHMEDNAGAR', 'AHILYANAGAR')",
        
        "UPDATE `indian_colleges` SET `college_name` = REPLACE(`college_name`, 'Osmanabad', 'Dharashiv')",
        "UPDATE `indian_colleges` SET `college_name` = REPLACE(`college_name`, 'OSMANABAD', 'DHARASHIV')",
        "UPDATE `indian_colleges` SET `college_name` = REPLACE(`college_name`, 'osmanabad', 'dharashiv')",
        
        "UPDATE `indian_colleges` SET `college_name` = REPLACE(`college_name`, 'Aurangabad', 'Chhatrapati Sambhajinagar')",
        "UPDATE `indian_colleges` SET `college_name` = REPLACE(`college_name`, 'AURANGABAD', 'CHHATRAPATI SAMBHAJINAGAR')",
        "UPDATE `indian_colleges` SET `college_name` = REPLACE(`college_name`, 'aurangabad', 'chhatrapati sambhajinagar')",
        
        "UPDATE `indian_colleges` SET `college_name` = REPLACE(`college_name`, 'North Maharashtra University', 'Kavayitri Bahinabai Chaudhari North Maharashtra University')",
        "UPDATE `indian_colleges` SET `college_name` = REPLACE(`college_name`, 'north maharashtra university', 'Kavayitri Bahinabai Chaudhari North Maharashtra University')",
        
        "UPDATE `indian_colleges` SET `district` = REPLACE(`district`, 'Ahmadnagar', 'Ahilyanagar')",
        "UPDATE `indian_colleges` SET `district` = REPLACE(`district`, 'Ahmednagar', 'Ahilyanagar')",
        "UPDATE `indian_colleges` SET `district` = REPLACE(`district`, 'Osmanabad', 'Dharashiv')",
        "UPDATE `indian_colleges` SET `district` = REPLACE(`district`, 'Aurangabad', 'Chhatrapati Sambhajinagar')",
        
        "UPDATE `indian_colleges` SET `taluka` = REPLACE(`taluka`, 'Osmanabad', 'Dharashiv')",
        "UPDATE `indian_colleges` SET `taluka` = REPLACE(`taluka`, 'Aurangabad', 'Chhatrapati Sambhajinagar')",
        
        "UPDATE `indian_colleges` SET `university_name` = REPLACE(`university_name`, 'Ahmednagar', 'Ahilyanagar')",
        "UPDATE `indian_colleges` SET `university_name` = REPLACE(`university_name`, 'Aurangabad', 'Chhatrapati Sambhajinagar')",
        "UPDATE `indian_colleges` SET `university_name` = REPLACE(`university_name`, 'AURANGABAD', 'CHHATRAPATI SAMBHAJINAGAR')",
        "UPDATE `indian_colleges` SET `university_name` = REPLACE(`university_name`, 'North Maharashtra University', 'Kavayitri Bahinabai Chaudhari North Maharashtra University')",
        "UPDATE `indian_colleges` SET `university_name` = REPLACE(`university_name`, 'north maharashtra university', 'Kavayitri Bahinabai Chaudhari North Maharashtra University')",
    ];
    
    $totalUpdated = 0;
    foreach ($queries as $query) {
        // Only run on table if it exists
        $stmt = $pdo->query($query);
        $updated = $stmt->rowCount();
        if ($updated > 0) {
            echo "✅ Executed: " . substr($query, 0, 80) . "...\n   -> Rows affected: $updated\n";
            $totalUpdated += $updated;
        }
    }
    
    echo "\n========================================\n";
    echo "🎉 SUCCESS! Total rows updated: $totalUpdated\n";
    echo "========================================\n";
    
} catch (PDOException $e) {
    echo "PDO Error: " . $e->getMessage() . "\n";
}

echo "\n⚠️ IMPORTANT: Delete this file from your server when finished!\n";
echo "</pre>";
