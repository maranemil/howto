
### POPUP JS
```
//  http://www.javascriptkit.com/dhtmltutors/ajaxgetpost.shtml
//  https://www.oodlestechnologies.com/blogs/Open-popup-window-with-http-POST-data-Javascript/
//  https://api.jquery.com/jquery.ajax/
```
```
[script]

let url = 'https://example.com/some/url'
var form = document.createElement("form");
form.setAttribute("method", "post");
form.setAttribute("action", url);
form.setAttribute("id", 'actionFormSelect');
var input = document.createElement('input');
     input.type = 'hidden';
     input.name = 'cancel';
     input.value = "Neue Suche";
     form.appendChild(input);
document.body.appendChild(form);
window.open(url);
form.submit();
document.body.removeChild(form);


/*var newpage;
function openWindow() {
    $.post(
    	urlDHL,
      { 'cancel_ta': "Neue Suche"  },
      function(result) {
        newpage = result;
        window.open(urlDHL, 'popUpWindow','height=400, width=650, status=yes');
    });
}

if(window.opener && !window.opener.closed) {
   document.write(window.opener.newpage);
 }*/

/*
$.ajax({
  method: "POST",
  url: urlDHL,
  data: {
  	back_ta: "John",
  	cancel_ta: "Neue Suche" }
})
  .done(function( msg ) {
 	console.debug( msg );
});*/
```





### Warning: Added non-passive event listener to a scroll-blocking 'touchstart' event [duplicate]
```
// https://developers.google.com/speed/docs/insights/browser-reflow
// https://www.chromestatus.com/feature/5745543795965952
```
```

[script]

$(function() {
    jQuery.event.special.mousewheel = {
        setup: function( _, ns, handle ){
            if ( ns.includes("noPreventDefault") ) {
                this.addEventListener("mousewheel", handle, { passive: false });
            } else {
                this.addEventListener("mousewheel", handle, { passive: true });
            }
        }
    };
    jQuery.event.special.touchstart = {
        setup: function( _, ns, handle ){
            if ( ns.includes("noPreventDefault") ) {
                this.addEventListener("touchstart", handle, { passive: false });
            } else {
                this.addEventListener("touchstart", handle, { passive: true });
            }
        }
    };
    jQuery.event.special.touchmove = {
        setup: function( _, ns, handle ){
            if ( ns.includes("noPreventDefault") ) {
                this.addEventListener("touchmove", handle, { passive: false });
            } else {
                this.addEventListener("touchmove", handle, { passive: true });
            }
        }
    };
});
```




### Introducing $(document).ready()
```
https://jquery.com/
https://api.jquery.com/ready/#ready-handler
https://www.learningjquery.com/2006/09/introducing-document-ready
```
```
[script]

(function () { ... })();
$(function() { ... });
$(document).ready(function() { ... });

$( handler )
$( document ).ready( handler )
$( "document" ).ready( handler )
$( "img" ).ready( handler )
$().ready( handler )

///////////////////////////////////////////////
//
// Understanding Objects in JavaScript
//
///////////////////////////////////////////////

https://javascript.info/object
https://www.digitalocean.com/community/tutorials/understanding-objects-in-javascript
https://developer.mozilla.org/en-US/docs/Learn/JavaScript/Objects/Basics
https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Object
https://www.freecodecamp.org/news/a-complete-guide-to-creating-objects-in-javascript-b0e2450655e8/
https://medium.com/front-end-weekly/es6-map-vs-object-what-and-when-b80621932373
https://mariusschulz.com/blog/object-rest-and-spread-in-typescript
https://yehudakatz.com/2011/08/12/understanding-prototypes-in-javascript/

[script]

var person1 = Object.create(null);
let person2 = new Object();
const person3 = {};
person1.name = "alpha"
person2.name = "beta"
person3.name = "teta"
console.log(person1)
console.log(person2)
console.log(person3)

var person = { firstName: "Paul", lastName: "Irish" }
var person = Object.create(Object.prototype);
person.firstName = "Paul";
person.lastName  = "Irish";


// Retrieve the value of the weapon property
person1.name;
person1["name"];


// copy object
const a = { x: "Hi", y: "Test" }
const b = Object.assign({}, a, { x: "Bye" });
console.log(b);

const additions = { x: "Bye" }
const a = { x: "Hi", y: "Test" }
const b = { ...a,  ...additions }
console.log(b);

const b = a.map(item => Object.assign([], ...item));
console.log(b);

var map = new Map([[1,2],[3,4]]);
console.log(map instanceof Object); //true
var obj = new Object();
console.log(obj instanceof Map); //false
```




