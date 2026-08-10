#################################################
# Base image
#################################################

ARG PHP_VERSION=8.5-fpm

FROM php:${PHP_VERSION}

#################################################
# Build Arguments
#################################################

ARG UID=1000
ARG GID=1000

#################################################
# System packages
#################################################

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    autoconf \
    g++ \
    make \
    pkg-config \
    libzip-dev \
    libicu-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        bcmath \
        intl \
        zip \
        gd \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

#################################################
# Composer
#################################################

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

#################################################
# Configuration
#################################################

COPY docker/php/php.ini /usr/local/etc/php/conf.d/custom.ini

#################################################
# User
#################################################

RUN groupadd -g ${GID} app \
    && useradd -u ${UID} -g app -m -s /bin/bash app

#################################################
# Working directory
#################################################    

WORKDIR /backend

USER app