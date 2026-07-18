FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip curl libpng-dev libonig-dev libxml2-dev libsqlite3-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_mysql pdo_sqlite mbstring bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Estructura que espera dirname(base_path()):
# base_path() = /app/API → dirname = /app → /app/Data/...
WORKDIR /app/API

COPY API/ .
COPY Data/ /app/Data/

RUN composer install --no-dev --optimize-autoloader

EXPOSE 8000

CMD php artisan config:cache && \
    php artisan route:clear && \
    php artisan migrate:fresh --seed --force && \
    php artisan serve --host=0.0.0.0 --port=8000
