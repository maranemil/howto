```
#####################################################
#
#   CSS Style for required
#
#####################################################
```
```
https://css-tricks.com/almanac/selectors/r/required/
https://getbootstrap.com/docs/4.0/components/forms/

/* style all elements with a required attribute */
:required {
  background: red;
}

/* style all input elements with a required attribute */
input:required {
  box-shadow: 4px 4px 20px rgba(200, 0, 0, 0.85);
}

/**
 * style input elements that have a required
 * attribute and a focus state
 */
input:required:focus {
  border: 1px solid red;
  outline: none;
}

/**
 * style input elements that have a required
 * attribute and a hover state
 */
input:required:hover {
  opacity: 1;
}

https://www.w3schools.com/tags/att_input_required.asp

<form action="/action_page.php">
  Username: <input type="text" name="usrname" required>
  <input type="submit">
</form>
```
```
#####################################################
#
# Select Element with Images
#
#####################################################
```
```
http://silviomoreto.github.io/bootstrap-select/
https://thdoan.github.io/bootstrap-select/
https://thdoan.github.io/bootstrap-select/examples.html

<select title="Select your surfboard" class="selectpicker">
  <option>Select...</option>
  <option data-thumbnail="images/icon-chrome.png">Chrome</option>
  <option data-thumbnail="images/icon-firefox.png">Firefox</option>
  <option data-thumbnail="images/icon-ie.png">IE</option>
  <option data-thumbnail="images/icon-opera.png">Opera</option>
  <option data-thumbnail="images/icon-safari.png">Safari</option>
</select>

------------------------------------------------------

# jQuery - How do I test whether an element exists?

if ( $( "#myDiv" ).length ) {
     $( "#myDiv" ).show();
}
```
```
#####################################################
#
# CSS Pure Loader
#
#####################################################
```
```
<style>
.loaderlarge {
        border: 16px solid #f3f3f3; /* Light grey */
        border-top: 16px solid #3498db; /* Blue */
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;
    }

    .loader {
        border: 5px solid #f3f3f3;
        -webkit-animation: spin 1s linear infinite;
        animation: spin 1s linear infinite;
        border-top: 5px solid #555;
        border-radius: 50%;
        width: 50px;
        height: 50px;
    }

    .loader2 {
        border: 5px solid #f3f3f3;
        -webkit-animation: spin 1s linear infinite;
        animation: spin 1s linear infinite;
        border-top: 5px solid #555;
        border-radius: 50%;
        width: 50px;
        height: 50px;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>


```
```
--------------------------------------------------------------------------
css word-break: break-all;
--------------------------------------------------------------------------
http://webdesignerwall.com/tutorials/word-wrap-force-text-to-wrap
https://css-tricks.com/snippets/css/prevent-long-urls-from-breaking-out-of-container/
https://www.w3schools.com/cssref/css3_pr_word-break.asp
https://www.w3schools.com/cssref/pr_text_word-spacing.asp
https://www.w3schools.com/cssref/css3_pr_word-wrap.asp
```

```
-------------------------------------------------------------------------------
Getting a div to scroll when the body uses overflow hidden
-------------------------------------------------------------------------------
.ContentWell {
	position:relative;
	top:1px;
	background-color:#fff;
	opacity:.85;
	padding:50px 50px 50px 50px;
	max-width:1140px;
	float:left;
	overflow-y:scroll;
}
```


```
-------------------------------------------------------------------------------
https://css-tricks.com/how-to-create-a-component-library-from-svg-illustrations/
https://github.com/miukimiu/react-kawaii
https://css-tricks.com/1-html-element-5-css-properties-magic/
https://css-tricks.com/creating-a-panning-effect-for-svg/

https://a.singlediv.com
https://css-tricks.com/iron-mans-arc-reactor-using-css3-transforms-and-animations/
https://css-tricks.com/solved-with-css-colorizing-svg-backgrounds/
https://viljamis.com/2018/vue-design-system/
https://css-tricks.com/putting-things-in-context-with-react/

.colorize-pink {
  filter: brightness(0.5) sepia(1) hue-rotate(-70deg) saturate(5);
}

.colorize-navy {
  filter: brightness(0.2) sepia(1) hue-rotate(180deg) saturate(5);
}

.colorize-blue {
  filter: brightness(0.5) sepia(1) hue-rotate(140deg) saturate(6);
}


https://css-tricks.com/animate-a-container-on-mouse-over-using-perspective-and-transform/
#container {
  /* This will come into play later */
  perspective: 40px;
}
```





