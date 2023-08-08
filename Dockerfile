# Usar a imagem base do PHP com Apache
FROM php:apache

# Define as permissões do diretório de documentos do Apache
RUN chown -R www-data:www-data /var/www/html

# Instalar o módulo do PHP para o MySQL
RUN docker-php-ext-install mysqli

# Habilitar o módulo de reescrita do Apache
RUN a2enmod rewrite

# Reiniciar o servidor Apache para aplicar as alterações
RUN service apache2 restart

# Instalar o editor de texto nano (opcional, se você ainda desejar o nano)
RUN apt-get update && apt-get install -y nano

# Copiar o conteúdo do diretório "src" para o diretório de documentos do Apache
COPY ./src /var/www/html

# Iniciar o servidor Apache
CMD ["apache2-foreground"]
