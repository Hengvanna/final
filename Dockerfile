FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git zip unzip libzip-dev

RUN docker-php-ext-install pdo pdo_mysql zip

WORKDIR /var/www/html

COPY . .

RUN chown -R www-data:www-data storage bootstrap/cache

RUN a2enmod rewrite

EXPOSE 80
