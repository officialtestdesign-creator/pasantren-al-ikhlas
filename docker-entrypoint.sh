#!/bin/bash
set -e

# Disable conflicting Apache MPMs
a2dismod mpm_event mpm_worker 2>/dev/null || true
a2enmod mpm_prefork 2>/dev/null || true

# Railway provides dynamic $PORT (fallback to 80)
PORT="${PORT:-80}"

# Configure Apache to listen on $PORT
sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/:80/:${PORT}/" /etc/apache2/sites-available/000-default.conf

exec "$@"
