#!/bin/sh
set -e

HOST=${DB_HOST:-mysql}
PORT=${DB_PORT:-3306}

echo "Aguardando o MySQL em $HOST:$PORT..."

while ! nc -z $HOST $PORT; do
  sleep 2
done

echo "MySQL está pronto! Iniciando o Reverb..."
exec php artisan reverb:start
