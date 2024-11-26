#!/bin/bash

# Entrar al directorio de la practica1 tema 5
cd /var/www/html/tema5/practica1

# Instalar dependencias
composer install

## Entrar al directorio de la practica3 tema 5
#cd /var/www/html/tema5/practica3
#
## Instalar dependencias
#composer install

# Ejecutar PHP-FPM como proceso principal
exec php-fpm