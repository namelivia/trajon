FROM php:7.4-fpm

# Copy composer.lock and composer.json
#COPY composer.lock composer.json /var/www/
COPY composer.json /var/www/

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libzip-dev \
    libfreetype6-dev \
    locales \
    zip \
    supervisor \
    nginx \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    nodejs \
    npm \
    git \
    curl

# Clear cache
RUN rm /etc/nginx/sites-enabled/default

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo_mysql zip exif pcntl
RUN docker-php-ext-install gd
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing application directory contents
COPY . /var/www

# Copy nginx configuration
COPY ./nginx/conf.d/ /etc/nginx/conf.d/

# Copy supervisor configuration
COPY ./supervisor/conf.d/ /etc/supervisor/conf.d/

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www

# Expose ports and start supervisor
EXPOSE 80
CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
