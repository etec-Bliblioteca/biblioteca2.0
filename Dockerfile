# Etapa 1: Build do frontend (Vue SSR)
FROM node:20 AS frontend

WORKDIR /app

COPY package*.json vite.config.js ./
RUN npm install

COPY resources ./resources
COPY public ./public
RUN npm run build

# Etapa 2: Build do backend (Composer)
FROM composer:2 AS vendor

WORKDIR /var/www/html

COPY composer.* ./
RUN composer install --prefer-dist --no-interaction --no-scripts

# Etapa 3: Imagem final PHP-FPM + Node para SSR
FROM php:8.2-fpm

# Dependências do sistema
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && pecl install redis && docker-php-ext-enable redis \
    && apt-get clean

# Node.js runtime para SSR
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

WORKDIR /var/www/html

# Copiar código Laravel
COPY . .

# Copiar dependências PHP
COPY --from=vendor /var/www/html/vendor ./vendor

# Copiar build frontend
COPY --from=frontend /app/public/build ./public/build
COPY --from=frontend /app/public/build/ssr.js ./public/build/ssr.js

# Permissões
RUN mkdir -p storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache public/build \
    && chmod -R 775 storage bootstrap/cache public/build

EXPOSE 9000
CMD ["php-fpm"]
