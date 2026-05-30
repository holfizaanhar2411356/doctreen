<?php
$path = 'c:/Users/Hype G12/Desktop/larapel/doctreen/resources/views/admin/dashboard.blade.php';
if (!file_exists($path)) {
    echo "File does not exist\n";
    exit;
}
$content = file_get_contents($path);
echo "Size: " . strlen($content) . "\n";
echo "First 200 chars: " . substr($content, 0, 200) . "\n";

The above content shows the entire, complete file contents of the requested file.