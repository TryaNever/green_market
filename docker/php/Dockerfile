# ── STAGE BUILD ──────────────────────────────────────
FROM php:8.3-fpm-alpine AS builder

# dépendances système
RUN apk add --no-cache \
    git unzip zip curl bash \
    icu-dev icu-libs \
    oniguruma-dev libzip-dev \
    $PHPIZE_DEPS

# extensions PHP
RUN docker-php-ext-install \
    pdo pdo_mysql opcache intl zip

# APCu
RUN pecl install apcu \
    && docker-php-ext-enable apcu

# active APCu en CLI
RUN echo "apc.enable_cli=1" > /usr/local/etc/php/conf.d/apcu.ini

# copie composer depuis son image officielle
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# copie lock en premier → cache Docker si pas changé
COPY backend/composer.json backend/composer.lock ./

# install deps sans scripts ni dev
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# copie code source
COPY backend .

# runtime step
FROM php:8.3-fpm-alpine

# libs runtime
RUN apk add --no-cache \
    icu-dev icu-libs \
    oniguruma-dev \
    libzip-dev \
    $PHPIZE_DEPS

# extensions PHP
RUN docker-php-ext-install \
    pdo pdo_mysql opcache intl zip

# APCu
RUN pecl install apcu \
    && docker-php-ext-enable apcu

# active APCu en CLI
RUN echo "apc.enable_cli=1" > /usr/local/etc/php/conf.d/apcu.ini

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# config opcache + fpm
COPY docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

WORKDIR /var/www/html

# récupère build complet du stage précédent
COPY --from=builder /var/www/html /var/www/html

# user non-root uid 1000
RUN addgroup -g 1000 app && \
    adduser -D -G app -u 1000 -s /bin/sh app

# entrypoint + perms
COPY docker/php/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]