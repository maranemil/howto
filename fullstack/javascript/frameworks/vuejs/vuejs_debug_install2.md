- 
- 
- https://askubuntu.com/questions/786015/how-to-remove-nodejs-from-ubuntu-16-04
- https://docs.npmjs.com/cli/v8/commands/npm-update
- https://github.com/facebook/create-react-app/issues/11174
- https://stackoverflow.com/questions/11177954/how-do-i-completely-uninstall-node-js-and-reinstall-from-beginning-mac-os-x?rq=1
- https://stackoverflow.com/questions/32426601/how-can-i-completely-uninstall-nodejs-npm-and-node-in-ubuntu

```
node v12.22.5
npm 8.5.0.

sudo apt-get remove nodejs npm -y
sudo apt autoremove -y
which node
sudo apt-get install nodejs npm -y

sudo apt remove nodejs
sudo apt purge nodejs
sudo apt autoremove

sudo apt-get uninstall nodejs npm node
sudo apt-get remove nodejs npm


sudo apt-get purge nodejs
sudo apt-get purge --auto-remove nodej

npm install
npm install --no-audit
npm audit fix --force
npm fund
sudo npm update
sudo npm update --force
```

-----------------------------------

https://computingforgeeks.com/installing-node-js-lts-on-ubuntu-debian-linux/

```
Node.js 10:
sudo apt update
sudo apt -y install curl dirmngr apt-transport-https lsb-release ca-certificates
curl -sL https://deb.nodesource.com/setup_10.x | sudo bash
```


```
Node.js 12:
sudo apt update
sudo apt -y install curl dirmngr apt-transport-https lsb-release ca-certificates
curl -sL https://deb.nodesource.com/setup_12.x | sudo -E bash -
```

---
```
sudo apt update
sudo apt -y install gcc g++ make
sudo apt -y install nodejs
```
---

https://www.journaldev.com/27373/install-uninstall-nodejs-ubuntu
https://coderrocketfuel.com/article/how-to-uninstall-node-js-on-ubuntu-18-04
```
sudo apt-get install software-properties-common
curl -sL https://deb.nodesource.com/setup_11.x | sudo -E bash -
sudo apt-get install nodejs
```

```
nvm uninstall 10.16.3
nvm current
nvm deactivate
nvm uninstall 10.16.3
```
----------------------------------------
```
npm" "install" "--no-optional

npm ERR! Linux 4.4.0-1098-aws
npm ERR! argv "/usr/bin/nodejs" "/usr/bin/npm" "install" "--no-optional"
npm ERR! node v4.2.6
npm ERR! npm  v3.5.2
npm ERR! code EMISSINGARG

npm ERR! typeerror Error: Missing required argument #1
```
https://github.com/npm/cli/issues/681
```
sudo npm install -g npm@latest
nvm install-latest-npm

sudo npm install -g n
sudo n latest
sudo npm install -g npm
hash -d npm
npm i

npm install -g npm@5.1.0
npm install -g npm@5.3
npm audit fix --force
```


### Using Ubuntu
```
curl -sL https://deb.nodesource.com/setup_10.x | sudo -E bash -
curl -sLf -o /dev/null 'https://deb.nodesource.com/node_10.x/dists/impish/Release'

sudo npm install -g npm
sudo apt purge npm
sudo apt install npm
sudo npm install -g n
sudo n stable
sudo npm install npm -g

sudo apt-get install -y nodejs
node -v
sudo npm install --global vue-cli  
sudo npm audit fix --force
vue --version
```
----------------------------------
```
INFO  Starting development server...
0% compiling ERROR  TypeError: Cannot read properties of undefined (reading 'get')
TypeError: Cannot read properties of undefined (reading 'get')

sudo npm remove webpack webpack-cli
sudo npm install --save-dev webpack webpack-cli
npm list webpack
webpack --config build/webpack.config.js

npm i --save-dev sass-loader terser-webpack-plugin css-loader webpack-dev-middleware style-loader dotenv-webpack ts-loader sass-loader

npm i --save-dev webpack@5.36
#npm i -D @babel/core@7.16.12
sudo npm update
#npm run dev

sudo rm -rf node_modules package-lock.json
sudo rm -rf /usr/local/lib/node_modules
sudo npm i
npm install --scripts-prepend-node-path=auto
```
-------------------------------------

```
npm cache clean --force
npm cache clean -f
rm -rf node_modules
sudo npm i
sudo npm install -f
npm -i electron
npm -i electron-builder
npm install --scripts-prepend-node-path=auto


node_modules/trim-newlines
meow  3.4.0 - 5.0.0
Depends on vulnerable versions of trim-newlines
node_modules/meow
```





```
> electron-builder install-app-deps

  • electron-builder  version=21.2.0
  • loaded configuration  file=/home/blabla/path/electron-builder.json

┌───────────────────────────────────────────────────┐
│       electron-builder update check failed        │
│        Try running with sudo or get access        │
│       to the local update config store via        │
│ sudo chown -R $USER:$(id -gn $USER) /root/.config │
└───────────────────────────────────────────────────┘
```

