<?php
$dir = 'resources/views/colleges';
$files = scandir($dir);
foreach ($files as $file) {
    if (str_ends_with($file, '.blade.php')) {
        $content = file_get_contents("$dir/$file");
        // Search for function open...Details
        if (preg_match('/function\s+(open[A-Za-z0-9_]*Details)\s*\(\s*([A-Za-z0-9_]+)\s*\)/i', $content, $matches)) {
            $funcName = $matches[1];
            echo "$file: Function: $funcName";
            // Search for modal ID
            if (preg_match('/document\.getElementById\(\'([A-Za-z0-9_-]+Modal)\'\)/i', $content, $mModal)) {
                echo ", Modal: " . $mModal[1];
            } else if (preg_match('/[\'"]#([A-Za-z0-9_-]+Modal)[\'"]/i', $content, $mModal)) {
                echo ", Modal: " . $mModal[1];
            }
            echo "\n";
        } else {
            echo "$file: No details function found.\n";
        }
    }
}
