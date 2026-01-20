@echo off
echo ============================================
echo    Reset Laragon Configuration
echo ============================================
echo.

echo This will create fresh Laragon config files.
echo.

echo [1] Creating PHP.ini with error display...
(
echo error_reporting = E_ALL
echo display_errors = On
echo display_startup_errors = On
echo log_errors = On
echo error_log = "C:\laragon\logs\php_errors.log"
echo memory_limit = 512M
echo max_execution_time = 300
) > "C:\laragon\etc\php\php.ini" 2>nul

echo [2] Creating Apache virtual host...
(
echo ^<VirtualHost *:80^>
echo     ServerName istichara.test
echo     DocumentRoot "C:/laragon/www/istichara/src/public"
echo     ^<Directory "C:/laragon/www/istichara/src/public"^>
echo         Options -Indexes +FollowSymLinks
echo         AllowOverride All
echo         Require all granted
echo     ^</Directory^>
echo ^</VirtualHost^>
) > "C:\laragon\etc\apache2\sites-enabled\istichara.conf" 2>nul

echo [3] Creating .htaccess in project...
cd /d "C:\laragon\www\istichara\src\public" 2>nul || (
    echo Could not navigate to project directory.
    echo Please run this from your project folder.
    pause
    exit /b 1
)

(
echo Options -Indexes
echo RewriteEngine On
echo RewriteRule ^(.*)$ index.php [QSA,L]
) > .htaccess

echo [4] Instructions:
echo.
echo 1. RESTART Laragon (Right-click -> Restart All)
echo 2. Test: http://istichara.test/EMERGENCY-DEBUG.php
echo 3. This will show ALL errors
echo.
echo If you see WHITE SCREEN or Internal Server Error:
echo - Check C:\laragon\logs\php_errors.log
echo - Check C:\laragon\logs\apache_error.log
echo.

pause
