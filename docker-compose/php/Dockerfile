FROM composer:2.1.14 AS composer
FROM php:8.1.0-apache AS shared
# user
ARG USERNAME=app
ARG USER_UID=1000
ARG USER_GID=$USER_UID
RUN groupadd --gid $USER_GID $USERNAME \
  && useradd --uid $USER_UID --gid $USER_GID -m $USERNAME
# packages
RUN apt-get update && apt-get install -y --no-install-recommends \
  git \
  && apt-get clean && rm -rf /var/lib/apt/lists/*
# PHP
RUN apt-get update && apt-get install -y \
  libicu-dev \
  libjpeg-dev \
  libpng-dev \
  libpq-dev \
  libzip-dev \
  unzip \
  && docker-php-ext-configure gd \
  --with-jpeg \
  && docker-php-ext-install \
  bcmath \
  gd \
  intl \
  pdo_mysql \
  pdo_pgsql \
  zip \
  && apt-get clean && rm -rf /var/lib/apt/lists/*
COPY ./php/my.ini /usr/local/etc/php/conf.d/
# Apache2
ENV APACHE_RUN_USER=app
ENV APACHE_RUN_GROUP=app
RUN chown ${APACHE_RUN_USER}:${APACHE_RUN_GROUP} /var/www/html \
  && chown ${APACHE_RUN_USER}:${APACHE_RUN_GROUP} /var/run/apache2 \
  && chown ${APACHE_RUN_USER}:${APACHE_RUN_GROUP} /var/lock/apache2 \
  && chown -R --no-dereference ${APACHE_RUN_USER}:${APACHE_RUN_GROUP} /var/log/apache2
RUN a2enmod rewrite
ARG APACHE_DOCUMENT_ROOT=/var/www/html/laravel/public
ENV APACHE_DOCUMENT_ROOT ${APACHE_DOCUMENT_ROOT}
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
COPY ./apache2/001-my.conf /etc/apache2/sites-available/001-my.conf
RUN a2dissite 000-default \
  && a2ensite 001-my
ENV APP_ENV laravel
# Supervisor
RUN apt-get update && apt-get install -y --no-install-recommends \
  busybox-static \
  supervisor=4.2.2-2 \
  && apt-get clean && rm -rf /var/lib/apt/lists/*
RUN mkdir -p /var/log/supervisor
COPY ./supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY ./crontabs/ /var/spool/cron/crontabs/
RUN ln -sf /dev/stdout /var/log/cron
CMD ["/usr/bin/supervisord"]

FROM shared AS local
COPY --from=composer /usr/bin/composer /usr/bin/composer
# Node.js
RUN curl -o nodejs.deb https://deb.nodesource.com/node_16.x/pool/main/n/nodejs/nodejs_16.13.2-deb-1nodesource1_amd64.deb \
  && apt-get update && apt-get install -y ./nodejs.deb \
  && rm ./nodejs.deb \
  && apt-get clean && rm -rf /var/lib/apt/lists/*

#FROM composer AS build_composer
#ENV APP_ENV laravel
#COPY --chown=www-data:www-data ./composer.json ./composer.lock ./
#RUN composer install --prefer-dist --no-dev --no-autoloader --no-scripts --no-progress --no-suggest --no-interaction
#COPY --chown=www-data:www-data . .
#RUN composer dump-autoload \
#  && composer run-script post-root-package-install \
#  && composer run-script post-create-project-cmd
#
#FROM node:14.15.0 AS build_npm
#WORKDIR /app
#COPY ./package.json ./package-lock.json ./
#RUN npm install
#COPY . .
#RUN npm run production
#
#FROM shared AS server
#COPY --from=build_composer --chown=www-data:www-data ./app/ .
#RUN touch ./database/database.sqlite
#COPY --from=build_npm --chown=www-data:www-data ./app/public/css ./public/css
#COPY --from=build_npm --chown=www-data:www-data ./app/public/js ./public/js
#COPY --from=build_npm --chown=www-data:www-data ./app/public/mix-manifest.json ./public/mix-manifest.json
