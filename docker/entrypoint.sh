#!/bin/sh

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations (force because we are in production)
php artisan migrate --force

# Link storage
php artisan storage:link

# Start Supervisord
/usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
