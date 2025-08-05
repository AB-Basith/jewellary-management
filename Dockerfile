FROM php:8.1-apache

# Enable Apache rewrite if your app uses clean URLs
RUN a2enmod rewrite

# Install PostgreSQL system libraries first 
RUN apt-get update && apt-get install -y libpq-dev


# Install PostgreSQL PHP extensions
RUN docker-php-ext-install pgsql pdo_pgsql

# Create subdirectory in Apache web root
RUN mkdir -p /var/www/html/

# Copy project into the Apache folder
#COPY . /var/www/html
COPY . /var/www/html/

# Change document root if needed:
# By default Apache looks at /var/www/html
# If your main entry is index.php in project root, it's fine.

# Install PHP extensions (if your app uses database)
RUN docker-php-ext-install mysqli pdo_mysql

# Set recommended permissions
RUN chown -R www-data:www-data /var/www/html/

EXPOSE 80

CMD ["apache2-foreground"]
