FROM php:8.2-apache

LABEL maintainer="Takács Ákos <rimelek@it-sziget.hu>"

WORKDIR /var/www/html

COPY --chown=www-data:www-data examples /var/www/html/examples/
COPY index.php LICENSE README.md /var/www/html/

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \   
 && echo "phar.readonly = Off" >> "$PHP_INI_DIR/php.ini"

EXPOSE 80