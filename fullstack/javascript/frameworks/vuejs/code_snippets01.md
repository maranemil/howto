

----------------------------------------------------------------------------------------


### To-dos mit Vue.js
https://entwickler.de/angular/to-dos-mit-vuejs/
```
<script>
  export default {
    name: 'TodoList',
    data() {
      return {todos: [
        {id: 1, title: 'Get up', done: true},
        {id: 2, title: 'Eat', done: true},
        {id: 3, title: 'Sleep', done: false},
      ]};
    }
  }
</script>

<template>
  <ul>
    <li v-for="todo in todos" v-bind:key="todo.id">
      {{todo.title}}
    </li>
  </ul>
</template>


<template>
  <ul>
    <li v-for="todo in todos" v-bind:key="todo.id">
      {{todo.title}}
      <span v-if="todo.done">P</span>
      <span v-else>x</span>
    </li>
  </ul>
</template>



<template>
  <ul>
    <li v-for="todo in todos" v-bind:key="todo.id">
      {{todo.title}}
      <span v-if="todo.done" v-on:click="toggleState()">P</span>
      <span v-else @click="toggleState()">x</span>
    </li>
  </ul>
</template>


<script>
  export default {
    name: 'TodoList',
    data() {
      return {todos: []};
    },
    methods: {
      toggleState(id) {
        const index = this.todos.findIndex((todo) => todo.id === id);
        const todo = this.todos[index];
        todo.done = !todo.done;
      },
    }
  }
</script>


<style scoped>
  ul {
    list-style: none;
    padding-left: 0;
    width: 400px;
    margin: 0 auto;
  }
  li {
    line-height: 30px;
    border: 1px solid darkgray;
    padding: 10px;
    margin: 2px 0;
    position: relative;
  }
  span {
    position: absolute;
    right: 10px;
  }
</style>

<template>
  <ul>
    <li v-for="todo in todos" v-bind:key="todo.id"
        v-bind:class="todo.done ? 'done' : 'open'">
      {{todo.title}}
      <span v-if="todo.done" v-on:click="toggleState()">P</span>
      <span v-else @click="toggleState()">x</span>
    </li>
  </ul>
</template>
…
<style scoped>
…
  .done {
    background-color: lightgreen;
  }

  .open {
    background-color: lightsalmon;
  }
</style>


<template>
  <li v-bind:class="todo.done ? 'done' : 'open'">
      {{todo.title}}
      <span v-if="todo.done" v-on:click="toggleState(todo.id)">P</span>
      <span v-else @click="toggleState(todo.id)">x</span>
    </li>
</template>

<script>
  export default {
    props: ['todo'],
  }
</script>

<style scoped>
  li {
    line-height: 30px;
    border: 1px solid darkgray;
    padding: 10px;
    margin: 2px 0;
    position: relative;
  }
  span {
    position: absolute;
    right: 10px;
  }

  .done {
    background-color: lightgreen;
  }

  .open {
    background-color: lightsalmon;
  }
</style>
```








```
<template>
  <ul>
    <TodoListItem v-for="todo in todos" v-bind:todo="todo"
     v-bind:key="todo.id"></TodoListItem>
  </ul>
</template>
<script>
  export default {
    props: ['todo'],
    methods: {
      toggleState() {
        this.$emit('toggle-state', this.todo.id);
      }
    }
  }
</script>




<template>
  <ul>
    <TodoListItem v-for="todo in todos" v-bind:todo="todo" v-bind:key="todo.id"
     v-on:toggle-state="toggleState($event)"></TodoListItem>
  </ul>
</template>
<script>
  import TodoListItem from './TodoListItem';

  export default {
    async mounted() {
      const response = await fetch('/todo');
      this.todos = await response.json();
    },
…
</script>


<template>
  <form>
    <div>
      <label for="title">Title: </label>
      <input type="text" v-model="todo.title" name="title" id="title">
    </div>
    <div>
      <label for="done">Done: </label>
      <input type="checkbox" v-model="todo.done" name="done" id="done">
    </div>
    <button v-on:click="save">save</button>
  </form>
</template>

<script>
  export default {
    data() {
      return {
        todo: {
          title: '',
          done: false
        }
      }
    },
    methods: {
      save() {
        this.$emit('save', this.todo);
      }
    }
  }

</script>

<style scoped></style>
```

### Listing 14: Todo Form-Component

