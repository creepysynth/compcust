FROM php:8.0.9-fpm

# Arguments defined in docker-compose.yml
ARG USER
ARG UID
ARG NODE_VERSION

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libargon2-dev \
    libcurl4-openssl-dev \
    libedit-dev \
    libfreetype6-dev \
    libgmp-dev \
    libjpeg62-turbo-dev \
    libldap2-dev \
    libonig-dev \
    libpng-dev \
    libsodium-dev \
    libsqlite3-dev \
    libssl-dev \
    libvpx-dev \
    libwebp-dev \
    libxml2-dev \
    libxpm-dev \
    zlib1g-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd \
    --with-freetype=/usr/include/ \
    --with-webp=/usr/include/ \
    --with-jpeg=/usr/include/ \
    --with-xpm=/usr/include/ \
    && docker-php-ext-install gd pdo_mysql mbstring exif pcntl bcmath

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u ${UID} -d /home/${USER} ${USER}
RUN mkdir -p /home/${USER}/.composer && \
    chown -R ${USER}:${USER} /home/${USER}

# Install nodejs with Node Version Manager
ENV NVM_DIR /home/${USER}/.nvm

RUN mkdir -p /home/${USER}/.nvm \
    && curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.38.0/install.sh | bash \
    && . /home/${USER}/.nvm/nvm.sh \
    && nvm install ${NODE_VERSION} \
    && nvm use ${NODE_VERSION} \
    && nvm alias ${NODE_VERSION} \
    && ln -s `npm bin --global` /home/${USER}/.node-bin

# Add PATH for node
ENV PATH $PATH:/home/${USER}/.node-bin

# Set working directory
WORKDIR /var/www

USER ${USER}
