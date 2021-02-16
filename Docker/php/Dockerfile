FROM php:7.4-fpm

RUN docker-php-source extract && \
        docker-php-ext-install \
            pdo_mysql && \
        docker-php-ext-configure \
            pdo_mysql && \
    docker-php-source delete && \
    pecl channel-update pecl.php.net && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug && \
    apt update && apt upgrade -y && \
    apt install libpcre3-dev -y && \
    pecl install phalcon && \
    mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini" && \
    echo "extension=psr.so" | tee -a "$PHP_INI_DIR/php.ini" && \
    echo "extension=phalcon.so" | tee -a "$PHP_INI_DIR/php.ini"

COPY ./xdebug-conf.ini /usr/local/etc/php/conf.d/

WORKDIR /var/www/
