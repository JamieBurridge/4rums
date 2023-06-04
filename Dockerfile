FROM php:8.2-rc-apache

WORKDIR /
COPY . /var/www/html

#RUN echo "ServerName localhost:80" >> /etc/apache2/apache2.conf
RUN docker-php-ext-install pdo pdo_mysql && docker-php-ext-enable pdo_mysql

EXPOSE 80

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
