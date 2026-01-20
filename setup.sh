#!/bin/bash

echo "�� Setting up Istichara Project..."

# Check if we're in Docker or Laragon
if [ -f "docker-compose.yml" ]; then
    echo "Detected Docker environment"
    
    # Create .env for Docker if it doesn't exist
    if [ ! -f ".env" ]; then
        echo "Creating .env for Docker..."
        cat > .env << 'DOCKERENV'
APP_NAME="Istichara"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8080

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=IsticharaDB
DB_USERNAME=root
DB_PASSWORD=camus
DOCKERENV
    fi
    
    # Start Docker
    docker-compose down 2>/dev/null
    docker-compose up -d --build
    
    echo "⏳ Waiting for services to start..."
    sleep 10
    
    # Install dependencies
    docker-compose exec php composer install
    
    # Generate key
    docker-compose exec php php artisan key:generate
    
    echo "✅ Docker setup complete!"
    echo "🌐 Access: http://localhost:8080"
    
else
    echo "Detected Laragon/local environment"
    
    # Create .env for Laragon
    if [ ! -f "src/.env" ]; then
        echo "Creating .env for Laragon..."
        cp .env.laragon.example src/.env
    fi
    
    cd src
    composer install
    php artisan key:generate
    
    echo "✅ Laragon setup complete!"
    echo "🌐 Access: http://localhost/istichara/public/"
fi
