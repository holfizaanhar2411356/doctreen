<?php
$content = file_get_contents('resources/views/petani/dashboard.blade.php');
$startPos = strpos($content, '<style>');
$endPos = strpos($content, '</style>');

if ($startPos === false || $endPos === false) {
    die("Style block not found\n");
}

$styleBlock = substr($content, $startPos + 7, $endPos - $startPos - 7);

$lines = explode("\n", $styleBlock);
foreach ($lines as $i => $line) {
    if (strpos($line, '{{') !== false || strpos($line, '{!!') !== false) {
        echo "Line " . ($i + 9) . ": " . trim($line) . "\n";
    }
}
echo "Done searching.\n";
