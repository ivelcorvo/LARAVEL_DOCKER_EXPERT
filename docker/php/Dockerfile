FROM php:8.2-fpm-alpine

RUN apk add --no-cache git unzip libpq-dev $PHPIZE_DEPS \
&& docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Usuário não-root (boa prática para dev)
RUN addgroup -g 1000 appuser && adduser -G appuser -u 1000 -D appuser
USER appuser