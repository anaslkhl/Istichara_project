<?php
// Quick test for Laragon
echo "<h1>Laragon Test Page</h1>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>Server: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'N/A') . "</p>";
echo "<p>If you see this, PHP is working with Laragon!</p>";

echo "<h2>Testing routing...</h2>";
echo '<ul>';
echo '<li><a href="/">Home</a></li>';
echo '<li><a href="/dashboard">Dashboard</a></li>';
echo '<li><a href="/professionals">Professionals</a></li>';
echo '<li><a href="/?debug=1">Debug Mode</a></li>';
echo '</ul>';

echo "<h2>Apache/Laragon Info:</h2>";
echo "<pre>";
if (function_exists('apache_get_modules')) {
    echo "Apache Modules:\n";
    foreach (apache_get_modules() as $module) {
        echo "  - $module\n";
    }
} else {
    echo "Apache modules not available\n";
}
echo "mod_rewrite working: " . (in_array('mod_rewrite', apache_get_modules() ?? []) ? 'YES' : 'NO') . "\n";
echo ".htaccess exists: " . (file_exists(__DIR__ . '/.htaccess') ? 'YES' : 'NO') . "\n";
echo "</pre>";
