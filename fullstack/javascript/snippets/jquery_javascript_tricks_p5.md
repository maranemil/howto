
### JavaScript Classes #2: Getters & Setters - JavaScript OOP Tutorial
#### https://www.youtube.com/watch?v=y4wDanUBNmE

```
class Square {
   constructor (_width){
      this.width = _width;
      this.height = _width;
   }
   get area(){
      return this.width = this.height;
   }
   set area(area){
      this.width = Math.sqrt(area);
      this.height = Math.sqrt(area);
   }
}

let square1 = new Sqare(4);
console.log(square1.area); // getter
square1.area = 3; // setter
console.log(square1.area); // getter
```



### Javascript Tutorial - Array Map
#### https://www.youtube.com/watch?v=cmgvB4wEkf8
```

let num = [1,2,3];
let mapArr = num.map(n => n *2); // ES6
let mapArr = num.map(function(n){ return n * 2; }); // ES5
```

---------------------------------------
### Javascript Tutorial - Array Reduce
#### https://www.youtube.com/watch?v=wM6WkVNMDuI

```
let num = [1,2,3];
let total = num.reduce(function(acc,cur){ return acc + cur; });
```

---------------------------------------
### Javascript Tutorial - Extending the Prototype
#### https://www.youtube.com/watch?v=TUJI3CVU1Pk
```

let f = 140; // fahrenheit
Number.prototype.toCelcius = function(){ return (this - 32) * 5/9  }  // extend Number prototype
f.toCelcius();
```

---------------------------------------
### JavaScript Getters and Setters | Mosh
#### https://www.youtube.com/watch?v=bl98dm7vJt0
```

const person = {
   fname: 'Jeff',
   lname: 'Harry',
   get fullName(){
      reture `${person.fname}`;
   }
   set fullName(value){
      const parts = value.split(' ');
      this.fname = parts[0];
      this.lname = parts[1];
   }
};
console.log(`${person.fname}`);
person.fullName = "Jim Spencer";
```


---------------------------------------
### JavaScript Object Property Descriptors
https://www.youtube.com/watch?v=LD1tQEWsjz4
https://gist.github.com/prof3ssorSt3v3/b38039f992f9ab37f1e4c11350dbf65d
```

/***************************************
Property Descriptors Methods and Usage
Object.defineProperty(obj, propName, {} )
Object.defineProperties(obj, props)
Object.getOwnPropertyNames(obj)
Object.getOwnPropertyDescriptor(obj, prop)
Object.getOwnPropertyDescriptors(obj)
Object.keys(obj) - list of enumerable properties
Object.values(obj) - list of enumerable prop values
obj.propertyIsEnumerable(prop)
obj.hasOwnProperty(prop)
Objects can be
1. Extensible - new properties added
2. Frozen - props cannot be changed in any way
3. Sealed - props can't be deleted or configured
          but are still writable
Object PROPERTIES can be
1. Writable - change the value
2. Enumerable - seen through a for...in loop
3. Configurable - change the property descriptors
Object.isExtensible(obj)
Object.isFrozen(obj)
Object.isSealed(obj)
Object.preventExtensions(obj)
Object.freeze(obj)
Object.seal(obj)
Descriptor Groups
DATA            ACCESSOR
value           get
writable        set
configurable    configurable
enumerable      enumerable
****************************************/
let log = console.log;
let obj = {
    name: 'Bob',
    age: 45
};
Object.defineProperty(obj, 'test', {
    value: 'Shagadelic',
    writable: true,
    configurable: true,
    enumerable: false
} );

Object.defineProperty(obj, 'frank', {
   configurable:true,
    enumerable: true,
    get: () => this.value,
    set: (_val) => {
        this.value = _val + " baby!";
    }
});



for( let prop in obj){
    log(prop);
}
log( obj, obj.test, obj.frank );
obj.frank = 'Shagadelic';
log(obj.frank);
```




