
######
###   Add JS Event Listener
######
```
https://stackoverflow.com/questions/9899372/pure-javascript-equivalent-of-jquerys-ready-how-to-call-a-function-when-t
https://stackoverflow.com/questions/2937227/what-does-function-jquery-mean
https://stackoverflow.com/questions/10611170/how-to-set-value-of-input-text-using-jquery
https://stackoverflow.com/questions/4083351/what-does-jquery-fn-mean

http://api.jquery.com/attr/
http://api.jquery.com/prop/
https://api.jquery.com/jquery.fn.extend/

https://learn.jquery.com/plugins/basic-plugin-creation/
https://www.sitepoint.com/5-ways-declare-functions-jquery/

// with jQuery
$(document).ready(function(){ /* ... */ });

// shorter jQuery version
$(function(){ /* ... */ });

// without jQuery (doesn't work in older IEs)
document.addEventListener('DOMContentLoaded', function(){
    // your code goes here
}, false);

// and here's the trick (works everywhere)
function r(f){/in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
// use like
r(function(){
    alert('DOM Ready!');
});


(function($){
    //Attach this new method to jQuery
    $.fn.extend({
   		'pluginname': function(_options) {}
    });
})(jQuery);


(function () { console.log('allo') });
(function($) {     })(jQuery);
(function ($) { console.log($) })(jQuery);


document.onreadystatechange = function () {}

document.addEventListener("DOMContentLoaded", function(event) {
    // Your code to run since DOM is loaded and ready
});

$(function () {
  $('#EmployeeId').val("fgg");
});

jQuery.fn.extend({
  check: function() {
    return this.each(function() {
      this.checked = true;
    });
  },
  uncheck: function() {
    return this.each(function() {
      this.checked = false;
    });
  }
});

```









######
###   Wildcards in jQuery find selectors
####   https://api.jquery.com/find/
######
```
$('body').find("[class^=message]").text()
$('body').find("[class^=message]").text().match(/<a(.+)<\/a>/g);

To get all the elements starting with "jander" you should use
$("[id^=jander]")

To get those that end with "jander"
$("[id$=jander]")



Jquery extract text with regular expression on complete visible text of web page
var text = $('body').text().match(/\d{3}/g);
```


######
###   iFrame inside Bootstrap 3 modal A PEN BY Filippo Quacquarelli
####   https://codepen.io/filippoq/pen/QwogWz
######
```
<!-- html modal iframe -->
<button type="button" class="bmd-modalButton" data-toggle="modal" data-bmdSrc="https://www.youtube.com/embed/cMNPPgB0_mU" data-bmdWidth="640" data-bmdHeight="480" data-target="#myModal"  data-bmdVideoFullscreen="true">Youtube</button>
<footer>
	<div class="modal fade" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content bmd-modalContent">

				<div class="modal-body">

          <div class="close-button">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="embed-responsive embed-responsive-16by9">
					            <iframe class="embed-responsive-item" frameborder="0"></iframe>
          </div>
				</div>

			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

</footer>
<!-- html modal iframe // -->



<script>

(function($) {

    $.fn.bmdIframe = function( options ) {
        var self = this;
        var settings = $.extend({
            classBtn: '.bmd-modalButton',
            defaultW: 640,
            defaultH: 360
        }, options );

        $(settings.classBtn).on('click', function(e) {
          var allowFullscreen = $(this).attr('data-bmdVideoFullscreen') || false;

          var dataVideo = {
            'src': $(this).attr('data-bmdSrc'),
            'height': $(this).attr('data-bmdHeight') || settings.defaultH,
            'width': $(this).attr('data-bmdWidth') || settings.defaultW
          };

          if ( allowFullscreen ) dataVideo.allowfullscreen = "";

          // stampiamo i nostri dati nell'iframe
          $(self).find("iframe").attr(dataVideo);
        });

        // se si chiude la modale resettiamo i dati dell'iframe per impedire ad un video di continuare a riprodursi anche quando la modale è chiusa
        this.on('hidden.bs.modal', function(){
          $(this).find('iframe').html("").attr("src", "");
        });

        return this;
    };

})(jQuery);

jQuery(document).ready(function(){
  jQuery("#myModal").bmdIframe();
});

</script>
```



