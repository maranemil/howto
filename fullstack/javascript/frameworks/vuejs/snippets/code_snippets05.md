### Vue JS - Open link in new tab Example

```

https://www.tutorialstuff.com/tutorials/vue-js-open-link-in-new-tab-exampleexample
https://forsmile.jp/en/vue-en/1356/
https://www.pakainfo.com/how-to-open-url-in-new-tab-using-vue-js/
https://www.itsolutionstuff.com/post/vue-js-open-link-in-new-tab-exampleexample.html
https://reactgo.com/vue-open-link-new-tab/
https://stackoverflow.com/questions/40015037/can-vue-router-open-a-link-in-a-new-tab

<!DOCTYPE html>
<html>
<head>
    <title>Vue JS - Open link in new tab Example - ItSolutionStuff.com</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.0.5/vue.min.js"></script>
</head>
<body>
 
<div id="app">
  <button @click="myFunction()">Click Me</button>
</div>
 
<script type="text/javascript">
  new Vue({
    el: '#app',
    data: {
      myModel:false
    },  
    methods:{
      myFunction: function () {  
          window.open("https://itsolutionstuff.com", "_blank");    
      }
    }
  });
</script>
 
</body>
</html>
```


--------
```

Basic usage (Vue.js only OK, no Router)
// html
<button type="button" @click="linkToOtherWindow('LINK URL')">Link to new Tab</button>
// script
export default {
  methods: {
    linkToOtherWindow (url) {
      window.open(url, '_blank')
    }
  }
}

How to open in a new window using Vue Router

// For profile page routing settings
const Profile= {
    template: '<div>Profile No.{{ $route.params.id }}</div>'
}
const router = new VueRouter({
  routes: [
    { path: '/profile/:id',name='profilePage', component: Profile}
  ]
})
// script Pass the resolved url to window.open
export default {
  methods: {
    linkToOtherWindow() {
      let resolvedRoute = this.$router.resolve({
        name: profilePage,
        params: {id: "someData"}
      });
      window.open(resolvedRoute.href, '_blank');
    }
  }
}


Maybe it can be used from Vue 3

<router-link :to="{ name: 'profilePage'}" target="_blank">
   LINK TO OTHER WINDOW
</router-link>




<router-link to="/contact" target="_blank">Contact</router-link>

App.vue
<template>
  <div id="app">
    <button @click="gotoContact()">Contact</button>
  </div>
</template>

<script>
export default {
  name: "app",
  methods: {
    gotoContact() {
      let route = this.$router.resolve({ path: "/contact" });
      window.open(route.href);
    },
  },
};
</script>



Opening the external links in a new tab
<a href="https://www.google.com" target="_blank" rel="noreferrer noopener">
   Google
</a>



App.vue
<template>
  <div id="app">
    <button @click="gotoGoogle()">Google</button>
  </div>
</template>

<script>
export default {
  name: "app",
  methods: {
    gotoGoogle() {
      window.open("https://www.google.com");
    },
  },
};
</script>
```


-----------------------
### Making HTTP requests
```

https://test-utils.vuejs.org/guide/advanced/http-requests.html

import axios from 'axios'

export default {
  data() {
    return {
      posts: null
    }
  },
  methods: {
    async getPosts() {
      this.posts = await axios.get('/api/posts')
    }
  }
}


----------
```

### how to trigger a method when page load on vuejs

```

https://www.codegrepper.com/code-examples/javascript/how+to+trigger+a+method+when+page+load+on+vuejs
https://vuejs.org/api/options-lifecycle.html
https://vuejs.org/guide/essentials/application.html
https://vue-loader.vuejs.org/guide/hot-reload.html
https://stackoverflow.com/questions/35064845/how-to-trigger-a-method-at-page-load-in-vuejs
https://vuejs.org/api/options-lifecycle.html
https://vuejs.org/guide/essentials/lifecycle.html
https://www.freecodecamp.org/news/common-mistakes-to-avoid-while-working-with-vue-js-10e0b130925b/


vm=new Vue({
  el:"#app",
  beforeMount () {
    // prepare data for later , eventually with setTimeout
  },
  mounted:function(){
        this.method1() //method1 will execute at pageload
  },
  methods:{
        method1:function(){
              /* your logic */
        }
     },
})

```


