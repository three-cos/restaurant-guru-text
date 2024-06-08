FROM php:8.2-cli

WORKDIR /app
COPY ./src /app

RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip

RUN useradd -m web
RUN chown -R web:web /app
USER web

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install

CMD ["php", "-S", "0.0.0.0:8080", "-t", "./"]
