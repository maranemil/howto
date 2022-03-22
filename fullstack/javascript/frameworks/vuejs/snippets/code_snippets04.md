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




