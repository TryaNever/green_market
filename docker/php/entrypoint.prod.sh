#!/bin/sh
set -e

echo "Fix permissions..."
chown -R app:app /var/www/html/var || true

echo "Install dependencies if needed..."
if [ ! -d /var/www/html/vendor ]; then
  composer install --no-interaction --optimize-autoloader --no-dev
fi

echo "Waiting for MySQL..."

until mysqladmin ping -h db -u"$DB_USER" -p"$DB_PASSWORD" --silent; do
  sleep 2
done

echo "Running migrations..."
php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration

echo "Warming cache..."
php bin/console cache:clear --env=prod --no-interaction
php bin/console cache:warmup --env=prod

echo "Starting PHP-FPM..."
exec php-fpm -F