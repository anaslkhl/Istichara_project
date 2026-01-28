<?php

namespace Middleware;

class AuthMiddleware
{

    public static function handle()
    {
        self::start_session();

        if (!isset($_SESSION['user'])) {
            header('location: /login');
            exit;
        }
    }
    public static function start_session()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function check()
    {
        self::start_session();
        return isset($_SESSION['user']);
    }
    public static function user()
    {
        self::start_session();
        return $_SESSION['user'] ?? null;
    }

    public static function logout()
    {
        self::start_session();
        session_destroy();
        header('Location: /main');
        exit;
    }
}
