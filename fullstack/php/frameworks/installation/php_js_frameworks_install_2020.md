```
########################################
#
#   Restful PHP micro Frameworks
#
#######################################

BulletPHP
Fat-Free Framework
Limonade
Phalcon
Recess PHP
Silex
Slim
Tonic
The One Framework
Wave Framework
Zaphpa
Lumen
```

```
http://www.phpgang.com/top-12-best-php-restful-micro-frameworks_2690.html
------------------------------------------------------------------------------
Reddit - PHP projects which help to implement a REST API with authentication
------------------------------------------------------------------------------
Symfony / FOSRestBundle
Laravel / Dingo
API-Platform
Micro-Frameworks
Slim
Silex
Lumen
API-Management
Apigility
Fusio
```

```
####################################################
#
#   PHP Frameworks Install 2020
#
####################################################

sudo apt install composer -y
sudo apt install curl  -y
sudo apt install php-intl -y
sudo apt install php-xml php-mbstring -y
sudo apt install php-sqlite3  -y
sudo apt install apache2  -y
sudo apt install php-mysql  -y
sudo a2dismod php5.6 ; sudo a2enmod php7.0 ; sudo service apache2 restart

sudo apt-get remove --purge apache2  php7.0 libapache2-mod-php
sudo apt-get install apache2 php7.0 libapache2-mod-php  -y
sudo service apache2 restart


sudo a2dismod mpm_event
sudo a2enmod mpm_prefork
udo a2dismod mpm_prefork
sudo a2dismod mpm_worker
sudo a2dismod mpm_event

mkdir Git
sudo ln -s ~/Git/ /var/www/html/Git
http://localhost/Git/
```

```
####################################################
#
#   PHP Frameworks Install 2021
#
####################################################

sudo apt install apache2
sudo apt install php
sudo apt install mariadb-server mariadb-client
sudo apt install curl
sudo apt install composer

sudo apt install php-intl -y
sudo apt install php-xml php-mbstring -y
sudo apt install php-mysql  -y
sudo apt install php-sqlite3  -y
sudo apt install php-curl

mkdir Git
sudo ln -s ~/Git /var/www/html/Git

# install demos
composer create-project --prefer-dist cakephp/app cake-bookmarker
composer create-project --prefer-dist cakephp/app cake-blog
composer create-project symfony/symfony-demo
composer create-project codeigniter4/appstarter ci-project-root
composer create-project codeigniter4/appstarter ci-news
composer create-project --prefer-dist laravel/laravel laravel-blog
```

```
---------------------------------------------------
cakephp 3.x
---------------------------------------------------
https://book.cakephp.org/3.0/en/installation.html
https://book.cakephp.org/3.0/en/tutorials-and-examples/cms/installation.html
https://book.cakephp.org/3.0/en/tutorials-and-examples/blog/blog.html
https://book.cakephp.org/3.0/en/tutorials-and-examples/bookmarks/intro.html
https://book.cakephp.org/3.0/en/tutorials-and-examples.html#
https://book.cakephp.org/3.0/en/tutorials-and-examples/bookmarks/part-two.html
https://book.cakephp.org/3.0/en/installation.html
```
```
#composer create-project --prefer-dist cakephp/app my_app_name

composer create-project --prefer-dist cakephp/app bookmarker
composer create-project --prefer-dist cakephp/app blog

composer self-update && composer create-project --prefer-dist cakephp/app blog

$average_of_foo = array_sum($foo) / count($foo);

bin/cake bake all users
bin/cake bake all bookmarks
bin/cake bake all tags

bin/cake server
bin/cake server -H 192.168.13.37 -p 5673

http://localhost/Git/bookmarker/index.php/bookmarks
http://localhost/Git/adminer-4.6.2.php?username=root&db=cake_bookmarks

////////////////
PHPUNIT
////////////////
cd cake_project
vendor/bin/phpunit -h
vendor/bin/phpunit -c phpunit.xml.dist --migrate-configuration

vendor/bin/phpunit tests/TestCase/Controller/PagesControllerTest.php
vendor/bin/phpunit tests/TestCase/ApplicationTest.php
vendor/bin/phpunit tests/TestCase/ApplicationTest.php --debug --verbose --repeat 2
```



