#!/bin/bash

# Entrar al directorio de la practica1 tema 5
cd /var/www/html/tema5/practica1
rm -rf vendor
rm -rf composer.lock
# Instalar dependencias
composer install

# Entrar al directorio de la practica3 tema 5
cd /var/www/html/tema5/practica3
rm -rf vendor
rm -rf composer.lock
# Instalar dependencias
composer install

# Dar permisos de escritura al directorio de imágenes a php
chown -R www-data:www-data /var/www/html/tema5/practica3/assets/images/articles

# Ejecutar PHP-FPM como proceso principal
exec php-fpm