

######
```
Building electron app on ubuntu fails with 'Permission denied'

sh: 1: electron-builder: Permission denied
npm ERR! code 126

npm ERR! code E404
npm ERR! 404 Not Found - GET https://registry.npmjs.org/install-app-deps - Not found
npm ERR! 404  'install-app-deps@*' is not in the npm registry.
```
######

- https://docs.npmjs.com/common-errors
- https://github.com/electron/electron-quick-start/issues/81
- https://github.com/electron/electron/issues/11755
- https://github.com/npm/cli/issues/2728
- https://stackoverflow.com/questions/47247443/electron-js-install-error-error-eacces-permission-denied
- https://stackoverflow.com/questions/53592389/building-electron-app-on-ubuntu-fails-with-permission-denied
- https://unix.stackexchange.com/questions/530574/eacces-permission-denied-when-using-sudo
- https://www.npmjs.com/package/electron-builder
- https://www.stefanjudis.com/today-i-learned/prevent-npm-install-for-not-supported-node-js-versions/

```
rm package-lock.json
npm i
npm install

How to prevent npm install with an unsupported Node.js version
engine-strict=true

node -v
npm -v
npm install npm@lastest -g

sudo npm install -g electron --unsafe-perm=true --allow-root
sudo npm install -g electron --unsafe-perm=true
# sudo npm install -g electron --allow-root --unsafe-perm=true
sudo npm install -g electron --unsafe-perm=true --allow-root
sudo npm install -g electron-builder install-app-deps --unsafe-perm=true --allow-root
sudo npm install -g install-app-deps --unsafe-perm=true --allow-root

rm -rf node_modules && npm i
chmod +x "$(npm bin)/electron-builder"
chmod +x "$(npm bin)/build"

# rm -rf dist
# sudo chown -R $USER /usr/local/lib/node_modules

# sudo npm i -g -D
sudo npm install npm@latest -g
```

######
```
sh: 1: vue-cli-service: Permission denied · Issue #5210 - GitHub
> vue-cli-service serve
sh: 1: vue-cli-service: Permission denied
npm ERR! 404 Not Found - GET https://registry.npmjs.org/vue-cli-service - Not found
npm ERR! command sh -c electron-builder install-app-deps
```
######

- https://github.com/electron/electron/issues/11755
- https://github.com/vuejs/vue-cli/issues/4004
- https://github.com/vuejs/vue-cli/issues/5210
- https://www.npmjs.com/package/@vue/cli-service
- https://www.npmjs.com/package/@vue/cli-service-global

```
rm -rf node_modules/
npm install

vue-cli-service serve
vue-cli-service: command not found
vue-cli-service: Permission denied

[OK]
sudo npm install -g @vue/cli@latest
sudo npm install -g @vue/cli-service
sudo npm install -g @vue/cli-service-global

 [ OK ]
rm -rf node_modules
npm install

[ OK ]
chmod -R a+x node_modules
```

######
```
npm ERR! code 1
npm ERR! path /home/user/PhpstormProjects/proj/source/node_modules/electron
npm ERR! command failed
npm ERR! command sh -c node install.js
npm ERR! Error: EACCES: permission denied, stat '/root/.cache/electron/8cc9cac8ac37f7e20/electron-v15.3.2-linux-x64.zip'
Error: EACCES: permission denied, stat electron-v15.3.6-linux-x64.zip
```
######
```
node -v
npm -v

[ OK ]
sudo npm install -g electron --unsafe-perm=true
sudo npm update
```

######
### Error: Cannot find module 'vue-cli-plugin-electron-builder'
######

- https://github.com/nklayman/vue-cli-plugin-electron-builder/issues/1056
- https://www.npmjs.com/package/vue-cli-plugin-electron-builder
- https://nklayman.github.io/vue-cli-plugin-electron-builder/guide/guide.html#web-workers

[OK ]
vue add electron-builder