### [ tab select activeTab ]
```

https://vuetifyjs.com/en/components/tabs/
https://lusaxweb.github.io/vuesax/components/tabs.html
https://vuejsexamples.com/tabbed-content-with-vue-js/
https://reactgo.com/vue-tabs-tutorial/
https://stackoverflow.com/questions/46464170/vuejs-show-tab-content-on-click
https://bootstrap-vue.org/docs/components/tabs
https://bestofvue.com/repo/spatie-vue-tabs-component-vuejs-tabs
https://laracasts.com/discuss/channels/vue/vue-tabs-open-the-correct-tab-on-page-load
https://www.syncfusion.com/forums/160709/get-current-selected-tab
https://learnvue.co/2019/12/building-reusable-components-in-vuejs-tabs/#setting-up-a-reusable-tab-component
```



### [ click ]
```

https://renatello.com/vue-js-manually-trigger-events/
https://thewebdev.info/2021/05/22/how-to-trigger-events-on-an-element-using-vue-js/
https://www.demo2s.com/javascript/javascript-vue-js-trigger-click-on-ref-in-vue-js.html
https://github.com/vuejs/test-utils/issues/456
https://stackoverflow.com/questions/31917889/is-it-possible-to-trigger-events-using-vue-js

<button type="button" @click="myClickEvent" v-el:my-btn>Click Me!</button>


function anotherRandomFunction() {
    var elem = this.$els.myBtn
    elem.click()
}


```


### images vue
```

https://www.codegrepper.com/code-examples/html/vuejs+image+source
https://dev.to/zahidjabbar/image-binding-error-handling-in-vue-js-1pdp
https://blog.lichter.io/posts/dynamic-images-vue-nuxt/
```

----
### slots vue
```

https://github.com/linkurzweg/vue3-webstorm-example
https://vuejs.org/guide/components/slots.html
https://eslint.vuejs.org/rules/valid-v-slot.html
https://www.codegrepper.com/code-examples/typescript/slots+in+vue
https://michaelnthiessen.com/supercharge-your-slots/
https://vuejs.org/guide/components/slots.html
https://www.trysmudford.com/blog/dynamic-scoped-slots-in-vue-js/
https://vuetifyjs.com/en/components/menus/#slots
https://vuetifyjs.com/en/components/data-tables/#slots
https://www.codetd.com/en/article/12096443
https://vuejs.org/guide/components/slots.html#named-slots
https://www.bezkoder.com/vue-v-slot/
https://ramblings.mcpher.com/snipgraphql/vuejs/vuejs-and-vuetify-what-does-v-on-mean/
https://youtrack.jetbrains.com/issue/WEB-52117
```


### Vue Select — Loading Options and Loops
https://hohanga.medium.com/vue-select-loading-options-and-loops-61bbfc394450

```

<template>
  <v-select @search="fetchOptions" :options="options" :filterable="false"/>
</template>
<script>
export default {
  data() {
    return {
      allOptions: ["apple", "orange", "grape"],
      options: []
    };
  },
  methods: {
    fetchOptions(search, loading) {
      setTimeout(() => {
        this.options = this.allOptions.filter(a =>
          a.toLowerCase().includes(search.toLowerCase())
        );
      }, 1000);
    }
  }
};
</script>


<template>
  <v-select @search="fetchOptions" :options="options" :filterable="false">
    <template v-slot:spinner="{ loading }">
      <div v-show="loading">Loading...</div>
    </template>
  </v-select>
</template>
<script>
export default {
  data() {
    return {
      allOptions: ["apple", "orange", "grape"],
      options: []
    };
  },
  methods: {
    fetchOptions(search, loading) {
      loading(true);
      setTimeout(() => {
        this.options = this.allOptions.filter(a =>
          a.toLowerCase().includes(search.toLowerCase())
        );
        loading(false);
      }, 2000);
    }
  }
};
</script>


<template>
  <table>
    <tr>
      <th>Name</th>
      <th>Country</th>
    </tr>
    <tr v-for="p in people" :key="p.name">
      <td>{{ p.name }}</td>
      <td>
        <v-select
          :options="options"
          :value="p.country"
          @input="country => updateCountry(p, country)"
        />
      </td>
    </tr>
  </table>
</template>
<script>
export default {
  data: () => ({
    people: [{ name: "John", country: "" }, { name: "Jane", country: "" }],
    options: ["Canada", "United States"]
  }),
  methods: {
    updateCountry(person, country) {
      person.country = country;
    }
  }
};
</script>
```


