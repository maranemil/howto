
### VueJS: Combining Vuex store getters with mixins to keep your components scalable

```
https://www.linkedin.com/pulse/vuejs-combining-vuex-store-getters-mixins-keep-your-scalable-martin
computed: {
  doneTodos () {
    return this.$store.getters.doneTodos
  }
},
getters: {
 // ...
 doneTodos: (state) => {
    return state.todos.filter(todo => todo.done)
 }
}

import { mapGetters } from 'vuex'
export default {
 // ...
 computed: {
   // mix the getters into computed with object spread operator
   ...mapGetters([
     'doneTodos',
     'anotherGetter',
     // ...
   ])
 }
 
 
 import { mapGetters } from 'vuex'
 export default {
  computed: {
    ...mapGetters([
      'doneTodos',
      'anotherGetter'
    ]),
  },
 }
 
 
import { mapGetters } from './mixins'
export default {
  name: 'Example',
  data() {
    return {
      ...
    }
  },
  mixins: [ mapGetters ]
 }
 ```
 -----------------------------------------------


### Correct way to watch vuex state changes?

 https://forum.vuejs.org/t/correct-way-to-watch-vuex-state-changes/102005

```
 User list component:

export default {
  name: 'Users',
  data: function(){
    return {
      searchUser: '',
      usersList: {}
    }
  },
  created(){
    let _this = this
    this.$store.watch(
      function (state) { return state.usersList; },
      function () {
        if(_this.searchUser== ''){
          _this.usersList= _this.$store.getters.getUsersList('')
        }
      }, { deep: true }
    );
  },
  watch: {
    searchUser: function() {
     this.usersList= this.$store.getters.getUsersList(this.searchUser)
    }
  }
}

---

export default {
  name: 'Users',
  data: function(){
    return {
      searchUser: ''
    }
  },
computed: {
    getUsersList: function(){
      return this.$store.getters.getUsersList(this.searchUser)
    }
  }
}
```
-----------------------------------------------

https://codepen.io/CodinCat/pen/PpNvYr
```

<div id="app">
  {{ $store.state.n }}
</div>

<script>
const store = new Vuex.Store({
  state: {
    n: 1
  },
  getters: {
    getN: state => () => state.n
  }
})

new Vue({
  el: '#app',
  store,
  mounted () {
    setInterval(() => { this.$store.state.n++ }, 1000)
    this.$store.watch(this.$store.getters.getN, n => {
      console.log('watched: ', n)
    })
  }
})

</script>
```
------------------------------------------------------------------------------------------
### How to watch store values from vuex?
```
https://stackoverflow.com/questions/43270159/how-to-watch-store-values-from-vuex
https://syntaxfix.com/question/1392/vue-js-2-how-to-watch-store-values-from-vuex

fruit-count-component.vue

<template>
  <!-- We meet our first objective (1) by simply -->
  <!-- binding to the count property. -->
  <p>Fruits: {{ count }}</p>
</template>

<script>
import basket from '../resources/fruit-basket'

export default () {
  computed: {
    count () {
      return basket.state.fruits.length
      // Or return basket.getters.fruitsCount
      // (depends on your design decisions).
    }
  },
  watch: {
    count (newCount, oldCount) {
      // Our fancy notification (2).
      console.log(`We have ${newCount} fruits now, yay!`)
    }
  }
}
</script>


fruit-basket.js

import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const basket = new Vuex.Store({
  state: {
    fruits: []
  },
  getters: {
    fruitsCount (state) {
      return state.fruits.length
    }
  }
  // Obviously you would need some mutations and actions,
  // but to make example cleaner I'll skip this part.
})

export default basket

---

watch: {
  '$store.state.drawer': function() {
    console.log(this.$store.state.drawer)
  }
}


import { mapGetters } from 'vuex'

export default {
  computed: {
    ...mapGetters({
      myState: 'getMyState'
    })
  }
}

const getters = {
  getMyState: state => state.my_state
}

this.$store.watch(
    function (state) {
        return state.my_state;
    },
    function () {
        //do something on data change
    },
    {
        deep: true //add this if u need to watch object properties change etc.
    }
);

```
----------------------------
```
https://dev.to/viniciuskneves/watch-for-vuex-state-changes-2mgj
https://vuex.vuejs.org/api/#watch
https://courses.bekwam.net/public_tutorials/bkcourse_vuejs_vuex_watch_state.html
https://www.educative.io/edpresso/watch-vuex-store-state-change-in-a-vuejs-app

import api from '@/api';

export default {
  name: 'simple',
  data() {
    return {
      status: 'pending',
    };
  },
  created() {
    console.log(`CREATED called, status: ${this.status}`);
    this.handleCreated();
  },
  methods: {
    async handleCreated() {
      try {
        await api.get();

        this.status = 'success';
      } catch (e) {
        console.error(e);

        this.status = 'error';
      }
    },
  },
};

```
---------------------------------------------------

### Vue-js click event from checkbox?
```
https://stackoverflow.com/questions/50506235/vuejs-click-event-from-checkbox
https://vuejs.org/guide/essentials/event-handling.html#accessing-event-argument-in-inline-handlers
https://v1.vuejs.org/guide/events.html
http://jsfiddle.net/bmpfs2w2/


<div id="demo">
  <ul>
    <li v-for="mainCat in mainCategories">
      <input type="checkbox" 
      :value="mainCat.merchantId" 
      id="mainCat.merchantId" 
      v-model="checkedCategories" 
      @click="check($event)"> {{mainCat.merchantId}}
    </li>
  </ul>
  {{ checkedCategories }}
</div>


var demo = new Vue({
  el: '#demo',
  data: {
    checkedCategories: [],
    mainCategories: [{
        merchantId: '1'
      }, {
        merchantId: '2'
      }] //testing with data use: [{done:false,content:'testing'}]
  },
  methods: {
    check: function(e) {
		console.log(this.checkedCategories)
    }
  }
})
```





 
 
 
 

