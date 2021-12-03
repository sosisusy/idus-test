
copy .env.example .env

docker-compose up -d

docker-compose exec php-fpm composer install

docker-compose exec php-fpm php artisan key:generate

docker-compose exec php-fpm php artisan migrate --seed
