######
#
### React Laravel References
######

```
http://t3n.de/news/einstieg-react-wichtigsten-tools-848652/
https://www.codecademy.com/articles/react-setup-i
http://blog.tamizhvendan.in/blog/2015/11/23/a-beginner-guide-to-setup-react-dot-js-environment-using-babel-6-and-webpack/
https://www.tutorialspoint.com/reactjs/reactjs_environment_setup.htm
http://blog.dirk-helbert.de/blog/2017/05/12/reactjs-anfaenger-tutorial/
https://facebook.github.io/react/tutorial/tutorial.html
http://jamesknelson.com/learn-raw-react-no-jsx-flux-es6-webpack/
https://reactarmory.com/guides/learn-react-by-itself/react-basics
http://reactjs.de/posts/react-tutorial
https://tylermcginnis.com/reactjs-tutorial-a-comprehensive-guide-to-building-apps-with-react/

http://t3n.de/news/react-einstieg-856725/
http://t3n.de/news/einstieg-react-wichtigsten-tools-848652/

Install packs:

npm install -g babel
npm install -g babel-cli

npm install babel-core
npm install babel-loader
npm install babel-preset-react
npm install babel-preset-es2015


npm i react react-dom -S
npm install react --save
npm install react-dom --save

mkdir react-hello-world
cd react-hello-world
npm init


npm i webpack -S # or npm install webpack --save
npm install webpack-dev-server --save

Start code:

touch webpack.config.js
-------------------------------
var webpack = require('webpack');
var path = require('path');

var BUILD_DIR = path.resolve(__dirname, 'src/client/public');
var APP_DIR = path.resolve(__dirname, 'src/client/app');

var config = {
  entry: APP_DIR + '/index.jsx',
  output: {
    path: BUILD_DIR,
    filename: 'bundle.js'
  }
};

module.exports = config;
--------------------------------
./node_modules/.bin/webpack -d

src/client/index.html

<html>
  <head>
    <meta charset="utf-8">
    <title>React.js using NPM, Babel6 and Webpack</title>
  </head>
  <body>
    <div id="app" />
    <script src="public/bundle.js" type="text/javascript"></script>
  </body>
</html>



....


index.jsx
-----------------------------------
import React from 'react';
import {render} from 'react-dom';

class App extends React.Component {
  render () {
    return <p> Hello React!</p>;
  }
}

render(<App/>, document.getElementById('app'));
------------------------------
./node_modules/.bin/webpack -d


Create a new file AwesomeComponent.jsx

import React from 'react';

class AwesomeComponent extends React.Component {

  constructor(props) {
    super(props);
    this.state = {likesCount : 0};
    this.onLike = this.onLike.bind(this);
  }

  onLike () {
    let newLikesCount = this.state.likesCount + 1;
    this.setState({likesCount: newLikesCount});
  }

  render() {
    return (
      <div>
        Likes : <span>{this.state.likesCount}</span>
        <div><button onClick={this.onLike}>Like Me</button></div>
      </div>
    );
  }

}

export default AwesomeComponent;


--

 include it in the index.jsx file

 // ...
import AwesomeComponent from './AwesomeComponent.jsx';
// ...
class App extends React.Component {
  render() {
    return (
        <div>
          <p> Hello React!</p>
          <AwesomeComponent />
        </div>
    );
  }
}
// ...
```

