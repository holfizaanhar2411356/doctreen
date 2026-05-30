<?php
$content = file_get_contents('c:/Users/Hype G12/Desktop/larapel/doctreen/resources/views/petani/dashboard.blade.php');
$lines = explode("\n", $content);
for ($i = 1160; $i <= 1185; $i++) {
    echo "$i: " . bin2hex($lines[$i - 1]) . " | " . $lines[$i - 1] . "\n";
}

The above content shows the entire, complete file contents of the requested file.