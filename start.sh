#!/bin/bash

docker-compose exec app bash -c "composer install"
docker-compose exec app bash -c "cp .env.example .env"
docker-compose exec app bash -c "chmod -R 777 storage bootstrap"
docker-compose exec app bash -c "php artisan migrate"