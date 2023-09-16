FROM php:8.1-fpm-alpine
# Add bash
RUN apk --no-cache add bash

# Install required packages, including ICU
RUN apk update && apk add --no-cache \
    git \
    zlib-dev \
    libxml2-dev \
    libzip-dev \
    icu-dev

# Install PHP extensions with ICU support
RUN docker-php-ext-install \
    zip \
    intl \
    mysqli \
    pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy your Symfony app files
COPY symfony/ /var/www/symfony

# Set the working directory
WORKDIR /var/www/symfony/
