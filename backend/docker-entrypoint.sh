#!/bin/bash

set -e

# attendre que MySQL soit prêt
until php -r "try {
    new PDO('mysql:host=db;port=3306;dbname=symfony', 'user', 'password');
} catch (Exception \$e) {
    exit(1);
}"; do
  sleep 2
done

php bin/console doctrine:migrations:migrate --no-interaction || true
php bin/console doctrine:fixtures:load --no-interaction || true

php bin/console cache:clear --env=dev || true
php bin/console cache:warmup --env=dev || true

cat > /var/www/html/public/.htaccess << 'EOF'
DirectoryIndex index.php

<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{HTTP:Authorization} ^(.*)
    RewriteRule .* - [e=HTTP_AUTHORIZATION:%1]
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [QSA,L]
</IfModule>
EOF

# Lancer Apache en mode premier plan
apache2-foreground