
### Modes and Environment Variables
```

https://cli.vuejs.org/guide/mode-and-env.html#example-staging-mode
https://cli.vuejs.org/guide/mode-and-env.html
https://stackoverflow.com/questions/50828904/using-environment-variables-with-vue-js
https://vitejs.dev/guide/env-and-mode.html

.env
.env.production
.env.local

.env                # loaded in all cases
.env.local          # loaded in all cases, ignored by git
.env.[mode]         # only loaded in specified mode
.env.[mode].local   # only loaded in specified mode, ignored by git


VUE_APP_NOT_SECRET_CODE=1234



webpack.config.js


console.log(process.env.VUE_APP_NOT_SECRET_CODE)
```
----------
```

if (process.env.NODE_ENV === 'production') {
  module.exports.devtool = '#source-map'
  // http://vue-loader.vuejs.org/en/workflow/production.html
  module.exports.plugins = (module.exports.plugins || []).concat([
    new webpack.DefinePlugin({
      'process.env': {
        NODE_ENV: '"production"'
      }
    }),
    new webpack.optimize.UglifyJsPlugin({
      sourceMap: true,
      compress: {
        warnings: false
      }
    }),
    new webpack.LoaderOptionsPlugin({
      minimize: true
    })
  ])
}

if (process.env.NODE_ENV === 'development') {

  module.exports.plugins = (module.exports.plugins || []).concat([
    new webpack.DefinePlugin({
      'process.env': {
        NODE_ENV: '"development"'
      }
    })
  ]);

}

if (process.env.NODE_ENV === 'development') {

  module.exports.plugins = (module.exports.plugins || []).concat([
    new webpack.DefinePlugin({
      'process.env': {
        NODE_ENV: '"development"',
        ENDPOINT: '"http://localhost:3000"',
        FOO: "'BAR'"
      }
    })
  ]);
}

vue.config.js

const webpack = require('webpack');

// options: https://github.com/vuejs/vue-cli/blob/dev/docs/config.md
module.exports = {
    // default baseUrl of '/' won't resolve properly when app js is being served from non-root location
    baseUrl: './',
    outputDir: 'dist',
    configureWebpack: {
        plugins: [
            new webpack.DefinePlugin({
                // allow access to process.env from within the vue app
                'process.env': {
                    NODE_ENV: JSON.stringify(process.env.NODE_ENV)
                }
            })
        ]
    }
};

```



### Getting 'Cross-Origin Request Blocked' on a GET request #853
#### axios CORS error No 'Access-Control-Allow-Origin' header is present on the requested resource
```

https://github.com/axios/axios/issues/569
https://github.com/axios/axios/issues/853
https://stackoverflow.com/questions/50949594/axios-having-cors-issue
https://www.stackhawk.com/blog/vue-cors-guide-what-it-is-and-how-to-enable-it/
https://dev.to/alirezahamid/how-to-fix-cors-issue-in-vuejs-545o
https://stackoverflow.com/questions/40863417/cors-issue-with-vue-js

// vue.config.js
module.exports = {
  devServer: {
        proxy: 'http://api.back.end',
    }
}
```

----------
```

 const headers = {
        'Content-Type': 'text/plain'
    };

  await axios.post(
        'http://localhost:3001/login',
        {
            user_name: this.state.user_name,
            password: this.state.password,
        },
        {headers}
        ).then(response => {
            console.log("Success ========>", response);
        })
        .catch(error => {
            console.log("Error ========>", error);
        }
    )
```


----------

```

axios.get( 'http://localhost:8000/api/###',
 {
      headers: {
          'Access-Control-Allow-Origin': '*',
       }
}).then(function (response) {
  console.log('response is : ' + response.data);
}).catch(function (error) {
    console.log(error.response);
});`
```

----------
```

vue.config.js

module.exports = {
    devServer:{
        proxy: {
            '/apiv1': {
                target: 'https://fuping.site/',
                changeOrigin: true,
                pathRewrite: {
                    '^/apiv1': ''
                }
            },
        },
    }
}

