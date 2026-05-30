<?php
$content = file_get_contents('c:/Users/Hype G12/Desktop/larapel/doctreen/resources/views/admin/dashboard.blade.php');
$lines = explode("\n", $content);
foreach ($lines as $i => $line) {
    if (strpos($line, '@foreach') !== false) {
        echo "Line " . ($i + 1) . ": " . trim($line) . "\n";
    }
}
