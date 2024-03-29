

### refresh page on modal window close
```
$( document ).delegate('.modal-dialog button.close',"click",function(){
	location.replace(location.href)
	// https://datatables.net/reference/api/draw()
	// var table = $('#dataTableAdminTickets_').DataTable();
	// table.page( 'next' ).draw( 'page' );
	// var table = $('#dataTableAdminTickets_').DataTable();
	// table.clear();
});
```


### display confirmation on submit
```
<form onsubmit="return confirm('Do you really want to submit the form?');">
<script>
function validate(form) {
    // validation code here ...
    if(!valid) {
        alert('Please correct the errors in the form!');
        return false;
    }
    else {
        return confirm('Do you really want to submit the form?');
    }}
</script>
<form onsubmit="return validate(this);">
```


###  For checkbox status Use jQuery's is() function:
```
if($("#isAgeSelected").is(':checked'))
    $("#txtAge").show();  // checked
else
    $("#txtAge").hide();  // unchecked
```


### The attributes property contains them all:


```
$(this).each(function() {
  $.each(this.attributes, function() {
    // this.attributes is not a plain object, but an array
    // of attribute nodes, which contain both the name and value
    if(this.specified) {
      console.log(this.name, this.value);
    }
  });
});
```



### isInteger
```
Number.isInteger()
if (Number.isInteger(y / x)) {
    return true
}
```



### outerHTML
```
https://developer.mozilla.org/en-US/docs/Web/API/Element/outerHTML
https://developer.mozilla.org/en-US/docs/Web/API/Element/outerHTML

Get selected element's outer HTML
$("#selectorid").prop("outerHTML")

// or

d = document.getElementById("d");
console.log(d.outerHTML);
```



### Console colors
```
https://developer.mozilla.org/de/docs/Web/API/Console
console.log("This is %cMy stylish message", "font-style: italic; background-color: blue;padding: 2px");
console.time("answer time");
console.log("This is %cMy stylish message", "color: white;  background-color: red; padding: 3px");
```




