@echo off
echo ====================================
echo    Quick Laragon Fix
echo ====================================
echo.

echo Applying one-line fix to index.php...
cd src\public

REM Create backup
copy index.php index.php.backup

REM Add the fix at the top
echo <?php > temp.php
echo // ONE-LINE FIX FOR LARAGON >> temp.php
echo if (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], '/istichara/public/') === 0) { >> temp.php
echo     $_SERVER['REQUEST_URI'] = str_replace('/istichara/public', '', $_SERVER['REQUEST_URI']); >> temp.php
echo } >> temp.php
echo. >> temp.php

REM Append the original content
type index.php.backup | findstr /v "^<?php" >> temp.php

REM Replace original
move /Y temp.php index.php

echo.
echo ✅ Fix applied!
echo.
echo Now access your application at:
echo   http://localhost/istichara/public/
echo.
echo If still not working, try:
echo   1. Enable rewrite module in Laragon
echo   2. Restart Laragon
echo   3. Access via: http://istichara.test (virtual host)
echo.
pause
