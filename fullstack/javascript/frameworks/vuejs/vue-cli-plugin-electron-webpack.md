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




