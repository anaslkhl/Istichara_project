#!/bin/bash

echo "🚀 Setting up Istichara Project with Docker..."

# Check for .env file
if [ ! -f ".env" ]; then
    echo "📄 Creating .env file..."
    cp .env.example .env
fi

# Build and start containers
echo "🐳 Building and starting Docker containers..."
docker-compose down 2>/dev/null
docker-compose up -d --build

# Wait for PHP to be healthy
echo "⏳ Waiting for PHP-FPM to be ready..."
for i in {1..30}; do
    if docker-compose ps php | grep -q "(healthy)"; then
        echo "✅ PHP-FPM is healthy!"
        break
    fi
    echo -n "."
    sleep 2
done

echo "📦 Installing Composer dependencies..."
docker-compose exec php composer install --no-interaction --prefer-dist

echo "🔑 Generating Laravel application key..."
docker-compose exec php php artisan key:generate

echo "🔧 Setting up storage permissions..."
docker-compose exec php chmod -R 775 storage bootstrap/cache
docker-compose exec php chown -R www-data:www-data storage bootstrap/cache

echo "🗃️ Running database migrations..."
docker-compose exec php php artisan migrate --force

echo "✨ Clearing caches..."
docker-compose exec php php artisan optimize:clear

echo ""
echo "✅ SETUP COMPLETE!"
echo "=================="
echo "🌐 Application: http://localhost:8080"
echo "📊 PHPMyAdmin:  http://localhost:8081"
echo "🔧 MySQL Port:  3308"
echo ""
echo "📋 Useful commands:"
echo "   docker-compose logs -f php     # View PHP logs"
echo "   docker-compose exec php bash   # Enter PHP container"
echo "   docker-compose restart nginx   # Restart nginx"