```
sudo apt install mlocate
locate php.ini

git clone -b 2.x git://github.com/cakephp/cakephp.git
composer create-project --prefer-dist cakephp/app:^3.9 my_app_name
composer create-project --prefer-dist cakephp/app:~4.0 my_app_name
composer fund # print dependencies

https://book.cakephp.org/4/en/console-commands.html
https://book.cakephp.org/bake/1/en/usage.html
https://book.cakephp.org/4/en/installation.html
https://getcomposer.org/doc/
https://book.cakephp.org/3/en/plugins.html
https://book.cakephp.org/3/en/core-libraries/app.html
https://book.cakephp.org/3/en/installation.html
https://book.cakephp.org/3/en/appendices/3-0-migration-guide.html
https://book.cakephp.org/3/en/development/errors.html
https://api.cakephp.org/3.4/class-Cake.Core.App.html

bin/cake bake
bin/cake bake --help
bin/cake server
bin/cake migrations -h
bin/cake bake.bake -h

# TPL
bin/cake bake controller Users
bin/cake bake model Users
bin/cake bake template Users
bin/cake bake all Users
bin/cake bake template Users index
bin/cake bake template Users -t BootstrapUI

bin/cake bake controller Users --prefix admin
bin/cake bake template Users --prefix admin

bin/cake bake all UserRecords -c records --table tbl_records_user -t BootstrapUI

# DB
bin/cake bake model UserRecords -c records
bin/cake bake model UserRecords -c records --table tbl_records_user
bin/cake bake model UserRecords -c records --table tbl_records_user --display-field email
bin/cake bake model UserRecords -c records --table tbl_records_user --no-associations

bin/cake bake model
bin/cake bake controller
bin/cake bake template
```

```
---------------------------------------------------
symfony 3.8
---------------------------------------------------
https://github.com/symfony/demo
https://symfony.com/doc/current/setup.html
https://symfony.com/doc/current/page_creation.html
https://github.com/symfony/demo

composer create-project symfony/symfony-demo

php bin/console server:run
php bin/console server:start 0.0.0.0:8000

https://symfony.com/doc/current/setup/web_server_configuration.html
https://symfony.com/doc/current/setup.html
https://symfony.com/doc/current/page_creation.html

http://localhost/Git/symfony-demo/web/app_dev.php/en/blog/
http://localhost/Git/symfony-demo/web/app_dev.php/en/blog/posts/abnobas-sunt-hilotaes-de-placidus-vita

Up & Running With Symfony 4 - Part 1: Setup, Controllers, Twig
https://www.youtube.com/watch?v=t5ZedKnWX9E
https://www.youtube.com/watch?v=MS4LICZ1j0s
https://www.youtube.com/watch?v=HchMW8EhWPU
https://www.youtube.com/watch?v=kfiKn5c9l84
https://www.youtube.com/watch?v=Bo0guUbL5uo

composer create-projecz symfony/skeleton  symphart
#https://github.com/bradtraversy/symphart

symfony bradtraversy crud
https://www.youtube.com/watch?v=WVeE4SXIOwA&t=4s
https://www.youtube.com/watch?v=62hsXxjD4bY&t=2s
https://www.youtube.com/watch?v=-xTmQ_iv5NI&t=9s

composer require twig

composer require doctrine maker
php bin/console doctrine:database:create
php bin/console make:entity Article
php bin/console doctrine:migrations:diff
php bin/console doctrine:migrations:migrate
php bin/console doctrine:query:sql 'SELECT * FROM article'

composer require form

Symfony PHP Framework Tutorial - Full Course
https://www.youtube.com/watch?v=Bo0guUbL5uo&t=12s

composer require server --dev
composer require make
composer require annotations
composer require dump

php bin/console make:controller MainController
php bin/console server:run
php bin/console server:start
php bin/console server:stop

https://flex.symfony.com/
```

