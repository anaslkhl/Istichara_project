@echo off
echo ============================================
echo    Laragon (Apache) Setup
echo ============================================
echo.

cd src\public

echo [1] Creating .htaccess for Apache...
(
echo ^<IfModule mod_rewrite.c^>
echo     RewriteEngine On
echo     RewriteRule ^^(.*^)$ index.php [L,QSA]
echo ^</IfModule^>
) > .htaccess

echo [2] Testing Apache configuration...
echo   Make sure mod_rewrite is enabled in Laragon:
echo   1. Right-click Laragon icon
echo   2. Go to Apache → Enable rewrite_module
echo   3. Restart Laragon

echo [3] Quick test...
echo   Open: http://localhost/istichara/public/server-test.php
echo.
echo ✅ Setup complete for Apache!
echo.
pause
