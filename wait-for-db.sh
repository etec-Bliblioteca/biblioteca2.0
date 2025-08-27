#!/bin/sh
set -e

HOST=${DB_HOST:-mysql}
PORT=${DB_PORT:-3306}
TIMEOUT=${DB_TIMEOUT:-60}  # tempo máximo em segundos

echo "Aguardando MySQL em $HOST:$PORT..."

START_TIME=$(date +%s)

while ! nc -z $HOST $PORT 2>/dev/null; do
    CURRENT_TIME=$(date +%s)
    ELAPSED=$((CURRENT_TIME - START_TIME))
    
    if [ $ELAPSED -ge $TIMEOUT ]; then
        echo "Erro: Timeout aguardando MySQL ($TIMEOUT s)"
        exit 1
    fi

    echo "MySQL não disponível ainda... tentando novamente em 2s"
    sleep 2
done

echo "MySQL está pronto! Iniciando o Reverb..."
exec php artisan reverb:start
