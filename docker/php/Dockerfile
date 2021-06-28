FROM php:7.3-fpm
COPY ./docker/php/php.ini /usr/local/etc/php/

RUN apt-get update \
  && apt-get install --no-install-recommends -y \
    apt-transport-https \
    apt-utils \
    build-essential \
    curl \
    debconf-utils \
    gcc \
    git \
    gnupg2 \
    libfreetype6-dev \
    libicu-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libpq-dev \
    libzip-dev \
    locales \
    ssl-cert \
    unzip \
    vim \
    zlib1g-dev \
    mariadb-client \
    git \
  && docker-php-ext-install zip pdo_mysql intl \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/* \
  && echo "en_US.UTF-8 UTF-8" >/etc/locale.gen \
  && locale-gen

#Composer install
COPY --from=composer:1.10.16 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin
#RUN composer global require hirak/prestissimo
#RUN composer global require laravel/installer

#npm install
RUN curl -sL https://deb.nodesource.com/setup_11.x | bash -
RUN apt-get install -y nodejs
RUN npm install npm@latest -g

RUN mkdir -p /var/www/laravel/
COPY . /var/www/

#laravel setup
WORKDIR /var/www/laravel/

RUN COMPOSER_MEMORY_LIMIT=-1 composer install
RUN cp .env.docker .env
RUN php artisan key:generate
#RUN php artisan migrate:refresh --seed
RUN chmod -R a+w storage/ bootstrap/cache

WORKDIR /var/www/

RUN rm -rf /var/www/html