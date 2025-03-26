FROM mysql:8.0

# Копируем кастомный entrypoint
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Переопределяем entrypoint
ENTRYPOINT ["/entrypoint.sh"]