### Using keyboard shortcuts in Javascript
#### Overriding Browser's Keyboard Shortcuts
```
https://www.catswhocode.com/blog/using-keyboard-shortcuts-in-javascript
https://stackoverflow.com/questions/3680919/overriding-browsers-keyboard-shortcuts
https://unixpapa.com/js/key.html
https://www.w3.org/WAI/UA/work/wiki/Keyboard_Concepts_for_HTML5_Discussion
https://craig.is/killing/mice # A simple library for handling keyboard shortcuts in Javascript
https://developer.mozilla.org/de/docs/Web/API/KeyboardEvent
https://developer.mozilla.org/de/docs/Web/API/KeyboardEvent/altKey
https://www.w3schools.com/jsref/event_key_ctrlkey.asp
https://www.w3schools.com/jsref/event_ctrlkey.asp


document.onkeydown = overrideKeyboardEvent;
document.onkeyup = overrideKeyboardEvent;
var keyIsDown = {};

function overrideKeyboardEvent(e){
  switch(e.type){
    case "keydown":
      if(!keyIsDown[e.keyCode]){
        keyIsDown[e.keyCode] = true;
        // do key down stuff here
      }
    break;
    case "keyup":
      delete(keyIsDown[e.keyCode]);
      // do key up stuff here
    break;
  }
  disabledEventPropagation(e);
  e.preventDefault();
  return false;
}
function disabledEventPropagation(e){
  if(e){
    if(e.stopPropagation){
      e.stopPropagation();
    } else if(window.event){
      window.event.cancelBubble = true;
    }
  }
}

/*

onkeydown = function(e){
  if(e.ctrlKey && e.keyCode == 'S'.charCodeAt(0)){
    e.preventDefault();
    //your saving code
  }
}



document.onkeydown = function () {
    if ((window.event.keyCode == 121) && (window.event.ctrlKey))) {
       window.event.returnValue = false;
       window.event.cancelBubble = true;
       window.event.keyCode = 0;
       return false;
    }
}
*/

// First example, without JQuery:

var isCtrl = false;
document.onkeyup=function(e) {
    if(e.which == 17) isCtrl=false;
}document.onkeydown=function(e){
    if(e.which == 17) isCtrl=true;
    if(e.which == 83 && isCtrl == true) {
         alert('Keyboard shortcuts are cool!');
         return false;
    }
}

// Example with the JQuery framework:

var isCtrl = false;$(document).keyup(function (e) {
if(e.which == 17) isCtrl=false;
}).keydown(function (e) {
    if(e.which == 17) isCtrl=true;
    if(e.which == 83 && isCtrl == true) {
        alert('Keyboard shortcuts + JQuery are even more cool!');
 	return false;
 }
});


/*

Keyboard codes reference
Key	Keyboard code
Backspace	8
Tab	9
Enter	13
Shift	16
Ctrl	17
Alt	18
Pause	19
Capslock	20
Esc	27
Page up	33
Page down	34
End	35
Home	36
Left arrow	37
Up arrow	38
Right arrow	39
Down arrow	40
Insert	45
Delete	46
0	48
1	49
2	50
3	51
4	52
5	53
6	54
7	55
8	56
9	57
a	65
b	66
c	67
d	68
e	69
f	70
g	71
h	72
i	73
j	74
k	75
l	76
m	77
n	78
o	79
p	80
q	81
r	82
s	83
t	84
u	85
v	86
w	87
x	88
y	89
z	90
0 (numpad)	96
1 (numpad)	97
2 (numpad)	98
3 (numpad)	99
4 (numpad)	100
5 (numpad)	101
6 (numpad)	102
7 (numpad)	103
8 (numpad)	104
9 (numpad)	105
*	106
+	107
–	109
.	110
/	111
F1	112
F2	113
F3	114
F4	115
F5	116
F6	117
F7	118
F8	119
F9	120
F10	121
F11	122
F12	123
=	187
Coma	188
Slash /	191
Backslash \	220

*/


EXAMPLE

<!DOCTYPE html>
<html>
<head>
<script>
'use strict';

document.addEventListener('keydown', (event) => {
  const keyName = event.key;

  if (keyName === 'Control') {
    // not alert when only Control key is pressed.
    return;
  }

  if (event.ctrlKey) {
    // Even though event.key is not 'Control' (i.e. 'a' is pressed),
    // event.ctrlKey may be true if Ctrl key is pressed at the time.
    alert(`Combination of ctrlKey + ${keyName}`);
  } else {
    alert(`Key pressed ${keyName}`);
  }
}, false);

document.addEventListener('keyup', (event) => {
  const keyName = event.key;

  // As the user release the Ctrl key, the key is no longer active.
  // So event.ctrlKey is false.
  if (keyName === 'Control') {
    alert('Control key was released');
  }
}, false);

</script>
</head>

<body>
</body>
</html>
```


