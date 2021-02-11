FROM php:7.2-apache
RUN apt-get update \
    && apt-get install -my wget gnupg sudo zip unzip git zlib1g-dev \
    && apt-get install -y libpq-dev && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && docker-php-ext-install pgsql && docker-php-ext-install zip \
    && apt-get clean

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN  a2enmod rewrite