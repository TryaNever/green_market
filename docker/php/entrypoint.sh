#!/bin/sh
set -e

chown -R app:app /var/www/html/var || true

if [ ! -f /var/www/html/vendor/autoload.php ]; then
  composer install --no-interaction --optimize-autoloader
fi

echo "Waiting for MySQL..."

until php -r "
try {
  new PDO('mysql:host=db;port=3306;dbname=symfony', 'user', 'password');
} catch (Exception \$e) {
  exit(1);
}
"; do
  sleep 2
done

php bin/console doctrine:migrations:migrate --no-interaction || true
sleep 5
php bin/console doctrine:fixtures:load --no-interaction || true
sleep 5
php bin/console cache:clear --env=dev || true
php bin/console cache:warmup --env=dev || true

exec php-fpm -F