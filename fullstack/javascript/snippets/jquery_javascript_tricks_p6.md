

### inArray

```
https://stackoverflow.com/questions/18867599/jquery-inarray-how-to-use-it-right
https://api.jquery.com/jquery.inarray/

var myarray = [ 4, "Pete", 8, "John" ];

if(jQuery.inArray("test", myarray) !== -1){
    // do something
}
```


### removeAttr
```
https://stackoverflow.com/questions/13951336/removing-html5-required-attribute-with-jquery

$('#edit-submitted-first-name').removeAttr('required'); // remove
$('#edit-submitted-first-name').prop('required',true); // enable
$('#edit-submitted-first-name').prop('required',false); // disable
```



### events

```
https://stackoverflow.com/questions/6998534/javascript-event-missing-after-html-reset
https://stackoverflow.com/questions/2398099/jquery-equivalent-of-javascripts-addeventlistener-method
https://api.jquery.com/on/
https://api.jquery.com/bind/
https://developer.mozilla.org/en-US/docs/Web/API/EventTarget/addEventListener
https://www.w3schools.com/js/js_htmldom_eventlistener.asp
https://www.w3schools.com/jsref/met_element_addeventlistener.asp
https://developer.mozilla.org/en-US/docs/Web/API/MediaQueryList/addListener
https://stackoverflow.com/questions/30883651/detach-and-reattach-event-listeners
https://stackoverflow.com/questions/15805000/jquery-change-event-callback
https://www.wissensarchiv.org/lib/exe/fetch.php?media=xajax.pdf
https://github.com/Xajax/Xajax
http://hackergarage.github.io/ThaFrame/xajax/xajax.html
https://github.com/jaxon-php/jaxon-core
https://hotexamples.com/de/examples/-/xajax/registerFunction/php-xajax-registerfunction-method-examples.html
```
```
# works better
$(function(){
    $('#container').delegate('#testbutton', 'click',
        function(){
            alert("Button has been clicked!");
    })
});

# lose event when mixed with xajax
$( "button" ).on( "click", function(event) {
    console.log( event.target );

} );

$(document).on('change', '#element', function(){
    console.log('after all callbacks')
});

document.getElementById("myBtn").addEventListener("click", displayDate);
```



### xajax-execution

```
https://stackoverflow.com/questions/12588359/modify-javascript-function-while-xajax-execution
https://stackoverflow.com/questions/666750/xajax-and-select?rq=1
https://stackoverflow.com/questions/1457293/validating-forms-using-xajax?rq=1

[php]

require_once("Resources/xajax/xajax_core/xajax.inc.php");

$xajax = new xajax();
$xajax->configure( 'javascript URI', 'Resources/xajax/');
$xajax->register(XAJAX_FUNCTION,"foo");
$xajax->processRequest();

function foo()
{
    $response = new xajaxResponse();
    // do something
    $response->call("callbackFoo()",json_encode(array("$param1","$param2")));
    return $response;

}

[/php]


<button onclick="xajax_foo()"></button>
<script>
function callbackFoo(response) {
    let response = $.evalJSON(response);
    console.log(response.param1);
    console.log(response.param2);
}
</script>
```



######
### Learn JavaScript - Full Course for Beginners
#### https://www.youtube.com/watch?v=PkZNo7MFNFg&t=14s
######
```
[beautify js]
https://beautifytools.com/javascript-beautifier.php
https://prettier.io/playground/

[run online code js]
https://playcode.io/new/
https://replit.com/languages/javascript
https://jsfiddle.net/
https://www.typescriptlang.org/play?


// Parameters
const sum = (function() {
	return function sum(...args) { // sum(x,y,z)
		// const args = [x,y,z];
		return args.reduce((a, b) => a + b, 0);
	};
})();
console.log(sum(1, 2, 3));


// Spread Operator
var arr2 = [...arr1]; // copy array

// Destructuring Assignment
var voxel = {
	x: 3,
	y: 6
};
var x = voxel.x;
var y = voxel.y;
const {
	x: a,
	y: b
} = voxel; // asign values

// Destructuring Params
const stats = {
	max: 25,
	min: 3,
	avg: 7
};
const half = (function() {
	return function half({
		max, min
	}) {
		return(max + min) / 2.0;
	};
})();
console.log(half(stats))


// Arrow functions
/*const createPerson = (name, age) => {
	return {
		name: name,
		age: age
	};
};*/
const createPerson = (name, age) => ({
	name, age
});
console.log(createPerson("Hans", 33));


// Classes
class Space {
	constructor(planet) {
		this.planet = planet;
	}

	get name (){
		return this.planet;
	}
	set name (name){
		this.planet = name
	}
}
var jup = new Space('Jupiter');
console.log(jup.planet); // get name
console.log(jup.name); // get name by function
jup.name ='Venus'; // set name by function
console.log(jup.name);


// Declarative functions
// https://www.typescriptlang.org/play
const bicycle = {
	gear: 2,
	setGear: function(newGear: number) {
		"use strict";
		this.gear = newGear;
	}
};
bicycle.setGear(3);
console.log(bicycle.gear);
```


