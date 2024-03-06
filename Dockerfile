# Utiliser une image PHP officielle comme base
FROM php:8.2-apache
# Après l'instruction FROM et les installations potentielles
RUN echo 'ServerName localhost' >> /etc/apache2/apache2.conf

# Mettre à jour les paquets et installer les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
        libpq-dev \
    && docker-php-ext-install \
        pdo pdo_pgsql
RUN apt-get install -y nano vim

# Installer Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

RUN sed -i '/<\/VirtualHost>/i\<Directory /var/www/html/public>\n\tAllowOverride All\n</Directory>' /etc/apache2/sites-available/000-default.conf && \
    sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Installer les outils nécessaires
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip

# Activer le module mod_rewrite d'Apache
RUN a2enmod rewrite

# Copier les fichiers du projet dans le conteneur
COPY . /var/www/html

# Modifier la configuration d'Apache pour autoriser .htaccess
# Ajouter la directive AllowOverride pour le répertoire public
RUN echo '<Directory /var/www/html/public>\n\tAllowOverride All\n</Directory>' >> /etc/apache2/sites-available/000-default.conf

# Définir les permissions des dossiers
RUN chown -R www-data:www-data /var/www/html

# Exposer le port 80
EXPOSE 80
