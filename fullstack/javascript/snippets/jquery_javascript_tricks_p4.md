

######
###	sidebar ? re-init
######
```
http://ace.jeka.by/
http://acquacleanpiscinas.com.br/public/docs/#basics/sidebar
http://acquacleanpiscinas.com.br/public/docs/#basics/sidebar
http://rpo.wrotapodlasia.pl/docs/sections/settings/index.html
http://www.bvbcode.com/code/4rst8ieb-2071114
http://www.codeforge.com/read/302488/ace.submenu-hover.js__html
http://www.codeforge.com/read/313626/ace.sidebar.js__html
https://cdnjs.com/libraries
https://getbootstrap.com/docs/3.4/javascript/
https://github.com/bf914/ACE/blob/a44417867ffda45e5814edf022ba0e9c21df282f/assets/js/ace-extra.js
https://github.com/bf914/ACE/blob/a44417867ffda45e5814edf022ba0e9c21df282f/assets/js/ace/ace.settings.js
https://github.com/bf914/ACE/blob/a44417867ffda45e5814edf022ba0e9c21df282f/mustache/app/views/assets/scripts/index.js
https://github.com/bf914/ACE/blob/master/assets/js/ace/ace.settings.js
https://github.com/bf914/ACE/tree/master/assets/js/ace
https://github.com/bopoda/ace
https://github.com/bopoda/ace/blob/master/top-menu.html
https://github.com/firefox-devtools/debugger
https://github.com/hrmSms/hrm/blob/master/src/main/webapp/shared/ace-settings-box.html
https://github.com/neilgao000/pro-admin/blob/master/assets/js/ace/ace.sidebar.js
https://github.com/nurisakbar/codeigniter-template-aceadmin/tree/master/aceadmin/assets/js
https://github.coventry.ac.uk/liur16/340CT/tree/cd6d7811f4eb2748313a448e010956a17308e5cb/apache-tomcat-7.0.57-windows-x64/apache-tomcat-7.0.57/webapps/inventory/static/ace
https://github.coventry.ac.uk/liur16/340CT/tree/cd6d7811f4eb2748313a448e010956a17308e5cb/FHADMINM_inventory/WebRoot/static/html_UI/assets/js
https://gitlab.tpu.ru/oic/yii2-tpuapptemplate/tree/66af8d3b65584a5a1157057342d674dc24dfadc3/backend/themes/ace/js
https://splashtours.ae/docs/sections/changes/
https://splashtours.ae/docs/sections/settings/
https://www.prignitz-bus.de/template/ace/assets/js/uncompressed/
https://www.prignitz-bus.de/template/ace/assets/js/uncompressed/ace.js

$('#sidebar').addClass('collpase navbar-collapse');

let $sidebar = $('.sidebar');
if($.fn.ace_sidebar) $sidebar.ace_sidebar();
$sidebar.ace_sidebar_hover({
	'sub_hover_delay': 750,
	'sub_scroll_style': 'no-track scroll-thin scroll-margin scroll-visible'
});

ace.settings.loadState('sidebar', 'minimized')
ace.helper.getAttrSettings('.sidebar',{ /**/ minimized:true });
try { ace.settings.check('sidebar', 'fixed') } catch (e) { }

$('#sidebar').ace_sidebar({ /**/sidebar_collapsed:true});
$('#sidebar').ace_sidebar();
$('#sidebar').ace_sidebar_hover({ /* */ sub_hover_delay: 750});
$('#sidebar').ace_scroll({ /* */ size: 850});
```

