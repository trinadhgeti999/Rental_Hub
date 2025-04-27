# Step 1: Use an official PHP image with necessary extensions
FROM php:8.2-fpm

# Step 2: Install necessary dependencies for PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Step 3: Install Node.js 18.x (or later) and npm
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Step 4: Set the working directory
WORKDIR /var/www

# Step 5: Copy the application files into the container
COPY . .

# Step 6: Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Step 7: Install Composer dependencies
RUN composer install --optimize-autoloader --no-dev

# Step 8: Set proper permissions for the Laravel app
RUN chown -R www-data:www-data /var/www
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Step 9: Install NPM dependencies and build assets
RUN npm install && npm run build

# Step 10: Expose port 8000
EXPOSE 8000

# Step 11: Start the application (PHP server)
CMD ["php", "artisan", "serve", "--host=0.0.0.0"]
