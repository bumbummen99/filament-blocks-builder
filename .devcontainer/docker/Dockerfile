# Define the DevContainer template to be used as the base
FROM mcr.microsoft.com/devcontainers/php:1-8.3-bullseye


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