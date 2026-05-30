<?php
$content = file_get_contents('c:/Users/Hype G12/Desktop/larapel/doctreen/resources/views/petani/dashboard.blade.php');
// Find <style> and </style>
$start = strpos($content, '<style>');
$end = strpos($content, '</style>');
if ($start !== false && $end !== false) {
    $styleBlock = substr($content, $start, $end - $start + 8);
    // Find all '<' characters in the style block, except the opening <style>
    $offset = 7; // after <style>
    while (($pos = strpos($styleBlock, '<', $offset)) !== false) {
        $snippet = substr($styleBlock, max(0, $pos - 20), 50);
        echo "Found '<' at position " . ($start + $pos) . " (line " . (substr_count(substr($content, 0, $start + $pos), "\n") + 1) . "): \n";
        echo "Snippet: " . trim($snippet) . "\n\n";
        $offset = $pos + 1;
    }
} else {
    echo "Style block not found\n";
}

The above content shows the entire, complete file contents of the requested file.