#### Learn JavaScript Generators In 12 Minutes - Web Dev Simplified
```
// https://www.youtube.com/watch?v=IJ6EgdiI_wU&t=478s

// https://onecompiler.com/
// https://jseditor.io/
// https://paiza.io/en/projects/new?language=bash
```
```
function* simpleGenerator(){
	yield 1
	yield 2
	yield 3
}

const gen = simpleGenerator()
console.log(gen)
const value = gen.next();
console.log(value)

// output:
// Object [Generator] {}
// { value: 1, done: false }
```

### 15 Magical JavaScript Tips for Every Web Developer
```
https://dev.to/dawgswqe/15-magical-javascript-tips-for-every-web-developer-1kp4
https://www.codelivly.com/magical-javascript-tips-for-every-web-developer/
```
```

[ Flatten the array of the array ]
var array = [123, 500, [1, 2, [34, 56, 67, [234, 1245], 900]], 845, [30257]]//flatten array of array
array.flat(Infinity)// output:
// [123, 500, 1, 2, 34, 56, 67, 234, 1245, 900, 845, 30257]


[ Easy Exchange Variables ]
//example 1 var a = 6;
var b = 7;[a,b] = [b,a]console.log(a,b) // 7 6


[ Sort alphabetically ]
//sort alphabetically
function alphabetSort(arr)
{
  return arr.sort((a, b) => a.localeCompare(b));
}
let array = ["d", "c", "b", "a"]
console.log(alphabetSort(array)) // ["a", "b", "c", "d"]


[ Create a range of numbers ]
let Start = 1000, End = 1500;
//Generating
[...new Array(End + 1).keys()].slice(Start);
Array.from({length: End - Start + 1}, (_,i) => Start + i) // [1000, 1001 .... 1500]


[ Leave the Array empty ]
let array = ["A", "B", "C", "D", "E", "F"]array.length=0
console.log(array) // []


[ Use isString ]
const isString = vaue => typeof value === 'string';
isString('JavaScript'); // true
isString(345); // false
isString(true); // false


[ Check Null ]
const CheckNull= value => value === null || value === undefined;CheckNull(null) // true
CheckNull() // true
CheckNull(123) // false
CheckNull("J") // false


[ Combine Arrays into One ]
//Example Code
let arr1 = ["JavaScript", "Python", "C++"]
let arr2 = ["Dart", "Java", "C#"]
const mergeArr = arr1.concat(arr2)
console.log(mergeArr) // ["JavaScript", "Python", "C++", "Dart", "Java", "C#"]


[ Performance Quick Calculation ]
const starttime = performance.now();
//some program
const endtime = performance.now();
const totaltime = startTime - endTime
console.log("function takes "+totaltime +" milisecond");


[ Eliminate duplicates ]
const ReDuplicates = array => [...new Set(array)];
console.log(ReDuplicates([200,200,300,300,400,500,600,600])) // [200,300,400,600]
```



### Debugging JavaScript in popup windows on Chrome
```
https://stackoverflow.com/questions/20198821/debugging-javascript-in-popup-windows-on-chrome+
https://stackoverflow.com/questions/4908729/debug-a-modal-dialog-showmodaldialog-in-ie/11097501
https://javascript.info/debugging-chrome
https://developer.chrome.com/docs/devtools/javascript/
```
```
1) add "debugger" in js script
2) enable "DevTools" setting "Auto.open DevTools for popups"

# for source code use "Ctrl + click" instead of just clicking on the link to the popup window.
```

######
### mewe dark mode
######
```
setInterval( () => { document.querySelector('*').style.filter = 'invert(21)'; let list = document.querySelectorAll("img");for (var i = 0; i < list.length; i++) {  list[i].style.filter = 'invert(100)'; } },5000);
```

######
### jquery ui dialog width
######
```
https://www.py4u.net/discuss/918364
https://forum.jquery.com/topic/cannot-call-methods-on-dialog-prior-to-initialization
https://stackoverflow.com/questions/13520139/jquery-ui-dialog-cannot-call-methods-on-dialog-prior-to-initialization
https://www.javatpoint.com/jquery-ui-dialog
https://api.jquerymobile.com/dialog/
https://www.tutorialspoint.com/jqueryui/jqueryui_dialog.htm
https://jqueryui.com/dialog/#modal-confirmation
https://api.jqueryui.com/dialog/#option-width

<script>
jQuery(function() {
	jQuery("#dialog-form").dialog({
	autoOpen: false,
	height: 350,
	width: 450,
});
</script>
```


