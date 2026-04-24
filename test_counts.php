<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$dimensionLimits = [
    'language-aptitude' => 5,
    'verbal-reasoning' => 5,
    'numerical-aptitude' => 5,
    'perceptual-aptitude' => 10,
    'abstract-reasoning' => 5,
    'mechanical-reasoning' => 5,
    'spatial-aptitude' => 5,
];

$dimensions = App\Models\Dimension::all();

$questions = [];
foreach ($dimensions as $dim) {
    $limit = $dimensionLimits[$dim->slug] ?? 5;
    $dimQuestions = $dim->questions()->inRandomOrder()->take($limit)->get();
    
    echo $dim->slug . " fetched: " . $dimQuestions->count() . "\n";
    foreach ($dimQuestions as $q) {
        $questions[] = $q;
    }
}
echo "Total: " . count($questions) . "\n";
