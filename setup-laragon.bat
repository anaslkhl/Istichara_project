cat > setup-laragon.bat << 'EOF'
@echo off
echo ========================================
echo    Laravel Setup for Laragon Users
echo ========================================
echo.

REM Check if .env exists
if not exist ".env" (
    echo [1/6] Creating .env file...
    copy .env.example .env
) else (
    echo [1/6] .env file already exists
)

echo [2/6] Installing Composer dependencies...
composer install --no-interaction --prefer-dist --optimize-autoloader

echo [3/6] Generating application key...
php artisan key:generate

echo [4/6] Setting permissions...
REM For Windows, permissions are handled differently
IF EXIST storage (
    icacls storage /grant Everyone:F /T >nul 2>&1
)
IF EXIST bootstrap/cache (
    icacls bootstrap/cache /grant Everyone:F /T >nul 2>&1
)

echo [5/6] Creating database in Laragon...
REM Create database if it doesn't exist
mysql -u root -e "CREATE DATABASE IF NOT EXISTS laravel;" 2>nul || (
    echo Note: MySQL might not be running or accessible
    echo Please start MySQL from Laragon first
)

echo [6/6] Running database migrations...
php artisan migrate --force

echo.
echo ========================================
echo      Setup Complete!
echo ========================================
echo.
echo Your Laravel application is ready!
echo Access it at: http://your-project-name.test
echo.
echo Press any key to exit...
pause >nul
EOF