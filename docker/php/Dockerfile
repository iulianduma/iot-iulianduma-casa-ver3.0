FROM php:8.2-fpm
RUN apt-get update && apt-get install -y \
    git zip unzip curl libicu-dev libpq-dev libonig-dev libxml2-dev \
    && docker-php-ext-install intl pdo pdo_pgsql mbstring
WORKDIR /var/www/html
