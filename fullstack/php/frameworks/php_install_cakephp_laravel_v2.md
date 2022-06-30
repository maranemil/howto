
```
################################################################
#
#   Install Laravel 
#
################################################################
```

```
sudo apt install composer -y

# Via Composer Create-Project Install Laravel 5.5
composer create-project --prefer-dist laravel/laravel todo
# Via Laravel Installer
#composer global require "laravel/installer"

Step 2: Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=here your database name(todo)
DB_USERNAME=here database username(root)
DB_PASSWORD=here database password(root)

# create Table and Model
php artisan make:migration create_users_table
php artisan make:model User
php artisan serve
php artisan make:migration create_todos_table
php artisan make:model Todos

php artisan preset none

# create db structure
# edit .env
nano .env
php artisan migrate --env=local

# gen app key
# php artisan key:generate
```

```
################################################################
#
# Install Laravel ToDo App 
#
################################################################
```

```
#fork https://github.com/milon521/laravel-todo.git
git clone https://github.com/maranemil/laravel-todo

cd laravel-todo
composer install
cp .env.example .env
php artisan migrate
chmod 777 -R storage
php artisan key:generate

'cipher' => "AES-256-CBC", # app.php
php artisan key:generate

php artisan serve
go to http://localhost:8000
```

```
################################################################
#
# Install CakePHP ToDo App  
#
################################################################
```

```
#fork https://github.com/MitjaSt/ToDoApp # + angular - cake 2.7.8
git clone https://github.com/maranemil/ToDoApp

chmod 777 -R ToDoApp

# show local in www
ln -s /home/myuser/WebLab/  /var/www/html/

# php composer.phar create-project --prefer-dist cakephp/app my_app_name
# composer self-update && composer create-project --prefer-dist cakephp/app my_app_name

# Error: Cannot use 'String' as class name as it is reserved 
find ./ -type f | xargs grep "\String"
grep -rl "String::" /path/to/contao/root | xargs sed -i s@String::@StringUtil::@g

https://book.cakephp.org/2.0/en/appendices/2-7-migration-guide.html#utility
CakeText

The class String has been renamed to CakeText. This resolves some conflicts around HHVM compatibility as well as possibly PHP7+. There is a String class provided as well for compatibility reasons.

./lib/Cake/Utility/String.php:class String

grep -r  "AllowOverride" /etc/

/etc/apache2/sites-available/default:    AllowOverride all
/etc/apache2/apache2.conf:      AllowOverride None

sudo nano /etc/apache2/apache2.conf # AllowOverride all
```

```
################################################################
#
#
#
################################################################
```

```
https://book.cakephp.org/2.0/en/development/exceptions.html
https://book.cakephp.org/3.0/en/orm/database-basics.html
https://book.cakephp.org/2.0/en/development/configuration.html
https://book.cakephp.org/2.0/en/development/configuration.html
https://api.cakephp.org/2.7/class-CacheSession.html
https://book.cakephp.org/3.0/en/installation.html
https://book.cakephp.org/2.0/en/getting-started.html
https://book.cakephp.org/1.1/en/configuration.html
https://book.cakephp.org/2.0/en/console-and-shells/schema-management-and-migrations.html
```








```
http://kohanaframework.org
https://silex.symfony.com/doc/2.0/
https://www.slimframework.com/docs/
https://book.cakephp.org/3.0/en/installation.html
https://laravel.com/docs/5.5/releases
https://www.codeigniter.com/user_guide/installation/index.html
https://book.cakephp.org/3.0/en/installation.html
https://laravel.com/docs/5.5/releases

https://themescorners.com/2017/12/07/20-best-php-frameworks-developers-themescorners-themes/
https://coderseye.com/best-php-frameworks-for-web-developers/
https://www.mindtwo.de/die-besten-php-frameworks/
```




```
#####################################################################
#
# Clone Repo Slim Silex Laravel Cakephp
#
#####################################################################
```
```
# https://www.slimframework.com/docs/
composer create-project slim/slim-skeleton  my_slimapp
php -S localhost:8888 -t public public/index.php
```

------------------------------------------------------------
```
# https://silex.symfony.com/doc/2.0/usage.html#bootstrap
composer create-project fabpot/silex-skeleton my_silexapp " ^2.0"
```
------------------------------------------------------------
```
# https://laravel.com/docs/5.6
composer create-project --prefer-dist laravel/laravel my_laravelapp
php artisan key:generate

Step 2: Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=here your database name(blog)
DB_USERNAME=here database username(root)
DB_PASSWORD=here database password(root)

Step 3: Create products Table and Model
php artisan make:migration create_products_table
php artisan make:migration create_users_table

php artisan make:model Product
php artisan make:model User

php artisan serve # http://localhost:8000

https://github.com/milon/laravel-todo
https://github.com/serverfireteam/blog
https://github.com/Blogify/Blogify
https://github.com/websanova/larablog
https://github.com/InWave/laravel-blog
https://github.com/laravel/socialite
```
------------------------------------------------------------
```
composer create-project --prefer-dist laravel/lumen my_lumenapp
php -S localhost:8000 -t public
```
------------------------------------------------------------
```
git clone -b 2.x git://github.com/cakephp/cakephp.git
chown -R www-data app/tmp

/* First, create our posts table: */
CREATE TABLE posts (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50),
    body TEXT,
    created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL
);

/* Then insert some posts for testing: */
INSERT INTO posts (title, body, created)
    VALUES ('The title', 'This is the post body.', NOW());
INSERT INTO posts (title, body, created)
    VALUES ('A title once again', 'And the post body follows.', NOW());
INSERT INTO posts (title, body, created)
    VALUES ('Title strikes back', 'This is really exciting! Not.', NOW());

    ---
```
```
sudo apt install composer
composer create-project --prefer-dist cakephp/app cakephpblog3x
composer self-update && composer create-project --prefer-dist cakephp/app cakephpblog3x
chmod +x bin/cake
```
```
composer create-project --prefer-dist cakephp/app bookmarker
create-project --prefer-dist cakephp/app blog
sudo chown -R www-data tmp && sudo chown -R www-data logs
sudo chmod 777 -R tmp && sudo chmod 777 -R logs
```
```
sudo apt install php7.2-intl
sudo service apache2 restart
```
```
bin/cake bake model Articles
bin/cake bake controller Articles

https://github.com/MitjaSt/ToDoApp
```
------------------------------------------------------------