### JavaScript variable start with a dollar sign
```

https://stackoverflow.com/questions/205853/why-would-a-javascript-variable-start-with-a-dollar-sign
https://stackoverflow.com/questions/846585/can-someone-explain-the-dollar-sign-in-javascript
http://www.ecma-international.org/publications/files/ECMA-ST-ARCH/ECMA-262,%203rd%20edition,%20December%201999.pdf
http://www.ecma-international.org/publications/files/ECMA-ST-ARCH/ECMA-262%205th%20edition%20December%202009.pdf

-- 3rd Edition of ECMAScript
The dollar sign ($) and the underscore (_) are permitted anywhere in an identifier. The dollar sign is intended for use only in mechanically generated code.
-- 5rd Edition of ECMAScript
The dollar sign ($) and the underscore (_) are permitted anywhere in an IdentifierName.

var $email = $("#email"); // refers to the jQuery object representation of the dom object
var email_field = $("#email").get(0); // refers to the dom object itself

-- ECMAScript 6 (ES6)
var user = 'Bob'
console.log(`We love ${user}.`); //Note backticks
// We love Bob.
```




### generate link list from array
```

[html]
<div id="placer">
  <p>Hello World</p>
</div>

[script]
(function(){

  var arkin = new Array(
  'https://www.youtube.com/watch?v=u3u22OYqFGo',
  'https://www.youtube.com/watch?v=OaZdj1ZgiP4v',
  'https://www.youtube.com/watch?v=Gxr206kmaBk',
  );

  $.each(arkin,function(index,value){
    $('#placer p').append( '<a href="' + value + '">' + value + '</a><br>')
    //window.open(value,'_blank'+index);
    //window.focus();
    //console.log(value)
  });

})();
```




###  Const, let and var, which and when?
#### JavaScript ES6+: var, let, or const?

```

https://medium.com/javascript-scene/javascript-es6-var-let-or-const-ba58b8dcde75
https://developer.mozilla.org/de/docs/Web/JavaScript/Reference/Statements/let
https://wiki.selfhtml.org/wiki/JavaScript/Variable/let
https://medium.com/@_bengarrison/accessing-and-modifying-css-variables-with-javascript-2ccb735bbff0
https://stackoverflow.com/questions/762011/whats-the-difference-between-using-let-and-var-to-declare-a-variable-in-jav/35585468
http://incaseofstairs.com/six-speed/
https://ourcodeworld.com/articles/read/21/what-s-the-difference-between-let-and-var-in-the-declaration-of-variables-in-javascript
https://jsfiddle.net/chesminsky/wuojkrxo/
https://www.reddit.com/r/javascript/comments/3z74ok/will_let_eventually_replace_var/
https://www.reddit.com/r/javascript/comments/71iqld/is_it_still_ok_to_use_var/

https://dev.to/sarah_chima/var-let-and-const--whats-the-difference-69e
https://codeburst.io/const-let-and-var-which-and-when-541a2721c18
https://hackernoon.com/js-var-let-or-const-67e51dbb716f
https://tylermcginnis.com/var-let-const/
https://developer.mozilla.org/de/docs/Web/JavaScript/Reference/Statements/const
https://developer.mozilla.org/de/docs/Web/JavaScript/Reference/Statements/let
https://developer.mozilla.org/de/docs/Web/JavaScript/Reference/Statements/var


[script]

function varTest() {
  var x = 31;
  if (true) {
    var x = 71;  // gleiche Variable!
    console.log(x);  // 71
  }
  console.log(x);  // 71
}

function letTest() {
  let x = 31;
  if (true) {
    let x = 71;  // andere variable
    console.log(x);  // 71
  }
  console.log(x);  // 31
}

varTest(); // var variables can be re-declared and updated
letTest(); // let can be updated but not re-declared.

const declarations are block scoped
const cannot be updated or re-declared
```





### jQuery Select list attributes properties

```

[html]
<input type=checkbox value=11 name="mylist[]" />
<input type=checkbox value=22 name="mylist[]" />
<input type=checkbox value=33 name="mylist[]" />
<input type=checkbox value=44 name="mylist[]" />

[script]
// find elements
var button = $('[name^="mylist"]')
// handle click and add class
button.on("click", function(){
   console.clear( )
   $.each(  $('[name^="mylist"]'), function(index,value){
     console.log($('[name^="mylist"]').eq(index).attr("value"));
     console.log($('[name^="mylist"]').eq(index).prop("checked"));
     console.log($('[name^="mylist"]').eq(index).is("value"));
     });
});
button.each(function(){
    console.log($(this).attr('value')); // show attr
    console.log(this,$(this).attr('value')); // show html code + attr
})
```




