#!/bin/bash
set -eo pipefail

# Автоматически исправляем права на папку с данными
chown -R 999:999 /var/lib/mysql

# Запускаем оригинальный entrypoint из образа MySQL
exec /usr/local/bin/docker-entrypoint.sh "$@"