######
#
### Laravel React Laravel 5.5 ReactJS Tutorial
######
```
https://github.com/connor11528/laravel-5-rest-api
https://github.com/talyssonoc/react-laravel
https://medium.com/@adelekandavid2013/reactjs-app-with-laravel-restful-api-endpoint-part-1-b3991dbf99f2
https://medium.com/@connorleech/adding-react-js-to-laravel-5-4-web-applications-with-laravel-mix-1c3e82950a20
https://appdividend.com/2017/08/31/laravel-5-5-reactjs-tutorial/

php artisan preset react
composer create-project --prefer-dist laravel/laravel ReactJSLaravelTutorial
npm install

env file and enter your database credentials.

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=LaravelReact
DB_USERNAME=root
DB_PASSWORD=mysql

php artisan migrate
php artisan preset react

.
.
.


Next, switch to the following structure directories.
ReactJSLaravelTutorial  >> resources  >>  assets  >>   js  there is one folder and two javascript files.

The folder name is components, which is react component and the second file is app.js other file is bootstrap.js

Go to the resources  >>  views  >>  welcome.blade.php file and copy the following code to it. Remove the existing code.

<!-- welcome.blade.php -->

<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="example"></div>
        <script src="{{asset('js/app.js')}}" ></script>
    </body>
</html>

.
.
.


npm run dev
php artisan serve

npm install react-router@2.8.1
npm run watch



copy the following code and paste it into the App.js file.

// app.js

require('./bootstrap');
import React from 'react';
import { render } from 'react-dom';
import { Router, Route, browserHistory } from 'react-router';

import Example from './components/Example';

render(<Example />, document.getElementById('example'));
Next change is to modify the Example.js component, copy paste the following code in that file.

import React, { Component } from 'react';

export default class Example extends Component {
    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col-md-8 col-md-offset-2">
                        <div className="panel panel-default">
                            <div className="panel-heading">Example Component</div>

                            <div className="panel-body">
                                I am an example component!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}




create one another component called Master.js inside components folder.

// Master.js

import React, {Component} from 'react';
import { Router, Route, Link } from 'react-router';

class Master extends Component {
  render(){
    return (
      <div className="container">
        <nav className="navbar navbar-default">
          <div className="container-fluid">
            <div className="navbar-header">
              <a className="navbar-brand" href="#">AppDividend</a>
            </div>
            <ul className="nav navbar-nav">
              <li className="active"><a href="#">Home</a></li>
              <li><a href="#">Page 1</a></li>
              <li><a href="#">Page 2</a></li>
              <li><a href="#">Page 3</a></li>
            </ul>
          </div>
      </nav>
          <div>
              {this.props.children}
          </div>
      </div>
    )
  }
}
export default Master;


Now, modify the app.js file and put this component as a root component.


// app.js

require('./bootstrap');
import React from 'react';
import { render } from 'react-dom';
import { Router, Route, browserHistory } from 'react-router';

import Master from './components/Master';

render(<Master />, document.getElementById('example'));



Step 4: Configure the ReactJS routes for our application.
Create three components inside components folder.

Make a CreateItem.js form to save the items data.

// CreateItem.js

import React, {Component} from 'react';

class CreateItem extends Component {
    render() {
      return (
      <div>
        <h1>Create An Item</h1>
        <form>
          <div className="row">
            <div className="col-md-6">
              <div className="form-group">
                <label>Item Name:</label>
                <input type="text" className="form-control" />
              </div>
            </div>
            </div>
            <div className="row">
              <div className="col-md-6">
                <div className="form-group">
                  <label>Item Price:</label>
                  <input type="text" className="form-control col-md-6" />
                </div>
              </div>
            </div><br />
            <div className="form-group">
              <button className="btn btn-primary">Add Item</button>
            </div>
        </form>
  </div>
      )
    }
}

export default CreateItem;

In app.js, we need to configure the routes.

// app.js

require('./bootstrap');
import React from 'react';
import { render } from 'react-dom';
import { Router, Route, browserHistory } from 'react-router';

import Master from './components/Master';
import CreateItem from './components/CreateItem';

render(
  <Router history={browserHistory}>
      <Route path="/" component={Master} >
        <Route path="/add-item" component={CreateItem} />
      </Route>
    </Router>,
        document.getElementById('example'));


Switch the browser to this URL: http://localhost:8000/
Now, click the CreateItem link, you will see the following screen.
Your URL will like this: http://localhost:8000/add-item




Step 5: Use axios to make AJAX Post request to the Laravel 5.5 Development Server.

Add some events to get the input data from the form and send the AJAX post request to the server.

// CreateItem.js

import React, {Component} from 'react';

class CreateItem extends Component {
  constructor(props){
    super(props);
    this.state = {productName: '', productPrice: ''};

    this.handleChange1 = this.handleChange1.bind(this);
    this.handleChange2 = this.handleChange2.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
  }
  handleChange1(e){
    this.setState({
      productName: e.target.value
    })
  }
  handleChange2(e){
    this.setState({
      productPrice: e.target.value
    })
  }
  handleSubmit(e){
    e.preventDefault();
    const products = {
      name: this.state.productName,
      price: this.state.productPrice
    }
    let uri = 'http://localhost:8000/items';
    axios.post(uri, products).then((response) => {
      // browserHistory.push('/display-item');
    });
  }

    render() {
      return (
      <div>
        <h1>Create An Item</h1>
        <form onSubmit={this.handleSubmit}>
          <div className="row">
            <div className="col-md-6">
              <div className="form-group">
                <label>Item Name:</label>
                <input type="text" className="form-control" onChange={this.handleChange1}/>
              </div>
            </div>
            </div>
            <div className="row">
              <div className="col-md-6">
                <div className="form-group">
                  <label>Item Price:</label>
                  <input type="text" className="form-control col-md-6" onChange={this.handleChange2}/>
                </div>
              </div>
            </div><br />
            <div className="form-group">
              <button className="btn btn-primary">Add Item</button>
            </div>
        </form>
  </div>
      )
    }
}
export default CreateItem;




Step 6: Make Laravel 5.5 Backend

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

php artisan migrate
php artisan make:controller ItemController --resource



ItemController contains all its functions of CRUD operations. We just need to put the code in it. I am right now putting the whole file with all the functions in it.

<?php

// ItemController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return response()->json($items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        $item->name = $request->get('name');
        $item->price = $request->get('price');
        $item->save();

        return response()->json('Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $item = Item::find($id);
      $item->delete();

      return response()->json('Successfully Deleted');
    }
}
We also need to create protected $fillable field in Item.php file otherwise ‘mass assignment exception‘ will be thrown.

<?php

// Item.php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name', 'price'];
}
Update the routes >> web.php file.

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::resource('items', 'ItemController');





Download the following Laravel Specific CORS package to avoid this issue and follow the steps.

composer require barryvdh/laravel-cors
Add the Cors\ServiceProvider to your config/app.php provider’s array

Barryvdh\Cors\ServiceProvider::class,
To allow CORS for all your routes, add the HandleCors middleware in the $middleware property of app/Http/Kernel.phpclass:

protected $middleware = [
    // ...
    \Barryvdh\Cors\HandleCors::class,
];
You can publish the config using this command:

php artisan vendor:publish --provider="Barryvdh\Cors\ServiceProvider"
Now, try again, it will save the data into the database. I have not set the redirect after saving the data but will set in short, while you can check the values in the database.


Step 7: Display the data into ReactJS Frontend
Make DisplayItem.js component inside components folder.

// DisplayItem.js

import React, {Component} from 'react';
import axios from 'axios';
import { Link } from 'react-router';
import TableRow from './TableRow';

class DisplayItem extends Component {
  constructor(props) {
       super(props);
       this.state = {value: '', items: ''};
     }
     componentDidMount(){
       axios.get('http://localhost:8000/items')
       .then(response => {
         this.setState({ items: response.data });
       })
       .catch(function (error) {
         console.log(error);
       })
     }
     tabRow(){
       if(this.state.items instanceof Array){
         return this.state.items.map(function(object, i){
             return <TableRow obj={object} key={i} />;
         })
       }
     }

  render(){
    return (
      <div>
        <h1>Items</h1>

        <div className="row">
          <div className="col-md-10"></div>
          <div className="col-md-2">
            <Link to="/add-item">Create Item</Link>
          </div>
        </div><br />

        <table className="table table-hover">
            <thead>
            <tr>
                <td>ID</td>
                <td>Item Name</td>
                <td>Item Price</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
              {this.tabRow()}
            </tbody>
        </table>
    </div>
    )
  }
}
export default DisplayItem;
Now, make TableRow.js component.

// TableRow.js

import React, { Component } from 'react';

class TableRow extends Component {
  render() {
    return (
        <tr>
          <td>
            {this.props.obj.id}
          </td>
          <td>
            {this.props.obj.name}
          </td>
          <td>
            {this.props.obj.price}
          </td>
          <td>
            <button className="btn btn-primary">Edit</button>
          </td>
          <td>
            <button className="btn btn-danger">Delete</button>
          </td>
        </tr>
    );
  }
}

export default TableRow;
Register this route in our application.

// app.js

import DisplayItem from './components/DisplayItem';

render(
  <Router history={browserHistory}>
      <Route path="/" component={Master} >
        <Route path="/add-item" component={CreateItem} />
        <Route path="/display-item" component={DisplayItem} />
      </Route>
    </Router>,
        document.getElementById('example'));
One thing we need to change is that, when we save the data, we need to redirect to this component. So in CreateItem.js file, we need to modify a bit of code.

// CreateItem.js

import {browserHistory} from 'react-router';

axios.post(uri, products).then((response) => {
      browserHistory.push('/display-item');
    });
Step 8: Edit and Update the data.
Make EditItem.js component inside components folder.

// EditItem.js

import React, {Component} from 'react';
import axios from 'axios';
import { Link } from 'react-router';

class EditItem extends Component {
  constructor(props) {
      super(props);
      this.state = {name: '', price: ''};
      this.handleChange1 = this.handleChange1.bind(this);
      this.handleChange2 = this.handleChange2.bind(this);
      this.handleSubmit = this.handleSubmit.bind(this);
  }

  componentDidMount(){
    axios.get(`http://localhost:8000/items/${this.props.params.id}/edit`)
    .then(response => {
      this.setState({ name: response.data.name, price: response.data.price });
    })
    .catch(function (error) {
      console.log(error);
    })
  }
  handleChange1(e){
    this.setState({
      name: e.target.value
    })
  }
  handleChange2(e){
    this.setState({
      price: e.target.value
    })
  }

  handleSubmit(event) {
    event.preventDefault();
    const products = {
      name: this.state.name,
      price: this.state.price
    }
    let uri = 'http://localhost:8000/items/'+this.props.params.id;
    axios.patch(uri, products).then((response) => {
          this.props.history.push('/display-item');
    });
  }
  render(){
    return (
      <div>
        <h1>Update Item</h1>
        <div className="row">
          <div className="col-md-10"></div>
          <div className="col-md-2">
            <Link to="/display-item" className="btn btn-success">Return to Items</Link>
          </div>
        </div>
        <form onSubmit={this.handleSubmit}>
            <div className="form-group">
                <label>Item Name</label>
                <input type="text"
                  className="form-control"
                  value={this.state.name}
                  onChange={this.handleChange1} />
            </div>

            <div className="form-group">
                <label name="product_price">Item Price</label>
                <input type="text" className="form-control"
                  value={this.state.price}
                  onChange={this.handleChange2} />
            </div>

            <div className="form-group">
                <button className="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
    )
  }
}
export default EditItem;
Now, register this route in the app.js file.

