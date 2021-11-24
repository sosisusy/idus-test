FROM php:7.4-fpm

RUN apt-get update && apt-get install -y libzip-dev zip

RUN docker-php-ext-install zip mysqli pdo_mysql

RUN php -r "readfile('https://getcomposer.org/installer');" | php
RUN mv ./composer.phar /usr/local/bin/composer

WORKDIR /var/www

EXPOSE 9000

CMD [ "php-fpm" ]
