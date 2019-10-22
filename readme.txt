composer require laravel/ui
php artisan ui vue --auth
npm install && npm run dev


correr el vue.js
npm run watch

use Illuminate\Support\Facades\Schema;
Schema::defaultStringLength(191);

php artisan make:model Role -m
php artisan make:model Pasatiempo -m
php artisan make:migration create_role_user_table

php artisan make:seeder RoleTableSeeder

php artisan make:seeder UserTableSeeder
php artisan migrate:refresh --seed

create resource 
php artisan make:controller NotaController --resource


ROLES:
1: ADMIN
2: USUARIO