### chartjs example
#### https://www.chartjs.org/docs/latest/charts/line.html
#### https://www.chartjs.org/docs/latest/getting-started/usage.html

```
<canvas id="myChart" width="800" height="150"></canvas>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js"></script>
<script type="text/javascript">
var myLineChart = new Chart(ctx, {
    type: 'line',
    data: data,
    options: options
});

var stackedLine = new Chart(ctx, {
    type: 'line',
    data: data,
    options: {
        scales: {
            yAxes: [{
                stacked: true
            }]
        }
    }
});
</script>
```



###  flotcharts example
####  https://www.flotcharts.org/flot/examples/

```
<div id="plot-hours"></div>
<script type="text/javascript">
    $(function ($) {
        let d1Hour = [];
        $.each([59,62,58,57,60], function (index, value) {
            d1Hour.push([index, value]);
        });
        $('#plot-hours').css({'width': '100%', 'height': '350px'});
        $.plot("#plot-hours", [
            {
                label: "Hour",
                data: d1Hour,
                bars: {show: true}
            }
        ], {
            hoverable: true,
            shadowSize: 1,
            series: {
                points: {show: false}
            },
            xaxis: {
                tickLength: 1,
                tickDecimals: 0,
                min: 0,
                max: 24,
                tickSize: 1,
            },
            yaxis: {
                min: 0,
                max: 180,
                tickSize: 50,
            },
            grid: {
                borderWidth: 1,
                borderColor: '#555'
            }
        });
    });
</script>
```





### JS OBJECTS

```
https://jsfiddle.net/

let obj1  = Object.create(null);
obj1.name = "a"

let obj2  = new Object(); // Deprecated in PHPStorm without null - expected new Object(null)
obj2.name = "b"

let obj3  = {};
obj3.name = "c"

console.log(obj1);
console.log(obj2);
console.log(obj3);
```




### DETECT HASH CLICK

```
$(function () {
	$('[href*=PREFIX]').click(function() {
		console.log($(this).css(""))
	});
	if ( window.location.hash ) {
		console.log(window.location.hash)
	}
});

$(document).ready(function(){
	console.log($('[href*=PREFIX]'));
});

# SCROLL TO HASH
$(function () {
	$('[href*=PREFIX]').on('click', function(e){
        let arHash = $(this).prop("href").split("#");
        let targetLnk = arHash[1];
		$('html, body').animate({
            scrollTop: ($('#'+targetLnk).offset().top - 100)
        }, 'slow');
        e.preventDefault();
	});
});
```




###  Get element that was clicked wehn more than one

```
$body.on('click', '.classOne, .classTwo', function (event) {
	event.stopPropagation();
	if (this == evt.target)
		// get target class info
		let targetNameClass = $(event.target).attr('class');
		let targetNameId = event.target.id
		let targetNametagName = event.target.tagName
	}
	if(targetNameClass.match(/classOne/)){
		// do something
	}
});
```




###  test

```
<div id="banner-message">
  <p>Hello World</p>
  <button msg="test">Change color</button>
</div>

<script>
// https://jsfiddle.net/boilerplate/jquery
let banner = $("#banner-message"), button = $("button");
// handle click and add class
button.on("click", function(){
  banner.addClass("alt")
  let $this = $(this), data = this.data, $button = $("button");
  console.log($button.text())
  console.log($this.attr("msg"))
})
</script>
```



#### JS Warning: Possible iteration over unexpected (custom / inherited) members, probably missing hasOwnProperty check
https://stackoverflow.com/questions/25723674/javascript-possible-iteration-over-unexpected
https://stackoverflow.com/questions/37732931/how-can-i-disable-possible-iteration-over-unexpected-inspection-in-intellij-i/37735060
https://www.reddit.com/r/learnjavascript/comments/1sv76u/the_for_in_loop_can_anyone_answer_a_few_questions/
```

// Code
for (i in awards) {
 	if (awards[i] instanceof Array === false) {
       console.log(awards[i]);
        httpFactory.patch(awards[i], {"read": true}, false);
    }
}

// FIX: Add check hasOwnProperty(i) instead of !isNaN(parseFloat(i)) or instanceof
if (!isNaN(parseFloat(i)) && awards.hasOwnProperty(i)) {
    ...
}
```


### match list

