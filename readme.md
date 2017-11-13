<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb combination of simplicity, elegance, and innovation give you tools you need to build any application with which you are tasked.

## Learning Laravel

Laravel has the most extensive and thorough documentation and video tutorial library of any modern web application framework. The [Laravel documentation](https://laravel.com/docs) is thorough, complete, and makes it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 900 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for helping fund on-going Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](http://patreon.com/taylorotwell):

- **[Vehikl](http://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Styde](https://styde.net)**
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

# Test Task.

На фреймворке Lavarel (самая последняя, стабильная версия этого фреймворка) сделать небольшое веб приложение, которое позволяет добавлять, изменять и удалять клиентов в/из базы (Postgres) при помощи сохраненных процедур (Stored Procedures). Выводить список клиентов нужно используя представление (View) в базе. Не используйте ORM. Графический вывод (меню, таблица, кнопки и тп) нужно сделать используя Vue.Js и сверстать таким образом чтобы оно эргономично отображалось на экране веб браузера на персональном компьютере а также правильно отображалось в iPhone, iPad, и Android устройствах. Запросы на сервер из графической части должны быть выполнены используя Ajax+JSON. Запись клиента должна содержать: имя, фамилия, личный код, емайл (+ проверка на валидность*), адрес (достаточно одного поля), город и страна. Проверка на валидность нужна только в емайле. Добавить експорт и импорт людей в базу в формате json. Не используйте стандартную авторизацию Laravel, сделайте свою.

* Обязательно использовать библиотеки https://vuejs.org/ (самая последняя, стабильная версия)

Результат работы 

Необходимо прислать в виде кода в ZIP/RAR формате, так же не забыть приложить дамп базы или DDL скрипты для ее разворачивания.

## Steps to reproduce

1. do git clone this repo:

'git clone ...'

2. in same folder do git clone laradock:

'git clone ...'

3. you must have next folders strucrute:

\root_folder\
|
*-\testTask20171111\
|
*-\laradock\

4. follow instructions of laradock to install docker + docker-compose.

5. copy .env file, do set up env values:

6. cd laravel ; run sudo docker-compose up -d nginx postgres;

7. cd testTask20171111; copy .env and set up db: pgsql , host = postgres, user, db, pass (default is default/default/ secret)

8. run chmode -R 777 ./storage ./bootstrap/cache 

9. cd laravel, enter to container sudo run docker-compose exec workspace bash

10. inside container run composer install

11. inside container run npm install -unsafe-perm

12. load migrations by php artisan migrate

12. seed db by php artisan db:seed

13. generate key by php artisan key:generate
 
14. npm run development

15. php artisan cache:clear

16. check test is correct by run phpunit

16. go to brouser url : http:\\localhost

17. you must see the result! enjoy! 