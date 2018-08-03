
FROM php:7.1-fpm

MAINTAINER André Kiffer <andre.kiffer@madeiramadeira.com.br>

RUN apt-get update && apt-get upgrade -y
RUN export DEBIAN_FRONTEND=noninteractive && apt-get install -y --force-yes libssl-dev curl  libcurl4-gnutls-dev libxml2-dev libicu-dev libmcrypt-dev  libmemcached11 libmemcached-dev

#CONFIGURAÇÕES DO OPCACHE
RUN docker-php-ext-install opcache

#CONFIGURAÇÕES DO APCU
RUN pecl install apcu-5.1.5 && docker-php-ext-enable apcu

#LIBS EXTRAS
RUN docker-php-ext-install bcmath
RUN apt-get install -y libbz2-dev memcached
RUN docker-php-ext-install bz2
RUN docker-php-ext-install mbstring
RUN apt-get install -y libmcrypt-dev
RUN docker-php-ext-install mcrypt
RUN apt-get install -y libpq-dev
RUN apt-get install -y libicu-dev
RUN docker-php-ext-install intl
RUN apt-get install -y libz-dev libmemcached-dev
RUN pecl install memcached

#GD
RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install gd

#PDO - CUSTOMIZAR A SEU DISPOR
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install pdo pdo_pgsql

RUN echo "extension=memcached.so" > /usr/local/etc/php/conf.d/memcached.ini
RUN echo "date.timezone=America/Sao_Paulo" > /usr/local/etc/php/conf.d/timezone_sao_paulo.ini
RUN echo "memory_limit = 1024M" > /usr/local/etc/php/conf.d/memory_limit.ini


RUN docker-php-ext-install pcntl
RUN docker-php-ext-install soap
RUN pecl install redis
RUN echo "extension=redis.so" > /usr/local/etc/php/conf.d/redis.ini
RUN apt-get update && apt-get install -y pdftk poppler-utils texlive-extra-utils
RUN apt-get install -y libxrender1 libfontconfig1
RUN apt-get install -y wget && wget https://github.com/wkhtmltopdf/wkhtmltopdf/releases/download/0.12.4/wkhtmltox-0.12.4_linux-generic-amd64.tar.xz && tar xf wkhtmltox-0.12.4_linux-generic-amd64.tar.xz && cd ./wkhtmltox && cp -R ./* /usr/
RUN mkdir -p /tmp/pdf

# Install PHP ZIP Archive
RUN apt-get install -y zlib1g-dev && rm -rf /var/lib/apt/lists/* && docker-php-ext-install zip

# Install PHP extGD
RUN docker-php-ext-install gd
RUN docker-php-ext-install dom
RUN docker-php-ext-install intl

# Install IMAP extension
RUN apt-get update && apt-get install -y libc-client-dev libkrb5-dev && rm -r /var/lib/apt/lists/*
RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-ext-install imap

# Install SPED-CTe
RUN apt-get update && apt-get install -y libcurl3-dev

EXPOSE 9000
CMD ["php-fpm"]
