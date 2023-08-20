FROM php:8.2.0-cli

# Mise à jour et installation des dépendances nécessaires
RUN apt-get update && apt-get install -y --no-install-recommends \
        locales apt-utils git libicu-dev g++ libpng-dev libxml2-dev libzip-dev libonig-dev libxslt-dev unzip libpq-dev nodejs npm wget \
        apt-transport-https lsb-release ca-certificates

# Configuration des locales
RUN echo "en_US.UTF-8 UTF-8" > /etc/locale.gen  \
    && echo "fr_FR.UTF-8 UTF-8" >> /etc/locale.gen \
    && locale-gen

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    && mv composer.phar /usr/local/bin/composer

# Installation des extensions PHP nécessaires
RUN docker-php-ext-configure intl \
    && docker-php-ext-install \
            pdo pdo_mysql pdo_pgsql opcache intl zip calendar dom mbstring gd xsl

# Installer APCu et l'activer
RUN pecl install apcu && docker-php-ext-enable apcu

# Installer Yarn
RUN npm install --global yarn

# Définir le répertoire de travail
WORKDIR /var/www/html/

# Copier les fichiers composer pour installer les dépendances
COPY composer.json composer.lock ./
RUN composer install --prefer-dist --no-scripts --no-progress --no-interaction

# Copier le reste du code source de l'application
COPY . .

# Installer les dépendances avec Composer
RUN composer install

# Ajuster les permissions pour le dossier "var" de Symfony
RUN chown -R www-data:www-data var


# Exposer le port 8000
EXPOSE 8000

# Utiliser le serveur PHP intégré pour servir l'application
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
