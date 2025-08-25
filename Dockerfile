# Etapa 1: Node para compilar assets
FROM node:20 AS node_builder
WORKDIR /app

COPY package*.json vite.config.js ./
COPY resources ./resources
COPY public ./public
RUN npm install
RUN npm run build

# Etapa 2: PHP + Laravel
FROM php:8.2-fpm

# Dependências
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

WORKDIR /var/www/html

# Copiar código Laravel
COPY . .

# Copiar build do Vite
COPY --from=node_builder /app/public/build ./public/build

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --optimize-autoloader --no-dev

# Permissões
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

CMD ["php-fpm"]
