#!/bin/sh
set -e

chown -R app:app /var/www/html/var || true

if [ ! -d /var/www/html/vendor ]; then
  composer install --no-interaction --optimize-autoloader --no-dev
fi

echo "Waiting for MySQL..."

until mysqladmin ping -h db -u"$DB_USER" -p"$DB_PASSWORD" --silent; do
  sleep 2
done

php bin/console doctrine:migrations:migrate --no-interaction || true

php bin/console cache:clear --env=prod || true
php bin/console cache:warmup --env=prod || true

exec php-fpm -F