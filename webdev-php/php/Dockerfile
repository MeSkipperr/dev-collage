FROM php:8.2-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY apache.conf /etc/apache2/conf-available/custom.conf

RUN a2enconf custom
RUN a2enmod rewrite