######
###   Detect if browser page was zoomed
######
```
window.devicePixelRatio
Math.round(window.devicePixelRatio * 100) # results 100, 110, etc

$(window).resize(function() {
// your code
});


screen.availWidth
screen.availHeight
window.innerWidth
window.outerWidth
$(window).width()
```


######
###	How do I store an array in localStorage? [duplicate]
####	https://stackoverflow.com/questions/3357553/how-do-i-store-an-array-in-localstorage
####	https://developer.mozilla.org/en-US/docs/Web/API/Storage/LocalStorage
####	https://developer.mozilla.org/de/docs/Web/API/Window/localStorage
######
```
localStorage only supports strings. Use JSON.stringify() and JSON.parse().

var names = [];
names[0] = prompt("New member name?");
localStorage.setItem("names", JSON.stringify(names));

//...
var storedNames = JSON.parse(localStorage.getItem("names"));
```


######
###	Looping through localStorage in HTML5 and JavaScript
####	https://stackoverflow.com/questions/3138564/looping-through-localstorage-in-html5-and-javascript
######
```
for (var i = 0; i < localStorage.length; i++){
	if(  localStorage.key(i).indexOf("somestring") > -1   ){
    	$('body').append(localStorage.getItem(localStorage.key(i)));
    }
}
localStorage.setItem("words", JSON.stringify(["Lorem", "Ipsum", "Dolor"]));

var words = JSON.parse(localStorage.getItem("words"));
words.push("hello");
localStorage.setItem("words", JSON.stringify(words));

$.each(localStorage, function(key, value){
  // key magic
  // value magic
});

for(var key in localStorage) {
  $('body').append(localStorage.getItem(key));
}

Object.keys(localStorage).forEach(function(key){
   console.log(localStorage.getItem(key));
});


localStorage.setItem('items_'+new Date().getTime(),JSON.stringify({ name : file.name, name_upload : file.uploadName }));
```



######
### Merge to array
######
```
var arrayA = [1, 2];
var arrayB = [3, 4];
var newArray = arrayA.concat(arrayB);
```


######
### join vals into string
######
```
$("#user_id").val(terms.join(','));
```


######
### Remove element
######
```
$( ".hello" ).remove();
```


######
### selectors
######
```
$( selector ).live( events, data, handler );                // jQuery 1.3+
$( document ).delegate( selector, events, data, handler );  // jQuery 1.4.3+
$( document ).on( events, selector, data, handler );        // jQuery 1.7+
```

######
### add attribute
######
```
$(element).attr('id', 'newID');
```



######
###   jQuery-File-Upload check file size
######

```
https://github.com/blueimp/jQuery-File-Upload
https://github.com/blueimp/jQuery-File-Upload/wiki/Setup
https://github.com/blueimp/jQuery-File-Upload/wiki/Basic-plugin

$(document).ready(function () {
    'use strict';

    $('#fileupload').fileupload({
        add: function(e, data) {
                var uploadErrors = [];
                var acceptFileTypes = /^image\/(gif|jpe?g|png)$/i;
                if(data.originalFiles[0]['type'].length && !acceptFileTypes.test(data.originalFiles[0]['type'])) {
                    uploadErrors.push('Not an accepted file type');
                }
                if(data.originalFiles[0]['size'].length && data.originalFiles[0]['size'] > 5000000) {
                    uploadErrors.push('Filesize is too big');
                }
                if(uploadErrors.length > 0) {
                    alert(uploadErrors.join("\n"));
                } else {
                    data.submit();
                }
        },
        dataType: 'json',
        autoUpload: false,
        // acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        // maxFileSize: 5000000,
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('<p style="color: green;">' + file.name + '<i class="elusive-ok" style="padding-left:10px;"/> - Type: ' + file.type + ' - Size: ' + file.size + ' byte</p>')
                .appendTo('#div_files');
            });
        },
        fail: function (e, data) {
            $.each(data.messages, function (index, error) {
                $('<p style="color: red;">Upload file error: ' + error + '<i class="elusive-remove" style="padding-left:10px;"/></p>')
                .appendTo('#div_files');
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);

            $('#progress .bar').css('width', progress + '%');
        }
    });
});
```





