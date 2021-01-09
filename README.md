# Laravel 6.2 - Template Scutum

## Very Quick start

-   git clone 'https://github.com/iqbaltc13/Mytarter.git'
-   composer install
-   composer run-script post-root-package-install
-   setting .env
-   php artisan migrate
-   php artisan key:generate
-   php artisan passport:install --force
-   php artisan db:seed --class=DatabaseSeeder

## Permission

sudo chmod -R 775 storage
sudo chmod -R 775 bootstrap/cache
sudo chmod -R 775 public/uploads
chmod a+rwx public/uploads -R

php artisan migrate:rollback
php artisan migrate

php artisan db:seed --class=RoleSeeder
php artisan db:seed --class=FaqSeeder

php artisan db:seed --class=NotifikasiGroupSeeder
php artisan db:seed --class=NotifikasiActionSeeder
