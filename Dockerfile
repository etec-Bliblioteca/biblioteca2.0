FROM php:8.2-fpm

# Instalar dependências do sistema e PHP
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip libssl-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

# Copiar o código Laravel para o container
COPY . .

# Instalar dependências do Composer
RUN composer install --optimize-autoloader

# Rodar comandos Artisan
USER root
RUN php artisan key:generate \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache


# Instalar Node.js e dependências
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && npm ci \
    && npm run build\
    && npm run build:ssr

# Ajustar permissões para o usuário www-data
RUN mkdir -p storage bootstrap/cache bootstrap/build \
    && chown -R www-data:www-data storage bootstrap/cache bootstrap/build

USER www-data

CMD ["php-fpm"]
