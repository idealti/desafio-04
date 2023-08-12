FROM php:7.4-apache

# Instala as dependências necessárias e o driver mysqli
RUN apt-get update \
    && apt-get install -y libzip-dev \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip mysqli \
    && a2enmod rewrite

# Copia o conteúdo do diretório atual para o diretório do Apache
COPY ./src/ /var/www/html/