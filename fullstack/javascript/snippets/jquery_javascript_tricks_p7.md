### CryptoJS md5

~~~

https://github.com/gabrielizalo/Awesome-JavaScript-Crypto-Libraries
https://www.cdnpkg.com/crypto-js
https://www.jsdelivr.com/package/npm/crypto-js?tab=files
https://cdnjs.com/libraries/crypto-js
https://www.tutorialspoint.com/how-to-create-a-hash-from-a-string-in-javascript#
https://stackoverflow.com/questions/7616461/generate-a-hash-from-string-in-javascript
https://code.google.com/archive/p/crypto-js/
https://www.npmjs.com/package/md5
https://gist.github.com/thanashyam/2309671 # jquery md5

------------

https://codepen.io/omararcus/pen/QWwBdmo

<html lang="es">
<head>
  <meta charset="utf-8">
  <title>CryptoJS Example</title>
  <meta name="description" content="CryptoJs Example">
  <meta name="author" content="Gabriel Porras">
  <!--
  https://cdnjs.com/libraries/crypto-js
  https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/index.min.js
  
  -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
  <script>
  // INIT
var myString   = "https://www.titanesmedellin.com/";
var myPassword = "myPassword";
// PROCESS
var encrypted = CryptoJS.AES.encrypt(myString, myPassword);
var decrypted = CryptoJS.AES.decrypt(encrypted, myPassword);
document.getElementById("demo0").innerHTML = myString;
document.getElementById("demo1").innerHTML = encrypted;
document.getElementById("demo2").innerHTML = decrypted;
document.getElementById("demo3").innerHTML = decrypted.toString(CryptoJS.enc.Utf8);
</script>
</head>
<body>
</body>
  <strong><label>Original String:</label></strong>
  <span id="demo0"></span>
  <strong><label>Encrypted:</label></strong>
  <span id="demo1"></span>
  <strong><label>Decrypted:</label></strong>
  <span id="demo2"></span>
  <strong><label>String after Decryption:</label></strong>
  <span id="demo3"></span>  
  <br/>
  <br/>
</body>
</html>

------------

https://codepen.io/Garma/pen/PrYNPP

<div id="app">
  <input type="text" :value="message" @input="handleHashing($event.target.value)">
  {{ message }}
  {{ hashedMessage }}
</div>

const vm = new Vue({
  el: "#app",
  data() {
    return {
      message: "",
      hashedMessage: ""
    }
  },
  methods: {
    handleHashing(data) {
      this.message = data
      this.hashedMessage = md5(data)
      console.log("lawl")
    }
  }
})

------------

https://stackoverflow.com/questions/43605175/webpack-md5-and-vuejs

