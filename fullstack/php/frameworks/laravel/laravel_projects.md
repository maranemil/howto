```
#####################################
#	5 Laravel Projects
#####################################
```
```
https://github.com/flarum/core					# http://flarum.org/
https://github.com/vuedo/vuedo					# https://vuejsfeed.com/
https://github.com/LavaLite/cms
https://github.com/ladybirdweb/faveo-helpdesk	# http://www.faveohelpdesk.com/
https://github.com/timegridio/timegrid 			# https://timegrid.io/


https://github.com/hubleto/erp
https://laraveldaily.com/post/large-laravel-open-source-projects
https://www.drupalarchitect.info/
https://github.com/LaravelDaily/Large-Laravel-PHP-Project-Examples

```
```
############################################################################################################
Laravel Angular
############################################################################################################
```
```
# Laravel Angular Admin Starter Kit
https://laravel-news.com/laravel-angular-admin-starter-kit
https://silverbux.github.io/laravel-angular-admin/
https://github.com/silverbux/laravel-angular-admin

Installation

composer install && npm install

Open .env and enter necessary config for DB and Oauth Providers Settings.
php artisan migrate
php artisan db:seed

General Workflow
$ gulp && gulp watch

Open new terminal
$ php artisan serve

Angular Generators
In order to get the right menu automatically generated you must respect some conventions.

$ artisan ng:page name       #New page inside angular/app/pages/
$ artisan ng:dialog name     #New custom dialog inside angular/dialogs/
$ artisan ng:component name  #New component inside angular/app/components/
$ artisan ng:service name    #New service inside angular/services/
$ artisan ng:filter name     #New filter inside angular/filters/
$ artisan ng:config name     #New config inside angular/config/

Karma Testing
$ karma start

PHP Unit
$ phpunit
```



```
OAuth with Angular, Lumen, Socialite, and Satellizer  - Token-based AngularJS Authentication
https://medium.com/@barryvdh/oauth-in-javascript-apps-with-angular-and-lumen-using-satellizer-and-laravel-socialite-bb05661c0d5c
https://github.com/sahat/satellizer


Laravel and Angular Material Starter Project
https://laravel-news.com/laravel-and-angular-material-starter-project
https://github.com/jadjoubran/laravel5-angular-material-starter
https://www.sitepoint.com/flexible-and-easily-maintainable-laravel-angular-material-apps/


Token Authentication for Laravel and Angular
https://laravel-news.com/token-authentication-for-laravel-and-angular
https://scotch.io/tutorials/token-based-authentication-for-angularjs-and-laravel-apps
https://github.com/scotch-io/laravel-angular-token-authentication


Build a Time Tracker with Laravel and AngularJS – Part 2
https://laravel-news.com/build-a-time-tracker-with-laravel-and-angularjs
https://laravel-news.com/build-a-time-tracker-with-laravel-and-angularjs-part-2
https://scotch.io/tutorials/build-a-time-tracker-with-laravel-5-and-angularjs-part-1
https://github.com/scotch-io/laravel-angular-time-tracker/tree/part1-angular
```

```
######
AngularJS and Laravel: Begin Building a CRM
https://code.tutsplus.com/tutorials/angularjs-and-laravel-begin-building-a-crm--net-36444
######
```