```
---------------------------------------------------
codeigniter 3.X
---------------------------------------------------
https://codeigniter.com
https://codeigniter.com/user_guide/installation/downloads.html
https://codeigniter.com/user_guide/installation/installing_composer.html

installation & Set Up
composer create-project codeigniter4/appstarter project-root
composer create-project codeigniter4/appstarter --no-dev

# upgrade
composer update codeigniter4/framework --prefer-source
composer update

# translations
composer require codeigniter4/translations

composer create-project codeigniter4/appstarter ci-news
http://localhost:8080
```

```
---------------------------------------------------
laravel 5.6
---------------------------------------------------
https://laravel.com
https://laravel.com/docs/5.6
https://laravel.com/docs/5.6/controllers
http://laraveldaily.com/create-controller-model-one-artisan-command/
https://www.tutorialspoint.com/laravel/laravel_controllers.htm

composer global require "laravel/installer"
composer create-project --prefer-dist laravel/laravel blog

php artisan serve

php artisan make:controller PhotoController --resource
php artisan make:controller PhotoController --resource --model=Photo
php artisan make:controller API/PhotoController --api
php artisan route:cache
php artisan route:clear

php artisan help make:controller
php artisan make:controller [Name]Controller
php artisan make:controller --plain <controller name>
php artisan make:model ModelName -m -cr  #   generate Model , controller with resources and migration
php artisan krlove:generate:model Videos --table-name=videos

make
  make:command         Create a new command class
  make:console         Create a new Artisan command
  make:controller      Create a new resource controller class
  make:event           Create a new event class
  make:middleware      Create a new middleware class
  make:migration       Create a new migration file
  make:model           Create a new Eloquent model class
  make:provider        Create a new service provider class
  make:request         Create a new form request class
```


```
---------------------------------------------------
lumen
---------------------------------------------------
https://lumen.laravel.com/docs/5.6
composer global require "laravel/lumen-installer"
composer create-project --prefer-dist laravel/lumen blog
php -S localhost:8000 -t public
```

```
---------------------------------------------------
slim
---------------------------------------------------
https://www.slimframework.com/docs/
composer require slim/slim "^3.0"
```

```
---------------------------------------------------
silex
---------------------------------------------------
https://silex.symfony.com/doc/2.0/
composer require silex/silex "^2.0"
composer create-project fabpot/silex-skeleton path/to/install " ^2.0"
```

```
---------------------------------------------------
phalconphp
---------------------------------------------------
https://docs.phalconphp.com/en/3.3/installation

Phalcon need the following extensions to run (minimal):

curl
gettext
gd2 (to use the Phalcon\Image\Adapter\Gd class)
libpcre3-dev (Debian/Ubuntu), pcre-devel (CentOS), pcre (macOS)
json
mbstring
pdo_*
fileinfo
openssl

curl -s https://packagecloud.io/install/repositories/phalcon/stable/script.deb.sh | sudo bash

sudo apt-get update
sudo apt-get install php7.0-phalcon
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
sudo apt-get install php-phalcon

git clone https://github.com/phalcon/cphalcon
cd cphalcon/build
sudo ./install

cd cphalcon/build

# One of the following:
sudo ./install --arch 32bits
sudo ./install --arch 64bits
sudo ./install --arch safe

php -r 'print_r(get_loaded_extensions());'  # check extensions
php -m  # check modules
```


