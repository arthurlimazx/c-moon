#!/bin/sh
set -e

cd /var/www/html

# Gera APP_KEY se vazio
if grep -q "^APP_KEY=$" .env 2>/dev/null || ! grep -q "^APP_KEY=base64:" .env 2>/dev/null; then
    php artisan key:generate --force
fi

echo "Aguardando banco de dados..."
until php -r "
    \$pdo = new PDO(
        'mysql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT') . ';dbname=' . getenv('DB_DATABASE'),
        getenv('DB_USERNAME'),
        getenv('DB_PASSWORD')
    );
" 2>/dev/null; do
    sleep 2
done
echo "Banco pronto!"

php artisan migrate --force
php artisan storage:link 2>/dev/null || true
php artisan optimize:clear
chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true

exec php-fpm