@echo off
echo ============================================
echo    Check Apache Error Log
echo ============================================
echo.

echo Looking for Laragon error logs...
echo.

set LOG_FOUND=0

if exist "C:\laragon\logs\apache_error.log" (
    echo Found: C:\laragon\logs\apache_error.log
    echo.
    echo Last 20 lines:
    echo ============================================
    tail -20 "C:\laragon\logs\apache_error.log" 2>nul || more +0 "C:\laragon\logs\apache_error.log"
    set LOG_FOUND=1
) else if exist "C:\laragon\logs\error.log" (
    echo Found: C:\laragon\logs\error.log
    echo.
    echo Last 20 lines:
    echo ============================================
    tail -20 "C:\laragon\logs\error.log" 2>nul || more +0 "C:\laragon\logs\error.log"
    set LOG_FOUND=1
)

if %LOG_FOUND%==0 (
    echo No error logs found in common locations.
    echo.
    echo Check these folders:
    echo 1. C:\laragon\logs\
    echo 2. C:\laragon\usr\logs\
    echo 3. C:\laragon\bin\apache\logs\
)

echo.
echo Press any key to exit...
pause >nul
