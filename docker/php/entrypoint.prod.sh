#!/bin/sh
set -e

echo "➡️ Fix permissions..."
chown -R app:app /var/www/html/var || true

echo "➡️ Waiting for database..."

# Attente MySQL via port (plus fiable que mysqladmin + pas de fuite de password)
until nc -z db 3306; do
  sleep 2
done

echo "➡️ Database is up."

echo "➡️ Running migrations (SAFE MODE)..."

# ⚠️ En prod: idéalement faire ça en CI/CD, mais laissé ici si nécessaire
php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration || true

echo "➡️ Clearing cache..."
php bin/console cache:clear --env=prod --no-interaction

echo "➡️ Warming up cache..."
php bin/console cache:warmup --env=prod

echo "➡️ Ensuring correct permissions after cache..."
chown -R app:app /var/www/html/var || true

echo "➡️ Starting PHP-FPM..."

exec php-fpm -F