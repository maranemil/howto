######
#
### Widget Box bootstrap - how to
```
https://rpo.wrotapodlasia.pl/docs/sections/custom/widget-box.html
http://git.test.topschool.net.cn:8080/summary/OpenSource%2Face.git
https://gitlab.tpu.ru/oic/yii2-tpuapptemplate/tree/66af8d3b65584a5a1157057342d674dc24dfadc3/backend/themes/ace
https://gitlab.tpu.ru/oic/yii2-tpuapptemplate/tree/053d1575e152aa6da5c92dcfacd69ee146a2a228
https://github.com/bf914/ACE
https://github.com/bopoda/ace
https://github.com/bopoda/ace
https://github.com/almasaeed2010/AdminLTE
http://www.alguaciles.cl/bootstrap/ace-theme/docs/#examples
http://www.alguaciles.cl/bootstrap/ace-theme/docs/#examples
https://rpo.wrotapodlasia.pl/docs/sections/custom/widget-box.html
https://gitlab.noblet.ca/nobletsolutions/ace-bundle
```
######

---------------------------
#
### Functions & Events
```
The following functions are available for widgets:

  close
  toggle
  hide
  show
  reload
  fullscreen



 $('#my-widget').widget_box('toggle');
 $('#my-widget').widget_box('show');
 $('#my-widget').widget_box('close');
 $('#my-widget').widget_box('reload');


The following events are triggered when using widgets:
```

---------------------------
### Before Events:
```
show.ace.widget triggered before a widget box is shown
hide.ace.widget triggered before a widget box is hidden
close.ace.widget triggered before a widget box is closed
reload.ace.widget triggered before a widget box is reloaded
fullscreen.ace.widget triggered before a widget box is fullscreen
setting.ace.widget triggered before a widget box is fullscreen
```

---------------------------
### After Events:
```
shown.ace.widget triggered after a widget box is shown
hidden.ace.widget triggered after a widget box is hidden
closed.ace.widget triggered after a widget box is closed
reloaded.ace.widget triggered after a widget box is reloaded
fullscreened.ace.widget triggered after a widget box is fullscreened

With "before events" you can cancel an action.

For example when you are waiting for remote content to arrive, you can cancel "close" events:

 $('#my-widget').on('close.ace.widget reload.ace.widget', function(event) {
    if(waitingForContent) {
       event.preventDefault();//action will be cancelled, widget box won't close
    }
 });

With "after events" you can do some action after its finished:

 $('#my-widget').on('shown.ace.widget', function(event) {
    //$(this).doSomething();
 });
reload.ace.widget can be used to load remote content.

When data is ready, you can trigger reloaded.ace.widget:

 $('#my-widget').on('reload.ace.widget', function(ev) {
   $.ajax({url: 'remote-data.php'}).done(function(content) {
     //use content
     //when ready ...
     $('#my-widget').trigger('reloaded.ace.widget');
   });
 });
setting.ace.widget event does not have an "after" event.

You can use it to be notified when "settings" button is clicked and show a dialog:
 $('#my-widget').on('setting.ace.widget', function(ev) {
   //launch a modal (settings box) or other appropriate action
 });

```
---------------------------
### Cookies & localStorage
 ```

Cookie and localStorage functionality has been added to save/load variables and settings.

The functions are defined in ace-extra.js

//cookie functions
ace.cookie.set(name, value, expires, path, domain, secure);
ace.cookie.get(name);
ace.cookie.remove(name, path);

//localStorage functions
ace.storage.set(key, value);
ace.storage.get(key);
ace.storage.remove(key);
ace.data_storage is a wrapper which by default chooses localStorage if available. Otherwise it will use cookies for saving data.

But you can change that by specifying an arguement.

Inside ace-extra.js, ace.data is initiated and used to save and retrieve settings.
ace.data = new ace.data_storage(2);//use cookies
ace.data = new ace.data_storage(1);//or use localStorage
ace.data = new ace.data_storage();//or use localStorage if available otherwise use cookies

ace.data.set(namespace, key, value);
//for example
ace.data.set('settings', 'sidebar-collapsed', 1);
ace.data.get('settings', 'sidebar-collapsed');

//without namespace
ace.data.set('username', 'alex');
ace.data.get('username');

//remove
ace.data.remove('settings', 'sidebar-collapsed');
ace.data.remove('username');
```

