<?php
// EMERGENCY DEBUG - Will show ALL errors
header('Content-Type: text/html; charset=utf-8');

// Force ALL error reporting
error_reporting(-1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
ini_set('log_errors', '1');

echo "<!DOCTYPE html><html><head><title>EMERGENCY DEBUG</title>";
echo "<style>body{font-family:monospace;background:#000;color:#0f0;padding:20px;}</style>";
echo "</head><body>";
echo "<h1>🚨 EMERGENCY PHP DEBUG 🚨</h1>";

// Test 1: Basic PHP
echo "<h2>✓ Test 1: PHP is running</h2>";
echo "PHP Version: " . phpversion() . "<br>";

// Test 2: Current directory and files
echo "<h2>📁 Test 2: Current Directory</h2>";
echo "Script: " . __FILE__ . "<br>";
echo "Dir: " . __DIR__ . "<br>";
echo "Document Root: " . ($_SERVER['DOCUMENT_ROOT'] ?? 'NOT SET') . "<br>";

// Test 3: List files
echo "<h2>📄 Test 3: Files in this directory</h2>";
$files = scandir(__DIR__);
echo "<pre>";
foreach ($files as $file) {
    if ($file !== '.' && $file !== '..') {
        $size = filesize(__DIR__ . '/' . $file);
        echo str_pad($file, 30) . " - " . number_format($size) . " bytes<br>";
    }
}
echo "</pre>";

// Test 4: Try to include your files
echo "<h2>🔗 Test 4: Include Your Files</h2>";

$filesToTest = [
    'autoload.php' => __DIR__ . '/../autoload.php',
    'Routing.php' => __DIR__ . '/../Routing/Routing.php',
    'routes.php' => __DIR__ . '/../Routing/routes.php',
    'personController.php' => __DIR__ . '/../Controllers/personController.php'
];

foreach ($filesToTest as $name => $path) {
    echo "<strong>$name:</strong> ";
    if (file_exists($path)) {
        echo "<span style='color:#0f0'>EXISTS</span> at: $path<br>";
        
        // Try to include it
        try {
            if ($name === 'autoload.php') {
                require_once $path;
                echo "<span style='color:#0f0'>✓ Included successfully</span><br>";
            }
        } catch (Exception $e) {
            echo "<span style='color:#f00'>✗ Error including: " . $e->getMessage() . "</span><br>";
        }
    } else {
        echo "<span style='color:#f00'>NOT FOUND</span> (looking at: $path)<br>";
    }
    echo "<br>";
}

// Test 5: Try your actual index.php logic
echo "<h2>🎯 Test 5: Your Router Logic</h2>";
try {
    // Manually load what your index.php does
    if (file_exists(__DIR__ . '/../autoload.php') && 
        file_exists(__DIR__ . '/../Routing/Routing.php') &&
        file_exists(__DIR__ . '/../Routing/routes.php')) {
        
        echo "✓ All required files exist<br>";
        
        // Try to require them
        require_once __DIR__ . '/../autoload.php';
        echo "✓ autoload.php loaded<br>";
        
        require_once __DIR__ . '/../Routing/Routing.php';
        echo "✓ Routing.php loaded<br>";
        
        // Create router
        $router = Routing::load(__DIR__ . '/../Routing/routes.php');
        echo "✓ Router created<br>";
        
        // Test a route
        $uri = '/';
        $method = 'GET';
        try {
            [$action, $params] = $router->direct($uri, $method);
            echo "<span style='color:#0f0'>✓ Route '/' works! Calls: $action</span><br>";
        } catch (Exception $e) {
            echo "<span style='color:#f00'>✗ Route error: " . $e->getMessage() . "</span><br>";
        }
    }
} catch (Throwable $e) {
    echo "<div style='background:#f00;color:#fff;padding:10px;margin:10px;'>";
    echo "<strong>FATAL ERROR:</strong><br>";
    echo "Message: " . $e->getMessage() . "<br>";
    echo "File: " . $e->getFile() . "<br>";
    echo "Line: " . $e->getLine() . "<br>";
    echo "Trace: <pre>" . $e->getTraceAsString() . "</pre>";
    echo "</div>";
}

// Test 6: Server variables
echo "<h2>🖥️ Test 6: Server Info</h2>";
echo "<pre>";
$safeVars = [
    'PHP_SELF', 'SCRIPT_NAME', 'REQUEST_URI', 'DOCUMENT_ROOT',
    'SERVER_SOFTWARE', 'SERVER_NAME', 'SCRIPT_FILENAME'
];
foreach ($safeVars as $var) {
    if (isset($_SERVER[$var])) {
        echo str_pad($var, 20) . ": " . $_SERVER[$var] . "\n";
    }
}
echo "</pre>";

echo "<hr>";
echo "<h2>🛠️ Quick Fixes to Try:</h2>";
echo "<ol>";
echo "<li>Check all required files exist (see above)</li>";
echo "<li>File paths might be wrong - check case sensitivity</li>";
echo "<li>PHP might have errors - check C:\\laragon\\logs\\php_errors.log</li>";
echo "<li>Try accessing: http://istichara.test/EMERGENCY-DEBUG.php</li>";
echo "</ol>";

echo "</body></html>";
