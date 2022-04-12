### courses vueschool vuemastery
```

https://vueschool.io/lessons/html-attribute-binding-in-vue-3
https://www.vuemastery.com/courses/intro-to-vue-3/attribute-binding-vue3/
https://docs.w3cub.com/vue~3/
https://medium.com/geekculture/vue-js-3-setup-function-236063add3cd
https://github.com/vueschool/vuejs-3-fundamentals
https://vue-multiselect.js.org/
https://test-utils.vuejs.org/guide/essentials/forms.html#setting-element-values
https://v2.vuejs.org/v2/guide/list.html
https://vuejs.org/guide/essentials/list.html
https://www.w3resource.com/vue/list-rendering.php
https://fjolt.com/article/vue-how-to-use-v-for
```


### Vuejs disable inputs

```

https://renatello.com/vue-js-html-attributes/
https://medium.com/@renatello/conditionally-enable-disable-html-attributes-in-vue-js-f86d0b3b2e69
https://www.thisdot.co/blog/build-advanced-components-in-vue-3-using-usdattrs
https://stackoverflow.com/questions/42874314/vuejs-conditionally-add-an-attribute-for-an-element
https://thewebdev.info/2021/03/28/how-to-disable-input-conditionally-in-vue-js-3/
https://tailwindcss.com/docs/hover-focus-and-other-states

<div id="app">
  <h2>Please, verify your email address:</h2>
  <input type="text" id="email" name="name" v-model="email" :disabled="!emailEnabled" :required="emailRequired" />
  <h4 v-if="validated">
    Thank you for verifying your email address
  </h4>
</div>

new Vue({
  el: "#app",
  data: {
    email: null,
    correctEmail: 'renat@example.com',
    emailEnabled: false
  },
  methods: {
  },
  computed: {
    validated() {
      if (this.email === this.correctEmail) {
      	return true
      }
    },
  }
})
```

### Vuejs multiple emelements
```

https://renatello.com/pass-parameter-to-method-vue-js/
https://stackoverflow.com/questions/40956671/passing-event-and-argument-to-v-on-in-vue-js
https://medium.com/@renatello/how-to-pass-a-parameter-to-a-method-in-vue-js-4edf3365c28b
https://stackoverflow.com/questions/50067400/vue2-disable-input-with-multiple-components
https://laracasts.com/discuss/channels/vue/how-to-target-a-specific-item-in-v-for
https://github.com/vuejs/vue/issues/4685

<div id="app">
  <h2>Items:</h2>
  <ol>
    <li v-for="item in items">
      {{ item.text }} <a href="#" @click="removeItem(item.id)">Remove</a>
      			<a href="#" @click="removeItem($event, item.id)">Remove2</a>
    </li>
  </ol>
</div>

<div @customEvent='(arg1) => myCallback(arg1, arg2)'>Hello!</div>

-----

<template>
  <article v-for="(item, index) in items">
    <div class="media-content">
      <div class="content">
        <p>{{item.name}}</p>
        <div class="field" v-if="selectedItem == index">
          <div class="control">
            <textarea class="textarea" v-model="item"></textarea>
          </div>
        </div>
      </div>
    </div>
    <div class="media-right">
      <a @click="editReply(item, index)"><span class="icon"><i class="fa fa-pencil"></i></span></a>
    </div>
  </article>
</template>

<script>
export default {

  data() {
    return {
      items: [],
      item:'',
      selectedItem: null,
    }
  },

  methods: {
    fetchAllitems() {
      axios.get(`/items`)
        .then(response => this.items = response.data)
        .catch(error => console.log(error.response.data))
    },

    editReply(item, index) {
      this.selectedItem = index;
      this.item = item.name;
    }
  },

  created() {
    this.fetchAllItems();
  }
}
</script>
```



### Install Tailwind CSS v2.0 and PostCSS 8

```

https://v2.tailwindcss.com/docs/upgrading-to-v2
npm install tailwindcss@latest postcss@latest autoprefixer@latest
```



### Javascript Vue.js Vuetify v-select get item index

```

https://www.demo2s.com/javascript/javascript-vue-js-vuetify-v-select-get-item-index.html

Vue.use(Vuetify);
var vm = new Vue({
   el: "#app",/*from   ww  w .  d  e  m  o  2s  .  com*/
  methods: {
      checkAnswer(correct) {
     correct.correct ? console.log('Correct Answer') : console.log('Wrong Answer')
    }
  },
  data: {
      questions: [
     {
      id: 1,
        question: 'The Last Name of Cristiano is:',
      answers: [
         { text: 'Ronaldo', correct: true},
        { text: 'Rivaldo', correct: false },
        { text: 'Messi', correct: false }
      ]
     },
     {
        id: 2,
      question: 'Vue.js, is a:',
      answers: [
         { text: 'Javscript Framework', correct: true },
        { text: 'Php Framework', correct: false },
        { text: 'Python Framework', correct: false }
      ]
     }
    ]
  }
});



Javascript Vue.js Vuetify v-select issue

new Vue({
  el: '#app',
  data() {
    return {
      items: [
      { name: 'Karen', icon: 'search', icon_color: 'red' },
      { name: 'Gordon', icon: 'person', icon_color: 'yellow' },
      { name: 'Craig', icon: 'opacity', icon_color: 'blue' },
      { name: 'Chris', icon: 'pets', icon_color: 'orange' }] };
  } });

```

