FROM node:14-alpine AS BUILD_VUE
WORKDIR /usr/app
RUN apk --no-cache add curl
RUN curl -sfL https://install.goreleaser.com/github.com/tj/node-prune.sh | sh -s -- -b /usr/local/bin

COPY . .

RUN yarn install --frozen-lockfile

RUN yarn run build

RUN npm prune --production


FROM php:7.4-fpm AS BUILD_PHP

# Install system dependencies
RUN apt-get update && apt-get install -y \
    curl \
    zip \
    unzip


# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /usr/app

COPY --from=BUILD_VUE /usr/app /usr/app


RUN composer install --no-dev


FROM php:7.4-fpm-alpine

RUN apk add --no-cache libpng-dev libxml2-dev oniguruma-dev
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
WORKDIR /var/www
COPY --from=BUILD_PHP /usr/app /var/www
RUN chown -R www-data:www-data storage/
RUN php artisan key:generate