######
###	Clone Dom jQuery 2.2.4 / 3.2.1 - Test https://jsfiddle.net/
######
```
<div class="js-source">   aaaa </div>
<div class="js-destination">   ? </div>
<div class="js2-source">   bbb </div>
<div class="js2-destination">   ???? </div>
<button type="button" id="doClone">clone</button>

<!--
https://api.jquery.com/clone/
https://api.jquery.com/empty/
https://css-tricks.com/snippets/javascript/random-hex-color/
https://forum.jquery.com/topic/cloned-dom-objects-losing-event-listeners-after-replacewith
https://pawelgrzybek.com/cloning-dom-nodes-and-handling-attached-events/
http://jsfiddle.net/1o8jk4pf/2/
https://mkyong.com/jquery/jquery-clone-example/
https://www.geeksforgeeks.org/jquery-clone-with-examples/
https://github.com/jquery/jquery/issues/1973
-->

<script>
	// using cloneNode()
	/*const sourceElement = document.querySelector('.js-source');
	const destination = document.querySelector('.js-destination');
	const copy = sourceElement.cloneNode(true);
	destination.appendChild(copy);*/

	// using importNode()
	const sourceElement = document.querySelector('.js-source');
	const destination = document.querySelector('.js-destination');
	const copy = document.importNode(sourceElement, true);
	destination.appendChild(copy);

	$(function($){
		let sourceElement = $('.js2-source').clone(true,true);
		let destination = $('.js2-destination');
		$('.js2-source').click(function(){
	  	var randomColor = Math.floor(Math.random()*16777215).toString(16);
	  		$(this).css("color","#" + randomColor);
	  });
	  $('#doClone').click(function(){
			//destination.html(sourceElement);
		sourceElement = $('.js2-source').clone(true,true);
		//sourceElement.data('clickEvent',sourceElement.onclick);
			sourceElement.data('clickEvent',this.onclick);
	  	destination.prepend(sourceElement);
	  });
	  //destination.html(sourceElement)
	  //destination.prepend(sourceElement)
	});
</script>
```


######
#	Clone Dom Element into the same Element
######
```
https://codepen.io/susanwinters/pen/gadgGY
https://api.jquery.com/clone/
https://developer.mozilla.org/de/docs/Web/API/ChildNode/remove
https://davidwalsh.name/javascript-clone
https://developer.mozilla.org/de/docs/Web/API/Node/cloneNode
https://www.w3schools.com/jsref/met_node_clonenode.asp
https://api.jquery.com/insertAfter/

$('#some-id-input').click(function(){
	// clone element
	let objCloned = $('.some-list').clone(true,true);
	$('.some-list').remove();
	$('#prev-element-before-list').after(objCloned)
});

/*
function clone (src) {
    return JSON.parse(JSON.stringify(src));
}
*/
```

######
### 	Using debugger in Chrome Devtools
######
```
https://stackoverflow.com/questions/28388530/why-does-chrome-debugger-think-closed-local-variable-is-undefined
https://jsfiddle.net/

function baz() {
  var x = "x value";
  var z = "z value";
  function foo () {
    console.log(x);
  }
  function bar() {
    debugger;
  };
  bar();
}
baz();
```


######
###   TypeError: Cannot read property 'msie' of undefined
####   The $.browser method has been removed as of jQuery 1.9.
######
```
https://plugins.jquery.com/jqModal/
http://jquery.iceburg.net/jqModal/
http://jquery.iceburg.net/jqModal/jqModal.js
http://jquery.iceburg.net/jqModal/jqModal.css
https://github.com/jquery/jquery-migrate/

https://github.com/briceburg/jqModal/blob/master/jqModal.js
https://github.com/gocept/jquery.jqmodal
```

######
###   Read Element Index
######
```
https://api.jquery.com/jquery.inarray/
https://api.jquery.com/index/
https://api.jquery.com/eq/

$('#list li').click(function() {
    console.log($(this).attr("id"));
    console.log($(this).text());
    console.log($(this).index());
});
```

######
###	DevTools errors
######
```
-----------------------------------------------------------------
DevTools failed to parse SourceMap: jquery.min.map ?
-----------------------------------------------------------------
-----------------------------------------------------------------
[Violation] Forced reflow while executing JavaScript took 40ms ?
-----------------------------------------------------------------
-----------------------------------------------------------------
[Violation] 'DOMContentLoaded' handler took 237ms ?
-----------------------------------------------------------------
jquery-X.X.X.min.js:3 Unable to preventDefault inside passive event listener invocation.
-----------------------------------------------------------------
jquery-X.X.X.min.js:3 [Violation] Added non-passive event listener to a scroll-blocking 'touchstart' event.
Consider marking event handler as 'passive' to make the page more responsive. See https://www.chromestatus.com/feature/5745543795965952
-----------------------------------------------------------------
```

