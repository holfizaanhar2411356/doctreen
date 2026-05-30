<?php
$content = file_get_contents('c:/Users/Hype G12/Desktop/larapel/doctreen/resources/views/petani/dashboard.blade.php');
$lines = explode("\n", $content);
foreach ($lines as $i => $line) {
    if (strpos($line, 'style=') !== false && strpos($line, '0.9s') !== false) {
        echo "Line " . ($i + 1) . ": " . trim($line) . "\n";
    }
}
echo "Done.\n";
