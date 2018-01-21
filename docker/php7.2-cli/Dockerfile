FROM php:7.2-cli

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng-dev \
    libzip-dev \
    git \
    && rm -rf /var/lib/apt/lists/*

# Install the PHP extentions
RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

# Install wait-for-it
RUN git clone https://github.com/vishnubob/wait-for-it.git /wait-for-it \
    && ln -s /wait-for-it/wait-for-it.sh /usr/local/bin/

WORKDIR /var/www/html

CMD bash