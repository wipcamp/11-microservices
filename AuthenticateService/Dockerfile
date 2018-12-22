FROM wipcamp/11-laravel-base-image:1.0.0
WORKDIR /var/www/html
COPY composer.json .
RUN composer install --no-dev --no-autoloader --no-scripts

COPY ./.env .
COPY ./app ./app
COPY ./bootstrap ./bootstrap
COPY ./config ./config
COPY ./database ./database
COPY ./public ./public
COPY ./resources ./resources
COPY ./routes ./routes
COPY ./storage ./storage
COPY ./tests ./tests
COPY ./.editorconfig .
COPY ./.gitattributes ./.gitattributes
COPY ./artisan ./artisan
COPY ./composer.lock .
COPY ./package.json .
COPY ./phpunit.xml .
COPY ./server.php .
COPY ./webpack.mix.js .

RUN composer dump-autoload
RUN php artisan migrate
RUN php artisan migrate:refresh
RUN php artisan migrate --seed

RUN chmod -R 777 bootstrap/cache
RUN chmod -R 777 storage

CMD ["php" ,"artisan" ,"serve","--host=0.0.0.0"]