import axios from 'axios'
 import { API_URL } from '../../config/constants'
 import { md5 } from '../utils-convenience/jquery.md5'

 export default {
  // Getting data for main-page
   getEvents () {
    return new Promise((resolve, reject) => {
      var authId = 'api.example.com'
      var secretKey = 'b619d974658f3e779b2d88b215baea46'
      var xml = '<?xml version="1.0" encoding="utf-8"?><request 
      module="subdivision" format="json"><filter id="" db="" state="" 
      /><auth id="' + authId + '" /></request>'
      var sign = md5(xml + secretKey)
      axios.post(API_URL, {
        headers: {
         'Content-Type': 'application/x-www-form-urlencoded',
         'X-Requested-With': 'XMLHttpRequest'
       },
        body: {
        'xml': xml,
        'sign': sign
       }
      })
      .then((result) => {
        console.log(result)
        return resolve(result.data)
      })
       .catch(err => reject(err))
    })
  }

  export default 
 (function ($) {
   'use strict';
     ///MD5 code
  }(typeof jQuery === 'function' ? jQuery : this));

~~~


### canvas text
~~~

https://stackoverflow.com/questions/3697615/how-can-i-write-text-on-a-html5-canvas-element
https://www.html5canvastutorials.com/tutorials/html5-canvas-text-color/
https://www.oreilly.com/library/view/html5-canvas/9781449308032/ch03.html
https://webglfundamentals.org/webgl/lessons/webgl-text-canvas2d.html
https://www.w3resource.com/html5-canvas/html5-canvas-text.php
https://fjolt.com/article/html-canvas-text
https://developer.mozilla.org/en-US/docs/Web/API/CanvasRenderingContext2D/fillText
https://wiki.selfhtml.org/wiki/JavaScript/Canvas/Text
https://developer.mozilla.org/en-US/docs/Web/API/Canvas_API/Tutorial/Drawing_text
https://www.w3schools.com/graphics/canvas_text.asp
https://jsfiddle.net/liormb/3D2SK/

<canvas id="myCanvas" width="960" height="540"></canvas>
var canvas = document.getElementById('myCanvas');
var ctx = canvas.getContext('2d');

// fiil the canvas
ctx.fillStyle='red';
ctx.fillRect(0, 0, canvas.width, canvas.height);

// set the text
ctx.font = 'italic 18px Arial';
ctx.textAlign = 'center';
ctx. textBaseline = 'middle';
ctx.fillStyle = 'white';  // a color name or by using rgb/rgba/hex values
ctx.fillText('ffplay -i in.mp4 \
', 150, 50); // text and position
~~~


~~~
##############################################
get click position canvas
##############################################

https://developer.mozilla.org/en-US/docs/Web/API/Document/querySelector?retiredLocale=de
https://developer.mozilla.org/en-US/docs/Web/API/EventTarget/addEventListener?retiredLocale=de
https://developer.mozilla.org/en-US/docs/Web/HTML/Element/canvas
https://fjolt.com/article/javascript-multiple-elements-addeventlistener
https://stackoverflow.com/questions/21700364/adding-click-event-listener-to-elements-with-the-same-class
https://stackoverflow.com/questions/22902447/how-to-get-the-second-match-with-queryselector
https://stackoverflow.com/questions/34001917/queryselectorall-with-multiple-conditions-in-javascript
https://stackoverflow.com/questions/55677/how-do-i-get-the-coordinates-of-a-mouse-click-on-a-canvas-element
https://stackoverflow.com/questions/70538163/how-to-simulate-click-on-canvas-with-coordinates
https://www.w3schools.com/jsref/met_document_queryselector.asp
https://www.w3schools.com/jsref/met_document_queryselectorall.asp
https://www.w3schools.com/jsref/met_element_queryselector.asp
https://www.w3schools.com/jsref/met_element_queryselectorall.asp
https://www.w3schools.com/jsref/prop_style_border.asp
https://www.w3schools.com/jsref/prop_style_bordercolor.asp

https://jsfiddle.net/boilerplate/jquery

document.querySelector('canvas').addEventListener( 'click', function(e) { if (confirm("confirm")) { console.log(e) } })
document.querySelector('canvas').style.border="thick solid #0000FF"
document.querySelectorAll('canvas')[1].style.border="thick solid #0000FF"
document.querySelectorAll('canvas')[1].addEventListener( 'click', function(e) { if (confirm("confirm")) { console.log(e) } })
document.querySelectorAll('canvas')[1].addEventListener( 'click', function(e) { if (confirm("confirm")) { console.log(document.elementFromPoint(e.clientX, e.clientY)); } })



document.querySelector("canvas").addEventListener("click", function(s) { console.log(s)});
document.querySelector("canvas").click(1470,170)

zrX:1452
zrY: 123
clientX: 1749
clientY: 356
~~~

##############################################
### Taking A Screenshot of the Canvas
##############################################
~~~

https://webglfundamentals.org/webgl/lessons/webgl-tips.html#screenshot_canvas

<canvas id="c"></canvas>
<button id="screenshot" type="button">Save...</button>
const elem = document.querySelector('#screenshot');
elem.addEventListener('click', () => {
  canvas.toBlob((blob) => {
    saveBlob(blob, `screencapture-${canvas.width}x${canvas.height}.png`);
  });
});
 
const saveBlob = (function() {
  const a = document.createElement('a');
  document.body.appendChild(a);
  a.style.display = 'none';
  return function saveData(blob, fileName) {
     const url = window.URL.createObjectURL(blob);
     a.href = url;
     a.download = fileName;
     a.click();
  };
}());
~~~


### querySelectorAll
~~~
https://developer.mozilla.org/en-US/docs/Web/API/Document/querySelector?retiredLocale=de
https://developer.mozilla.org/en-US/docs/Web/API/Element/querySelector?retiredLocale=de
https://www.mediaevent.de/javascript/queryselector.html
https://playwright.dev/docs/other-locators
https://stackoverflow.com/questions/7084557/select-all-elements-with-a-data-xxx-attribute-without-using-jquery


document.querySelectorAll("[data-foo]")
~~~

### URLSearchParams
~~~

https://developer.mozilla.org/en-US/docs/Web/API/URL/search
https://developer.mozilla.org/en-US/docs/Web/API/URL/URL
https://developer.mozilla.org/en-US/docs/Web/API/URLSearchParams/URLSearchParams

const url = new URL(
  "https://developer.mozilla.org/en-US/docs/Web/API/URL/search?q=123",
);

// Retrieve params via url.search, passed into constructor
const url = new URL("https://example.com?foo=1&bar=2");
const params1 = new URLSearchParams(url.search);

// Get the URLSearchParams object directly from a URL object
const params1a = url.searchParams;

// Pass in a string literal
const params2 = new URLSearchParams("foo=1&bar=2");
const params2a = new URLSearchParams("?foo=1&bar=2");

// Pass in a sequence of pairs
const params3 = new URLSearchParams([
  ["foo", "1"],
  ["bar", "2"],
]);

// Pass in a record
const params4 = new URLSearchParams({ foo: "1", bar: "2" });
console.log(url.search); // Logs "?q=123"

~~~



~~~
https://stackoverflow.com/questions/45193524/how-to-add-a-tag-and-href-using-javascript
https://stackoverflow.com/questions/18500759/createelement-a-href-variable1variable2-a

const insertButton = document.getElementById('insertButton');

const appendAnchorTag = () => {
  const anchor = document.createElement('a');
  const list = document.getElementById('linksList');
  const li = document.createElement('li');
  anchor.href = 'http://google.com';
  anchor.innerText = 'Go to Google';
  li.appendChild(anchor);
  list.appendChild(li);
};

insertButton.onclick = appendAnchorTag;
<button id="insertButton">Create New Anchor Tag</button>

<ul id="linksList"></ul>
~~~



~~~
https://devhints.io/xpath
http://xpather.com/
https://www.w3schools.com/xml/xpath_syntax.asp
https://www.w3schools.com/xml/xpath_intro.asp
https://developer.mozilla.org/en-US/docs/Web/XPath/Introduction_to_using_XPath_in_JavaScript
https://www.w3schools.com/xml/xml_xpath.asp

$x("//div[contains(@class, 'month-table_col') and contains(text(), 'Nov')]")[0]
$x("//div[contains(@class, 'month-table_col') and contains(text(), 'Nov')]")
$x("/html/.//div[contains(@class, 'month-table_col'))
~~~


