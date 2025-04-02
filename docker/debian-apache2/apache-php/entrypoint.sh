#!/bin/bash

echo "Starting PHP-FPM in background"
service php8.2-fpm start

echo "Starting Apache"
rm -f /var/run/apache2/apache2.pid
apachectl -D FOREGROUND
