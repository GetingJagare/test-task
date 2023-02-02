FROM php:8.1-fpm

WORKDIR /var/www/app
COPY app/ .

# Installing dependencies for the PHP modules
RUN apt-get update && apt-get install -y zip libzip-dev libpng-dev libicu-dev libonig-dev libcurl4-gnutls-dev libxml2-dev

# Installing additional PHP modules
RUN docker-php-ext-install gd zip bcmath ctype intl mbstring opcache xml dom curl
RUN pecl install redis && docker-php-ext-enable redis
RUN echo '\nupload_max_size = 128M;' >> /usr/local/etc/php/php.ini;
RUN echo '\nmemory_limit = 2048M;' >> /usr/local/etc/php/php.ini;
#RUN echo '\nerror_reporting=E_ERROR;' >> /usr/local/etc/php/php.ini;
#RUN echo '\nshort_open_tag=On;' >> /usr/local/etc/php/php.ini;

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install -o
