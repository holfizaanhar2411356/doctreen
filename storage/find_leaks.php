<?php
$content = file_get_contents('c:/Users/Hype G12/Desktop/larapel/doctreen/resources/views/petani/dashboard.blade.php');
$lines = explode("\n", $content);

// We want to find any occurrence of "margin-top:" or "s 0.9s; }" that is not inside <style>...</style>
$inStyle = false;
foreach ($lines as $i => $line) {
    if (strpos($line, '<style>') !== false) {
        $inStyle = true;
    }
    if (strpos($line, '</style>') !== false) {
        $inStyle = false;
    }
    if (!$inStyle) {
        if (strpos($line, 'margin-top') !== false && strpos($line, 'style=') === false) {
            echo "Line " . ($i + 1) . " (not in style/style-attr): " . trim($line) . "\n";
        }
        if (strpos($line, '0.9s') !== false) {
            echo "Line " . ($i + 1) . " has 0.9s (not in style): " . trim($line) . "\n";
        }
    }
}

The above content shows the entire, complete file contents of the requested file.