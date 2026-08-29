# Stage 1: Build frontend assets
FROM node:22-alpine AS frontend

WORKDIR /app

COPY package*.json ./

RUN npm install

COPY resources ./resources
COPY public ./public
COPY vite.config.js ./
COPY . .

RUN npm run build


# Stage 2: Laravel + PHP
FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    nginx \
    git \
    curl \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy Laravel project
COPY . .

# Install PHP dependencies
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction

# Copy built Vite assets
COPY --from=frontend /app/public/build ./public/build

# Laravel permissions
RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

# Nginx
COPY nginx.conf /etc/nginx/sites-available/default

# Start Laravel
RUN echo '#!/bin/sh' > /start.sh \
    && echo 'php artisan config:cache' >> /start.sh \
    && echo 'php artisan route:cache' >> /start.sh \
    && echo 'php artisan view:cache' >> /start.sh \
    && echo 'php-fpm -D' >> /start.sh \
    && echo 'nginx -g "daemon off;"' >> /start.sh \
    && chmod +x /start.sh

EXPOSE 80

CMD ["/start.sh"]