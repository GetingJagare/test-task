#!/bin/sh

cd /var/www/app
php artisan migrate
php artisan db:seed
php artisan route:clear