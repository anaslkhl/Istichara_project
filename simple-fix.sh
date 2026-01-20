#!/bin/bash

echo "🔄 Applying simple routing fix..."

# Create the fixed index.php
cat > public/index.php << 'PHP'
<?php
// ULTRA-SIMPLE LARAGON FIX
function getNormalizedUri(): string
{
    \$uri = \$_SERVER['REQUEST_URI'] ?? '/';
    
    // Remove query string
    if ((\$pos = strpos(\$uri, '?')) !== false) {
        \$uri = substr(\$uri, 0, \$pos);
    }
    
    // Remove Laragon prefix if present
    if (strpos(\$uri, '/istichara/public') === 0) {
        \$uri = substr(\$uri, strlen('/istichara/public'));
    }
    
    // Ensure not empty
    if (\$uri === '') {
        \$uri = '/';
    }
    
    return \$uri;
}

require_once __DIR__ . "/../autoload.php";
require_once "../Routing/Routing.php";

\$router = Routing::load('routes.php');
\$uri = getNormalizedUri();
\$method = \$_SERVER['REQUEST_METHOD'];

try {
    [\$action, \$params] = \$router->direct(\$uri, \$method);
    [\$controller, \$methodName] = explode('@', \$action);

    \$controller = "Controllers\\\\\$controller";
    \$controllerInstance = new \$controller();

    call_user_func_array([\$controllerInstance, \$methodName], \$params);

} catch (Exception \$e) {
    http_response_code(404);
    echo "<h1>404 - Page Not Found</h1>";
    echo "<p>The page you're looking for doesn't exist.</p>";
    echo '<p><small>URI attempted: ' . htmlspecialchars(\$uri) . '</small></p>';
}
PHP

echo "✅ Fix applied!"
echo ""
echo "For Laragon users: Access http://localhost/istichara/public/"
echo "For Docker users: Access http://localhost:8080/"
echo ""
echo "That's it! 🎉"
