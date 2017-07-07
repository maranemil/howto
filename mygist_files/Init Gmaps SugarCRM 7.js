// Init Gmaps SugarCRM 7

if($.isEmptyObject(google)) {
   $.getScript('https://www.google.com/jsapi', function () {
    google.load("maps", "3", {'other_params' : 'sensor=true' });                       
   });             
}