FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    zip unzip curl git libzip-dev libpng-dev libonig-dev libxml2-dev \
    supervisor \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install PHPUnit
RUN curl -L https://phar.phpunit.de/phpunit-11.phar -o /usr/local/bin/phpunit && \
    chmod +x /usr/local/bin/phpunit

# Update package list and install Vim
RUN apt-get update && apt-get install -y vim

WORKDIR /var/www

# Prepare Laravel folders and permissions as root (no chown needed)
RUN mkdir -p /var/www/storage /var/www/bootstrap/cache /var/www/database && \
    touch /var/www/database/database.sqlite && \
    chmod -R 777 /var/www/storage /var/www/bootstrap/cache /var/www/database

EXPOSE 9000

CMD ["php-fpm"]