###  Two submit buttons in one form
```
https://stackoverflow.com/questions/547821/two-submit-buttons-in-one-form
https://stackoverflow.com/questions/1960240/jquery-ajax-submit-form
https://css-tricks.com/separate-form-submit-buttons-go-different-urls/
https://www.tutorialspoint.com/Can-I-submit-form-with-multiple-submit-buttons-using-jQuery
https://sarbbottam.github.io/blog/2015/08/21/multiple-submit-buttons-and-javascript
http://javascript-coder.com/javascript-form/javascript-get-all-form-objects.phtml
https://stackoverflow.com/questions/5721724/jquery-how-to-get-which-button-was-clicked-upon-form-submission

<form method="post" name="form">
<input type="submit" value="dosomething" onclick="javascript: form.action='actionurl1';"/>
<input type="submit" value="dosomethingelse" onclick="javascript: form.action='actionurl2';"/>
</form>


// this is the id of the form
$("#idForm").submit(function(e) {

    var form = $(this);
    var url = form.attr('action');

     //var val = $("input[type=submit][clicked=true]").val();
     //var btn = $(this).find("input[type=submit]:focus" ).val();
     //console.log(btn)

	// ------------------------------------
    // decide by action
    // ------------------------------------
    if (url.match(/actionurl1/)) {
        // we do save
        return true;
    }
    else if (url.match(/actionurl2/)) {
        // we do delete
        return confirm('some conformation here');
    }

    // ------------------------------------
	// decide by submit id value
	// ------------------------------------
  	var btn = $(this).find("input[type=submit]:focus" ).attr("id");
    console.log(btn) //

	if (btn == "add" ) {
	    // we do save
	    return true;
	}
	else if (btn == "delete" ) {
	    // we do delete
	    return confirm('some conformation here');
	}

    /*$.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
               alert(data); // show response from the php script.
           }
         });
    */
    e.preventDefault(); // avoid to execute the actual submit of the form.

  /*
	  $("#myform button").click(function (ev) {
      ev.preventDefault()
      if ($(this).attr("value") == "button1") {
        alert("First Button is pressed - Form will submit")
        $("#myform").submit();
      }
      if ($(this).attr("value") == "button2") {
        alert("Second button is pressed - Form did not submit")
      }
  */

  /*
	$.each ( document.forms["some"].getElementsByTagName("input"), function(i,e){
 		console.log(i +  ' ' + e.value )
 	})

 	$("form").submit(function() {
   		// Print the value of the button that was clicked
   		console.log($(document.activeElement).val());
	}

	 var oForm = document.forms["customer_status_form"]
	//var oTagsList = oForm.elements["submit"].attr("value");
	console.log(oForm.valueOf())
	// document.getElementById("customer_status_form").elements.length;
	// var x = document.getElementById("myForm").action;

  */


});
```



### currently running function in JavaScript?
```
function foo()
{
    alert(arguments.callee.name)
}

function DisplayMyName()
{
   var myName = arguments.callee.toString();
   myName = myName.substr('function '.length);
   myName = myName.substr(0, myName.indexOf('('));

   alert(myName);
}
```

///////////////////////////////////////////////
//
// console lowercase
//
///////////////////////////////////////////////
```
javascript:String('STRING TO LOWERCASE').toLowerCase()
```

///////////////////////////////////////////////
//
// change css in iframe
//
///////////////////////////////////////////////
```
<iframe src="somepage.html" onload="call_func"></iframe>
<script>
setTimeout(function(){
	$('iframe').contents().find("head") .append($("<style type='text/css'>  body{ font-size:11px;} </style>"));
},2000);
</script>
```







