FROM php:7.2-fpm

COPY php.ini /usr/local/etc/php/

RUN apt update && apt install -y git zip unzip
RUN docker-php-ext-install pdo_mysql bcmath
RUN cd /usr/bin && curl -s http://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer
RUN cd /var/www && composer install && cp .env.example .env && php artisan key:generate

WORKDIR /var/www