<?php
$dir = new RecursiveDirectoryIterator('c:/Users/Hype G12/Desktop/larapel/doctreen/resources/views');
foreach (new RecursiveIteratorIterator($dir) as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        if (preg_match('/margin-top:\s*s\s*0\.9s/i', $content, $m)) {
            echo "MATCH in " . $file->getPathname() . "\n";
        }
        if (strpos($content, 's 0.9s') !== false) {
            echo "s 0.9s literal MATCH in " . $file->getPathname() . "\n";
        }
    }
}
echo "Search completed.\n";

The above content shows the entire, complete file contents of the requested file.