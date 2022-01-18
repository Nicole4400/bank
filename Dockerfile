FROM php:8-fpm-alpine

WORKDIR /var/www

RUN adduser -D -g 'www' www

RUN apk add --no-cache --update nginx supervisor postgresql-libs postgresql-dev

RUN docker-php-ext-install pdo pdo_pgsql

RUN chown -R www:www /var/lib/nginx && \
    chown -R www:www /var/www

COPY ./.docker/nginx.conf /etc/nginx/nginx.conf

COPY ./.docker/supervisord.conf /etc/supervisord.conf

COPY . .

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
