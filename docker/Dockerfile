FROM php:8.1.22-apache

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y \
    unzip \
    nodejs \
    npm \
    && rm -rf /var/lib/apt/lists/*

COPY web.conf /etc/apache2/sites-available/

RUN a2ensite web.conf

RUN service apache2 restart

RUN chown -R www-data:www-data /var/www/html

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

EXPOSE 80
