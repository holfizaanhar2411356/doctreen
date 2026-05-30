<?php
$content = file_get_contents('c:/Users/Hype G12/Desktop/larapel/doctreen/resources/views/petani/dashboard.blade.php');
$lines = explode("\n", $content);
foreach ($lines as $i => $line) {
    if (strpos($line, 's 0.9s') !== false) {
        echo "Line " . ($i + 1) . ": " . trim($line) . "\n";
        echo "Surrounding context:\n";
        for ($j = max(0, $i - 3); $j <= min(count($lines) - 1, $i + 3); $j++) {
            echo "  " . ($j + 1) . ": " . $lines[$j] . "\n";
        }
        echo "\n";
    }
}

The above content shows the entire, complete file contents of the requested file.