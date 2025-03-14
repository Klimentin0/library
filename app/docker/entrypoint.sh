#!/bin/bash

set -e

until nc -z -v -w30 mysql 3306
do
  echo "Waiting for MySQL connection..."
  sleep 5
done
mkdir -p storage/app/public/books
chmod -R 775 storage/app/public/books
chown -R www-data:www-data storage/app/public/books

chown -R www-data:www-data /var/www/html/storage
chmod -R 775 /var/www/html/storage

composer install
echo "Running migrations..."
php artisan migrate --force
# php artisan config:clear
# php artisan cache:clear
php artisan db:seed --class=BookSeeder
echo "Building frontend assets..."
npm install && npm run build
echo "Starting Apache..."
exec apache2-foreground