```
####################################################################################
#
#   Install Frameworks 2020
#
####################################################################################

http://cdimage.ubuntu.com/lubuntu/releases/20.04/release/
http://ftp.uni-kl.de/pub/linux/ubuntu-dvd/xubuntu/releases/20.04/release/
------------------------------------------------------------

http://127.0.0.1/wwweb/
------------------------------------------------------------
mysql 8.0
------------------------------------------------------------
sudo mysql -u root -p
USE mysql;
SHOW tables;
describe user;
CREATE USER 'blabla'@'%' IDENTIFIED BY 'blabla';
GRANT ALL PRIVILEGES ON *.* TO 'blabla'@'%' WITH GRANT OPTION;
FLUSH PRIVILEGES;
exit

sudo mysql -u blabla -p
SET PASSWORD = 'blabla';
SELECT CURRENT_USER();
SELECT CURRENT_ROLE();
quit

------------------------------------------------------------

php7.4-bcmath     php7.4-dev        php7.4-intl       php7.4-pgsql      php7.4-sybase
php7.4-bz2        php7.4-enchant    php7.4-json       php7.4-phpdbg     php7.4-tidy
php7.4-cgi        php7.4-fpm        php7.4-ldap       php7.4-pspell     php7.4-xml
php7.4-cli        php7.4-gd         php7.4-mbstring   php7.4-readline   php7.4-xmlrpc
php7.4-common     php7.4-gmp        php7.4-mysql      php7.4-snmp       php7.4-xsl
php7.4-curl       php7.4-imap       php7.4-odbc       php7.4-soap       php7.4-zip
php7.4-dba        php7.4-interbase  php7.4-opcache    php7.4-sqlite3

sudo apt install php7.4-xml php7.4-soap php7.4-xdebug php7.4-mysql php7.4-mbstring  php7.4-cli php7.4-curl php7.4-gd php7.4-intl php7.4-json php7.4-opcache php7.4-sqlite3 php7.4-tidy php7.4-zip

rm -rf app-slim
composer create-project slim/slim-skeleton app-slim
cd app-slim; php -S localhost:8080 -t public public/index.php

http://www.slimframework.com/
------------------------------------------------------------
```

```
------------------------------------------------------------
laravel
------------------------------------------------------------

https://laravel.com/docs/5.1/quickstart
https://laravel.com/docs/5.1/homestead
https://laravel.com/docs/5.1/installation
https://github.com/laravel/lumen
https://www.tutorialspoint.com/laravel/index.htm


# composer create-project laravel/laravel blog "5.1.*"
git clone https://github.com/laravel/quickstart-basic quickstart
cd quickstart
composer install

sudo mysql -u root -p
create database forge;

php artisan migrate
php artisan make:migration create_tasks_table --create=tasks
php artisan migrate
php artisan make:model Task
```

```
------------------------------------------------------------
symfony
------------------------------------------------------------

https://symfony.com/
https://symfony.com/doc/current/index.html#gsc.tab=0
https://symfony.com/doc/current/setup.html
https://symfony.com/doc/current/page_creation.html
https://symfony.com/doc/current/routing.html
https://symfony.com/doc/current/controller.html
https://symfony.com/doc/current/templates.html
https://symfony.com/doc/current/configuration.html
https://symfony.com/what-is-symfony
https://symfony.com/doc/current/setup.html


symfony check:security
symfony check:requirements
symfony new my_project_name --full
symfony new my_project_name
symfony new my_project_name --version=lts
symfony new my_project_name --version=next
symfony new my_project_name --version=4.4
symfony new my_project_name --demo

# install from composer
composer create-project symfony/website-skeleton app_symfony          # webapp
composer create-project symfony/skeleton my_project_name                   # microservie
composer create-project symfony/website-skeleton:^4.4 my_project_name

cd my-project/
symfony server:start


# install from git repo
git clone repo path
cd path
composer install
composer require logger

php bin/console about
```



------------------------------------------------------------------------------
```
https://docs.djangoproject.com/en/3.0/
```
------------------------------------------------------------------------------
```
#############################################################
Ubuntu 18
#############################################################

sudo apt install apache2
sudo apt install php
sudo apt install mysql-server mysql-client
sudo apt install git
sudo apt install curl
sudo apt install composer
sudo apt install php7.2-zip php7.2-cli php7.2-common php7.2-curl php7.2-dev php7.2-gd php7.2-intl php7.2-json php7.2-mbstring php7.2-mysql php7.2-soap php7.2-xml php7.2-xmlrpc php7.2-xsl

```

```
Laravel
-------------------------------------------
composer global require laravel/installer
composer create-project --prefer-dist laravel/laravel blog
php artisan serve
```


```
Symfony
-------------------------------------------
composer create-project symfony/website-skeleton my_project_web
composer create-project symfony/skeleton my_project_microservice
symfony server:start
```


```
CodeIgniter4
-------------------------------------------
composer create-project codeigniter4/appstarter project-root
composer create-project codeigniter4/appstarter --no-dev
composer update
composer require codeigniter4/framework
composer require codeigniter4/translations
php spark serve
php spark serve --host=example.dev
php spark serve --port=8081
php spark serve --php=/usr/bin/php7.6.5.4
```

