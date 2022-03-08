
### read-write-excel-file-in-node-js-using-xlsx
```
https://stackoverflow.com/questions/30859901/parse-xlsx-with-node-and-create-json
https://www.tabnine.com/code/javascript/functions/xlsx/XLSX%24Utils/sheet_to_json
https://javascript.hotexamples.com/examples/xlsx/utils/sheet_to_json/javascript-utils-sheet_to_json-method-examples.html
https://npmdoc.github.io/node-npmdoc-xlsx/build..beta..travis-ci.org/apidoc.html
https://javascript.plainenglish.io/read-write-excel-file-in-node-js-using-xlsx-ab11881d00b4


const dt = await XLSX.readFile('./data/data.xlsx', {});
const first_worksheet = dt.Sheets[dt.SheetNames[0]];
const data = XLSX.utils.sheet_to_json(first_worksheet, { header: 1 });


var XLSX = require('xlsx');
var workbook = XLSX.readFile('Master.xlsx');
var sheet_name_list = workbook.SheetNames;
console.log(XLSX.utils.sheet_to_json(workbook.Sheets[sheet_name_list[0]]))
```
```
var XLSX = require('xlsx');
var workbook = XLSX.readFile('test.xlsx');
var sheet_name_list = workbook.SheetNames;
sheet_name_list.forEach(function(y) {
    var worksheet = workbook.Sheets[y];
    var headers = {};
    var data = [];
    for(z in worksheet) {
        if(z[0] === '!') continue;
        //parse out the column, row, and value
        var tt = 0;
        for (var i = 0; i < z.length; i++) {
            if (!isNaN(z[i])) {
                tt = i;
                break;
            }
        };
        var col = z.substring(0,tt);
        var row = parseInt(z.substring(tt));
        var value = worksheet[z].v;

        //store header names
        if(row == 1 && value) {
            headers[col] = value;
            continue;
        }

        if(!data[row]) data[row]={};
        data[row][headers[col]] = value;
    }
    //drop those first two rows which are empty
    data.shift();
    data.shift();
    console.log(data);
});
```

---------------------------------------------------
```
vue.js $watch array of objects

https://stackoverflow.com/questions/34283891/vue-js-watch-array-of-objects
https://012.vuejs.org/guide/list.html
https://v2.vuejs.org/v2/guide/list.html
https://jsfiddle.net/jonatan2m/h7sm7wbr/
https://reactgo.com/vue-watch-array-of-objects/
https://thewebdev.info/2021/05/18/how-to-deep-watch-an-array-of-objects-and-calculating-the-change-with-vue-js/
https://www.codegrepper.com/code-examples/javascript/vue+watch+not+detecting+when+property+in+array+object+changed

mounted: function () {
  this.$watch('things', function () {
    console.log('a thing changed')
  }, {deep:true})
}


new Vue({
  ...
  watch: {
    things: {
      handler: function (val, oldVal) {
        console.log('a thing changed')
      },
      deep: true
    }
  },
  ...
})


new Vue({
  ...
  watch: {
    things: {
      handler: function (val, oldVal) {
        var vm = this;
        val.filter( function( p, idx ) {
            return Object.keys(p).some( function( prop ) {
                var diff = p[prop] !== vm.clonethings[idx][prop];
                if(diff) {
                    p.changed = true;                        
                }
            })
        });
      },
      deep: true
    }
  },
  ...
})
```
```
{
  el: "#app",
  data () {
    return {
      list: [{a: 0}],
      calls: 0,
      changes: 0,
    }
  },
  computed: {
    copy () { return this.list.slice() },
  },
  watch: {
    copy (a, b) {
      this.calls ++
      if (a.length !== b.length) return this.onChange()
      for (let i=0; i<a.length; i++) {
        if (a[i] !== b[i]) return this.onChange()
      }
    }
  },
  methods: {
    onChange () {
      console.log('change')
      this.changes ++
    },
    addItem () { this.list.push({a: 0}) },
    incrItem (i) { this.list[i].a ++ },
    removeItem(i) { this.list.splice(i, 1) }
  }
}
```


