
### Full Stack Shopping Cart With MEVN Stack
https://medium.com/@jaouad_45834/full-stack-shopping-cart-with-mevn-stack-part-1-89dae1f35378

```
mkdir Vueexpress
npm install -g express-generator
express server
npm install
npm start

http://localhost:3000
```
------
```
const mongoose = require('mongoose');
const Schema = mongoose.Schema;

const ProductSchema = new Schema({
    name: String,
    price: Number,
    category: String,
    image: String,
    description: String
});

exports.module = mongoose.model('Product', ProductSchema);
```
-----
```
const mongoose = require('mongoose');
const Schema = mongoose.Schema;

const CategorySchema = new Schema({
    title: String
});

exports.module = mongoose.model('Category', CategorySchema);
```
-----
```
//Import the mongoose module
const mongoose = require('mongoose');

//Set up default mongoose connection
const mongoDB = 'mongodb://127.0.0.1/my_database';
mongoose.connect(mongoDB);

// Get Mongoose to use the global promise library
mongoose.Promise = global.Promise;

//Get the default connection
const db = mongoose.connection;

//Bind connection to error event (to get notification of connection errors)
db.on('error', console.error.bind(console, 'MongoDB connection error:'));
```

----
```
const express = require('express');
const router = express.Router();
const faker = require('faker');
const Product = require('../../models/Product');
const Category = require('../../models/Category');

router.get('/', function (req, res, next) {
    const categories = ["Baby", "Movies", "Shoes", "Books", "Electronics","Computers", "Kids"];
    for (let i = 0; i < 20; i++) {
        let product = new Product({
            name : faker.commerce.productName(),
            price : faker.commerce.price(),
            category: categories[Math.floor(Math.random() * categories.length)],
            description : faker.lorem.paragraph(),
            image: "https://images-na.ssl-images-amazon.com/images/I/4196ru-rkjL.jpg"
        });

        product.save();
    }
    for (let i = 0; i < categories.length; i++) {
        let cat = new Category({
            title: categories[i]
        });
        cat.save();
    }
    res.redirect('/')
});


module.exports = router;
```
-----
```
const seeder = require('./routes/seeder/products');
app.use(‘/seeder’, seeder);
```

-----
```
http://localhost:3000/seeder
```

-----

```
const express = require('express');
const router = express.Router();

const Product = require('../models/Product');

router.get('/', function (req, res, next) {
  let perPage = 3;
  let page = parseInt(req.query.page) || 0;
  let pages = 0;
  let nextUrl = '';
  let prevUrl = '';
  Product.count().exec(function (err, count) {
    Product.find()
      .limit(perPage)
      .skip(perPage * page)
      .exec(function (err, products) {
        pages = Math.floor(count / perPage);
        if (page === 0) {
          res.json({
            products,
            currentPage: page,
            pages,
            count,
            prevUrl: ``,
            nextUrl: `http://localhost:3000/products?page=${page + 1}`
          })

        } else if (page === pages - 1) {
          res.json({
            products: products,
            currentPage: page,
            pages,
            count,
            prevUrl: `http://localhost:3000/products?page=${page - 1}`,
            nextUrl: ``
          })
        } else if (page > 0 && page < pages) {
          res.json({
            products: products,
            currentPage: page,
            pages,
            count,
            prevUrl: `http://localhost:3000/products?page=${page - 1}`,
            nextUrl: `http://localhost:3000/products?page=${page + 1}`
          })
        }else {
          res.redirect('/products')
        }

      });
  });
});

router.get('/:id', function (req, res, next) {
  Product.findById(req.params.id, function (err, product) {
    if (err) return console.log(err);
    res.status(200).json(product);
  })
});

module.exports = router;
```

-----

```
const express = require('express');
const router = express.Router();

const Category = require('../models/Category');
const Product = require('../models/Product');

router.get('/', function (req, res, next) {
    Category.find(function (err, categories) {
        if (err) return console.log(err);
        res.status(200).json(categories);
    });

});
//display all products in a specific Category
router.get('/:category', function (req, res, next) {
    Category.findOne({title: req.params.category}, function (err, category) {
        if (err) return console.log(err);
        Product.find({category: category.title}, function(err, products) {
            if(err) return console.log(err);
            res.status(200).json(products);
        });
    });
});

module.exports = router;
```

-----

```
app.use('/products', products);
app.use('/categories', categories);
```