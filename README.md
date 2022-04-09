## Steps:

1. composer install
2. create a .env file, copy .env.example file content to .env
3. php artisan key:generate
4. php artisan migrate
5. php artisan db:seed --class SeederForTheEats