### Array von Objekten erzeugen

```
https://stackoverflow.com/questions/2799283/use-a-json-array-with-objects-with-javascript/24875753
https://www.mediaevent.de/javascript/array-of-objects.html
https://www.w3schools.com/js/js_json_arrays.asp

var arrayOfObjects = [{
  "id": 28,
  "Title": "Sweden"
}, {
  "id": 56,
  "Title": "USA"
}, {
  "id": 89,
  "Title": "England"
}];

for (var i = 0; i < arrayOfObjects.length; i++) {
  var object = arrayOfObjects[i];
  for (var property in object) {
    alert('item ' + i + ': ' + property + '=' + object[property]);
  }
  // If property names are known beforehand, you can also just do e.g.
  // alert(object.id + ',' + object.Title);
}

$(jQuery.parseJSON(JSON.stringify(dataArray))).each(function() {
    var ID = this.id;
    var TITLE = this.Title;
});
```

###  npm shortcuts
```
https://blog.bitsrc.io/the-most-pertinent-npm-commands-and-shortcuts-you-should-know-as-javascript-developer-d84e34f6fe32

npm install <package-name>@tag
npm install <package-name>@version
npm install <package-name>@version-range
npm install ioredis
npm uninstall <package-name>
npm update
npm audit
npm audit fix
npm audit –json
npm audit –readable
npm prune
```



### Feature detection Sensor APIs concepts and usage

```
device.sensors.enabled
device.sensors.orientation.enabled
device.sensors.motion.enabled

https://developer.mozilla.org/en-US/docs/Web/API/Sensor_APIs#
https://developer.mozilla.org/en-US/docs/Web/API/DeviceMotionEvent
https://www.bleepingcomputer.com/news/software/firefox-gets-privacy-boost-by-disabling-proximity-and-ambient-light-sensor-apis/
https://chromestatus.com/feature/5698781827825664
https://web.dev/generic-sensor/
https://www.w3.org/TR/generic-sensor/#
https://intel.github.io/generic-sensor-demos/
https://www.chromium.org/developers/design-documents/generic-sensor/#
https://developers.google.com/web/fundamentals/native-hardware/device-orientation

if (typeof Gyroscope === "function") {
// run in circles...
}

if ("ProximitySensor" in window) {
// watch out!
}

if (window.AmbientLightSensor) {
// go dark...
}

navigator.permissions.query({ name: 'accelerometer' })
.then(result => {
if (result.state === 'denied') {
console.log('Permission to use accelerometer sensor is denied.');
return;
}
// Use the sensor.
});

const sensor = new AbsoluteOrientationSensor();
sensor.start();
sensor.addEventListener('error', error => {
if (event.error.name === 'SecurityError')
console.log("No permissions to use AbsoluteOrientationSensor.");
});
```

### Boolean
```
https://heyjavascript.com/javascript-string-to-boolean/

if(Boolean(myString)) {}
```

### Arrow functions

```
Array.prototype.forEach()
https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/forEach

// Arrow functions
forEach((element) => { /* ... */ })
forEach((element, index) => { /* ... */ })
forEach((element, index, array) => { /* ... */ })

// Callback function
forEach(callbackFn)
forEach(callbackFn, thisArg)

// Inline callback function
forEach(function(element) { /* ... */ })
forEach(function(element, index) { /* ... */ })
forEach(function(element, index, array){ /* ... */ })
forEach(function(element, index, array) { /* ... */ }, thisArg)


const array1 = ['a', 'b', 'c'];
array1.forEach(element => console.log(element));
```

### includes string
```

https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/includes
https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/includes

// ECMAScript 6
const string = "foo";
const substring = "oo";
console.log(string.includes(substring)); // true

// ECMAScript 5
var string = "foo";
var substring = "oo";
console.log(string.indexOf(substring) !== -1); // true
```

### how+to+compare+key+in+json+object
```

https://www.codegrepper.com/code-examples/javascript/how+to+compare+key+in+json+object
https://stackoverflow.com/questions/26049303/how-to-compare-two-json-have-the-same-properties-without-order

<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

var
remoteJSON = {"allowExternalMembers": "false", "whoCanJoin": "CAN_REQUEST_TO_JOIN"},
    localJSON = {"whoCanJoin": "CAN_REQUEST_TO_JOIN"};
   
console.log( _.isEqual(remoteJSON, localJSON) );

var myString = "Item1";
var jsObject =
{
    Item1:
    {
        "apples": "red",
        "oranges": "orange",
    },
    Item2:
    {
        "bananas": "yellow",
        "pears": "green"
    }
};

var keys = Object.keys(jsObject); //get keys from object as an array
keys.forEach(function(key) { //loop through keys array
  console.log(key, key == myString)
});
```
