```
#################################################################
#
#   Laravel 5.5 Angular 4 Tutorial Example From Scratch
#   https://appdividend.com/2017/09/22/laravel-5-5-angular-4-tutorial-example-scratch/#
#
#################################################################
```

```
Setup an Angular 4 Environment.
First, we need to install Angular CLI globally. So type the following command.

npm install -g @angular/cli
Okay, now we need to create one project, let us call it ng4tutorial.

Type the following command in your terminal.

ng new ng4tutorial
It will create some files and folders and also install all the front end dependencies.

After install, type the following command.

cd ng4tutorial
ng serve --open

Step 2: Create one form to enter the data.

Angular 4 is totally modular. All the component files reside in the src  >>  app folder.

We are using Bootstrap CSS Framework to design our form. So I have downloaded bootstrap CSS file in src  >>  assets directory called app.css file.

Our index.html file looks like this.

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Ng4app</title>
  <base href="/">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="/assets/app.css" rel="stylesheet">
</head>
<body>
  <app-root></app-root>
</body>
</html>
```

```
All the public static files are served from the assets folder.

For creating the form, we need to modify the app.component.html file. This file resides in src  >>  app directory.

<!--The whole content below can be removed with the new code.-->
<div class="container">
  <h1>
    Welcome to {{title}}!!
  </h1>
  <hr />
    <form>
      <div class="form-group">
        <label for="name">Item Name:</label>
        <input type="text" class="form-control">
      </div>
      <div class="form-group">
        <label for="price">Item Price:</label>
        <input type="text" class="form-control">
      </div>
      <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>
```

```
Our app.component.ts file looks like this.

// app.component.ts

import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'Laravel Angular 4 App';
}
```







```
Step 3: Handle the input data.
First of all, we need to import two modules in the app.module.ts file.

FormsModule
HttpModule


And these modules are also included in the import array. So our src  >>  app  >>  app.module.ts file looks like this.

// app.module.ts

import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule }   from '@angular/forms';
import { HttpModule }    from '@angular/http';

import { AppComponent } from './app.component';

@NgModule({
  declarations: [
    AppComponent
  ],
  imports: [
    BrowserModule, FormsModule, HttpModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
```

```
Now, we need to include Angular Form Object into our HTML. Our final code of app.component.ts looks like this.

// app.component.ts

<div class="container">
  <h1>
    Welcome to {{title}}!!
  </h1>
  <hr />
    <form (ngSubmit)="onSubmit(fm)" #fm="ngForm">
      <div class="form-group">
        <label for="name">Item Name:</label>
        <input type="text" class="form-control" ngModel name="name">
      </div>
      <div class="form-group">
        <label for="price">Item Price:</label>
        <input type="text" class="form-control" ngModel name="price">
      </div>
      <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>
```


```
<form (ngSubmit)="onSubmit(fm)" #fm="ngForm">
It is the way to tell AngularJS that it needs to create an object that describes the whole form element and its values.

After press the submit, onSubmit() function is called and in that we can get all the values of the form.

// app.component.ts

import { Component } from '@angular/core';
import { Item } from './Item';
import { NgForm }   from '@angular/forms';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'Laravel Angular 4 App';
  onSubmit(form: NgForm){
  	console.log(form.value);
  }
}
```


```
Here onSubmit() function, we get all the form values. Now, we can send the POST request to the Laravel Server.

Step 4: Send the data to the Laravel server.
Next step would be to call HTTP Service to handle the POST request.

First, we need to import two modules in app.component.ts file.

import { Http, Headers } from '@angular/http';
import 'rxjs/add/operator/toPromise';
The further step would be to call that service. This is my full code of the app.component.ts file.

// app.component.ts

import { Component, Injectable } from '@angular/core';
import { Item } from './Item';
import { NgForm }   from '@angular/forms';
import { Http, Headers } from '@angular/http';
import 'rxjs/add/operator/toPromise';

@Injectable()
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
    constructor(private _http: Http){}
        private headers = new Headers({'Content-Type': 'application/json'});
  	title = 'Laravel Angular 4 App';
  	onSubmit(form: NgForm): Promise <Item>{
        return this._http.post('http://127.0.0.1:8000/api/items', JSON.stringify(form.value), {headers: this.headers})
  		   .toPromise()
    	           .then(res => res.json().data)
    	            .catch(this.handleError);
  }
  private handleError(error: any): Promise<any> {
  console.error('An error occurred', error); // for demo purposes only
  return Promise.reject(error.message || error);
  }
}
I have used Promise and Observables. Also imported it on the Top.

Step 5: Create A Laravel Backend For the Request.
Create one Laravel project by typing the following command.

composer create-project laravel/laravel --prefer-dist ng4Laravel55
Edit the .env file to set the MySQL database credentials.
```

```
Next, switch to your command line interface and type the following command.

php artisan make:model Item -m



Navigate to the migration file in the database  >>  migrations  >>  create_items_table and copy the following code into it.

<?php

// create_items_table

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
Type the following command in your terminal.

php artisan migrate
Create one controller called ItemController.

php artisan make:controller ItemController
Register the routes in the routes  >>  api.php file.

Route::post('items', 'ItemController@store');
In the Item.php model, we need to include the $fillable property to prevent the mass assignment exceptions.

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name', 'price'];
}
Write the store function in the ItemController.php file to save the data into the database.

<?php

// ItemController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Item([
          'name' => $request->get('name'),
          'price' => $request->get('price')
        ]);
        $item->save();
        return response()->json('Successfully added');
    }
}
Start the Laravel Development server by the typing the following command.

php artisan serve
Step 6: Resolve CORS problem
Download the following Laravel Specific CORS package to avoid this issue and follow the steps.

composer require barryvdh/laravel-cors
Add the Cors\ServiceProvider to your config/app.php provider’s array.

Barryvdh\Cors\ServiceProvider::class,
To allow CORS for all your routes, add the HandleCors middleware in the $middleware property of app/Http/Kernel.phpclass:

protected $middleware = [
    // ...
    \Barryvdh\Cors\HandleCors::class,
];
You can publish the config using this command:

php artisan vendor:publish --provider="Barryvdh\Cors\ServiceProvider"
Now, try again, it will save the data into the database. I have not set the redirect after saving the data but will set in short, while you can check the values in the database.

For now, this is enough, we can build CRUD functionality in the next article. So stay tuned.
This is the basic example of Laravel 5.5 Angular 4 Tutorial.
```