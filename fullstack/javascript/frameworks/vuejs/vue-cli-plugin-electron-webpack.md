## Vue CLI Plugin Electron Builder


- https://www.npmjs.com/package/vue-cli-plugin-electron-webpack
- https://www.npmjs.com/package/vue-cli-plugin-electron-builder
- https://github.com/nklayman/vue-cli-plugin-electron-builder
- https://vuejs.org/examples/#hello-world
- https://vuejs.org/tutorial/#step-1
- https://vuejs.org/guide/essentials/application.html
- https://vuejs.org/guide/quick-start.html
- https://cli.vuejs.org/guide/webpack.html#replacing-loaders-of-a-rule
- https://webpack.js.org/


---------------------------------------------------------
```
How to set up an electron app with Vue and webpack
https://stricker.digital/posts/electron-with-vue-and-webpack/

npm install -g @vue/cli
vue create <project-name> && cd <project-name>
vue add electron-builder
npm electron:serve
```
---------------------------------------------------------
```
Vue CLI Plugin Electron Builder
https://nklayman.github.io/vue-cli-plugin-electron-builder/guide/guide.html
https://nklayman.github.io/vue-cli-plugin-electron-builder/guide/#installation

vue add electron-builder
npm run electron:serve
npm run electron:build
```
---------------------------------------------------------
```
Building an app with Electron and Vue

https://blog.logrocket.com/building-app-electron-vue/


npm install -g @vue/cli
vue create vue-desktop
vue add electron-builder
npm run electron:serve
npm run electron:build
npm electron:build -- --linux nsis
```
---------------------------------------------------------
```
Building a Desktop App with Electron and Vue.js

https://buddy.works/tutorials/building-a-desktop-app-with-electron-and-vue-js

npm install -g @vue/cli
vue create electron-vue
cd electron-vue
npm run serve
npm install --save-dev electron@latest
npm start
```

---------------------------------------------------------
https://vuejs.org/guide/quick-start.html
```
npm init vue@latest
cd <your-project-name>
npm install
npm run dev
npm run build


✔ Project name: … <your-project-name>
✔ Add TypeScript? … No / Yes
✔ Add JSX Support? … No / Yes
✔ Add Vue Router for Single Page Application development? … No / Yes
✔ Add Pinia for state management? … No / Yes
✔ Add Vitest for Unit testing? … No / Yes
✔ Add Cypress for both Unit and End-to-End testing? … No / Yes
✔ Add ESLint for code quality? … No / Yes
✔ Add Prettier for code formating? … No / Yes

Scaffolding project in ./<your-project-name>...
Done.


Without Build Tools


<script src="https://unpkg.com/vue@3"></script>

<div id="app">{{ message }}</div>

<script>
  Vue.createApp({
    data() {
      return {
        message: 'Hello Vue!'
      }
    }
  }).mount('#app')
</script>


<script type="importmap">
  {
    "imports": {
      "vue": "https://unpkg.com/vue@3/dist/vue.esm-browser.js"
    }
  }
</script>

<div id="app">{{ message }}</div>

<script type="module">
  import { createApp } from 'vue'

  createApp({
    data() {
      return {
        message: 'Hello Vue!'
      }
    }
  }).mount('#app')
</script>


Serving over HTTP

<!-- index.html -->
<script type="module">
  import { createApp } from 'vue'
  import MyComponent from './my-component.js'

  createApp(MyComponent).mount('#app')
</script>


// my-component.js
export default {
  data() {
    return { count: 0 }
  },
  template: `<div>count is {{ count }}</div>`
}
```

```
Working with Webpack
https://cli.vuejs.org/guide/webpack.html#inspecting-the-project-s-webpack-config

vue inspect > output.js
vue inspect --mode production > output.prod.js
vue inspect module.rules.0
vue inspect --rule vue
vue inspect --plugin html
vue inspect --rules
vue inspect --plugins
```

## electron 


