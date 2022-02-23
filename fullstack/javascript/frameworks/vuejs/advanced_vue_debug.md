#
### Advanced Javascript Debugging With Vue.js

npm install vuejs-logger

```
https://highlandsolutions.com/blog/advanced-javascript-debugging-with-vue-js-in-chrome
https://medium.com/idomongodb/visual-studio-code-debugging-vue-js-d3bf5bcc6656
https://v2.vuejs.org/v2/cookbook/debugging-in-vscode.html?redirect=true
https://medium.com/@marshallswain/debugging-a-new-vue-cli-app-with-vs-code-ade4945e75f0
```
```
chrome
------------------
resources/js
breakpoints
console.log


vscode
------------------
Bug
Debugger for Chrome
launch.json -> "breakOnLoad" :true

Webpack source-map
odule.exports = {
    configureWebpack: {
        devtool: 'source-map'
    }
}


npm start serve
DEBUG CONSOLE
```
------------------------------------------------------------
```
VS Code ####

https://v2.vuejs.org/v2/cookbook/debugging-in-vscode.html?redirect=true

https://marketplace.visualstudio.com/items?itemName=msjsdiag.debugger-for-chrome
https://marketplace.visualstudio.com/items?itemName=firefox-devtools.vscode-firefox-debug
https://chrome.google.com/webstore/detail/vuejs-devtools/nhdogjmejiglipccpnnnanhbledajbpd?hl=en
https://addons.mozilla.org/en-US/firefox/addon/vue-js-devtools/
https://github.com/vuejs/devtools


ext install msjsdiag.debugger-for-chrome
ext install firefox-devtools.vscode-firefox-debug

If you use Vue CLI 3, set or update the devtool property inside vue.config.js:

module.exports = {
  configureWebpack: {
    devtool: 'source-map'
  }
}
```
------------------------------------------------------------
```
https://stackoverflow.com/questions/59925475/is-there-any-good-way-to-debug-vuejs-computed-properties-and-templates

return {Component1, data, ComputedProp }
try { ... } catch(e) { console.log(e); }.
```
------------------------------------------------------------
```
https://suedbroecker.net/2021/05/17/how-to-debug-a-javascript-code-of-a-vue-js-application-using-visual-studio-code/

source code of your Vue.js application
{
     "type": "chrome",
     "request": "launch",
     "name": "vuejs: chrome",
     "url": "http://localhost:8080",
     "webRoot": "[YOUR_PATH_TO_THE_CODE]/src",
        "breakOnLoad": true,
        "sourceMapPathOverrides": {
        "webpack:///src/*": "${webRoot}/*"
     }
}

Create a file called vue.config.js in the root folder of your Vue.js project.


// vue.config.js
/**
 * @type {import('@vue/cli-service').ProjectOptions}
 */
 module.exports = {
    configureWebpack: {
        devtool: 'source-map'
    }
}

```
------------------------------------------------------------
https://vuejsdevelopers.com/2018/10/16/vue-js-advanced-debugging/
```
console.error("[Vue warn]:" + msg + trace)
```
------------------------------------------------------------
```
https://vuedose.tips/debugging-templates-in-vue-js

Vue.prototype.$debugger = function(){
debugger;
}

_c("h1", [ _vm._v( _vm.s ( function(){ debugger })() || _vm.message )) ]);
```

