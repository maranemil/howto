
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



