######
###   Keep overflow div scrolled to bottom unless user scrolls up
####   https://stackoverflow.com/questions/18614301/keep-overflow-div-scrolled-to-bottom-unless-user-scrolls-up
######
```
setTimeout(function() {
    var element = document.getElementById("admin_ticket_layer_panel_edit_history");
    element.scrollTop = element.clientHeight + 50; // scroll to bottom
},1500)

* * * * *

var element = document.getElementById("yourDivID");
element.scrollTop = element.scrollHeight;


function updateScroll(){
    var element = document.getElementById("yourDivID");
    element.scrollTop = element.scrollHeight;
}

//once a second
setInterval(updateScroll,1000);

* * * * *

if you want to update ONLY if the user didn't move:

var scrolled = false;
function updateScroll(){
    if(!scrolled){
        var element = document.getElementById("yourDivID");
        element.scrollTop = element.scrollHeight;
    }
}

$("#yourDivID").on('scroll', function(){
    scrolled=true;
});

* * * * *
// http://jsfiddle.net/KGfG2/
$('#yourDiv').scrollTop($('#yourDiv')[0].scrollHeight);
$("#div1").animate({ scrollTop: $('#div1')[0].scrollHeight}, 1000);
$('#div1').scrollTop($('#div1')[0].scrollHeight);
$('#yourDivID').animate({ scrollTop: $(document).height() }, "slow");   return false;

* * * * *

//Make sure message list is scrolled to the bottom
var container = $('#MessageWindowContent')[0];
var containerHeight = container.clientHeight;
var contentHeight = container.scrollHeight;

container.scrollTop = contentHeight - containerHeight;
```




######
### Init date-picker calendar
######
```
$(function () {

    $('.someclass').datepicker({
        autoclose: true,
        todayHighlight: true
    });

  $(".someclass").datepicker({
        "setDate": new Date(),
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 3,
        dateFormat: 'dd-mm-yy',
        onClose: function (selectedDate) {
            $(".someclass").datepicker("option", "maxDate", selectedDate);
        }
    });
});


http://jsfiddle.net/nEGTv/3/

<input type="text" name="date" id="datepicker" class="date-picker"/>

<script>
    $(function () {
        $("#datepicker").datepicker({
            dateFormat: {
                toDisplay: 'dd.mm.yy',
                toValue: 'yy-mm-dd'
            },
            todayHighlight: true,
            autoclose: true,
            onClose: function (selectedDate) {
                //console.log($('#datepicker').datepicker({ dateFormat: 'dd-mm-yy' }).val())
                //$("#datepicker").datepicker("option", "maxDate", selectedDate);
            }
        });
    });
</script>
```