```
https://jsfiddle.net/jonatan2m/h7sm7wbr/

<div id="app">
  <button @click="change">change</button>
  <div v-for="q in Questions">
<input type="text" v-model="q.foo">
  </div>
  <pre>{{ $data | json }}</pre>
</div>

new Vue({
	el: "#app",
  data () {
  return {
  	Questions: [],
    cloneQuestions: []
    }
  },
  mounted() {
   
   this.Questions = [{foo:1, changed: false}, {foo:2, changed: false}];
   this.cloneQuestions = this.Questions.map(a => Object.assign({}, a));
   },
  created (){
  var vm = this;
  this.$watch("Questions", function (after, before) {
  	after.filter( function( p, idx ) {
    	return Object.keys(p).some( function( prop ) {
      	var diff = p[prop] !== vm.cloneQuestions[idx][prop];
        if(diff) {
        	p.changed = true;
          vm.cloneQuestions[idx][prop] = p[prop];
        }
      })
     });
     
      }, {deep: true})
  }, 
  methods: {
  	change: function () {
	    this.Questions[0].foo = 5
    }
  }
})
```
---------------------------------------------------
```
https://v2.vuejs.org/v2/guide/filters.html
https://vuejs.org/api/
https://stackoverflow.com/questions/35787159/check-if-value-exists-in-vuejs

var vm = new Vue({
    el: 'body',
    data: {
        editlistAssesments: [1,2,3,4,4,5]
    },
    filters: {
        ifInArray: function (value) {
            return this.editlistAssesments.indexOf(value) > -1 ? 'Yes' : 'No';
        }
    },
});


<div id="looping" v-for="display in editlistAssesments">
    <span v-text="display.test_id | ifInArray"></span>
    <!-- bind Vue value to html element is better practice -->
</div>

<div id="looping" 
     v-for="display in editlistAssesments">
    <span v-if="typeof display.test_id !== 'undefined'">
        {{display.test_id}}
    </span>
</div>

```
---------------------------------------------------
```
https://jsonformatter.curiousconcept.com/#

[[["id"],[157],"Sheet1"]]
```
---------------------------------------------------
```
vuejs check in array
https://laracasts.com/discuss/channels/vue/how-to-check-does-value-exists-in-array-with-vue

methods: {       
    inArray: function(needle, haystack) {
        var length = haystack.length;
        for(var i = 0; i < length; i++) {
            if(haystack[i] == needle) return true;
        }
        return false;
    }
}
 ```
    
    
```
Using forEach method in Vue
https://codesource.io/using-foreach-method-in-vue/
https://www.digitalocean.com/community/tutorials/vuejs-iterating-v-for
https://v2.vuejs.org/v2/guide/list.html
https://stackoverflow.com/questions/42535987/how-to-use-foreach-in-vuejs


let newData = [];
	this.data.forEach((value,index ) => {
	newData.push(value);
	console.log("newData", newData);
});

let arr = [];
this.myArray.forEach((value, index) => {
    arr.push(value);
    console.log(value);
    console.log(index);
});

const newArray = this.myArray.filter((value, index) => {
    console.log(value);
    console.log(index);
    if (value > 5) return true;
});

 Array.from(files).forEach((file) => {
       if(this.mediaTypes.image.includes(file.type)) {
            this.media.images.push(file)
             console.log(this.media.images)
       }
   }
```


```
"Uncaught SyntaxError: Unexpected token"
Unexpected token < in first line of HTML

https://bobbyhadz.com/blog/javascript-uncaught-syntaxerror-unexpected-token
https://www.codecademy.com/forum_questions/523ca828548c35497900518e
https://stackoverflow.com/questions/31529446/unexpected-token-in-first-line-of-html

<!DOCTYPE html>
<!doctype html>

fix

<script src="correct path"> </script>
```