######
```
Error: Cannot find module 'semver'
https://codemarvels.com/2021/03/20/npm-install-gives-error-cannot-find-module-semver/
```
######

```
sudo rm -rf /usr/local/lib/node_modules
sudo rm -rf ~/.npm
sudo apt remove nodejs -y
sudo apt remove nodejs npm -y
sudo apt autoremove -y
sudo apt install nodejs npm -y


npm run dev
npm start


Fix:n OK
Run these commands

Shell
sudo rm -rf /usr/local/bin/npm /usr/local/share/man/man1/node* ~/.npm
sudo rm -rf /usr/local/bin/node*
sudo rm -rf /usr/local/include/node*

sudo apt-get purge nodejs npm -y
sudo apt autoremove -y
sudo apt-get install nodejs npm -y
```


######
### install-app-deps not found #1610
######
https://github.com/electron-userland/electron-builder/issues/1610
https://askubuntu.com/questions/1152570/npm-cant-find-module-semver-error-in-ubuntu-19-04

```
npm ERR! 404 Not Found - GET https://registry.npmjs.org/install-app-deps - Not found

sudo npm i electron-builder install-app-deps


sudo npm -g install npm
sudo npm cache clean -f
sudo npm install -g n
sudo npm i --dev

sudo npm i --dev

Usage of the `--dev` option is deprecated. Use `--include=dev` instead.

sudo npm install --save electron
sudo npm install --save electron-builder
sudo npm install --save-dev electron-builder
sudo npm audit fix --force


vue-cli-service serve
vue-cli-plugin-electron-builder
sudo npm install npm -g

sudo npm install -g @vue/cli --force
sudo vue-cli-plugin-electron-builder
```

-------------------
```
npm uninstall -g angular-cli
npm uninstall --save-dev angular-cli
```
-------------------

- https://docs.npmjs.com/cli/v8/commands/npm-install
- https://docs.npmjs.com/downloading-and-installing-node-js-and-npm
- https://gemfury.com/help/npm-registry/
- https://security.snyk.io/vuln/npm:diff:20180305
- https://www.npmjs.com/package/@vue/cli-plugin-router
- https://www.npmjs.com/package/@vue/cli-plugin-router/v/4.5.14
- https://www.npmjs.com/package/ts-node
- https://www.tabnine.com/code/javascript/modules/fs%2Fpromises
-------------------

- https://github.com/npm/npm/issues/16807
- https://github.com/npm/npm/issues/15611

```
docker run -it --rm node:4-alpine sh -c 'npm update -g npm && npm --version'

FROM node:6.10.3
RUN npm i -g npm3 && npm3 -g uninstall npm
RUN npm3 i -g npm@5.0.3
RUN npm -v
```

----------------------------------------------------------
- https://www.digitalocean.com/community/tutorials/how-to-install-node-js-on-ubuntu-20-04
- https://www.digitalocean.com/community/tutorials/how-to-install-node-js-on-ubuntu-18-04
- https://webpack.electron.build/dependency-management
- https://nodejs.org/dist/latest-v10.x/docs/api/fs.html
----------------------------------------------------------
https://embed.plnkr.co/4Q54rVebm8gyJnKUIB1Q/

```
webpack --version
webpack -v
npm list webpack

npm -v            
nodejs -v         
vue -V            
npm list webpack  
npm list electron 
npm list electron-builder 
```
----------------------------------------------------------

- https://stackoverflow.com/questions/41409893/csrf-token-in-vue-component
- https://symfony.com/doc/current/frontend/encore/vuejs.html
- https://symfony.com/doc/current/security/csrf.html

```
composer require symfony/security-csrf
composer require owasp/csrf-protector-php

"require": {
        "owasp/csrf-protector-php": "1.0.2"
} 

<your-component :csrf-token="{{ csrf_token() }}"></your-component>
<Example-component csrf="{{csrf_token()}}"></Example-component>
```

######
#
### npm install vuejs-validators
###

- https://bootstrap-vue.org/docs/reference/validation
- https://dev.to/aaronksaunders/using-vue3-and-vuelidate-for-forms-and-form-validation-4aa1
- https://v2.vuejs.org/v2/cookbook/form-validation.html?redirect=true
- https://vee-validate.logaretm.com/v2/guide/rules.html
- https://vee-validate.logaretm.com/v2/guide/rules.html#numeric
- https://vuejsdevelopers.com/2018/08/27/vue-js-form-handling-vuelidate/
- https://vuejsexamples.com/a-form-validation-component-for-vue-3/
- https://vuelidate-next.netlify.app/custom_validators.html
- https://vuelidate.js.org/
- https://vueschool.io/lessons/vuejs-form-validation-diy
- https://vuetifyjs.com/en/components/forms/#vuelidate
- https://www.npmjs.com/package/vue-echo-laravel
- https://www.npmjs.com/package/vuejs-validators
- https://www.positronx.io/vue-js-forms-tutorial-form-validation-in-vue-with-vuelidate/
----

https://jsfiddle.net/gregpeden/hmcLdc5a/

