FROM almalinux:9.5

ENV TZ=Europe/Paris
ENV PHP_VERSION=8.2
ENV PHP_INI_DIR=/etc/php.d/

# Timezone
RUN echo $TZ > /etc/timezone

RUN yum update -y

# Installation PHP
RUN dnf install -qy https://rpms.remirepo.net/enterprise/remi-release-9.rpm
RUN dnf install -qy dnf-utils
RUN dnf module enable -y php:remi-$PHP_VERSION
RUN dnf install -qy \
    php-fpm \
    php-opcache \
    php-cli \
    php-dom \
    php-sqlite3 \
    php-apcu \
    php-intl

# Configuration PHP
RUN mkdir /run/php-fpm
RUN echo "date.timezone = $TZ" >> $PHP_INI_DIR/0-custom.ini

# Installation Composer
RUN dnf -y install wget unzip
# https://getcomposer.org/doc/faqs/how-to-install-composer-programmatically.md
RUN wget https://raw.githubusercontent.com/composer/getcomposer.org/11cb825ad3d659a4f63fe591226b8f3545897914/web/installer -O - -q | php -- --quiet
RUN chmod u+x composer.phar
RUN mv composer.phar /usr/local/bin/composer

# Installation Caddy
RUN dnf install -qy 'dnf-command(copr)'
RUN dnf copr enable -qy @caddy/caddy
RUN dnf install -qy caddy

# Nettoyage
RUN dnf clean all && \
  rm -rf /var/cache/dnf

COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80 443
CMD ["/usr/local/bin/entrypoint.sh"]