```

$(function($){
	let method = "drive_2";
  // classic
  if(method === "drive_1" || method === "drive_2" || method ===  "flight" ){
    $('body').append("<br>","done if")
  }
  // simplified
  if(method.match(/(drive_1|drive_2|flight)/) ){
    $('body').append("<br>","done match")
  }
})
```




###	JavaScript's Lambda and Arrow Functions

```

https://www.vinta.com.br/blog/2015/javascript-lambda-and-arrow-functions/
https://medium.com/@chineketobenna/lambda-expressions-vs-anonymous-functions-in-javascript-3aa760c958ae
https://developer.mozilla.org/de/docs/Web/JavaScript/Reference/Functions/Pfeilfunktionen

const materials = [
  'Hydrogen',
  'Helium',
  'Lithium',
  'Beryllium'
];

console.log(materials.map(material => material.length));
// expected output: Array [8, 6, 7, 9]

elements.map(function(element) {
  return element.length
}); // [8, 6, 7, 9]

elements.map(element => {
  return element.length
}); // [8, 6, 7, 9]

elements.map(({length}) => length); // [8, 6, 7, 9]

var func = x => x * x;
var func = (x, y) => { return x + y; };
var func = () => {  foo: 1  };
var func = () => {  foo: function() {}  };


let callback;
callback = callback || function() {}; // ok
callback = callback || (() => {});    // ok

var anon = function (a, b) { return a + b };


var numbers = [1, 4, 9];
var doubles = numbers.map(function(num) {
  console.log( num * 2);
});

// doubles ist jetzt [2, 8, 18]
// numbers ist immer noch [1, 4, 9]
```


######
###	JavaScript's Lambda InArray  or use includes()
######
```
https://developer.mozilla.org/de/docs/Web/JavaScript/Reference/Global_Objects/Object/hasOwnProperty
https://repl.it/languages/nodejs
https://developer.mozilla.org/de/docs/Web/JavaScript/Reference/Global_Objects/Array/map
https://developer.mozilla.org/de/docs/Web/JavaScript/Reference/Global_Objects/Map
https://stackoverflow.com/questions/35099779/javascript-if-a-value-exists-in-an-object
https://www.geeksforgeeks.org/javascript-array-values/
https://developer.mozilla.org/de/docs/Web/JavaScript/Reference/Global_Objects/Array/indexOf
https://developer.mozilla.org/de/docs/Web/JavaScript/Reference/Global_Objects/Array/includes

let arr = ['1','4','7','9'];
// checks integer key
arr.map( function(val){ if(arr.hasOwnProperty(val)){  console.log("Val:" + val ); } });
// checks value
arr.map( function(val){ if(val.match(/9/)){ console.log("Val:" + val ); } });

// ------------

let arr = ['1','4','7','9'];
let check = arr.map( function(val){ if(val.match(/9/)){ return true; }  });
console.log(check)   // [ undefined, undefined, undefined, true ]
const unique = [...new Set(check.map(  item => item  ))];
console.log(unique)  // [ undefined, true ]

// ------------

var elems = ["1","6","9"];
var values = Array.prototype.map.call(elems, function(obj) {
  console.log( obj );
});

// ------------

https://codepen.io/vlad-bezden/pen/OMEXJz?editors=0012
const unique = [...new Set(array.map(item => item.age))];

// ------------

'use strict';

const data = [{
	Group: 'A',
	Name: 'SD'
}, {
	Group: 'B',
	Name: 'FI'
}, {
	Group: 'A',
	Name: 'MM'
}, {
	Group: 'B',
	Name: 'CO'
}];

let unique = [...new Set(data.map(item => item.Group))];
console.log(unique);
//console.log(...new Set(data.map(item => item.Group)));


// ------------

var elems = ['ant', 'bison', 'camel', 'duck', 'bison'];
var values = Array.prototype.map.call(elems, function(obj) {
  if(obj.match(/bison/)){
    return obj;
  }
});
console.log(values)

if(values.includes('bison')){
  console.log(true)
}
else{
  console.log(false)
}

if(elems.includes('bison')){
  console.log(true)
}
else{
  console.log(false)
}

```




######
###   HTML5 required attribute one of two fields
####  https://codepen.io/anon/pen/LCpue?editors=100
####   https://stackoverflow.com/questions/24403817/html5-required-attribute-one-of-two-fields
######
```
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Form Validation Phone Number</title>
</head>
<body>
    <form name="myForm" action="data_handler.php">
        <input type="tel" name="telephone">
        <input type="tel" name="mobile">
        <input type="button" value="Submit" onclick="validateAndSend()">
    </form>
<script>
function validateAndSend() {
    if (myForm.telephone.value == '' && myForm.mobile.value == '') {
        alert('You have to enter at least one phone number.');
        return false;
    }
    else {
        myForm.submit();
    }
}
</script>
</body>
</html>
```

