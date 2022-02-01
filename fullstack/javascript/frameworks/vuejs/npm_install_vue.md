
### url

```
https://cli.vuejs.org/guide/installation.html
https://mochajs.org/
https://www.npmjs.com/package/@vue/cli-plugin-unit-mocha
https://cli.vuejs.org/core-plugins/unit-mocha.html
https://github.com/vuejs/vue-test-utils-mocha-webpack-example
https://www.npmjs.com/package/mocha-webpack
https://github.com/vuejs/vue-cli
https://www.npmjs.com/package/jsdom-global
https://github.com/rstacruz/jsdom-global
https://github.com/modosc/global-jsdom
```

```
npm install vue
npm uninstall vue-cli -g
npm install webpack mocha mocha-webpack --save-dev
npm install --save-dev --save-exact jsdom jsdom-global
```

--------------------------------------------------------
#
### An intuitive CLI for processing video, powered by FFmpeg
https://www.npmjs.com/package/vdx/v/0.0.2?activeTab=readme

```
npm install --global vdx

$ vdx '*.mov' --crop 360,640    # Crop to width 360, height 640 
$ vdx '*.mov' --format gif      # Convert to GIF 
$ vdx '*.mov' --fps 12          # Set the frame rate to 12 
$ vdx '*.mov' --no-audio        # Strip audio 
$ vdx '*.mov' --resize 360,-1   # Resize to width 360, maintaining aspect ratio 
$ vdx '*.mov' --reverse         # Reverse 
$ vdx '*.mov' --rotate 90       # Rotate 90 degrees clockwise 
$ vdx '*.mov' --speed 2         # Double the speed 
$ vdx '*.mov' --trim 0:05,0:10  # Trim from time 0:05 to 0:10 
$ vdx '*.mov' --volume 0.5      # Halve the volume 
$ vdx '*.mov' --crop 10,20,360,640
```


-------------------------------------
#
### npm Tutorial for Beginners 
```
https://www.youtube.com/watch?v=r0CJwuCP2ck&list=PLC3y8-rFHvwhgWwm5J3KqzX47n7dwWNrq&index=5
https://docs.npmjs.com/cli/v7/using-npm/config

sudo apt install nodejs
sudo apt install npm
# check
node -v
npm -v
npm help
npm install -h
npm help-search update

# config
package.json
npm init --yes
npm config set init-author-name "some name"
npm set init-license "MIT"
npm config get init-author-name
npm config delete init-license
npm config delete init-author-name

# Installing Local Packages
npm install <package>
npm install <package> --save
npm install <package> --save-dev

npm uninstall <package> --save
npm uninstall <package> --save-dev

# installing Global Packages
npm install <package> -g
npm uninstall <package> -g
npm remove <package> -g

# Listing Packages
npm list
npm list --depth 1
npm list --global true

# npm versioning
npm install <package>@3.3.0 --save

~4.14.1 - keep major version and minor version
npm install

npm update <package> --save
npm update --dev --save-dev
npm update -g

npm prune
npm start
```


---------------------------------------------
#
### MEAN Stack
https://www.youtube.com/watch?v=QUULp3sH1vQ&list=PLC3y8-rFHvwj200LLotCYum_9wmGeTJx9&index=2
```

MongoDB Express Angular Node

apt install nodejs
npm install -g @angular/cli

ng new ngApp --routing
ng server -o
ng build

npm install --save express body-parser

add server.js
const express
const bodyParser
const path
const api
const port
const app

add folder server/routes/api.js

npm install --save mongoose
```
------------------------------------------------------------------------------
```
https://stackoverflow.com/questions/60200991/unable-to-get-angular-cli-version-though-all-the-requirements-are-installed
https://github.com/nvm-sh/nvm


https://github.com/angular/angular-cli/issues/17162
ng --version
Node.js version v8.10.0 detected.
The Angular CLI requires a minimum Node.js version of either v10.13 or v12.0.

Please update your Node.js version or visit https://nodejs.org/ for additional instructions.

nvm install 11
nvm install 12
nvm alias default 12
nvm use 11
npm install @angular/cli -g


nvm install 12
nvm use 12
npm install @angular/cli -g
ng --version
```

-----------------------------------------------
#
### Packages
```
https://github.com/reduxjs/redux
https://github.com/react-boilerplate/react-boilerplate
https://github.com/reduxjs/redux
https://github.com/reduxjs/react-redux
https://reactjs.org/docs/getting-started.html
https://redux.js.org/tutorials/fundamentals/part-5-ui-react
https://redux.js.org/introduction/examples

# counter-vanilla
git clone https://github.com/reduxjs/redux.git
cd redux/examples/counter-vanilla
open index.html

# counter
git clone https://github.com/reduxjs/redux.git
cd redux/examples/counter
npm install
npm start

# todos
git clone https://github.com/reduxjs/redux.git
cd redux/examples/todos
npm install
npm start

# todos-with-undo
git clone https://github.com/reduxjs/redux.git
cd redux/examples/todos-with-undo
npm install
npm start

# todos-flow - https://codesandbox.io/s/github/reduxjs/redux/tree/master/examples/todos-flow
git clone https://github.com/reduxjs/redux.git
cd redux/examples/todos-flow
npm install
npm start

# todomvc - https://codesandbox.io/s/github/reduxjs/redux/tree/master/examples/todomvc
git clone https://github.com/reduxjs/redux.git
cd redux/examples/todomvc
npm install
npm start

# shopping-cart - https://codesandbox.io/s/github/reduxjs/redux/tree/master/examples/shopping-cart
git clone https://github.com/reduxjs/redux.git
cd redux/examples/shopping-cart
npm install
npm start

# async - https://codesandbox.io/s/github/reduxjs/redux/tree/master/examples/async
git clone https://github.com/reduxjs/redux.git
cd redux/examples/async
npm install
npm start

npx create-react-app my-app --template redux
npm install react-redux

npm install @reduxjs/toolkit react-redux
npm install redux

git clone --depth=1 https://github.com/react-boilerplate/react-boilerplate.git <YOUR_PROJECT_NAME>
cd <YOUR_PROJECT_NAME>.
npm run setup
npm start
http://localhost:3000
npm run clean
```

---------------------------------------------
#
### Delete node_modules like a Pro - Fireship
```
https://www.youtube.com/watch?v=qOSH2pYg6m8

npx npkill
```

---------------------------------------------
#
### Learn React In 30 Minutes
https://www.youtube.com/watch?v=hQAHSlTtcmY
```
node -v
npx create-react-app .
npm start
npm run bild
```

---------------------------------------------
#
### Next.js in 100 Seconds
```
https://www.youtube.com/watch?v=Sklc_fQBmcs
https://github.com/fireship-io/nextjs-basics
```

---------------------------------------------
#
### How can I completely uninstall nodejs, npm and node in Ubuntu [closed]
https://stackoverflow.com/questions/32426601/how-can-i-completely-uninstall-nodejs-npm-and-node-in-ubuntu
```

sudo apt-get remove nodejs
sudo apt-get remove npm

sudo apt-get remove nodejs npm node
sudo apt-get purge nodejs

from folder /etc/apt/sources.list.d and remove any node list
ls /etc/apt/sources.list.d

sudo apt-get update

which node
which nodejs
which npm

rm -rf /usr/local/bin/node
rm -rf /usr/local/bin/npm
rm -rf /usr/local/bin/npx
```