###  click event problem with nestable jquery plugin
```

Stop Drag-Ereignis beim Klicken auf einen Link

FIX: add dd-nodrag in a href

https://github.com/dbushell/Nestable
https://github.com/RamonSmit/Nestable2
https://cdnjs.com/libraries/nestable2

//cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.css
//cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js
https://stackoverflow.com/questions/16229573/stop-drag-event-during-click-a-link
https://bootstrapdocs.com/v3.3.5/docs/css/
https://hackerthemes.com/bootstrap-cheatsheet/

http://jsfiddle.net/ivangrs/N83MT/
https://css-tricks.com/myth-busting-css-animations-vs-javascript/
https://css-tricks.com/stop-animations-during-window-resizing/
https://developers.google.com/web/updates/2017/03/performant-expand-and-collapse
https://getuikit.com/v2/docs/nestable.html
https://github.com/daneden/animate.css/issues/349
https://github.com/RamonSmit/Nestable2
https://github.com/RamonSmit/Nestable2
https://jsfiddle.net/Beengie/2nLd10p7/
https://jsfiddle.net/i_like_robots/6mWZa/
https://jsfiddle.net/RomanKhomyshynets/4vogfw6o/1/
https://jsfiddle.net/s5yt9mc4/2/
https://jsfiddle.net/simurai/CMrJG/
https://stackoverflow.com/questions/29063244/consistent-styling-for-nested-lists-with-bootstrap

.noanimated {
	-webkit-animation-duration: none;
	animation-duration: none;
	-webkit-animation-fill-mode: none;
	animation-fill-mode: none;
}

```
######
```
<script>

jQuery(function ($) {
    $('.dd').nestable();
    // add click event on li blocks
    $('#nestable li').nestable({
        dropCallback : 'sourceId'
    }).on('change', function(e) {
        var strURL = $(this).find("a").attr("href");
        if(strURL != "#"){
            $('#iframe').attr("src",strURL)
        }
    });

    // test click event in list
    $('.dd').nestable({
        // options
        // maxDepth: 5,
    }).on('click', '.dd-item', function (e) {
        //e.stopPropagation();
    }).on('click', '.dd-handle', function (e) {
        e.preventDefault();
        console.log ( $(this).find("a").attr("href") );
    }).on('click', '.dd-list', function(e){
        //
    });

    setTimeout(function() {
        $('.dd').nestable('collapseAll');
    },500)
    $('#ExpandAll').click(function() {
        $('.dd').nestable('expandAll');
    });
    $('#CloseAll').click(function() {
        $('.dd').nestable('collapseAll');
    });
});

</script>

<div class="dd">
    <ol class="dd-list">
        <li class="dd-item" data-id="1">
            <div class="dd-handle">Item 1</div>
        </li>
        <li class="dd-item" data-id="3">
            <div class="dd-handle">Item 3</div>
            <ol class="dd-list">
                <li class="dd-item" data-id="4">
                    <div class="dd-handle">
                    	<a href="#" class="dd-nodrag link_min">Link</a>
                    </div>
                </li>
            </ol>
        </li>
    </ol>
</div>
```




### How to collapse the jquery nestable tree by default
```
$(selector).nestable('collapseAll');
$('#nestable').nestable({});
$('#nestable').nestable('collapseAll');
```





######
###	Nestable
####	Drag & drop hierarchical list with mouse and touch compatibility (jQuery plugin)
######
```
https://github.com/dbushell/Nestable
https://dbushell.com/Nestable/

https://jsfiddle.net/RomanKhomyshynets/4vogfw6o/1/
https://github.com/RamonSmit/Nestable2
https://codepen.io/Mestika/pen/vNpvVw
https://github.com/GetSimpleCMS/Nestable-2/blob/master/index.html
https://github.com/GetSimpleCMS/Nestable-2
https://ufirst.jp/alpha/miscellaneous-nestable.html
https://www.endpoint.com/blog/2014/07/29/customizing-nestable-jquery-plugin
http://embed.plnkr.co/Q9v6Ji/
https://getuikit.com/v2/docs/nestable.html
https://www.npmjs.com/package/nestable2
https://johnny.github.io/jquery-sortable/
*/

<div class="dd" id="nestable2">
	<input type="search" id="quicksearch" value="" placeholder="Search" />
        <ol class="dd-list">
            <li class="dd-item" data-id="13">
                <div class="dd-handle">Item 13</div>
            </li>
            <li class="dd-item" data-id="14">
                <div class="dd-handle">Item 14</div>
            </li>
            <li class="dd-item" data-id="15">
                <div class="dd-handle">Item 15</div>
                <ol class="dd-list">
                    <li class="dd-item" data-id="16">
                        <div class="dd-handle">Item 16</div>
                    </li>
                    <li class="dd-item" data-id="17">
                        <div class="dd-handle">Item 17</div>
                    </li>
                    <li class="dd-item" data-id="18">
                        <div class="dd-handle">Item 18</div>
                    </li>
                </ol>
            </li>
        </ol>
    </div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="jquery.nestable.js"></script>
<script>
    $(document).ready(function() {
   		$('#nestable-menu').on('click', function(e) {
            var target = $(e.target),
                    action = target.data('action');
            if(action === 'expand-all') {
                $('.dd').nestable('expandAll');
            }
            if(action === 'collapse-all') {
                $('.dd').nestable('collapseAll');
            }
        });
        $('#quicksearch').keyup(function(){
            var text = $('#quicksearch').val()
            var listWebmaster = $('#nestable2 ol > li');
            listWebmaster.each( function(index,value) {
                if (value.innerText.toLowerCase().indexOf(text) != -1){
                    $(this).css("display","block");
                }
                else{
                    $(this).css("display","none");
                }
            });
        });
        $('#quicksearch').click(function() {
            $('#nestable2').nestable('expandAll');
        });
    });

    $(function($) {
        $('#nestable2').nestable({ maxDepth: 1}).nestable('collapseAll');
        $('#nestable2 li button,#nestable2 li a, .dd2-contentlv1').css('pointer-events', 'all');

        // expand collapse subitems by id
        $('#nestable2 li').on('click', function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            let idLI = $(this).data('id');
            $('li#'+idLI).data("action","expand").find("ol").toggle("expand");
            $(this).find('button').toggle('expand')
        });
    });


</script>
```





