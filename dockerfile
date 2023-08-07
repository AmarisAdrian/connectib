FROM php:8.1-apache

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        zip \
        unzip \
        git \
        libpq-dev \
        libzip-dev \
        libicu-dev \
        libxml2-dev \
        libmagickwand-dev \
        libmemcached-dev \
        libssl-dev \
        libcurl4-openssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql zip intl soap curl
        
RUN apt-get update -y 
# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY --from=composer /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1

COPY  . /var/www/html/
WORKDIR /var/www/html/

RUN chown -R www-data:www-data /var/www/html  
RUN composer install  
RUN composer dumpautoload  
CMD php artisan migrate &&  php artisan db:seed 
