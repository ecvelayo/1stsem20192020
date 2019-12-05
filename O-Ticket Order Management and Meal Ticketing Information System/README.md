<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1400 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- [UserInsights](https://userinsights.com)
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)
- [Invoice Ninja](https://www.invoiceninja.com)
- [iMi digital](https://www.imi-digital.de/)
- [Earthlink](https://www.earthlink.ro/)
- [Steadfast Collective](https://steadfastcollective.com/)
- [We Are The Robots Inc.](https://watr.mx/)
- [Understand.io](https://www.understand.io/)
- [Abdel Elrafa](https://abdelelrafa.com)
- [Hyper Host](https://hyper.host)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## System Requirements

    Source Code Editor: Sublime Text Xampp: v. 7.3.2 Laravel Framework: v. 6.0 Composer: v. 1.8.4 Node J.S: v. 10.15.3 Git: Version 2.21.0 Operating System: Windows 7 PHP: v. 7.3.3

    1. Download Sumblime Text3 (https://www.sublimetext.com/3).
    2. Download Xampp 7.3.2 (https://www.apachefriends.org/download.html)
    3. Install GitBash (https://git-scm.com/download/win).
    4. Install Node J.S. (https://nodejs.org/en/download/) through git bash or Command Prompt
    5. Clone Repository and copy it to C:/xampp/htdocs.
    6. Open command prompt and go to project path
    7. Enter "composer install" after fully process enter "npm install".
    8. In command promp input command “php artisan key:generate”.
    9. Input in command prompt “php artisan migrate”
        in your PhpMyAdmin, enter this query in SQL
            1st:
                CREATE VIEW users_and_patron AS SELECT users.user_id, users.firstname, users.middlename, users.lastname,      users.status, users.user_type, patron.patron_type
                FROM users INNER JOIN patron WHERE users.user_id = patron.patron_id;
            2nd:
                CREATE VIEW credit_history_and_users AS SELECT users_and_patron.user_id, users_and_patron.firstname, users_and_patron.middlename, users_and_patron.lastname, users_and_patron.status, users_and_patron.user_type, users_and_patron.patron_type, credit_history.no_of_passenger, credit_history.employee_id, credit_history.patron_id, credit_history.date_earned FROM users_and_patron INNER JOIN credit_history WHERE users_and_patron.user_id = credit_history.patron_id;
            3rd:
                CREATE VIEW order_line_and_meal AS SELECT order_line_item.order_id, order_line_item.meal_id, order_line_item.status, order_line_item.date_redeemed, meal.meal_type FROM order_line_item INNER JOIN meal WHERE order_line_item.meal_id = meal.meal_id;
            4th:
                CREATE VIEW order_orderline AS SELECT `order`.order_id, `order`.patron_id, `order`.order_datetime, order_line_and_meal.meal_id, order_line_and_meal.status, order_line_and_meal.date_redeemed, order_line_and_meal.meal_type FROM `order` INNER JOIN order_line_and_meal WHERE `order`.`order_id` = order_line_and_meal.order_id;
            5th:
                CREATE VIEW users_order AS SELECT
                credit_history_and_users.user_id,
                credit_history_and_users.firstname,
                credit_history_and_users.middlename,
                credit_history_and_users.lastname,
                credit_history_and_users.user_type,
                credit_history_and_users.patron_type,
                credit_history_and_users.no_of_passenger,
                credit_history_and_users.employee_id,
                credit_history_and_users.patron_id,
                order_orderline.date_redeemed,
                order_orderline.meal_id,
                order_orderline.meal_type,
                order_orderline.status,
                credit_history_and_users.date_earned
                FROM credit_history_and_users INNER JOIN order_orderline WHERE credit_history_and_users.patron_id = order_orderline.patron_id AND order_orderline.date_redeemed = credit_history_and_users.date_earned;
                
    10. Input in command promt “php artisan db:seed”
    11 .Input in command prompt “php artisan serve”
    12. Open Google Chrome Browser and type: http://localhost:8000/

    Default
        - user: superadmin@gmail.com
        - password: password
