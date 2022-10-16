


------------------------------------------------------

```
https://github.com/bradtraversy/express_crash_course

const express = require('express');
const app = express();
app.get('/',function(req,res){
	res.send('lol')
});
app.listen(5000);
```
------------------------------------------------------
```
sudo snap install code --classic
sudo snap install intellij-idea-community --classic
sudo snap install pycharm-community --classic
sudo snap install brave


https://getmdl.io/
https://getmdl.io/started/index.html
https://getmdl.io/components/index.html
https://material.io/
https://material.io/components
https://material.io/icons
```

### node

```
let os = require('os');
let fs = require('fs');
let path = require('path');
let url = require('url');
let uuid = require('uuid');


let http = require('http');
const server = http.createServer(route);
server.liste(3000);
function route(req,res){
   if(req.url=='/'){ res.write('ok'); } res.end();
}
```
------------------------------------------------------
```
https://www.npmjs.com/package/selenium-webdriver


npm init
npm install express
npm install -g nodemon
```


```
------------------------------------------------------------
####################################################
Docker Node.js EPIPE error - Memory and Swap
####################################################
Error: write EPIPE

npx browserslist@latest --update-db
sudo apt-get install libfontconfig
node-red-node-pi-gpio

npm run build
gatsby build
```


```
####################################################
node environment
####################################################

https://www.jvandemo.com/how-to-use-environment-variables-to-configure-your-angular-application-without-a-rebuild/
https://k6.io/docs/using-k6/environment-variables/
https://stackoverflow.com/questions/71798412/problems-with-env-variables-on-angular-13
https://github.com/vercel/next.js/issues/159
https://stackoverflow.com/questions/39508795/how-to-access-windows-environment-variables-in-angular2-js-app
https://github.com/angular/angular-cli


environments/environments.prod.ts

export const environment = {
  apiUrl: 'http://my-api-url',
  enableDebug: false
};

...

import { Component } from '@angular/core';
import { environment } from './../environments/environment';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  constructor() {
    console.log(environment.apiUrl);
  }
  title = 'app works!';
}

---

import { EnvService } from './env.service';

export const EnvServiceFactory = () => {
  // Create env
  const env = new EnvService();

  // Read environment variables from browser window
  const browserWindow = window || {};
  const browserWindowEnv = browserWindow['__env'] || {};

  // Assign environment variables from browser window to env
  // In the current implementation, properties from env.js overwrite defaults from the EnvService.
  // If needed, a deep merge can be performed here to merge properties instead of overwriting them.
  for (const key in browserWindowEnv) {
    if (browserWindowEnv.hasOwnProperty(key)) {
      env[key] = window['__env'][key];
    }
  }

  return env;
};

export const EnvServiceProvider = {
  provide: EnvService,
  useFactory: EnvServiceFactory,
  deps: [],
};

.....

import { Component } from '@angular/core';
import { EnvService } from '../env.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss'],
})
export class HomeComponent {
  constructor(
    private env: EnvService
  ) {
    if(env.enableDebug) {
      console.log('Debug mode enabled!');
    }
  }
}

...

env.js

(function (window) {
  window.__env = window.__env || {};
  window.__env.apiUrl = 'http://localhost:8080';
  window.__env.enableDebug = true;
}(this));


(function (window) {
  window.__env = window.__env || {};
  window.__env.apiUrl = 'http://production.your-api.com';
  window.__env.enableDebug = false;
}(this));

........

// package.json
{
  "scripts": {
     "start": "MY_VAR=hi next",
  }
}

// pages/index.js
const env = 'undefined' !== process ? process.env.MY_VAR : null
export default class extends React.Component {
  static getInitialProps () {
    return { env }
  }
  render () {
    return <div>{this.props.env}</div>
  }
}


........

// package.json
{
  "scripts": {
     "start": "MY_VAR=hi next",
  }
}


// components/Hoc.js
import React from 'react';

export default function hoc(WrappedComponent) {
  return class Hoc extends React.Component {
    render() {
      return <WrappedComponent {...this.props} />;
    }
  };
}


// pages/index.js
import React from 'react';
import hoc from '../components/Hoc';

const env = process.env.MY_VAR;

class Index extends React.Component {
  static getInitialProps() {
    return { env };
  }
  render() {
    return <div>{this.props.env}</div>;
  }
}

export default hoc(Index);
// above doesn't work, but `export default Index;` renders "hi" properly


const { MY_VAR } = 'undefined' !== typeof window ? window.env : process.env

export default () => {
  return (
    <div>
      {MY_VAR}
      <script dangerouslySetInnerHTML={{ __html: 'env = ' + escape(JSON.stringify({ MY_VAR })) }}/>
    </div>      
  )
}


// components/Hoc.js
import React from 'react';

export default function hoc(WrappedComponent) {
  return class Hoc extends React.Component {
    static getInitialProps(ctx) {
        return WrappedComponent.getInitialProps(ctx)
    }

    render() {
      return <WrappedComponent {...this.props} />;
    }
  };
}

// withApiHoc.js

import React from 'react';
import Axios from 'axios';

const endpoint = process.env.API_ENDPOINT;

export default (WrappedComponent) => {
  return class extends React.Component {
    static getInitialProps(ctx) {
      let props = {};

      if (WrappedComponent.getInitialProps) {
        props = { ...WrappedComponent.getInitialProps(ctx) };
      }

      return {
        ...props,
        endpoint,
      }
    }

    render() {
      return (
        <WrappedComponent
          {...this.props}
          api={
            Axios.create({
              baseURL: this.props.endpoint + '/api/v1/',
            })
          }
        />
      );
    }
  };
}


const webpack = require('webpack');

if (process.env.NODE_ENV !== 'production') {
  require('dotenv').config();
}

module.exports = {
  webpack: (config) => {
    config.plugins.push(
      new webpack.DefinePlugin({
        'process.env.FB_APP_ID': JSON.stringify(process.env.FB_APP_ID),
        'process.env.FB_PAGE_ID': JSON.stringify(process.env.FB_PAGE_ID),
      })
    );

    return config;
  },
};


const webpack = require('webpack');

if (process.env.NODE_ENV !== 'production') {
  require('dotenv').config();
}

module.exports = {
  webpack: (config) => {
    config.plugins.push(
      new webpack.DefinePlugin({
        'process.env.GRAPHQL_URL': JSON.stringify(process.env.GRAPHQL_URL),
      })
    );

    return config;
  },
};

if(window){  
  Object.assign(__env, window.__env);
}

var myModule = angular.module('app', []);
myModule.constant('__env', __env); 

```


```

list all npm pkgs with beta 0
https://www.youtube.com/watch?v=GWgRw5jiYy0

npm ls | grep @0
```




