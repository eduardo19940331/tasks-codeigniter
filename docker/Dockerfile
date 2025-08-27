FROM php:8.2-fpm

# Crear usuario "appuser" con UID 1000 y GID 1000
RUN groupadd -g 1000 appuser && \
    useradd -u 1000 -g appuser -m appuser

# Instalar dependencias necesarias para extensiones PHP
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libicu-dev \
    libonig-dev \
    unzip \
    git \
    pkg-config \
    build-essential \
    g++ \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo pdo_pgsql intl mbstring pgsql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Cambiar propietario del proyecto a este usuario
WORKDIR /var/www/html
RUN chown -R appuser:appuser /var/www/html

# Cambiar al usuario appuser
USER appuser
