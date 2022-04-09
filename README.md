## Steps:

1. After clonned, please install the composer

```
composer install
```

2. Create an env file

```
create a .env file, copy .env.example file content to .env
```

3. Generate key for env file

```
php artisan key:generate
```

4. Migrate the databse table

```
php artisan migrate
```

5. Run seeder

```
php artisan db:seed --class SeederForTheEats
php artisan db:seed --class SeederForBookingTablePivot
```
