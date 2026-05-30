<?php
$content = file_get_contents('c:/Users/Hype G12/Desktop/larapel/doctreen/resources/views/petani/dashboard.blade.php');
$start = strpos($content, '<style>');
$end = strpos($content, '</style>');
if ($start !== false && $end !== false) {
    $styleBlock = substr($content, $start, $end - $start + 8);
    $chars = str_split($styleBlock);
    $depth = 0;
    $lineNum = substr_count(substr($content, 0, $start), "\n") + 1;
    $currLine = $lineNum;
    
    foreach ($chars as $pos => $ch) {
        if ($ch === "\n") {
            $currLine++;
        }
        if ($ch === '{') {
            $depth++;
        }
        if ($ch === '}') {
            $depth--;
            if ($depth < 0) {
                echo "Unmatched closing brace '}' at position " . ($start + $pos) . " (line $currLine)\n";
                $depth = 0;
            }
        }
    }
    if ($depth > 0) {
        echo "Style block ends with unclosed opening braces. Depth: $depth\n";
    } else {
        echo "Braces are perfectly balanced!\n";
    }
}
