# =========================
# Etapa 1: Node para build dos assets
# =========================
FROM node:20 AS node_builder
WORKDIR /app

# Copiar configs do npm e Vite
COPY package*.json vite.config.js ./

# Instalar dependências Node
RUN npm install

# Copiar código necessário para build
COPY resources ./resources
COPY public ./public

# Rodar build
RUN npm run build

# =========================
# Etapa 2: PHP-FPM com Laravel + Node para SSR
# =========================
FROM php:8.2-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar Node.js para SSR runtime
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest

WORKDIR /var/www/html

# Copiar código Laravel (sem sobrescrever build do Vite)
COPY . .

# Copiar build do Node gerado na etapa 1 (por último)
COPY --from=node_builder /app/public/build ./public/build

# Copiar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instalar dependências PHP
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Instalar dependências Node para SSR (sem devDependencies)
COPY package*.json ./
RUN npm install --omit=dev --no-audit --no-fund

# Ajustar permissões
RUN mkdir -p storage bootstrap/cache public/build \
    && chown -R www-data:www-data storage bootstrap/cache public/build \
    && chmod -R 775 storage bootstrap/cache public/build

USER www-data

CMD ["php-fpm"]
