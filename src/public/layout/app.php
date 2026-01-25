<?php
$user = $_SESSION['user'] ?? null;

if (!$user) {
    require_once __DIR__ . '/../main.php';
    require_once __DIR__ . '/../nav/user_navbar.php';
} else {


    switch ($user['role']) {

        case 'client':
            require __DIR__ . '/../nav/client_navbar.php';
            break;
        case 'admin':
            require __DIR__ . '/../nav/admin_navbar.php';
            break;
        case 'avocat':
            require __DIR__ . '/../nav/admin_navbar.php';
            break;
        case 'huisser':
            require __DIR__ . '/../nav/admin_navbar.php';
            break;

        default:
            require __DIR__ . '/../nav/user_navbar.php';
            break;
    }
}
