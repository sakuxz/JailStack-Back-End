# JailStack Back-End

> A Laravel App

https://laravel.com/

## Develop

local
```sh
# install dependency packages
composer install

# copy .env.example to .env and edit some info on it, such as db name, db user, etc.
cp .env.example .env

# generate APP_KEY and JWT_SECRET in .env
php artisan key:generate
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
php artisan jwt:secret

# db migration
php artisan migrate

# start a PHP's built-in development server for laravel
php artisan serve
```

docker compose
```sh
# install packages & init config & db migration
docker-compose run install

# start a PHP's built-in development server for laravel
docker-compose run -p 8000:8000 php7.2-cli php artisan serve --host 0.0.0.0
```

## Deploy

build docker image
```sh
docker build -t jailstack .
```

build docker image with custom db config
```sh
docker build -t jailstack \
  --build-arg DB_HOST=127.0.0.1 \
  --build-arg DB_PORT=3307 \
  --build-arg DB_DATABASE=jailstack \
  --build-arg DB_USER=user \
  --build-arg DB_PASSWORD=pwd .
```

run with docker-compose
```sh
docker-compose up -d php7.2-apache mysql

# run db migration in php7.2-apache
docker-compose exec php7.2-apache php artisan migrate
```