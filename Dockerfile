FROM php:8.3-apache

RUN docker-php-ext-install pdo pdo_mysql \
    && a2enmod rewrite

COPY LavaLust/ /var/www/lavalust/

ENV APACHE_DOCUMENT_ROOT=/var/www/lavalust/public

RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf \
    && printf '<Directory /var/www/lavalust/public>\n    AllowOverride All\n    Require all granted\n</Directory>\n' > /etc/apache2/conf-available/lavalust.conf \
    && a2enconf lavalust \
    && chown -R www-data:www-data /var/www/lavalust \
    && chmod -R 755 /var/www/lavalust

EXPOSE 80
