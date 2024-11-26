FROM php:8.4-fpm

RUN apt-get update && apt-get upgrade -y
RUN apt-get install git nano unzip libssl-dev -y

RUN curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php

RUN pecl install mongodb && docker-php-ext-enable mongodb
RUN echo "extension=mongodb.so" >> /usr/local/etc/php/php.ini

RUN curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php

RUN cd ~

RUN HASH=`curl -sS https://composer.github.io/installer.sig`
RUN php -r "if (hash_file('SHA384', '/tmp/composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo pdo_mysql

# Copiar el script de entrada
COPY ./entrypoints/php.entrypoint.sh /entrypoints/entrypoint.sh

# Asegurar permisos de ejecución
RUN chmod +x /entrypoints/entrypoint.sh

# Configurar el script de entrada como punto de entrada
ENTRYPOINT ["/entrypoints/entrypoint.sh"]

CMD ["php-fpm"]