------------------------------------------------------------
https://medium.com/@grusingh/debug-vuejs-jest-tests-in-vscode-63e2ed45e503
```

package.json

"test:debug": "node --inspect-brk node_modules/.bin/vue-cli-service test:unit --no-cache --watch --runInBand"


jest.config.js
transformIgnorePatterns: ['/node_modules/(?!@babel)']

.vscode/launch.json

{
  "version": "0.2.0",
  "configurations": [
   {
      "type": "node",
      "request": "launch",
      "name": "Debug Unit Tests",
      "runtimeExecutable": "npm",
      "runtimeArgs": [
        "run-script",
        "test:debug",
        "${file}"
      ],
      "port": 9229
    }
  ]
}
```
------------------------------------------------------------
```
PhpStorm

https://www.jetbrains.com/help/phpstorm/vue-js.html
https://www.jetbrains.com/help/phpstorm/vue-js.html#vue_running_and_debugging_debug
https://www.jetbrains.com/help/phpstorm/run-debug-configuration-javascript-debug.html
https://www.jetbrains.com/help/phpstorm/run-debug-configuration-javascript-debug.html
```
------------------------------------------------------------
```
vscode

https://code.visualstudio.com/docs/nodejs/vuejs-tutorial
https://github.com/microsoft/vscode-recipes/tree/main/vuejs-cli
https://github.com/microsoft/vscode-recipes
https://github.com/vuejs/vue-loader/issues/1163

vue vs code extension Packs
```
------------------------------------------------------------
```

https://webpack.js.org/configuration/devtool/
```
------------------------------------------------------------
```
https://www.npmjs.com/package/vuejs-logger

logLevels :  ['debug', 'info', 'warn', 'error', 'fatal']

npm install vuejs-logger --save-exact
```
------------------------------------------------------------
```
https://himynameistim.com/blog/debugging-vusjs--typescript-with-vs-code

module.exports = {
configureWebpack: {
  devtool: 'source-map'
}
}


{
// Use IntelliSense to learn about possible attributes.
// Hover to view descriptions of existing attributes.
// For more information, visit: https://go.microsoft.com/fwlink/?linkid=830387
"version": "0.2.0",
"configurations": [
  {
    "type": "pwa-msedge",
    "request": "launch",
    "name": "vuejs: edge",
    "url": "http://localhost:8080",
    "webRoot": "${workspaceFolder}",
    "breakOnLoad": true,
    "sourceMapPathOverrides": {
        "webpack:///./*": "${webRoot}/*"
    },
    "skipFiles": [
        "${workspaceFolder}/node_modules/**/*"
    ]
  },
  {
    "type": "chrome",
    "request": "launch",
    "name": "vuejs: chrome",
    "url": "http://localhost:8080",
    "webRoot": "${workspaceFolder}",
    "breakOnLoad": true,
    "sourceMapPathOverrides": {
        "webpack:///./*": "${webRoot}/*"
    },
    "skipFiles": [
        "${workspaceFolder}/node_modules/**/*"
    ]
  }
]
}
```


------------------------------------------------------------
```
https://blog.logrocket.com/5-vue-devtools-hacks/


npm install -g @vue/devtools
npm install --save-dev @vue/devtools


vue-devtools
```
------------------------------------------------------------
```

https://forum.vuejs.org/t/debugging-vue-files-with-visual-studio-code/8022/6

{
    "version": "0.2.0",
    "configurations": [
        {
            "type": "chrome",
            "name": "Chrome",
            "request": "launch",
            "program": "${workspaceRoot}/build/dev-server.js",
            "cwd": "${workspaceRoot}",
            "outFiles": ["${workspaceRoot}/**/*.vue"],
            "sourceMaps": true
        }
    ]
}


launch.json configuration:

{
    "version": "0.2.0",
    "configurations": [
        {
            "type": "chrome",
            "request": "launch",
            "name": "Launch Chrome against localhost",
            // "port": 9222,
            "sourceMaps": true,
            "url": "http://localhost:8080",
            "webRoot": "${workspaceRoot}"
        }
    ]
}

launch.json
{
“name”: “Attach dsdev”,
“type”: “chrome”,
“request”: “attach”,
“port”: 9222,
“url”:“dsdev/",
“sourceMaps”: true,
“diagnosticLogging”: false,
“webRoot”: “${workspaceFolder}”,
“sourceMapPathOverrides”: {
"webpack:///”: “${webRoot}/*”
}
},

---

# vue.config.js

module.exports = {
  configureWebpack: {
    devtool: 'source-map'
  }
}

launch.json
{
  "version": "0.2.0",
  "configurations": [
    {
      "type": "chrome",
      "request": "launch",
      "name": "vuejs: chrome",
      "url": "http://localhost:8080",
      "webRoot": "${workspaceFolder}",
      "breakOnLoad": true,
      "sourceMapPathOverrides": {
        "webpack:///*": "${webRoot}/*"
      }
    }
  ]
}


# test breakpoint

methods: {
  removeThing (thingIndex) {
    debugger
    this.things.splice(thingIndex, 1)
  }
}

```