@echo off
echo ============================================
echo    Fix Laragon Routing Issues
echo ============================================
echo.

echo [1] Creating CORRECT .htaccess...
cd src\public
(
echo Options -Indexes
echo RewriteEngine On
echo RewriteCond %%{REQUEST_FILENAME} !-f
echo RewriteCond %%{REQUEST_FILENAME} !-d
echo RewriteRule ^(.*)$ index.php [QSA,L]
) > .htaccess

echo [2] Enabling Apache modules in Laragon...
echo.
echo CRITICAL STEPS (must do manually):
echo 1. Open Laragon
echo 2. Right-click Laragon icon in system tray
echo 3. Go to: Apache -> Enable rewrite_module
echo 4. Restart Laragon (Right-click -> Restart All)
echo.

echo [3] Creating Apache config file for Laragon users...
cd ..\..

echo Creating laragon-apache-fix.conf...
(
echo # Apache Configuration for Laragon - Istichara Project
echo # Save to: C:\laragon\etc\apache2\sites-enabled\000-istichara.conf
echo.
echo ^<Directory "C:/laragon/www/istichara/src/public"^>
echo     AllowOverride All
echo     Require all granted
echo     Options -Indexes +FollowSymLinks
echo ^</Directory^>
echo.
echo ^<VirtualHost *:80^>
echo     ServerName istichara.test
echo     DocumentRoot "C:/laragon/www/istichara/src/public"
echo     ^<Directory "C:/laragon/www/istichara/src/public"^>
echo         AllowOverride All
echo         Require all granted
echo     ^</Directory^>
echo ^</VirtualHost^>
) > laragon-apache-fix.conf

echo [4] Instructions for Laragon users:
echo.
echo AFTER enabling mod_rewrite and restarting Laragon:
echo.
echo OPTION A (Easy - Virtual Host):
echo 1. Right-click Laragon icon -> Quick App -> This folder
echo 2. Access: http://istichara.test
echo.
echo OPTION B (Manual - if A doesn't work):
echo 1. Copy laragon-apache-fix.conf to:
echo    C:\laragon\etc\apache2\sites-enabled\000-istichara.conf
echo 2. Restart Laragon
echo 3. Access: http://istichara.test
echo.
echo OPTION C (Subdirectory):
echo Access: http://localhost/istichara/public/
echo.

echo [5] Testing...
echo Open: http://istichara.test/test-apache-routing.php
echo Should show "Apache is routing correctly through index.php"
echo.

echo ✅ Fix applied. Follow the instructions above.
pause
