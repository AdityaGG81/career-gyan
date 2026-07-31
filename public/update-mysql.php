<?php
/**
 * One-time script to update district and university names on the live MySQL database.
 * Visit: https://yoursite.com/update-mysql.php?key=CareerGyaan2026Update
 */

$SECRET_KEY = 'CareerGyaan2026Update';

if (!isset($_GET['key']) || $_GET['key'] !== $SECRET_KEY) {
    http_response_code(403);
    die('Access denied.');
}

echo "<pre>";
echo "Starting MySQL database update...\n\n";

// Find the base path
$basePath = realpath(__DIR__ . '/../repositories/career-gyan');
if (!$basePath) {
    $basePath = realpath(dirname(__DIR__));
}

try {
    if (file_exists($basePath . '/vendor/autoload.php') && file_exists($basePath . '/bootstrap/app.php')) {
        echo "Bootstrapping Laravel to connect to the correct database...\n";
        require $basePath . '/vendor/autoload.php';
        $app = require_once $basePath . '/bootstrap/app.php';
        $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
        $kernel->bootstrap();
        
        $connection = env('DB_CONNECTION', 'mysql');
        $dbName = env('DB_DATABASE', 'unknown');
        echo "Connected using: $connection\n";
        echo "Database Name: $dbName\n\n";
        
        use Illuminate\Support\Facades\DB;
        
        // Define all update queries
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
            $updated = DB::update($query);
            if ($updated > 0) {
                echo "✅ Executed: $query\n   -> Rows affected: $updated\n";
                $totalUpdated += $updated;
            }
        }
        
        echo "\n========================================\n";
        echo "🎉 SUCCESS! Total rows updated: $totalUpdated\n";
        echo "========================================\n";
        
        // Also clear cache just in case
        echo "\nClearing cache...\n";
        try {
            $kernel->call('cache:clear');
            echo "Cache cleared!\n";
        } catch (\Exception $e) {
            echo "Notice: Could not clear cache via artisan: " . $e->getMessage() . "\n";
        }
        
    } else {
        echo "Could not find Laravel bootstrap files.\n";
    }
} catch (Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n\n";
}

echo "\n⚠️ IMPORTANT: Delete this file (update-mysql.php) from your server now!\n";
echo "</pre>";
