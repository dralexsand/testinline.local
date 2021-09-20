
git init
git clone https://github.com/dralexsand/testinline.local.git

cp .env.example .env

composer update

SQL:

CREATE DATABASE testinline_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

php artisan migrate

php artisan tinker
User::factory()->count(10)->create();

php artisan serve