### examples 

```

https://jsfiddle.net/boilerplate/vue
https://jsfiddle.net/Akryum/4arzpcdv/
https://jsfiddle.net/chrisvfritz/50wL7mdz/
https://jsfiddle.net/Linusborg/9sd90474/18/


https://jsfiddle.net/381510688/wxg4c0th/
https://jsfiddle.net/amitavroy/2p9gsz49/
https://jsfiddle.net/381510688/uyppvvL0/
https://jsfiddle.net/jonataswalker/416oz6ga/

/////////////////////////////////////////////////
// https://jsfiddle.net/Akryum/4arzpcdv/
/////////////////////////////////////////////////

<!-- Include the library in the page -->
<script src="https://unpkg.com/vue@2.2.0-beta.1/dist/vue.js"></script>

<!-- App -->
<div id="app">
  <p ref="a" @click="handleClick">{{ message }}</p>
  <test>
    <button @click="handleClick">Test</button>
  </test>
  <comp ref="b" v-show="show"></comp>
  <div>
    <a ref="c">Hello</a>
  </div>
  <div ref="d">
    <a>Hello</a>
  </div>
  <comp ref="b2" v-show="show"/>
  <div v-show="show">
    <comp ref="e"/>
  </div>
  <div>
    <comp ref="f"/>
  </div>
  <div>
    <a ref="g">Hello</a>
  </div>
  <div ref="h">
    <a>Hello</a>
  </div>
</div>


console.clear()
console.log('Yes! We are using Vue version', Vue.version)


// New VueJS instance
var app = new Vue({
	// CSS selector of the root DOM element
  el: '#app',
  // Some data
  data: () => ({
    message: 'Hello Vue.js!',
    show: false,
  }),
  components: {
  	comp: {
    	render (h) {
      	return h('div', 'MyComponent')
      }
    },
    test: {
    	template: `<section><slot/></section>`
    }
  },
  methods: {
  	handleClick () {
    	this.show ^= 1
    	console.log('click', this.$refs)
      this.$nextTick(() => {
      	console.log('tick', this.$refs)
      })
    }
  },
  mounted () {
  	console.log('mounted', this.$refs)
  }
})
```

