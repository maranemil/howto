```
#############################################
# 	Darkmode made simple with Chrome DevTools
#############################################
```
```
Chrome DevTools  > Sources -> Overrides > Enable Local Overrides > Select folder > Save CSS File

Add:
html { filter: invert(0.89) contrast(1.1) hue-rotate(-10deg) saturate(2.5);  }
img { filter: invert(0.96) }
video { filter: invert(0.96) }

For Bootstrap:
html,body,.footer-content { background: #1a1a1a !important;}
#main-container,#nav-search { filter: invert(0.93) contrast(1.0) hue-rotate(-30deg) saturate(1.5);  }

References:
chrome://chrome-urls/
https://egghead.io/lessons/chrome-persist-live-style-changes-in-the-browser-with-chrome-devtools-local-overrides
https://developers.google.com/web/tools/chrome-devtools/inspect-styles/edit-styles
https://developers.google.com/web/updates/2018/01/devtools

Firefox > View > Page Style Your stylesheet?

https://addons.mozilla.org/en-US/firefox/addon/stylish/
https://addons.mozilla.org/de/firefox/addon/styl-us/
https://developer.mozilla.org/de/docs/Tools/Style_Editor
https://developer.mozilla.org/en-US/docs/Mozilla/Add-ons/WebExtensions/user_interface/Browser_styles
```
```
#############################################
# 	Darkmode made simple facebook
#############################################
```
```
body { filter: invert(1); background: black; }
img { filter: invert(1); }

# gray mode
let nd = document.createElement("style");  let nc = document.createTextNode(" body, _li { filter: invert(0) brightness(1.1) contrast(1.1) grayscale(96) }");  nd.appendChild(nc);  document.body.appendChild(nd)

# orange mode
let nd = document.createElement("style");  let nc = document.createTextNode(" body, _li { filter: hue-rotate(112deg) saturate(2)  }"); nd.appendChild(nc); document.body.appendChild(nd)

# darkmode dark mode
let nd = document.createElement("style");  let nc = document.createTextNode(" body, _li, div { background-color: #000000 !important; color: lightgray;  }");  nd.appendChild(nc);  document.body.appendChild(nd)
```
```
#############################################
# 	change youtube background colors
# 	div#content.style-scope.ytd-app
#############################################
```
```
http://www.colorhexa.com/999999
https://www.beautycolorcode.com/999999

#a3a3a3
#b0b0b0
#bdbdbd
#cacaca
#d6d6d6

var bgcolor = "#bdbdbd"
document.getElementById('content').style.backgroundColor = bgcolor
document.getElementById('container').style.backgroundColor = bgcolor
document.getElementById('guide-content').style.backgroundColor = bgcolor

#############################################
# change facebook background colors
# var bgcolor = 'rgb(180, 187, 75)'
#############################################

var bgcolor = '#cacaca'
var x = document.getElementsByTagName("div");
for (var i = 0; i < x.length; i++) {
    x[i].style.backgroundColor = bgcolor;
}
document.getElementById('globalContainer').style.backgroundColor = bgcolor
var y = document.getElementsByClassName('fbUserContent');
for (var j = 0; j < y.length; j++) {
    y[j].style.backgroundColor = bgcolor;
}

...

var bgcolor = '#666666'
var x = document.getElementsByTagName("div");
for (var i = 0; i < x.length; i++) {
    x[i].style.backgroundColor = bgcolor;
    x[i].style.color = '#EEEEEE';
}



setInterval( function(){   const bgcolor = '#111111'; let x = document.getElementsByTagName("div");for (let i = 0; i < x.length; i++) { x[i].style.backgroundColor = bgcolor;x[i].style.color = '#FFFF99';}  x = document.getElementsByTagName("a");for (let i = 0; i < x.length; i++) { x[i].style.color = '#FFFF99';}  x = document.getElementsByTagName("span");for (let i = 0; i < x.length; i++) { x[i].style.color = '#FFFF99'; }} ,22000);





window.onload = function() { document.getElementsByClassName("_li")[1].style.filter="invert(1)"; }
window.onload = function() { document.getElementsByClassName("_li").style.backgroundColor="#444444"; }
window.onload = function() { document.getElementsByTagName("div")[4].style.filter = "grayscale(100%)"; }

document.addEventListener("DOMContentLoaded", function(){   document.getElementsByTagName("div")[0].style.filter = "grayscale(100%)";  });
document.addEventListener("DOMContentLoaded", () => {     alert("DOM ready!");   });
window.addEventListener("unload", function() { document.getElementsByTagName("div")[0].style.filter = "grayscale(100%)"; });

#works
var newDiv = document.createElement("style");  var newContent = document.createTextNode("* { filter: invert(1); }");  newDiv.appendChild(newContent);  document.body.appendChild(newDiv)


```
```
#############################################
#	youtube_now_has_a_dark_mode_builtin
#############################################
```
```
https://www.reddit.com/r/google/comments/652obk/youtube_now_has_a_dark_mode_builtin/

document.cookie="VISITOR_INFO1_LIVE=fPQ4jCL6EiE; path=/"
document.cookie="VISITOR_INFO1_LIVE=fPQ4jCL6EiE;path=/;domain=.youtube.com";

javascript:document.cookie="name=value"
javascript:void(document.cookie="cookiename=value");

var cookieDate = new Date();
cookieDate.setFullYear(cookieDate.getFullYear( ) + 1);
document.cookie="VISITOR_INFO1_LIVE=fPQ4jCL6EiE; expires=" + cookieDate.toGMTString( ) + "; path=/";

var cookieDate = new Date();
cookieDate.setFullYear(cookieDate.getFullYear( ) + 1);
document.cookie="VISITOR_INFO1_LIVE=fPQ4jCL6EiE; expires=" + cookieDate.toGMTString( ) + "; path=/";

document.getElementById('ytd-app').style.property = 'magenta'
document.getElementByTagName('ytd-app').style.background-color = '#555'
ytd-app { background: #663; }
console.log('%c Oh my heavens! ', 'background: #222; color: #bada55');
javascript:(function(){ window.document.getElementById('content').style.backgroundColor = "#666"   });
#document.body[0].style.backgroundColor = "#666";

```
