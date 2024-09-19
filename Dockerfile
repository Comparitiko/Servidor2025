# Utiliza la imagen de PHP con FPM
FROM php:8.1-fpm-alpine

# Instala extensiones necesarias de PHP, como mysqli o pdo
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Define el directorio raíz del servidor
WORKDIR /var/www/html

# Copia el código fuente al contenedor
COPY ./src /var/www/html
