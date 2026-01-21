<?php
// Test if Apache is routing correctly
echo "<h1>Apache Routing Test</h1>";

// Check if we're coming through index.php
$isIndex = (basename($_SERVER['SCRIPT_FILENAME'] ?? '') === 'index.php');

echo "<p>Current file: " . basename($_SERVER['SCRIPT_FILENAME'] ?? 'N/A') . "</p>";
echo "<p>Is index.php: " . ($isIndex ? '✅ YES' : '❌ NO') . "</p>";

if (!$isIndex) {
    echo "<h2 style='color:red;'>PROBLEM!</h2>";
    echo "<p>Apache is NOT routing through index.php!</p>";
    echo "<p>This means .htaccess is not working.</p>";
    
    echo "<h3>Check these:</h3>";
    echo "<ol>";
    echo "<li>.htaccess exists in public/ folder</li>";
    echo "<li>mod_rewrite is enabled in Laragon</li>";
    echo "<li>AllowOverride is set to All in Apache config</li>";
    echo "</ol>";
    
    echo "<h3>Current .htaccess content:</h3>";
    if (file_exists(__DIR__ . '/.htaccess')) {
        echo "<pre>" . htmlspecialchars(file_get_contents(__DIR__ . '/.htaccess')) . "</pre>";
    } else {
        echo "<p style='color:red;'>❌ .htaccess NOT FOUND at: " . __DIR__ . "/.htaccess</p>";
    }
} else {
    echo "<h2 style='color:green;'>✅ SUCCESS!</h2>";
    echo "<p>Apache is routing correctly through index.php</p>";
}

echo "<hr>";
echo "<h2>Test Your Routes:</h2>";
echo '<ul>';
echo '<li><a href="/">Home</a></li>';
echo '<li><a href="/dashboard">Dashboard</a></li>';
echo '<li><a href="/professionals">Professionals</a></li>';
echo '<li><a href="/?debug=1">Debug Mode</a></li>';
echo '</ul>';
