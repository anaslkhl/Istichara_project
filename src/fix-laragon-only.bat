@echo off
echo ============================================
echo    Laragon Apache Fix (No Code Changes)
echo ============================================
echo.

cd /d "%~dp0"

echo [1] Creating powerful .htaccess...
cd src\public

(
echo Options -Indexes -MultiViews +FollowSymLinks
echo DirectoryIndex index.php index.html
echo.
echo ^<IfModule mod_rewrite.c^>
echo     RewriteEngine On
echo     RewriteCond %{REQUEST_FILENAME} !-f
echo     RewriteCond %{REQUEST_FILENAME} !-d
echo     RewriteRule ^(.*)$ index.php [L,QSA]
echo ^</IfModule^>
) > .htaccess

echo [2] Creating simple index.html redirect...
(
echo ^<meta http-equiv="refresh" content="0; url=index.php"^>
echo ^<script^>window.location.href="index.php";^</script^>
) > index.html

echo [3] Checking Apache modules...
echo.
echo 📢 CRITICAL: Enable these in Laragon:
echo.
echo 1. Open Laragon
echo 2. Right-click Laragon icon in system tray
echo 3. Go to: Apache -> Enable rewrite_module
echo 4. ALSO enable: headers_module (optional but good)
echo 5. Restart Laragon (Right-click -> Restart All)
echo.

echo [4] Setting up virtual host...
echo.
echo OPTION A (Automatic):
echo - Right-click Laragon icon -> Quick App -> This folder
echo.
echo OPTION B (Manual - if A doesn't work):
echo 1. Open: C:\laragon\etc\apache2\sites-enabled\
echo 2. Create file: istichara.conf
echo 3. Add virtual host configuration
echo.

echo [5] Testing...
echo.
echo AFTER RESTARTING LARAGON, test:
echo 1. http://istichara.test/?test=1
echo 2. http://localhost/istichara/public/?test=1
echo.
echo Both should show your application, NOT file listing.
echo.

pause
