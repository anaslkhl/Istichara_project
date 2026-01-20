#!/bin/bash
echo "Docker (Nginx) Setup..."

echo "[1] Starting Docker containers..."
docker-compose up -d

echo "[2] Testing Nginx configuration..."
curl -I http://localhost:8080/server-test.php

echo "✅ Docker/Nginx setup complete!"
echo "🌐 Access: http://localhost:8080"
