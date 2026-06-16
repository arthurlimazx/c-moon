#!/bin/sh

set -e

cd /var/www/html

if [ ! -f .env ]; then
    cp .env.example .env
fi

if ! grep -q "^APP_KEY=base64:" .env; then
    php artisan key:generate --force
fi

echo "Waiting for database..."

until php artisan db:show >/dev/null 2>&1
do
    sleep 2
done

echo "Database ready"

php artisan migrate --force

php artisan storage:link || true

php artisan optimize:clear

chown -R www-data:www-data storage bootstrap/cache || true

exec php-fpm