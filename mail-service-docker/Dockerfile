FROM php:8.1-apache-buster

ENV APP_HOME=/var/www/app
ENV APACHE_DOCUMENT_ROOT=${APP_HOME}/public
ENV COMPOSER_HOME=/var/lib/composer

WORKDIR /tmp

RUN sed -i '/jessie-updates/d' /etc/apt/sources.list

RUN useradd -u 500 mailservice

RUN apt-get update --allow-releaseinfo-change && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        unzip \
        bzip2
RUN docker-php-ext-install pdo pdo_mysql
RUN apt-get install -y ansible
RUN apt-get install -y git
RUN apt-get install -y libpng-dev
RUN apt-get install -y libzip-dev
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) gd zip

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash -
RUN apt-get install -y nodejs

RUN sed -ri -e "s!www-data!mailservice!g" /etc/apache2/envvars
RUN sed -ri -e "s!/var/www/html!$APACHE_DOCUMENT_ROOT!g" /etc/apache2/sites-available/*.conf
RUN sed -ri -e "s!/var/www/!$APACHE_DOCUMENT_ROOT!g" /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

COPY ./config/php.ini /usr/local/etc/php/

RUN a2enmod rewrite

VOLUME ["$COMPOSER_HOME/cache", "$APP_HOME"]

EXPOSE 80

WORKDIR ${APP_HOME}

ENTRYPOINT ["apache2-foreground"]