----------------------------
```
##########################################################
#
#   How To Pass Data Between Components In Vue.js
#   https://www.smashingmagazine.com/2020/01/data-components-vue-js/
#
##########################################################

1. Using Props To Share Data From Parent To Child #
------------------------

AccountInfo.vue

<template>
 <div id='account-info'>
   {{username}}
 </div>
</template>
 
<script>
export default {
 props: ['username']
}
/*
export default {
 props: {
   username: String
 }
}
*/
</script>



ProfilePage.vue

<account-info username='matt' />

...

<template>
 <div>
   <account-info :username="user.username" />
 </div>
</template>
 
<script>
import AccountInfo from "@/components/AccountInfo.vue";
 
export default {
 components: {
   AccountInfo
 },
 data() {
   return {
     user: {
       username: 'matt'
     }
   }
 }
}
</script>

...

# FOLLOW PROP NAMING CONVENTIONS 
// GOOD
<account-info :my-username="user.username" />
props: {
   myUsername: String
}
 
// BAD
<account-info :myUsername="user.username" />
props: {
   "my-username": String
}

2. Emitting Events To Share Data From Child To Parent 
---------------------------------------------------

<template>
 <div id='account-info'>
   <button @click='changeUsername()'>Change Username</button>
   {{username}}
 </div>
</template>
 
<script>
export default {
 props: {
   username: String
 },
 methods: {
   changeUsername() {
     this.$emit('changeUsername')
   }
 }
}
</script>


<template>
 <div>
   <account-info :username="user.username" @changeUsername="user.username = 'new name'"/>
 </div>
</template>

# CUSTOM EVENTS CAN ACCEPT ARGUMENTS

this.$emit('changeUsername', 'mattmaribojoc')


...in parent component,

<account-info :username="user.username" @changeUsername="user.username = $event"/>
 
OR 
 
<account-info :username="user.username" @changeUsername="changeUsername($event)"/>
 
export default {
    ...
    methods: {
       changeUsername (username) {
         this.user.username = username;
       }
    }
}



3. Using Vuex To Create An Application-Level Shared State
---------------------------------------------------

// store/index.js
 
import Vue from "vue";
import Vuex from "vuex";
 
Vue.use(Vuex);
 
export default new Vuex.Store({
 state: {},
 getters: {},
 mutations: {},
 actions: {}
});



// main.js
 
import store from "./store";
 
new Vue({
  store,
  ...


# ACCESSING VUE STORE INSIDE COMPONENTS

export default new Vuex.Store({
 state: {
   user: {
     username: 'matt',
     fullName: 'Matt Maribojoc'
   }
 },
 getters: {},
 mutations: {},
 actions: {}
});


mounted () {
   console.log(this.$store.state.user.username);
},

# GETTERS

getters: {
   firstName: state => {
     return state.user.fullName.split(' ')[0]
   }
 }
 
 
 mounted () {
   console.log(this.$store.getters.firstName);
}

lastName (state, getters) {
     return state.user.fullName.replace(getters.firstName, '');
}

# Pass Custom Arguments to Vuex Getters 
 
prefixedName: (state, getters) => (prefix) => {
     return prefix + getters.lastName;
}
 
// in our component
console.log(this.$store.getters.prefixedName("Mr."));


# MUTATIONS

mutations: {
   changeName (state, payload) {
     state.user.fullName = payload
   }
},

this.$store.commit("changeName", "New Name");

changeName (state, payload) {
     state.user.fullName = payload.newName
}

this.$store.commit("changeName", {
       newName: "New Name 1",
});
 
// or
 
 this.$store.commit({
       type: "changeName",
       newName: "New Name 2"
});

# ACTIONS

actions: {
   changeName (context, payload) {
     setTimeout(() => {
       context.commit("changeName", payload);
     }, 2000);
   }
}

this.$store.dispatch("changeName", {
      newName: "New Name from Action"
});


####################################################
#
#   Passing Data Between Components in Vue.js
#   https://dev.to/maxwellboecker/passing-data-between-components-in-vue-js-296p
#
####################################################


GardenMain.vue

<editmodal
        :id="gardenId"
        :name="name"
        :lat="location.lat"
        :lng="location.lng"
        :width="gardenSize.width"
        :height="gardenSize.height"
        :updateMain="updateMain"
      ></editmodal>


updateMain: function (garden) {
      const { id, lat, lng, width, length, name } = garden.data;
      this.gardenSize = { width, height: length };
      this.name = name;
      this.location = { lat, lng };
    },



EditModal.vue

export default {
  name: "EditModal",
  props: {
    id: {
      type: Number,
    },
    name: {
      type: String,
    },
    lat: {
      type: Number,
    },
    lng: {
      type: Number,
    },
    width: {
      type: Number,
    },
    height: {
      type: Number,
    },
    updateMain: {
      type: Function,
    },
  },


Editor.vue

<template>
  <div>
    <EditGarden
      v-on:edit:garden="submitEdit"
      :id="this.id"
      :name="this.name"
      :lat="this.lat"
      :lng="this.lng"
      :width="this.width"
      :height="this.height"
    />
  </div>
</template>

methods: {
    submitEdit(info) {
      axios.put("/garden/gardenupdate", {
          id: this.id,
          info: info,
        })
        .then((garden) => {
          this.$emit("close");
          this.updateMain(garden);
        });
    },
  },
  
EditGarden.vue
  
  methods: {
    handleSubmit() {
      this.$emit("edit:garden", {
        name: this.gardenName,
        lat: this.latt,
        lng: this.long,
        width: this.wid,
        length: this.hei,
      });
    },
  },
  
```


  















