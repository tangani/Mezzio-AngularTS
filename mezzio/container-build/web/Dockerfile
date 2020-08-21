FROM php:7.4-apache

## Update package information
RUN apt-get update

##  Install zip libraries and extension
RUN apt-get update && apt-get install -y \
        zlib1g-dev \
        libzip-dev \
        vim \
        git \
        mariadb-client \
 && docker-php-ext-install zip mysqli pdo_mysql \
 && pecl install xdebug \
 && docker-php-ext-enable xdebug \
 && echo 'xdebug.remote_enable=on' >> /usr/local/etc/php/conf.d/xdebug.ini \
 && echo 'xdebug.remote_host=host.docker.internal' >> /usr/local/etc/php/conf.d/xdebug.ini \
 && echo 'xdebug.remote_port=9000' >>  /usr/local/etc/php/conf.d/xdebug.ini \
RUN docker-php-ext-install zip
RUN apt-get install -y zlib1g-dev libicu-dev g++
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl

## Configure Apache
RUN a2enmod rewrite
RUN sed -i 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/000-default.conf
RUN mv /var/www/html /var/www/public

## Install Composer
RUN curl -sS https://getcomposer.org/installer \
  | php -- --install-dir=/usr/local/bin --filename=composer \
&& echo "AllowEncodedSlashes On" >> /etc/apache2/apache2.conf

###
## Additional PHP extensions.  To use these extensions uncomment the 
## leading `# ` from the RUN commands.  These are provided to show 
## examples of including other libraries into the PHP installation.
###

## Install i18n libraries and extensions
# RUN apt-get install --yes libicu-dev
# RUN docker-php-ext-configure intl 
# RUN docker-php-ext-install intl

## Install mbstring for i18n string support
# RUN docker-php-ext-install mbstring

## MySQL PDO support
# RUN docker-php-ext-install pdo_mysql

## Redis support.  igbinary and libzstd-dev are only needed based on redis 
## pecl options
# RUN pecl install igbinary
# RUN docker-php-ext-enable igbinary
# RUN apt-get install --yes libzstd-dev
# RUN pecl install redis
# RUN docker-php-ext-enable redis

WORKDIR /var/www
