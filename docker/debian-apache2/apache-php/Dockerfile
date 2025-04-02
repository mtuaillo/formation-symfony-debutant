FROM debian:12.9

ENV DEBIAN_FRONTEND=noninteractive \
    TZ=Europe/Paris

ENV PHP_VERSION=8.2
ENV PHP_INI_DIR=/etc/php/$PHP_VERSION/

# Timezone
RUN echo $TZ > /etc/timezone

RUN apt-get update -yqq

# Installation de git, requis par composer
RUN apt-get install git -yqq

# Installation PHP
RUN apt-get install -yqq \
    php$PHP_VERSION-fpm \
    php$PHP_VERSION-cli \
    php$PHP_VERSION-dom \
    php$PHP_VERSION-sqlite3 \
    php$PHP_VERSION-apcu \
    php$PHP_VERSION-intl

# Configuration PHP
RUN mkdir -p $PHP_INI_DIR/conf.d
RUN echo "date.timezone = $TZ" >> $PHP_INI_DIR/fpm/conf.d/0-custom.ini

# Installation de Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"

# Installation Apache
RUN apt-get install --no-install-recommends apache2 libapache2-mod-fcgid -yqq
RUN a2enconf php$PHP_VERSION-fpm
RUN a2enmod proxy_fcgi
RUN a2enmod ssl
RUN a2enmod http2
RUN a2dissite 000-default
RUN mkdir /var/log/apache2/app/

# Certificat auto-signé pour HTTPS
RUN mkdir -p /etc/ssl/private/apache
RUN openssl req -newkey rsa:2048 -nodes -keyout /etc/ssl/private/apache/localhost.key -x509 -days 365 -out /etc/ssl/private/apache/localhost.crt -subj "/ST=ST/L=L/O=O/OU=OU/CN=CN"

COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80 443
CMD ["/usr/local/bin/entrypoint.sh"]
