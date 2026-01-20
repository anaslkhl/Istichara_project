<?php
// Include your routing class
require_once 'path/to/your/Routing.php';

// Simulate different environments
$environments = [
    'Docker' => [
        'SCRIPT_NAME' => '/index.php',
        'REQUEST_URI' => '/login'
    ],
    'Laragon Virtual Host' => [
        'SCRIPT_NAME' => '/index.php',
        'REQUEST_URI' => '/login'
    ],
    'Laragon Subdirectory' => [
        'SCRIPT_NAME' => '/istichara/public/index.php',
        'REQUEST_URI' => '/istichara/public/login'
    ]
];

foreach ($environments as $env => $serverVars) {
    echo "\n=== Testing: $env ===\n";
    
    // Mock $_SERVER
    $_SERVER = $serverVars;
    
    // Create router
    $router = new Routing();
    $router->detectBasePath();
    
    echo "Base Path: " . $router->getBasePath() . "\n";
    
    // Test URL normalization
    $testUrls = [
        '/login',
        '/istichara/public/login',
        '/dashboard',
        '/istichara/public/dashboard'
    ];
    
    foreach ($testUrls as $url) {
        $normalized = $router->removeBasePath($url);
        echo "  $url → $normalized\n";
    }
}
