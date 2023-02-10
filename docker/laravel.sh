#!/bin/bash
chmod -R 777 .
# cp .env.example .env
# composer install --ignore-platform-reqs
# php artisan config:clear
# php artisan cache:clear
# php artisan route:cache
# php artisan migrate
php artisan serve --host=0.0.0.0