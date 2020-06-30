FROM php:7.4-fpm

# libs:
# for pecl (c compile): mc autoconf libtool automake make g++
# for pecl_http (1): zlib1g-dev libssl-dev libcurl4-openssl-dev libbrotli-dev libevent-dev
# for pecl_http (2): libicu-dev libidn11-dev libidn2-0-dev
# for pdo_pgsql: libpq-dev

RUN apt-get upgrade && apt-get update && apt-get install -y \
    git \
    wget \
    mc \
    autoconf \
    libtool \
    automake \
    make \
    g++ \
    zlib1g-dev \
    libssl-dev \
    libcurl4-openssl-dev \
    libbrotli-dev \
    libevent-dev \
    libicu-dev \
    libidn11-dev \
    libidn2-0-dev \
    libmemcached-dev \
    libpq-dev

RUN pecl install -of propro && docker-php-ext-enable propro
RUN pecl install -of raphf && docker-php-ext-enable raphf
RUN pecl install -of redis && docker-php-ext-enable redis
RUN pecl install -of memcached && docker-php-ext-enable memcached
RUN pecl install pecl_http && docker-php-ext-enable http
RUN pecl install mongodb && docker-php-ext-enable mongodb
RUN docker-php-ext-install sockets

RUN docker-php-ext-install pgsql pdo_pgsql
RUN docker-php-ext-install pdo_mysql

RUN pecl install -of xdebug-2.9.4
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# select PROD or DEV
#RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN cp "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/conf.d/php.ini"
RUN cp "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# install composer under system user (non root!)
#RUN groupadd -r devs && useradd devops --no-log-init -r -g devs
#USER devops:devs

#EXPOSE 80
#EXPOSE 8888
#EXPOSE 3306

WORKDIR /var/www/site.local
CMD ["php-fpm"]
#CMD ["nginx", "-g", "daemon off;"]
