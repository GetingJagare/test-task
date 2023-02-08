FROM php:8.1-fpm

WORKDIR /var/www/app
COPY app/ .
COPY php/entrypoint.sh /

# Installing dependencies for the PHP modules
RUN apt-get update && apt-get install -y zip libzip-dev libpng-dev libicu-dev libonig-dev libcurl4-gnutls-dev libxml2-dev

# Installing additional PHP modules
RUN docker-php-ext-install mysqli pdo pdo_mysql gd zip bcmath ctype intl mbstring opcache xml dom curl
RUN pecl install redis && docker-php-ext-enable redis
RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install -o