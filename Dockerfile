FROM ubuntu:20.04

RUN apt update

RUN apt install php7.4-fpm -y \
    curl

RUN apt-get install php-cli -y \
    unzip \
    php-xml \
    php-mysql \
    php-curl \
    php-mbstring \
    php-xdebug \
    php-codecoverage

RUN curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php

RUN curl -sL https://deb.nodesource.com/setup_14.x -o /tmp/nodesource_setup.sh

RUN php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer

COPY . .

RUN /bin/sh -c /bin/sh -c touch .env

RUN chmod +x docker/laravel.sh

ENTRYPOINT ["docker/laravel.sh"]