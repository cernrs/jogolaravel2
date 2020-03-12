FROM php:7.2-fpm

# Install PHP extensions
RUN apt-get update && apt-get install -y \
      libicu-dev \
      libpq-dev \
      libmcrypt-dev \
      zlib1g-dev \
      libjpeg-dev \
      libpng-dev \
      curl \
      software-properties-common \
      gnupg \
    && rm -r /var/lib/apt/lists/* \
    && docker-php-ext-install \
      intl \
      mbstring \
      tokenizer \
      opcache

RUN curl -sL https://deb.nodesource.com/setup_9.x | bash - \
   && curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
   && echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list

RUN apt-get update \
   && apt-get install -y nodejs

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql pdo_pgsql

RUN apt-get install libmcrypt-dev
RUN pecl install mcrypt-1.0.1 && docker-php-ext-enable mcrypt

RUN apt-get update && apt-get -y install rsyslog