FROM php:8.2-fpm

RUN apt-get update
RUN apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql
RUN apt-get install -y libc-client-dev libkrb5-dev
RUN apt-get install -y unzip libzip-dev && docker-php-ext-install zip
RUN pecl install apcu && docker-php-ext-enable apcu
RUN apt-get install -y libicu-dev && docker-php-ext-configure intl && docker-php-ext-install intl
RUN docker-php-ext-install opcache

RUN apt-get install -y git

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN mv composer.phar /usr/local/bin/composer
RUN php -r "unlink('composer-setup.php');"

CMD php-fpm