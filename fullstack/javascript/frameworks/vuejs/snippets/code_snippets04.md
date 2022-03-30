```
https://stackoverflow.com/questions/41122028/set-default-value-to-option-select-menu
https://forum.vuejs.org/t/set-default-value-on-input-select/96682/6
https://laracasts.com/discuss/channels/vue/vue-default-selection-for-select
https://renatello.com/default-select-value-vue-js/
```


```
https://jsfiddle.net/Lxfxyqmf/

<div id="app">
  <select v-model="selected">
     <option value="foo">foo</option>
     <option value="bar">Bar</option>
     <option value="baz">Baz</option>
  </select>
</div>


<script>
new Vue({
  el: "#app",
  data: {
    selected: 'bar'
  }
});

</script>
```
---


```
<div id="myComponent">
    <select v-model="selectedValue">
        <option v-for="listValue in valuesList" :value="listValue">
            {{listValue}}
        </option>
    </select>
    <span>Chosen item: {{ selectedValue }}</span>
</div>
<script>
var app = new Vue({
    el: '#myComponent',
    data: {
        selectedValue: 'Two',
        valuesList: ['One', 'Two', 'Three']
    },
    // ...
    });
<script>    
```
---
```
Using the new composition API:

<template>
     <select v-model="selectValue">
         <option value="a">
             Option a
         </option>
         <option value="b">
             Option b
         </option>
      </select>
</template>

<script>
import { ref } from 'vue';

export default {
    setup() {
        // Create a reactive value for our select
        const selectValue = ref('a');

        // Return to the template
        return { selectValue };
    },
};
</script>
```
---

```
<template>
  <form @submit.prevent="submit">
    <form-group id="company" label-for="company" label="Company">
      <v-select :options="companies" v-model="formdata.company"></v-select>
    </form-group>
  </form>
</template>

<script>
  import vSelect from 'vue-select';

  export default {
    components: {vSelect},
    data() {
      return {
        form: new Form,
        formdata: {},
        companies: [
          {'value': 1, 'label': 'Acme Inc'},
          {'value': 2, 'label': 'Beta Ltd'},
          {'value': 3, 'label': 'Chaz Co.'},
        ],
      };
    },
    methods: {
      submit() {
        this.form.save('/form-end-point', this.formdata)
          .then(() => console.log('submitted'))
          .catch(err => console.log('ERRORS', err.response));
      },
    },
  };
</script>
```
---
```
<div class="form-group">
  <label>Countries</label>
  <select @change="changeCountry($event)">
    <option value="" selected disabled>Choose</option>
    <option v-for="country in countries" :value="country.code" :key="country.code" :selected="user.country==country.code">{{ country.name }}</option>
  </select>
</div>
```
---
```
https://www.pakainfo.com/vuejs-how-to-set-default-value-to-option-value-selected/

https://jsfiddle.net/Lxfxyqmf/
https://codepen.io/yingming25/pen/MzNgaz

<div id="liveApp">
  <select v-model="selected">
     <option value="live24u">live24u</option>
     <option value="Laravel">Laravel</option>
     <option value="Angularjs">Angularjs</option>
     <option value="Vuejs">Vuejs</option>
     <option value="JavaScript">JavaScript</option>
  </select>
</div>

<script>
new Vue({
  el: "#liveApp",
  data: {
    selected: 'Angularjs'
  }
})
</script>
```

---
```
https://vue-select.org/guide/values.html
https://vue-select.org/guide/values.html#tagging
```

### disble fields