```

CakePHP4
-------------------------------------------
composer create-project --prefer-dist cakephp/app:~4.0 my_cakeapp_name
bin/cake server
bin/cake server -H 192.168.13.37 -p 5673
bin/cake server -H 0.0.0.0
```


```
Yii
-------------------------------------------
composer create-project --prefer-dist yiisoft/yii2-app-basic basic
composer create-project --prefer-dist --stability=dev yiisoft/yii2-app-basic basic
php yii serve
php yii serve --port=8888
```


```
Laminas
-------------------------------------------
composer require laminas/laminas-mvc
composer create-project mezzio/mezzio-skeleton mezzio
```

```
Slim
-------------------------------------------
composer create-project slim/slim-skeleton:dev-master [my-app-name]
php -S localhost:8080 -t public public/index.php
```

```
PhpMyAdmin
-------------------------------------------
https://docs.phpmyadmin.net/en/latest/setup.html
composer create-project phpmyadmin/phpmyadmin
```


```
zend framework
-------------------------------------------
https://docs.zendframework.com/zend-mvc/quick-start/
https://docs.zendframework.com/zend-mvc/examples/
composer create-project -sdev zendframework/skeleton-application my-application
composer require zendframework/zend-mvc



https://symfony.com/doc/current/setup.html
https://laravel.com/docs/7.x#installing-laravel
https://codeigniter.com/user_guide/index.html
https://codeigniter.com/userguide3/index.html
https://codeigniter.com/user_guide/installation/running.html
https://codeigniter.com/user_guide/installation/installing_composer.html
https://book.cakephp.org/4/en/installation.html
https://www.yiiframework.com/doc/guide/2.0/en/start-installation
https://docs.mezzio.dev/mezzio/
https://docs.laminas.dev/laminas-mvc/
```

```
https://getlaminas.org/
https://www.slimframework.com/
https://framework.zend.com/
https://www.yiiframework.com/
https://laravel.com/
https://symfony.com/
https://codeigniter.com/
https://book.cakephp.org/4/en/index.html
```
----------------------------------


```
-------------------------------------------
Django Python
-------------------------------------------
pip3 install django
django startproject myproj
python3 manage.py runserver
python3 manage.py startapp demoapp


----------------------------------------
Installing Django in a Virtual Environment
https://hackersandslackers.com/getting-started-django/
----------------------------------------


python3.8 -m pip install pipenv
python3.8 -m pipenv shell
pipenv install django
python3 -m django --version
django-admin startproject [YOUR_PROJECT_NAME]
python3 manage.py runserver
pip3 install mysqlclient
django-admin startapp [YOUR_APP_NAME]


----------------------------------------
FIX: Visual Studio Code is unable to watch for file changes in this large workspace
https://code.visualstudio.com/docs/setup/linux#_visual-studio-code-is-unable-to-watch-for-file-changes-in-this-large-workspace-error-enospc
----------------------------------------

# check
cat /proc/sys/fs/inotify/max_user_watches
# 65536

# edit
sudo nano /etc/sysctl.conf
fs.inotify.max_user_watches=524288
sudo sysctl -p
```

```
#################################################
FIX for composer error:  "Package 'php-mcrypt' has no installation candidate"
#################################################

Install PHP mcrypt extension on Ubuntu 20.04
https://computingforgeeks.com/install-php-mcrypt-extension-on-ubuntu/

sudo apt update
sudo apt install -y build-essential

#gcc --version
#make --version

sudo apt install php php-pear php-dev libmcrypt-dev

#which pecl
#pecl help

sudo pecl channel-update pecl.php.net
sudo pecl update-channels
sudo pecl search mcrypt
sudo pecl install mcrypt

$ sudo nano /etc/php/7.4/cli/php.ini
extension=mcrypt.so

$ sudo nano /etc/php/7.4/apache2/php.ini
extension=mcrypt.so

php -m | grep mcrypt
sudo systemctl restart apache2
sudo systemctl restart nginx
```





