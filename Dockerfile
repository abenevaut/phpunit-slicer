FROM ghcr.io/abenevaut/vapor-ci:php83

RUN docker-php-ext-install exif
