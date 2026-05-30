<?php
$content = file_get_contents('c:/Users/Hype G12/Desktop/larapel/doctreen/resources/views/petani/dashboard.blade.php');
$lines = explode("\n", $content);
foreach ($lines as $i => $line) {
    if (stripos($line, '<style') !== false || stripos($line, '</style') !== false) {
        echo "Line " . ($i + 1) . ": " . trim($line) . "\n";
    }
}

The above content shows the entire, complete file contents of the requested file.