```
-------------------------------------------------------------------------------
css streifen - stripes
-------------------------------------------------------------------------------
https://www.rapidtables.com/web/color/magenta-color.html
https://t3n.de/news/css-muster-37-449775/
https://css-tricks.com/stripes-css/
https://www.mediaevent.de/css/gradient.html
https://fastwp.de/524/
http://m101.informatik.sg/IAI2/effekte_mit_css/streifen.html

body {
    color: white;
    background: repeating-linear-gradient(45deg, #dce5f2, #dce5f2 10px, #eff1f4 10px, #eff1f4 20px);
}
```

```
-------------------------------------------------------------------------------
How to Force a Button or Link to be 100% Width CSS Tutoria
https://pagecrafter.com/how-to-force-a-button-or-link-to-be-100-width-css-tutorial/
http://html5doctor.com/html5-custom-data-attributes/
-------------------------------------------------------------------------------

.fullwidth {
	width:100%;
	margin-left:0;
	margin-right:0;
	padding-left:0;
	padding-right:0;
	display:block;
	text-align:center; /*This will result in centering the link text, which is probably what you want -brianjohnsondesign.com*/
}
```

```
-------------------------------------------------------------------------------
BG GRADIENT PATTERNS
-------------------------------------------------------------------------------
https://www.cssmatic.com/gradient-generator
http://www.colorzilla.com/gradient-editor/
https://cssgradient.io/
https://www.w3schools.com/css/css3_gradients.asp
https://css-tricks.com/snippets/css/css-linear-gradient/
https://mycolor.space/gradient


https://leaverou.github.io/css3patterns/
https://www.heropatterns.com/
http://www.patternify.com/
http://enjoycss.com/gallery/gradient_patterns
https://www.rapidtables.com/web/color/blue-color.html

/*
background: rgba(252,234,187,1);
background: -moz-linear-gradient(left, rgba(252,234,187,1) 0%, rgba(252,205,77,1) 50%, rgba(248,181,0,1) 51%, rgba(251,223,147,1) 100%);
background: -webkit-gradient ( left top, right top, color-stop(0%, rgba(252,234,187,1)), color-stop(50%, rgba(252,205,77,1)), color-stop(51%, rgba(248,181,0,1)), color-stop(100%, rgba(251,223,147,1)));
background: -webkit-linear-gradient(left, rgba(252,234,187,1) 0%, rgba(252,205,77,1) 50%, rgba(248,181,0,1) 51%, rgba(251,223,147,1) 100%);
background: -o-linear-gradient(left, rgba(252,234,187,1) 0%, rgba(252,205,77,1) 50%, rgba(248,181,0,1) 51%, rgba(251,223,147,1) 100%);
background: -ms-linear-gradient(left, rgba(252,234,187,1) 0%, rgba(252,205,77,1) 50%, rgba(248,181,0,1) 51%, rgba(251,223,147,1) 100%);
background: linear-gradient(to right, rgba(252,234,187,1) 0%, rgba(252,205,77,1) 50%, rgba(248,181,0,1) 51%, rgba(251,223,147,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fceabb', endColorstr='#fbdf93', GradientType=1 );
*/

/*
background: -webkit-linear-gradient(45deg, rgba(255,255,255,0.2) 25%, rgba(0,0,0,0) 25%, rgba(0,0,0,0) 50%, rgba(255,255,255,0.2) 50%, rgba(255,255,255,0.2) 75%, rgba(0,0,0,0) 75%, rgba(0,0,0,0) 0), rgb(170, 204, 0);
background: -moz-linear-gradient(45deg, rgba(255,255,255,0.2) 25%, rgba(0,0,0,0) 25%, rgba(0,0,0,0) 50%, rgba(255,255,255,0.2) 50%, rgba(255,255,255,0.2) 75%, rgba(0,0,0,0) 75%, rgba(0,0,0,0) 0), rgb(170, 204, 0);
background: linear-gradient(45deg, rgba(255,255,255,0.2) 25%, rgba(0,0,0,0) 25%, rgba(0,0,0,0) 50%, rgba(255,255,255,0.2) 50%, rgba(255,255,255,0.2) 75%, rgba(0,0,0,0) 75%, rgba(0,0,0,0) 0), rgb(170, 204, 0);
-webkit-background-origin: padding-box;
background-origin: padding-box;
-webkit-background-clip: border-box;
background-clip: border-box;
-webkit-background-size: 50px 50px;
background-size: 50px 50px;
*/

/*
background: -webkit-linear-gradient(45deg, rgba(248,181,0,0.2) 25%, rgba(0,0,0,0) 25%, rgba(0,0,0,0) 50%, rgba(248,181,0,1) 50%, rgba(255,255,255,0.2) 75%, rgba(0,0,0,0) 75%, rgba(0,0,0,0) 0), rgb(248,181,0);
background: -moz-linear-gradient(45deg, rgba(248,181,0,0.2) 25%, rgba(0,0,0,0) 25%, rgba(0,0,0,0) 50%, rgba(248,181,0,1) 50%, rgba(255,255,255,0.2) 75%, rgba(0,0,0,0) 75%, rgba(0,0,0,0) 0), rgb(248,181,0);
background: linear-gradient(45deg, rgba(248,181,0,0.2) 25%, rgba(0,0,0,0) 25%, rgba(0,0,0,0) 50%, rgba(248,181,0,1) 50%, rgba(255,255,255,0.2) 75%, rgba(0,0,0,0) 75%, rgba(0,0,0,0) 0), rgb(248,181,0);
-webkit-background-origin: padding-box;
background-origin: padding-box;
-webkit-background-clip: border-box;
background-clip: border-box;
-webkit-background-size: 50px 50px;
background-size: 50px 50px;
*/
```