######
###   Scroll to the top of the page using JavaScript? - Stack Overflow
####   https://stackoverflow.com/questions/1144805/scroll-to-the-top-of-the-page-using-javascript
######
```
<script>
    $(function($){
		$('.dd-menu').delegate('a',"click",function () {
			window.scrollTo(0, 0);
		});
	});
</script>
```

######
###   UCFirst
######
```
function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
```


###   Bootstrap grid examples

```
#   https://getbootstrap.com/examples/grid/
#   http://getbootstrap.com/
#   http://fontawesome.io/icon/sticky-note-o/


jQuery’s .each() Syntax
https://www.sitepoint.com/jquery-each-function-examples/

$('div').each(function (index, value) {
  console.log('div' + index + ':' + $(this).attr('id'));
});

$.each(arr, function (index, value) {
  	console.log(value);
});

$.each(obj, function (index, value) {
	console.log(value);
});


$.each(json, function () {
   $.each(this, function (name, value) {
      console.log(name + '=' + value);
   });
});
```


### delegate
```
http://api.jquery.com/delegate/

// jQuery 1.4.3+
$( elements ).delegate( selector, events, data, handler );

// jQuery 1.7+
$( elements ).on( events, selector, data, handler );

$( "body" ).delegate( "p", "click", function() {
  alert( $( this ).text() );
});

$( "body" ).delegate( "a", "click", function( event ) {
  event.preventDefault();
});

$( "table" ).on( "click", "td", function() {
  $( this ).toggleClass( "chosen" );
});

$( "table" ).delegate( "td", "click", function() {
  $( this ).toggleClass( "chosen" );
});
```


### #Add row
```
http://jsfiddle.net/ambiguous/LAECx/

$("input.tr_clone_add").live('click', function() {
    var $tr    = $(this).closest('.tr_clone');
    var $clone = $tr.clone();
    $clone.find(':text').val('');
    $tr.after($clone);
});

Add row
http://jsfiddle.net/kQpfE/2/

$("#btnAdd").on("click",function(){
var $tableBody = $('#tbl').find("tbody"),
        $trLast = $tableBody.find("tr:last"),
        $trNew = $trLast.clone();

    $trLast.after($trNew);
});
```


######
###   Math Random
######
```
/*
http://stackoverflow.com/questions/1349404/generate-random-string-characters-in-javascript
Math.random().toString(36).replace(/[^a-z]+/g, '')
Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5);
(Math.random() + 1).toString(36).substring(7);
(Math.random().toString(36)+'00000000000000000').slice(2, N+2)
Array(N+1).join((Math.random().toString(36)+'00000000000000000').slice(2, 18)).slice(0, N)
*/

<script type="text/javascript">
    $(function ($) {
        // clone rows
        for(var i = 0; i < 500; i ++){
            var $tableBody = $('#tableid').find("tbody"),
                $trLast = $tableBody.find("tr:last"),
                $trNew = $trLast.clone();
                $trLast.after($trNew);
        }
        $('#tableid tr').each(function (index, value) {
            //console.log('' + index + ':' + $(this).find("td:eq(0)").text());
            $(this).find("td:eq(0)").text(Math.floor(Math.random() * 2000000 + 20000000))
            $(this).find("td:eq(1)").text(Math.floor(Math.random() * 4000000 + 40000000))
            //
            $(this).find("td:eq(4)").html('<span class="label label-warning arrowed arrowed-right">'+$(this).find("td:eq(4)").text()+'</span>')
            // random name
            //$(this).find("td:eq(3)").text( Math.random().toString(36).replace(/[^a-z]+/g, '') + ' ' + Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5) )
        });
        var myTable = $('#tableid').DataTable({
            "lengthMenu": [[15, 25, 50, 5, 10, -1], [ 15, 25, 50, 5,10, "All"]]
        });
        $('.loader').css("display", "none");
    });
</script>
```


######
###   copy To Clipboard javascript
######
```
<button id="demo" onclick="copyToClipboard(document.getElementById('demo').innerHTML)">This is what I want to copy</button>

<script>
  function copyToClipboard(text) {
    window.prompt("Copy to clipboard: Ctrl+C, Enter", text);
  }
</script>

https://davidwalsh.name/clipboard
https://www.sitepoint.com/javascript-copy-to-clipboard/
http://ourcodeworld.com/articles/read/143/how-to-copy-text-to-clipboard-with-javascript-easily
```


