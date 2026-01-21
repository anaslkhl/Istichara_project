FROM php:8.2-fpm-bookworm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer directly (alternative to COPY --from)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Create a non-root user
RUN useradd -m -u 1000 dockeruser
USER dockeruser

# Set working directory
WORKDIR /var/www/html

# Copy application with correct permissions
COPY --chown=dockeruser:dockeruser src/ /var/www/html/

EXPOSE 9000
CMD ["php-fpm"]
