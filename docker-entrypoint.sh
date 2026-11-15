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

# Pass environment variables to Apache and PHP
echo "PassEnv RAILWAY_PUBLIC_DOMAIN RAILWAY_STATIC_URL RAILWAY_ENVIRONMENT MYSQLHOST MYSQLPORT MYSQLUSER MYSQLPASSWORD MYSQLDATABASE MYSQL_URL" > /etc/apache2/conf-available/railway-env.conf
a2enconf railway-env 2>/dev/null || true

exec "$@"