######
###   Analyze reflow Repaint Issues with Browser Tools
######
```
https://benchmarkjs.com/
https://github.com/bestiejs/benchmark.js


<script src="lodash.js"></script>
<script src="platform.js"></script>
<script src="benchmark.js"></script>
<script>
var suite = new Benchmark.Suite;

// add tests
suite.add('RegExp#test', function() {
  /o/.test('Hello World!');
})
.add('String#indexOf', function() {
  'Hello World!'.indexOf('o') > -1;
})
.add('String#match', function() {
  !!'Hello World!'.match(/o/);
})
// add listeners
.on('cycle', function(event) {
  console.log(String(event.target));
})
.on('complete', function() {
  console.log('Fastest is ' + this.filter('fastest').map('name'));
})
// run async
.run({ 'async': true });
</script>

..

;(function ($) {
  var options = {};
  window.sr = ScrollReveal(options);

  sr.reveal('.sr-item', { viewFactor: 0.6, duration: 500 });
  sr.reveal('.sr-item--seq', { viewFactor: 0.6, duration: 500 }, 50);
})(jQuery);

Ref:
https://developers.google.com/speed/articles/reflow
https://developers.google.com/web/tools/chrome-devtools/rendering-tools/
http://blog.carbonfive.com/2013/10/27/the-javascript-event-loop-explained/
https://www.sitepoint.com/10-ways-minimize-reflows-improve-performance/
```


######
###   Do action on resize
######
```
<script type="text/javascript">

    {*$('.somediv-content').resize(function () {*}
        {*setTimeout(function () {*}
            {*$('#somediv').css({"width": "100%"});*}
        {*}, 2000)*}
    {*});*}


//    $(document).ready(function () {
//        var width = $(window).width();
//        function resizeIt() {
//            $(window).resize(function () {
//                if ($(window).width() != width) {
//                    alert('resize events');
//                }
//            });
//        }
//        resizeIt();
//    });

</script>

<script type="text/javascript">
//    var elFrame = $('#frame')[0];
//    $(elFrame.contentWindow).resize(function () {
//        $(window).trigger('zoom');
//    });
//    $(window).on('zoom', function () {
//        alert('zoom', window.devicePixelRatio);
//    });
</script>

<script>
$(document).ready(function () {
//$( function() {
        $('<div id="error_alert">' + errBox + '</div>').dialog({
            modal: true,
            show: {effect: 'slideDown', direction: 'right'},
            width: 500,
            //height:500,
            //show: 'slide',
            //show: 'slideDown',
            hide: 'slideUp',
            title: "Info",
            dialogClass: "alert"
        });
        return this;
    });
//})( jQuery );
</script>

<script>
    window.setTimeout(function(){
        //$('body').find('.alert-danger').slideUp("slow");
        $('body').find('.alert-danger').parent().slideUp("slow");
    },3500);
</script>
```



######
###   Bootstrap Admin Widget collaps all
######
```
https://getbootstrap.com/docs/4.0/components/collapse/
https://adminlte.io/docs/2.4/js-box-widget
http://sitroom-bromotenggersemeru.org/master/template/Admin-ace-master/widgets.html
http://acquacleanpiscinas.com.br/public/docs/#plugins/jquery

$('.widget-box').addClass('collapsed');
```


