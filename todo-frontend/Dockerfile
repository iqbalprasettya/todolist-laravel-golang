FROM php:8.2-fpm

# Install extensions buat Laravel
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libzip-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Install Node.js dan NPM
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set directory
WORKDIR /var/www/html

# Salin semua project ke dalam container
COPY . .

# Install dependency Laravel dan Node.js
RUN composer install
RUN npm install
RUN npm run build

# Expose port Laravel
EXPOSE 8000

# Jalankan Laravel di 0.0.0.0
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