######
###   javascript base64 decode image (php rules)
####   https://jsfiddle.net/
######
```
<script>
	var image = new Image();
	var base64code = 'iVBORw0KGgoAAAANSUhEUgAAABwAAAASCAMAAAB/2U7WAAAABlBMVEUAAAD///+l2Z/dAAAASUlEQVR4XqWQUQoAIAxC2/0vXZDrEX4IJTRkb7lobNUStXsB0jIXIAMSsQnWlsV+wULF4Avk9fLq2r8a5HSE35Q3eO2XP1A1wQkZSgETvDtKdQAAAABJRU5ErkJggg==';
	image.src = 'data:image/png;base64,' +base64code;
	document.body.appendChild(image);
</script>


<script>
	var image = new Image();
	var base64code = '   iVBORw0KGgoAAAANSUhEUgAAABwAAAASCAMAAAB/2U7WAAAABlBMVEUAAAD///+l2Z/dAAAASUlEQVR4XqWQUQoAIAxC2/0vXZDrEX4IJTRkb7lobNUStXsB0jIXIAMSsQnWlsV+wULF4Avk9fLq2r8a5HSE35Q3eO2XP1A1wQkZSgETvDtKdQAAAABJRU5ErkJggg==  ';
	base64code = trim(base64code.toString());
	image.src = 'data:image/png;base64,' + base64code;
	document.body.appendChild(image);

	function trim (str)
	{
	     //return str.replace(/\t/g, '').replace (/^\s+|\s+$/g, '').replace(/\t+/g,'');
	     return str.replace (/^\s+|\s+$/g, '');
	     //return trimSpaces(str);
	}

	/*
	function trimSpaces(str){
		var s = str;
	  	s = s.replace(/ /g,'');
		s = s.replace(/(^\s*)|(\s*$)/gi,"");
		s = s.replace(/[ ]{2,}/gi," ");
		s = s.replace(/\n /,"\n");
	  	s = s.replace(/\s/g, "");
		return s;
	}*/

	/* String.prototype.trim = function () {
	  var reExtraSpace = /^\s+(.*?)\s+$/;
	  return this.replace(reExtraSpace, "$1");
	}; */

	/* if(!String.prototype.trim) {} */
	/*
	String.prototype.trim = function() { return this.replace(/^\s+|\s+$/g,''); }
	String.prototype.trim = function() { return this.replace(/^\s+|\s+$/g,""); }
	String.prototype.ltrim = function() { return this.replace(/^\s+/,""); 	}
	String.prototype.rtrim = function() { return this.replace(/\s+$/,""); }
	*/

</script>
```


######
### 	image placer
######
```
https://css-tricks.com/snippets/html/base64-encode-of-1x1px-transparent-gif/
https://onlinepngtools.com/convert-png-to-base64
https://onlinepngtools.com/convert-data-uri-to-png
https://jsfiddle.net/amaan/xRTAA/
https://jsfiddle.net/yasumodev/tg298ns7/
https://wiki.selfhtml.org/wiki/Grafik/Grafiken_mit_Data-URI
https://css-tricks.com/data-uris/

<img width="49" height="49" alt="tick" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABwAAAASCAMAAAB/2U7WAAAABlBMVEUAAAD///+l2Z/dAAAASUlEQVR4XqWQUQoAIAxC2/0vXZDrEX4IJTRkb7lobNUStXsB0jIXIAMSsQnWlsV+wULF4Avk9fLq2r8a5HSE35Q3eO2XP1A1wQkZSgETvDtKdQAAAABJRU5ErkJggg==">
<img src="data:image/png;base64, iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAAHElEQVQI12P4//8/w38GIAXDIBKE0DHxgljNBAAO9TXL0Y4OHwAAAABJRU5ErkJggg==" alt="Red dot" />
<img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" alt="1px dot transparent">
<img src="data:image/gif;base64,R0lGODlhAQABAIAAAAUEBAAAACwAAAAAAQABAAACAkQBADs=" alt="1px dot black">

##############################################
#
#  read image pixel by pixel
#
##############################################

Source image:<br/>
<img src="data:image/jpg;base64,/9j/8iFV1XgEdoea5ciRjSKSlbJxtUfmXLly7sRzcz//Z" name="myimage" id="myimage" style="width:50%;height:50%;" />

<br/>Result image:<br/>
<canvas id="testcanvas" width="300" height="200" style="background-color:lightgrey;">
    Your browser dont support canvas.
</canvas>
<br/>
<input type="button" value="Click Here" onClick="doSomething();" />

 function doSomething() {
    var ctx=document.getElementById("testcanvas").getContext("2d");

    var img=document.getElementById("myimage");
    var x=0,y=0,width=img.width,height=img.height;
    ctx.drawImage(img,x,y,width,height);

    var imgd = ctx.getImageData(x,y,width,height);
    var pix = imgd.data;

    for (var i = 0, n = pix.length; i < n; i += 4) {
       pix[i  ] = 255 - pix[i  ]; // red
       pix[i+1] = 255 - pix[i+1]; // green
       pix[i+2] = 255 - pix[i+2]; // blue
       // i+3 is alpha (the fourth element)
    }

    ctx.putImageData(imgd, x, y);
}
```


