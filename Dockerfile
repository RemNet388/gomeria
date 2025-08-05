FROM php:8.2-fpm

# Requisitos para Laravel y Vite
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev nodejs npm \
    && docker-php-ext-install pdo_mysql zip

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set work directory
WORKDIR /var/www

# Copiar proyecto
COPY . .

# Instalar dependencias
RUN composer install --no-interaction --prefer-dist --optimize-autoloader
RUN npm install && npm run build

# Permisos
RUN chown -R www-data:www-data /var/www

# Exponer el puerto
EXPOSE 3000

# Comando para iniciar Laravel
CMD php artisan serve --host=0.0.0.0 --port=3000
