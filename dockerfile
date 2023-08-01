FROM php:7.3.33-apache

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y \
        zlib1g-dev \
        libicu-dev \
        libxml2-dev \
        libpq-dev \
        libzip-dev \
        libpng-dev \
        libmagickwand-dev \
        && docker-php-ext-install pdo pdo_mysql pgsql pdo_pgsql zip intl xmlrpc soap opcache gd \
        && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
        && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
        && pecl install xdebug-3.1.6 \
        && pecl install imagick \
        && docker-php-ext-enable imagick \
        && docker-php-ext-enable xdebug

RUN apt-get update -y 

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY  docker/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY  docker/php.ini /usr/local/etc/php/php.ini

ENV COMPOSER_ALLOW_SUPERUSER 1

COPY  . /var/www/html/
WORKDIR /var/www/html/

RUN chown -R www-data:www-data /var/www/html  \
    && composer install  && composer dumpautoload  &&  php artisan migrate &&  php artisan db:seed 
