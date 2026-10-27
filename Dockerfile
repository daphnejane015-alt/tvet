FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    supervisor \
    libpq-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd && \
    docker-php-ext-enable pdo_pgsql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . /var/www/html/

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts
RUN npm install --legacy-peer-deps --no-audit --no-fund
RUN npm run build

# Create storage directories
RUN mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs storage/app/public bootstrap/cache

# Set permissions
RUN chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port
EXPOSE 8080

# Make start script executable
RUN chmod +x /var/www/html/start.sh

CMD ["/var/www/html/start.sh"]
