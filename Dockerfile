# Build Stage
FROM node:20 as build

WORKDIR /app

COPY package.json package-lock.json* ./
RUN npm ci

COPY . .
RUN npm run build

# Production Stage
FROM php:8.2-fpm

# Install system dependencies
# Added gettext-base for envsubst
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx \
    supervisor \
    libzip-dev \
    libicu-dev \
    gettext-base

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy existing application directory contents
COPY . /var/www

# Copy built assets from build stage
COPY --from=build /app/public/build /var/www/public/build

# Create system user to run Composer and Artisan Commands
RUN chown -R www-data:www-data /var/www

# Copy config files
# Nginx config will be treated as a template
COPY docker/nginx.conf /etc/nginx/sites-available/default.template
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh

# Make entrypoint executable
RUN chmod +x /usr/local/bin/entrypoint.sh

# Render sets PORT env var. Access it in entrypoint.
# We don't need EXPOSE here strictly for Render, but good for local doc.
EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
