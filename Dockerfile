FROM php:7.2-apache

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng-dev \
    libzip-dev \
    git \
    && rm -rf /var/lib/apt/lists/* \
    && rm /etc/apache2/sites-enabled/000-default.conf \
    && ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/

# Install the PHP extentions
RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/html

COPY docker/php7.2-apache/sites-enabled /etc/apache2/sites-enabled

COPY . /var/www/html

ARG DB_HOST=mysql
ARG DB_PORT=3306
ARG DB_DATABASE=homestead
ARG DB_USER=homestead
ARG DB_PASSWORD=secret

RUN cp docker/php7.2-apache/.env.production.example .env \
    && echo "DB_HOST=${DB_HOST}\n\
DB_PORT=${DB_PORT}\n\
DB_DATABASE=${DB_DATABASE}\n\
DB_USER=${DB_USER}\n\
DB_PASSWORD=${DB_PASSWORD}\n\
$(cat .env)" > .env

RUN chown -R www-data:www-data storage /var/www/html \
    && composer install --optimize-autoloader --no-plugins --no-scripts --no-dev \
    && php artisan key:generate \
    && php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider" \
    && php artisan jwt:secret -f \
    && php artisan config:cache
    # && php artisan route:cache