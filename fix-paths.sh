#!/bin/bash
echo "Fixing file paths from Public to public..."

# Fix PHP files that reference Public
find src/ -name "*.php" -type f -exec sed -i 's|/Public/|/public/|gi' {} \;
find src/ -name "*.php" -type f -exec sed -i 's|/Public"|/public"|gi' {} \;
find src/ -name "*.php" -type f -exec sed -i "s|/Public'|/public'|gi" {} \;

# Fix require/include statements
find src/ -name "*.php" -type f -exec sed -i 's|require.*Public/|require __DIR__ . "/../public/|gi' {} \;
find src/ -name "*.php" -type f -exec sed -i 's|include.*Public/|include __DIR__ . "/../public/|gi' {} \;

# Fix specific common patterns
find src/ -name "*.php" -type f -exec sed -i 's|\.\./Public|../public|gi' {} \;
find src/ -name "*.php" -type f -exec sed -i 's|Controllers/../Public|../public|gi' {} \;

echo "✅ Paths fixed!"
echo "Testing main.php exists:"
ls -la src/public/main.php 2>/dev/null && echo "Found!" || echo "Not found - creating placeholder"

# Create main.php if missing
if [ ! -f "src/public/main.php" ]; then
    cat > src/public/main.php << 'PHP'
<?php
// Main application entry
echo "Main application loaded";
PHP
    echo "Created placeholder main.php"
fi
