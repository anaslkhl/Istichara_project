@echo off
echo ============================================
echo    Laragon Setup Script
echo ============================================
echo.

echo [1] Checking Laragon installation...
if not exist "C:\laragon\www\" (
    echo ERROR: Laragon not found at C:\laragon\
    echo Please install Laragon first from: https://laragon.org/download/
    pause
    exit /b 1
)

echo [2] Creating project directory...
if not exist "C:\laragon\www\istichara\" (
    mkdir "C:\laragon\www\istichara"
    echo Created: C:\laragon\www\istichara
)

echo [3] Copying project files...
echo Please make sure you've cloned the project to C:\laragon\www\istichara
echo.

echo [4] Enabling Apache modules in Laragon...
echo.
echo IMPORTANT: In Laragon, enable these modules:
echo 1. Right-click Laragon icon in system tray
echo 2. Go to: Apache -> Enable rewrite_module
echo 3. Restart Laragon (Right-click -> Restart All)
echo.

echo [5] Creating virtual host...
echo.
echo To create virtual host:
echo 1. In Laragon, right-click icon -> Quick App -> This folder
echo 2. This creates: http://istichara.test
echo.
echo OR use subdirectory URL:
echo http://localhost/istichara/public/
echo.

echo [6] Testing...
echo.
echo After setup, test:
echo 1. http://istichara.test/?debug=1
echo 2. Should show "ROUTING DEBUG" at top
echo.
echo If you see "Internal Server Error":
echo - Check .htaccess exists in src/public/
echo - Make sure mod_rewrite is enabled
echo - Check C:\laragon\logs\apache_error.log
echo.

echo ✅ Setup instructions complete!
echo.
pause