```
##################################################################
#
#   padding bootstrap3
#
##################################################################
```
```
https://bootsnipp.com/tags/card/3
https://bootsnipp.com/snippets/featured/bootstrap-material-wizard
https://codepen.io/jstneg/pen/EVKYZj
https://getbootstrap.com/docs/4.0/components/card/
https://bootsnipp.com/tags/login

https://getbootstrap.com/docs/4.0/utilities/colors/
https://getbootstrap.com/docs/3.4/css/

https://seantheme.com/color-admin-v1.8/admin/html/helper_css.html
https://getbootstrap.com/docs/4.1/utilities/spacing/

.no-padding-left
.no-padding-right
.no-padding-bottom
.no-padding-top
.no-padding - to remove padding from all sides
```

```
#################################################################
#
#   Putting -moz-available and -webkit-fill-available in one width/height
#
#################################################################

elem {
    width: 100%;
    width: -moz-available;          /* WebKit-based browsers will ignore this. */
    width: -webkit-fill-available;  /* Mozilla-based browsers will ignore this. */
    width: fill-available;
}

#####################################################
#   HTML5 Table Borders
#   https://www.w3docs.com/snippets/html/how-to-add-border-to-html-table.html
#   https://wiki.selfhtml.org/wiki/CSS/Eigenschaften/Tabellenformatierung/border-collapse
#   https://www.w3schools.com/css/css_table.asp
#####################################################

<style>
  table, th, td {
    padding: 10px;
    border: 1px solid black;
    border-collapse: collapse;
  }
</style>
```
```
#####################################################
#
#   Responsive textarea
#
#####################################################

<div class="input-group">
	<textarea name="mytextarea" cols="100" rows="5" class="form-control"
		style="-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; width: 100%;"></textarea>
</div>
```

```
#####################################################
#
#   How to remove the CSS3 Transitions ?
#
#####################################################

https://onezeronull.com/2016/10/06/disable-css-transitions-and-animations-temporarily-or-permanently/
https://css-tricks.com/controlling-css-animations-transitions-javascript/
https://sevenspark.com/docs/ubermenu-remove-transitions
https://developer.mozilla.org/en-US/docs/Web/CSS/transition
https://developer.mozilla.org/en-US/docs/Web/CSS/transition-delay
https://developer.mozilla.org/de/docs/Web/CSS/transition
https://vuejs.org/v2/guide/transitions.html
https://wiki.selfhtml.org/wiki/CSS/Eigenschaften/Animation/transition
https://www.mediaevent.de/css/transition.html

Permanent solution
To disable CSS transitions permanently use following CSS code:

* {
    -o-transition-property: none !important;
    -moz-transition-property: none !important;
    -ms-transition-property: none !important;
    -webkit-transition-property: none !important;
    transition-property: none !important;
}
To disable CSS transformations use following instead:

* {
    -o-transform: none !important;
    -moz-transform: none !important;
    -ms-transform: none !important;
    -webkit-transform: none !important;
    transform: none !important;
}

#megaMenu ul.megaMenu > li.menu-item > a,
#megaMenu ul.megaMenu > li.menu-item > a:hover{
  -webkit-transition:none !important;
  -moz-transition:none !important;
  -o-transition:none !important;
  transition:none !important;
}

/* transition-property: top; */
```