######
###  PNG SVG Conversion
######
```
convert 'Desktop/convert/06.jpg' -resize 50x50 'Desktop/convert/06a.jpg'"
convert source.svg -density 1200 -resize 200x200  target.png

# echo ''<img src="data:image/png;base64,' . base64_encode(file_get_contents($tmpFile)) . '" width="150" />'
```


######
###   Countdown with refresh
######
```

<script>
function timedRefresh(timeoutPeriod) {
   var timer = setInterval(function() {
   if (timeoutPeriod > 0) {
       timeoutPeriod -= 1;
       //document.body.innerHTML = timeoutPeriod + ".." + "<br />";
       // or
       document.getElementById("countdown").innerHTML = timeoutPeriod + ".." + "<br />";
       document.title =  timeoutPeriod + ".." + "";
   } else {
       clearInterval(timer);
            window.location.href = window.location.href;
       };
   }, 1000);
};
timedRefresh(7);

 $(document).ready(function() {
        document.title = 'countdown ...';
 });


</script>

<div id="countdown">0</div>
```




### jQuery Event : Detect changes to the html/text of a div
```
Added synchronous DOM mutation listener to a 'DOMSubtreeModified' event. Consider using MutationObserver to make the page more responsive.
http://jsfiddle.net/nnbqye55/7/
http://help.dottoro.com/ljrmcldi.php

https://davidwalsh.name/mutationobserver-api
https://gist.github.com/zplume/de65d55702d0735398105e50f2d6de0c
https://davidwalsh.name/mutationobserver-api
https://jsfiddle.net/ecmanaut/jRbEz/
https://developer.mozilla.org/de/docs/Web/API/MutationObserver
https://gabrieleromanato.name/jquery-detecting-new-elements-with-the-mutationobserver-object/
https://github.com/eskat0n/mutabor
https://github.com/joelpurra/jquery-mutation-summary
https://davidwalsh.name/mutationobserver-api
```
```


var observer = new MutationObserver(function(mutations) {
  mutations.forEach(function(mutation) {
    alert(mutation.type);
  });
});

$(document).on("DOMSubtreeModified", "#test", function () {
    alert("Paragraph changed");
});

$('mydiv').bind("DOMSubtreeModified",function(){
  alert('changed');
});

$('.myDiv').bind('DOMNodeInserted DOMNodeRemoved', function() {

});

##################################

// The node to be monitored
var target = $( "#content" )[0];

// Create an observer instance
var observer = new MutationObserver(function( mutations ) {
  mutations.forEach(function( mutation ) {
    var newNodes = mutation.addedNodes; // DOM NodeList
    if( newNodes !== null ) { // If there are new nodes added
    	var $nodes = $( newNodes ); // jQuery set
    	$nodes.each(function() {
    		var $node = $( this );
    		if( $node.hasClass( "message" ) ) {
    			// do something
    		}
    	});
    }
  });
});

// Configuration of the observer:
var config = {
	attributes: true,
	childList: true,
	characterData: true
};

// Pass in the target node, as well as the observer options
observer.observe(target, config);

// Later, you can stop observing
observer.disconnect();

----------------------
https://stackoverflow.com/questions/41971140/implementing-mutationobserver-in-place-of-domsubtreemodified
----------------------

$('.content').each(function() {
    var sel = this;
    new MutationObserver(function() {
          //
        console.log("MutationObserver?");
    }).observe(sel, {
        childList: true, subtree: true
    });
});


$('.content').each(function() {
    var sel = this;
	new MutationObserver(adjustHeight.bind(null, sel)).observe( sel, { childList: true, subtree: true } );
});
```




