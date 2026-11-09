FROM php:7.4-apache

# Ensure only mpm_prefork is enabled to avoid Apache MPM conflict on cloud runners
RUN a2dismod mpm_event mpm_worker 2>/dev/null || true \
    && a2enmod mpm_prefork 2>/dev/null || true

# Install mysqli, pdo, and pdo_mysql extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite for CodeIgniter routing
RUN a2enmod rewrite

# Configure Apache Directory permissions and AllowOverride
RUN echo "<Directory /var/www/html>\n\
    Options -Indexes +FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>" >> /etc/apache2/apache2.conf

# Copy application source code
COPY . /var/www/html/

# Ensure web server has write access to uploads, cache, and logs
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/uploads \
    && chmod -R 775 /var/www/html/application/cache \
    && chmod -R 775 /var/www/html/application/logs

# Install and prepare entrypoint script for dynamic Railway PORT binding
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]
