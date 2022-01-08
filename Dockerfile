FROM node:14-alpine as VUE_BUILD

WORKDIR /app
COPY . .

RUN yarn install --frozen-lockfile

RUN yarn run build


FROM webdevops/php-nginx:7.4-alpine

RUN apk add oniguruma-dev libxml2-dev
RUN docker-php-ext-install \
        bcmath \
        ctype \
        fileinfo \
        json \
        mbstring \
        pdo_mysql \
        xml

# Copy Composer binary from the Composer official Docker image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV WEB_DOCUMENT_ROOT /app/public
WORKDIR /app
COPY . .
COPY --from=VUE_BUILD /app/public ./public

RUN composer install --no-interaction --optimize-autoloader

# nginx
COPY docker/nginx/vhost.conf /opt/docker/etc/nginx/vhost.conf
COPY docker/nginx/10-general.conf /opt/docker/etc/nginx/vhost.common.d/10-general.conf
COPY docker/nginx/10-location-root.conf /opt/docker/etc/nginx/vhost.common.d/10-location-root.conf
COPY docker/nginx/10-php.conf /opt/docker/etc/nginx/vhost.common.d/10-php.conf


RUN chown -R application:application .