```
php artisan serve  # locahost:8000
php artisan migrate:make create_customers_table

in app/database/migrations add

public function up() {
    Schema::create('customers', function ($table) {
        $table->increments('id');
        $table->string('first_name');
        $table->string('last_name');
        $table->string('email')->unique();
        $table->timestamps();
    });
}

public function down() {
    Schema::drop('customers');
}


php artisan migrate:make create_transactions_table

public function up() {
    Schema::create('transactions', function ($table) {
        $table->increments('id');
        $table->string('name');
        $table->float('amount');
        $table->integer('customer_id');
        $table->timestamps();
    });
}

Database Configuration

'mysql' => array(
    'driver'    => 'mysql',                 // database driver, don't touch
    'host'      => 'localhost',             // host of the database, usually localhost unless you have your db on some server
    'database'  => 'database',              // name of the database you will be using, it must be created earlier
    'username'  => 'root',                  // username that the script will use to connect, I strongly advice against using root user for this
    'password'  => '',                      // password for the user above, it's better not to use a blank one
    'charset'   => 'utf8',                  // encoding of the db
    'collation' => 'utf8_unicode_ci',       // db's collation setting
    'prefix'    => '',                      // prefix of the database tables, useful if you have multiple scripts using the same database
),

php artisan migrate
```
```
model

class Transaction extends Eloquent {
    public function customer() {
        return $this->belongsTo('Customer');
    }
}
```
```
Controller
class CustomerController extends BaseController {

    public function getIndex() {
        $id = Input::get('id');
        return Customer::find($id);
    }

    public function getAll() {
        return Customer::all();
    }

    public function postIndex() {
        if (Input::has('first_name', 'last_name', 'email')) {
            $input = Input::all();

            if ($input['first_name'] == '' || $input['last_name'] == '' || $input['email'] == '') {
                return Response::make('You need to fill all of the input fields', 400);
            }

            $customer = new Customer;
            $customer->first_name = $input['first_name'];
            $customer->last_name = $input['last_name'];
            $customer->email = $input['email'];

            $customer->save();
            return $customer;

        }
    }

    public function deleteIndex() {
        $id = Input::get('id');
        $customer = Customer::find($id);
        $customer->delete();
        return $id;
    }


}
```
```
Route::controller('/customers', 'CustomerController');

php artisan serve
curl -X POST -d "first_name=Jane&last_name=Doe&email=jdoe@g
curl http://localhost:8000/customers/all
```
```
class TransactionController extends BaseController {

    public function getIndex() {
        $id = Input::get('id');
        return User::find($id)->transactions;
    }

    public function postIndex() {
        if (Input::has('name', 'amount')) {
            $input = Input::all();

            if ($input['name'] == '' || $input['amount'] == '') {
                return Response::make('You need to fill all of the input fields', 400);
            }

            $transaction = new Transaction;
            $transaction->name = $input['name'];
            $transaction->amount = $input['amount'];

            $id = $input['customer_id'];
            User::find($id)->transactions->save($transaction);

            return $transaction;
        }
    }

    public function deleteIndex() {
            $id = Input::get('id');
            $transaction = Transaction::find($id);
            $transaction->delete();

            return $id;
    }

}

Route::controller('/transactions', 'TransactionController');
```


```
############################################################################################################
The basics of building a Laravel and Angular application - Working with a Laravel 4 + AngularJS application
############################################################################################################
```
```
https://laravel-news.com/basics-building-laravel-angular-application
http://angular-tips.com/blog/2014/10/working-with-a-laravel-4-plus-angular-application/
https://github.com/Foxandxss/angular-laravel4-workflow

laravel new laravelangulardemo
$ cd laravelangulardemo

$ git clone https://github.com/Foxandxss/angular-laravel4-workflow angular
$ cd angular
$ npm install

rm -rf angular/.git
$ git init

We delete the repository that comes with the workflow and we create a new one for the whole application, then we modify our .gitignore to support our Angular workflow:

/bootstrap/compiled.php
/vendor
composer.phar
composer.lock
.env.*.php
.env.php
.DS_Store
Thumbs.db

# Angular ignores
angular/node_modules
public/images
public/css
public/js
public/angular.html

git add .
$ git commit -m "Initial commit"
git push

cd angular
$ gulp

And then we modify our index.html file to put that Hello World.

File: angular/app/index.html

<!doctype html>
<html ng-app="app" lang="en">
<head>
  <meta charset="UTF-8">
  <title>Angular App</title>
  <link rel="stylesheet" href="<%= css %>">
</head>
<body>
  Hello, World, this is angular and to prove it, there is a computation: 5 + 3 == {{ 5 + 3 }}
  <script type="text/javascript" src="<%= js %>"></script>
</body>
</html>

File: app/routes.php

App::missing(function($exception)
{
    return File::get(public_path() . '/angular.html');
});

```