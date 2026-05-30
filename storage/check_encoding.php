<?php
$content = file_get_contents('c:/Users/Hype G12/Desktop/larapel/doctreen/resources/views/admin/dashboard.blade.php');
echo "Is UTF-16? " . (strpos($content, "\0") !== false ? "Yes" : "No") . "\n";
echo "Length: " . strlen($content) . "\n";

The above content shows the entire, complete file contents of the requested file.