---------------------------------------
### JavaScript Object keys, values, and entries methods
https://www.youtube.com/watch?v=VmicKaGcs5g
https://gist.github.com/prof3ssorSt3v3/b3779e85e74ecd8b2ba0dec1e7dd6ae6
```


/**********************************
Object.keys(obj)
Object.values(obj)
Object.entries(obj)
Create an iterable object from the Object
**********************************/

let westeros = {
    cersei: 'Lannister',
    arya: 'Stark',
    jon: 'Snow',
    brienne: 'Tarth',
    daenerys: 'Targaryen',
    theon: 'Greyjoy',
    jorah: 'Mormont',
    margaery: 'Tyrell',
    sandor: 'Clegane',
    samwell: 'Tarly',
    ramsay: 'Bolton'
}

//for(let prop of arr)
// foreach( )  filter( ) map() reduce()

let keys = Object.keys(westeros);
//console.log('Keys ', keys);
let vals = Object.values(westeros);
//console.log('Vals', vals);
let entries = Object.entries(westeros);
console.log('Entries', entries);
console.log( entries[2][1] );
```


---------------------------------------
### JavaScript Tip: Understanding the Mutability of JavaScript Objects
https://www.youtube.com/watch?v=HE6KfMSTHKE
```
const obj = { number: 10 };
contt obj1 = obj;
obj.number++;
```


---------------------------------------
### Sort DIVs alphabetically without destroying and recreating them?
```
https://stackoverflow.com/questions/31266660/sort-divs-alphabetically-without-destroying-and-recreating-them

http://jsfiddle.net/hibbard_eu/C2heg/
https://jsfiddle.net/hibbard_eu/C2heg/


$('.sortme').sort(function(a, b) {
  if (a.textContent < b.textContent) {
    return -1;
  } else {
    return 1;
  }
}).appendTo('body');

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<div class='sortme'>
  CCC
</div>
<div class='sortme'>
  AAA
</div>
<div class='sortme'>
  BBB
</div>
<div class='sortme'>
  DDD
</div>
```




###Disable initial sorting for jquery DataTables?


```
https://stackoverflow.com/questions/4964388/is-there-a-way-to-disable-initial-sorting-for-jquery-datatables

$(document).ready( function() {
    $('#example').dataTable({
        /* Disable initial sort */
        "aaSorting": []
    });
})

# For newer versions of Datatables (>= 1.10) use order option:
$(document).ready( function() {
    $('#example').dataTable({
        /* No ordering applied by DataTables during initialisation */
        "order": []
    });
})
```


### Datatables sort numbers is not working properly

```
https://stackoverflow.com/questions/20273325/datatables-sort-numbers-is-not-working-properly
https://stackoverflow.com/questions/16832139/jquery-datatable-sorting-numeric-value-column-not-working-properly/16832408

<table .....>
  <tbody>
    <tr>
      <td><span>1</span></td>
    </td>
    ....
  </tbody>
</table>


$(document).ready(function () {
  $('#ctl00_ContentPlaceHolder1_GridView3').dataTable({
      "aaSorting": [[ 9, "asc"]], /*row count starts from 0 in datatables*/
      "bJQueryUI": true,
      "sPaginationType": "full_numbers"
     // "aoColumnDefs": [{ "sType": "numeric", "aTargets": [9] }]

     });
});
```




### positioning datapicker
```
# html5
<div class="spacer"></div>
<input type="text"  id="myDatePicker">  Focus
<div class="spacer"></div>
<input type="text" id="datepicker1"> Focus me!
<input type="text" id="datepicker2"> Focus me too! <br>
<div class="spacer"></div>
<!-- https://codepen.io/Bes7weB/pen/ypPobJ -->
<!-- https://eonasdan.github.io/bootstrap-datetimepicker/Options/ -->


# js

$(function() {
  $("#myDatePicker").datepicker({
    onSelect: function(date) {
      $("#myDate").val(date);
      $("#myDatePicker").hide();
    }
  }).position({
    my: "left top",  at: "left bottom", of: $("#myDate"), collision: "none"
  }).hide();
});
$("#datepicker1").datepicker({ popup: { position: "bottom left", origin: "top left"  } });

$("#datepicker2").datepicker({ orientation: "bottom" });
// Nothing related to the issue...
// Just to on load scroll to the datepicker inputs.
$(document).ready(function(){
  var viewport = $(window).height();
  var dp_pos = $("#datepicker1").position().top;
  var dp_height = $("#datepicker1").outerHeight();
  $("html,body").scrollTop(dp_pos - viewport + dp_height);
});

#css

.spacer{
  height:50px;
}
input{
  margin-left: 2em;
}
```



