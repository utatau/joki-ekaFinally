FROM php:8.2-cli
RUN apt-get update && apt-get upgrade -y \  
    zlib1g-dev \
    libzip-dev \
    unzip
RUN docker-php-ext-install zip

COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer self-update

RUN composer install
CMD php spark serve