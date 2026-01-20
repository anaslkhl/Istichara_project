<?php
// Test accessing files directly (bypassing router)
echo "<h1>Direct File Access Test</h1>";

// What file are we trying to access?
$requested = $_GET['file'] ?? 'autoload.php';
$base = __DIR__ . '/../';

echo "<h2>Testing: $requested</h2>";

// Common files to test
$testFiles = [
    'autoload.php',
    'Routing/Routing.php', 
    'Routing/routes.php',
    'Controllers/personController.php',
    'Services/personService.php',
    'Repository/personRepository.php'
];

echo "<form method='GET'>";
echo "Test file: <select name='file'>";
foreach ($testFiles as $file) {
    $selected = ($file === $requested) ? 'selected' : '';
    echo "<option value='$file' $selected>$file</option>";
}
echo "</select>";
echo "<input type='submit' value='Test'>";
echo "</form>";

$filePath = $base . $requested;
echo "<h3>Path: $filePath</h3>";

if (file_exists($filePath)) {
    echo "<div style='background:#dfd;padding:10px;'>";
    echo "✓ FILE EXISTS<br>";
    echo "Size: " . filesize($filePath) . " bytes<br>";
    echo "Last modified: " . date('Y-m-d H:i:s', filemtime($filePath)) . "<br>";
    
    // Try to read first few lines
    $content = file_get_contents($filePath, false, null, 0, 500);
    echo "<pre>" . htmlspecialchars($content) . "...</pre>";
    
    echo "</div>";
} else {
    echo "<div style='background:#fdd;padding:10px;'>";
    echo "✗ FILE NOT FOUND<br>";
    echo "Looking in: " . realpath($base) . "<br>";
    
    // List what IS there
    $dir = dirname($filePath);
    if (is_dir($dir)) {
        echo "Files in " . basename($dir) . ":<br>";
        $files = scandir($dir);
        echo "<ul>";
        foreach ($files as $f) {
            if ($f !== '.' && $f !== '..') {
                $full = $dir . '/' . $f;
                echo "<li>$f - " . (is_dir($full) ? "DIR" : "FILE") . "</li>";
            }
        }
        echo "</ul>";
    }
    echo "</div>";
}

echo "<hr>";
echo "<h2>Quick Navigation:</h2>";
echo "<ul>";
foreach ($testFiles as $file) {
    echo "<li><a href='?file=" . urlencode($file) . "'>Test $file</a></li>";
}
echo "</ul>";