```
<script>

    jQuery(function($) {

        (function() {

          ace.data = new ace.data_storage(); // or use localStorage if available otherwise use cookies
          var widgets = ace.data.get('demo', "widget-state",1) // get statuses hidden shown

          //console.log(widgets);
          //console.log(jQuery.type( widgets ))


          // Object.is('foo', 'foo');
          // https://api.jquery.com/jQuery.isEmptyObject/
          // https://api.jquery.com/jQuery.type/
          // https://developer.mozilla.org/de/docs/Web/JavaScript/Reference/Global_Objects/Object/is
          // https://rpo.wrotapodlasia.pl/docs/sections/custom/widget-box.html

          // if no widget set, hide second widget
          if( widgets === null ){
            $('#widget-box-myqw1').widget_box('hide'); // toggleFast closeFast
          }

            // check if is object
            if( jQuery.type( widgets ) == 'object' ){

                 // check in array of key exists
                 var bWW1 = 'widget-box-myqw1' in widgets; // returns true or false
                 var bWW2 = 'widget-box-myqw2' in widgets; // returns true or false

                 //console.log(widgets['widget-box-myqw1'])
                 //console.log(widgets['widget-box-myqw2'])

                 if( widgets['widget-box-myqw1'] == "shown" && widgets['widget-box-myqw2'] == "shown" ){
                     $('#widget-box-w1').widget_box('show'); // toggleFast closeFast
                     $('#widget-box-w2').widget_box('hide'); // toggleFast closeFast
                 }

                /*
                //if(bW1 && bW2 ){
                  $.each(widgets,function(key,value) {
                      if(key == 'widget-box-w1' && value == "shown" && bW2){
                          $('#widget-box-w1').widget_box('toggleFast'); // toggleFast closeFast
                      }
                      else if(key == 'widget-box-w2' && value == "shown" && bW2){
                          $('#widget-box-w1').widget_box('toggleFast');
                      }
                      //console.log(key + ' ' + value)
                  });
                //}
                */
          }
        })();
    });

</script>
```
```
<script>

    jQuery(function($) {
        // close Box1
        $('#widget-box-w2').on('shown.ace.widget', function(event) {
            event.preventDefault();
            $('#widget-box-w1').widget_box('hide');
        });
        // close Box2
        $('#widget-box-w1').on('shown.ace.widget', function(event) {
            event.preventDefault();
            $('#widget-box-w1').widget_box('hide');
        });

        (function() {

           // ace_demo_widget-state
           // { "widget-box-w1":"hidden","undefined":"hidden" }
           // { "widget-box-w2":"shown","undefined":"shown" }

           ace.data = new ace.data_storage();//or use localStorage if available otherwise use cookies
           var widgets = ace.data.get('demo', "widget-state",1) // hidden shown

           // if no widget set, hide second widget
           if( widgets === null ){
               $('#widget-box-w2').widget_box('hide'); // toggleFast closeFast toggle show close reload
           }

           if( jQuery.type( widgets ) === 'object' ){

               // console.log(widgets)
               // check in array of key exists
               var bW1 = 'widget-box-w1' in widgets; // returns true or false
               var bW2 = 'widget-box-w2' in widgets; // returns true or false

               //console.log(widgets['widget-box-w1'])
               //console.log(widgets['widget-box-w2'])

               if( widgets['widget-box-w1'] === "shown" && widgets['widget-box-w2'] === null){
                   $('#widget-box-w1').widget_box('hide'); // toggleFast closeFast
                   $('#widget-box-w2').widget_box('show'); // toggleFast closeFast
               }

               /*if(widgets['widget-box-w1'] == "shown" && widgets['widget-box-w2'] == "shown" ){
                   $('#widget-box-w1').widget_box('show'); // toggleFast closeFast
                   $('#widget-box-w2').widget_box('hide'); // toggleFast closeFast
               }*/
            }

        })();

    });

</script>
```

