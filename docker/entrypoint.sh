#!/bin/sh

# Replace environment variables in Nginx config
# If PORT is not set, default to 8080
export PORT=${PORT:-8080}
envsubst '${PORT}' < /etc/nginx/sites-available/default.template > /etc/nginx/sites-available/default

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
