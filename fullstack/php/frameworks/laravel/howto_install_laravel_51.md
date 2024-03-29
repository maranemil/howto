```
###############################################
#
#
#	Laravel 5 installation
#
#	https://www.digitalocean.com/community/tutorials/how-to-install-and-use-composer-on-ubuntu-14-04
#
#	https://laravel.com/docs/5.2/installation
#	https://laravel.com/docs/5.1/authentication
#
#	Laravel 5.1 Basics PLAYLIST
#	https://www.youtube.com/playlist?list=PL_UnIDIwT95NUvLU14l_QFFV2ZxO1phpQ

#	https://www.youtube.com/watch?v=FKUAAZSJiGY	Composer & Laravel Installer
#	https://www.youtube.com/watch?v=Yuku0C89jpw	Controllers
#	https://www.youtube.com/watch?v=bWhJJJwMvco	Middleware
#
#	Laravel 5.2 PHP Build a social network
#	https://www.youtube.com/watch?v=_dd4-HEPejU&list=PL55RiY5tL51oloSGk5XdO2MGjPqc0BxGV
#
#	How to Build a Blog with Laravel
#	https://www.youtube.com/watch?v=R8B4og-BeCk&list=PLwAKR305CRO-Q90J---jXVzbOd4CDRbVx
#
###############################################
```

```
sudo apt-get update
sudo apt-get install curl php5-cli git
#curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

curl -sS https://getcomposer.org/installer | php
mv composer.phar /user/local/bin/composer
composer --version

composer global require "laravel/installer"
laravel new blog

php artisan # shows all available commands
php artisan make:controller CustomerController
php artisan serve
```
*
*
*
```
Laravel 5 Videos
-------------------------------------------------
laravel 5.2 tutorial for beginners step by step PLAYLIST
https://www.youtube.com/list=PLzeTBm5Nhz71Z5GtN9H66iPWLbFmD0mBI

https://www.youtube.com/watch?v=_SlJJi_cLng
https://www.youtube.com/watch?v=_F7pciOgSZ0
https://www.youtube.com/watch?v=XwhZ4xX7Qmc
https://www.youtube.com/watch?v=kcxPqn0iVa0
https://www.youtube.com/watch?v=_dd4-HEPejU
https://www.youtube.com/watch?v=--9I5wqXgUM

https://www.youtube.com/watch?v=bFKConAvXVM
```

```
##################################################################
#
# laravel Resources
#
##################################################################
```

```
https://laravel.com
https://laravel.com/docs/5.5/horizon
https://laravel.com/docs/5.5/dusk
https://laravel.com/docs/5.5/broadcasting
https://laravel.com/docs/5.5
https://lumen.laravel.com

https://laracasts.com/skills/laravel
https://laracasts.com/series/laravel-from-scratch-2017/episodes/1?autoplay=true

https://github.com/laravel/laravel
https://github.com/laravel/quickstart-intermediate
https://github.com/laravel/socialite
https://github.com/laravel/laravel.com

http://laravelcoding.com/blog/laravel-5-beauty-the-10-minute-blog
https://vuejsdevelopers.com/2017/11/20/vuebnb-full-stack-laravel/
https://github.com/jacurtis/laravel-blog-tutorial
```



### laravel 9x

https://laravel.com/docs/9.x/installation
https://github.com/coderstape/freecodegram
https://laravel.com/docs/4.2/quick

node -v
npm -v
npm install
npm run dev

composer create-project laravel/laravel helloworld
laravel new helloworld
php artisan serve


composer global require laravel/installer
laravel new example-app
cd example-app
php artisan serve
php artisan make:auth

.env
DB_CONNECTION=sqlite

php artisan migrate

app.blade.php
app.scss

php artisan tinker
User::all();
exit

php artisan help make:controller
php artisan make:controller ProfilesController

https://laravel.com/docs/5.1/controllers
https://laravel.com/docs/9.x/controllers

php artisan help make:model
php artisan make:model Profile -m
php artisan make:model Post -m

php artisan make:controller PostController





### cURL error 6: Could not resolve host: laravel
```

https://laracasts.com/discuss/channels/laravel/curl-error-6-could-not-resolve-host-1

php artisan route:clear
php artisan config:clear
php artisan cache:clear

etc/hosts file
127.0.0.1 api.zoom.us:80
```