```
#####################################################
#
#   wrap
#
#####################################################

word-break: break-all; word-wrap: break-word;
```

```
#####################################################
#
#   Media Query for different Device or Screen
#
#####################################################

/* (320x480) iPhone (Original, 3G, 3GS) */
@media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
    /* insert styles here */
}

/* (320x480) Smartphone, Portrait */
@media only screen and (device-width: 320px) and (orientation: portrait) {
    /* insert styles here */
}

/* (320x480) Smartphone, Landscape */
@media only screen and (device-width: 480px) and (orientation: landscape) {
    /* insert styles here */
}

/* (480x800) Android */
@media only screen and (min-device-width: 480px) and (max-device-width: 800px) {
    /* insert styles here */
}

/* (640x960) iPhone 4 & 4S */
@media only screen and (min-device-width: 640px) and (max-device-width: 960px) {
    /* insert styles here */
}

/* (720x1280) Galaxy Nexus, WXGA */
@media only screen and (min-device-width: 720px) and (max-device-width: 1280px) {
    /* insert styles here */
}

/* (720x1280) Galaxy Nexus, Landscape */
@media only screen and (min-device-width: 720px) and (max-device-width: 1280px) and (orientation: landscape) {
    /* insert styles here */
}

/* (1024x768) iPad 1 & 2, XGA */
@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
    /* insert styles here */
}

/* (768x1024) iPad 1 & 2, Portrait */
@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: portrait) {
    /* insert styles here */
}

/* (1024x768) iPad 1 & 2, Landscape */
@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: landscape) {
    /* insert styles here */
}

/* (2048x1536) iPad 3 */
@media only screen and (min-device-width: 1536px) and (max-device-width: 2048px) {
    /* insert styles here */
}

/* (1280x720) Galaxy Note 2, WXGA */
@media only screen and (min-device-width: 720px) and (max-device-width: 1280px) {
    /* insert styles here */
}

/* (1366x768) WXGA Display */
@media  screen and (max-width: 1366px) {
    /* insert styles here */
}

/* (1280x1024) SXGA Display */
@media  screen and (max-width: 1280px) {
    /* insert styles here */
}

/* (1440x900) WXGA+ Display */
@media  screen and (max-width: 1440px) {
    /* insert styles here */
}

/* (1680x1050) WSXGA+ Display */
@media  screen and (max-width: 1680px) {
    /* insert styles here */
}

/* (1920x1080) Full HD Display */
@media  screen and (max-width: 1920px) {
    /* insert styles here */
}

/* (1600x900) HD+ Display */
@media  screen and (max-width: 1600px) {
    /* insert styles here */
}

```

```
@media screen and (min-width: 900px) {
   body{
   background-color:#bbb;
   color:#333;
   }
   span.gr900 {display: inline-block;}
 }

@media screen and (min-width: 600px) and (max-width: 900px) {
   body{
   background-color:#000;
   color:#fff;
   }
   span.zw600-900 { display: inline-block; }
}

@media screen and (max-width: 600px) {
   body{
   background-color:#0ff;
   color:#333;
   }
   span.k600 {display: inline-block;}
}

@media screen and (max-device-width: 480px) {
   body {
   background: #eee;
   color:f67;
   }
   span.iphone {display: inline-block;}
}
```

```
###########################################################
#
#   filter css
#
###########################################################

https://css-tricks.com/almanac/properties/f/filter/
https://developer.mozilla.org/en-US/docs/Web/CSS/filter


blur()
brightness()
contrast()
drop-shadow()
grayscale()
hue-rotate()
invert()
opacity()
saturate()
sepia()

filter: blur(5px);
filter: brightness(0.4);
filter: contrast(200%);
filter: drop-shadow(16px 16px 20px blue);
filter: grayscale(50%);
filter: hue-rotate(90deg);
filter: invert(75%);
filter: opacity(25%);
filter: saturate(30%);
filter: sepia(60%);
```
```

###########################################################
#   misc
###########################################################

# adds scroll and height 50%
overflow-scroll tree-container dd
overflow-scroll tree-container dd-handle

# add padding
EditTable
```

