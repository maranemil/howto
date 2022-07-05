```
################################################################
#	create-todo-app-laravel
#	https://www.cloudways.com/blog/create-todo-app-laravel-5-4/
################################################################
```

```
# create App
---------------------------------
composer create-project laravel/laravel todoapp
```
```
# create DB
---------------------------------
public function up()
{
    Schema::create('users', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('email')->unique();
        $table->string('password');
        $table->string('userimage');
        $table->string('api_key')->nullable()->unique();
        $table->rememberToken();
        $table->timestamps();
    });
}
```
```
php artisan make:migration create_todo_table
php artisan migrate
php artisan make:controller TodoController --resource --model=Todo # Create Models and Controllers
```

```
Create Models and Controllers
---------------------------------
protected $table = 'todo';
protected $fillable = ['todo','category','user_id','description'];

<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Todo extends Model
{
    protected $table = 'todo';
    protected $fillable = ['todo','category','user_id','description'];
}
```


```
User Model
---------------------------------
public function todo()
{
    return $this->hasMany('App\Todo');
}

<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    use Notifiable;
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name', 'email', 'password','userimage'
    ];
    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /*
    * Get Todo of User
    *
    */
    public function todo()
    {
        return $this->hasMany('App\Todo');
    }
}
```