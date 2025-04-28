#!/bin/bash

echo "Starting PHP-FPM in background"
php-fpm -D

echo "Starting Caddy"
caddy run --config /etc/caddy/Caddyfile
