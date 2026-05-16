#!/bin/sh
set -e

php artisan package:discover --ansi || true
php artisan config:clear --ansi || true
php artisan route:clear --ansi || true
php artisan view:clear --ansi || true

exec "$@"
