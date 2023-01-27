FROM php:8.1-fpm

ARG UID
ARG GID

ENV UID=${UID}
ENV GID=${GID}


RUN groupadd --gid $GID laravel \
&& useradd --uid $UID --gid laravel --shell /bin/bash --create-home laravel


RUN apt-get update && apt-get install -y --no-install-recommends \
		libfreetype6-dev \
		libzip-dev \
        unzip \
        zip \
        ffmpeg \
        && docker-php-ext-install -j$(nproc) pdo_mysql mysqli \
        && docker-php-ext-install zip \
        # Install xDebug
        && pecl install xdebug \
        && docker-php-ext-enable xdebug \
        ## Install Composer
        && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
        && composer --version


USER $UID

EXPOSE 9000
CMD ["php-fpm"]