### Uncaught TypeError: value.split is not a function
#### FIX: use toString() / toDateString()

```

console.log(typeof document.location);
string = document.location.href;
arrayOfStrings = string.toString().split('/');

alert(typeof latlong);
var latlongpieces = latlong.toString().split(",");
var latitude = latlongpieces[0];
var longitude = latlongpieces[1];

var date = new Date();
var claimedDate = new Date(date.setDate(date.getDate()-1)) ;
var todaysDate = new Date()
// converting toString and splitting up
claimedDate = claimedDate.toDateString().split(" ");
todaysDate = new Date().toDateString().split(" ");
// result date with array of Day, MonthName, Date and Year
console.log("claimed date", claimedDate)
console.log("todays date", todaysDate)
```




###  scroll into view

```

Element.scrollIntoView()
https://developer.mozilla.org/de/docs/Web/API/Element/scrollIntoView

var element = document.getElementById("box");
element.scrollIntoView();
element.scrollIntoView(false);
element.scrollIntoView({block: "end"});
element.scrollIntoView({block: "end", behavior: "smooth"});
```


### textarea reset

```

<form action="">
 <textarea" id="bin" name="bin"></textarea><br>
 <input type="reset" value="Reset">
 <input type="submit" value="Submit">
</form>

$(function () {
    $('input[type=reset]').click(function () {
        $('#bin').val('');
    });
});
```



### reset multiples textareas (jQuery)
```

https://stackoverflow.com/questions/6201676/iterating-through-all-textareas-with-javascript-jquery

$(function(){
    $("textarea").each(function(){
	// this.value = this.value.replace("AFFURL",producturl);
	$(this).text(""); // reset fields
    });
});
```




###  selectors
```

https://api.jquery.com/first/
https://developer.mozilla.org/de/docs/Web/CSS/:first-child
https://developer.mozilla.org/de/docs/Web/API/Document/querySelector
https://api.jquery.com/category/selectors/

$("[id^=jander]")
$("[id$=jander]")
```



### css nth-child
```
https://developer.mozilla.org/de/docs/Web/CSS/:nth-child
https://www.w3schools.com/cssref/sel_nth-child.asp

p:nth-child(2) {
  background: red;
}

$('li:nth-child(2) a').click();
```


### DataTables add new row
```
https://datatables.net/
https://datatables.net/examples/api/add_row.html

$('#example').DataTable().row.add( ['col_1','col_2'] ).draw( false );
```



### jQuery.parseJSON vs JSON.parse
```
https://stackoverflow.com/questions/10362277/jquery-parsejson-vs-json-parse
https://api.jquery.com/jQuery.parseJSON/
https://api.jquery.com/jquery.parsejson/
https://caniuse.com/?search=json
https://github.com/douglascrockford/JSON-js
https://www.learningjquery.com/2016/12/jquery-parsejson-vs-json-parse
https://github.com/bigskysoftware/intercooler-js/issues/260
https://developer.mozilla.org/de/docs/Web/JavaScript/Reference/Global_Objects/JSON/parse
https://demos.jquerymobile.com/1.0a1/experiments/api-viewer/docs/jQuery.parseJSON/index.html

jQuery.parseJSON deprecation

use JSON.parse


Method of converting JavaScript objects to JSON strings and JSON back to objects using JSON.stringify()
and JSON.parse()

Where the browser provides a native implementation of JSON.parse, jQuery uses it to parse the string.

jQuery will use the native JSON.parse method if it is available, and otherwise it will try to evaluate
the data with new Function, which is kind of like eval.

JSON.parse() is natively available on some browsers, not on others

As of jQuery 3.0, $.parseJSON is deprecated. To parse JSON objects, use the native JSON.parse method instead.

JSON.parse() and jQuery.parseJSON(), both are used to parse a JSON string and returns
resulting JavaScript value or object described by the string.
jQuery.parseJSON() is available only when jQuery library is used where JSON.parse() is
JavaScript's standard built-in JSON object method.
```



