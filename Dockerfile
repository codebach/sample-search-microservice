FROM php:7.2-fpm

MAINTAINER Ahmet Akbana

RUN apt-get update && apt-get install -y \
    build-essential \
    vim \
    git \
    libzip-dev \
    zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

# Install extensions
RUN docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install zip

# Add console alias
RUN echo 'alias console="php bin/console"' >> ~/.bashrc

# Configuration arguments
ARG PHP_MEMORY_LIMIT=2048M
ARG PHP_DATE_TIMEZONE=Europe/Berlin
ARG PHP_ERROR_REPORTING=E_ERROR
ARG PHP_DISPLAY_ERRORS=Off
ARG PHP_LOG_ERRORS=Off

# Set timezone and php memory limit
RUN echo "memory_limit=${PHP_MEMORY_LIMIT}" > /usr/local/etc/php/conf.d/memory_limit.ini
RUN echo "date.timezone=${PHP_DATE_TIMEZONE}" > /usr/local/etc/php/conf.d/date_timezone.ini

# Set error settings
RUN echo "error_reporting=${PHP_ERROR_REPORTING}" > /usr/local/etc/php/conf.d/error_reporting.ini
RUN echo "display_errors=${PHP_DISPLAY_ERRORS}" > /usr/local/etc/php/conf.d/display_errors.ini
RUN echo "log_errors=${PHP_LOG_ERRORS}" > /usr/local/etc/php/conf.d/log_errors.ini

WORKDIR /app
