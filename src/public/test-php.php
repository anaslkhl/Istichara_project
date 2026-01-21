<?php
// Simple PHP test
echo "<h1>PHP Test Page</h1>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>If you see this, PHP is working!</p>";

// Test basic functions
echo "<h2>System Info:</h2>";
echo "<pre>";
echo "Server: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'N/A') . "\n";
echo "Document Root: " . ($_SERVER['DOCUMENT_ROOT'] ?? 'N/A') . "\n";
echo "Script: " . __FILE__ . "\n";

// Check if we can include files
echo "\n=== File Include Test ===\n";
if (file_exists(__DIR__ . '/../autoload.php')) {
    echo "autoload.php: EXISTS\n";
} else {
    echo "autoload.php: NOT FOUND\n";
}

if (file_exists(__DIR__ . '/../Routing/Routing.php')) {
    echo "Routing.php: EXISTS\n";
} else {
    echo "Routing.php: NOT FOUND\n";
}
echo "</pre>";

echo '<p><a href="/">Test router</a></p>';