### jquery removeData
```

https://api.jquery.com/jquery.removedata/
https://api.jquery.com/removedata/

$( "div" ).removeData( "test1" );
```


### Autosize Bootstrap Textarea
```

https://jsfiddle.net/djibe89/bofcrp8v/
https://bootsnipp.com/snippets/P351
https://gist.github.com/borisreitman/d0a87f624238c29a5f5b9f2a61ea37ae
https://codepen.io/vsync/pen/czgrf
https://mdbootstrap.com/snippets/jquery/piotr-glejzer/131442#js-tab-view


jQuery.fn.extend({
  autoHeight: function () {
    function autoHeight_(element) {
      return jQuery(element).css({
        'height': 'auto',
        'overflow-y': 'hidden'
      }).height(element.scrollHeight);
    }
    return this.each(function () {
      autoHeight_(this).on('input', function () {
        autoHeight_(this);
      });
    });
  }
});
$('#exampleFormControlTextarea11').autoHeight();
```



### html select only one checkbox in a group
https://stackoverflow.com/questions/9709209/html-select-only-one-checkbox-in-a-group
```

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

$("input:checkbox").on('click', function() {
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[name='" + $box.attr("name") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});
```



### chrome benchmark cpu test
```
https://www.chromium.org/developers/design-documents/process-models
http://hassansin.github.io/shared-event-loop-among-same-origin-windows

function longrunning(){
    for (let i=0; i<10000000000; i++);
}
```


### 5 Must-Know JavaScript Features That Almost Nobody Knows - Web Dev Simplified
```
https://www.youtube.com/watch?v=v2tJ3nzXh8I
https://www.youtube.com/watch?v=y17RuWkWdn8

# check vars
string = string ?? null;

# debug with css colors and bold fonts
console.log(%c var1, %c var2 ,"font-weight: bold"," color:red")

# debug
console.log(var1?.var2?.var3)

# load and run
<script src="some.js" defer><script>

# retrieve all data info
dataset

# add/remove
classList.add/remove
```



### js data calculation
```
https://www.w3schools.com/jsref/jsref_obj_date.asp
https://developer.mozilla.org/de/docs/Web/JavaScript/Reference/Global_Objects/Date/setHours
https://developer.mozilla.org/de/docs/Web/JavaScript/Reference/Global_Objects/Date
https://css-tricks.com/everything-you-need-to-know-about-date-in-javascript/
https://stackoverflow.com/questions/3552461/how-to-format-a-javascript-date
https://developer.mozilla.org/de/docs/Web/JavaScript/Reference/Global_Objects/Date/toLocaleDateString
https://stackoverflow.com/questions/12805981/get-last-week-date-with-jquery-javascript/12806057



	//const event = new Date();
	//event.setFullYear(2020)
	//event.setHours(20);

	let lastmonth = new Date();
	lastmonth.setMonth(lastmonth.getMonth()-1);

	let lastyear = new Date();
	lastyear.setFullYear(lastyear.getFullYear()-1);

	let lastweek = new Date(new Date().getTime() - 7 * 24 * 60 * 60 * 1000);
	let lastweek2 = new Date();
	lastweek2.setDate(new Date().getDate() - 7);


	//let options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
	let options = { year: 'numeric', month: '2-digit', day: '2-digit' };
	let now = new Date();

	console.log("claimed date", now.toDateString().split(" ")); /* [0: "Wed" , 1: "May" ,2: "27" , 3: "2020"] */
	console.log(new Date().getTime()); // 1622122329552
	let nowformat = now.getDate() + "-" + now.getMonth() + "-" + now.getFullYear();
	console.log(nowformat); // 27-4-2021

	console.log(now.toLocaleDateString("en-GB")); // 27/05/2021
	console.log(now.toLocaleDateString("de-DE",options)); // 27.05.2021
	console.log(lastmonth.toLocaleDateString("de-DE",options)); // 27.04.2021
	console.log(lastyear.toLocaleDateString("de-DE",options)); // 27.05.2020
	console.log(lastweek.toLocaleDateString("de-DE",options)); // 20.05.2021
	console.log(lastweek2.toLocaleDateString("de-DE",options)); // 20.05.2021



/*

Options key examples:

day: The representation of the day. Possible values are "numeric", "2-digit".
weekday: The representation of the weekday. Possible values are "narrow", "short", "long".
year: The representation of the year. Possible values are "numeric", "2-digit".
month: The representation of the month. Possible values are "numeric", "2-digit", "narrow", "short", "long".
hour: The representation of the hour. Possible values are "numeric", "2-digit".
minute: The representation of the minute. Possible values are "numeric", "2-digit".
second: The representation of the second.
Possible values are "numeric", 2-digit".

*/
```



