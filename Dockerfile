# Etapa 1: Node para build dos assets
FROM node:20 AS node_builder
WORKDIR /app

# Copiar configs do npm e Vite
COPY package*.json vite.config.js ./
COPY resources ./resources
COPY public ./public

# Instalar dependências e rodar build
RUN npm install
RUN npm run build

# Etapa 2: PHP-FPM com Laravel
FROM php:8.2-fpm

# Dependências PHP
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && apt-get clean

# Instalar Node.js para SSR runtime
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

WORKDIR /var/www/html

# Copiar código Laravel (inclui composer.json etc)
COPY . .

# Copiar build do Node gerado na etapa 1
COPY --from=node_builder /app/public/build ./public/build

# Copiar build do Node
COPY --from=node_builder /app/public/build /var/www/html/public/build

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Ajustar permissões
RUN mkdir -p storage bootstrap/cache public/build \
    && chown -R www-data:www-data storage bootstrap/cache public/build \
    && chmod -R 775 storage bootstrap/cache public/build

USER www-data

CMD ["php-fpm"]