######
### npm run serve
######
```
> vue-cli-service serve

INFO  Starting development server...
10% building 2/2 modules 0 active ERROR  TypeError: Cannot read property 'upgrade' of undefined
TypeError: Cannot read property 'upgrade' of undefined



sudo npm install electron -g
sudo npm install -g nodemon
sudo npm update
npm audit
sudo npm audit fix --force [OK]

sudo vue-cli-service serve
npx vue-cli-service serve
npm run serve


sudo npm i
sudo npm run dev
sudo npm install webpack@4.39.3 --save

sudo npm install @vue/cli-plugin-router
```


######
#
### Error: Cannot find module '@vue/cli-plugin-router'
### Error: Cannot find module '@vue/cli-plugin-router'
#
### npm ERR! notarget No matching version found for @vue/cli-plugin-router@3.12.1.
######

- https://bestofvue.com/repo/nklayman-vue-cli-plugin-electron-builder-vuejs-vue-cli-3-plugins
- https://cli.vuejs.org/config/
- https://docs.npmjs.com/common-errors
- https://docs.npmjs.com/resolving-eacces-permissions-errors-when-installing-packages-globally
- https://gemfury.com/help/npm-registry/
- https://router.vuejs.org/installation.html
- https://spack.readthedocs.io/en/latest/package_list.html
- https://stackoverflow.com/questions/65342453/can-not-install-vue-cli-no-matching-version-found
- https://vueschool.io/articles/vuejs-tutorials/how-to-migrate-from-vue-cli-to-vite/
- https://vuetifyjs.com/en/getting-started/installation/#vue-ui-install
- https://www.codegrepper.com/code-examples/shell/npm+install+vue+router
- https://www.npmjs.com/package/@vue/cli-plugin-router
- https://www.reddit.com/r/vuejs/comments/7g8qnj/vuecli_cannot_find_modules/

```
sudo npm i @vue/cli-plugin-babel
sudo npm install vue-router
sudo npm install --save vue-router@next
vue add router [OK]

npm install --save vue-router
npm install vue-router@4

sudo npm install -g vue-cli --force [OK]
sudo npm install -g @vue/cli --force
sudo npm install vue-router --force

[?]
rm -rf /Users/username/.npm/
Solved it. Then reinstalled vue-cli as stated in OP.


node -v
npm -v
vue --version
which npm

npm update -g @vue/cli [ok]

vue --version # @vue/cli 4.5.15
```

```
# vue create project-name
# vue create my-project --preset vuetifyjs/vue-cli-preset-vuetify
# npm init react-app my-app
# sudo npm install -g @angular/cli
# npm install -g jshint
```
```
sudo npm i -S vue-router@3
sudo npm i -S vue-router@4
npm i gulp-resource@1.0.39


vue add electron-builder
npm run electron:serve
npm run electron:build


sudo npm install npm@latest -g [ok]
sudo npm audit --force
#sudo npm uninstall ...

vue --version
vue ui
npm install @nuxtjs/vuetify -D
vue add electron-builder
sudo npm install --loglevel error vue-cli-plugin-electron-builder -D --legacy-peer-deps

npm install -g @vue/cli


# npm login
# npm config ls -l
```



######
#
### Installation vue
######

- https://cli.vuejs.org/guide/installation.html
- https://cli.vuejs.org/guide/plugins-and-presets.html#plugins
- https://router.vuejs.org/
- https://github.com/electron/electron/issues/11755
- https://github.com/electron/electron/blob/8a4c76d6558cffa53400e54317f0f9b1da22f7ef/docs/tutorial/installation.md#troubleshooting

```
sudo npm install -g @vue/cli
vue --version
sudo npm update -g @vue/cli

vue add eslint
sudo npm audit fix --force

npm i vue-router
sudo vue add router


sudo npm install electron -g
sudo npm install -g electron --unsafe-perm=true
sudo npm install -g electron --unsafe-perm=true --allow-root
sudo npm install -g electron --unsafe-perm=true --allow-root


sudo npm install electron --unsafe-perm=true
npm install --verbose electron


sudo npm install --loglevel error @vue/cli-plugin-router@~4.5.0 -D --legacy-peer-deps
```






