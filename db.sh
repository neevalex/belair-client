#/bin/bash

# run mysql command that removes mysql app database tables
composer install
php artisan db:wipe
php artisan migrate
php artisan db:seed
php artisan filament:assets
#php artisan storage:link