######
###	ACE Scrollbars Skins
######
```
https://rpo.wrotapodlasia.pl/docs/sections/custom/scrollbar.html
https://github.com/junlintianxiazhifulinzhongguo/new/blob/master/public/backups/plug/ace/docs/sections/custom/scrollbar.html
https://github.com/unidal/cat2/blob/master/cat-home/src/main/webapp/assets/css/less/skins/skin-1.less
https://app.datapos.com.ar/ui/assets_old/css/less/skins/skin-1.less
https://app.datapos.com.ar/ui/assets_old/css/less/skins/skin-2.less


$('#my-content').ace_scroll({size: 400});
$('#my-content').ace_scroll({size: 400});
$('#my-content').ace_scroll({horizontal: true});
$('#my-content').ace_scroll({size: 300, mouseWheelLock: true});
$('#my-content').ace_scroll({
    size: 300,
    styleClass: 'scroll-dark scroll-left scroll-thin'
 });


https://jsfiddle.net/m_d_a/6gtjpvck/1/
https://jsfiddle.net/m_d_a/6gtjpvck/

https://github.com/bopoda/ace/blob/master/top-menu.html
https://github.com/bopoda/ace/blob/master/content-slider.html
https://cheef.github.io/jquery-ace/
https://ace.c9.io/
https://github.com/bopoda/ace/tree/master/assets/js
http://www.codeforge.com/read/302488/ace-elements.js__html
http://git.dev.sportq.com/fit-plantform/fitbkadmin/tree/master05251533/WebRoot/static/html_UI/assets/js
https://coreui.io/docs/components/bootstrap/scrollspy/
https://codepen.io/harunpehlivan/pen/dwVrEE
http://www.codeforge.com/read/302488/ace.submenu-hover.js__html
https://imwz.io/unable-to-preventdefault-inside-passive-event-listener-invocation/
https://www.gitmemory.com/issue/glidejs/glide/334/511852980

$(window).on('resize.scroll_reset', function() {
	$('.scrollable-horizontal').ace_scroll('reset');
	$('.tree-container').ace_sidebar_hover({ sub_hover_delay: 750});
	$('.tree-container').ace_scroll('reset').ace_scroll('start');
	$('.tree-container').ace_scroll({size: 250, mouseWheelLock: true});

	$('#profile-feed-1').ace_scroll({
		height: '250px',
		mouseWheelLock: true,
		alwaysVisible : true
	});

	$('.message-body').ace_scroll({
		size: 150,
		mouseWheelLock: true,
		styleClass: 'scroll-visible'
	});

	$('.sidebar').ace_scroll({
		height: '1080px',
		mouseWheelLock: true
	}).resizable({minWidth: 200, maxWidth: 880});

	$('.sidebar').ace_scroll({
		height: 1080,
		size:600,
		mouseWheelLock: true
	}).resizable({
		minWidth: 800,
		maxWidth: 980
	});
});

jQuery(function($) {

	$('.modal.aside').ace_aside();
	$('#aside-inside-modal').addClass('aside').ace_aside({
		container: '#my-modal > .modal-dialog'});

	//$('#top-menu').modal('show')
	$(document).one('ajaxloadstart.page', function(e) {
		//in ajax mode, remove before leaving page
		$('.modal.aside').remove();
		$(window).off('.aside')
	});

	//make sliders resizable using jQuery UI (you should include jquery ui files)
	$('#right-menu > .modal-dialog').resizable({
		handles: "w",
		grid: [ 20, 0 ],
		minWidth: 200,
		maxWidth: 600
	});
})
```


######
###	Browser detection using the user agent
######
```
https://developer.mozilla.org/en-US/docs/Web/HTTP/Browser_detection_using_the_user_agent
https://stackoverflow.com/questions/4565112/javascript-how-to-find-out-if-the-user-browser-is-chrome

https://modernizr.com/
https://api.jquery.com/jQuery.browser/
https://www.quirksmode.org/js/detect.html

if (navigator.userAgent.indexOf("Chrome") !== -1){ }
var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
```


######
###	Browser detection using css
######
```
https://www.shift8web.ca/2014/11/detect-browser-device-assign-custom-css-wordpress/
https://stackoverflow.com/questions/5621749/how-do-i-detect-the-user-s-browser-and-apply-a-specific-css-file

/* Chrome */
@media screen and (-webkit-min-device-pixel-ratio:0) {
 .whatever-class { padding-top:10px; }
}

/* Mozilla Firefox */
@-moz-document url-prefix() {
    .whatever-class {
        padding-top: 10px;
    }
}

@support(transform: ...){
    ...
}
```





######
###	jQuery.each - Getting li elements inside an ul
######
```
https://stackoverflow.com/questions/6017309/jquery-each-getting-li-elements-inside-an-ul
https://stackoverflow.com/questions/24319899/jquery-search-box-to-search-link-from-side-verticle-menu
https://api.jquery.com/each/
https://stackoverflow.com/questions/17162334/how-to-use-continue-in-jquery-each-loop
https://developer.mozilla.org/de/docs/Web/JavaScript/Reference/Statements/continue


<!-- https://jsfiddle.net/ -->

<div class="phrase">
  <ul class="main ">
    <li class="open">
      <ul>
        <li><a>TEXT1</a></li>
        <li>TEXT0</li>
      </ul>
    </li>
    <li>
      <ul>
        <li>TEXT2</li>
        <li>TEXT3</li>
        <li>TEXT4</li>
      </ul>
    </li>
    <li>
      <ul>
        <li>TEXT6</li>
        <li>TEXT7</li>
        <li>TEXT8</li>
      </ul>
    </li>
  </ul>
</div>

<style>

ul.main > li {
   display: none;
}

ul.main > li.open {
   display: block;
}
</style>


<script>

$(function($) {
  console.clear()
  $('ul.main li ul').each(function() {
    let strFilter = "XT3";
    $(this).find('li').each(function() {
      //let strLiElemTxt = $(this).find('a').text();
      let strLiElemTxt = $(this).text();
      //console.log(strLiElemTxt);
      //let strLiElemUrl = $(this).find('a').prop("href");
      //let strLiElemUrlRel = $(this).find('a').prop("href").replace(location.host, '');
      let strRegExPatternFilter = '' + strFilter + '';
      if (strLiElemTxt.match(new RegExp(strRegExPatternFilter, 'i'))) {
       	console.log(strLiElemTxt);
        //$(this).parent().parent().addClass('open');
         $(this).parent().closest('li').addClass('open');
      }
      /*if (strLiElemTxt.indexOf(strFilter) != -1){
      	console.log(strLiElemTxt);
         $(this).parent().closest('li').addClass('open');
      }*/
    });
  });
});


</script>
```



