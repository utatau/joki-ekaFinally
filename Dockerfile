FROM php:8.2-apache
RUN apt-get update && apt-get install -y \
    libicu-dev \
    unzip \
    git \
    zip \
    curl \
    libzip-dev \
    && docker-php-ext-install intl zip pdo pdo_mysql \
    && apt-get clean

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

RUN a2enmod rewrite