----
- https://github.com/vuelidate/vuelidate
- https://www.digitalocean.com/community/tutorials/vuejs-model-form-validation-vuelidate
- https://dzone.com/articles/validation-forms-in-vuejs-apps-using-vuelidate-lib



```
import {email, required, numeric} from "vuelidate/lib/validators";
<input v-validate="'numeric'" data-vv-as="field" name="numeric_field" type="text">
```
-------------------------------------

- https://blog.logrocket.com/form-validation-in-vue-with-vuelidate/
- https://dzone.com/articles/validation-forms-in-vuejs-apps-using-vuelidate-lib
- https://github.com/happyDemon/vue-echo
- https://github.com/vuelidate/vuelidate/issues/136
- https://learnvue.co/2020/01/getting-smart-with-vue-form-validation-vuelidate-tutorial/
- https://medium.com/mh-mohon/create-real-time-component-using-laravel-echo-pusher-vue-js-b6ac35a0f13b
- https://prismic.io/docs/technologies/vue-template-content
- https://router.vuejs.org/guide/advanced/data-fetching.html#fetching-after-navigation
- https://stackoverflow.com/questions/40714319/how-to-call-a-vue-js-function-on-page-load
- https://stackoverflow.com/questions/52917019/vue-js-vuelidate-custom-validation
- https://stackoverflow.com/questions/67567141/how-to-validate-an-input-field-in-vue3-using-regex
- https://v2.vuejs.org/v2/cookbook/form-validation.html?redirect=true
- https://vuejs.org/guide/components/slots.html#scoped-slots
- https://vuejs.org/guide/extras/reactivity-in-depth.html#how-reactivity-works-in-vue
- https://vuejs.org/guide/introduction.html
- https://vuejs.org/guide/introduction.html#what-is-vue
- https://vuejs.org/guide/quick-start.html
- https://vuelidate-next.netlify.app/
- https://vuelidate-next.netlify.app/validators.html#numeric
- https://vuelidate.js.org/
- https://vueschool.io/lessons/vuejs-form-validation-diy
- https://www.cloudhadoop.com/vuejs-current-date-time/
- https://www.digitalocean.com/community/tutorials/vuejs-model-form-validation-vuelidate
- https://www.positronx.io/vue-js-forms-tutorial-form-validation-in-vue-with-vuelidate/
- https://www.tutorialsplane.com/vue-js-get-current-timestamp/
- https://www.youtube.com/watch?v=2BR6Vvjw3wQ

---

- https://bootstrap-vue.org/docs/components/alert
- https://devtools.vuejs.org/plugin/plugins-guide.html
- https://github.com/vuejs/devtools
- https://router.vuejs.org/guide/advanced/navigation-failures.html#detecting-navigation-failures
- https://v2.vuejs.org/v2/guide/events.html?redirect=true
- https://v2.vuejs.org/v2/guide/events.html?redirect=true#Key-Modifiers
- https://v2.vuejs.org/v2/guide/forms.html
- https://vuejs.org/guide/essentials/forms.html
- https://vuejs.org/guide/essentials/forms.html#checkbox
- https://vuejsexamples.com/simple-alert-for-vue-js/
- https://vuejsexamples.com/tag/alert/



######
### serve
######

https://cli.vuejs.org/guide/cli-service.html

```
vue-cli-service inspect
vue-cli-service serve
npm run serve
npx vue-cli-service serve
```


######
### timestamp
######

- https://stackoverflow.com/questions/57249466/getting-current-time-and-date-in-vue-js
- https://www.positronx.io/vue-js-get-current-date-time-and-timestamp-tutorial/
- https://www.tutorialsplane.com/vue-js-get-current-timestamp/

```
<h1 @load="getTimestamp">timestamp {{ timestamp }} </h1>

export default {
  name: "name",
  components: {..},
  props: {},
  data() {},
  validations: {},
  watch: {},
  computed: {},
  created() {},
  mounted() {},
  methods: {
    getTimestamp() {
      this.timestamp = Math.round(+new Date()/1000);
    }
  },
  beforeMount(){
    this.getTimestamp()
  }
}
```

```
npm install vue-echo-laravel

npm install -g @vue/cli
vue create vue-blog
cd vue-blog

new Date().toLocaleDateString();
new Date().toLocaleTimeString();
new Date().getFullYear();

export default {
    name: "DateComponent",
    data: () => ({
      date: '',
      time: '',
      year: '',
      timestamp: '',
      fulldatetime: ''
    }),
    methods: {
      printDate: function () {
        return new Date().toLocaleDateString();
      },
      printTime: function () {
        return new Date().toLocaleTimeString();
      },
      printYear: function () {
        return new Date().getFullYear();
      },          
      printTimestamp: function () {
        return Date.now();
      },
      printFullDate: function(){
        return new Date();
      }
    },
    mounted: function () {
      this.date = this.printDate();
      this.time = this.printTime();
      this.timestamp = this.printTimestamp();
      this.year = this.printYear();
      this.fulldatetime = this.printFullDate();
    }
};
```