https://webpack.js.org/concepts/
https://webpack.js.org/
https://github.com/nklayman/vue-cli-plugin-electron-builder


----------------------------------------------
```
Vue CLI Plugin Electron Builder
https://nklayman.github.io/vue-cli-plugin-electron-builder/

vue add electron-builder
yarn electron:serve
npm run electron:serve
yarn electron:build
npm run electron:build
```
----------------------------------------------

```
Movies recommendation desktop application with Electron and Vue.js
https://blog.logrocket.com/building-app-electron-vue/
https://github.com/AsaoluElijah/vue-electron

npm install -g @vue/cli
vue create vue-desktop
vue add electron-builder
npm run electron:serve
npm run electron:build
npm electron:build -- --linux nsis
npm run electron:build -- --linux deb --win nsis
```
-------------------------------

```
https://bestofvue.com/repo/nklayman-vue-cli-plugin-electron-builder-vuejs-vue-cli-3-plugins
https://nklayman.github.io/vue-cli-plugin-electron-builder/guide/guide.html

vue add electron-builder
npm run electron:serve
npm run electron:build
```
------------------------------------
```
Create an Electron application with Vue and Vuetify

https://itnext.io/electron-application-with-vue-js-and-vuetify-f2a1f9c749b8

npm install -g @vue/cli
npm install -g @vue/cli
vue create vue-electron-app
cd vue-electron-app
npm run serve
vue add vuetify
npm run serve
vue add electron-builder
npm run electron:serve

Summary

npm install -g @vue/cli
vue create vue-electron-app
vue add vuetify
vue add electron-builder(optional)
npm install -D @types/node@">=12.0.0 <13.0.0"
```
---------------------------------------------------------------------------------------

https://simulatedgreg.gitbooks.io/electron-vue/content/en/using-electron-builder.html

---------------------------------------------------------------------------------------
```
https://medium.com/@devesu/how-to-build-a-react-based-electron-app-d0f27413f17f
https://mmazzarolo.com/blog/2021-08-12-building-an-electron-application-using-create-react-app/
https://www.electronjs.org/docs/latest/development/build-instructions-linux
# Using npx (https://www.npmjs.com/package/npx) to run create-react-app.
npx create-react-app my-electron-app
cd my-electron-app
yarn add -D concurrently cross-env electron electron-builder electronmon wait-on


npx create-react-app <your_app_name> --typescript
yarn add cross-env electron-is-dev                    
          or
npm install --save cross-env electron-is-dev

yarn add --dev concurrently electron electron-builder wait-on                             
or
npm install concurrently electron electron-builder wait-on

yarn start
or
npm run start


yarn build
or
npm run build
```
---------------------------------------------------------------------------------------
```
https://dev.to/wchr/how-to-build-electron-apps-with-react-36b

mkdir electron_react_app && cd $_
npx create-react-app .
yarn add electron electron-builder wait-on concurrently -D
yarn add electron-is-dev
yarn electron-dev
yarn add @rescripts/cli  @rescripts/rescript-env -D
yarn add electron-builder typescript -D
yarn electron-pack

sudo chown root node_modules/electron/dist/chrome-sandbox
sudo chmod 4755 node_modules/electron/dist/chrome-sandbox
chmod a+x '<You app>.AppImage'
./<You app>.AppImage
 sudo chown root '<Your appname>.AppImage' 
sudo chmod 4755 '<Your appname>.AppImage'   
```
---------------------------------------------------------------------------------------
```
https://rockiger.com/de/cross-plattform-apps-mit-electron-und-react-teil-1/

npm install -g electron-forge
electron-forge init electron-react-example --template=react
cd electron-react-example
npm install
electron-forge start
```
---------------------------------------------------------------------------------------
```
https://www.section.io/engineering-education/desktop-application-with-react/

cd ~/ your-prefered-location

npx create-react-app electron-react-demo
cd electron-react-demo

npm i -D electron electron-is-dev
npm i -D concurrently wait-on
npm i react-open-weather
```
---------------------------------------------------------------------------------------