// app.js

import EditItem from './components/EditItem';

render(
  <Router history={browserHistory}>
      <Route path="/" component={Master} >
        <Route path="/add-item" component={CreateItem} />
        <Route path="/display-item" component={DisplayItem} />
        <Route path="/edit/:id" component={EditItem} />
      </Route>
    </Router>,
        document.getElementById('example'));
We need to update the TableRow.js component file.

<Link to={"edit/"+this.props.obj.id} className="btn btn-primary">Edit</Link>
Step 9: Delete The Data.
For delete the data, we just need to define the delete function in the TableRow.js file.

// TableRow.js

import React, { Component } from 'react';
import { Link, browserHistory } from 'react-router';

class TableRow extends Component {
  constructor(props) {
      super(props);
      this.handleSubmit = this.handleSubmit.bind(this);
  }
  handleSubmit(event) {
    event.preventDefault();
    let uri = `http://localhost:8000/items/${this.props.obj.id}`;
    axios.delete(uri);
      browserHistory.push('/display-item');
  }
  render() {
    return (
        <tr>
          <td>
            {this.props.obj.id}
          </td>
          <td>
            {this.props.obj.name}
          </td>
          <td>
            {this.props.obj.price}
          </td>
          <td>
            <Link to={"edit/"+this.props.obj.id} className="btn btn-primary">Edit</Link>
          </td>
          <td>
          <form onSubmit={this.handleSubmit}>
           <input type="submit" value="Delete" className="btn btn-danger"/>
         </form>
          </td>
        </tr>
    );
  }
}