this.$axios({
  method:'get',
  url:'apiv1/about/'
}).then(function(response){
  console.log(response.data)
}).catch(error=>{
  console.log(error)
})

```

----------
```

axios.get('https://a.4cdn.org/a/threads.json', {
    headers: {
        'Access-Control-Allow-Origin': '*',
        'Access-Control-Allow-Headers': 'Content-Type, Authorization',
    },
    proxy: {
        host: '104.236.174.88',
        port: 3128
    }
    }).then(function (response) {
        console.log('response is : ' + response.data);
    }).catch(function (error) {
        if (error.response) {
            console.log(error.response.headers);
        }
        else if (error.request) {
            console.log(error.request);
        }
        else {
            console.log(error.message);
        }
        console.log(error.config);
});

```

----------
```

return axios(url, {
      method: 'GET',
      mode: 'no-cors',
      headers: {
        'Access-Control-Allow-Origin': '*',
        'Content-Type': 'application/json',
      },
      withCredentials: true,
      credentials: 'same-origin',
    }).then(response => {
    })
```

----------

```

const getData = async () => {
    await axios
      .get(
        'https://cors-anywhere.herokuapp.com/' +
          '<YOURPAGE>',
      )
      .then(({ data }) => setData(data.data))
  }
```

----------

```

const board = this.props.routeParams.tag;
var config = {
    headers: {'Access-Control-Allow-Origin': '*'}
};
axios.get('https://a.4cdn.org/' + board + '/threads.json', config)
    .then(function (response) {
        console.log(response.data);
});

```
----------
```

axios.get('https://a.4cdn.org/a/threads.json', {
	headers: {
	  'Access-Control-Allow-Origin': '*',
	},
	proxy: {
	  host: '104.236.174.88',
	  port: 3128
	}
	}).then(function (response) {
		console.log('response is : ' + response.data);
	}).catch(function (error) {
		if (error.response) {
		  console.log(error.response.headers);
		}
		else if (error.request) {
	      console.log(error.request);
		}
		else {
		  console.log(error.message);
		}
	console.log(error.config);
});
```

----------

```

axios.defaults

axios.defaults.headers.common = {
	...axios.defaults.headers.common,
	'Access-Control-Allow-Origin': 'http://localhost:3000',
	"Content-Type": 'application/json',
	"Authorization": token ? `Token ${token}` : undefined
};
axios.defaults.preflightContinue = true;
//axios.defaults.crossDomain = true;
axios.defaults.withCredentials = !!token;
```

----------

```

const {name, email, city, country, message} = this.state.contact;
const formData = new FormData();

formData.append('name', name);
formData.append('email', email);
formData.append('city', city);
formData.append('country', country);
formData.append('message',message);
const url = 'http://localhost/xxx-api/contacts.php';
axios({
    method: 'post',
    url,
    data: formData,
    config: {
        headers: {
            'Content-Type': 'multipart/form-data',
        }
    }
}).then(resp => {
    console.log('Submission response', resp);
}).catch(err => console.error(err));`
```

----------

```

npm i cors --save


index.js
const cors = require('cors')
app.use(cors())



npm install cors

var express = require('express') , cors = require('cors') , app = express();
app.options('*', cors()); // preflight OPTIONS; put before other routes
app.listen(80, function(){
	console.log('CORS-enabled web server listening on port 80');
});


if(env('APP_DEBUG')){
    return $next($request)
             ->header('Access-Control-Allow-Origin', '*')
             ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
             ->header('Access-Control-Allow-Headers', '*');
}
else {
    return $next($request);
}
```

----------

```

app.use(function(req, res, next) {
  res.header('Access-Control-Allow-Origin', '*');
  res.header('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
  next();
});

app.use(
    cors({
        credentials: true,
        origin: [
            'http://localhost:8080',
            'http://your-production-website.com'
        ]
    })
)
```

### npm yarn

```

sudo npm install --save
npm audit fix
npm audit fix --force
npm audit report
npm run serve

yarn install
yarn serve
```

