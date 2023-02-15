FROM php:8.2.2-fpm

LABEL maintainer="archer"

RUN apt-get update -y && apt-get upgrade -y && apt-get install -y git && apt-get install -y libpq-dev libzip-dev zip zlib1g-dev libjpeg-dev libpng-dev && rm -rf /var/lib/apt/lists/*

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && docker-php-ext-install pdo pdo_mysql

RUN chmod +x /usr/local/bin/install-php-extensions && install-php-extensions zip && install-php-extensions gd \
    && install-php-extensions igbinary \
    && install-php-extensions redis \
    && install-php-extensions opcache \
    && install-php-extensions bcmath \
    && install-php-extensions imagick \
    && install-php-extensions exif \
    && install-php-extensions pdo_pgsql \
    && install-php-extensions pgsql \
    && install-php-extensions simdjson

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

#RUN #docker-php-ext-install zip gd
#RUN docker-php-ext-configure gd --enable-gd-native-ttf --with-freetype-dir=/usr/include/freetype2 --with-png-dir=/usr/include --with-jpeg-dir=/usr/include
#RUN docker-php-ext-enable gd
#RUN pecl install igbinary && docker-php-ext-enable igbinary
#RUN pecl install redis && docker-php-ext-enable redis

