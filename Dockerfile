# ============================
# 1) STAGE: Build de dependências PHP (Composer)
# ============================
FROM composer:2 AS vendor

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install \
    --ignore-platform-reqs \
    --no-dev \
    --no-scripts \
    --prefer-dist \
    --optimize-autoloader

# ============================
# 2) STAGE: Build do Frontend (Node + Vite)
# ============================
FROM node:20 AS frontend

WORKDIR /app
COPY package*.json ./
RUN npm install --production=false

COPY resources resources
COPY vite.config.js postcss.config.js tailwind.config.js ./
RUN npm run build

# ============================
# 3) STAGE: Container final do Laravel (PHP-FPM)
# ============================
FROM php:8.2-fpm

# Instala extensões PHP necessárias para Laravel
RUN apt-get update && apt-get install -y \
    unzip git curl libpq-dev libzip-dev libonig-dev \
    netcat-openbsd \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && docker-php-ext-install pdo pdo_mysql zip mbstring bcmath pcntl \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

# Copia dependências do composer do estágio 'vendor'
COPY --from=vendor /app/vendor ./vendor

# Copia frontend compilado do estágio 'frontend'
COPY --from=frontend /app/public ./public

# Copia o restante do projeto
COPY . .

# Otimizações Laravel (não cache rotas que dão conflito)
RUN php artisan config:clear \
    && php artisan view:clear \
    && php artisan config:cache \
    && php artisan view:cache

# Permissões
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