######
###   JavaScript DOM Crash Course Traversy Media
######
```
https://www.youtube.com/watch?v=0ik6X4DJKCc
https://www.youtube.com/watch?v=mPd2aJXCZ2g
https://www.youtube.com/watch?v=wK2cBMcDTss
https://www.youtube.com/watch?v=i37KVt_IcXw

document.domain
document.URL
document.title
document.doctype
document.head
document.body
document.all
document.forms
document.links
document.images

document.getElementById()
document.getElementsByClassName()
document.getElementsByTagName()
document.querySelector()
document.querySelectorAll()

00:23 Traversing the DOM Introduction
01:18 Parents
01:18         .parentNode
04:03         .parentElement
04:48 Children
04:48         .childNodes
06:36         .children
08:03         .firstChild
08:58         .firstElementChild
09:38         .lastChild & .lastElementChild
10:37 Siblings
10:37         .nextSibling
11:17         .nextElementSibling
12:04         .previousSibling
12:31         .previousElementSibling
14:12 Create Elements
14:30         .createElement()
16:50         .createTextNode()
17:27         .appendChild()
17:59 Insert Created Elements Into the DOM
18:12         .insertBefore()

var btn = document.getElementById('button').addEventListener('click',btnClick);

function btnClick(e){
	e.target
	e.target.id
	e.target.className
	e.target.classList
	e.type
	e.clientX
	e.clientY
	e.altKey
	e.ctrlKey
	e.shiftKey
	e.offsetX
}
```

######
###	jQuery Hash selector compatibility syntax
######
```
https://code.jquery.com/jquery/
https://jquery.com/download/
https://jsfiddle.net/
https://github.com/jquery/jquery/issues/3085
https://github.com/jquery/jquery/issues/3063
https://api.jquery.com/id-selector/
https://api.jquery.com/attribute-starts-with-selector/
https://www.w3schools.com/jquery/sel_attribute_end_value.asp
https://www.tutorialspoint.com/How-to-write-a-jQuery-selector-to-find-links-with-hash-in-href-attribute

<a data-toggle="tab" href="group-tab">test</a>

$(function(){
  $('[href=#group-tab]').click(); 	// valid jQuery 2.1.4
  $('[href="#group-tab"]').click();	// valid jQuery 2.2.3
});
```

