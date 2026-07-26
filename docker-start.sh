#!/bin/bash

# Ensure SQLite database file exists and has write permissions
touch /var/www/html/database/database.sqlite
chmod 777 /var/www/html/database/database.sqlite
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Clear cache
php artisan config:clear
php artisan cache:clear

# Run migrations and seeders automatically
php artisan migrate --force
php artisan db:seed --force

# Optimize Laravel performance for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Update Apache port dynamically from Render's $PORT environment variable
PORT=${PORT:-8080}
sed -i "s/Listen [0-9]*/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:[0-9]*>/<VirtualHost *:${PORT}>/g" /etc/apache2/sites-available/000-default.conf

# Start Apache server in foreground
exec apache2-foreground