######
###	How to disable and then enable onclick event on <div> with javascript [closed]
######
```
https://stackoverflow.com/questions/18982642/how-to-disable-and-then-enable-onclick-event-on-div-with-javascript/18983026
https://css-tricks.com/forums/topic/add-a-click-event-and-disable-the-click-event-after-the-click/
https://www.codexworld.com/how-to/disable-click-event-jquery/
https://www.w3schools.com/jquery/event_off.asp
https://stackoverflow.com/questions/40147856/disable-click-event-on-all-controls-using-javascript
https://stackoverflow.com/questions/36105298/how-to-overwrite-event-handler-for-click-event-in-javascript
https://api.jquery.com/toggleclass/
https://api.jquery.com/event.preventdefault/
https://api.jquery.com/unbind/
https://www.mediaevent.de/javascript/event-handler-default-verhindern.html
https://www.w3schools.com/jsref/event_preventdefault.asp
https://developers.google.com/web/tools/lighthouse/audits/passive-event-listeners
https://stackoverflow.com/questions/39152877/consider-marking-event-handler-as-passive-to-make-the-page-more-responsive
https://addyosmani.com/resources/essentialjsdesignpatterns/book/
https://git.caixamagica.pt/abel.tenera/gitlab-ce-development-kit-vfos/tree/master/app
https://stackoverflow.com/questions/38451932/jquery-mobile-navigation-does-not-open-after-page-change
http://wiki.pdclab.csie.ncu.edu.tw/sirius/gitlab-ce/tree/11-4-stable/app/assets/javascripts
https://developer.mozilla.org/en-US/docs/Web/API/Event/target
https://wiki.selfhtml.org/wiki/JavaScript/DOM/Event/target
https://www.w3schools.com/jsref/event_target.asp
https://gitlab.tpu.ru/oic/yii2-tpuapptemplate/tree/053d1575e152aa6da5c92dcfacd69ee146a2a228
https://github.com/bf914/ACE
https://github.com/bopoda/ace/blob/master/form-elements.html
https://stackoverflow.com/questions/15648329/how-to-make-a-bootstrap-nav-link-inactive
http://jsfiddle.net/sujay/ec8bU/

setTimeout(function(){

    //$('.nav-list li a').unbind('click');
    //$('.nav-list li a').off('click');

    /*document.body.removeEventListener('click',function (e) {
        if (e.target.innerHTML.toLowerCase() == 'administrator') {
            e.target.insertAdjacentHTML('afterend','<div>One we do <strong>not want</strong></div>');
            e.preventDefault();
        }
    });*/

    /*document.querySelector(".nav-list li a").removeEventListener("click",
    function (evt) {
        evt.preventDefault();
        evt.stopPropagation();
    });*/

    $('body').on('click', '.disabled', function(e) {
        e.preventDefault();
        return false;
    });

    $(document).ready(function() {
       $(".nav li.disabled a").click(function() {
         return false;
       });
    });


},1600);
```


######
###	Basic Plugin Authoring
######
```
https://api.jquery.com/jQuery/
https://api.jquery.com/
https://learn.jquery.com/plugins/basic-plugin-creation/


$.fn.greenify = function() {
    this.css( "color", "green" );
};
$( "a" ).greenify(); // Makes all the links green.


(function ( $ ) {
    $.fn.greenify = function() {
        this.css( "color", "green" );
        return this;
    };
}( jQuery ));
```


######
###   Unable to preventDefault inside passive event listener invocation.
######
```
https://github.com/Tolc/jquery.nicescroll
https://stackoverflow.com/questions/60031642/how-to-add-parameters-to-a-window-event-mouse-wheel-in-svelte
```

