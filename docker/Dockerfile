FROM php:8.4-fpm as app

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libicu-dev \
    libpq-dev \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    pdo_pgsql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    intl \
    opcache

RUN pecl install redis && docker-php-ext-enable redis

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN groupadd -g 1000 www && \
    useradd -u 1000 -g www -s /bin/sh -d /home/www www && \
    mkdir -p /home/www && \
    chown -R www:www /home/www

WORKDIR /var/www

COPY --chown=www:www . .

RUN composer install --optimize-autoloader --no-dev --no-interaction --no-progress

RUN php artisan optimize && \
    php artisan event:cache && \
    php artisan view:cache

RUN chmod -R 775 storage bootstrap/cache

USER www

EXPOSE 9000

CMD ["php-fpm"]
