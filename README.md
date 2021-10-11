

Задача:

Имеются следующие ресурсы:

Список записей блога: https://jsonplaceholder.typicode.com/posts
Комментарии к записям: https://jsonplaceholder.typicode.com/comments

Требуется:

1. Создать схему БД для хранения записей и комментариев к ним. SQL-запросы для создания БД поместить в отдельный файл.
   1. Создать PHP скрипт, который скачает список записей и комментариев к ним и загрузит их в БД.
   По завершению загрузки, вывести в консоль надпись: "Загружено Х записей и Y комментариев"
2. Создать HTML-форму поиска записей по тексту комментария (поле ввода и кнопка "Найти").

Пример: при вводе "laudanti" нужно вывести все записи, в комментариях к которым есть эта строка. (имеется в этой записи https://jsonplaceholder.typicode.com/posts/6/comments).

Поиск должен работать при вводе минимум 3-х символов.
В результатах поиска вывести заголовок записи и комментарий с искомой строкой.

*********

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