######
### [Violation] Added non-passive event listener to a scroll-blocking 'mousewheel' event. 
#### Consider marking event handler as 'passive' to make the page more responsive. 
#### See https://www.chromestatus.com/feature/5745543795965952
```
Added non-passive event listener to a scroll-blocking 'touchstart' event. Consider marking event handler as 'passive' to make the page more responsive.
https://github.com/angular/material2/issues/4221
https://github.com/zzarcon/default-passive-events
https://github.com/zzarcon/default-passive-events
https://github.com/WICG/EventListenerOptions/blob/gh-pages/explainer.md
https://medium.com/@devlucky/about-passive-event-listeners-224ff620e68c

```
```
jQuery.event.special.touchstart = {
    setup: function (_, ns, handle) {
        if (ns.includes("noPreventDefault")) {
            this.addEventListener("touchstart", handle, { passive: false });
        } else {
            this.addEventListener("touchstart", handle, { passive: true });
        }
    }
};


/*

document.addEventListener('touchstart', handler, {passive: true});
document.addEventListener('touchstart', handler, true);
document.addEventListener('touchstart', handler, {capture: true});

event.stopPropagation();
event.preventDefault();

*/


https://github.com/jquery/jquery/issues/2871
https://api.jquery.com/event.stoppropagation/
https://github.com/jquery/jquery/blob/1de834672959636da8c06263c3530226b17a84c3/src/event.js#L591-L599
https://stackoverflow.com/questions/39152877/consider-marking-event-handler-as-passive-to-make-the-page-more-responsive
https://developer.mozilla.org/en-US/docs/Web/API/Event/preventDefault

var supportsCaptureOption = false;
document.createElement("div").addEventListener("test", function() {}, {
  get capture() {
    supportsCaptureOption = true;
    return false;
  }
});

...

// Only use addEventListener if the special events handler returns false
if (!special.setup || special.setup.call(elem, data, namespaces, eventHandle) === false) {
    if (elem.addEventListener) {
        var supportsPassive = false;
        try {
            var opts = Object.defineProperty({}, 'passive', {
                get: function () {
                    supportsPassive = true;
                }
            });
            window.addEventListener(type, eventHandle, opts);
            window.removeEventListener(type, eventHandle, opts);
        } catch (e) {
        }
        elem.addEventListener(type, eventHandle, supportsPassive ? {passive: true} : false);
    }
}
```



######
###   switch button off on
######

```
<div class="col-xs-3">
	<label>
		<input name="switch-field-1" class="ace ace-switch" type="checkbox">
		<span class="lbl" data-lbl="CUS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOM"></span>
	</label>
</div>

<script>

	/*

	https://github.com/bopoda/ace/blob/master/elements.html
	https://github.com/bopoda/ace/blob/master/form-elements.html
	https://github.com/bopoda/ace/
	http://ace.jeka.by/form-elements.html
	https://adminlte.io/docs/2.4/js-control-sidebar
	http://code.taobao.org/svn/ace_on_rails/trunk/doc/demo/ace-v1.2--bs-v3.0.0/form-elements.html

	Switch examples CodePen
	https://codepen.io/essejmclean/pen/wxMrGg?page=2
	https://codepen.io/saralina/pen/djGBZW?page=2
	https://codepen.io/AlbertFeynman/pen/RBKaRy?page=1&
	https://codepen.io/JiveDig/pen/jbdJXR
	https://codepen.io/brunomassa/pen/zLqebe?page=2
	https://codepen.io/pinnaclewebdevelopment/pen/yqgOEO?page=1
	https://codepen.io/ododog/pen/PBPPVv?page=3
	https://codepen.io/bhorsey/pen/gjYdxG?page=3
	https://codepen.io/3rror404/pen/PBYKbO?page=3
	https://codepen.io/bertdida/pen/oMPQgz?page=1&
	https://codepen.io/agoodwin/pen/JBvBPr?page=1&
	*/

    jQuery(function($) {
        $('#switch-field-1').change(function() {
            if($('#switch-field-1').is(':checked')){
                window.location.href='page?ps=CUS'
            }
            else{
                window.location.href='page?ps=TOM'
            }
            /*
            console.log($('#switch-field-1').val());
            console.log($('#switch-field-1').attr('checked'));
            console.log($('#switch-field-1').prop('checked'));
            console.log($('#switch-field-1').is(':checked'));
            */
        });

        if (!location.href.match(/TOM/)) {
            $('#switch-field-1').removeProp('checked',false);
        }
        else if( location.href.indexOf("TOM") != -1 ){
            $('#switch-field-1').removeProp('checked',false);
        }
        else{
            $('#switch-field-1').prop('checked',true);
            //$('.ace-switch').prop('checked',true);
        }
    });
</script>
```