```
/////////////////////////////////////////////////
// gen list /////////////////////////////////////
//  https://jsfiddle.net/Linusborg/9sd90474/18/
/////////////////////////////////////////////////

<div id="app">
  <ul class="list">
    <item v-for="item in limitedItems" :item="item"></item>
  </ul>
  
  <button @click="limitNumber += 2">Show more</button>
</div>

<template id="list-template">
  <li>{{ item }}</li>
</template>

Vue.component('item', {
  template:'#list-template',
  props:['item']
});

var vm = new Vue({
  el:"#app",
  computed: {
    limitedItems() {
      return this.items.slice(0,this.limitNumber)
    }
  },
  data:{
  	limitNumber: 2,
    items: [
     'item1',
     'item2',
     'item3',
     'item4',
     'item5',
     'item6',
     'item7',
     'item8',
     'item9',
     'item10',
    ]
  }

/////////////////////////////////////////////////
// grettings
// https://jsfiddle.net/coligo/cckLd9te/
/////////////////////////////////////////////////

<div id="app">
  <greeting></greeting>
</div>

Vue.component('greeting', {
  template: '<h1>Welcome to coligo!</h1>'
});

// create a new Vue instance and mount it to our div element above with the id of app
var vm = new Vue({
  el: '#app'
});


// todos

https://jsfiddle.net/boilerplate/vue

<div id="app">
  <h2>Todos:</h2>
  <ol>
    <li v-for="todo in todos">
      <label>
        <input type="checkbox"
          v-on:change="toggle(todo)"
          v-bind:checked="todo.done">

        <del v-if="todo.done">
          {{ todo.text }}
        </del>
        <span v-else>
          {{ todo.text }}
        </span>
      </label>
    </li>
  </ol>
</div>


new Vue({
  el: "#app",
  data: {
    todos: [
      { text: "Learn JavaScript", done: false },
      { text: "Learn Vue", done: false },
      { text: "Play around in JSFiddle", done: true },
      { text: "Build something awesome", done: true }
    ]
  },
  methods: {
  	toggle: function(todo){
    	todo.done = !todo.done
    }
  }
})


body {
  background: #20262E;
  padding: 20px;
  font-family: Helvetica;
}

#app {
  background: #fff;
  border-radius: 4px;
  padding: 20px;
  transition: all 0.2s;
}

li {
  margin: 8px 0;
}

h2 {
  font-weight: bold;
  margin-bottom: 15px;
}

del {
  color: rgba(0, 0, 0, 0.3);
}

```
```
/////////////////////////////////////////////////
// vue 3 ////////////////////////////////////////
/////////////////////////////////////////////////

<script src="https://unpkg.com/vue"></script>

<div id="dynamic-component-demo">
  <button v-for="tab in tabs" v-bind:key="tab" v-bind:class="['tab-button', { active: currentTab === tab }]" v-on:click="currentTab = tab"  >{{ tab }}</button>
  <keep-alive>
    <component v-bind:is="currentTabComponent" class="tab"></component>
  </keep-alive>
</div>



console.clear()
console.log('Yes! We are using Vue version', Vue.version)

Vue.component('tab-posts', { 
  data: function () {
  	return {
      posts: [
        { 
        	id: 1, 
          title: 'Cat Ipsum',
          content: '<p>Dont wait</p>'
        },
        { 
        	id: 2, 
          title: 'Hipster Ipsum',
          content: '<p>Bushwick blue.</p>'
        }
      ],
      selectedPost: null
    }
  },
	template: `
  	<div class="posts-tab">
      <ul class="posts-sidebar">
        <li v-for="post in posts"  v-bind:key="post.id"  v-bind:class="{ selected: post === selectedPost }" v-on:click="selectedPost = post">
          {{ post.title }}
        </li>
      </ul>
      <div class="selected-post-container">
      	<div 
        	v-if="selectedPost"
          class="selected-post"
        >
          <h3>{{ selectedPost.title }}</h3>
          <div v-html="selectedPost.content"></div>
        </div>
        <strong v-else>
          Click on a blog title to the left to view it.
        </strong>
      </div>
    </div>
  `
})

Vue.component('tab-archive', { 
	template: '<div>Archive component</div>' 
})

new Vue({
  el: '#dynamic-component-demo',
  data: {
    currentTab: 'Posts',
    tabs: ['Posts', 'Archive']
  },
  computed: {
    currentTabComponent: function () {
      return 'tab-' + this.currentTab.toLowerCase()
    }
  }
})

```
```

////////////////////////////////////////////////////////////
/// enable disable fields vuejs 3
////////////////////////////////////////////////////////////

<script src="https://unpkg.com/vue@3"></script>
<div id="app">
  <ol>
    <li v-for="(item, index) in items"> 
      <input type="text" :disabled="true" ref="customfield"  />

          Item: {{ item.id }} Title:  {{ item.title }}
    </li>
  </ol>
  <button @click="enableInputs">  Enable </button>
  <button @click="disableInputs">  Disable </button>
</div>

<script>
 console.clear()
  console.log('Yes! We are using Vue version', Vue.version)
  // https://vuejs.org/guide/quick-start.html#without-build-tools
  Vue.createApp({
    data() {
      return {
      	customfield: [],
         items: [
          { 
            id: 1, 
            title: 'Cat Ipsum',
            content: 'Dontten around'
          },
          { 
            id: 2, 
            title: 'Hipster Ipsum',
            content: 'Bushwick el migas 8-ujang.'
          }       
        ]  
      }
    },
    methods: {
    	enableInputs() {
      //this.$refs.customfield[0].value=1;
      //this.$refs.customfield[0].disabled=false;
      //console.log(this.$refs.customfield[0].value);      
        this.$refs.customfield.forEach(function(item,index){          
          	item.value= index * 10
           	item.disabled=false;
            console.log(item.value)
        });
      },
      disableInputs(){
      	 this.$refs.customfield.forEach(function(item,index){          
           	item.disabled=true;
            console.log(item.value)
        });
      }
    }
  }).mount('#app')
</script>


```
```


/////////////////////////////////////////////////
axios vue vuex
/////////////////////////////////////////////////
https://jsfiddle.net/jonataswalker/416oz6ga/


<script src="https://unpkg.com/vue"></script>
<script src="https://unpkg.com/vuex"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<div id="app">
  <followers></followers>
</div>


Vue.component('followers', {
  template: '<div>Followers: {{ computedFollowers }}</div>',
  data() {
  	return { followers: 0 }
  },
  created () {
    this.$store.dispatch('getFollowers').then(res => {
    	this.followers = res.data.followers
    })
  },
  computed: {
  	computedFollowers: function () {
    	return this.followers
    }
  }
});

const store = new Vuex.Store({
  actions: {
    getFollowers() {
      return new Promise((resolve, reject) => {
        axios.get('https://api.github.com/users/octocat')
          .then(response => resolve(response))
          .catch(err => reject(error))
      });
    }
  }
})

const app = new Vue({
	store,
  el: '#app'
})

```
