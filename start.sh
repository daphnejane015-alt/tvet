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
if [ -n "$DB_HOST" ]; then
    sed -i "s/DB_HOST=.*/DB_HOST=${DB_HOST}/" /var/www/html/.env
fi
if [ -n "$DB_PORT" ]; then
    sed -i "s/DB_PORT=.*/DB_PORT=${DB_PORT}/" /var/www/html/.env
fi
if [ -n "$DB_DATABASE" ]; then
    sed -i "s/DB_DATABASE=.*/DB_DATABASE=${DB_DATABASE}/" /var/www/html/.env
fi
if [ -n "$DB_USERNAME" ]; then
    sed -i "s/DB_USERNAME=.*/DB_USERNAME=${DB_USERNAME}/" /var/www/html/.env
fi
if [ -n "$DB_PASSWORD" ]; then
    sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=${DB_PASSWORD}/" /var/www/html/.env
fi

# Verify database configuration
if [ -z "$DB_HOST" ] || [ -z "$DB_DATABASE" ]; then
    echo "WARNING: Database credentials not fully set."
    echo "Please ensure a PostgreSQL database is created in Render and linked to this service."
    echo "Service name should be 'tvet-db' as configured in render.yaml"
fi

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

# Run migrations (only if database is configured)
if [ -n "$DB_HOST" ] && [ -n "$DB_DATABASE" ]; then
    echo "Running migrations..."
    php artisan migrate --force || echo "Migration failed, but continuing..."
    echo "Migrations completed"
else
    echo "Skipping migrations - database not configured"
fi

# Cache configuration
php artisan config:cache
php artisan route:cache
echo "Caching completed"

echo "Starting server on port 8080..."
php artisan serve --host=0.0.0.0 --port=8080
