#!/bin/sh
set -e

# Copy public assets to shared volume (for nginx) if empty
if [ -d /public_volume ] && [ -z "$(ls -A /public_volume 2>/dev/null)" ]; then
    cp -a /var/www/html/public/. /public_volume/
fi

exec php-fpm