######
### 	Select input data for ajax call
######
```
https://stackoverflow.com/questions/2295496/convert-array-to-json
https://www.w3schools.com/js/js_json_parse.asp
https://www.w3schools.com/js/js_json_stringify.asp
https://www.w3schools.com/js/js_json_arrays.asp
https://stackoverflow.com/questions/191881/serializing-to-json-in-jquery
https://developer.mozilla.org/de/docs/Web/JavaScript/Reference/Global_Objects/Date/toJSON
https://developer.mozilla.org/de/docs/Web/JavaScript/Reference/Global_Objects/JSON/stringify
https://javascript.info/json
https://developer.mozilla.org/de/docs/Web/JavaScript/Reference/Global_Objects/Date/toJSON
https://developer.mozilla.org/de/docs/Web/JavaScript/Reference/Global_Objects/JSON/stringify
https://www.w3schools.com/jsref/jsref_tojson.asp


$('#someIs').click(function () {

	let objFormData =  {
		var1: $('[name=var1]').val(),
		var2: $('[name=var2]').val(),
		var3: $('[name=var3]').val(),
	};

	console.log(objFormData);
//	let strJson = $.toJSON(  objFormData  ); // jquery json
	let strJson = JSON.stringify({  objFormData })
	xajax_SomeComponent_xSomeMethod(strJson);


	$.ajax({
		url: location.href,
		data: {
			var1:  $('[name=var1]').val(),
			var2:  $('[name=var2]').val(),
			var3:  $('[name=var3]').val(),
		},
		dataType: "json",
		type: "POST",
		timeout: 25,
		success: function (data) {
			// do somethings
		},
		error: function (jqXHR, timeout, message) {
			// window.location.reload();
		}
	});

});
------------------------------------

var jsonArg1 = new Object();
    jsonArg1.name = 'calc this';
    jsonArg1.value = 3.1415;
var jsonArg2 = new Object();
    jsonArg2.name = 'calc this again';
    jsonArg2.value = 2.73;

var pluginArrayArg = new Array();
    pluginArrayArg.push(jsonArg1);
    pluginArrayArg.push(jsonArg2);

var jsonArray = JSON.parse(JSON.stringify(pluginArrayArg))
var myJsonString = JSON.stringify(pluginArrayArg);
------------------------------------
json = { ...array };
json = Object.assign({}, array);
json = array.reduce((json, value, key) => { json[key] = value; return json; }, {});
------------------------------------

Use native JSON.stringify and JSON.parse instead, or json2.js
https://github.com/krinkle/jquery-json

var myObj = {foo: "bar", "baz": "wockaflockafliz"};
$.toJSON(myObj);

------------------------------------
https://jsfiddle.net/boilerplate/jquery
https://developer.mozilla.org/de/docs/Web/JavaScript/Reference/Global_Objects/Array/map
https://developer.mozilla.org/de/docs/Web/JavaScript/Reference/Global_Objects/Map
https://www.w3schools.com/jsref/jsref_map.asp
https://stackoverflow.com/questions/25369893/mapping-checkbox-values-to-an-empty-array
http://jsfiddle.net/slippery_pete/ddpnhww5/1/


<ul>
  <li><input type="checkbox" name="samovar[]" value="111"/>  </li>
  <li><input type="checkbox" name="samovar[]" value="222"/>  </li>
  <li><input type="checkbox" name="samovar[]" value="333"/>  </li>
  <li><input type="checkbox" name="samovar[]" value="444"/>  </li>
</ul>


// find elements v1
let list = $('[name="samovar[]"]');
let arrList = []
list.each(function(index, item) {
  //console.log(item.value)
  arrList.push(item.value)
});
console.log(arrList)
console.log(JSON.stringify({
  'data-list': (arrList)
}))



// find elements v2
var newArray = [];
$('[name="samovar[]"]').map(function(){
    newArray.push($(this).val());
    })
let myObj = {
	'data-list': newArray
}
console.log(newArray)
console.log(myObj)
console.log(JSON.stringify({  myObj }))
```


######
###   Netflix JavaScript Talks - RxJS + Redux + React = Amazing! 25:30 / 31:16
####  https://www.youtube.com/watch?v=AslncyG8whg
######
```
// ping pong
const pingPongEpi = (action$,store) =>
	action.ofType('PING')
	.delay(1000) // or use debounceTime(1000)
	.map(action => ({ type: 'PONG' }));

// auto complete
const autocompleteEpic = (action$,store) =>
	action.ofType('QUERY')
	.debounceTime(1000)
	.switchMap( action =>
		ajax(url)
			.map(payload => ({
				type: 'QUERY_FULFILED',
				payload
			}))
			.takeUntil(action.ofType('CANCEL_QUERY'))
			.catch(payload => [{
				type: 'QUERY_FULFILED',
				payload
			}])

	);
```


