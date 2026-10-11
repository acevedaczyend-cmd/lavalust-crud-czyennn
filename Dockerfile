FROM php:8.3-apache

RUN docker-php-ext-install pdo pdo_mysql \
    && a2enmod rewrite

COPY LavaLust/ /var/www/lavalust/

ENV APACHE_DOCUMENT_ROOT=/var/www/lavalust/public

RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf \
    && chown -R www-data:www-data /var/www/lavalust \
    && chmod -R 755 /var/www/lavalust

EXPOSE 80