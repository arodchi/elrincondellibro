FROM php:8.2-apache

# Instalar extensiones mysqli y pdo_mysql
RUN docker-php-ext-install mysqli pdo_mysql

# Habilitar mod_rewrite si lo necesitas
RUN a2enmod rewrite