### play-code playground vue-js

- https://bootstrap-vue.org/play
- https://codepen.io/dinsmore/pen/pyGJMd
- https://codepen.io/jgunnison/pen/pgXomz
- https://embed.plnkr.co/
- https://embed.plnkr.co/
- https://jsfiddle.net/boilerplate/vue
- https://jsfiddle.net/chrisvfritz/50wL7mdz/
- https://jsfiddle.net/gregpeden/hmcLdc5a/
- https://playcode.io/vue/
- https://sfc.vuejs.org/





------------------------
- https://app.netlify.com/sites/vue-sfc-playground/deploys
- https://github.com/vuesomedev/vue-3-playground
- https://gitlab.com/gitlab-de/playground/5-min-prod-app-vuejs
- https://madewithvuejs.com/code-playground
- https://nativescript-vue.org/en/docs/getting-started/playground-tutorial/
- https://vue-view.com/nativescript-vue-js-tutorial-make-a-native-vue-js-app/
- https://vuejsexamples.com/interactive-sandox-playground-for-vue-components/
- https://vuejsfeed.com/blog/playcode-fast-javascript-playground-created-using-vue-js-vuex-vue-router




### slots
```
vue.runtime.esm.js?2b0e:619 [Vue warn]: 
Error in render: "TypeError: Cannot read property 'find' of undefined"
```

- https://vuejs.org/guide/components/slots.html
- https://v2.vuejs.org/v2/guide/components-slots.html#Scoped-Slots
- https://vuejs.org/guide/essentials/component-basics.html
- https://www.smashingmagazine.com/2019/07/using-slots-vue-js/
- https://medium.com/binarcode/understanding-scoped-slots-in-vue-js-db5315a42391
- https://www.bezkoder.com/vue-v-slot/
- https://dev.to/suniljoshi19/understanding-slot-in-vue-js-1j7p
- https://stackoverflow.com/questions/57806610/how-to-use-slot-scope-correctly-within-vuejs-2-5-x
- https://stackoverflow.com/questions/67926696/vue-runtime-esm-js2b0e619-vue-warn-error-in-render-typeerror-cannot-read
- https://stackoverflow.com/questions/46106037/vuex-computed-property-name-was-assigned-to-but-it-has-no-setter

-----------------------------------

### Fix – Vuex computed property was assigned to, but it has no setter

- https://codesource.io/fix-vuex-computed-property-was-assigned-to-but-it-has-no-setter/###
- https://developpaper.com/question/computed-property-route-was-assigned-to-but-it-has-no-setter/
- https://laracasts.com/discuss/channels/vue/computed-property-profit-was-assigned-to-but-it-has-no-setter
- https://github.com/vuejs/vue/issues/6078
- https://segmentfault.com/q/1010000022067653/a-1020000022073936
--------------------------------------------

### i18n gender npm install i18n-js

- https://github.com/atapas/i18n-js-npm
- https://github.com/meedan/i18n-translate-json
- https://github.com/ruby-i18n/i18n/blob/master/lib/i18n.rb
- https://github.com/aimeos/ai-client-html/issues/105
- https://stackoverflow.com/questions/25826578/i18n-internationalization-for-regex-honorific-checking
- https://localizely.com/blog/angular-i18n-tutorial/
- https://www.npmjs.com/package/jus-i18n
- https://www.npmjs.com/package/i18n
- https://github.com/ruby-i18n/i18n
- https://dev.to/adrai/how-does-server-side-internationalization-i18n-look-like-5f4c
- https://medium.com/geekculture/how-does-server-side-internationalization-i18n-look-like-6ddbd15147b7
- https://npm.io/search/keyword:i18n/33
- https://www.npmjs.com/package/i18n-js
- https://locize.com/blog/how-does-server-side-internationalization-look-like/
- https://localazy.com/blog/javascript-app-localization-i18next-localazy
- https://dev.to/adrai/internationalization-i18n-for-deno-with-i18next-3e0l
```
salutations (mr mrs company)
```



