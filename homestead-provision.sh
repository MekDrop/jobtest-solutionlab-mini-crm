#!/usr/bin/env bash

pushd ~/code

    if [ ! -f .env ]; then
        cp .env.example .env
    fi;

    source .env

    composer install

    if [ "$APP_KEY" == "" ]; then
        php artisan key:generate
    fi;

    php artisan migrate --force
    php artisan db:seed --force
    php artisan storage:link
popd