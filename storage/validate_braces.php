<?php
$content = file_get_contents('resources/views/konsultan/dashboard.blade.php');
$startPos = strpos($content, '<style>');
$endPos = strpos($content, '</style>');

if ($startPos === false || $endPos === false) {
    die("Style block not found\n");
}

$styleBlock = substr($content, $startPos + 7, $endPos - $startPos - 7);

$len = strlen($styleBlock);
$depth = 0;
$braces = [];
$inString = false;
$stringChar = '';

for ($i = 0; $i < $len; $i++) {
    $char = $styleBlock[$i];
    if ($char === '{') {
        $depth++;
        $braces[] = ['type' => 'open', 'pos' => $i, 'line' => substr_count(substr($styleBlock, 0, $i), "\n") + 9];
    } elseif ($char === '}') {
        $depth--;
        $braces[] = ['type' => 'close', 'pos' => $i, 'line' => substr_count(substr($styleBlock, 0, $i), "\n") + 9];
    }
}

echo "Total braces count: " . count($braces) . "\n";
echo "Final depth: " . $depth . "\n";

// Trace unmatched braces
$stack = [];
foreach ($braces as $brace) {
    if ($brace['type'] === 'open') {
        $stack[] = $brace;
    } else {
        if (empty($stack)) {
            echo "Unmatched CLOSE brace at line " . $brace['line'] . "\n";
        } else {
            array_pop($stack);
        }
    }
}

foreach ($stack as $unmatched) {
    echo "Unmatched OPEN brace at line " . $unmatched['line'] . "\n";
}

The above content shows the entire, complete file contents of the requested file.