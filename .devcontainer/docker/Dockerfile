# Define the DevContainer template to be used as the base
FROM mcr.microsoft.com/devcontainers/php:1-8.4-bullseye

# Update the registry once
RUN apt-get update

# Install ext-intl
RUN apt-get install -y libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl

# Install ext-zip
RUN apt-get install -y libzip-dev \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip


# Install Google Chrome
RUN wget -q https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb \
    && apt-get install -y ./google-chrome-stable_current_amd64.deb \
    && rm -f google-chrome-stable_current_amd64.deb

# Fix / Reset xDebug shenanigans
RUN sed -i '/client_port/d' /usr/local/etc/php/conf.d/xdebug.ini