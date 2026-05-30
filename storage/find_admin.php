<?php
$content = file_get_contents('c:/Users/Hype G12/Desktop/larapel/doctreen/resources/views/admin/dashboard.blade.php');
$lines = explode("\n", $content);
foreach ($lines as $i => $line) {
    if (stripos($line, 'konsultan') !== false || stripos($line, 'status') !== false || stripos($line, 'pending') !== false) {
        if ($i < 1000) {
            echo "Line " . ($i + 1) . ": " . trim($line) . "\n";
        }
    }
}

The above content shows the entire, complete file contents of the requested file.