#!/bin/sh
set -e

echo "Starting Laravel application..."

# Setup environment file
if [ ! -f /var/www/html/.env ]; then
    cp /var/www/html/.env.example /var/www/html/.env
fi
echo "Environment file setup complete"

# Override database connection with PostgreSQL
sed -i "s/DB_CONNECTION=.*/DB_CONNECTION=pgsql/" /var/www/html/.env
echo "Database connection set to PostgreSQL"

# Set database credentials from environment variables
sed -i "s/DB_HOST=.*/DB_HOST=${DB_HOST}/" /var/www/html/.env
sed -i "s/DB_PORT=.*/DB_PORT=${DB_PORT}/" /var/www/html/.env
sed -i "s/DB_DATABASE=.*/DB_DATABASE=${DB_DATABASE}/" /var/www/html/.env
sed -i "s/DB_USERNAME=.*/DB_USERNAME=${DB_USERNAME}/" /var/www/html/.env
sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=${DB_PASSWORD}/" /var/www/html/.env

echo "Database configuration:"
echo "  DB_CONNECTION=${DB_CONNECTION}"
echo "  DB_HOST=${DB_HOST}"
echo "  DB_PORT=${DB_PORT}"
echo "  DB_DATABASE=${DB_DATABASE}"

# Generate application key
php artisan key:generate --ansi || true
echo "Application key generated"

# Discover packages
php artisan package:discover --ansi
echo "Packages discovered"

# Create storage link
php artisan storage:link
echo "Storage linked"

# Run migrations
php artisan migrate --force
echo "Migrations completed"

# Cache configuration
php artisan config:cache
php artisan route:cache
echo "Caching completed"

echo "Starting server on port 8080..."
php artisan serve --host=0.0.0.0 --port=8080
