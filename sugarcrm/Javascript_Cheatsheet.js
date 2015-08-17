/////////////////////////////////////////////////
///
/// Javascript mini Cheatsheet
///
////////////////////////////////////////////////

//---------------------------------------
// Match
//---------------------------------------
if (location.href.match(/#YourString/)) {
    // ...do someting
}
if (element.toString().indexOf("#YourString") != -1) {
    //...do someting
}


//---------------------------------------
// Regex V1
//---------------------------------------
// var regexEmail = "[a-zA-Z0-9._%+-]+@[A-Z0-9.-]+\.[a-zA-Z]{2,4}"
var text = location.href;
var regex = /#(.*)+/g;
var match = regex.exec(text);
var SomeId = match[0].replace("#YourString/", "");


//---------------------------------------
// Regex V2
//---------------------------------------
var arr = text.match(/#(.*)+/g) || [""]; //could also use null for empty value
var SomeId = arr[0].replace("#YourString/", "");


//---------------------------------------
// Set value to child
//---------------------------------------
$('[data-fieldname="somefield_c"]').children().children().attr('readonly', true);

({
    // sugarCRM 7.X
    _renderFields: function () {
        this._super('_renderFields');
        var field = this.getField("field_a_c");
        if (field && this.model.get("field_b_c")) {
            //if(field.tplName=="edit"){
            //field.setMode('readonly');
            field.setMode('disabled');
            //field.setMode('edit');
            //field.setMode('detail');
            //}
        }
    }
})


//---------------------------------------
// Search recursive in DOM
//---------------------------------------
$(this).parent().parent().parent().find('input.somefield:first').val();
$(this).parent().closest('input.somefield').val();


//---------------------------------------
// Remove chars
//---------------------------------------
var FieldName = FieldName.replace(/(\(\(0\)\)|\(0\))/g, function (m) {
    return m == '(0)' ? '' : m
});
FieldName = FieldName.replace(/\D/g, '');
FieldName = FieldName.replace(/[^0-9]/g, '');


//---------------------------------------
// Repalce \n with BR Tag
//---------------------------------------
var StringName = "bla bla \n";
StringName = StringName.replace(/\n/g, "<br />");

//---------------------------------------
// Remove digits
//---------------------------------------
FieldName = FieldName.replace(/[^a-zA-Z]/g, '');


//---------------------------------------
// Loop through objects
//---------------------------------------
_.each(data, function (item, index) {
    //...do someting
});
$.each(data, function (index, value) {
    // ...do someting
});


//---------------------------------------
// Split string
//---------------------------------------
var someVar = element.toString().split('#YourString/');


//---------------------------------------
// Replace string
//---------------------------------------
var someVar = element.toString().replace('x', '');

//---------------------------------------
// Select by value
//---------------------------------------
$('#fild :input[value="123"]').show();


//---------------------------------------
// Match selected options from select tag element jQuery
//---------------------------------------

$("#select > option").each(function () {
    alert(this.text + ' ' + this.value);
});

$(function () {
    $("#select option").each(function (i) {
        alert($(this).text() + " : " + $(this).val());
    });
});

$('#select').find('option').each(function (index, element) {
    console.log(index);
    console.log(element.value);
    console.log(element.text);
});

$('#select option').each(function (index, element) {
    console.log(index);
    console.log(element.value);
    console.log(element.text);
});

//---------------------------------------
// Match selected checkboxes from select tag element jQuery
//---------------------------------------

var maxSyncFields = $('.sync_statusbox').length;
var checked = 0;
for (var i = 0; i <= maxSyncFields; i++) {
    if ($('.sync_statusbox').eq(i).attr("checked") == "checked") {
        var fieldKey = $(".labelname").eq(i).attr("data-labelname");
        checked++;
    }
}


//---------------------------------------
// Match past date
//---------------------------------------

var ONE_HOUR = 60 * 60 * 1000;
/* ms */
var ONE_DAY = 60 * 60 * 1000 * 24;
/* ms */
var INTERVAL = ONE_DAY * 60;
var myDate = new Date();
var now = myDate.getTime();
var past = myDate.getTime() - INTERVAL
console.debug(now)
console.debug(past)
console.debug(new Date(now))
console.debug(new Date(past))

// created < pastinterval - refresh
// created > pastinterval - do nothing

//---------------------------------------
// Match future date
//---------------------------------------

var timestamp = new Date().getTime() + (30 * 24 * 60 * 60 * 1000)
if (timestamp > selectedTimestamp) {
    // The selected time is less than 30 days from now
}
else if (timestamp < selectedTimestamp) {
    // The selected time is more than 30 days from now
}
else {
    // -Exact- same timestamps.
}

// -------------------------------------------

var now = new Date();
now.setHours(0, 0, 0, 0);
if (selectedDate < now) {
    // selected date is in the past
}

// -------------------------------------------
// http://jsfiddle.net/3yXCY/3/
// -------------------------------------------
var dateStart = new Date(1990, 11, 01);
var dateEnd = new Date(1990, 11, 03);

var dateStart2 = new Date(1990, 11, 03);
var dateEnd2 = new Date(1990, 11, 01);

if (Date.parse(dateStart) < Date.parse(dateEnd)) {
    alert("DateStart: " + dateStart + " is less than " + dateEnd);
} else {
    alert("DateEnd: " + dateEnd + " is less than " + dateStart);
}

if (dateStart2 < dateEnd2) {
    alert("DateStart: " + dateStart2 + " is less than " + dateEnd2);
} else {
    alert("DateEnd: " + dateEnd2 + " is less than " + dateStart2);
}


// -------------------------------------------
//
// Math expressions Javascript
//
// -------------------------------------------

// https://jsfiddle.net/

$(document).ready(function () {

    setTimeout(function () {
        var srand = Math.floor(Math.random() * 20 + 200); // range 200-220
        var rem = srand % 2; // 0 or 1 as result from Modulus

        if (rem == 0) {
            // do something
            // parseFloat((737/1070).toFixed(2)) // 0.69
        }

        $('#result').html(srand);
    }, 200);

});

// http://mathjs.org/docs/reference/functions/divide.html

Math.divide(2, 3);            // returns number 0.6666666666666666

var a = math.complex(5, 14);
var b = math.complex(4, 1);
math.divide(a, b);            // returns Complex 2 + 3i

var c = [[7, -6], [13, -4]];
var d = [[1, 2], [4, 3]];
math.divide(c, d);            // returns Array [[-9, 4], [-11, 6]]

var e = math.unit('18 km');
math.divide(e, 4.5);          // returns Unit 4 km



// jQuery check Checkbox value


// jQuery 1.6+
// Use the new .prop() method:

$('.myCheckbox').prop('checked', true);
$('.myCheckbox').prop('checked', false);

// jQuery 1.5.x and below
// The .prop() method is not available, so you need to use .attr().

$('.myCheckbox').attr('checked', true);
$('.myCheckbox').attr('checked', false);

// Note that this is the approach used by jQuery's unit tests prior to version 1.6 and is preferable to using

$('.myCheckbox').removeAttr('checked');

//http://stackoverflow.com/questions/426258/setting-checked-for-a-checkbox-with-jquery