```

https://vuejs.org/guide/essentials/forms.html
https://stackoverflow.com/questions/38085180/disable-input-conditionally-vue-js


<div>Selected: {{ selected }}</div>

<select v-model="selected">
  <option disabled value="">Please select one</option>
  <option>A</option>
  <option>B</option>
  <option>C</option>
</select>

https://jsfiddle.net/willywg/2g7m5qy5/


<div id="app">
  <p>
    <label for='terms'>
      <input id='terms' type='checkbox' v-model='terms' /> I accept terms!!!
    </label>
  </p>
  <button :disabled='isDisabled'>Send Form</button>
</div>

<script>
new Vue({
  el: '#app',
  data: {
  terms: false
  },
  computed: {
  isDisabled: function(){
    return !this.terms;
    }
  }
})
</script>

---

https://codepen.io/oomusou/pen/mVNVrL

<div id='app'>
  <label for="agree"><input id="agree" type="checkbox" value="agree" v-model="checked"/>I Agree</lable>
  <p>
  <button :disabled="!checked">Button</button>
</div>

<script>
new Vue({
  el : '#app',
  data: {
    checked : false
  }
});
</script>
```


### Difference between @keyup and @input?
```
https://forum.vuejs.org/t/difference-between-keyup-and-input/108962/2


checkPaceInput: function() {
  this.$nextTick(() => {
    this.pace = this.pace.replace(/[^0-9.:]/g,'');
  })
},
```
----------------------------------------------------------



### Onload Event vuejs lifecycle hooks

```
https://stackoverflow.com/questions/40714319/how-to-call-a-vue-js-function-on-page-load
https://michaelnthiessen.com/call-method-on-page-load/
https://www.codegrepper.com/code-examples/javascript/how+to+use+the+onload+event+n+vue+js


You can call this function in beforeMount section of a Vue component: like following:

new Vue({
    // ...
 methods:{
     getUnits: function() {...}
 },
 beforeMount(){
    this.getUnits()
 },
});
......
new Vue({
    // ...
    methods:{
        getUnits: function() {...}
    },
    created: function(){
        this.getUnits()
    }
});
......
new Vue({
  el:"#app",
  mounted:function(){
        this.method1() //method1 will execute at pageload
  },
  methods:{
        method1:function(){
              /* your logic */
        }
     },
})
 ......
 
Working fiddle: https://jsfiddle.net/q83bnLrx/1/

There are different lifecycle hooks Vue provide:

I have listed few are :

beforeCreate: 
Called synchronously after the instance has just been initialized, before data observation and event/watcher setup.

created: 
Called synchronously after the instance is created. At this stage, the instance has finished processing the options which means the following have been set up: data observation, computed properties, methods, watch/event callbacks. However, the mounting phase has not been started, and the $el property will not be available yet.

beforeMount: 
Called right before the mounting begins: the render function is about to be called for the first time.

mounted: 
Called after the instance has just been mounted where el is replaced by the newly created vm.$el.

beforeUpdate: 
Called when the data changes, before the virtual DOM is re-rendered and patched.

updated: 
Called after a data change causes the virtual DOM to be re-rendered and patched.
```
----------------------------------------------------------

### handleClick
```
https://flaviocopes.com/vue-events/
https://stackoverflow.com/questions/46464170/vuejs-show-tab-content-on-click
https://www.codegrepper.com/code-examples/csharp/%40click%3D%22handleClick%22+vuejs
https://vuejs.org/guide/essentials/event-handling.html
https://vuejs.org/guide/essentials/event-handling.html
https://www.digitalocean.com/community/tutorials/how-to-use-built-in-and-custom-directives-in-vue-js
https://github.com/ashwamegh/vue-link-preview

<button  @click="setComponent('manage')">manage</button>

<template>
  <a @click="handleClick">Click me!</a>
</template>

<script>
export default {
  methods: {
    handleClick: function(event) {
      console.log(event)
    }
  }
}
</script>
```
----------------------------------------------------------

### fullPath
```
https://router.vuejs.org/api/#custom
https://github.com/vuejs/vue-router
https://codesandbox.io/embed/vue-template-0vm7k

<router-link to="/home" custom v-slot="{ navigate, href, route }">
  <a :href="href" @click="navigate">{{ route.fullPath }}</a>
</router-link>
```

### vue disable field

https://stackoverflow.com/questions/38085180/disable-input-conditionally-vue-js
```
<input type="text" :disabled="someFunctionHere">

<input
  type="text"
  id="name"
  class="form-control"
  name="name"  
  v-model="form.name"
  :disabled="validated ? '' : disabled"
/>
```


