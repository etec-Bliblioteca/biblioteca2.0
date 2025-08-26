# Etapa 1: Node para build
FROM node:20 AS node_builder
WORKDIR /app

# Copiar apenas o necessário para instalar deps
COPY package*.json vite.config.js ./
COPY resources ./resources
COPY public ./public

# Instalar deps e build (SSR incluso)
RUN npm install
RUN npm run build # <-- gera public/build/ssr.js e client assets

# Etapa 2: PHP-FPM
FROM php:8.2-fpm

# Dependências PHP
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Node.js (necessário para SSR runtime)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

WORKDIR /var/www/html

# Copiar código Laravel
COPY . .

# Copiar build do Node
COPY --from=node_builder /app/public/build ./public/build
COPY --from=node_builder /app/node_modules ./node_modules

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --optimize-autoloader --no-dev

# Permissões
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

CMD ["php-fpm"]