```
#################################################################
#
#   CSS Sort List
#   https://jsfiddle.net/crisuwork/pfn62rkx/10/
#
#################################################################

<div class="container">
  <ul class="flex-sort-container list-unstyled">
    <li class="flex-sort-col sortdown">1</li>
    <li class="flex-sort-col sortdown">2</li>
    <li class="flex-sort-col sortup">3</li>
    <li class="flex-sort-col sortup">4</li>
    <li class="flex-sort-col sortup">5</li>
  </ul>
</div>
<style>
   .sortup {
      order: 1;
      background: #7FFFD4;
    }

    .sortdown {
      order: 2;
      background: #7FFF00;
    }

    .flex-sort-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      column-count: 3;
      column-gap: 4px;
      column-rule-style: dotted;
    }

    .flex-sort-col {
      display: flex;
      flex-direction: row-reverse;
      width: 9em;
      height: 9em;
    }

</style>
<!--
http://jsfiddle.net/n85cx/
https://css-tricks.com/arranging-elements-top-bottom-instead-left-right-float/
https://masonry.desandro.com/options.html
https://www.sitepoint.com/order-align-items-grid-layout/
https://www.mediaevent.de/css/flex-order.html
https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Flexible_Box_Layout/Ordering_Flex_Items
https://css-tricks.com/designing-a-product-page-layout-with-flexbox/
https://www.w3schools.com/css/css3_flexbox.asp
https://www.w3schools.com/cssref/css3_pr_order.asp
http://jsfiddle.net/EL6Zr/#
http://www.storiesinflight.com/js_divsort/index.html
https://www.w3schools.com/cssref/css_colors.asp
http://flexboxgrid.com/
-->
```


```
#####################################################
Canvas Border
#####################################################
https://www.w3schools.com/html/html5_canvas.asp
<canvas id="myCanvas" width="200" height="100" style="border:1px solid #000000;"></canvas>
```


```
#####################################################
Ugly Firefox styling for buttons, input fields and dropdown selection
https://support.mozilla.org/de/questions/1266036
#####################################################

https://www.jeffersonscher.com/googletime/index.php
https://www.jeffersonscher.com/res/select.html

border-width: 1px; # remove
```


```
#####################################################
tbody acroll
#####################################################

https://stackoverflow.com/questions/23989463/how-to-set-tbody-height-with-overflow-scroll/56998444#56998444
https://stackoverflow.com/questions/23989463/how-to-set-tbody-height-with-overflow-scroll/23989771
http://jsfiddle.net/f2XYF/16/

table, tr td {
    border: 1px solid red
}
tbody {
    display: block;
    height: 50px;
    overflow: auto;
}
thead, tbody tr {
    display: table;
    width: 100%;
    table-layout: fixed;/* even columns width , fix width of table too*/
}
thead {
    width: calc( 100% - 1em )/* scrollbar is average 1em/16px width, remove it from thead width */
}
table {
    width: 400px;
}

/*..*/

table tbody {
  display: block;
  max-height: 300px;
  overflow-y: scroll;
}

table thead, table tbody tr {
  display: table;
  width: 100%;
  table-layout: fixed;
}
/*..*/

div.scrollable-table-wrapper {
  height: 500px;
  overflow: auto;

  thead tr th {
    position: sticky;
    top: 0;
  }
}
```


```
#####################################################
force wrap inhalt table
#####################################################
[id^='some-table-'] {
    overflow-wrap: anywhere !important;
}
```

```
#####################################################
The new responsive: Web design in a component-driven world | Session CSS container queries
https://www.youtube.com/watch?v=jUQ2-C5ZNRc
#####################################################

@prefers-reduced-motion
@prefers-contrast
@prefers-reduced-transparency
@prefers-color-scheme
@inverted-colors

preference-media-queries
@container
```



```
#####################################################
5 CSS tricks every Web Developer should know in 2021
https://www.youtube.com/watch?v=wfaDzSL6ll0
#####################################################
1) backgrond-blend-mode: screen
2) clip-path: polygon (css clip path maker)
3) -webkit-animation: blink 10s infinite;
4) google fonts
5) bg gradients
```


```
#####################################################
// Learn Flexbox in 15 Minutes - Web Dev Simplified
// https://www.youtube.com/watch?v=fYq5PXgSsbE
// css flexbox
#####################################################

.flex-container {
	display: flex;
	flex-wrap: wrap;
	justify-content: center;
	align-items: center;
	align-content: center;
	/* flex-direction: column; */
}

.flex-item{
	flex-shrink: 0;
	flex-basis: 0;
	/* flex-grow: 2; */
}
```

