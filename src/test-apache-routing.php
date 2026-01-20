<?php
// Place this in src/public/test-routing.php temporarily
// Then access: http://istichara.test/test-routing.php

// Test if we're going through index.php
$isRouted = (basename($_SERVER['SCRIPT_FILENAME']) === 'index.php');

echo "<h1>Apache Routing Test</h1>";
echo "<p>Script: " . basename($_SERVER['SCRIPT_FILENAME']) . "</p>";
echo "<p>Is routed through index.php: " . ($isRouted ? '✅ YES' : '❌ NO') . "</p>";

if (!$isRouted) {
    echo "<h2 style='color:red;'>PROBLEM DETECTED!</h2>";
    echo "<p>Apache is executing this PHP file directly instead of routing through index.php</p>";
    echo "<h3>Fixes:</h3>";
    echo "<ol>";
    echo "<li>Enable mod_rewrite in Laragon</li>";
    echo "<li>Check .htaccess exists in public/ folder</li>";
    echo "<li>Restart Laragon</li>";
    echo "</ol>";
} else {
    echo "<h2 style='color:green;'>✅ Routing is working correctly!</h2>";
}
