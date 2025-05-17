FROM php:8.3-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
        git \
        curl \
        zip \
        unzip \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libonig-dev \
        libxml2-dev \
        libzip-dev \
        nodejs \
        npm \
        autoconf \
        make \
        gcc \
        g++ \
        libc6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip opcache \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt-get purge -y --auto-remove autoconf make gcc g++ libc6-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN apt-get install -y libzip4

WORKDIR /var/www/prod_My_Resume

RUN chown -R www-data:www-data /var/www/prod_My_Resume

EXPOSE 9000

CMD ["php-fpm"]
