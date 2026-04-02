FROM php:8.4-fpm-alpine

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

RUN apk add --no-cache git unzip icu-libs libzip libpq \
    && apk add --no-cache --virtual .build-deps $PHPIZE_DEPS icu-dev libzip-dev oniguruma-dev postgresql-dev \
    && docker-php-ext-install bcmath exif intl mbstring pcntl pdo_pgsql zip \
    && apk del .build-deps

WORKDIR /var/www/html
