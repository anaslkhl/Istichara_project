<?php
$user = $_SESSION['user'] ?? null;

if (!$user) {
    require_once __DIR__ . '/../nav/user_navbar.php';
} else {
    switch ($user['role']) {
        case 'client':
            require_once __DIR__ . '/../nav/client_navbar.php';
            break;
        case 'admin':
        case 'avocat':
        case 'huisser':
            require_once __DIR__ . '/../nav/admin_navbar.php';
            break;
        default:
            require_once __DIR__ . '/../nav/user_navbar.php';
            break;
    }
}