```
#####################################################
//  
//  flex margin
//
#####################################################
https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Flexible_Box_Layout/Aligning_Items_in_a_Flex_Container
https://getbootstrap.com/docs/4.0/utilities/flex/
https://vuetifyjs.com/en/styles/flex/
https://tailwindcss.com/docs/justify-content
https://tailwindcss.com/docs/padding

flex justify-content
flex justify-start
flex justify-center

mb-4 ml-4 pb.4
```


#### align-content Flex

```
https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Flexible_Box_Layout/Aligning_Items_in_a_Flex_Container
https://developer.mozilla.org/en-US/docs/Web/CSS/overflow-x

align-content: space-between
align-content: space-around
```

~~~
https://www.w3schools.com/css/css3_variables_overriding.asp
https://vue-loader.vuejs.org/guide/scoped-css.html#deep-selectors
https://vuejs.org/guide/essentials/class-and-style.html#binding-html-classes
https://v2.vuejs.org/v2/guide/class-and-style.html
~~~

~~~
############################################################
bulma-tooltip
############################################################

https://github.com/CreativeBulma/bulma-tooltip/
https://bulma-tooltip.netlify.app/get-started/
https://www.jsdelivr.com/package/npm/@creativebulma/bulma-tooltip
https://fontawesome.com/icons/circle-info?s=regular&f=classic
https://wikiki.github.io/elements/tooltip/
https://bulma.io/documentation/columns/sizes/
https://bulma.io/documentation/elements/button/
https://bulma.io/documentation/overview/colors/

<link href="https://cdn.jsdelivr.net/npm/@creativebulma/bulma-tooltip@1.2.0/dist/bulma-tooltip.min.css" rel="stylesheet">
~~~

~~~
###############################################################
Drop-Shadow: The Underrated CSS Filter
###############################################################

https://css-irl.info/drop-shadow-the-underrated-css-filter/
https://developer.mozilla.org/en-US/docs/Web/CSS/filter-function/drop-shadow


.my-element {
  filter: drop-shadow(0 0.2rem 0.25rem rgba(0, 0, 0, 0.2));
}
img {
  filter: drop-shadow(0.35rem 0.35rem 0.4rem rgba(0, 0, 0, 0.5));
}

filter: drop-shadow(0 0 0.75rem crimson);
~~~


~~~
###############################################################
keyframes
###############################################################
https://developer.mozilla.org/en-US/docs/Web/CSS/@keyframes?retiredLocale=de
https://www.w3schools.com/cssref/css3_pr_animation-keyframes.php
https://www.mediaevent.de/css/animation.html
https://www.w3schools.com/css/css3_animations.asp
https://css-tricks.com/snippets/css/keyframe-animation-syntax/
https://wiki.selfhtml.org/wiki/CSS/Tutorials/Animation/Animation
https://www.html-seminar.de/css3-keyframes-animationen.htm


@keyframes slidein {
  from {
    transform: translateX(0%);
  }

  to {
    transform: translateX(100%);
  }
}

@keyframes mymove {
  from {top: 0px;}
  to {top: 200px;}
}

~~~


~~~
################################################################
CSS random colors
################################################################


https://codepen.io/beben-koben/pen/eYPNew

<div class="center"></div>

body {
     background-color: #fff;
     -webkit-animation: random 5s infinite;
     animation: random 5s infinite;
}
@keyframes  random {
    15% { background-color: red; } 
    30% { background-color: yellow; } 
    45% { background-color: green; } 
    60% { background-color: blue; }
    75% { background-color: white; }  
}

/*
@keyframes mymove{
    form{background-color: #38dc58; }
    to{background-color: #9b40f1;}
}
YOU CAN USE LIKE IT TOO :d
*/

div
{
  background:#debe94;
  width:100px;
  height:100px;
  transition: all 0.3s ease-out;
}
.center
{ 
  margin:auto;
  position:absolute;
  top:0; bottom:0; left:0; right:0;
}


https://css-tricks.com/random-numbers-css/

@keyframes flicker {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}

#red {
  animation: flicker 2s ease alternate infinite;
}

~~~


~~~
#################################################
height: 100% fix
#################################################

https://stackoverflow.com/questions/7049875/why-doesnt-height-100-work-to-expand-divs-to-the-screen-height

body {
    height: 100vh;
}
body {
    min-height: 100vh;
    background: #ffdd57;
    overflow-x: hidden;
}
~~~