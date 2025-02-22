FROM php:8.3-fpm

# Установка необходимых пакетов
RUN apt-get update && apt-get install -y \
      apt-utils \
      libpq-dev \
      libpng-dev \
      libjpeg-dev \
      libfreetype6-dev \
      libzip-dev \
      zip unzip \
      git && \
      # Конфигурация GD
      docker-php-ext-configure gd --with-freetype --with-jpeg && \
      # Установка расширений PHP
      docker-php-ext-install pdo_mysql bcmath gd zip && \
      docker-php-ext-install pcntl && \
      apt-get clean && \
      rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Копирование php.ini
COPY ./docker/app/php.ini /usr/local/etc/php/conf.d/php.ini

# Установка Composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

# Установка рабочего каталога
WORKDIR /var/www/html