######
###	React Component Patterns by Michael Chan
####	https://www.youtube.com/watch?v=YaZg8wg39QQ
######
```
// container component
class SmallCircleInCircle{
	constructor(){
		super()
		this.state = { smarts: "smarts" }
	}

	render(){
		return <SmallCircle {...state} />
	}
}

const SmallCircle = props =>
	<div> { props.smarts} </div>

---------------------------------------

function DottedCircle(AnyCircle){
	return class Circle extends React.Component {
		constructor(){
			super()
			thi.state = { smarts: "smarts" }
		}
		render(){
			return <AnyCircle {...state} />
		}
	}
}

function SmallCircle(props){
	return <div>{props.smarts}</div>
}

var SmallCircleInCircle = DottedCircle(SmallCircle)

---------------------------------------
class Circle extends React.Component {
	constructor(){
		super()
		this.state = { smarts: "smarts" }
	}
	render(){
		return <AnyCircle {...state} />
	}
}

function SmallCircle(props){
	return <div>{ props.smarts}</div>
}

const SmallCircleInCircle =
	<Cicle
		dashedCircle={state => (
			<SmallCircle {...state} />
		)}
	/>
```




######
###   ( map + concat ) values from multiple checkboxes
######
```
<!-- DOM for test -->
 <ul>
   <li>
     <label>
       <input type="checkbox" name="zutat[]" value="salami" checked>
       Salami
     </label>
   </li>
   <li>
     <label>
        <input type="checkbox" name="zutat[]" value="schinken" checked>
        Schinken
     </label>
   </li>
   <li>
     <label>
       <input type="checkbox" name="zutat[]" value="sardellen">
       Sardellen
     </label>
   </li>
 </ul>
 <!--
   References:
   https://jsfiddle.net/boilerplate/jquery
   https://wiki.selfhtml.org/wiki/HTML/Formulare/input/Radio-Buttons_und_Checkboxen
   https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/from
   https://appdividend.com/2017/04/14/array-foreach-map-filter-reduce-concat-methods-in-javascript/
   https://developer.mozilla.org/de/docs/Web/JavaScript/Reference/Global_Objects/Array/flatMap
   https://dev.to/wangonya/better-consolelogs-448c
   https://stackoverflow.com/questions/38598801/map-reduce-is-not-a-function/38598861
   https://stackoverflow.com/questions/21121830/typeerror-this-reduce-is-not-a-function
   https://stackoverflow.com/questions/17069223/concatenate-nested-array-after-mapping

   https://jsonlint.com/
    https://api.jquery.com/serialize/
    https://jsonformatter.curiousconcept.com/
    https://jsonformatter.org/
    https://www.freeformatter.com/json-validator.html
    https://www.jsonschemavalidator.net/
    https://de.piliapp.com/json/validator/
    https://jsoneditoronline.org/

 -->


console.clear()

// let x = $('input[name="zutat[]"]:checked').map(function(item){ return {value:item => item.val()}  } );
// console.table(x);
// let y = $('input[name="zutat[]"]:checked').map(function(item){ item => item.val(); } );
// console.table(y);
// var z = Array.from($('input[name="zutat[]"]:checked')).map(function(item,dex) {  return {index:dex,value:item.value} });
// console.table(z);

var w = Array.from($('input[name="zutat[]"]:checked')).map(function(item) {  return {value:item.value} });
console.table(JSON.stringify(w));
var v = Array.from($('input[name="zutat[]"]:checked')).map(function(item) {  return item.value });
console.table(JSON.stringify(v));
let zz = $('input[name="zutat[]"]:checked').toArray().map( (dex,item) => dex.value ).reduce( (prev, next) => prev + ' '+ next, 0 );
console.table(zz);

[{"value":"salami"},{"value":"schinken"}]
["salami","schinken"]
0 salami schinken
...
```


######
###  each
######
```
const arr = [10000000];
console.time('str');
for(const v of arr){}
arr.forEach(v => null)
arr.map( v => v ).map ( v => v).forEach( v => v )
console.timeEnd('str');

for(const key in loop){ console.log(loop[key]) }
for(const key in Object.values(loop)){ console.log(key) }

const arr = new Map(  Object.entries({1:"1",2:"2",3:"3"})  )
for(const v in loop.values){ console.log(v) }

const arr = arr.filter(v => v === 'str')
const arr = arr.map( v => 'str')
const arr = arr.some(v => v === 'str')
const arr = arr.every(v => v === 'str')
const arr = arr.reduce((acc,cur) => {  return acc + cur },0)
```




