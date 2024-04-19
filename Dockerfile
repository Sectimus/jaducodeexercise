# Use an official PHP runtime as a parent image
FROM php:8.3-apache
RUN a2enmod rewrite

WORKDIR /var/www

# Install Symfony and dependencies
RUN apt-get update \
    && apt-get install -y libzip-dev git wget --no-install-recommends \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install PHP extensions
RUN docker-php-ext-install pdo mysqli pdo_mysql zip;

# Install Composer
RUN wget https://getcomposer.org/download/2.0.9/composer.phar \ 
    && mv composer.phar /usr/bin/composer && chmod +x /usr/bin/composer

# Apache configuration file
COPY /apache.conf /etc/apache2/sites-enabled/000-default.conf

# Entrypoint script
COPY /entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Copy the project contents into the container at /var/www
COPY . /var/www

# Set permissions
RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www/var/cache/dev

# Expose port 80
EXPOSE 80

# Start Apache web server
CMD ["apache2-foreground"]

ENTRYPOINT ["/entrypoint.sh"]