######
### Search in page with javascript
```
https://developer.mozilla.org/en-US/docs/Web/API/Window/find
https://osvaldas.info/real-time-search-in-javascript
https://osvaldas.info/examples/real-time-search-in-javascript/
https://github.com/riklomas/quicksearch
http://jsfiddle.net/ZLhAd/369/
https://blog.codecentric.de/en/2013/11/javascript-search-text-html-page/
https://developer.mozilla.org/de/docs/Web/API/Element/innerHTML
```

######
```
<input type="search" id="quicksearch" value="" placeholder="Type some keywords" />

<script>
    jQuery(function($) {
        // search
        $('#quicksearch').keyup(function(){
            //console.log($('#quicksearch').val())
            var text = $('#quicksearch').val()
            var listWebmaster = $(' ol > li');
            listWebmaster.each( function(index,value) {
                if (value.innerText.indexOf(text) != -1){
                    $(this).css("display","block")
                }
                else{
                    $(this).css("display","none")
                }
            });
        });
    });
</script>
```


######
### Jquery add / remove multiple attribute on select
#### https://stackoverflow.com/questions/5881626/jquery-add-remove-multiple-attribute-on-select
#### https://www.w3schools.com/jquery/html_attr.asp
######
```
$("#theCheckbox").change(function() {
    $("#theSelect").attr("multiple", (this.checked) ? "multiple" : "");
}).change();
```



######
###	How to change date format (MM/DD/YY) to (YYYY-MM-DD) in date picker
######
```
<input type=text  data-date-format="dd-mm-yyyy" />

http://api.jqueryui.com/datepicker/#utility-formatDate
http://api.jqueryui.com/datepicker/#option-altField
http://api.jqueryui.com/datepicker/#option-dateFormat
http://api.jqueryui.com/datepicker/#option-altFormat
https://bootstrap-datepicker.readthedocs.io/en/latest/events.html
https://www.tutorialspoint.com/How-does-jQuery-Datepicker-onchange-event-work
http://jsfiddle.net/sFBn2/10/

Demo at http://jsfiddle.net/gaby/WArtA/
$(function(){
    $("#to").datepicker({ dateFormat: 'yy-mm-dd' });
    $("#from").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
        var minValue = $(this).val();
        minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
        minValue.setDate(minValue.getDate()+1);
        $("#to").datepicker( "option", "minDate", minValue );
    })
});

$('.air-datepicker').datepicker({
    onSelect: function(formattedDate, date, inst) {
        $(inst.el).trigger('change');
    }
});



// jQuery datepicker on click of icon
$(document).ready(function() {
  $("#datepicker").datepicker();
  $('.fa-calendar').click(function() {
    $("#datepicker").focus();
  });
});

 $(document).on('click',".calendar",function(){
     $("#datepicker").datepicker("show");
 });

$('#myDate').datepicker().on('changeDate', function (e) {
    $('#myDate').datepicker('hide');
});

$('#dob').datepicker({"autoclose": true});
$('#dob').datepicker().on('changeDate', function (ev) {
    $('#dob').hide();
});

$('yourpickerid').on('changeDate', function(ev){
    $(this).datepicker('hide');
});
```




