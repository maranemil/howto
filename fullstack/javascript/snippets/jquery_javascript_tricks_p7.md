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