```
<template>
  <TodoForm v-if="create" v-on:save="save($event)"></TodoForm>
  <ul v-else>
    <TodoListItem v-for="todo in todos" v-bind:todo="todo" v-bind:key="todo.id"
     v-on:toggle-state="toggleState($event)"></TodoListItem>
    <button v-on:click="create = true">new</button>
  </ul>
</template>

<script>
  import TodoListItem from './TodoListItem';
  import TodoForm from './TodoForm';

  export default {
    async mounted() {…},
    components: {
      TodoListItem,
      TodoForm
    },
    name: 'TodoList',
    data() {
      return {todos: [], create: false};
    },
    methods: {
      async toggleState(id) {…},
      async save(todo) {
        await fetch('/todo', {
          method: 'POST',
          headers: {'content-type': 'application/json'},
          body: JSON.stringify(todo),
        });
        this.create = false;
      }
    }
  }
</script>

<style scoped>
…
</style>
```


------------------------
### vuejs links

```
https://forum.vuejs.org/t/how-create-a-working-link-in-a-method/67132
https://router.vuejs.org/guide/advanced/extending-router-link.html
https://vuejs.org/guide/essentials/component-basics.html#using-a-component
https://reactgo.com/vue-open-link-new-tab/
https://stackoverflow.com/questions/50633001/vuejs-vue-router-linking-an-external-website

intern link
-------------------
<router-link :to="'club/' + team.id">{{ team.team }}</router-link>

extern link
-------------------
<a :href="'//' + websiteUrl" target="_blank">
  {{ url }}
</a>
```







### vue replace chars numbers

- https://codepen.io/patskot/pen/WdwarO
https://stackoverflow.com/questions/50566430/vue-js-how-to-restrict-special-characters-in-an-input-field
```
<div id="app">
  <input type="text" v-model="input" @keyup="onlyText">
</div>

new Vue({
    el: '#app',
    data () {
      return {
        input: 'Some text',
      }
    },
    methods: {
      onlyText () {
        this.input = this.input.replace(/[0-9]/g, '')
      }
    },
    watch: {
  	myAlphaNumField(newVal) {
    		let re = /[^A-Z0-9]/gi;
    		this.$set(this, 'myAlphaNumField', newVal.replace(re, ''));
   	}
     }
})
```
----------------------------------------
```
# convert a string to number in vue js
let myNumber = Number("5.25"); //5.25
```
----------------------------------------
```
input change
https://github.com/vuejs-tips/vue-the-mask/issues/92

    <input
        @click="onInputClick"
        @change="onInputChange"
        @input="onInputChange"
        v-model="input"
        class="chatroom-footer-input"
    />
```
----------------------------------------
```
https://www.codegrepper.com/code-examples/javascript/vue+watch+handler
https://laracasts.com/discuss/channels/vue/vuejs-deep-watch

new Vue({
	el:"#app",
	data: function ()  {
	    return {
	       questions: []
	    }
	},    
	watch: {
	   questions: {
	       handler: function(val, oldVal) {
		   this.foo(); // call it in the context of your component object
	       },
	       deep: true
	    }
	},
	methods: {
	    foo() {
		console.log("foo called");
	    }
	}
});

Vue.set(vm.someObject, 'propertyName', value)
// Or using alias
this.$set(this.someObject, 'propertyName', value)
// For an array, simply repalce propertyName with the index
this.$set(this.someArray, indexOfItem, value)
// Or assign new props to an object
this.someObject = Object.assign({}, this.someObject, { a: 1, b: 2 })
```

-----------------------------------------
```
Deep Watchers
https://vuejs.org/guide/essentials/watchers.html#basic-example

export default {
  watch: {
    someObject: {
      handler(newValue, oldValue) {
        // Note: `newValue` will be equal to `oldValue` here
        // on nested mutations as long as the object itself
        // hasn't been replaced.
      },
      deep: true
    }
  }
}
```
-----------------------------------------
```
@input="customMethod"

export default {
  watch: {
    someObject: {
      handler(newValue, oldValue) {
        // Note: `newValue` will be equal to `oldValue` here
        // on nested mutations as long as the object itself
        // hasn't been replaced.
      },
      deep: true
    }
  },
  methods: {
  	customMethod(){
  		// do something
  	}
  }
}
```