######
### JavaScript Classes
#### https://www.youtube.com/watch?v=fQ1oNTRdByA
######
```
class Person{
	constructor (_name, _age){
  	this.name = _name
    this.age = _age
  }
  describe (){
  		console.log("show " + this.name)
  }
}

class Manager extends Person {
	constructor (_name, _age,_job){
  	super(_name,_age);
    this.job = _job
  }
  code(){
  	console.log(this.name + ' called')
  }
}

let pers1 = new Person('Josh',55);
let pers2 = new Manager('Sven',35,'Worker');
//console.clear()
//console.time()
console.log([pers1,pers2]);
//console.timeEnd()
pers2.code();

const progs = [
  new Manager('Aly',33,'Programer'),
  new Manager('Jenny',33,'QA')
];
for (let prog of progs){
		console.log(prog.code())
}
```


######
### JavaScript Classes vs Prototypes
#### https://www.youtube.com/watch?v=XoQKXDWbL1M
#### https://www.youtube.com/watch?v=xizFJHKHdHw
######
```
let Person = function(_name, _age){
	this.name = _name;
  this.age = _age;
}
Person.prototype.getDetails = function(){
	return this.name + ' ' +  this.age;
}
let Employe = function(_name, _age,_score){
	Person.call(this, _name, _age)
  this.score = _score;
}
Object.setPrototypeOf(Employe,Person.prototype) // extend
Employe.prototype.getDetails = function(){
	return this.name + ' ' +  this.age + ' ' +  this.score;
}
let pers1 = new Person('Jim',66);
let pers2 = new Employe('Jess',66,899);
console.log(pers1.getDetails())
console.log(pers2.getDetails())

```


######
###   Imperative vs. Declarative Programming (in 60 seconds)
####   https://www.youtube.com/watch?v=JqvMTwnbhnA
######
```
// Imperative
function double1(arr) {
  let results = [];
  for (let i = 0; i < arr.length; + i++) {
    results.push(arr[i] * 2);
  }
  return results;
}
// Declarative
function double2(arr) {
  return arr.map((item) => item * 2)
}
const arrs = [2,3,4];
console.log(double1(arrs))
console.log(double2(arrs))
```

### arrays
```
// https://medium.com/front-end-weekly/es6-set-vs-array-what-and-when-efc055655e1a
// https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Set
// https://stackoverflow.com/questions/1129216/sort-array-of-objects-by-string-property-value?rq=1
// https://stackoverflow.com/questions/9229645/remove-duplicate-values-from-js-array
// https://stackoverflow.com/questions/111102/how-do-javascript-closures-work?rq=1
```
```
//const arr = [4,4,5,6,7,8,9];
//var arr2 = Array.from("123"); //["1","2","3"]
//

var set = new Set([1,2,3]); // {1,2,3}
var arr = Array.from(set);//[1,2,3]
console.log(set);
console.log(arr);

// sort
console.log(  Array.from(new Set(["b","a","c"])).sort() );
console.log(  [...(new Set(["b","a","c"]))].sort() ); // with spread.

// unique
var names = ["Mike","Matt","Nancy","Adam","Jenny","Nancy","Carl"];
uniq = [...new Set(names)];
console.log( uniq );


// sort by prop
var objs = [
    { first_nom: 'Lazslo', last_nom: 'Jamf'     },
    { first_nom: 'Pig',    last_nom: 'Bodine'   },
    { first_nom: 'Pirate', last_nom: 'Prentice' }
];
objs.sort((a,b) => (a.last_nom > b.last_nom) ? 1 : ((b.last_nom > a.last_nom) ? -1 : 0));
console.log( objs );

// How do JavaScript closures work?
function foo() {
  const secret = Math.trunc(Math.random()*100)
  return function inner() {
    console.log(`The secret number is ${secret}.`)
  }
}
const f = foo() // `secret` is not directly accessible from outside `foo`
f() // The only way to retrieve `secret`, is to invoke `f`
```