export default TableRow;
So, finally our Laravel 5.5 ReactJS Tutorial CRUD Operations From Scratch is over.

https://github.com/KrunalLathiya/ReactJSLaravel5.5
```

######
#
### React JS crash course 2021
######
```
https://www.youtube.com/watch?v=w7ejDZ8SWv8&t=155s
https://www.youtube.com/watch?v=Hf4MJH0jDb4&t=304s
https://github.com/bradtraversy/react-crash-2021

xrandr -s 1440x900
sudo apt install firefox

https://code.visualstudio.com/docs/?dv=linux64_deb
sudo dpkg -i code_1.55.1-1617808414_amd64.deb





sudo apt-get install nodejs
sudo apt-get install npm

npx command not found
npm i -g npx
sudo npm i -g npx

You are running Node 8.10.0.
Create React App requires Node 10 or higher.
Please update your version of Node.


sudo npm cache clean -f
sudo npm install -g n
sudo n stable
sudo n latest
sudo apt-get install --reinstall nodejs-legacy

npx create-react-app my-app
#npm install -g npm@7.15.0
sudo npm uninstall -g n

wget -qO- https://raw.githubusercontent.com/nvm-sh/nvm/v0.35.3/install.sh | bash
npx create-react-app my-app

/*
Success! Created my-app at /home/demo/Git/ReactApp/my-app
Inside that directory, you can run several commands:

  npm start
    Starts the development server.

  npm run build
    Bundles the app into static files for production.

  npm test
    Starts the test runner.

  npm run eject
    Removes this tool and copies build dependencies, configuration files
    and scripts into the app directory. If you do this, you can’t go back!

We suggest that you begin by typing:

  cd my-app
  npm start

Happy hacking!
*/

npm --version
npm start # localhost:3000
npm run build

You can now view my-app in the browser.
  Local:            http://localhost:3000

Note that the development build is not optimized.
To create a production build, use npm run build.

code .

create src/components/Header.js
type "rafce" to create boiler template of component
The development server has disconnected. Refresh the page if necessary.  [HMR] Waiting for update signal from WDS.
```





