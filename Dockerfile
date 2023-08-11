FROM php:apache

# Copia o arquivo de configuração do X-Debug para dentro do diretório de configurações do PHP
COPY docker/xdebug/90-xdebug.ini "${PHP_INI_DIR}/conf.d"

# Instala as extensões mysqli e X-Debug
RUN docker-php-ext-install mysqli
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

# Habilita o módulo de Rewrite do Apache, para que o arquivo de configuração possa funcionar corretamente
RUN cd /etc/apache2/mods-available/ && \
    a2enmod rewrite.load

# Determina o diretório raíz do projeto
WORKDIR /var/www/html