######
###	how to disable drag and drop in Jquery Nestable List
######
```
<style>
	.drag_disabled{
	    pointer-events: none;
	}

	.drag_enabled{
	    pointer-events: all;
	}
</style>


<div id="nestable2" class="drag_disabled dd">
    <ol class="dd-list">
        <li class="dd-item" data-id="Item 1">
            <div class="dd-handle dd-outline dd-anim">
                Text 1
                </div>
            </div>
        </li>
        <li class="dd-item" data-id="Item 3">
            <div class="dd-handle dd-outline dd-anim">
                Text 2
            </div>
        </li>
    </ol>
</div>

<script>
	$('#list').nestable({maxDepth: 1});

	$('#nestable2').change(function(){
	    $('#list').toggleClass('drag_disabled drag_enabled');
	});
</script>
```

######
###	How to open a modal in javascript instead of manual click? [duplicate]
######
```
<script>
	$('#nestable2 li').nestable({ }).on('change', function(e) {
	    var strURL = $(this).find("a").eq(1).attr("href");
	    if(strURL !== "#" && strURL !== "javascript:" ){
	        $(this).find("a").eq(1).click();
	    }
	});
</script>
```


######
###	FIX replacement for href="javascript:void(0);"
####	jquery.min.js:4 XMLHttpRequest cannot load javascript:void(0);.
####	Cross-origin requests are only supported for protocol schemes: http, data, chrome, chrome-extension, https, chrome-extension-resource.
######
```
<button id="btnModal" type="reset" href="javascript:function(){ return false; }" class="btn btn-primary btn-xs">Open </button>

<script type="text/javascript">
    $(function($) {
      $('#btnModal').on("click", function(e){
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();
            $('#ShowModal').modal('show');
        });
    });
</script>
```





### datepicker start monday jQuery 1.7.2 + UI

https://jsfiddle.net/boilerplate/jquery

http://fiddlesalad.com/javascript/


```
Shown Field : <input id="thedate" type="text" /><br />
Hidden Field : <input id="thealtdate" type="text" /><br />
<input id="thesubmit" type="button" value="Submit" />

<script type="text/javascript">
$(function(){
    $('#thedate').datepicker({
        dateFormat: 'dd-mm-yy',
        altField: '#thealtdate',
        altFormat: 'yy-mm-dd',
        firstDay: 1,
        // defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1
        // dateFormat: 'dd-mm-yy',

    });

});
</script>
```

######
### set minDate/maxDate to now
######
```
https://github.com/Eonasdan/bootstrap-datetimepicker
https://eonasdan.github.io/bootstrap-datetimepicker/Functions/#show
https://bootstrap-datepicker.readthedocs.io/en/latest/options.html#startdate
https://github.com/Eonasdan/bootstrap-datetimepicker
https://flatpickr.js.org/
https://unpkg.com/flatpickr@2.0.5/index_.html
https://flatpickr.js.org/examples/
http://t1m0n.name/air-datepicker/docs/

<input data-date-minDate="now"/>

jQuery('#start_date').datetimepicker({ language: 'fr', minDate: new Date(), format: "YYYY-MM-DD", pickTime: false });
jQuery('#end_date').datetimepicker({ language: 'fr', minDate: new Date(), format: "YYYY-MM-DD", pickTime: false });
jQuery("#start_date").on("dp.change", function (e) { jQuery('#end_date').data("DateTimePicker").setMinDate(e.date); });
jQuery("#end_date").on("dp.change", function (e) { jQuery('#start_date').data("DateTimePicker").setMaxDate(e.date); });
```



######
### Get selected text from a drop-down list (select box) using jQuery
######
```
$("#yourdropdownid option:selected").text();
```

######
### preg_match in JavaScript
######
```
var matches = text.match(/price\[(\d+)\]\[(\d+)\]/);
```

######
### remove select option
######
```
$(".ct option[value='X']").each(function() {
    $(this).remove();
});
Or to be more terse, this will work just as well:

$(".ct option[value='X']").remove();
```