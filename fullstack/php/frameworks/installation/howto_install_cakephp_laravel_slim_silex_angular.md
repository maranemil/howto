
```
https://angular.io/docs/ts/latest/quickstart.html
https://angularjs.de/artikel/angular2-tutorial-deutsch
http://www.beyondjava.net/blog/getting-started-with-angularjs-2-0-your-first-application/
https://tests4geeks.com/tutorials/angular-2-tutorial/
http://onehungrymind.com/build-a-simple-website-with-angular-2/
https://www.sitepoint.com/angular-2-tutorial/
https://toddmotto.com/angular-2-forms-reactive
http://blog.thoughtram.io/angular/2016/03/21/template-driven-forms-in-angular-2.html
https://github.com/IstvanOri/ng2-examples/blob/master/examples/file-upload/src/app.ts
http://blog.thoughtram.io/angular/2016/06/22/model-driven-forms-in-angular-2.html
https://scotch.io/tutorials/how-to-build-nested-model-driven-forms-in-angular-2
https://www.barbarianmeetscoding.com/blog/2016/07/15/updating-your-angular-2-app-to-use-the-new-forms-api-a-practical-guide/
```
-------------------------------------------------------------
```
sudo apt install npm
npm install -g angular-cli
sudo apt install ng-common
ng version
ng new angular2-todo-app
cd angular2-todo-app
ng serve

# Generate a new component
$ ng generate component my-new-component

# Generate a new directive
$ ng generate directive my-new-directive

# Generate a new pipe
$ ng generate pipe my-new-pipe

# Generate a new service
$ ng generate service my-new-service

# Generate a new class
$ ng generate class my-new-class

# Generate a new interface
$ ng generate interface my-new-interface

# Generate a new enum
$ ng generate enum my-new-enum
```
-------------------------------------------------------------
```
## https://github.com/cakephp/cakephp
## http://book.cakephp.org/3.0/en/installation.html
curl -sS https://getcomposer.org/installer | php
php composer.phar create-project --prefer-dist cakephp/app todoapp
# composer self-update && composer create-project --prefer-dist cakephp/app my_app_name
# php composer.phar update
## logs and tmp directories and subdirectories must be writable
bin/cake server # built-in server is running in http://localhost:8765/
#bin/cake server -H 192.168.13.37 -p 5673 # custom ip and port
```
-------------------------------------------------------------
```

## https://laravel.com/docs/5.3/session#configuration
## https://laravel.com/docs/5.3/database#configuration
## https://laravel.com/docs/5.3/cache#configuration
## https://github.com/laravel/laravel
curl -sS https://getcomposer.org/installer | php
sudo apt install composer
composer global require "laravel/installer"
composer create-project --prefer-dist laravel/laravel blog
cd blog
# chmod +x artisan
php artisan serve 		# Laravel development server started on http://localhost:8000/
php artisan key:generate 	# Application key [base64:VhcBAry10rXSvQ2jyc9vSpViW3to2xX/CPGWfXnT000=] set successfully.
## renamed the .env.example file to .env
## review the config/app.php
## session configuration file is stored at config/session.php

## Database

php artisan session:table
php artisan migrate

## Redis need to install the predis/predis package
```
-------------------------------------------------------------
```
## https://github.com/slimphp/Slim-Skeleton
## http://www.slimframework.com/
curl -sS https://getcomposer.org/installer | php
php composer.phar create-project slim/slim-skeleton myapp
cd myapp; php -S 0.0.0.0:8080 -t public public/index.php
```
-------------------------------------------------------------
```
## http://silex.sensiolabs.org/doc/master/usage.html
sudo apt install composer
composer require silex/silex:~2.0
```
-------------------------------------------------------------
```
https://github.com/bcit-ci/CodeIgniter
https://www.codeigniter.com/
http://www.codeigniter.com/userguide2/
http://www.codeigniter.com/user_guide/installation/index.html

https://codeigniter.com/userguide3/database/db_driver_reference.html
https://codeigniter.com/userguide3/database/caching.html
https://codeigniter.com/userguide3/database/utilities.html
https://dev.mysql.com/doc/refman/8.0/en/miscellaneous-functions.html
https://dev.mysql.com/doc/refman/8.0/en/miscellaneous-functions.html#function_uuid
https://codeigniter.com/userguide2/database/active_record.html
https://codeigniter.com/user_guide/database/queries.html
```
-------------------------------------------------------------
```
https://symfony.com/doc/current/setup.html

composer create-project symfony/framework-standard-edition myapp
composer create-project symfony/framework-standard-edition myapp "2.8.*"
cd myapp/
$ php bin/console server:run
```
-------------------------------------------------------------
```
https://codeigniter.com
https://laravel.com
https://cakephp.org
https://symfony.com
https://framework.zend.com
http://www.yiiframework.com
https://www.djangoproject.com
```


