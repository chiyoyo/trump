FROM php:8.1-apache

RUN apt-get update && apt-get install -y bash zip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
