#!/bin/sh
chown -R www-data:www-data /var/www/storage
chmod -R 775 /var/www/storage
exec "$@"