### vanilla-javascript change
```
https://stackoverflow.com/questions/24172963/jquery-change-method-in-vanilla-javascript

document.querySelector('#Email').addEventListener('change',function(){
    document.querySelector('#UserName').value = this.value;
});
```



### switch
```
https://developer.mozilla.org/de/docs/Web/JavaScript/Reference/Statements/switch

switch (expr) {
  case "Mangoes":
  case "Papayas":
    console.log("Mangoes and papayas are $2.79 a pound.");
    break;
  default:
    console.log("Sorry, we are out of " + expr + ".");
}

console.log("Is there anything else you'd like?");
```


### get max min array
```

https://medium.com/coding-at-dawn/the-fastest-way-to-find-minimum-and-maximum-values-in-an-array-in-javascript-2511115f8621

const array = [37,-5,-15,-37,5,15]
const min = array[0]
const max = array[array.length-1]
```



### timestamp data compare
```
https://stackabuse.com/compare-two-dates-in-javascript/
https://www.w3resource.com/javascript-exercises/javascript-date-exercise-5.php
https://stackoverflow.com/questions/5619202/converting-a-string-to-a-date-in-javascript


// Ex 1
// get date object from string
var st = "26.04.2013";
var pattern = /(\d{2})\.(\d{2})\.(\d{4})/;
var dt = new Date(st.replace(pattern,'$3-$2-$1'));

// Ex 2
// compare dates by timestamp
let dateTo = "11.11.2022"
let timeStampNow = new Date().getTime();
const pattern = /(\d{2})\.(\d{2})\.(\d{4})/;
let timeStampSel = new Date(dateTo.replace(pattern,'$3-$2-$1')).getTime(); // get date object from string
// set date to
if (!isNaN(timeStampSel) && timeStampNow < timeStampSel) {
    let dateNow = new Date();
    let options = { year: 'numeric', month: '2-digit', day: '2-digit' };
    document.querySelector('#someid').value = dateNow.toLocaleDateString("de-DE", options);
} else {
    document.querySelector('#someid').value = dateTo;
}
```


### search string
```
https://developer.mozilla.org/de/docs/Web/JavaScript/Reference/Global_Objects/Array/indexOf

if ($(this).val().indexOf(";") !== -1) {
	// do something
}
```


### selectors jquery vanilla-js
```
https://stackoverflow.com/questions/4781420/set-the-default-value-in-dropdownlist-using-jquery
https://stackoverflow.com/questions/17497662/natively-set-html-select-element-to-its-default-value
https://developer.mozilla.org/de/docs/Web/API/Document/querySelector
https://developer.mozilla.org/de/docs/Web/API/Document/querySelectorAll
https://developer.mozilla.org/de/docs/Web/JavaScript/Reference/Global_Objects/undefined

$('select option[value="1"]').attr("selected",true);
$('select option:contains("it\'s me")').prop('selected',true);

$('select').val('1'); // selects "it's me"
$('select').val("it's me"); // also selects "it's me"

or

document.querySelector('option[selected]').selected = true;
# document.forms[0].reset();

or

// Set default value
var defaultValue = 0;
// Get Select Object
const select = document.getElementById('mySelect');
// "Reset" selected value
select.options[defaultValue].selected = true;
```


### Changing selection in a select with the Chosen plugin
```


https://stackoverflow.com/questions/8980131/changing-selection-in-a-select-with-the-chosen-plugin
https://harvesthq.github.io/chosen/
https://github.com/harvesthq/chosen
https://julesjanssen.github.io/chosen/
https://plugins.jquery.com/chosen/
https://harvesthq.github.io/chosen/

$('#select-id').val("22").trigger('chosen:updated');
$('#documents').val(["22", "25", "27"]).trigger('chosen:updated');
```