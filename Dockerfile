FROM php:8.2-cli

WORKDIR /app
COPY . /app

RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install

RUN useradd -m web
RUN chown -R web:web /app

CMD ["php", "-S", "0.0.0.0:8080", "-t", "src"]