-----------------------------------------
```
const event = new Event('input')
vm.$refs.child.value = 'something'
vm.$refs.child.dispatchEvent(event)

```
---------------------------------------
```
https://012.vuejs.org/guide/forms.html
https://blog.logrocket.com/form-input-validation-in-vue-js-using-watchers/
https://blog.logrocket.com/vue-refs-accessing-dom-elements/
https://bootstrap-vue.org/docs/components/form-input
https://codepen.io/CSWApps/pen/RQbvvp
https://dev.to/timothyokooboh/understanding-watchers-in-vue-js-mki
https://dev.to/vcpablo/vuejs-2-different-ways-to-implement-v-model-1mjf
https://developer.mozilla.org/en-US/docs/Learn/Tools_and_testing/Client-side_JavaScript_frameworks/Vue_methods_events_models
https://developer.mozilla.org/en-US/docs/Learn/Tools_and_testing/Client-side_JavaScript_frameworks/Vue_refs_focus_management
https://developpaper.com/question/modifying-the-value-of-v-model-in-the-change-event-in-the-el-input-component-of-element-will-not-take-effect/
https://laracasts.com/discuss/channels/vue/update-component-data-from-event-data
https://laracasts.com/discuss/channels/vue/v-model-not-updating-when-data-changes-in-edit-form
https://laracasts.com/discuss/channels/vue/vuejs-data-value-not-updating
https://laracasts.com/discuss/channels/vue/vuejs-props-dont-update-when-input-changes
https://learnvue.co/2020/01/a-vue-event-handling-cheatsheet-the-essentials/#emitting-custom-events
https://learnvue.co/2020/01/getting-smart-with-vue-form-validation-vuelidate-tutorial/#what-is-vuelidate
https://learnvue.co/2021/01/everything-you-need-to-know-about-vue-v-model/#tips-for-using-v-model
https://medium.com/js-dojo/learn-form-validation-in-vue-3-in-10-minutes-with-vuelidate-8929c5059e66
https://medium.com/swlh/how-to-use-async-and-await-with-vue-js-apps-33132aa0838b
https://michaelnthiessen.com/how-to-watch-nested-data-vue/
https://michaelnthiessen.com/how-to-watch-nested-data-vue/
https://reactjs.org/docs/refs-and-the-dom.html
https://router.vuejs.org/guide/advanced/navigation-failures.html
https://siongui.github.io/2017/02/03/vuejs-input-change-event/
https://stackoverflow.com/questions/41135188/vue-deep-watching-an-array-of-objects-and-calculating-the-change
https://stackoverflow.com/questions/56238080/vue-js-method-change-event-doesnt-trigger
https://thewebdev.info/2021/05/22/how-to-watch-multiple-properties-with-a-single-handler-in-vue-js/

https://v2.vuejs.org/v2/cookbook/form-validation.html
https://v2.vuejs.org/v2/guide/components-custom-events.html
https://v2.vuejs.org/v2/guide/components-edge-cases.html
https://v2.vuejs.org/v2/guide/computed.html
https://v2.vuejs.org/v2/guide/computed.html
https://v2.vuejs.org/v2/guide/custom-directive.html
https://v2.vuejs.org/v2/guide/forms.html

https://vueformulate.com/guide/inputs/#context-object

https://vuejs.org/api/
https://vuejs.org/api/composition-api-lifecycle.html#onerrorcaptured
https://vuejs.org/api/reactivity-core.html#watch
https://vuejs.org/guide/essentials/class-and-style.html
https://vuejs.org/guide/essentials/event-handling.html
https://vuejs.org/guide/essentials/reactivity-fundamentals.html#declaring-methods
https://vuejs.org/guide/essentials/template-refs.html#ref-on-component
https://vuejs.org/guide/essentials/watchers.html#basic-example
https://vuejs.org/guide/extras/reactivity-in-depth.html#how-reactivity-works-in-vue
https://vuejs.org/guide/scaling-up/state-management.html#pinia
https://vuejsdevelopers.com/2018/08/27/vue-js-form-handling-vuelidate/
https://vuelidate-next.netlify.app/advanced_usage.html#using-the-validateeach-component
https://vuetifyjs.com/en/components/text-fields/#prefixes-and-suffixes
https://www.binarcode.com/blog/3-anti-patterns-to-avoid-in-vuejs/
https://www.codegrepper.com/code-examples/javascript/vue+watch+value+change
https://www.codegrepper.com/code-examples/javascript/vue2+watch+deep
https://www.freecodecamp.org/news/migrate-from-vue2-to-vue3-with-example-project/
https://www.javatpoint.com/vue-js-form-input-bindings
https://www.jetbrains.com/help/idea/vue-js.html#ws_vue_coding_assistance
https://www.thisdot.co/blog/vue-3-composition-api-watch-and-watcheffect
https://www.tutorialspoint.com/vuejs/vuejs_watch_property.htm
https://www.w3docs.com/snippets/vue-js/how-to-properly-watch-for-nested-data.html

```















